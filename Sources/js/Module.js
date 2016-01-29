
// volanie ajaxu na ulozenie formularu
function submitForm(element ,formSelector) {
            //event.preventDefault();
            var edi = $('#editor1');
            if(!(typeof edi.val() === "undefined")){
                CKEDITOR.instances.editor1.updateElement();
            }

            var $btn = $(element).button("loading");
            var form = $(element).closest(formSelector);
            var formData = new FormData(form[0]);

            $.ajax({
                url: form.attr("action"),
                type: form.attr("method"),
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function (returndata) {
                    form.find(".form_result").hide().html(returndata).fadeIn(200);
                },
                error: function (returndata) {
                    form.find(".form_result").hide().html(returndata).fadeIn(200);
                }
            });
            $btn.button("reset");
}

// volanie ajaxu na vypisanie editovacieho formulara
function updateModule(moduleClass,id) {
    $.ajax({
        url: "_controllers/" + moduleClass + ".php?show_editor=true",
        data: { "id": id },
        type: "post",
        success: function (result) {
            showModal("modalBox", "lg", "Edit "+moduleClass, result);
        },
        error:function (result){
            showModal("modalBox", "sm", "Edit "+moduleClass, "Unable to open editor.<br>"+result);
        }
    });
}

//volanie ajax funkcie na vymazanie modulu zo stranky
function deleteModule(moduleClass, id) {
    if (confirm("Do you really want to remove this module?")) {
        $.ajax({
            url: "_controllers/" + moduleClass + ".php?delete=true",
            data: { "id": id },
            type: "post",
            success: function (result) {
                $.fancybox({
                    'modal': true,
                    'content': result + '<a href="javascript:;" onclick="$.fancybox.close();">CLOSE</a>'
                });
                setTimeout(function () {
                    location.reload();
                }, 1000);
            },
            error: function (result) {
                $.fancybox({
                    'modal': true,
                    'content': result + '<a href="javascript:;" onclick="$.fancybox.close();">CLOSE</a>'
                });
            }
        });
   }
}

//funkcia na select/deselect vsetkych checkboxov v parente
function selectAllCheckboxesFrom(parent){
    $(parent).find("input[type^='checkbox']").each(function () {
        $(this).prop('checked', true);
    });
}

//funkcia na select/deselect vsetkych checkboxov v parente
function unSelectAllCheckboxesFrom(parent){
    $(parent).find("input[type^='checkbox']").each(function () {
        $(this).prop('checked', false);
    });
}

//funkcia na select/deselect vsetkych checkboxov v parente
function selectUnselectAllCheckboxesFrom(parent){
    var unselected = 0;
    var cb = $(parent).find("input[type^='checkbox']");
    cb.each(function () {
        if(!$(this).is(':checked'))
            unselected++;
    });
    if(unselected > 0)
        selectAllCheckboxesFrom(parent);
    else
        unSelectAllCheckboxesFrom(parent);
}

//funkcia vymaze selectnute chekbox polozky z parenta 
function removeSelectedItemsFrom(parent){
    $(parent).find("input[type^='checkbox']").each(function () {
        if($(this).is(':checked')){
            $(this).parent().remove();
        }
    });
}


// --------- Filemanager Functions ------ START//
//funkcia zisti ci je zadana cesta subor/priecinok/neexistujuci
function getPathType(path){
    var pathType = null;
    $.ajax({
        'async': false,
        'type': "POST",
        'global': false,
        'dataType': 'html',
        'url': "_controllers/File.php",
        'data': { 'get_path_type': path },
        'success': function (data) {
		data = jQuery.parseJSON(data);
            if(data.success){
                pathType = data.data;
            }
            else alert('type not success');

        }
    });
    return pathType;
}
//funkcia vrati vsetky subory ktorych pripona suboru sa nachadza v premennej extensions ktora je typu pole
function getFilesFromPath(path, extensions){
    var resultFiles = null;
    $.ajax({
        'async': false,
        'type': "POST",
        'global': false,
        'dataType': 'html',
        'url': "_controllers/File.php",
        'data': { 'get_files_from_dir': path , 'supported_file' : JSON.stringify(extensions)},
        'success': function (data) {
            data = jQuery.parseJSON(data);
            if(data.success){
                resultFiles = data.data;
            }
            else alert('folder not success');
        }
    });
    return resultFiles;
}
//funkcia nastavuje nahlad suboru
//ak je parameter editable nastaveny na true, zobrazi nahlad s moznostou vyplnit meno a popis
function setPreview(url, editable, multi){
    var filename = url.replace(/^.*[\\\/]/, "");
    var ext = filename.split(".").pop();
    var path = "files/" + url;
    if (getPathType("filesthumb/" + url)=="file") {
        var thumb = "filesthumb/" + url;
        var thumb_medium = "filesthumb_medium/" + url;
    }
    else if (getPathType("img/ico/" + ext + ".jpg")=="file") {
        var thumb = "img/ico/" + ext + ".jpg";
        var thumb_medium = thumb;
    }
    else {
        var thumb = "img/ico/default.jpg";
        var thumb_medium = thumb;
    }

    if(editable && multi)
        $(".files-actual").append(previewEditable(filename, "", path, thumb, thumb_medium));
    else if(!editable && multi)
        $(".files-actual").append(preview(filename, path, thumb, thumb_medium));
    else if(editable && !multi)
        $(".files-actual").html(previewEditable(filename, "", path, thumb, thumb_medium));
    else if(!editable && !multi)
        $(".files-actual").html(preview(filename, path, thumb, thumb_medium));
}
// vrati nahlad pre editovatelny subor
function previewEditable(title, description, path, thumb, thumb_medium) {
    return '\
                    <label class="col-xs-12">\
                        <input class="hiddenSection" name="file-path[]" type="checkbox" value="' + path + '">\
                        <div class="row">\
                            <input class="hiddenSection" name="file-thumb[]" type="text" value="' + thumb + '">\
                            <input class="hiddenSection" name="file-thumb-medium[]" type="text" value="' + thumb_medium + '">\
                            <div class="col-xs-3 result-file-preview" style="background-image:url(\''+ thumb + '\')"></div>\
                            <div class="col-xs-9 "><input name="file-title[]" placeholder="title"  class="form-control" type="text" value="'+ title + '"></div>\
                            <div class="col-xs-9 "><input name="file-description[]" placeholder="description" class="form-control" type="text" value="' + description + '"></div>\
                        </div>\
                    </label>\
                                    ';
}

//vrati nahlad pre subor
function preview(filename, path, thumb, thumb_medium) {
    return '\
                    <label class="col-xs-12">\
                        <input class="hiddenSection" name="file-path[]" type="checkbox" value="' + path + '">\
                        <div class="row">\
                            <input class="hiddenSection" name="file-thumb[]" type="text" value="' + thumb + '">\
                            <input class="hiddenSection" name="file-thumb-medium[]" type="text" value="' + thumb_medium + '">\
                            <div class="col-xs-3 result-file-preview" style="background-image:url(\'' + thumb_medium + '\')"></div>\
                            <div class="col-xs-9 "><a href="'+ path + '" target="_blank" download title="' + filename + '">' + filename + '</a></div>\
                            <div class="col-xs-9 "></div>\
                        </div>\
                    </label>';
}
// otvori okno s filemanagerom
function open_popup(type) {

    var w = window.innerWidth - window.innerWidth / 15;
    var h = window.innerHeight - window.innerHeight / 8;
    var l = Math.floor((screen.width - w) / 2);
    var t = Math.floor((screen.height - h) / 2);

    var win = window.open("filemanager/filemanager.php?type="+type, "ResponsiveFilemanager", "scrollbars=1,width=" + w + ",height=" + h + ",top=" + t + ",left=" + l);

    }

/*
//callback funkcia filemanagera
function responsive_filemanager_callback(field_id) {
    handleFile(field_id,true, true, ["jpg", "jpeg", "gif", "png"])
}*/
//spracovania callback funkcie filemanagera
function handleFile(field_id, editable, multiple, extensions){
    var url = jQuery("#" + field_id).val();
	var pathType = getPathType("files/"+url);
    if(pathType == 'file'){
        setPreview(url, editable, multiple);
    }
    else if(pathType == 'dir'){
        var files = getFilesFromPath("../files/"+url, extensions);
        //alert(files[0]);
        $.each(files, function(index, path){
            setPreview(path.replace("../files/",""), editable, multiple);
        });
    }
}

$(function () {
    $('[data-toggle="popover"]').popover()
})

/*
<script type="text/javascript">
  $(document).ready(function(){
    $('.combobox').combobox();
  });
</script>
*/

// --------- Filemanager Functions ------ END//

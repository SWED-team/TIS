// inicializacia tiniMCE pluginu
    tinymce.init({
        height:500,
        selector: ".formated",
        //theme: "modern",
        //skin: 'light',
        plugins: [
             "advlist autolink link image lists charmap print preview hr anchor pagebreak",
             "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
             "table contextmenu directionality emoticons paste textcolor responsivefilemanager code "
        ],
        toolbar1: "undo redo | styleselect fontsizeselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent ",
        toolbar2: "| filemanager | link unlink | image media | forecolor backcolor  | print preview code ",
        image_advtab: true,

        external_filemanager_path: "/TIS/Sources/filemanager/",
        filemanager_title: "Filemanager",
        external_plugins: { "filemanager": "/TIS/Sources/filemanager/plugin.min.js" },

        content_css: ["./css/format.css"]
    });

// volanie ajaxu na ulozenie formularu
function submitForm(element ,formSelector) {
            event.preventDefault();
            tinyMCE.triggerSave();
            //CKEDITOR.instances.content.updateElement();
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
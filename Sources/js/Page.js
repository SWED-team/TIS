// volanie ajaxu na vypisanie editovacieho formulara
function updatePage(id) {
    $.ajax({
        url: "_controllers/Page.php?show_editor=true",
        data: { "id": id },
        type: "post",
        success: function (result) {
            showModal("modalBox", "lg", "Edit Page", result);
        },
        error:function (result){
            showModal("modalBox", "sm", "Edit Page", "Unable to open editor.<br>"+result);
        }
    });
}

//volanie ajax funkcie na vymazanie modulu zo stranky
function deletePage(id) {
    if (confirm("Do you really want to remove this page?")) {
        $.ajax({
            url: "_controllers/Page.php?delete=true",
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
function addPage(){
    $.ajax({
        url: "_controllers/Page.php?show_editor=true",
        data: { },
        type: "post",
        success: function (result) {
            showModal("modalBox", "lg", "Add Page", result);
        },
        error:function (result){
            showModal("modalBox", "sm", "Add Page", "Unable to open editor.<br>"+result);
        }
    });
}
function setHomePage(value,id){
    if ($(value).is(":checked")){
        
        $.ajax({
            url: "_controllers/Page.php",
            data: {"id" : id, "set_home" : true},
            type: "post",
            success: function (result) {
                //showModal("modalBox", "sm", "Edit Page", result);
                $(".homeDisabled").prop('checked', false).change();
                //$('#pagelist_result').html(printAlert('warning', '<strong>Warning!</strong>  Changes applies when page will be reloaded. <a onclick="javascript:location.reload()"> Click to reload</a>'));
                setTimeout(function(){location.reload();}, 300);
                
          },
            error:function (result){
                //showModal("modalBox", "sm", "Edit Page", "Error occured.<br>"+result);
                location.reload()
            }
        });
    }
}
function setNavbarPage(value,id){
    val = $(value).is(":checked")*1;
    $.ajax({
        url: "_controllers/Page.php",
        data: {"id" : id, "set_navbar" : val},
        type: "post",
        success: function (result) {

            //showModal("modalBox", "sm", "Edit Page", result);
            $('#pagelist_result').html(printAlert('warning', '<strong>Warning!</strong>  Changes applies when page will be reloaded. <a onclick="javascript:location.reload()"> Click to reload</a>'));
        },
        error:function (result){
            //showModal("modalBox", "sm", "Edit Page", "Error occured.<br>"+result);
            $('#pagelist_result').html(printAlert('warning', reuslt));
        }
    });
}
function setStatusPage(value, id){
    val = $(value).is(":checked")*1;
    $.ajax({
        url: "_controllers/Page.php",
        data: {"id" : id, "set_status" : val},
        type: "post",
        success: function (result) {
            //showModal("modalBox", "sm", "Edit Page", result);
            //location.reload()
            $('#pagelist_result').html(printAlert('warning', '<strong>Warning!</strong>  Changes applies when page will be reloaded. <a onclick="javascript:location.reload()"> Click to reload</a>'));
            
        },
        error:function (result){
            //showModal("modalBox", "sm", "Edit Page", "Error occured.<br>"+result);
            //location.reload()
            $('#pagelist_result').html(printAlert('warning', reuslt));

        }
    });
}

// volanie ajaxu na vypisanie editovacieho formulara
function updateCategory(id) {
    $.ajax({
        url: "_controllers/Category.php?show_editor_category=true",
        data: { "id": id },
        type: "post",
        success: function (result) {
            showModal("modalBox", "lg", "Edit Category", result);
        },
        error:function (result){
            showModal("modalBox", "sm", "Edit Category", "Unable to open editor.<br>"+result);
        }
    });
}

//volanie ajax funkcie na vymazanie modulu zo stranky
function deleteCategory(id) {
    if (confirm("Do you really want to remove this page?")) {
        $.ajax({
            url: "_controllers/Category.php?delete_category=true",
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
function addCategory(){
    $.ajax({
        url: "_controllers/Category.php?show_editor_category=true",
        data: { },
        type: "post",
        success: function (result) {
            showModal("modalBox", "lg", "Add Category", result);
        },
        error:function (result){
            showModal("modalBox", "sm", "Add Category", "Unable to open editor.<br>"+result);
        }
    });
}

function printAlert(type, message){
    return '<div class="alert alert-warning alert-dismissible" role="alert">\
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
  '+message+'</div>';
}





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
function setHomePage(id){
    $.ajax({
        url: "_controllers/Page.php",
        data: {"id" : id, "set_home" : true},
        type: "post",
        success: function (result) {
            //showModal("modalBox", "sm", "Edit Page", result);
            location.reload()
        },
        error:function (result){
            //showModal("modalBox", "sm", "Edit Page", "Error occured.<br>"+result);
            location.reload()
        }
    });
}
function setNavbarPage(value,id){
    $.ajax({
        url: "_controllers/Page.php",
        data: {"id" : id, "set_navbar" : value},
        type: "post",
        success: function (result) {
            //showModal("modalBox", "sm", "Edit Page", result);
            location.reload()
        },
        error:function (result){
            //showModal("modalBox", "sm", "Edit Page", "Error occured.<br>"+result);
            location.reload()
        }
    });
}
function setStatusPage(value, id){
    $.ajax({
        url: "_controllers/Page.php",
        data: {"id" : id, "set_status" : value},
        type: "post",
        success: function (result) {
            //showModal("modalBox", "sm", "Edit Page", result);
            location.reload()
        },
        error:function (result){
            //showModal("modalBox", "sm", "Edit Page", "Error occured.<br>"+result);
            location.reload()
        }
    });
}





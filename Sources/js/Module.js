function submitForm(formSelector){
    $(formSelector).find("[type=\'submit\']").each(function(){
        $(this).on("click",function(event){
            event.preventDefault();
            var $btn = $(this).button("loading");
            var form = $(this).closest(formSelector);
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
                error: function(returndata){
                    form.find(".form_result").hide().html(returndata).fadeIn(200);
                }
            });
            $btn.button("reset");
        });
    });
}

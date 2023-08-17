BX.ready(function(){
    if(typeof form_id !== "undefined"){
        $(`#${form_id}`).validate({
            rules: {
                phone:{required: true,},
            },
            messages: {
                phone:{required: "Введите номер телефона",},
            },
            submitHandler: function(form, event) {
                event.preventDefault();    
        
                var request = BX.ajax.runComponentAction('kontur:form', 'Send_Form', {
                    mode: 'class',
                    data: new FormData( document.getElementById(`${form_id}`) ),
                });
                
                request.then(function(response) {
                    $(`#${form_id} .phone`).addClass("hide");
                    $(`#${form_id} span.success`).removeClass("hide");
                    $(`#${form_id} button`).addClass("hide");
                });
        
            },
            errorElement: "div",
            errorPlacement: function(error, element) {
                $(`#${form_id} .error_placement`).append(error);
            },
        });
	
        $(`${form_id} .phone-mask`).inputmask("mask", {"mask": "+7 (999) 999-99 99"});
    
    }
});
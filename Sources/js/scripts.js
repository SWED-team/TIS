
        $.fn.modal.Constructor.prototype.enforceFocus = function() {
          modal_this = this
          $(document).on('focusin.modal', function (e) {
            if (modal_this.$element[0] !== e.target && !modal_this.$element.has(e.target).length 
            && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_select') 
            && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_text')) {
              modal_this.$element.focus()
            }
          })
        };
        



function showModal(modalId, size, header, body) {
    var modalHtml = '\
    <div class="modal fade" id="'+ modalId + '" role="dialog">\
    <div class="modal-dialog modal-'+size+'">\
      <div class="modal-content">\
        <div class="modal-header">\
          <button type="button" class="close" data-dismiss="modal">&times;</button>\
          <h4 class="modal-title">'+ header + '</h4>\
        </div>\
        <div class="modal-body">\
          <p>'+ body + '</p>\
        </div>\
        <div class="modal-footer">\
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>\
        </div>\
      </div>\
    </div>\
  </div>';
    var modal = $("#" + modalId);
    if (modal.size() > 0) {
        modal.remove();
    }
    $("body").append(modalHtml);

    $("#" + modalId).modal();
}


//kliknutie na registracne tlacitko
$("#regButton").on("click",function  () {
			ajaxRegistration();
});

//kliknutie na prihlasovacie tlacidlo
$("#loginButton").on("click",function  (event) {
		event.preventDefault();
		$("#check_div").html("");
		ajaxLogin();
});

//kliknutie na odhlasenie 
$("#logofButton").on("click",function  () {
		logOfUser();
});

//kliknutie na editovanie profilu
$("#editProfileButtonSubmit").on("click",function  () {
		ajaxEditProfile();
});


///funckia vypise vsetky errory pri reg/editacii usera
function printRegErrors(selector,errors){
		$(selector).html("");
			 $.each(errors ,function(key,value)
			 {
			 	if(value){$(selector).
			 		append('<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> '+value+'</div>');}
			 });
}
		
		
function ajaxUniversal(parameter1, parameter2,parameter3) {
	    fnc =  parameter1;
	    var sendInfo = {
	        'function': fnc,
	        "arg": {
	            "par1": parameter2,
	            "par2": parameter3
	        }
	    };
	    jQuery.ajax({
	        type: "POST",
	        url: '_controllers/ajax_handler.php',
	        data: { 'json': sendInfo },
	        success: function (data) {
	            $("#infoSectionUser2").html(data);
	        },
	        error: function (data) {
	            alert("chyba AJAXU");
	        }
	    });
}
    
function logOfUser(){
		$.ajax({
			type:"POST",
	    url: '_controllers/ajax_handler.php',
	    data: {'json':{'function': "Logoff","arg": {"":""}}},
	    success: function(data){
	    	if(data==""){
	    		location.reload();
	    	}
	    },
	    error: function(data){
		  }

		});
}

function ajaxLogin(){
		fnc ="Login";
		 var sendInfo = {'function':fnc,
	 	 "arg":{
	           "loginEmail": $("#PoploginEmail").val(),
	           "loginPass":$("#PoploginPass").val()
	       		}
	       };
	    jQuery.ajax({
	        type: "POST",
	        url: '_controllers/ajax_handler.php',
	        data: {'json':sendInfo},
	       success: function(data){
					if(data !==""){
					     $("#check_divPop").html("");
					     location.reload();
					}else {
			       	$("#check_div").html("");
					   $("#check_div").append('<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong></strong> Login dont match</div>');
					}
			  },
		  		error: function(data){
		  			alert("chyba AJAXU");
			  }
			});
}

function ajaxRegistration(){
		 var sendInfo = {
		 	'function':'RegUser',
		 	"arg":{
		           "login": $("#loginEmail").val(),
		           "firstName":$("#loginFirstName").val(), 
		       		"lastName":$("#loginLastName").val(),
		       		"pass":$("#loginPass1").val(),
		       		"pass2":$("#loginPass2").val(),
		       		"bio":$("#loginBio").val(),
		       	}
	  };
	  jQuery.ajax({
	        type: "POST",
	        url: '_controllers/ajax_handler.php',
	        data: {'json':sendInfo
	      },
	       success: function(data){
			   if(data=="ok" || data ==""){
			  		$("#check_div2").html("");
			  		$('#regButton').hide();
			   		$("#check_div2").append('<div class="alert alert-success" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Well done!</strong>Successfull registration !</div>');
					}else {

						data2 =jQuery.parseJSON(data);
						printRegErrors("#check_div2",data2);
					}
		  },
	  		error: function(data){
	  			alert("chyba AJAXU");
		    return data;
		  	}
		});
}

function ajaxEditProfile(){
		 var sendInfo = {
		 	'function':'EditUser',
		 	"arg":{
		          "firstName":$("#editFirstName").val(), 
		       		"lastName":$("#editLastName").val(),
		       		"bio":$("#editBio").val(),
		       	}
	  };
	  jQuery.ajax({
	        type: "POST",
	        url: '_controllers/ajax_handler.php',
	        data: {'json':sendInfo
	      },
	       success: function(data){
			   if(data=="ok" || data ==""){

			  		$("#editProfileResult").html("");
			   		$("#editProfileResult").append('<div class="alert alert-success" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Well done!</strong> Your profile informations was updated successfully</div>');
					}else {

						data2 =jQuery.parseJSON(data);
						printRegErrors("#editProfileResult",data2);
					}
		  },
	  		error: function(data){
	  			alert("chyba AJAXU");
		    	return data;
		  	}
		});
}


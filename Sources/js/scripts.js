
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










///script na preklikvania user/search v headeri
   
  /*$("#userBarIcon" ).on("click",function() {
                
           
	  var toggleWidth = $("#userBarHide").width() == 500 ? "0px" : "500px";
	  var height = 50;
	  $('#userBarHide').animate({ width: toggleWidth,height: "50px" });
	  $('#searchBarHide').animate({ width: "0px",height: "0px"  });
  });


  $("#searchBarIcon" ).on("click",function() {

                
                     
    var toggleWidth = $("#searchBarHide").width() == 500 ? "0px" : "500px";
    var height = 50;
    $('#searchBarHide').animate({ width: toggleWidth,height: "50px"});
    $('#userBarHide').animate({ width: "0px",height: "0px" });
  });

*/
/////script pre overenie registracnych udajov usera a naslednej registracie
	$("#regButton").on("click",function  () {

	//	alert("idem regfdsfsdffsdf");
			ajaxRegEdit(0);

	
	
	});
/////swtich user menu 
	$("#btnEdit").on("click", function () {
	    ajaxUniversal("SwithUserMenu1",1,null);
	});


	




////script pre overenie a editaciu usera
	$("#editButton").on("click",function  () {
		

			id=$("#idcko").val();
			alert("fsdfsdfsdfsd"+id);
			ajaxRegEdit(id);

			
		// body...
	});

	$("#loginButton").on("click",function  (event) {
		event.preventDefault();
		$("#check_div").html("");
		ajaxLogin();
	});
	$("#logOffButton").on("click",function  () {
		ajaxLogin();
	});


////funckia na validaciu registracie/editacie usera 
/*
	function checkValidReg()
	{
		valid =true;
		
		errors={};

		//alert($("#loginLastName").val());
		if($("#loginEmail").val().length<3){
		valid=false;errors["email"]="invalid email ";
		$("#loginEmail2").css("border-bottom","2px solid red");}

		if($("#loginFirstName").val().length<3){
		valid=false;errors["first name"]=true;
		$("#loginFirstName2").css("border-bottom","2px solid red");}

		if($("#loginLastName2").val().length<3){
		valid=false;errors["last name"]=true;
		$("#loginLastName").css("border-bottom","2px solid red");}
		if($("#loginPass1").val()){}
		if($("#loginPass2")){}
		if($("#loginBio")){}
			printRegErrors(errors);
		return valid;

	}*/


///funckia vypise vsetky errory pri reg/editacii usera
	function printRegErrors(errors)
		{
	    //alert("fsfdxxx");

		$("#check_div").html("");
			 $.each(errors ,function(key,value)
			 {

			
			 	if(value){$("#check_div").
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

	    //  alert(poradie);
	    jQuery.ajax({
	        type: "POST",
	        url: '_controllers/ajax_handler.php',

	        data: { 'json': sendInfo },


	        success: function (data) {
	            // alert("toto su data" + data);

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

	function ajaxLogin()
	{
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
		 //  alert("toto su data"+data);
		   if(data !==""){

		     $("#check_divPop").html("");
		     location.reload();
				}
		   else {
		       $("#check_divPop").html("");
				   $("#check_divPop").append('<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong></strong> Login dont match</div>');


			}

				

				
		


		  },
	  		error: function(data){
	  			alert("chyba AJAXU");
		  }
	    });
		
	}
/////ajax volanie registacie/ editacie 
	function ajaxRegEdit(id)
	{
		
//alert("Vddolam ajax toto je id : " +id);
		var fnc;
		if(id==0)fnc="RegUser";
		else fnc="EditUser"

		 var sendInfo = {'function':fnc,

	 	 "arg":{
	           "login": $("#loginEmail").val(),
	           "firstName":$("#loginFirstName").val(), 
	       		"lastName":$("#loginLastName").val(),
	       		"pass":$("#loginPass1").val(),
	       		"pass2":$("#loginPass2").val(),
	       		"bio":$("#loginBio").val(),
	       		"date":"2014-04-20",
	       		"admin":0,
	       		"id":id
	       		}

	       };

	    jQuery.ajax({
	        type: "POST",
	        url: '_controllers/ajax_handler.php',
	        
	        data: {'json':sendInfo},
	       
	       

	       success: function(data){
		   if(data=="ok" || data ==""){
		  // 	alert("je to ok");

		   $("#check_div").append("<div id='sub_error' class='btn btn-success'><i ></i><span>Edit successfull</span> </div>");
				}
			else {
				data2 =jQuery.parseJSON(data);
			//	alert("DATATYP:"+typeof data2 +data );
					printRegErrors(data2);
				}
		   // return data;
		  },
	  		error: function(data){
	  			alert("chyba AJAXU");
		    return data;
		  }
	    });


	}
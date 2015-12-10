///script na preklikvania user/search v headeri
   
  $("#userBarIcon" ).on("click",function() {
                
           
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


/////script pre overenie registracnych udajov usera a naslednej registracie
	$("#regButton").on("click",function  () {

alert("fsdfsdf");
		if(checkValidReg())
		{
			ajaxRegEdit(0);	
	 		$("#check_div").append("<div id='sub_error' class='btn btn-success'><i ></i><span>Registration successfull</span> </div>");
		}
	
	
	});



////script pre overenie a editaciu usera
	$("#editButton").on("click",function  () {
		alert("editujem");

		if(checkValidReg())
		{
			ajaxRegEdit($("#idcko").val());	
	 		$("#check_div").append("<div id='sub_error' class='btn btn-success'><i ></i><span>Edit successfull</span> </div>");
		}
		// body...
	});

////funckia na validaciu registracie/editacie usera
	function checkValidReg()
	{
		valid =true;
		
		errors={};

		//alert($("#loginLastName").val());
		if($("#loginEmail").val().length<3){
		valid=false;errors["email"]="invalid email ";
		$("#loginEmail").css("border-bottom","2px solid red");}

		if($("#loginFirstName").val().length<3){
		valid=false;errors["first name"]=true;
		$("#loginFirstName").css("border-bottom","2px solid red");}

		if($("#loginLastName").val().length<3){
		valid=false;errors["last name"]=true;
		$("#loginLastName").css("border-bottom","2px solid red");}
		if($("#loginPass1").val()){}
		if($("#loginPass2")){}
		if($("#loginBio")){}
			printRegErrors(errors);
		return valid;

	}
///funckia vypise vsetky errory pri reg/editacii usera
	function printRegErrors(errors)
	{
		$("#check_div").html("");
			 $.each(errors ,function(key,value)
			 {

			 	if(value){$("#check_div").
			 		append("<div id='sub_error' class='btn btn-danger'><i class='fa fa-minus-circle'></i> <span>chyba: "+value+"</span> </div>");}
			 });
		}
		
		
////ajax volanie registacie/ editacie 
	function ajaxRegEdit(id)
	{
		
alert("volam ajax"+id);
		var fnc;
		if(id==0)fnc="RegUser";
		else fnc="EditUser"

		 var sendInfo = {'function':fnc,

	 	 "arg":{
	           "login": $("#loginEmail").val(),
	           "firstName":$("#loginFirstName").val(), 
	       		"lastName":$("#loginLastName").val(),
	       		"pass":$("#loginPass1").val(),
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
		    alert(data);
		    alert(data);
		  },
	  		error: function(data){
		    alert(data);
		    alert('failure');
		  }
	    });

	}

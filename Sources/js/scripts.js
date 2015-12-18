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

		alert("idem regfdsfsdffsdf");
			ajaxRegEdit(0);

	
	
	});



////script pre overenie a editaciu usera
	$("#editButton").on("click",function  () {
		

			id=$("#idcko").val();
			alert("fsdfsdfsdfsd"+id);
			ajaxRegEdit(id);

			
		// body...
	});

		$("#loginButton").on("click",function  () {

		$("#check_div").html("");
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

		$("#check_div").html("");
			 $.each(errors ,function(key,value)
			 {

			
			 	if(value){$("#check_div").
			 		append('<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> '+value+'</div>');}
			 });
		}
		
		
	function ajaxLogin()
	{
		//alert("fsdfsdXXXX");
		fnc ="Login";
		 var sendInfo = {'function':fnc,

	 	 "arg":{
	           "loginEmail": $("#loginEmail").val(),
	           "loginPass":$("#loginPass").val()
	       		
	       		
	       		
	       		}


	       };
	    //   alert(sendInfo.arg.loginEmail);

	    jQuery.ajax({
	        type: "POST",
	        url: '_controllers/ajax_handler.php',
	        
	        data: {'json':sendInfo},
	       
	       

	       success: function(data){
		   alert("toto su data"+data);
		   if(data !==""){
		   	

		   $("#check_div").html("");
		   
				 location.reload();
				}
			else {
				   $("#check_div").append('<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong></strong> Login dont match</div>');
				

				}
		

		  },
	  		error: function(data){
	  			alert("chyba AJAXU");
		    return data;
		  }
	    });
		
	}
/////ajax volanie registacie/ editacie 
	function ajaxRegEdit(id)
	{
		
alert("Vddolam ajax toto je id : " +id);
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
		//   alert("xxxx"+JSON.parse(data));
		   if(data=="ok" || data ==""){
		  // 	alert("je to ok");

		   $("#check_div").append("<div id='sub_error' class='btn btn-success'><i ></i><span>Edit successfull</span> </div>");
				}
			else {
			//	alert("RAw data"+ data);
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
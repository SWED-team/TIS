<?php

class User_v extends User{


	/**
	 * view pre zobrazenie pop-up okna pre login
	 * @return [string] [html kod okna]
	 */
	public static function showLogPop()
	{
		$res='<div id="LoginPop" class="modal fade  " role="dialog">
		  <div class="modal-dialog modal-sm">


		    <div class="modal-content">
		      <div class="modal-header">
		        <div type="button" class="close" data-dismiss="modal">&times;</div>
		        <h4 class="modal-title">Login/Registration</h4>
		      </div>
		      <form method="post">
		      <div class="modal-body">

		         <input id="PoploginEmail" type="text" class="form-control col-ms-1" name="login" placeholder="zadajte email">
		         <br>
		          <input id="PoploginPass" type="text" class="form-control" name="pass" placeholder="zadajte heslo">
		      </div>
		      <div class="modal-footer">
		         <div id="loginButton" class="btn btn-success" >Login</div>

		        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		      </form>

		      </div>
				<div id="check_divPop"></div>
		    </div>

			  </div>

			</div>';

		return $res;
	}

	/**
	 * zobrazenie bočného panelu na správu používateľského konta
	 * @return [string] [html kod panelu]
	 */
	public static function showNavbar($admin)
	{
		$res='<div id="navigationBarUser" class="col-md-12" >


            <button type="button" class="btn btn-info col-md-12" id="btnEdit">
              <i class="glyphicon glyphicon-edit"></i>&nbsp &nbsp Edit profile
            </button>


            <button type="button" class="btn btn-info col-md-12" id="btnListM" >
              <i class="glyphicon glyphicon-list"></i>&nbsp List pages
            </button>

			 <button type="button" class="btn btn-info col-md-12" id="btnAddPage" >
              <i class="glyphicon glyphicon-list"></i>&nbsp Add page
            </button>

            '
	  ;

		if($admin==1){

			$res=$res.'
          		 <button type="button" class="btn btn-info col-md-12" id="btnListU" >
              <i class="glyphicon glyphicon-list"></i>&nbsp List users
            </button>
             <button type="button" class="btn btn-info col-md-12" id="btnListM" >
              <i class="glyphicon glyphicon-list"></i>&nbsp List approves
            </button></div>


          	';
		}
		else {
			echo $admin;
			$res=$res.'</div>';
		}

		;
		return $res;

	}
	/**
	 * funkcia naplni celú sekciu pre administráciu konta
	 */

	public static function fillInfoSection($userData)
	{


		$res=
		'<div id="infoSectionUser2" >'.
		'</div>';

		return $res;

	}

	public static function showListUsers($list)
	{

		$res=
	'<div id="listP">'.'
					<div id="listPControl" class="col-lg-8">

						<div class="btn btn-default" id="listPOrderFirstName">Order by FIrst name</div>
						<div class="btn btn-default" id="listPOrderRegDate">Order by Reg date</div>
						<div class="btn btn-default" id="listPOrderEmail">Order by email</div>


					</div>
					<div id="ListPList" class="col-lg-12">';

		foreach ($list as $key => $value) {
			$deactive=true;
			$admin=false;
			if($value["deactivated"]==0){$deactive=false;}
			if($value["admin"]==1){$admin=true;}
			$res=$res.'

						<div id="listRow" class="row">
						<div  class="col-lg-4 col-md-6 col-sm-6 "><input disabled class="form-control" type="text" value='.$value["first_name"].'></input></div>
						<div  class="col-lg-3 col-md-6 col-sm-6"><input disabled class="form-control" type="text" value='.$value["email"].'></input></div>
						<div  class="col-lg-2 col-md-4 col-sm-4 col-xs-12"><button onclick="list_user_pages('.$value["id"].');"class="btn btn-success">Go To pages</button></div>
						';
						if($deactive){
							$res=$res.'<div  class="col-lg-2 col-md-4 col-sm-4 col-xs-6"><input onchange="user_deactive(this,'.$value["id"].');" checked type="checkbox"class="btn btn-warning">Deactivated</div>';
						}
						else
						{$res=$res.'<div  class="col-lg-2 col-md-4 col-sm-4 col-xs-6"><input  id="krava" onchange="user_deactive(this,'.$value["id"].');" type="checkbox"class="btn btn-warning">Deactive</div>';}

						if($admin){
							$res=$res.'	<div  class="col-lg-1 col-md-4 col-sm-4 col-xs-6"><input onchange="user_admin(this,'.$value["id"].');" checked type="checkbox"class="btn btn-warning">Admin</div>';
						}
						else
						{$res=$res.'<div  class="col-lg-1 col-md-4 col-sm-4 col-xs-6"><input onchange="user_admin(this,'.$value["id"].');"  type="checkbox"class="btn btn-warning">Admin</div>';}
						$res=$res.'
						</div>
						';
		}
		$res=$res.'

					</div>
			 </div>
	<script>

	function user_deactive(current,id)
		{
				check=0;

				if($(current).is(":checked")){check=1;}
				ajaxUniversal("Deactivate",check, id);
				ajaxUniversal("SwithUserMenu3",3, "first_name");
			}

	function user_admin(current,id)
		{
				check=0;

				if($(current).is(":checked")){check=1;}
				ajaxUniversal("Admin",check, id);
				ajaxUniversal("SwithUserMenu3",3, "first_name");
			}
	function list_user_pages(id)
	{

		 ajaxUniversal("listAdminUserPages",id, "created");
	}

		$("#listPOrderFirstName").on("click", function () {

			 ajaxUniversal("SwithUserMenu3",3, "first_name");
		});
		$("#listPOrderRegDate").on("click", function () {
			 ajaxUniversal("SwithUserMenu3",3, "reg_date");
		});
		$("#listPOrderEmail").on("click", function () {

			 ajaxUniversal("SwithUserMenu3",3, "email");
		});

	</script>';


		return $res;

	}
	/**
	 * view na zorazenie formulára na editovanie údajov používateľa
	 * @param  [array] $userData [údaje]
	 * @return [string] [html kod formuláru]
	 */
	public static function showEditForm($userData)
	{
		$res='
			<div id="editForm">
			<form method="post">

			 <input id="idcko" type="text" class="form-control col-ms-1 hidden" name="login" value='.$userData["id"].'>


      	 <div class="form-group col-md-6">
		  <label for="usr">Email:</label>
		         <input id="loginEmail" type="text" class="form-control col-ms-1" name="login" value='.$userData["email"].'>
		         </div>

         <div class="form-group col-md-6">
		  <label for="usr">First Name:</label>
		         <input id="loginFirstName" type="text" class="form-control col-ms-1" name="firstName" value='.$userData["first_name"].'>
		         </div>

         <div class="form-group col-md-6">
		  <label for="usr">Last Name:</label>
		         <input id="loginLastName" type="text" class="form-control col-ms-1" name="LastName" value='.$userData["last_name"].'>
		         </div>

        <div class="form-group col-md-6">
		  <label for="usr">Password:</label>
		         <input id="loginPass1" type="text" class="form-control col-ms-1" name="pass" value='.$userData["password"].'>
		         </div>

        <div class="form-group col-md-6">
		  <label for="usr">Password again:</label>
		         <input id="loginPass2" type="text" class="form-control col-ms-1" name="pass2" value='.$userData["password"].'>
		         </div>

          <div class="form-group col-md-6">
		  <label for="usr">Bio:</label>
		         <textarea rows="4" cols="50" id="loginBio"  class="form-control col-ms-1" name="bio" value='.$userData["bio"].'>'.$userData["bio"].'</textarea>
		         </div>



      <div class="modal-footer" style="margin-top:50px;">
         <div id="editButton" name="submitRegUser" class="btn btn-success" >Edit</div>

        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </form></div></div></div><div id="check_div">krista</div>
<script>
	$("#editButton").on("click",function  () {


			id=$("#idcko").val();
		//	alert("fsdfsdfsdfsd"+id);
			ajaxRegEdit(id);



	});


</script>
	';
		return $res;
	}

	/**
	 * view na zorazenie formulára na registráciu používateľa
	 *
	 * @return [string] [html kod formuláru]
	 */

	public static function showRegForm()
	{

		$res='
	<section class="container-fluid">
<div class="moduel-container col-sm-9">
<div id="infoSectionUser2"  >

			<div id="editForm" >
			<form method="post">


      	 <div class="form-group col-md-6">
		  <label for="usr">Email:*</label>
		         <input id="loginEmail" type="text" class="form-control col-ms-1" name="login" />
		         </div>

         <div class="form-group col-md-6">
		  <label for="usr">First Name:*</label>
		         <input id="loginFirstName" type="text" class="form-control col-ms-1" name="firstName"/>
		         </div>

         <div class="form-group col-md-6">
		  <label for="usr">Last Name:*</label>
		         <input id="loginLastName" type="text" class="form-control col-ms-1" name="LastName" />
		         </div>

        <div class="form-group col-md-6">
		  <label for="usr">Password:*</label>
		         <input id="loginPass1" type="text" class="form-control col-ms-1" name="pass" />
		         </div>

        <div class="form-group col-md-6">
		  <label for="usr">Password again:*</label>
		         <input  id="loginPass2" type="text" class="form-control col-ms-1" name="pass2" />
		         </div>

          <div class="form-group col-md-6">
		  <label for="usr">Bio:</label>
		         <textarea rows="4" cols="50" id="loginBio"  class="form-control col-ms-1" name="bio" ></textarea>
		         </div>



      <div class="modal-footer" style="margin-top:50px;">
         <div id="regButton" name="submitRegUser" class="btn btn-success" >Register</div>

        <input type="submit" class="btn btn-danger" data-dismiss="modal" value="Close">
      </form></div></div><div id="check_div">krista</div></div><section>';
		return $res;
	}

	/**
	 * view na zobrazenie zoznamu modulov pre daného používateľa
	 * @return [string] [html kod zoznamu]
	 */
	public static function showListPages($list)
	{



		$res=
		'<div id="listP">'.'
					<div id="listPControl" class="col-lg-8">

						<div class="btn btn-default" id="listPOrderEditDate">Order by Edit date</div>
						<div class="btn btn-default" id="listPOrderAddDate">Order by Add date</div>
						<div class="btn btn-default" id="listPOrderTitle">Order by Title</div>


					</div>
					<div id="ListPList" class="col-lg-12">';

		foreach ($list as $key => $value) {

			$res=$res.'

						<div id="listRow" class="row">
						<div  class="col-lg-3 col-md-3 col-sm-6 "><input class="form-control" id="page_title" type="text" value='.$value["title"].' ></input></div>
						<div  class="col-lg-2 col-md-2 col-sm-3"><input class="form-control" type="text" value='.$value["created"].'></input></div>
						<div  class="col-lg-2 col-md-2 col-sm-3"><input class="form-control" type="text" value='.$value["edited"].'></input></div>
						<div  class="col-lg-2 col-md-2 col-sm-4 "><a href="index.php?page_id='.$value["id"].'" class="btn btn-success">Go To page</a></div>
						<div  class="col-lg-2 col-md-2 col-sm-4 "><div onclick="change_page_title('.$value["id"].');" class="btn btn-warning">Change tittle</div></div>
						<div  class="col-lg-1 col-md-1 col-sm-4 "><button class="btn btn-info">Ok</button></div>
						</div>
						';
		}
		$res=$res.'

					</div>
			 </div>
	<script>

	function change_page_title(id)
			{

			title=$("#page_title").val();

			ajaxUniversal("changeTitle", title,id);
			ajaxUniversal("SwithUserMenu2",2, "created");
			}
		$("#listPOrderEditDate").on("click", function () {

			 ajaxUniversal("SwithUserMenu2",2, "edited");
		});
		$("#listPOrderAddDate").on("click", function () {
			 ajaxUniversal("SwithUserMenu2",2, "created");
		});
		$("#listPOrderTitle").on("click", function () {

			 ajaxUniversal("SwithUserMenu2",2, "title");
		});

</script>';
		return $res;
	}

	public static function showAddPage()
	{

		$res='<div id="infoSectionUser2" >


			<form method="post">


      	 <div class="form-group col-md-6">
		  <label for="usr">Email:*</label>
		         <input id="pageTitle" type="text" class="form-control col-ms-1" name="pageTitle" />
			<div class="btn btn-default" id="addPagebtn">AddPage</div>
</div>

	</div>
	<script>

	$("#addPagebtn").on("click", function () {
	   // alert($("#pageTitle").val());

	    ajaxUniversal("AddPage", 0, $("#pageTitle").val());



	});
	</script>


';

		return $res;


	}

	public static function showTraceList()
	{
		$res='';
		foreach ($_SESSION["pages_list"] as $key => $value) {
			$res= $res. "<a href='index.php?page_id=".$_GET["page_id"]."'>".$value."-></a>";


		}
		return $res;
	}
	/**
	 * zobrazenie kompletnej sekcie pre správu používateľského konta aj so skriptami
	 *@return [string] [html a js  kod sekcie]
	 */
	public static function showUserSection($userData)
	{
		$res='<section class="container-fluid">
				<div class="row"><div class="moduel-container col-sm-3">
					'.User_v::showNavbar($userData["admin"]).'

				</div>
				<div class="moduel-container col-sm-9">

					'.User_v::fillInfoSection($userData).'
				</div>
			</div>
			</section>';


		return $res;

	}


}
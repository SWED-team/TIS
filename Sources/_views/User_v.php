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
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Login/Registration</h4>
		      </div>
		      <form method="post">
		      <div class="modal-body">

		         <input id="loginEmail " type="text" class="form-control col-ms-1" name="login" placeholder="zadajte email">
		         <br>
		          <input id="loginPass" type="text" class="form-control" name="pass" placeholder="zadajte heslo">
		      </div>
		      <div class="modal-footer">
		         <input type="submit" name="submitLog" value="Login"class="btn btn-success" ></button>
		          <button type="button" class="btn btn-info" data-dismiss="modal">registration</button>
		        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		      </form>
		      </div>
		    </div>

			  </div>
			</div>';

			return $res;
		}

		/**
		 * zobrazenie bočného panelu na správu používateľského konta
		 * @return [string] [html kod panelu]
		 */
		public static function showNavbar()
		{
			$res='<div id="navigationBarUser" class="col-md-12" >
				  
			
            <button type="button" class="btn btn-info col-md-12" id="btnEdit">
              <i class="glyphicon glyphicon-edit"></i>&nbsp &nbsp Edit profile
            </button>
            

            <button type="button" class="btn btn-info col-md-12" id="btnListM" >
              <i class="glyphicon glyphicon-list"></i>&nbsp List modules
            </button>
            <button type="button" class="btn btn-info col-md-12" id="ListP" >
              <i class="glyphicon glyphicon-align-justify"></i>&nbsp &nbsp List pages
            </button>
            <button type="button" class="btn btn-danger col-md-12" >
              <i class="glyphicon glyphicon-remove"></i>&nbspremove user
            </button>
          </div>';

				return $res;

		}
		/**
		 * funkcia naplni celú sekciu pre administráciu konta
		 */

		public static function fillInfoSection($userData)
		{


			$res=User_v::showEditForm($userData).User_v::showListModules().User_v::addScripts();

			return $res;

		}

		/**
		 * view na zorazenie formulára na editovanie údajov používateľa
		 * @param  [array] $userData [údaje]
		 * @return [string] [html kod formuláru]
		 */
		public static function showEditForm($userData)
		{
			$res='<div id="infoSectionUser2" >
			<div id="editForm" class="hiddeng">
			<form method="post">

			 <input id="Idcko " type="text" class="form-control col-ms-1" name="login" value='.$userData["id"].'>
      

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
      </form></div></div><div id="check_div">blabla</div></div>';
      	return $res;
		}

		/**
		 * view na zorazenie formulára na registráciu používateľa
		 * 
		 * @return [string] [html kod formuláru]
		 */

		public static function showRegForm()
		{

			$res='<div id="infoSectionUser2" >

			<div id="editForm" >
			<form method="post">
      

      	 <div class="form-group col-md-6">
		  <label for="usr">Email:</label>
		         <input id="loginEmail" type="text" class="form-control col-ms-1" name="login" />
		         </div>
         
         <div class="form-group col-md-6">
		  <label for="usr">First Name:</label>
		         <input id="loginFirstName" type="text" class="form-control col-ms-1" name="firstName"/>
		         </div>

         <div class="form-group col-md-6">
		  <label for="usr">Last Name:</label>
		         <input id="loginLastName" type="text" class="form-control col-ms-1" name="LastName" />
		         </div>

        <div class="form-group col-md-6">
		  <label for="usr">Password:</label>
		         <input id="loginPass1" type="text" class="form-control col-ms-1" name="pass" />
		         </div>

        <div class="form-group col-md-6">
		  <label for="usr">Password again:</label>
		         <input id="loginPass2" type="text" class="form-control col-ms-1" name="pass2" />
		         </div>

          <div class="form-group col-md-6">
		  <label for="usr">Bio:</label>
		         <textarea rows="4" cols="50" id="loginBio"  class="form-control col-ms-1" name="bio" ></textarea>
		         </div>
      


      <div class="modal-footer" style="margin-top:50px;">
         <div id="regButton" name="submitRegUser" class="btn btn-success" >Register</div>
          
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </form></div></div></div><div id="check_div">blabla</div>'.User_v::addScripts();
      	return $res;
		}

		/**
		 * view na zobrazenie zoznamu modulov pre daného používateľa
		 * @return [string] [html kod zoznamu]
		 */
		public static function showListModules()
		{

			$res='
			<div id="listM" class="hidden">

			  <div class="modal-body">

			<button type="button" class="btn btn-info crow col-md-12 "  >
              <i class="glyphicon glyphicon-edit"></i>&nbsp &nbsp Edit profile
            </button>
            <button type="button" class="btn btn-info crow col-md-11" >
              <i class="glyphicon glyphicon-list"></i>&nbsp List modules
            </button>
            <button type="button" class="btn btn-info crow col-md-11" >
              <i class="glyphicon glyphicon-align-justify"></i>&nbsp &nbsp List pages
            </button>
            <button type="button" class="btn btn-danger crow col-md-11" >
              <i class="glyphicon glyphicon-remove"></i>&nbspremove user
            </button></div></div>';
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

			'.User_v::showNavbar().'
				
			</div>
			<div class="moduel-container col-sm-9">

          		
					'.User_v::fillInfoSection($userData).'
          		

				</div>


			</div>

			</section>

			'.User_v::addScripts();

			return $res;

		}

		/**
		 * pridanie skriptov pre zobrazovanie jednotlivých podsekcií
		 */
		public static function addScripts(){



			$res='<script type="text/javascript">


				  $("#btnEdit").on("click",function(){
		
				    $("#editForm").removeClass("hidden");
				     $("#listM").addClass("hidden");
				  });
				  
				  $("#btnListM").on("click",function(){
				  
				    $("#listM").removeClass("hidden");
				     $("#editForm").addClass("hidden");
				  });

				</script>';
				return $res;

		}

		







	}




?>

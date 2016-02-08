<?php
/**
 * User_v Trieda View-u pre kontroler User.
 *
 * User_v trieda obsahuje view-y pre zobrazenie:
 * uživatelských rozhraní ako prihlásenie a editácia jeho údajov
 *
 * @version 1.0
 * @author KRASNAN
 * @package ModuleViews
 */
class User_v{


	/**
	 * view pre zobrazenie pop-up okna pre login
	 * @return string html kod okna
	 */
	public static function loginForm()
	{
	?>
		<div id="LoginPop" class="modal fade" role="dialog">
			<div class="modal-dialog ">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<div type="button" class="close" data-dismiss="modal">&times;</div>
		        		<h4 class="modal-title">Login/Registration</h4>
		      		</div>
              	<div class="modal-body">
                	<div class="well">
                  		<ul class="nav nav-tabs"><li class="active"><a href="#login" data-toggle="tab">Login</a></li>
                    		<li><a href="#create" data-toggle="tab">Create Account</a></li>
                  		</ul>
                  		<br>
                  	<div id="myTabContent" class="tab-content">

                    	<div class="tab-pane active in" id="login">
                      		<form method="POST">
                      			<div class="form-group ">
                        			<fieldset>
                          				<div class="form-group ">
		                            		<!-- Username -->
				                            <label class="control-label"  for="PoploginEmail">Username</label>
				                            <input id="PoploginEmail" type="email" class="form-control input-sm" name="login" placeholder="Enter email">
			                          	</div>
    	                      			<div class="form-group">
				                            <br>
				                            <!-- Password-->
			    	                        <label class="control-label" for="pass">Password</label>
		            	                  	<input id="PoploginPass" type="password" class="form-control" name="pass" placeholder="Enter password">
                        	  			</div>
	                        	  	   		<!-- Button -->
			                    	    <div class="modal-footer">
					       					<button type="submit" id="loginButton" class="btn btn-success" >Login</button>
	                          			</div>
                        			</fieldset>
                        		</div>
                      		</form>
                      		<div id="check_div"></div>
                    	</div>
                    <div class="tab-pane fade " id="create">
			    		<form role="form">
			    			<fieldset class="form-group">
			    				<div class="row">
			    					<div class="col-sm-6">
			    						<div class="form-group">
			    							<label class="control-label"  for="loginFirstName">First Name</label>
			                	<input id="loginFirstName" type="text" class="form-control input-sm" name="firstName" placeholder="Enter first name"/>
			    						</div>
					    			</div>
					    			<div class="col-sm-6">
					    				<div class="form-group">
					    					<label class="control-label"  for="loginLastName">Last Name</label>
					    					<input id="loginLastName" type="text" class="form-control input-sm" name="LastName" placeholder="Enter surname "/>
					    				</div>
					    			</div>
			    				</div>
			    				<div class="row">
			    					<div class="col-sm-12">
			    						<div class="form-group">
			    							<label class="control-label"  for="loginEmail">	Login Email</label>
				    						<input id="loginEmail" type="email" class="form-control input-sm" name="login" placeholder="xxx@xxx.xx"/>
				    					</div>
				    				</div>
				    			</div>
			    				<div class="row">
			    					<div class="col-sm-6">
			    						<div class="form-group">
			    							<label class="control-label"  for="loginPass1">Password</label>
				    						<input id="loginPass1" type="password" class="form-control input-sm" name="pass"  placeholder="Password"/>
				    					</div>
				    				</div>
				    				<div class="col-sm-6">
			    						<div class="form-group">
			    						<label class="control-label"  for="loginPass2">Confirm Password</label>
			    							<input id="loginPass2" type="password" class="form-control input-sm" placeholder="Confirm Password" name="pass2"  />
			    						</div>
			    					</div>
			    				</div>
									<div class="row">
			    					<div class="col-sm-12">
					    				<div class="form-group">
					    					<label class="control-label"  for="loginBio">About me</label>
					    					<textarea rows="4" cols="50" id="loginBio"  class="form-control input-sm" name="bio"  style="resize: none" placeholder="Enter short bio"></textarea>
					    				</div>
					    			</div>
					    		</div>
			    				<div class="modal-footer" >
		         						<div id="regButton" name="submitRegUser" class="btn btn-success" >Register</div>
			    			</fieldset>

			    		</form>

			    		<div id="check_div2"></div>
                	</div>
              </div>
            </div>
			</div>
		</div>
	</div>
</div>

		<?php
	}


	public static function adminAdministrationTabs($active, $user_id){ ?>
		<ul class="nav nav-tabs nav-justified">
		  <li <?php if($active=="profile")echo "class='active'"?> role="presentation"><a href="?profile&amp;user=<?php echo $user_id?>">Profile</a></li>
		  <li <?php if($active=="pages")echo "class='active'"?> role="presentation"><a href="?pages&amp;user=<?php echo $user_id?>">Pages</a></li>
		  <li <?php if($active=="pages_administration")echo "class='active'"?> role="presentation"><a href="?pages_administration">Pages Administration</a></li>
		  <li <?php if($active=="users_administration")echo "class='active'"?> role="presentation"><a href="?users_administration">Users</a></li>
		  <li <?php if($active=="category_administration")echo "class='active'"?> role="presentation"><a href="?category_administration">Categories</a></li>
		</ul>
	<?php }

	public static function userAdministrationTabs($active, $user_id){ ?>
		<ul class="nav nav-tabs">
		  <li <?php if($active=="profile")echo "class='active'"?> role="presentation"><a href="?profile&amp;user=<?php echo $user_id?>">Profile</a></li>
		  <li <?php if($active=="pages")echo "class='active'"?> role="presentation"><a href="?pages&amp;user=<?php echo $user_id?>">Pages</a></li>
		</ul>
		<?php 
	}
	public static function profile( $user, $editable=false, $pages_count=0){ ?>
		<div class="user-profile row adminContent">
			<div class="text-center">
				<i class="fa fa-users"></i><h2><?php echo $user['first_name']." ".$user["last_name"];?></h2>
				<i class="fa fa-at"></i><h5><?php echo $user['email'];?></h5>
				<i class="fa fa-calendar-o"></i><h6 class="text-muted"><?php echo $user['reg_date'];?></h6>
				<i class="fa fa-comments"></i><p><?php echo $user['bio'];?></p>
			</div>
			<?php if($editable){ ?>
			<div class="col-sm-offset-3 col-sm-3 col-xs-12">
				<a href="?profile&amp;edit_profile" class="col-xs-12 btn btn-default" >Edit Informations</a>
			</div>
			<div class="col-sm-3 col-xs-12">
				<a href="?profile&amp;edit_password" class="col-xs-12 btn btn-default" >Change Password</a>
			</div> 
			<?php } ?>
		</div>
	<?php
	}

	/**
	 * view na zorazenie formulára na editovanie údajov používateľa
	 * @param  array $userData pole údajov o používateľovi
	 * @return string html kod formuláru
	 */
	public static function showEditForm($userData=array())
	{
		?>
		<div class="adminContent">
			<h2>Profile editation <?php echo $userData["first_name"] .' '. $userData["last_name"]?>  </h2>
			<p>
				Insert valid informations about you.
			</p>
				<form role="form">
				  <fieldset class="form-group">
				    <div class="row">
				    	<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label"  for="editFirstName">First Name</label>
									<input id="editFirstName" value=<?php echo '"'.$userData["first_name"].'"'?> type="text" class="form-control input-sm" name="firstName"  placeholder="Enter first name"/>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label"  for="editLastName">Last Name</label>
									<input id="editLastName" value=<?php echo '"'.$userData["last_name"].'"'?> type="text" class="form-control input-sm" name="LastName" placeholder="Enter surname "/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label"  for="editBio">About me</label>
									<textarea id="editBio" rows="4" cols="50" class="form-control input-sm" name="editBio"  style="resize: none" placeholder="Enter short bio"><?php echo $userData['bio']; ?></textarea>
								</div>
							</div>
						</div>
						</fieldset>
					<div id="editProfileResult"></div>
					<a href="?profile&amp;user=<?php echo $userData['id']; ?>" class="btn btn-primary" >Back</a>
					<a id="editProfileButtonSubmit" class="btn btn-success" >Save</a>
				</form>	
			</div>
	<?php
	}

	public static function editPasswordForm($userData){ ?>
		<div class="adminContent">
			<h2>Password editation <?php echo $userData["first_name"] .' '. $userData["last_name"]?>  </h2>
				<form role="form">
				  <fieldset class="form-group">
				    <div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label"  for="editPassword">Type your new password</label>
									<input id="editPassword" type="password" class="form-control input-sm" name="password"  placeholder="Enter new password..." required/>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label"  for="editPassword2">Retype your new password</label>
									<input id="editPassword2" type="password" class="form-control input-sm" name="password2"  placeholder="Enter new password again..." required/>
								</div>
							</div>
						</div>
						</fieldset>
					<div id="editPasswordResult"></div>
					<a href="?profile&amp;user=<?php echo $userData['id']; ?>" class="btn btn-primary" >Back</a>
					<a id="editPasswordButtonSubmit" class="btn btn-success" >Save</a>
				</form>	
			</div>
	<?php

	}



	/**
	 * zobrazenie bočného panelu na správu používateľského konta
	 * @return [string] [html kod panelu]
	 */

	public static function showListUsers($list){ ?>
		<div id="listP" class="">
			<div id="data-list" class="col-lg-12 adminContent data-list">
			<?php
			  $cnt=0;
			foreach ($list as $key => $value) {
				$cnt++;
				$deactive=true;
				$admin=false;
				if($value["deactivated"]==0){$deactive=false;}
				if($value["admin"]==1){$admin=true;}
				?>
				<div class="row bordered "><?php
         	echo "<div class='col-sm-4  page-list-info'><small class='text-muted'>#".$cnt ." </small> ". $value["first_name"]." ".$value["last_name"] ." (". $value["email"] .") </div>";					
					if($deactive) 
						echo '<div class="col-sm-2 col-sm-3 text-center"><input checked onchange="user_deactive(this,'.$value["id"].');" data-on="Deactive" data-off="Active"  data-toggle="toggle" data-onstyle="danger" data-offstyle="success" data-size="mini" type="checkbox"></div>';
					else 
						echo '<div class="col-sm-2 col-sm-3 text-center"><input  onchange="user_deactive(this,'.$value["id"].');" data-on="Deactive" data-off="Active"  data-toggle="toggle" data-onstyle="danger" data-offstyle="success" data-size="mini"  type="checkbox"></div>';
					if($admin) 
						echo '<div class="col-sm-2 col-sm-3 text-center"><input checked onchange="user_admin(this,'.$value["id"].');" data-on="Admin" data-off="User"  data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-size="mini" type="checkbox"></div>';
					else 
						echo '<div class="col-sm-2 col-sm-3 text-center"><input  onchange="user_admin(this,'.$value["id"].');" data-on="Admin" data-off="User"  data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-size="mini" type="checkbox"></div>';
					
					echo '<div  class="col-sm-2 col-sm-3 "><a href="?pages&amp;user='.$value["id"].'" class="btn  col-xs-12 btn-xs btn-default"><i class="fa fa-th-list"></i> Pages</a></div>';
					echo '<div  class="col-sm-2 col-sm-3 "><a href="?profile&amp;user='.$value["id"].'" class="btn col-xs-12  btn-xs btn-default"><i class="fa fa-user"></i> Profile</a></div>';
				?>
				</div>
				<?php
			} ?>
			</div>
		</div>
	<script>
	function user_deactive(current,id){
				check=0;

				if($(current).is(":checked")){check=1;}
				ajaxUniversal("Deactivate",check, id);
				ajaxUniversal("SwithUserMenu3",3, "first_name");
		}

		function user_admin(current,id){
				check=0;

				if($(current).is(":checked")){check=1;}
				ajaxUniversal("Admin",check, id);
				ajaxUniversal("SwithUserMenu3",3, "first_name");
		}

		function list_user_pages(id){
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

	</script>
	<?php
	}


	/**
	 * view na zorazenie formulára na registráciu používateľa
	 *
	 * @return [string] [html kod formuláru]
	 */

	/*public static function showRegForm()
	{
		?>

		<section class="container-fluid">
			<div class="moduel-container col-sm-9">
				<div id="infoSectionUser2">
					<div id="editForm" >
						<form method="post">
      	 					<div class="form-group col-md-6">
		  						<label for="usr">Email:*</label>
		        				<input id="loginEmail" type="text" class="form-control col-ms-1" name="login"/>
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
		         				<input id="loginPass2" type="text" class="form-control col-ms-1" name="pass2" />
		         			</div>
          					<div class="form-group col-md-6">
		  						<label for="usr">Bio:</label>
		         				<textarea rows="4" cols="50" id="loginBio"  class="form-control col-ms-1" name="bio" ></textarea>
		         			</div>
      						<div class="modal-footer" style="margin-top:50px;">
         						<div id="regButton" name="submitRegUser" class="btn btn-success" >Register</div>
        						<input type="submit" class="btn btn-danger" data-dismiss="modal" value="Close">
      					</form>
      				</div>
      			</div>
      			<div id="check_div"></div>
      		</div>
      	</section>
		<?php
	}

	/**
	 * view na zobrazenie zoznamu modulov pre daného používateľa
	 * @return [string] [html kod zoznamu]
	 */
/*	public static function showListPages($list)
	{
		?>
		<div id="listP">
			<div id="listPControl" class="col-lg-8">
				<div class="btn btn-default" id="listPOrderEditDate">Order by Edit date</div>
				<div class="btn btn-default" id="listPOrderAddDate">Order by Add date</div>
				<div class="btn btn-default" id="listPOrderTitle">Order by Title</div>
			</div>
			<div id="ListPList" class="col-lg-12">
		<?php
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
		?>
		<div id="infoSectionUser2">
      	 		<div class="form-group col-md-6">
		  			<label for="pageTitle">Page title:</label>
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
		<?php
	}
	/**
	 * zobrazenie kompletnej sekcie pre správu používateľského konta aj so skriptami
	 *@return [string] [html a js  kod sekcie]
	 */
	/*public static function showUserSection($userData,$profileID)
	{
		?>
		

		<div class=" col-xs-12 ">
			<div class="row">
			<?php
		if($userData["id"]==$profileID)
		{
		?>

		
				<div class="moduel-container col-sm-3">
					<div id="navigationBarUser" class="col-md-12" >
			            <button type="button" class="btn btn-info col-md-12" id="btnEdit"><i class="glyphicon glyphicon-edit"></i>&nbsp &nbsp Edit profile</button>
			            <button type="button" class="btn btn-info col-md-12" id="btnListM" ><i class="glyphicon glyphicon-list"></i>&nbsp List pages</button>
						<button type="button" class="btn btn-info col-md-12" id="btnAddPage" ><i class="glyphicon glyphicon-list"></i>&nbsp Add page</button>

        				<?php if($userData["admin"]==1){ ?>

			         	<button type="button" class="btn btn-info col-md-12" id="btnListU" ><i class="glyphicon glyphicon-list"></i>&nbsp List users</button>
			         	<button type="button" class="btn btn-info col-md-12" id="btnListM" ><i class="glyphicon glyphicon-list"></i>&nbsp List approves</button>
			        	
			       

			   
			     	<?php }
			        
			        ?>
			             </div>
						    </div>
						    
							<div class="col-sm-9">
								<div id="infoSectionUser2"> <?php User_v::showEditForm($userData,false);
								 ?> </div>
									 		</div>  <?php
		}  
		else 
		{
					 		?>
							 	<div class="col-lg-14">
							 		<div class="row">
									<div id="infoSectionUser2" style="min-height:200px;"><?php
									 	User_v::showEditForm($userData,true);
									 	?> 
									 		</div>
									 		</div>
									 		<div class="row">
									 		

									 		<?php 

									 		$pole=User_m::getPagesFromDb($userData["id"],"created");
									 		foreach ($pole as $key => $value) {
									 				$pom = new Page($value["id"]);
									 				$pom->preview(false,1);

									 			

									  } ?>
							</div>
							<?php 
			} 
			?>
			</div>
							</div>

			<?php
			

		}
		
*/
}


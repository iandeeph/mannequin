<?php
	$postMessages = isset($postMessages)?$postMessages:'';
	$colorMessages = isset($colorMessages)?$colorMessages:'';
	if(isset($_POST['addUserButton'])){
		$postUsername 	= $_POST['addUserUsername'];
		$postPassword 	= $_POST['addUserPassword'];
		$postFirstName 	= $_POST['addUserFirstName'];
		$postLastName 	= $_POST['addUserLastName'];
		$postEmail 		= $_POST['addUserEmail'];
		$postPrivilege 	= $_POST['addUserPermission'];

		$addNewUserQry = "INSERT INTO tb_user (username, password, firstName, lastName, email, privilege) 
						VALUES ('".$postUsername."', '".md5($postPassword).md5(md5($postPassword))."', '".$postFirstName."', '".$postLastName."', '".$postEmail."', '".$postPrivilege."')";
		$permission = ($postPrivilege == '1')?"Administrator":"Operator";

		if(mysqli_query($conn, $addNewUserQry)){
			$LastIdUser = mysqli_insert_id($conn);
			logging($now, $user, "Add New User", "Username : ".$postUsername."<br>Name : ".$postFirstName." ".$postLastName."<br>Permission : ".$permission, $LastIdUser);
	        // header('Location: ./index.php?menu=user');
	    }else{
	    	$postMessages = "ERROR: Could not able to execute ".$addNewUserQry.". " . mysqli_error($conn);
        	$colorMessages = "red-text";
	    }
	}
	// ============================== BUTTON DELETE CLICK ==========================================================
	if(isset($_POST['btnDeleteUser'])){
		foreach ($_POST['checkboxUser'] as $selectedIdUser) {
			$delUserQry = "DELETE FROM tb_user WHERE idUser = '".$selectedIdUser."'";

			// =============================================== LOGING
			$nameDelUserQry = "";
            $nameDelUserQry = "SELECT idUser, username, firstName, lastName, privilege FROM tb_user WHERE idUser = '".$selectedIdUser."'";
            if($resultDelUserQry = mysqli_query($conn, $nameDelUserQry)){
                if (mysqli_num_rows($resultDelUserQry) > 0) {
                    while($rowDelUsers = mysqli_fetch_array($resultDelUserQry)){
                        $idDelUsers    		= $rowDelUsers['idUser'];
                        $usernameDelUsers  	= $rowDelUsers['username'];
                        $firstNameDelUsers  = $rowDelUsers['firstName'];
                        $lastNameDelUsers  	= $rowDelUsers['lastName'];
                        $privilegeDelUsers  = $rowDelUsers['privilege'];

                        $permission = ($privilegeDelUsers == '1')?"Administrator":"Operator";
                    }
                }
            }
			// =============================================== LOGING
			if (mysqli_query($conn, $delUserQry)) {
				logging($now, $user, "Delete User", "Username : ".$usernameDelUsers."<br>Name : ".$firstNameDelUsers." ".$lastNameDelUsers."<br>Permission : ".$permission, $idDelUsers);
			    $postMessages =  "Record deleted successfully";
				$colorMessages = "green-text";
			} else {
			    $postMessages = "Error deleting record: " . mysqli_error($conn);
	        	$colorMessages = "red-text";
			}
		}
	}
?>
<div class="row">
	<div class="col s12 border-bottom grey lighten-2 mb-50">
		<h3 class="left-align">Manage User</h3>
	</div>
	<div class="col s12">
		<span class="<?php echo $colorMessages;?>"><?php echo $postMessages;?></span>
	</div>
	<div class="col s12">
		<form action="#" method="post" enctype="multipart/form-data">
			<div class="col s12 mb-30">
				<a id="delSelectionUserButton" href="#modalDelUserItems" class="waves-effect waves-light btn red accent-4 disabled" disabled><i class="material-icons left">delete</i>Delete</a>
				<a href="#modalAddUserItems" class="modal-trigger btn-floating btn-large waves-effect waves-light green darken-4 right"><i class="material-icons">add</i></a>
			</div>
			<table class="stripped responsive-table col s12">
				<thead>
					<tr>
						<th data-field="id">
							<p>
								<input type="checkbox" id="checkAll" />
								<label for="checkAll"></label>
							</p>
						</th>
						<th data-field="username">
							Username
						</th>
						<th data-field="password">
							Password
						</th>
						<th data-field="firstname">
							First Name
						</th>
						<th data-field="lastname">
							Last Name
						</th>
						<th data-field="email">
							Email
						</th>
						<th data-field="permission">
							Permission
						</th>
						<th data-field="action">
							Action
						</th>
					</tr>
				</thead>
				<tbody>
					<?php
						if($resultUserQry = mysqli_query($conn, "SELECT * FROM tb_user")){
							if (mysqli_num_rows($resultUserQry) > 0) {
								while ($rowUser = mysqli_fetch_array($resultUserQry)) {
									$idUser         = $rowUser['idUser'];
									$username       = $rowUser['username'];
									$passwordUser 	= $rowUser['password'];
									$firstNameUser  = $rowUser['firstName'];
									$lastNameUser   = $rowUser['lastName'];
									$email 			= $rowUser['email'];
									$privilege 		= $rowUser['privilege'];
									?>
									<tr>
										<td>
											<p>
												<input name="checkboxUser[]" type="checkbox" id="<?php echo $idUser; ?>" value="<?php echo $idUser; ?>" />
												<label for="<?php echo $idUser; ?>"></label>
											</p>
										</td>
										<td><?php echo $username; ?></td>
										<td><?php echo $passwordUser; ?></td>
										<td><?php echo $firstNameUser; ?></td>
										<td><?php echo $lastNameUser; ?></td>
										<td><?php echo $email; ?></td>
										<td><?php echo ($privilege == 1) ? "Administrator":"Operator"; ?></td>
										<td><a href="<?php echo "#modalEditUser".$idUser; ?>" class="btn-floating btn-large modal-trigger waves-effect waves-light btn blue darken-4"><i class="material-icons left">edit</i></a></td>
										<div id="<?php echo "modalEditUser".$idUser; ?>" class="modal">
											<div class="modal-content">
												<div class="border-bottom mb-10"><h4>Edit User</h4></div>
												<div class="col s12 mt-30 center container">
													<div class="file-field input-field col s12 m6 l6">
														<input value="<?php echo $username; ?>" id="<?php echo "UserUsername".$idUser; ?>" name="<?php echo "UserUsername".$idUser; ?>" type="text" class="validate" required>
														<label for="<?php echo "UserUsername".$idUser; ?>">Username</label>
													</div>
													<div class="file-field input-field col s12 m6 l6">
														<input value="<?php echo $passwordUser; ?>" id="<?php echo "UserPassword".$idUser; ?>" name="<?php echo "UserPassword".$idUser; ?>" type="text" class="validate" required>
														<label for="<?php echo "UserPassword".$idUser; ?>">Password</label>
													</div>
													<div class="file-field input-field col s12 m6 l6">
														<input value="<?php echo $firstNameUser; ?>" id="<?php echo "UserFirstName".$idUser; ?>" name="<?php echo "UserFirstName".$idUser; ?>" type="text" class="validate" required>
														<label for="<?php echo "UserFirstName".$idUser; ?>">First Name</label>
													</div>
													<div class="file-field input-field col s12 m6 l6">
														<input value="<?php echo $lastNameUser; ?>" id="<?php echo "UserLastName".$idUser; ?>" name="<?php echo "UserLastName".$idUser; ?>" type="text" class="validate" required>
														<label for="<?php echo "UserLastName".$idUser; ?>">Last Name</label>
													</div>
													<div class="file-field input-field col s12 m6 l6">
														<input value="<?php echo $email; ?>" id="<?php echo "UserEmail".$idUser; ?>" name="<?php echo "UserEmail".$idUser; ?>" type="email" class="validate" required>
														<label for="<?php echo "UserEmail".$idUser; ?>">Email</label>
													</div>
													<div class="input-field col s12 m6 l6">
														<select id="<?php echo "UserPermission".$idUser; ?>" name="<?php echo "UserPermission".$idUser; ?>">
															<option value="" disabled>Choose your option</option>
															<option <?php echo ($privilege == 1) ? "selected":""; ?> value="1">Administrator</option>
															<option <?php echo ($privilege == 2) ? "selected":""; ?> value="2">Operator</option>
														</select>
														<label>Permission</label>
													</div>
													<div class="input-field col s12 mb-50">
														<input value="<?php echo $idUser; ?>" name="<?php echo "hiddeniduser".$idUser; ?>" type="hidden">
														<button type="submit" name="<?php echo "updateUserButton".$idUser; ?>" class="waves-effect waves-light btn green darken-4 right">Update</button>
													</div>
												</div>
											</div>
										</div>
									</tr>
									<?php
									// ============================== BUTTON UPDATE CLICK ==========================================================
									$btnUpdateIdUser	= "updateUserButton".$idUser;
									$hiddeniduser 		= "hiddeniduser".$idUser;
									$UserUsername 		= "UserUsername".$idUser;
									$UserPassword 		= "UserPassword".$idUser;
									$UserFirstName 		= "UserFirstName".$idUser;
									$UserLastName 		= "UserLastName".$idUser;
									$UserEmail 			= "UserEmail".$idUser;
									$UserPermission 	= "UserPermission".$idUser;
									if(isset($_POST[$btnUpdateIdUser])){
										$postUpdateIdUser 		= $_POST[$hiddeniduser];
										$postUpdateUsername 	= $_POST[$UserUsername];
										$postUpdatePassword 	= $_POST[$UserPassword];
										$postUpdateFirstName 	= $_POST[$UserFirstName];
										$postUpdateLastName 	= $_POST[$UserLastName];
										$postUpdateEmail 		= $_POST[$UserEmail];
										$postUpdatePrivilege 	= $_POST[$UserPermission];

										$updateUserQry = "UPDATE user SET username = '".$postUpdateUsername."', password = '".md5($postUpdatePassword).md5(md5($postUpdatePassword))."', firstName = '".$postUpdateFirstName."', lastName = '".$postUpdateLastName."', email = '".$postUpdateEmail."', privilege = '".$postUpdatePrivilege."' 
														WHERE idUser = '".$postUpdateIdUser."'";
										// ================================== LOGGING
											$updateLogUserQry = "";
											$updateLogUserQry = "SELECT username, firstName, lastName FROM tb_user WHERE idUser = '".$postUpdateIdUser."' LIMIT 1";
											if($resultUpdateUserQry = mysqli_query($conn, $updateLogUserQry)){
												if (mysqli_num_rows($resultUpdateUserQry) > 0) {
													$rowUpdateUser = mysqli_fetch_array($resultUpdateUserQry);
													$usernameUpdateUser		= $rowUpdateUser['username'];
													$firstNameUpdateUser    = $rowUpdateUser['firstName'];
													$lastNameUpdateUser     = $rowUpdateUser['lastName'];
												}
											}
											$logingContentText = "Old Username : ".$usernameUpdateUser."<br>Old First Name : ".$firstNameUpdateUser."<br>Old Last Name : ".$lastNameUpdateUser."<br>New Username : ".$postUpdateUsername."<br>New First Name : ".$postUpdateFirstName."<br>New Last Name : ".$postUpdateLastName;
										// ================================== LOGGING
										if(mysqli_query($conn, $updateUserQry)){
											logging($now, $user, "Update User", $logingContentText, $postUpdateIdUser);
									        header('Location: ./index.php?menu=user');
									    }else{
									    	$postMessages = "ERROR: Could not able to execute ".$updateUserQry.". " . mysqli_error($conn);
								        	$colorMessages = "red-text";
									    }
									}
								}
							}
						}
					?>
				</tbody>
			</table>
			<div id="modalDelUserItems" class="modal">
				<div class="modal-content">
					<h4>Deleting Confirmation</h4>
					<h5>Are you sure want to delete selected item(s) ?</h5>
				</div>
				<div class="modal-footer col s12 mb-30">
					<button type="submit" name="btnDeleteUser" class="waves-effect waves-light btn green darken-4 right">Yes</button>
					<a href="#!" class="modal-action modal-close waves-effect waves-light btn blue darken-4 right">Cancel</a>
				</div>
			</div>
		</form>
		<div id="modalAddUserItems" class="modal">
			<div class="modal-content">
				<div class="border-bottom mb-10"><h4>Add New User</h4></div>
				<div class="col s12 mt-30 center container">
					<form action="#" method="post" enctype="multipart/form-data">
						<div class="file-field input-field col s12">
							<input id="addUserUsername" name="addUserUsername" type="text" class="validate" required>
							<label for="addUserUsername">Username</label>
						</div>
						<div class="file-field input-field col s12 m6 l6">
							<input id="addUserPassword" name="addUserPassword" type="password" class="validate" required>
							<label for="addUserPassword">Password</label>
						</div>
						<div class="file-field input-field col s12 m6 l6">
							<input id="addUserReenterPassword" name="addUserReenterPassword" type="password" class="validate" required>
							<label for="addUserReenterPassword">Reenter Password</label>
						</div>
						<span class="col s12 left-align" id="txtConfirmPassword"></span>
						<div class="file-field input-field col s12 m6 l6">
							<input id="addUserFirstName" name="addUserFirstName" type="text" class="validate" required>
							<label for="addUserFirstName">First Name</label>
						</div>
						<div class="file-field input-field col s12 m6 l6">
							<input id="addUserLastName" name="addUserLastName" type="text" class="validate" required>
							<label for="addUserLastName">Last Name</label>
						</div>
						<div class="file-field input-field col s12 m6 l6">
							<input id="addUserEmail" name="addUserEmail" type="email" class="validate" required>
							<label for="addUserEmail">Email</label>
						</div>
						<div class="input-field col s12 m6 l6">
							<select id="addUserPermission" name="addUserPermission">
								<option value="" disabled selected>Choose your option</option>
								<option value="1">Administrator</option>
								<option value="2">Operator</option>
							</select>
							<label>Permission</label>
						</div>
						<div class="input-field col s12 mb-50">
							<button type="submit" name="addUserButton" class="waves-effect waves-light btn green darken-4 right">Add</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
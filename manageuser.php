<?php
if(isset($_SESSION['logged'])){
	$linkHere = "./index.php?menu=user&user=".$_SESSION['priv']."";
?>
<div class="row" style="border-bottom: 1px solid #bcbcbc; margin-top:15px;">
	<div class="container">
		<div class="col s12">
			<h4 class="center">
				User Management
			</h4>
		</div>
	</div>
</div>
<div class="col s12">
	<div class="row">
		<div class="container">
			<div class="col s12">
		      	<a class="btn-floating btn-large waves-effect waves-light blue blue lighten-2 right" onclick="javasrcipt:window.location.href='<?php echo $linkHere?>'"><i class="material-icons">replay</i></a>
		      	<a type="submit" href="#newUser" data-target="newUser" name="addNewUser" class="modal-trigger tooltipped btn-floating btn-large waves-effect waves-light red" data-position="left" data-delay="50" data-tooltip="Add New User..."><i class="material-icons">add</i></a>
		    </div>
		    <!-- MODAL ADD NEW USER START -->			
			<div id="newUser" class="modal modal-fixed-footer">
				<div class="modal-content">
					<div class="row">
						<div class="col s12 center">
							<h5>Manage User</h5>
						</div>
						<form action="" method="POST" name="formAddNewUser">
							<div class="input-field col s12 m6 l6">
								<input id="firstNameUser" type="text" class="validate" name="firstNameUser" required>
								<label for="firstNameUser">First Name</label>
							</div>
							<div class="input-field col s12 m6 l6">
								<input id="lastNameUser" type="text" class="validate" name="lastNameUser">
								<label for="lastNameUser">Last Name</label>
							</div>
							<div class="input-field col s12 m6 l6">
								<input id="usernameUser" type="text" class="validate" name="usernameUser" required>
								<label for="usernameUser">Username</label>
							</div>
							<div class="input-field col s12 m6 l6">
								<input id="passwordUser" type="text" class="validate" name="passwordUser">
								<label for="passwordUser">Password</label>
							</div>
							<div class="input-field col s12">
								<input id="emailUser" type="email" class="validate" name="emailUser">
								<label for="emailUser" data-error="Wrong email format" data-success="">Email</label required>
							</div>
							<div class="input-field col s12" style="margin-top:25px">
								<select id="addUserPriv" name="privilege">
									<option value="1" selected>Administrator</option>
									<option value="2">Operator</option>
								</select>
								<label>Privilege</label>
							</div>
							<div class="col s12">
								<?php
								$postfirstNameUser = $_POST['firstNameUser'];
								$postlastNameUser = $_POST['lastNameUser'];
								$postusernameUser = $_POST['usernameUser'];
								$postpasswordUser = $_POST['passwordUser'];
								$postemailUser = $_POST['emailUser'];
								$postprivilege = $_POST['privilege'];
								if(isset($_POST['addUser'])){
									$qryAddUser = mysql_query("SELECT * FROM tb_user WHERE username = '".$postusernameUser."'");
									if(mysql_num_rows($qryAddUser) == 0){
										if(mysql_query("INSERT INTO tb_user (firstName, lastName, username, password, email, priviledge) VALUES ('".$postfirstNameUser."', '".$postlastNameUser."', '".$postusernameUser."', '".$postpasswordUser."', '".$postemailUser."', '".$postprivilege."')")){
											//header("Location: ./index.php?menu=user&user=".$_SESSION['priv']."&tai=".$postprivilege."");
										}else{
											echo "Error: ".mysql_error($conn);
										}
									}else{
										$usernameUserExistNotif = "username exist in database, use another one :)";
									}
								}
								?>
								<button class="modal-action modal-close waves-effect waves-green btn-flat amber" type="submit" name="addUser">Submit</button>
								<a class="modal-action modal-close waves-effect waves-green btn-flat cyan" onclick="javasrcipt:window.location.href='<?php echo $linkHere?>'">Cancel</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		    <!-- MODAL ADD NEW USER ENDS -->
    <?php
		$modalNum = 1;
		$qryUserForModal = mysql_query("SELECT * FROM tb_user");
		while($getUserForModal = mysql_fetch_array($qryUserForModal)){
	?>
		    <!-- MODAL UPDATE USER START -->
			<div id="<?php echo 'manageUser'.$modalNum;?>" class="modal modal-fixed-footer">
				<div class="modal-content">
					<div class="row">
						<div class="col s12 center">
							<h5>Manage User</h5>
						</div>
						<form action="" method="POST" name="<?php echo "updateForm".$modalNum; ?>">	
						<?php
							$firstNameUpdate = "firstNameUpdate".$modalNum;
							$lastNameUpdate = "lastNameUpdate".$modalNum;
							$usernameUpdate = "usernameUpdate".$modalNum;
							$passwordUpdate = "passwordUpdate".$modalNum;
							$emailUpdate = "emailUpdate".$modalNum;
							$privilegeUpdate = "privilegeUpdate".$modalNum;
							$hiddenId = "hiddenId".$modalNum;
							$updateUser = "updateUser".$modalNum;
							$deleteUser = "deleteUser".$modalNum;
						?>
						<div class="input-field col s12 m6 l6">
							<input value="<?php echo $getUserForModal['firstName'];?>" type="text" class="validate" name="<?php echo $firstNameUpdate; ?>" required>
							<label for="<?php echo $firstNameUpdate; ?>">First Name</label>
						</div>
						<div class="input-field col s12 m6 l6">
							<input value="<?php echo $getUserForModal['lastName'];?>" type="text" class="validate" name="<?php echo $lastNameUpdate; ?>">
							<label for="<?php echo $lastNameUpdate; ?>">Last Name</label>
						</div>
						<div class="input-field col s12 m6 l6">
							<input value="<?php echo $getUserForModal['username'];?>" type="text" class="validate" name="<?php echo $usernameUpdate; ?>" required>
							<label for="<?php echo $usernameUpdate; ?>">Username</label>
						</div>
						<div class="input-field col s12 m6 l6">
							<input value="<?php echo $getUserForModal['password'];?>" type="text" class="validate" name="<?php echo $passwordUpdate; ?>" required>
							<label for="<?php echo $passwordUpdate; ?>">Password</label>
						</div>
						<div class="input-field col s12">
							<input value="<?php echo $getUserForModal['email'];?>" type="email" class="validate" name="<?php echo $emailUpdate; ?>">
							<label for="<?php echo $emailUpdate; ?>" data-error="wrong emailUser format" data-success="">Email</label required>
						</div>
						<div class="input-field col s12" style="margin-top:25px">
							<select name="<?php echo $privilegeUpdate; ?>" class="validate">
								<option value="" selected>Select Privilege</option>
								<option value="1">Administrator</option>
								<option value="2">Operator</option>
							</select>
							<label>Privilege</label>
						</div>
						<div class="col s12">
							<?php
							$firstName = $_POST[$firstNameUpdate];
							$lastName = $_POST[$lastNameUpdate];
							$username = $_POST[$usernameUpdate];
							$password = $_POST[$passwordUpdate];
							$email = $_POST[$emailUpdate];
							$privilege = $_POST[$privilegeUpdate];
							$idUserHidden = $_POST[$hiddenId];
							if(isset($_POST[$updateUser])){
								if(mysql_query("UPDATE tb_user SET firstName = '".$firstName."', lastName = '".$lastName."', username = '".$username."', password = '".$password."', email = '".$email."', priviledge = '".$privilege."' WHERE idUser = ".$idUserHidden."")){
									header("Location: ./index.php?menu=user&user=".$_SESSION['priv']."&tai=".$_POST['privilegeUpdate']."");
								}else{
									echo "Error: ".mysql_error($conn);
								}
							}

							if(isset($_POST[$deleteUser])){
								if(mysql_query("DELETE FROM tb_user WHERE idUser = ".$idUserHidden."")){
									header("Location: ./index.php?menu=user&user=".$_SESSION['priv']."");
								}else{
									echo "Error: ".mysql_error($conn);
								}
							}
							?>
							<input value="<?php echo $getUserForModal['idUser'];?>" type="hidden" class="validate" name="<?php echo $hiddenId;?>">
							<button class="modal-action modal-close waves-effect waves-green btn-flat amber" type="submit" name="<?php echo $updateUser; ?>">Update</button>
							<button class="modal-action modal-close waves-effect waves-green btn-flat red" type="submit" name="<?php echo $deleteUser; ?>">Delete</button>
							<a class="modal-action modal-close waves-effect waves-green btn-flat cyan" onclick="javasrcipt:window.location.href='<?php echo $linkHere?>'">Cancel</a>
						</div>
						</form>
					</div>
				</div>
			</div>
			<!-- MODAL UPDATE USER ENDS -->	
	<?php
		$modalNum++;
		}
	?>
			<div class="col s12">
				<table class="responsive-table striped">
					<thead>
						<tr>
							<th data-field="no">
								No.
							</th>
							<th data-field="firstNameUser">
								First Name
							</th>
							<th data-field="lastNameUser">
								Last Name
							</th>
							<th data-field="usernameUser">
								Username
							</th>
							<th data-field="passwordUser">
								Password
							</th>
							<th data-field="emailUser">
								Email
							</th>
							<th data-field="priv">
								Privilege
							</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$userNum = 1;
							$qryUser = mysql_query("SELECT * FROM tb_user");
							while($getUser = mysql_fetch_array($qryUser)){
						?>
						<tr>
							<td>
								<?php echo $userNum;?>
							</td>
							<td>
								<?php echo $getUser['firstName'];?>
							</td>
							<td>
								<?php echo $getUser['lastName'];?>
							</td>
							<td>
								<?php echo $getUser['username'];?>
							</td>
							<td>
								<?php echo $getUser['password'];?>
							</td>
							<td>
								<?php echo $getUser['email'];?>
							</td>
							<td>
								<?php 
									if($getUser['priviledge'] == 1){
										$userPriv = "Administrator";
									}else{
										$userPriv = "Operator";
									}

									echo $userPriv;
								?>
							</td>
							<td>
								<a href="<?php echo '#manageUser'.$userNum;?>" name="action" data-target="<?php echo 'manageUser'.$userNum;?>" class="modal-trigger waves-effect waves-light btn tra"><i class="material-icons">edit</i>Manage</a>
							</td>
						</tr>
						<?php
							$userNum++;
							}
						?>
					</tbody>
				</table>
				<div class="col s12">
					<span class="red-text"><?php echo $usernameUserExistNotif; ?></span>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
}else{
	header('Location: ./');
}
?>
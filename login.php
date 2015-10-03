<div class="row" style="border-bottom: 1px solid #bcbcbc; margin-top:15px;">
	<div class="container">
		<div class="col s12 center">
			<img src="images/logo.png" class="responsive-img" width="30%">
		</div>
		<div class="container">
		<div class="col s12">
			<h4 class="left white-text">
				Login
			</h4>
		</div>
		</div>
		<form class="col s12" method="POST" action="">
			<div class="row">
				<div class="container">
					<div class="input-field col s12 m12 l12">
						<input id="icon_prefix" type="text" class="validate" name="username" required>
						<label for="icon_prefix">Username</label>
					</div>
					<div class="input-field col s12 m12 l12">
						<input id="icon_prefix" type="password" class="validate" name="password" required>
						<label for="icon_prefix">Password</label>
					</div>
					<div class="input-field col m12 l12">
						<button style="margin-left:20px	" class="right waves-effect waves-light btn-large amber hide-on-small-only" type="submit" name="submit"><i class="material-icons right">send</i>Login</button>
						<button class="right waves-effect waves-light btn-large amber hide-on-small-only" type="cancel" onclick="javasrcipt:window.location.href='./index.php?menu=login'" name="cancel"><i class="material-icons right">cancel</i>Cancel</button>
					</div>
					<div class="input-field col s12">
						<button class="waves-effect waves-light btn amber hide-on-med-and-up" type="cancel" onclick="javasrcipt:window.location.href='./index.php?menu=login'" name="cancel"><i class="material-icons right">cancel</i>Cancel</button>
					</div>
					<div class="input-field col s12">
						<button class="waves-effect waves-light btn amber hide-on-med-and-up" type="submit" name="submit"><i class="material-icons right">send</i>Login</button>
					</div>
					<div class="input-field col s12 red-text">
<?php
if(isset($_POST['submit'])){
	$username = $_POST['username'];
	$password = $_POST['password'];

	$checkLogin = "SELECT * FROM tb_user WHERE username = '".$username."' AND password = '".$password."'";
	$resulCheckLogin = mysql_query($checkLogin);
	$checkLogin = mysql_fetch_array($resulCheckLogin);

	if (mysql_num_rows($resulCheckLogin) == 1) {
		$_SESSION['name'] = $checkLogin['firstName'].' '.$checkLogin['lastName'];
		$_SESSION['priv'] = $checkLogin['priviledge'];
		$_SESSION['user'] = $checkLogin['username'];
		$_SESSION['logged'] = "logged";
		header("Location: ./");
		}else{
		echo 'Username & Password salah..';
		}
}
?>
					</div>
				</div>
			</div>
		</form>
  	</div>
</div>
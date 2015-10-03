<?php
if(isset($_POST['submit'])){
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$message = $_POST['message'];

	$insertToMessage = "INSERT INTO tb_message (date, firstName, lastName, phone, email, message, status) value (now(), '".$firstName."', '".$lastName."', '".$phone."', '".$email."', '".$message."', 'unread')";
	if (mysql_query($insertToMessage)) {
		?>
		<div class="row" style="border-bottom: 1px solid #bcbcbc; border-top: 1px solid #bcbcbc; margin-top:15px;">
			<div class="container">
				<div class="col s12">
					<h2 class="center white-text">
						THANK YOU FOR YOUR APRECIATE
					</h2>
				</div>
				<div class="col s12">
					<h2 class="center white-text">
						Your message sent, we will cantact you soon.
					</h2>
				</div>
				<div class="col s12 center">
					<img src="images/logo.png" class="responsive-img" width="30%">
				</div>
				<div class="input-field col s12 center" style="margin-top:50px; margin-bottom:50px;">
					<button class=" center waves-effect waves-light btn-large white grey-text text-darken-4" type="cancel" onclick="javasrcipt:window.location.href='./index.php?menu=collection'" name="cancel">Back to see Mannequin Collection..</button>
				</div>
			</div>
		</div>
		<?php
		} else {
			echo "Error: ".$insertToMessage." ".mysql_error($conn);
		}
}else{
	header('Location: ./');
}
?>
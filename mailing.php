<?php
include('connect.php');
if(isset($_POST['submit'])){
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$phone = $_POST['phone'];
	$emailPost = $_POST['email'];
	$message = $_POST['message'];

	$insertToMessage = "INSERT INTO tb_message (date, firstName, lastName, phone, email, message, status) value (now(), '".$firstName."', '".$lastName."', '".$phone."', '".$emailPost."', '".$message."', 'unread')";
	if (mysql_query($insertToMessage)) {
	}else {
		echo "Error: ".$insertToMessage." ".mysql_error($conn);
	}

	$email = $_REQUEST['email'];
	$messageMail = $_REQUEST['message']."</br></br>To manage visitor messages, please login on mannequinbutik.com then goto message menu..";
	$subject = "Notification from Mannequinbutik.com : Visitor send message..";
	$body = <<<HTML
$messageMail
HTML;

	$headers = "From: $email\r\n";
    $headers .= "Content-type: text/html\r\n";

    $qryEmailAddress = mysql_query("SELECT email FROM tb_user");
    while($getEmailAddress = mysql_fetch_array($qryEmailAddress)){
		$to = $getEmailAddress['email'];
	    mail($to, $subject, $body, $headers);
	}
    header('Location: ./index.php?menu=thankyou');
}else{
	header('Location: ./');
}
?>
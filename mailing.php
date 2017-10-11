<?php
include('connect.php');
if(isset($_POST['submit'])){
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$phone = $_POST['phone'];
	$emailPost = $_POST['email'];
	$message = $_POST['message'];

	$insertToMessage = "INSERT INTO tb_message (date, firstName, lastName, phone, email, message, status) value (now(), '".$firstName."', '".$lastName."', '".$phone."', '".$emailPost."', '".$message."', 'unread')";
	if (mysqli_query($insertToMessage)) {
	}else {
		echo "Error: ".$insertToMessage." ".mysqli_error($conn);
	}

	$email = $_REQUEST['email'];
	$messageMail = $_REQUEST['message']."</br></br>To manage visitor messages, please login on mnqboutique.com then goto admin menu..";
	$subject = "Notification from mnqboutique.com : Visitor send message..";
	$body = <<<HTML
$messageMail
HTML;

	$headers = "From: $email\r\n";
    $headers .= "Content-type: text/html\r\n";

    $qryEmailAddress = mysqli_query($conn, "SELECT email FROM tb_user");
    while($getEmailAddress = mysqli_fetch_array($qryEmailAddress)){
		$to = $getEmailAddress['email'];
	    mail($to, $subject, $body, $headers);
	}
    header('Location: ./index.php?menu=thankyou');
}else{
	header('Location: ./');
}
?>
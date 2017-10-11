<?php
foreach($_POST as $key => $val) {
  if (!is_array($val)) {
    $_POST[$key] = mysqli_real_escape_string($conn, $val);
  }
}

$menu 			= isset($_GET['menu'])?$_GET['menu']:'';
$postMessages 	= isset($postMessages)?$postMessages:'';
$colorMessages 	= isset($colorMessages)?$colorMessages:'';

$menu = isset($_GET['menu'])?$_GET['menu']:'';
$cat = isset($_GET['cat'])?$_GET['cat']:'';
$user = (isset($_SESSION['login']) && $_SESSION['login'] == "logged" )?$_SESSION['firstName']." ".$_SESSION['lastName']:'';
$now = date("Y-m-d H:i:s");

function logging($date, $user, $action, $value, $iditem){
	require "../connect.php";
	$insertLogQry = "";
	$insertLogQry = "INSERT INTO tb_log (date, user, action, value, iditem) VALUES ('".$date."', '".$user."', '".$action."', '".$value."', '".$iditem."')";
	if(!mysqli_query($conn, $insertLogQry)){
    	echo "ERROR: Could not able to execute ".$insertLogQry.". " . mysqli_error($conn);
    }else{
    	echo $insertLogQry;
    }
}
?>
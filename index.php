<?php
ob_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
session_start();
include 'connect.php';
if(isset($_GET['menu'])){
	$menu = $_GET['menu'];
}else{
	$menu = "home";
}

if(isset($_SESSION['user'])){
	$name = $_SESSION['name'];
	$priv = $_SESSION['priv'];
	$user = $_SESSION['user'];
}else{
	$name = '';
	$priv = '';
	$user = '';
}

?>
<!DOCTYPE html>
<html>
  <head>
  	<title>Mannequin Boutique</title>
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <style type="text/css">
	body {
		display: flex;
		min-height: 100vh;
		flex-direction: column;
	}

	main {
		flex: 1 0 auto;
	}
	</style>
    </head>
  <body>
  	<header>
		<nav class="top-nav amber" style="height:100px">
			<div class="container">
				<div class="nav-wrapper" style="padding-top:15px">
					<a href="./index.php" class="brand-logo">
						<img class="valign" src="images/logo.png" style="height:70px" alt="Mannequin">
					</a>
					<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
					</ul>
					<!-- top nav start -->
					<ul class="right hide-on-med-and-down valign-wrapper" style="height:90px">
						<li class="<?php if ($menu == 'home'){echo 'active';}else{echo '';}?>" style="height:80px <?php if ($menu == 'home'){echo '';}else{echo 'valign';}?>"><a href="./index.php?menu=home"><h6>Home</h6></a></li>
						<li class="<?php if ($menu == 'collection'){echo 'active';}else{echo '';}?>" style="height:80px <?php if ($menu == 'collection'){echo '';}else{echo 'valign';}?>"><a href="./index.php?menu=collection"><h6>Collection</h6></a></li>
						<li class="<?php if ($menu == 'contact'){echo 'active';}else{echo '';}?>" style="height:80px <?php if ($menu == 'contact'){echo '';}else{echo 'valign';}?>"><a href="./index.php?menu=contact"><h6>Contact</h6></a></li>
				<?php
				if(!isset($_SESSION['name'])){
				?>	
						<li class="<?php if ($menu == 'login'){echo 'active';}else{echo '';}?>" style="height:80px <?php if ($menu == 'login'){echo '';}else{echo 'valign';}?>"><a href="./index.php?menu=login"><h6>Login</h6></a></li>
				<?php
				}else{
				?>
						<li class="<?php if ($menu == 'edit'){echo 'active';}else{echo '';}?>" style="height:80px <?php if ($menu == 'edit'){echo '';}else{echo 'valign';}?>"><a href="./index.php?menu=edit"><h6>Edit Panel</h6></a></li>
						<li class="<?php if ($menu == 'message'){echo 'active';}else{echo '';}?>" style="height:80px <?php if ($menu == 'message'){echo '';}else{echo 'valign';}?>"><a href="./index.php?menu=messages"><h6>Messages</h6></a></li>
						<li class="<?php if ($menu == 'logout'){echo 'active';}else{echo '';}?>" style="height:80px <?php if ($menu == 'logout'){echo '';}else{echo 'valign';}?>"><a href="./index.php?menu=logout"><h6>Logout</h6></a></li>
					<?php
					}
					?>
					</ul>
					</ul>
					<!-- top nav start -->
					<!-- side nav start -->
					<ul class="side-nav" id="mobile-demo">
						<li class="<?php if ($menu == 'home'){echo 'active';}else{echo '';}?>" ><a href="./index.php?menu=home">Home</a></li>
						<li class="<?php if ($menu == 'collectin'){echo 'active';}else{echo '';}?>" ><a href="./index.php?menu=collection">Collection</a></li>
						<li class="<?php if ($menu == 'contact'){echo 'active';}else{echo '';}?>" ><a href="./index.php?menu=contact">Contact</a></li>
					<?php
					if(!isset($_SESSION['name'])){
					?>	
						<li class="<?php if ($menu == 'login'){echo 'active';}else{echo '';}?>" ><a href="./index.php?menu=login">Login</a></li>
					<?php
					}else{
					?>
						<li class="<?php if ($menu == 'edit'){echo 'active';}else{echo '';}?>" ><a href="./index.php?menu=edit">Panel Edit</a></li>
						<li class="<?php if ($menu == 'messages'){echo 'active';}else{echo '';}?>" ><a href="./index.php?menu=messages">Messages</a></li>
						<li class="<?php if ($menu == 'logout'){echo 'active';}else{echo '';}?>" ><a href="./index.php?menu=logout">Logout</a></li>
					<?php
					}
					?>
					</ul>
					</ul>
					<!-- side nav ends -->
				</div>
			</div>
		</nav>
	</header>
	<main>
		<?php
			switch ($menu) {
				case 'collection':
					include 'collection.php';
					break;
				case 'home':
					include 'home.php';
					break;
				case 'contact':
					include 'contact.php';
					break;
				case 'login':
					include 'login.php';
					break;
				case 'thankyou':
					include 'thankyou.php';
					break;
				case 'logout':
					include 'logout.php';
					break;
				case 'edit':
					include 'edit.php';
					break;
				case 'messages':
					include 'showmessage.php';
					break;
				default :
					include 'home.php';
					break;
			}
		?>
	</main>
	<footer class="page-footer amber lighten-2">
		<div class="row">
			<div class="container">
				<div class="col s12">
					<h5 class="white-text">Visit Mannequin</h5>
				</div>
<?php
$queryAddres = "SELECT * FROM tb_addres LIMIT 3";
$resultAddres= mysql_query($queryAddres);
while ($addres = mysql_fetch_array($resultAddres)) {
?>
				<div class="col m4 l4 s12">
						<h5 class="grey-text text-lighten-4"><?php echo nl2br($addres['title']);?></h5>
					<p class="grey-text text-lighten-4">
						<?php echo nl2br($addres['label']);?>
					</p>
				</div>
<?php
}
?>
			</div>
		</div>
		<div class="footer-copyright amber">
			<div class="container">
				<div class></div>
				<div></div>
				<div></div>
				&copy; 2015 Copyright Mannequin
				<?php
				if(isset($_SESSION['name'])){
					$label = "Hi, ".$name;
				}else{$label = 'Mannequin Boutique';}
				?>
				<a class="grey-text text-lighten-4 right" href="./index.php"><?php echo $label; ?></a>
			</div>
		</div>
	</footer>
  	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript">
	var $leftRightBanner = $("#leftRightBanner");
	var $slidingBanner = $("#slidingBanner");
	var $about = $("#about");
	var $sample = $("#sample");
	var $dropdownButton = $(".dropdown-button");
		$(document).ready(function(){
			$('.slider').slider({full_width: false});
			$('ul.tabs').tabs();
	    	$('.tooltipped').tooltip({delay: 50});
		    $('.materialboxed').materialbox();
		    $('#libanner').click(function(){
				$banner.css("display", '');
				$about.css("display", 'none');
				$collection.css("display", 'none');
				$address.css("display", 'none');
				$dropdownButton.text('Banner Edit');
		    });

		    $('#liabout').click(function(){
				$banner.css("display", 'none');
				$about.css("display", '');
				$collection.css("display", 'none');
				$address.css("display", 'none');
				$dropdownButton.text('About Edit');
		    });

		    $('#licollection').click(function(){
				$banner.css("display", 'none');
				$about.css("display", 'none');
				$collection.css("display", '');
				$address.css("display", 'none');
				$dropdownButton.text('Collection Edit');
		    });

		    $('#liaddress').click(function(){
				$banner.css("display", 'none');
				$about.css("display", 'none');
				$collection.css("display", 'none');
				$address.css("display", '');
				$dropdownButton.text('Address Edit');
		    });

			// the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
			$('.modal-trigger').leanModal();
			$('.dropdown-button').dropdown({
				inDuration: 300,
				outDuration: 225,
				constrain_width: false, // Does not change width of dropdown to that of the activator
				hover: false, // Activate on hover
				gutter: 0, // Spacing from edge
				belowOrigin: false, // Displays dropdown below the button
				alignment: 'left' // Displays dropdown with edge aligned to the left of button
			});
		});

		$(".button-collapse").sideNav();
    </script>
  </body>
</html>
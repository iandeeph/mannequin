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
    <link type="text/css" rel="stylesheet" href="css/master.css"  media="screen,projection"/>
    <link href='https://fonts.googleapis.com/css?family=Quattrocento+Sans:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="icon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="icon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="icon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="icon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="icon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="icon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="icon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="icon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="icon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="icon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="icon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="icon/favicon-16x16.png">
    <link rel="manifest" href="icon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="icon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
  <body class="brown lighten-4">
  	<header>
        <div class="navbar container">
			<nav class="transparent z-depth-0 absolute container">
				<div class="nav-wrapper">
					<a href="#!" class="brand-logo grey-50"><img class="mt-10 ml-10 mr-10" title="Mannquin Boutique" alt="mnqboutique.com" src="images/logo.png" width="175px"></a>
                    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down grey-50">
                        <li class="font-25 <?php echo ($menu == 'home' || $menu == '')? "active" : "";?>"><a class="menu-btn" href="./index.php?menu=home">Home</a></li>
                        <li class="font-25 <?php echo ($menu == 'collection')? "active" : "";?>"><a class="menu-btn" href="./index.php?menu=collection">Collection</a></li>
                        <li class="font-25 <?php echo ($menu == 'contact')? "active" : "";?>"><a class="menu-btn" href="./index.php?menu=contact">Contact</a></li>
                    </ul>
                    <!-- ====================== MOBILE MENU -->
                    <ul class="side-nav" id="mobile-demo">
                        <li class="bold font-25 <?php echo ($menu == 'home' || $menu == '')? "active" : "";?>"><a href="./index.php?menu=home">Home</a></li>
                        <li class="bold font-25 <?php echo ($menu == 'collection')? "active" : "";?>"><a href="./index.php?menu=collection">Collection</a></li>
                        <li class="bold font-25 <?php echo ($menu == 'contact')? "active" : "";?>"><a href="./index.php?menu=contact">Contact</a></li>
                    </ul>
				</div>
			</nav>
        </div>
        <div class="parallax-container">
            <div class="parallax"><img src="images/banner.jpg"></div>
        </div>
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
				// case 'logout':
				// 	include 'logout.php';
				// 	break;
				// case 'edit':
				// 	include 'edit.php';
				// 	break;
				// case 'messages':
				// 	include 'showmessage.php';
				// 	break;
				default :
					include 'home.php';
					break;
			}
		?>
	</main>
	<footer class="page-footer amber lighten-1">
		<div class="row">
			<div class="container">
				<div class="col s12">
					<h5 class="white-text">Visit Mannequin</h5>
				</div>
<?php
$queryAddres = "SELECT * FROM tb_addres LIMIT 3";
$resultAddres= mysqli_query($conn, $queryAddres);
while ($addres = mysqli_fetch_array($resultAddres)) {
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
				&copy; 2017 Copyright Mannequin
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
    <script type="text/javascript" src="js/materialize.js"></script>
    <script type="text/javascript" src="js/mannequin.js"> </script>
  </body>
</html>
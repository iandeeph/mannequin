<?php
ob_start();
ini_set("display_errors", "1");
ini_set('error_reporting', E_ALL);
ini_set('memory_limit','1G');
set_time_limit(0);
ini_set('max_execution_time', 0); //300 seconds = 5 minutes
ini_set('upload_max_filesize', '1G');
ini_set('post_max_size', '1G');
error_reporting(E_ALL);
session_start();

require "../connect.php";
include '../php/mannequin.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
    <link rel="stylesheet" href="../css/master.css">

    <script src='../js/tinymce/tinymce.min.js'></script>

    <!-- ICON -->
    <link rel="apple-touch-icon" sizes="57x57" href="../icon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../icon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../icon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../icon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../icon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../icon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../icon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../icon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../icon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="../icon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../icon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../icon/favicon-16x16.png">
    <link rel="alternate" href="http://example.com/en" hreflang="en" />
    <link rel="manifest" href="../icon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../icon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Mannequin Admin Panel</title>
  </head>
  <body>
		<header>
			<div class="navbar-fixed grey darken-3">
				<nav class="grey darken-3">
					<div class="nav-wrapper navbar-fixed grey darken-3 valign-wrapper left-menu">
						<a href="#" data-activates="side-menu" class="button-collapse left ml-30"><i class="menu-side-icon material-icons">menu</i></a>
						<a href="./" class="center brand-logo"><img class="admin-logo mt-20" src="../images/logo.png"></a>
						<div class="hide-on-med-and-down full"><h4 class="right-align mr-30">Admin Control Panel</h4></div>
					</div>
				</nav>
			</div>
		  	<?php
		  		if(isset($_SESSION['login']) && $_SESSION['login'] == 'logged'){
		  			$firstName = $_SESSION['firstName'];
		  			$lastName = $_SESSION['lastName'];
		  			?>
						<ul id="side-menu" class="side-nav fixed">
							<li class="bold height-100 valign-wrapper" disabled><a>Hi, <?php echo $firstName." ".$lastName;?></a></li>
							<li class="divider"></li>
							<li class="bold <?php echo ($menu == 'home' || $menu == '')? "active" : "";?>"><a href="./index.php?menu=home"><i class="menu-side-icon material-icons mt-20 left">home</i>Home</a></li>
							<li class="bold <?php echo ($menu == 'collection')? "active" : "";?>"><a href="./index.php?menu=collection"><i class="menu-side-icon material-icons mt-20 left">collections</i>Collection</a></li>
							<?php
								if($_SESSION['privilege'] == '1'){
									?>
										<li class="bold <?php echo ($menu == 'user')? "active" : "";?>"><a href="./index.php?menu=user"><i class="menu-side-icon material-icons mt-20 left">person</i>Manage User</a></li>
										<li class="bold <?php echo ($menu == 'log')? "active" : "";?>"><a href="./index.php?menu=log"><i class="menu-side-icon material-icons mt-20 left">content_paste</i>Activity Log</a></li>
									<?php
								}
							?>
							<li class="bold <?php echo ($menu == 'visitor')? "active" : "";?>"><a href="./index.php?menu=visitor"><i class="menu-side-icon material-icons mt-20 left">contact_mail</i>Viisitor</a></li>
							<li class="divider"></li>
							<li class="bold"><a href="./index.php?menu=logout"><i class="menu-side-icon material-icons mt-20 left">power_settings_new</i>Logout</a></li>
						</ul>
					<?php
				}else{
			    	include 'login.php';
			    }
			?>
		</header>
    <main>
    	<div class="menu-admin">
		    <?php
		  		if(isset($_SESSION['login']) && $_SESSION['login'] == 'logged'){
			        switch ($menu) {
			          case 'home':
			            include 'home.php';
			            break;
			          
			          case 'collection':
			            include 'collection.php';
			            break;

			          case 'user':
			            include 'user.php';
			            break;

			          case 'log':
			            include 'log.php';
			            break;

			          case 'visitor':
			            include 'visitor.php';
			            break;

			          case 'logout':
			            include 'logout.php';
			            break;

			          default:
			            include 'home.php';
			            break;
			        }
			    }
		    ?>
    	</div>
    </main>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
  	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="../js/materialize.js"></script>
    <script type="text/javascript" src="../js/mannequin.js"></script>
  </body>
</html>
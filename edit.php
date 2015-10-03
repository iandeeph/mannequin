<?php
if(!isset($_SESSION['logged']) && $_SESSION['priv'] != 1){
	header('Location: ./index.php');
}else{
?>
<div class="row" style="border-bottom: 1px solid #bcbcbc; margin-top:15px;">
	<div class="container">
		<div class="row">
			<div class="col s12 hide-on-small-only">
				<ul class="tabs transparent">
					<li class="tab col s3 "><a class="white-text" href="#banner">Banner Edit</a></li>
        			<li class="tab col s3 "><a class="white-text" href="#about">About Edit</a></li>
        			<li class="tab col s3 "><a class="white-text" href="#collection">Collection Edit</a></li>
        			<li class="tab col s3 "><a class="white-text" href="#address">Address Edit</a></li>
				</ul>
			</div>
			<div class="col s12 hide-on-med-and-up">
			<a class='dropdown-button btn amber' href='#' data-activates='dropdown1'>Menu for Edit..</a>
				<ul id='dropdown1' class='dropdown-content'>
					<li><a id='libanner'>Banner Edit</a></li>
        			<li><a id='liabout'>About Edit</a></li>
        			<li><a id='licollection'>Collection Edit</a></li>
        			<li><a id='liaddress'>Address Edit</a></li>
				</ul>
			</div>
			<form method="POST" action="" enctype="multipart/form-data">
				<!-- banner start -->
				<div class="col s12" id="banner">
					<?php
						include('leftrightbanner.php');
						include('slidingbanner.php');
					?>
				</div>
				<!-- banner ends -->
				<!-- about edit start -->
				<div class="col s12" id="about">
					<?php
						include('aboutedit.php');
					?>
				</div>
				<!-- about edit ends -->
				<!-- collecton edit start -->
				<div class="col s12" id="collection">
					<?php
						include('collectionEdit.php');
					?>
				</div>
				<!-- collecton edit ends -->
				<!-- adress edit start -->
				<div class="col s12" id="address">
					<?php
						include('addressEdit.php');
					?>
				</div>
				<!-- address edit start -->
			</form>
		</div>
	</div>
</div>
<?php
}
?>
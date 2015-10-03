<div class="row" style="border-bottom: 1px solid #bcbcbc; border-top: 1px solid #bcbcbc; margin-top:15px;">
	<div class="col s12" style="margin-top:30px;">
<?php
$getLeftBanner = mysql_query("SELECT image FROM tb_image WHERE category = 'left banner'");
$leftbanner = mysql_fetch_array($getLeftBanner);

$getRightBanner = mysql_query("SELECT image FROM tb_image WHERE category = 'right banner'");
$rightbanner = mysql_fetch_array($getRightBanner);
?>
		<div class="col l3 hide-on-med-and-down valign-wrapper" style="height:440px;" >
			<img src="<?php echo $leftbanner['image'];?>" class="responsive-img valign">
		</div>
		<div class="col s12 m12 l6" style="padding-top:15px; margin-bottom:15px;">
			<div class="slider">
				<ul class="slides">
<?php
$queryBanner = "SELECT * FROM tb_banner";
$resultBanner = mysql_query($queryBanner);
while ($banner = mysql_fetch_array($resultBanner)) {
?>
					<li>
						<img src="<?php echo $banner['image'];?>"> <!-- random image -->
						<div class="caption right-align">
							<h3 class="amber-text"><?php echo $banner['titleLabel'];?></h3>
							<h5 class="light amber-text text-darken-4"><?php echo $banner['label'];?></h5>
						</div>
					</li>
<?php
}
?>
				</ul>
			</div>
		</div>
		<div class="col l3 hide-on-med-and-down valign-wrapper" style="height:440px;" >
			<img src="<?php echo $rightbanner['image'];?>" class="responsive-img valign-wrapper">
		</div>
	</div>
</div>
<div class="row" style="border-bottom: 1px solid #bcbcbc; border-top: 1px solid #bcbcbc; margin-top:15px;">
	<div class="container">
		<div class="col s12">
			<h4 class="center">
				Mannequin Boutique
			</h4>
		</div>
<?php
$queryContent = "SELECT * FROM tb_content";
$resultContent = mysql_query($queryContent);
$content = mysql_fetch_array($resultContent);
?>
		<div class="col s12 center">
			<img src="<?php echo $content['image'];?>" class="responsive-img" width="50%">
		</div>
		<div class="col s12">
			<p class="flow-text" style="text-align:justify;">
				<?php echo nl2br($content['text']);?>
			</p>
		</div>
	</div>
</div>
<div class="row" style="border-bottom: 1px solid #bcbcbc; border-top: 1px solid #bcbcbc; margin-top:15px;">
	<div class="container">
		<div class="col s12">
			<h4 class="center">
				Mannequin Collection
			</h4>
		</div>
<?php
$queryCollectionHome = "SELECT * FROM tb_image LIMIT 3";
$resultCollectionHome = mysql_query($queryCollectionHome);
while ($collectionHome = mysql_fetch_array($resultCollectionHome)) {
?>
		<div class="col s12 m12 l4 center">
			<img class="materialboxed" data-caption="<?php echo $collectionHome['label'];?>" width="250" src="<?php echo $collectionHome['image'];?>">
		</div>
<?php
}
?>
		<div class="col s12 center" style="padding-top:15px; margin-bottom:15px;">
			<a href="./index.php?menu=collection" class="waves-effect amber waves-light btn-large">More Collection...</a>
		</div>
	</div>
</div>
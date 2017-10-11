<div class="row mt-30">
	<div class="container">
		<div class="col s12">
			<h4 class="center">
				Mannequin Boutique
			</h4>
		</div>
<?php
$queryContent = "SELECT * FROM tb_content";
$resultContent = mysqli_query($conn, $queryContent);
$content = mysqli_fetch_array($resultContent);
?>
		<div class="col s12">
			<p class="flow-text center">
				<?php echo nl2br($content['text']);?>
			</p>
		</div>
		<div class="col s6 valign-wrapper center">
			<img src="<?php echo $content['image'];?>" class="responsive-img">
		</div>
		<div class="col s6 valign-wrapper center">
			<img src="<?php echo $content['image2'];?>" class="responsive-img">
		</div>
	</div>
</div>
<!--slid-->
<div class="slid">
	<div class="container">			
		<div class="slid-info">
			<p>What you wear is how you present yourself to the world, especially today, when human contacts are so quick. Fashion is instant language.</p>
			<p class="italic">~ Miuccia Prada</p>
		</div>
	</div>	
</div>
<!--//slid-->
<div class="row mt-30">
	<div class="container">
		<div class="col s12">
			<h4 class="center">
				Mannequin Collection
			</h4>
		</div>
		<div class="row">
		    <div class="col s12">
		      <?php
$queryCollectionHome = "SELECT * FROM tb_image LIMIT 3";
$resultCollectionHome = mysqli_query($conn, $queryCollectionHome);
while ($collectionHome = mysqli_fetch_array($resultCollectionHome)) {
?>
        		<div class="col s12 m12 l4">
        			<img class="img-center materialboxed" data-caption="<?php echo $collectionHome['label'];?>" width="250" src="<?php echo $collectionHome['image'];?>">
        		</div>
<?php
}
?>  
		    </div>
		</div>
		<div class="col s12 center mt-15">
			<a href="./index.php?menu=collection" class="waves-effect amber waves-light btn-large">More Collection...</a>
		</div>
	</div>
</div>
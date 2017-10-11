<?php
	if(!isset($_GET['pages'])){
		$_GET['pages'] = 1;
	}

	$perPages = 6;
	$collQry = "SELECT * FROM tb_image WHERE category = 'collection'";
	$getCollection = mysqli_query($conn, $collQry);
	$totCont = mysqli_num_rows($getCollection);
	$totPages = ceil($totCont/$perPages);

	//pagination code
	if(isset($_GET['pages'])){
		$curPages = $_GET['pages'];
		if ($curPages>0 && $curPages<=$totPages) {
			$start = ($curPages-1)*$perPages;
			$end = $start+$perPages;
		}else{
			$start=0;
			$end=$perPages;
		}
	}else{
		$start=0;
		$end=$perPages;
	}

	$page=intval($_GET['pages']);
	$tpages=$totPages;

	if($page<=0)$page=1;

	if($curPages <= 1){
		$dissleft = "disabled";
	}else{$dissleft="";}
	if($curPages >= $tpages){
		$dissright = "disabled";
	}else{$dissright="";}

	if ($curPages > 1) {
		$prevPage = $_SERVER['PHP_SELF']."?menu=collection&pages=".$prevCurPage = $_GET['pages'] - 1;
	}else{
		$prevPage = '';
	}
	if ($curPages < $tpages) {
		$nextPage = $_SERVER['PHP_SELF']."?menu=collection&pages=".$nextCurPage = $_GET['pages'] + 1;
	}else{
		$nextPage = '';
	}
?>
<div class="row mt-15">
	<div class="container">
		<div class="col s12">
			<h4 class="center">
				Mannequin Collection
			</h4>
		</div>
	</div>
</div>
<div class="row mt-15">
	<div class="container">
<?php
$collectionItemPerPages = mysqli_query($conn, "SELECT * FROM tb_image WHERE category = 'collection' order by idimg DESC LIMIT ".$perPages." OFFSET ".$start."");
if($collectionItemPerPages && mysqli_num_rows($collectionItemPerPages) > 0){
	while($collection = mysqli_fetch_array($collectionItemPerPages)) {
?>
		<div class="center">
			<img class="materialboxed col s12 m12 l4" data-caption="<?php echo $collection['label']; ?>" width="250" src="<?php echo $collection['image']; ?>" style="margin-bottom:15px;">
		</div>
<?php
	}
}
?>
		<div class="center col s12">
			<ul class="pagination">
				<li class="waves-effect <?php echo $dissleft; ?>" <?php echo $dissleft; ?>><a href="<?php echo $prevPage; ?>" class="<?php echo $dissleft; ?>"><i class="material-icons">chevron_left</i></a></li>
					<?php
					for ($j=1; $j <= $tpages; $j++) {
						if ($curPages == $j) {
							$active = 'active';
						}else{$active="";}
						echo "<li class='".$active."'><a href='".$_SERVER['PHP_SELF']."?menu=collection&pages=".$j."'>".$j."</a></li>";
					}
					?>
				<li class="waves-effect <?php echo $dissright; ?>"><a href="<?php echo $nextPage; ?>" class="<?php echo $dissright; ?>"><i class="material-icons">chevron_right</i></a></li>
			</ul>
		</div>
	</div>
</div>
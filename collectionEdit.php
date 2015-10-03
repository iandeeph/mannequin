<?php
$queryNewImage = "INSERT INTO tb_image (image, category, label) VALUES ('images/noimage.jpg', 'collection', 'Mannequin Collection...')";
	if(isset($_POST['insertNewImage'])){
		if(mysql_query($queryNewImage)){
			header("Location: ./index.php?menu=homeedit#collection");
		}else{
			echo "Error: ".mysql_error($conn);
		}
	}
?>
<div class="col s12" style="border-bottom: 1px solid #bcbcbc; margin-top:30px">
	<h5 class="center white-text">
		Sample Collection Edit
	</h5>
</div>
<div class="col s12 center " style="margin-top:30px; margin-bottom:30px;"  >
	<button type="submit" name="insertNewImage" class="tooltipped btn-floating btn-large waves-effect waves-light red" name="addNewImage" data-position="left" data-delay="50" data-tooltip="Add New Collection..."><i class="material-icons">add</i></button>
</div>
<?php
$target_dir = "images/";
$queryColletion = "SELECT * FROM tb_image WHERE category = 'collection'";
$resultColletion = mysql_query($queryColletion);
$imgNumbering = 1;
while($rowCollection = mysql_fetch_array($resultColletion)){
	
	$images = $rowCollection['image'];
	$label = $rowCollection['label'];
	//Upload Image && Update labelImg & label --->>>>>>
	if(isset($_POST["uploadImgCollection".$imgNumbering])){
		$sampleCheck = "sample".$imgNumbering;
		$idoncheckbox = $_POST['idoncheckbox'.$imgNumbering];
		$qrySample = mysql_query("SELECT sample FROM tb_image WHERE idimg = '".$idoncheckbox."'");
		$rowSample = mysql_fetch_array($qrySample);
		if($rowSample['sample'] == 'selected'){
			$postSample = NULL;
		}else{
			$postSample = 'selected';
		}

		if(mysql_query("UPDATE tb_image SET sample = '".$postSample."'WHERE idimg = '".$idoncheckbox."'")){
		}else{
			echo "Error: ".mysql_error($conn);
		}
		$postLabelImage = addslashes($_POST['labelImg'.$imgNumbering]);
		$postidImg = $_POST['idimg'.$imgNumbering];
		$imagePath = $_POST['imagePath'.$imgNumbering];
		$imageFile = $_POST['imageFile'.$imgNumbering];
		$filesimageFile = $_FILES['imageFile'.$imgNumbering];

		if(mysql_query("UPDATE tb_image SET label = '".$postLabelImage."' WHERE idimg = ".$postidImg."")){
		}else{
			echo "Error: ".mysql_error($conn);
		}
		if($_POST['imagePath'.$imgNumbering] != "" ) {
			$imgFile = $target_dir . basename($imagePath);
			$collectionUploadOK = 1;
			$sliderFileType = pathinfo($imgFile,PATHINFO_EXTENSION);

			// Check if image file is a actual image or fake image
			$check = getimagesize($filesimageFile['tmp_name']);
			if($check !== false) {
				$collectionUploadOK = 1;
			} else {
				$color = "red";
				$msgImg = "File bukan gambar.";
				$collectionUploadOK = 0;
			}

			// Allow certain file formats
			if($sliderFileType != "jpg" && $sliderFileType != "png" && $sliderFileType != "jpeg") {
				$color = "red";
				$msgImg = "Format gambar yang dapat diupload hanya JPG, JPEG & PNG.";
				$collectionUploadOK = 0;
			}

			// Check if $uploadOk is set to 0 by an error
			if ($collectionUploadOK == 0) {
				$color = "red";
				$msgImg = "Gambar belum diupload.";
			} else {
				// if everything is ok, try to upload file
				if (move_uploaded_file($filesimageFile["tmp_name"], $imgFile)) {
					$delCollection = mysql_query("SELECT image FROM tb_image WHERE idimg = '".$postidImg."'");
					$imgdel = mysql_fetch_array($delCollection);
					if($imgdel['image'] != 'images/noimage.jpg'){
						unlink($imgdel['image']);
					}
					
					if(mysql_query("UPDATE tb_image SET image = '".$imgFile."' WHERE idimg = '".$postidImg."'")){
					}else{
						echo "Error: ".mysql_error($conn);
					}
				} else {
					$color = "red";
					$msgImg = "Terjadi kesalahan saat upload gambar, gambar belum diupload.";
				}
			}
		}

		header("Location: ./index.php?menu=homeedit#collection");
	}
	//<<<<----------
?>
<div class="col s12" style="margin-top:30px; border-bottom: 1px solid #bcbcbc;">
	<div class="col s1">
		<?php echo $imgNumbering; ?>
	</div>
	<div class="col m3 l3 s11">
		<img src="<?php echo $images;?>" class="responsive-img valign">
	</div>
	<div class="input-field col s6 m7 l7">
<?php
$selectedQuery = mysql_query("SELECT sample FROM tb_image WHERE sample = 'selected'");
$numSample = mysql_num_rows($selectedQuery);
if($rowCollection['sample'] == "selected"){
	$checked = "checked";
	$notif = "";
}else{
	if($numSample >= 3){
		$checked = "disabled";

		$notif = "(Uncheck active checklist if you wish to make this image as sample collection..)";
	}else{
		$checked = "";
		$notif = "";
	}
}
?>
		<p class="left">
			<input type="hidden" name="<?php echo "idoncheckbox".$imgNumbering;?>" value="<?php echo $rowCollection['idimg'];?>">
			<input value="<?php echo $checked;?>" type="checkbox" id="<?php echo "sample".$imgNumbering; ?>" name="<?php echo "sample".$imgNumbering;?>" <?php echo $checked; ?>/>
			<label for="<?php echo "sample".$imgNumbering; ?>">Sample Collection For Homepage<?php echo $notif;?></label>
		</p>
	</div>
	<div class="col s1 hide-on-small-only">
		<a class="modal-trigger btn-floating btn-large waves-effect waves-light red" data-target="<?php echo "deleteImgAllert".$imgNumbering;?>" href="#<?php echo "deleteImgAllert".$imgNumbering;?>"><i class="material-icons">delete</i></a>
	</div>
	<div class="input-field col s11 l7 m7" style="margin-top:50px">
		<input value="<?php echo $label;?>" id="<?php echo "labelImg".$imgNumbering;?>" type="text" class="validate" name="<?php echo "labelImg".$imgNumbering;?>">
		<label for="<?php echo "labelImg".$imgNumbering;?>">Label Image</label>
	</div>
	<div class="input-field col s11 l7 m7" style="margin-top:50px">
		<span>
<?php 
echo $msgImg;
?>
		</span>
	</div>
	<div class="file-field input-field col offset-l1 offset-m1 s12 m8 l8">
		<div class="btn tooltipped amber" data-position="top" data-delay="50" data-tooltip="Change Image...">
			<span>Change Image</span>
			<input type="file" name="<?php echo "imageFile".$imgNumbering;?>" id="<?php echo "imageFile".$imgNumbering;?>">
		</div>
		<div class="file-path-wrapper">
			<input class="file-path validate" type="text" name="<?php echo "imagePath".$imgNumbering;?>">
		</div>
	</div>
	<div class="input-field col l3 m3 hide-on-small-only">
		<button class="btn waves-effect waves-light amber" type="submit" name="<?php echo "uploadImgCollection".$imgNumbering;?>">Submit
			<i class="material-icons right">send</i>
		</button>
	</div>
	<div class="col s12 hide-on-med-and-up">
		<button class="btn waves-effect waves-light amber" type="submit" name="<?php echo "uploadImgCollection".$imgNumbering;?>">Submit
			<i class="material-icons right">send</i>
		</button>
		<a class="modal-trigger btn waves-effect waves-light red" data-target="<?php echo "deleteImgAllert".$imgNumbering;?>" name="action" href="#<?php echo "deleteImgAllert".$imgNumbering;?>">Delete
	    <i class="material-icons right">delete</i>
		</a>
	</div>
</div>
<!-- MODAL ALERT -->
<div id="<?php echo "deleteImgAllert".$imgNumbering;?>" class="modal modal-fixed-footer" style="height:30%">
	<div class="modal-content">
		<h4>Apakah anda yakin untuk menghapus image collection ini ?</h4>
		<p>Image collection akan dihapus untuk selamanya!!</p>
	</div>
	<div class="modal-footer">
<?php
$delCollection = "delCollection".$imgNumbering;
$idimg = $_POST['idimg'.$imgNumbering];
if(isset($_POST[$delCollection])){
	if(mysql_query("DELETE FROM tb_image WHERE idimg = '$idimg'")){
		header("Location: ./index.php?menu=homeedit#collection");
	}else{
		echo "Error: ".mysql_error($conn);
	}
}
?>
		<input type="hidden" name="<?php echo "idimg".$imgNumbering;?>" value="<?php echo $rowCollection['idimg'];?>">
		<button class="modal-action modal-close waves-effect waves-green btn-flat" type="submit" name="<?php echo "delCollection".$imgNumbering;?>">Yes</button>
		<a class="modal-action modal-close waves-effect waves-green btn-flat" name="<?php echo "canceldelCollection".$imgNumbering;?>">No</a>
	</div>
</div>
<?php
$imgNumbering++;
}
?>
<div class="col s12 center " style="margin-top:30px; margin-bottom:30px;"  >
	<button type="submit" name="insertNewImage" class="tooltipped btn-floating btn-large waves-effect waves-light red" name="addNewImage" data-position="left" data-delay="50" data-tooltip="Add New Collection..."><i class="material-icons">add</i></button>
</div>
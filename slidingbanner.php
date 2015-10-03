<div class="col s12" style="border-bottom: 1px solid #bcbcbc; margin-top:30px">
	<h5 class="center white-text">
		Sliding Image Banner Edit
	</h5>
</div>
<?php
$target_dir = "images/";
$getSlidingBanner = mysql_query("SELECT * FROM tb_banner");
$numbering = 1;
while($sliding = mysql_fetch_array($getSlidingBanner)){
	$titleLabel = stripcslashes($sliding['titleLabel']);
	$label = stripcslashes($sliding['label']);
	//Upload Image && Update titleLabel & label --->>>>>>
	if(isset($_POST["uploadSlidingImage".$numbering])){
		$postTitleLabel = addslashes($_POST['titleLabel'.$numbering]);
		$postLabel = addslashes($_POST['label'.$numbering]);
		$postIdImage = $_POST['idImage'.$numbering];
		$postSliderImagePath = $_POST['sliderImagePath'.$numbering];
		$postSliderImageFile = $_POST['sliderImage'.$numbering];
		$filesSliderImage = $_FILES['sliderImage'.$numbering];

		if(mysql_query("UPDATE tb_banner SET titleLabel = '".$postTitleLabel."', label = '".$postLabel."' WHERE idImage = ".$postIdImage."")){
		}else{
			echo "Error: ".mysql_error($conn);
		}
		if($_POST['sliderImagePath'.$numbering] != "" ) {
			$sliderFile = $target_dir . basename($postSliderImagePath);
			$sliderUploadOK = 1;
			$sliderFileType = pathinfo($sliderFile,PATHINFO_EXTENSION);

			// Check if image file is a actual image or fake image
			$check = getimagesize($filesSliderImage['tmp_name']);
			if($check !== false) {
				$sliderUploadOK = 1;
			} else {
				$color = "red";
				$msgSlider[$numbering] = "File bukan gambar.";
				$sliderUploadOK = 0;
			}

			// Allow certain file formats
			if($sliderFileType != "jpg" && $sliderFileType != "png" && $sliderFileType != "jpeg") {
				$color = "red";
				$msgSlider[$numbering] = "Format gambar yang dapat diupload hanya JPG, JPEG & PNG.";
				$sliderUploadOK = 0;
			}

			// Check if $uploadOk is set to 0 by an error
			if ($sliderUploadOK == 0) {
				$color = "red";
				$msgSlider[$numbering] = "Gambar belum diupload.";
			} else {
				// if everything is ok, try to upload file
				if (move_uploaded_file($filesSliderImage["tmp_name"], $sliderFile)) {
					$delSlider = mysql_query("SELECT image FROM tb_banner WHERE idImage = '".$postIdImage."'");
					$del = mysql_fetch_array($delSlider);
					if($del['image'] != 'images/noimage.jpg'){
						unlink($del['image']);
					}
					
					if(mysql_query("UPDATE tb_banner SET image = '".$sliderFile."' WHERE idImage = '".$postIdImage."'")){
					}else{
						echo "Error: ".mysql_error($conn);
					}
				} else {
					$color = "red";
					$msgSlider[$numbering] = "Terjadi kesalahan saat upload gambar, gambar belum diupload.";
				}
			}
		}

		header("Location: ./index.php?menu=homeedit#slidingBanner");
	}
	//<<<<----------

?>
<div class="col s12" style="border-bottom: 1px solid #bcbcbc; margin-top:30px">
	<div class="col l1 m1 s1">
		<h5 class="center white-text">
			<?php echo $numbering.".";?>
		</h5>
	</div>
	<div class="col s11">
		<img src="<?php echo $sliding['image'];?>" class="responsive-img valign">
	</div>
	<div class="file-field input-field col s12">
		<div class="btn tooltipped" data-position="top" data-delay="50" data-tooltip="Change Sliding Image...">
			<span>Change Image</span>
			<input type="file" name="<?php echo "sliderImage".$numbering;?>" id="<?php echo "sliderImage".$numbering;?>">
		</div>
		<div class="file-path-wrapper">
			<input class="file-path validate" type="text" name="<?php echo "sliderImagePath".$numbering;?>">
		</div>
	</div>
	<div class="input-field col l6 m12 s12">
		<input value="<?php echo $titleLabel;?>" id="<?php echo "titleLabel".$numbering;?>" type="text" class="validate" name="<?php echo "titleLabel".$numbering;?>">
	</div>
	<div class="input-field col l6 m12 s12">
		<input value="<?php echo $label;?>" id="<?php echo "label".$numbering;?>" type="text" class="validate" name="<?php echo "label".$numbering;?>">
	</div>
	<div class="col s12" style="margin-bottom:50px;">
		<input type="hidden" name="<?php echo "idImage".$numbering;?>" value="<?php echo $sliding['idImage'];?>">
		<a class=" modal-trigger btn waves-effect waves-light" data-target="<?php echo "deleteAllert".$numbering;?>" href="#<?php echo "deleteAllert".$numbering;?>">Delete
			<i class="material-icons right">delete</i>
		</a>
		<button class="btn waves-effect waves-light " type="submit" name="<?php echo "uploadSlidingImage".$numbering;?>">Submit
			<i class="material-icons right">send</i>
		</button>
	</div>
	<div class="input-field col s12 <?php echo $color;?>-text">
<?php
echo $msgSlider[$numbering];
?>
	</div>
</div>
<!-- MODAL ALERT -->
<div id="<?php echo "deleteAllert".$numbering;?>" class="modal modal-fixed-footer" style="height:30%">
	<div class="modal-content">
		<h4>Apakah anda yakin untuk menghapus image slider ini ?</h4>
		<p>Image slider akan dihapus untuk selamanya!!</p>
	</div>
	<div class="modal-footer">
<?php
$deleteSlidingImage = "deleteSlidingImage".$numbering;
$idImage = $_POST['idImage'.$numbering];
if(isset($_POST[$deleteSlidingImage])){
	if(mysql_query("DELETE FROM tb_banner WHERE idImage = '$idImage'")){
		header("Location: ./index.php?menu=homeedit#slidingBanner");
	}else{
		echo "Error: ".mysql_error($conn);
	}
}
?>
		<input type="hidden" name="<?php echo "idImage".$numbering;?>" value="<?php echo $sliding['idImage'];?>">
		<button class="modal-action modal-close waves-effect waves-green btn-flat" type="submit" name="<?php echo "deleteSlidingImage".$numbering;?>">Yes</button>
		<a class="modal-action modal-close waves-effect waves-green btn-flat" name="<?php echo "cancelDeleteSlidingImage".$numbering;?>">No</a>
	</div>
</div>
<?php
$numbering++;
}

$insertNewSliding = "INSERT INTO tb_banner (image, titleLabel, label) VALUES ('images/noimage.jpg', 'Mannequin Boutique', 'Mall Puri Mall')";
	if(isset($_POST['insertNewSlide'])){
		if(mysql_query($insertNewSliding)){
			header("Location: ./index.php?menu=homeedit#slidingBanner");
		}else{
			echo "Error: ".mysql_error($conn);
		}
	}
?>
<div class="col s12 center " style="margin-top:30px; margin-bottom:30px;"  >
	<button type="submit" name="insertNewSlide" class="tooltipped btn-floating btn-large waves-effect waves-light red" name="addNewSlideImage" data-position="left" data-delay="50" data-tooltip="Add New Sliding Image..."><i class="material-icons">add</i></button>
</div>
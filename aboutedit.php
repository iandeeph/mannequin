<?php
$target_dir = "images/";
$queryContent = "SELECT * FROM tb_content WHERE id = 1";
$resultContent = mysql_query($queryContent);
$rowContent = mysql_fetch_array($resultContent);

if(isset($_POST["updateContent"])){
	$postHomeText = addslashes($_POST["homeText"]);
	$postImagePath = addslashes($_POST["imagePath"]);
	$postImageFile = addslashes($_POST["imageFile"]);
	$filesImage = $_FILES["imageFile"];

	if(mysql_query("UPDATE tb_content SET text = '".$postHomeText."' WHERE id = 1")){
	}else{
		$msgContent['content'] = "Error: ".mysql_error($conn);
	}
	if($_POST["imagePath"] != "" ) {
		$imageFile = $target_dir . basename($postImagePath);
		$imageUploadOK = 1;
		$imageFileType = pathinfo($imageFile,PATHINFO_EXTENSION);

		// Check if image file is a actual image or fake image
		$check = getimagesize($filesImage['tmp_name']);
		if($check !== false) {
			$imageUploadOK = 1;
		} else {
			$color = "red";
			$msgContent['content'] = "File bukan gambar.";
			$imageUploadOK = 0;
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
			$color = "red";
			$msgContent['content'] = "Format gambar yang dapat diupload hanya JPG, JPEG & PNG.";
			$imageUploadOK = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($imageUploadOK == 0) {
			$color = "red";
			$msgContent['content'] = "Gambar belum diupload.";
		} else {
			// if everything is ok, try to upload file
			if (move_uploaded_file($filesImage["tmp_name"], $imageFile)) {
				$delResultContent = mysql_query("SELECT image FROM tb_content WHERE id = 1");
				$delResult = mysql_fetch_array($delResultContent);
				unlink($delResult['image']);
				if(mysql_query("UPDATE tb_content SET image = '".$imageFile."' WHERE id = 1")){
				}else{
					$msgContent['content'] = "Error: ".mysql_error($conn);
				}
			} else {
				$color = "red";
				$msgContent['content'] = "Terjadi kesalahan saat upload gambar, gambar belum diupload.";
			}
		}
	}

	header("Location: ./index.php?menu=homeedit#about");
}
?>
<div class="col s12" style="border-bottom: 1px solid #bcbcbc; margin-top:30px">
	<h5 class="center white-text">
		About Mannequin Edit
	</h5>
</div>
<div class="col s11 center" style="margin-top:30px">
	<img src="<?php echo $rowContent['image'];?>" class="responsive-img valign">
</div>
<div class="file-field input-field col s12">
	<div class="btn tooltipped" data-position="top" data-delResultay="50" data-tooltip="Change About Mannequin Image...">
		<span>Change Image</span>
		<input type="file" name="imageFile" id="imageFile">
	</div>
	<div class="file-path-wrapper">
		<input class="file-path validate" type="text" name="imagePath">
	</div>
</div>
<div class="input-field col s12 <?php echo $color;?>-text">
<?php
echo $msgContent['content'];
?>
	</div>
<div class="input-field col s12">
	<i class="material-icons prefix">mode_edit</i>
	<textarea id="icon_prefix2" class="materialize-textarea" name="homeText"><?php echo $rowContent['text'];?></textarea>
	<label for="icon_prefix2">About Mannequin Text</label>
</div>
<div class="col l9 m9 s12" style="margin-top:30px">
	<button class="btn waves-effect waves-light " type="submit" name="updateContent">Submit
		<i class="material-icons right">send</i>
	</button>
</div>
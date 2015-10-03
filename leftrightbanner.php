<?php	
$target_dir = "images/";
$leftBannerFile = $target_dir . basename($_POST['leftBanner']);
$lefyBannerUploadOK = 1;
$leftImageFileType = pathinfo($leftBannerFile,PATHINFO_EXTENSION);


$rightBannerFile = $target_dir . basename($_POST['rightBanner']);
$rightBannerUploadOK = 1;
$rightImageFileType = pathinfo($rightBannerFile,PATHINFO_EXTENSION);

// Check if image file is a actual image or fake image
if(isset($_POST["uploadLeftImage"]) && $_POST["leftBanner"] != "" ) {
    $check = getimagesize($_FILES['leftBannerFile']['tmp_name']);
    if($check !== false) {
        $leftBannerUploadOK = 1;
    } else {
    	$color = "red";
        $msgLeft = "File bukan gambar.";
        $leftBannerUploadOK = 0;
    }

	// Allow certain file formats
	if($leftImageFileType != "jpg" && $leftImageFileType != "png" && $leftImageFileType != "jpeg") {
		$color = "red";
	    $msgLeft = "Format gambar yang dapat diupload hanya JPG, JPEG & PNG.";
	    $leftBannerUploadOK = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($leftBannerUploadOK == 0) {
		$color = "red";
	    $msgLeft = "Gambar belum diupload.";
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["leftBannerFile"]["tmp_name"], $leftBannerFile)) {
	    	$delLeftBanner = mysql_query("SELECT image FROM tb_image WHERE category = 'left banner'");
			$del = mysql_fetch_array($delLeftBanner);
			unlink($del['image']);
	    	mysql_query("UPDATE tb_image SET image = '".$leftBannerFile."' WHERE category = 'left banner'");
	    	header("Location: ./index.php?menu=editbanner");
	    	$msgLeft = "Upload image berhasil, silahkan kembali ke halaman depan untuk melihat hasil";
	    	$color = "green";
	    	} else {
	    	$color = "red";
	        $msgLeft = "Terjadi kesalahan saat upload gambar, gambar belum diupload.";
	    }
	}
}

// Check if image file is a actual image or fake image
if(isset($_POST["uploadRightImage"]) && $_POST["rightBanner"] != "" ) {
    $check = getimagesize($_FILES['rightBannerFile']['tmp_name']);
    if($check !== false) {
        $rightBannerUploadOK = 1;
    } else {
    	$color = "red";
        $msgRight = "File bukan gambar.";
        $rightBannerUploadOK = 0;
    }

	// Allow certain file formats
	if($rightImageFileType != "jpg" && $rightImageFileType != "png" && $rightImageFileType != "jpeg") {
		$color = "red";
	    $msgRight = "Format gambar yang dapat diupload hanya JPG, JPEG & PNG.";
	    $rightBannerUploadOK = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($rightBannerUploadOK == 0) {
		$color = "red";
	    $msgRight = "Gambar belum diupload.";
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["rightBannerFile"]["tmp_name"], $rightBannerFile)) {
	    	$delRightBanner = mysql_query("SELECT image FROM tb_image WHERE category = 'right banner'");
			$del = mysql_fetch_array($delRightBanner);
			unlink($del['image']);
	    	mysql_query("UPDATE tb_image SET image = '".$rightBannerFile."' WHERE category = 'right banner'");
	    	header("Location: ./index.php?menu=homeedit");
	    	} else {
	    	$color = "red";
	        $msgRight = "Terjadi kesalahan saat upload gambar, gambar belum diupload.";
	    }
	}
}

$getLeftBanner = mysql_query("SELECT image FROM tb_image WHERE category = 'left banner'");
$leftbanner = mysql_fetch_array($getLeftBanner);

$getRightBanner = mysql_query("SELECT image FROM tb_image WHERE category = 'right banner'");
$rightbanner = mysql_fetch_array($getRightBanner);
?>
<div class="col s12" style="border-bottom: 1px solid #bcbcbc; margin-top:30px">
	<h5 class="center white-text">
		Left & Right Image Banner Edit
	</h5>
</div>
<!-- left banner start -->
<div class="col s12">
	<h5 class="left">
		Left Banner Images
	</h5>
</div>
<div class="col l3 m3 s12">
	<img src="<?php echo $leftbanner['image'];?>" class="responsive-img valign">
</div>
<div class="file-field input-field col l9 m9 s12">
	<div class="btn tooltipped" data-position="top" data-delay="50" data-tooltip="Ukuran gambar sebaiknya square/persegi..">
		<span>Change Image</span>
		<input type="file" name="leftBannerFile" id="leftBannerFile">
	</div>
	<div class="file-path-wrapper">
		<input class="file-path validate" type="text" name="leftBanner">
	</div>
</div>
<div class="col l9 m9 s12">
	<button class="btn waves-effect waves-light " type="submit" name="uploadLeftImage">Submit
		<i class="material-icons right">send</i>
	</button>
</div>
<div class="input-field col s12 <?php echo $color;?>-text">
<?php
echo $msgLeft;
?>
</div>

<!-- right banner start -->
<div class="col s12">
	<h5 class="left">
		Right Banner Images
	</h5>
</div>
<div class="col l3 m3 s12">
	<img src="<?php echo $rightbanner['image'];?>" class="responsive-img valign">
</div>
<div class="file-field input-field col l9 m9 s12">
	<div class="btn tooltipped" data-position="top" data-delay="50" data-tooltip="Ukuran gambar sebaiknya square/persegi..">
		<span>Change Image</span>
		<input type="file" name="rightBannerFile" id="rightBannerFile">
	</div>
	<div class="file-path-wrapper">
		<input class="file-path validate" type="text" name="rightBanner">
	</div>
</div>
<div class="col l9 m9 s12">
	<button class="btn waves-effect waves-light " type="submit" name="uploadRightImage">Submit
		<i class="material-icons right">send</i>
	</button>
</div>
<div class="input-field col s12 <?php echo $color;?>-text">
<?php
echo $msgRight;
?>
</div>
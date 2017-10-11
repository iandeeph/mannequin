<?php
if(!isset($_SESSION['logged'])){
	header('Location: ./');
}else{
	$target_dir = "images/";
	$target_file = $target_dir . basename($_POST['leftBanner']);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
    $check = getimagesize($_FILES['leftBannerFile']['tmp_name']);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File bukan gambar.";
        $uploadOk = 0;
    }

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    echo "Format gambar yang dapat diupload hanya JPG, JPEG & PNG.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Gambar belum diupload.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["leftBannerFile"]["tmp_name"], $target_file)) {
    	mysql_query("UPDATE tb_image SET image = '".$target_file."' WHERE category = 'left banner'");
    	echo "Gambar berhasil diupload, silahkan ";
    } else {
        echo "Terjadi kesalahan saat upload gambar, gambar belum diupload.";
    }
}
}
?>
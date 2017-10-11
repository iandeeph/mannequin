<?php
$target_dir = "images/";
$queryContent = "SELECT * FROM tb_content WHERE id = 1";
$resultContent = mysqli_query($conn, $queryContent);
$rowContent = mysqli_fetch_array($resultContent);

$msgContent['content'] = "";

function imageUpload($path, $filesImage, $file, $field, $table, $target_dir, $conn)
{
	$msgContent['content'] = "";
	if($path != "" ) {
		$imageFile = $target_dir . basename($path);
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
			if (move_uploaded_file($filesImage["tmp_name"], "../".$imageFile)) {
				$delResultContent = mysqli_query($conn, "SELECT ".$field." FROM ".$table."");
				$delResult = mysqli_fetch_array($delResultContent);
				unlink("../".$delResult['image']);
				if(mysqli_query($conn, "UPDATE ".$table." SET ".$field." = '".$imageFile."'")){
				}else{
					$msgContent['content'] = "Error: ".mysqli_error($conn);
				}
			} else {
				$color = "red";
				$msgContent['content'] = "Terjadi kesalahan saat upload gambar, gambar belum diupload.";
			}
		}
	}else{
		$color = "red";
		$msgContent['content'] = "Gambar tidak boleh kosong..!!";
	}
	return $msgContent['content'];
}

if(isset($_POST["updateContent"])){
	$postHomeText = addslashes($_POST["homeText"]);
	//image1
	$postImagePath = addslashes($_POST["imagePath"]);
	$postImageName = addslashes($_POST["imageFile"]);
	$postImageFile = $_FILES["imageFile"];
	//image2
	$postImagePath2 = addslashes($_POST["imagePath2"]);
	$postImageName2 = addslashes($_POST["imageFile2"]);
	$postImageFile2 = $_FILES["imageFile2"];

	if(mysqli_query($conn, "UPDATE tb_content SET text = '".$postHomeText."' WHERE id = 1")){
	}else{
		$msgContent['content'] = "Error: ".mysqli_error($conn);
	}
	imageUpload($postImagePath, $postImageFile, $postImageName, "image", "tb_content", $target_dir, $conn);
	imageUpload($postImagePath2, $postImageFile2, $postImageName2, "image2", "tb_content", $target_dir, $conn);

	header("Location: ./index.php?menu=home");
}
?>
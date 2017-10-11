<?php
$target_dir = "images/";
function imageUpload($path, $tmp_name, $target_dir, $conn, $count)
{
	$msgContent['content'] = "";
	if($path != "" ) {
		$imageFile = $target_dir . basename($path);
		$imageUploadOK = 1;
		$imageFileType = pathinfo($imageFile,PATHINFO_EXTENSION);

		// Check if image file is a actual image or fake image
		$check = getimagesize($tmp_name);
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
			if (move_uploaded_file($tmp_name, "../".$imageFile)) {
				//idimg, image, category, label, sample
				if(mysqli_query($conn, "INSERT INTO tb_image (image, category, label) VALUES ('".$imageFile."', 'Collection', 'Mannequin Collection')")){
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

// SUBMIT NEW COLLECTION
if(isset($_POST["btnAddCollection"])){
	$postImageName = addslashes($_POST["imageFile"]);
	$postImageFile = $_FILES["imageFile"];

	//https://stackoverflow.com/questions/2704314/multiple-file-upload-in-php
	$count=0;
	foreach ($_FILES['collection']['name'] as $filename)
	{
		$path = $_FILES['collection']['name'][$count];
		$tmp_name = $_FILES['collection']['tmp_name'][$count];
		imageUpload($path, $tmp_name, $target_dir, $conn, $count);
		$count++;
	}

	header("Location: ./index.php?menu=collection");
}

// ==================================== BUTTON DELETE SUBMIT ===============================
    if(isset($_POST['btnDeleteCollection']) && isset($_POST['collection'])){
    	foreach ($_POST['collection'] as $coll) {
    		if(!empty($coll['checkboxCollection'])){
		        $delImagesBrandQry = "DELETE FROM tb_image WHERE idimg = '".$coll['checkboxCollection']."'";

		        if(mysqli_query($conn, $delImagesBrandQry)){
		            $unsetImagesBrandQry = "SELECT image FROM tb_image WHERE idimg ='".$coll['checkboxCollection']."'";

		            if($resultPathImages = mysqli_query($conn, $unsetImagesBrandQry)){
		                if(mysqli_num_rows($resultPathImages) > 0){
		                    $rowPathImagesBrand = mysqli_fetch_array($resultPathImages);
		                    $pathImagesBrand = $rowPathImagesBrand['path'];
		                    unlink("../".$pathImagesBrand);
		                    header('Location: ./index.php?menu=collection');
		                }
		            }else{
		                $postMessages = "ERROR: Could not able to execute ".$unsetImagesBrandQry.". " . mysqli_error($conn);
		                $colorMessages = "red-text";
		            }

		        }else{
		            $postMessages = "ERROR: Could not able to execute ".$delImagesBrandQry.". " . mysqli_error($conn);
		            $colorMessages = "red-text";
		        }	
    		}
    	}
    }

    // ==================================== BUTTON UPDATE SUBMIT ===============================
    if(isset($_POST['btnUpdateCollection']) && isset($_POST['collection'])){
    	foreach ($_POST['collection'] as $coll) {
    		if(!empty($coll['checkboxCollection']) || !empty($coll['description'])){
	    		$description 	= $coll['description'];
	    		$idimg  		= $coll['checkboxCollection'];

		        $updateCollQry = "UPDATE tb_image SET label = '".$description."' WHERE idimg = '".$idimg."'";

		        if(mysqli_query($conn, $updateCollQry)){
	 				$postMessages = "Upload Success";
	 				header('Location: ./index.php?menu=collection');
		        }else{
		            $postMessages = "ERROR: Could not able to execute ".$updateCollQry.". " . mysqli_error($conn);
		            $colorMessages = "red-text";
		        }
    		}
    	}
    }

?>
<div class="col s12" style="border-bottom: 1px solid #bcbcbc; margin-top:30px">
	<h5 class="center white-text">
		Adress Edit
	</h5>
</div>
<?php
$addressNumbring = 1;
$resultAdress = mysql_query("SELECT * FROM tb_addres");
while($rowAddress = mysql_fetch_array($resultAdress)){
	if(isset($_POST['updateAddress'.$addressNumbring])){
		$postTitle = addslashes($_POST["title".$addressNumbring]);
		$postlabel = addslashes($_POST["label".$addressNumbring]);
		$postId = addslashes($_POST["idAddress".$addressNumbring]);
		$addQuery = "UPDATE tb_addres SET title = '".$postTitle."', label = '".$postlabel."' WHERE idAddres = ".$postId."";
		if(mysql_query($addQuery)){
			header("Location: ./index.php?menu=edit#address");
		}else{
			echo "Error: ".mysql_error($conn);
		}
	}
?>
<div class="col s12" style="border-bottom: 1px solid #bcbcbc; margin-top:30px">
	<div class="col s1">
		<h5 class="center white-text">
			<?php echo $addressNumbring.".";?>
		</h5>
	</div>
	<div class="input-field col s11">
		<input value="<?php echo $rowAddress['title'];?>" id="<?php echo "title".$addressNumbring;?>" type="text" class="validate" name="<?php echo "title".$addressNumbring;?>">
		<label for="<?php echo "title".$addressNumbring;?>">Label Image</label>
	</div>
	<div class="input-field col offset-s1 s11">
		<textarea id="icon_prefix2" class="materialize-textarea" name="<?php echo "label".$addressNumbring;?>"><?php echo $rowAddress['label'];?></textarea>
		<label for="icon_prefix2">Detail Address</label>
	</div>
	<div class="col offset-s1 s11" style="margin-top:30px">
		<input type="hidden" name="<?php echo "idAddress".$addressNumbring;?>" value="<?php echo $rowAddress['idAddres'];?>">
		<button class="btn waves-effect waves-light amber" type="submit" name="<?php echo "updateAddress".$addressNumbring;?>">Submit
			<i class="material-icons right">send</i>
		</button>
	</div>
</div>
<?php
$addressNumbring++;
}
?>
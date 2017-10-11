<?php
include "../php/home.php";
?>
<div class="row">
	<form action="#" method="post" enctype="multipart/form-data">
		<div class="col s12 border-bottom grey lighten-2 mb-50">
			<h4 class="left-align">Welcome Note Editor</h4>
		</div>
		<div class="row">
			<div class="col s12 m6 l6">
				<div class="col s12 center" style="margin-top:30px">
					<img src="../<?php echo $rowContent['image'];?>" class="responsive-img valign">
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
			</div>
			<div class="col s12 m6 l6">
				<div class="col s12 center" style="margin-top:30px">
					<img src="../<?php echo $rowContent['image2'];?>" class="responsive-img valign">
				</div>
				<div class="file-field input-field col s12">
					<div class="btn tooltipped" data-position="top" data-delResultay="50" data-tooltip="Change About Mannequin Image...">
						<span>Change Image</span>
						<input type="file" name="imageFile2" id="imageFile2">
					</div>
					<div class="file-path-wrapper">
						<input class="file-path validate" type="text" name="imagePath2">
					</div>
				</div>
			</div>
		</div>
		<div class="row">
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
		</div>
		<div class="row">
			<div class="input-field col s12 <?php echo $color;?>-text">
			<?php
				echo $msgContent['content'];
			?>
			</div>
		</div>
	</form>
</div>
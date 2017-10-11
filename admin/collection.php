<?php
include '../php/collection.php';
?>
<div class="row">
	<div class="col s12 border-bottom grey lighten-2 mb-20">
		<h4 class="left-align">Collection Editor</h4>
	</div>
</div>
<div class="row">
    <div class="col s12">
        <span class="<?php echo $colorMessages;?>"><?php echo $postMessages;?></span>
    </div>
</div>
<form action="#" method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="col s12">
	        <a id="delSelectionCollection" href="#modalDelCollection" class="waves-effect waves-light btn red accent-4 disabled" disabled>
	        	<i class="material-icons left">delete</i>Delete
	        </a>
	        <button id="btnUpdateCollection" name="btnUpdateCollection" class="waves-effect waves-light btn blue darken-4 disabled" disabled>
	        	<i class="material-icons left">subdirectory_arrow_left</i>Update
	        </button>
	        <a href="#addCollection" class="modal-trigger btn-floating btn-large waves-effect waves-light green darken-4 right" title="Add more images">
	        	<i class="material-icons">add</i>
	        </a>
		</div>
	</div>
	<div class="row">
		<div class="col s12">
			<?php
	            $collQry = "";
	            $collQry = "SELECT * FROM tb_image WHERE category = 'collection' ORDER BY idimg DESC";
	            if($resultcollQry = mysqli_query($conn, $collQry)){
	                if(mysqli_num_rows($resultcollQry) > 0){
	                    while ($rowcollQry = mysqli_fetch_array($resultcollQry)) {
	                        $idimg	= $rowcollQry['idimg'];
	                        $path   = $rowcollQry['image'];
	                        $label  = $rowcollQry['label'];
					        ?>
							<div class="blockCollection col s6 m4 l3">
								<div class="col s12">
									<p>
										<input type="checkbox" name="collection[<?php echo $idimg ?>][checkboxCollection]" id="<?php echo $idimg ?>" value="<?php echo $idimg ?>" />
										<label for="<?php echo $idimg ?>"></label>
									</p>
								</div>
								<div class="col s12 center valign-wrapper responsive-img height-350">
									<div class="col s12">
										<img src="../<?php echo $path ?>" alt="Collection" class="responsive-img" width="250px">
									</div>
								</div>
								<div class="input-field col s12">
									<input name="collection[<?php echo $idimg ?>][description]" id="description<?php echo $idimg ?>" type="text" class="validate" value="<?php echo $label ?>">
									<label for="description"></label>
							    </div>
							</div>
							<?php
						}
					}
				}
			?>
		</div>
	</div>
	<!-- MODAL -->
	<div id="modalDelCollection" class="modal">
	    <div class="modal-content">
	        <h4>Deleting Confirmation</h4>
	        <h5>Are you sure want to delete selected item(s) ?</h5>
	    </div>
	    <div class="modal-footer col s12 mb-30">
	        <button type="submit" name="btnDeleteCollection" class="waves-effect waves-light btn green darken-4 right">Yes</button>
	        <a href="#!" class="modal-action modal-close waves-effect waves-light btn blue darken-4 right">Cancel</a>
	    </div>
	</div>
	<div id="addCollection" class="modal">
		<div class="modal-content">
			<div class="col s12">
				<h4>Add Collection(s)</h4>
			</div>
			<div class="col s12">
				<div class="file-field input-field">
					<div class="btn">
						<span>Upload</span>
						<input name="collection[]" type="file" multiple>
					</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text" placeholder="Upload one or more files">
				</div>
			</div>
		</div>
	    <div class="modal-footer col s12 mb-30">
	        <button type="submit" name="btnAddCollection" class="waves-effect waves-light btn green darken-4 right">Add Collection</button>
	        <a href="#!" class="modal-action modal-close waves-effect waves-light btn blue darken-4 right">Cancel</a>
	    </div>
	</div>
</form>
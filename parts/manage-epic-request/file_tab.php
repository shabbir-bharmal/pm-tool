</br>
<?php
if ($epic_files) { ?>
    <div class="form-row">
        <table class="table">
            <thead>
            <tr>
                <th>File Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr>
				<?php
				foreach ($epic_files as $file) { ?>
            <tr data-row_id="<?php echo $file['id']; ?>">
                <td>
                    <a href="<?php echo $file['e_fileurl']; ?>" target="_blank"><?php echo $file['e_filename']; ?></a>
                </td>
                <td>
                    <span class="download-file" title="Download File"> <a href="<?php echo $file['e_fileurl']; ?>" download><i class="fa fa-download mr-2" aria-hidden="true"></i></a></span>
                    <span class="delete_file" data-file_name="<?php echo $file['e_filename']; ?>" data-file_id="<?php echo $file['id']; ?>" title="Delete File"><i class="fa fa-trash"></i></span>
                </td>
            </tr>
			<?php }
      

			?>
            </tr>
            </tbody>
        </table>
    </div>
	<?php }else{ ?>
      
<div class="form-row">
    <div class="form-group col-12">
     <br/>keine Dateien vorhanden
    </div>
</div>    
<?php
}
?>
<?php if (empty($disabled)){ ?>
<div class="form-row">
    <div class="form-group col-12">
        <label for="e_file" class="col-form-label">Dateien:</label>
        <input type="file" name="e_file[]" id="file" class="form-control-file" multiple>
    </div>
</div>
<?php }?>
              
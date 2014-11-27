<?php include('header.php'); ?>

<div class="container main-content">
	<h2>Edit location</h2>

	<div class="row">
	
 		<div class="col-lg-8">
  			<?php echo form_open('plasmid_location/edit/' . $id . '/' . $plasmid_id); ?>
 			<div class="panel panel-default">

 				<div class="panel-heading">Information</div>
				<div class="panel-body">
					<?php echo form_label('Location', 'location', array( 'class' => 'col-sm-3 control-label')); ?>
          			<div class="col-sm-9"><?php echo form_dropdown('location', $locations, $plasmid_location->location_id, 'id="location" class="form-control"'); ?></div>
          			<?php echo form_label('Label', 'label', array( 'class' => 'col-sm-3 control-label'));?>
          			<div class="col-sm-9"><?php echo form_input('label', $plasmid_location->label, 'id="label" placeholder="Label" class="form-control"');?></div>
          			<?php echo form_label('Comment', 'comment', array( 'class' => 'col-sm-3 control-label'));?>
          			<div class="col-sm-9"><?php echo form_input('comment', $plasmid_location->comment, 'id="comment" placeholder="Comment" class="form-control"');?></div>
					<?php echo form_label('Storage type', 'storage', array( 'class' => 'col-sm-3 control-label')); ?>
          			<div class="col-sm-9"><?php echo form_dropdown('storage', $storage_types, $plasmid_location->storage_type, 'id="storage" class="form-control"'); ?></div>          			
          			</div>       						
				</div>

			<?php     		
          		$data = array(
    				'name' => 'submit',
    				'id' => 'submit',
    				'value' => 'true',
    				'type' => 'submit',
    				'content' => '<span class="glyphicon glyphicon-save"></span> Save changes',
    				'class' => 'btn btn-success'
				);
          		echo form_button($data); ?>
				<?php echo form_close(); ?>	
			</div>				 		

 		
 		<?php 
			require_once('help/help_template.php');
			quick_help('help_edit_plasmid_location.php');
		?>
 		</div>		
 	</div> 

   
</div>
<?php include('footer.php'); ?>
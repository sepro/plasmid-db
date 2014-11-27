<?php include('header.php'); ?>

<div class="container main-content">
	<h2>Add <?php echo $plasmid_name; ?> location</h2>

	<div class="row">
	
 		<div class="col-lg-8">
  			<?php echo form_open('plasmid_location/add/' . $plasmid_id); ?>
 			<div class="panel panel-default">

 				<div class="panel-heading">Information</div>
				<div class="panel-body">
					<?php echo form_label('Location', 'location', array( 'class' => 'col-sm-3 control-label')); ?>
          			<div class="col-sm-9"><?php echo form_dropdown('location', $locations, set_value('location'), 'id="location" class="form-control"'); ?></div>
          			<?php echo form_label('Label', 'label', array( 'class' => 'col-sm-3 control-label'));?>
          			<div class="col-sm-9"><?php echo form_input('label', $plasmid_id, 'id="label" placeholder="Label" class="form-control"');?></div>
          			<?php echo form_label('Comment', 'comment', array( 'class' => 'col-sm-3 control-label'));?>
          			<div class="col-sm-9"><?php echo form_input('comment', set_value('comment'), 'id="comment" placeholder="Comment" class="form-control"');?></div>
					<?php echo form_label('Storage type', 'storage', array( 'class' => 'col-sm-3 control-label')); ?>
          			<div class="col-sm-9"><?php echo form_dropdown('storage', $storage_types, set_value('storage'), 'id="storage" class="form-control"'); ?></div>          			
          			</div>       						
				</div>

			<?php     		
          		$data = array(
    				'name' => 'submit',
    				'id' => 'submit',
    				'value' => 'true',
    				'type' => 'submit',
    				'content' => '<span class="glyphicon glyphicon-plus"></span> Add location',
    				'class' => 'btn btn-success'
				);
          		echo form_button($data); ?>
				<?php echo form_close(); ?>	
			</div>				 		

 		
		<?php 
			require_once('help/help_template.php');
			quick_help('help_add_plasmid_location.php');
		?>
 		</div>		
 	</div> 

   
</div>
<?php include('footer.php'); ?>
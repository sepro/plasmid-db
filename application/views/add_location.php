<?php include('header.php'); ?>

<div class="container main-content">
	<h2>Add location</h2>
	<div class="row">
	
 		<div class="col-lg-8">
  			<?php echo form_open('location/add'); ?>
 			<div class="panel panel-default">

 				<div class="panel-heading">Information</div>
				<div class="panel-body">
          			<?php echo form_label('Building', 'building', array( 'class' => 'col-sm-3 control-label'));?>
          			<div class="col-sm-9"><?php echo form_input('building', set_value('building'), 'id="building" placeholder="Building" class="form-control"');?></div>
           			<?php echo form_label('Room', 'room', array( 'class' => 'col-sm-3 control-label'));?>
          			<div class="col-sm-9"><?php echo form_input('room', set_value('room'), 'id="room" placeholder="Room" class="form-control"');?></div>         			
					<?php echo form_label('Address', 'address', array( 'class' => 'col-sm-12 control-label')); ?>
          			<div class="col-sm-12"><?php echo form_textarea('address', set_value('address'), 'id="address" placeholder="Address" class="form-control"'); ?></div>
          				
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
			quick_help('help_add_location.php');
		?>
 		</div>		
 	</div> 

   
</div>
<?php include('footer.php'); ?>
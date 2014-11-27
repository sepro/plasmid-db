<?php include('header.php'); ?>

<div class="container main-content">
	<h2>Edit location</h2>
	<div class="row">
	
 		<div class="col-lg-8">
  			<?php echo form_open('location/edit/' . $location_id); ?>
 			<div class="panel panel-default">

 				<div class="panel-heading">Information</div>
				<div class="panel-body">
					<?php
						if (set_value('building') !== '')
						{
							$location->building = set_value('building');
						}
						if (set_value('room') !== '')
						{
							$location->room = set_value('room');
						}
						if (set_value('address') !== '')
						{
							$location->address = set_value('address');
						}
					?>
				
				
          			<?php echo form_label('Building', 'building', array( 'class' => 'col-sm-3 control-label'));?>
          			<div class="col-sm-9"><?php echo form_input('building', $location->building, 'id="building" placeholder="Building" class="form-control"');?></div>
           			<?php echo form_label('Room', 'room', array( 'class' => 'col-sm-3 control-label'));?>
          			<div class="col-sm-9"><?php echo form_input('room', $location->room, 'id="room" placeholder="Room" class="form-control"');?></div>         			
					<?php echo form_label('Address', 'address', array( 'class' => 'col-sm-12 control-label')); ?>
          			<div class="col-sm-12"><?php echo form_textarea('address', $location->address, 'id="address" placeholder="Address" class="form-control"'); ?></div>
          				
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
			quick_help('help_edit_location.php');
		?>
 		</div>		
 	</div> 

   
</div>
<?php include('footer.php'); ?>
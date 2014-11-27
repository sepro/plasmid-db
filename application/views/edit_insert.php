<?php include('header.php'); ?>

<div class="container main-content">
	<h2>Edit insert</h2>
	<div class="row">
	
 		<div class="col-lg-8">
  			<?php echo form_open('insert/edit/' . $insert_id); ?>
 			<div class="panel panel-default">

 				<div class="panel-heading">Information</div>
				<div class="panel-body">
					<?php
						if (set_value('name') !== '')
						{
							$insert->name = set_value('name');
						}
						if (set_value('comment') !== '')
						{
							$insert->comment = set_value('comment');
						}
						if (set_value('sequence') !== '')
						{
							$insert->sequence = set_value('sequence');
						}
					?>
				
				
          			<?php echo form_label('Name', 'name', array( 'class' => 'col-sm-3 control-label'));?>
          			<div class="col-sm-9"><?php echo form_input('name', $insert->name, 'id="name" placeholder="Name" class="form-control"');?></div>
           			<?php echo form_label('Comment', 'comment', array( 'class' => 'col-sm-3 control-label'));?>
          			<div class="col-sm-9"><?php echo form_input('comment', $insert->comment, 'id="comment" placeholder="Comment" class="form-control"');?></div>         			
					<?php echo form_label('Sequence', 'sequence', array( 'class' => 'col-sm-12 control-label')); ?>
          			<div class="col-sm-12"><?php echo form_textarea('sequence', $insert->sequence, 'id="sequence" placeholder="Address" class="form-control"'); ?></div>
          				
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
			quick_help('help_edit_insert.php');
		?>
 		</div>		
 	</div> 

   
</div>
<?php include('footer.php'); ?>
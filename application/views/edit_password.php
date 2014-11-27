<?php include('header.php'); ?>

<div class="container main-content">
	<h2>Change password</h2>
	<div class="row">
	
 		<div class="col-lg-8">
  			<?php echo form_open('password/change'); ?>
 			<div class="panel panel-default">

 				<div class="panel-heading">Change password ?</div>
				<div class="panel-body">
          			<?php echo form_label('Old password', 'password', array( 'class' => 'col-sm-3 control-label'));?>
          			<div class="col-sm-9"><?php echo form_password('password', '', 'id="password" class="form-control"');?></div>

          			<?php echo form_label('New password', 'new', array( 'class' => 'col-sm-3 control-label'));?>
          			<div class="col-sm-9"><?php echo form_password('new', '', 'id="new" class="form-control"');?></div>
          			
          			<?php echo form_label('Confirm new password', 'confirm', array( 'class' => 'col-sm-3 control-label'));?>
          			<div class="col-sm-9"><?php echo form_password('confirm', '', 'id="confirm" class="form-control"');?></div>
	
          			</div>       						
				</div>

			<?php     		
          		$data = array(
    				'name' => 'submit',
    				'id' => 'submit',
    				'value' => 'true',
    				'type' => 'submit',
    				'content' => '<span class="glyphicon glyphicon-save"></span> Change password',
    				'class' => 'btn btn-success'
				);
          		echo form_button($data); ?>
				<?php echo form_close(); ?>	
			</div>				 		

 		
 				<?php 
			require_once('help/help_template.php');
			quick_help('help_edit_password.php');
		?>
 		</div>		
 	</div> 

   
</div>
<?php include('footer.php'); ?>
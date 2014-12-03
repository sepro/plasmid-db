<?php include('header.php'); ?>

<div class="container main-content">
	<h2>Forgot your username or password?</h2>
	<div class="row">
	
 		<div class="col-lg-8">
  			<?php echo form_open('forgot/userpass'); ?>
 			<div class="panel panel-default">

 				<div class="panel-heading">Enter your e-mail address to recover your username or reset the password.</div>
				<div class="panel-body">
          			<?php echo form_label('E-mail address', 'email', array( 'class' => 'col-sm-3 control-label'));?>
          			<div class="col-sm-9"><?php echo form_input('email', '', 'id="email" class="form-control"');?></div>
          			</div>       						
				</div>

			<?php     		
          		$data = array(
    				'name' => 'submit',
    				'id' => 'submit',
    				'value' => 'username',
    				'type' => 'submit',
    				'content' => '<span class="glyphicon glyphicon-send"></span> Send username',
    				'class' => 'btn btn-success'
				);
          		echo form_button($data);
          	?> <?php
          		$data = array(
    				'name' => 'submit',
    				'id' => 'submit',
    				'value' => 'password',
    				'type' => 'submit',
    				'content' => 'Reset password',
    				'class' => 'btn btn-success'
				);
          		echo form_button($data); ?>
				<?php echo form_close(); ?>	
			</div>				 		

 		
 				<?php 
			require_once('help/help_template.php');
			quick_help('help_forgot.php');
		?>
 		</div>		
 	</div> 

   
</div>
<?php include('footer.php'); ?>
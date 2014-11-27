<?php include('header.php'); ?>

    <div class="container main-content">
    <h2>Registration</h2>
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-lg-8">
  			<?php echo form_open('register'); ?>
 			<div class="panel panel-default">

 				<div class="panel-heading">Enter your credentials below</div>
				<div class="panel-body">
				<div class="form-group">
          		<?php echo form_label('Username', 'username', array( 'class' => 'col-sm-3 control-label'));?>
          		<div class="col-sm-9"><?php echo form_input('username', set_value('username'), 'id="username" placeholder="Username" class="form-control"');?></div></div>			

				<div class="form-group">
          		<?php echo form_label('First name', 'first name', array( 'class' => 'col-sm-3 control-label'));?>
          		<div class="col-sm-9"><?php echo form_input('first_name', set_value('first_name'), 'id="first_name" placeholder="First name" class="form-control"');?></div></div>
          		
          		<div class="form-group">
          		<?php echo form_label('Last name', 'last name', array( 'class' => 'col-sm-3 control-label'));?>
          		<div class="col-sm-9"><?php echo form_input('last_name', set_value('last_name'), 'id="last_name" placeholder="Last name" class="form-control"');?></div></div>
          		
          		<div class="form-group">
          		<?php echo form_label('E-mail address', 'email', array( 'class' => 'col-sm-3 control-label'));?>
          		<div class="col-sm-9"><?php echo form_input('email', set_value('email'), 'id="email" placeholder="E-mail" class="form-control"');?></div></div>

          		<div class="form-group">
          		<?php echo form_label('Phone number', 'phone', array( 'class' => 'col-sm-3 control-label'));?>
          		<div class="col-sm-9"><?php echo form_input('phone', set_value('phone'), 'id="phone" placeholder="Phone number" class="form-control"');?></div></div>
          		
          		<div class="form-group">
          		<?php echo form_label('Password', 'password', array( 'class' => 'col-sm-3 control-label'));?>
          		<div class="col-sm-3"><?php echo form_password('password', set_value('password'), 'id="password" class="form-control"');?></div>
          		<?php echo form_label('Confirm', 'confirm', array( 'class' => 'col-sm-3 control-label'));?>
          		<div class="col-sm-3"><?php echo form_password('confirm', set_value('confirm'), 'id="confirm" class="form-control"');?></div></div>
          		
  				<?php echo form_label('Location', 'location', array( 'class' => 'col-sm-3 control-label')); ?>
          		<div class="col-sm-9"><?php echo form_dropdown('location', $locations, set_value('location'), 'id="location" class="form-control"'); ?></div>        		          		
 
				</div>
			</div>
			<?php     		
          		$data = array(
    				'name' => 'submit',
    				'id' => 'submit',
    				'value' => 'true',
    				'type' => 'submit',
    				'content' => '<span class="glyphicon glyphicon-ok"></span> Sign Up',
    				'class' => 'btn btn-success'
				);
          		echo form_button($data); ?>
			<?php echo form_close(); ?>
        </div>
        
		<?php 
			require_once('help/help_template.php');
			quick_help('help_registration.php');
		?>
      </div>
	</div>
<?php include('footer.php'); ?>
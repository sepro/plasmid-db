<?php include('header.php'); ?>

    <div class="container main-content">
    <h2>Edit user</h2>
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-lg-8">
  			<?php echo form_open('user/edit/' . $user->username); ?>
 			<div class="panel panel-default">

 				<div class="panel-heading">Change user credentials</div>
				<div class="panel-body">
					<?php
						if (set_value('first_name') !== '')
						{
							$user->first_name = set_value('first_name');
						}
						if (set_value('last_name') !== '')
						{
							$user->last_name = set_value('last_name');
						}
						if (set_value('email') !== '')
						{
							$user->email = set_value('phone');
						}
						if (set_value('phone') !== '')
						{
							$user->phones = set_value('email');
						}
						if (set_value('location') !== '')
						{
							$user->location = set_value('location');
						}
						if (set_value('account') !== '')
						{
							$user->account = set_value('account');
						}
					?>

				<div class="form-group">
          		<?php echo form_label('First name', 'first name', array( 'class' => 'col-sm-3 control-label'));?>
          		<div class="col-sm-9"><?php echo form_input('first_name', $user->first_name, 'id="first_name" placeholder="First name" class="form-control"');?></div></div>
          		
          		<div class="form-group">
          		<?php echo form_label('Last name', 'last name', array( 'class' => 'col-sm-3 control-label'));?>
          		<div class="col-sm-9"><?php echo form_input('last_name', $user->last_name, 'id="last_name" placeholder="Last name" class="form-control"');?></div></div>
          		
          		<div class="form-group">
          		<?php echo form_label('E-mail address', 'email', array( 'class' => 'col-sm-3 control-label'));?>
          		<div class="col-sm-9"><?php echo form_input('email', $user->email, 'id="email" placeholder="E-mail" class="form-control"');?></div></div>

          		<div class="form-group">
          		<?php echo form_label('Phone number', 'phone', array( 'class' => 'col-sm-3 control-label'));?>
          		<div class="col-sm-9"><?php echo form_input('phone', $user->phone, 'id="phone" placeholder="Phone number" class="form-control"');?></div></div>
          		
          		
  				<?php echo form_label('Location', 'location', array( 'class' => 'col-sm-3 control-label')); ?>
          		<div class="col-sm-9"><?php echo form_dropdown('location', $locations, $user->location, 'id="location" class="form-control"'); ?></div>        		          	
          		
          		
          		<?php echo form_label('Account', 'account', array( 'class' => 'col-sm-3 control-label')); ?>
          		<?php if ($_SESSION['account'] == 'admin') { ?>
          		<div class="col-sm-9"><?php echo form_dropdown('account', array ('pending' => "Pending", 'guest' => "Guest", 'user' => "User", 'admin' => "Admin"), $user->account, 'id="location" class="form-control"'); ?></div> <?php } else { ?>
          		<div class="col-sm-9"><?php echo form_dropdown('account', array ('pending' => "Pending", 'guest' => "Guest", 'user' => "User", 'admin' => "Admin"), $user->account, 'id="location" class="form-control" disabled="disabled"'); ?></div>					
          		<input type="hidden" name="account" value="<?php echo $user->account;?>" />
				<?php } ?>
          			
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
			quick_help('help_edit_user.php');
		?>
      </div>
	</div>
<?php include('footer.php'); ?>
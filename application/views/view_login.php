<?php include('header.php'); ?>



    <div class="container main-content">
    <h2>Plasmid DB</h2>
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-lg-8">
          <h4>Intoduction</h4>
          <p>This is the very first version of Plasmid DB, you can do absolutely nothing without logging in first! Fill in your credentials on the right or <a href="<?php echo base_url(); ?>register">register</a> for an account.</p>
        </div>
        
        <div class="col-lg-4">
        <div class="panel panel-primary">
          <div class="panel-heading">Login</div>
          <div class="panel-body">
          	<?php echo form_open('login'); ?>
          	<p>
          		<?php
          			echo form_label('Username', 'username');
          			echo form_input('username', set_value('username'), 'id="username" placeholder="Username" class="form-control"');
          		?>
          	</p><p>
          		<?php
          			echo form_label('Password', 'password');
          			echo form_password('password', '', 'id="password" placeholder="Password" class="form-control"');
          		?>
          	</p>
          	<p>
          		<?php 
          		
          		$data = array(
    				'name' => 'submit',
    				'id' => 'submit',
    				'value' => 'true',
    				'type' => 'submit',
    				'content' => '<span class="glyphicon glyphicon-log-in"></span> Login',
    				'class' => 'btn btn-success'
				);
          		echo form_button($data); ?> <a href="<?php echo base_url(); ?>register" class="btn btn-default">Register</a>
          	</p>
          	<?php echo form_close(); ?>
          	</div>
          	
          </div>
        </div>
      </div>
	</div>
<?php include('footer.php'); ?>
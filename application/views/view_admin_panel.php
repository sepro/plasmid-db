<?php include('header.php'); ?>

<div class="container main-content">
	<h2>Admin Panel</h2>
	
	<div class="row">
 		<div class="col-lg-8">
	  	  <ul class="nav nav-tabs">
  			<li class="active"><a href="#users" data-toggle="tab">Users</a></li>
  			<li><a href="#plasmids" data-toggle="tab">Plasmids</a></li>
  			<li><a href="#options" data-toggle="tab">Options</a></li>
  			<li><a href="#export" data-toggle="tab">Import/Export</a></li>
		  </ul>
		  
		  <div class="tab-content">
  			<div class="tab-pane active" id="users">
  				<div class="col-lg-12" style="padding-bottom:15px;">
  				<h3>Transfer Plasmids <br /><small>(Transfer all plasmids from one user to another)</small></h3>
  					<?php echo form_open('admin/transfer_plasmids'); ?>
   					<div class="row">  				
  				    <?php echo form_label('From', 'original_user', array( 'class' => 'col-sm-3 control-label')); ?>
          			<div class="col-sm-9"><?php 
          				if (set_value('original_user') !== '')
          				{
							echo form_dropdown('original_user', $users, set_value('original_user'), 'id="original_user" class="form-control"');
						} else {
							echo form_dropdown('original_user', $users, $_SESSION['userid'], 'id="original_user" class="form-control"');	
						}?>
  					</div>
   				    <?php echo form_label('To', 'new_user', array( 'class' => 'col-sm-3 control-label')); ?>
          			<div class="col-sm-9"><?php 
          				if (set_value('new_user') !== '')
          				{
							echo form_dropdown('new_user', $users, set_value('new_user'), 'id="new_user" class="form-control"');
						} else {
							echo form_dropdown('new_user', $users, $_SESSION['userid'], 'id="new_user" class="form-control"');	
						}?>
  					</div>
  					</div>
  				<br />
   					<?php     		
          				$data = array(
    						'name' => 'submit',
    						'id' => 'submit',
    						'value' => 'true',
    						'type' => 'submit',
    						'content' => '<span class="glyphicon glyphicon-transfer"></span> Transfer Plasmids',
    						'class' => 'btn btn-success'
						);
          		echo form_button($data);
          		echo form_close(); ?>
  				</div>
  			</div>
  			
  			<div class="tab-pane" id="plasmids">
   				<div class="col-lg-12">
  					<h3>Transfer Plasmids Location <br /><small>(Change the location of plasmids in bulk)</small></h3>
  					
  					<?php echo form_open('admin/transfer_plasmids_location'); ?>
   					<div class="row">  				
  				    <?php echo form_label('From', 'original_location', array( 'class' => 'col-sm-3 control-label')); ?>
          			<div class="col-sm-9"><?php 
          				if (set_value('original_location') !== '')
          				{
							echo form_dropdown('original_location', $locations, set_value('original_location'), 'id="original_location" class="form-control"');
						} else {
							echo form_dropdown('original_location', $locations, key($locations), 'id="original_location" class="form-control"');	
						}?>
  					</div>
   				    <?php echo form_label('To', 'new_location', array( 'class' => 'col-sm-3 control-label')); ?>
          			<div class="col-sm-9"><?php 
          				if (set_value('new_location') !== '')
          				{
							echo form_dropdown('new_location', $locations, set_value('new_location'), 'id="new_location" class="form-control"');
						} else {
							echo form_dropdown('new_location', $locations, key($locations), 'id="new_location" class="form-control"');	
						}?>
  					</div>
  					</div>
  				<br />
   					<?php     		
          				$data = array(
    						'name' => 'submit',
    						'id' => 'submit',
    						'value' => 'true',
    						'type' => 'submit',
    						'content' => '<span class="glyphicon glyphicon-transfer"></span> Transfer Plasmids',
    						'class' => 'btn btn-success'
						);
          		echo form_button($data);
          		echo form_close(); ?>	
          		</div>	
  			</div>

  			<div class="tab-pane" id="options">
  				<div class="col-lg-12">
  					<h3>Available options <br /><small>(Set the possible values of fields)</small></h3>
  				
  					<?php if ($options != false) { ?>
					<table class="sortable table table-condensed table-hover table-striped">
					<thead>
						<tr>
							<th>Type</th>
							<th>Value</th>
							<th class="sorttable_nosort">Actions</th>
						</tr>
					</thead>
					<tbody>
					<?php	foreach($options as $option) { ?>
					<tr>
						<td><?php echo $option->option_name;?></td>
						<td><?php echo $option->possible_value;?></td>
						<td>
							<!-- <a href="<?php echo base_url(); ?>admin/edit_option/<?php echo $option->id;?>"><span class="glyphicon glyphicon-edit"></span></a> -->
							<a href="<?php echo base_url(); ?>admin/delete_option/<?php echo $option->id;?>"><span class="glyphicon glyphicon-trash"></span></a>	
						</td>
					</tr>
					<?php } ?>
					</tbody>
					</table>
					<?php } else { ?>
						<p>No options set in the database !</p>
					<?php }?>
  				
  					<h3>Add option</h3>

  					<?php echo form_open('admin/add_option'); ?>
   					<div class="row"> 					
  					<?php echo form_label('Option Type', 'option_name', array( 'class' => 'col-sm-3 control-label')); ?>
          				<div class="col-sm-9"><?php
          					$option_names = array(	"bacterial_resistance" => "bacterial_resistance", 
          											"plant_resistance" => "plant_resistance",
          											"storage_type" => "storage_type", 
          											"vector_type" => "vector_type");
          	          		if (set_value('option_name') == '') {			
								echo form_dropdown('option_name', $option_names, 'bacterial_resistance', 'id="option_name" class="form-control"');
							} else {
								echo form_dropdown('option_name', $option_names, set_value('option_name'), 'id="option_name" class="form-control"');
							}
          			?></div>
  					
  				<?php echo form_label('Option Value', 'option_value', array( 'class' => 'col-sm-3 control-label'));?>
          		<div class="col-sm-9"><?php echo form_input('option_value', set_value('option_value'), 'id="option_value" placeholder="Value" class="form-control"');?></div>

  				</div>
  				<br />
   					<?php     		
          				$data = array(
    						'name' => 'submit',
    						'id' => 'submit',
    						'value' => 'true',
    						'type' => 'submit',
    						'content' => '<span class="glyphicon glyphicon-plus"></span> Add Option',
    						'class' => 'btn btn-success'
						);
          		echo form_button($data);
          		echo form_close(); ?>	
  				</div>
  			</div>
  			
  			<div class="tab-pane" id="export">
  				<div class="col-lg-12" style="padding-bottom:15px;">
  					<h3>Export Database <br /><small>(Create a local backup of the database)</small></h3>
  					<a href="<?php echo base_url(); ?>admin/export_database/"class="btn btn-primary"><span class="glyphicon glyphicon-export"></span> Export DB</a>
  					<h3>Import from file <br /><small>(Upload a local file with plasmid information to the database)</small></h3>
  					<?php 
  						echo form_open_multipart('admin/import_database');
  						echo form_upload('userfile'); 
  					?>
  					<br />
  					<?php     		
          				$data = array(
    						'name' => 'submit',
   			 				'id' => 'submit',
    						'value' => 'true',
    						'type' => 'submit',
    						'content' => '<span class="glyphicon glyphicon-import"></span> Import DB',
    						'class' => 'btn btn-primary'
						);
          				echo form_button($data);
          				echo form_close(); 
          			?>	
  				</div>
  			</div>
  			
		  </div>
		</div>
        
		<?php 
			require_once('help/help_template.php');
			quick_help('help_admin_panel.php');
		?>
	</div>
</div>

<?php include('footer.php'); ?>
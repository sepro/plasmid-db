<?php include('header.php'); ?>

<div class="container main-content">
	<h2>Add plasmid</h2>

	<div class="row">
 		<div class="col-lg-8">
  			<?php echo form_open('plasmid/add'); ?>
 			<div class="panel panel-default">

 				<div class="panel-heading">Information</div>
				<div class="panel-body">
				

          		<?php echo form_label('Plasmid name', 'name', array( 'class' => 'col-sm-3 control-label'));?>
          		<div class="col-sm-9"><?php echo form_input('name', set_value('name'), 'id="name" placeholder="Name" class="form-control"');?></div>
          			
          		<?php echo form_label('Creator', 'creator', array( 'class' => 'col-sm-3 control-label')); ?>
          		<div class="col-sm-9"><?php 
          		
          		if ($_SESSION['account'] == 'admin')
          		{
          			//only admins can create for other users
          			if (set_value('creator') !== '')
          			{
						echo form_dropdown('creator', $users, set_value('creator'), 'id="creator" class="form-control"');
					} else {
						echo form_dropdown('creator', $users, $_SESSION['userid'], 'id="creator" class="form-control"');	
					}
					
				} else {
					//disabled box for other users + hidden type to set value
					echo form_dropdown('creator', $users, $_SESSION['userid'], 'id="creator" class="form-control" disabled="disabled"');?>
				<input type="hidden" name="creator" value="<?php echo $_SESSION['userid'];?>" />	
				<?php } ?></div>

				<?php echo form_label('Empty vectory?', 'is_vector', array( 'class' => 'col-sm-3 control-label')); ?>
				<div class="col-sm-3"><?php 
				$data = array(
							    'name'        => 'is_vector',
							    'id'          => 'is_vector',
							    'value'       => '1',
							    'checked'     => FALSE,
								    );		
								    		
				if (set_value('is_vector') == 1) {
					$data['checked'] = TRUE;			
				}


				echo form_checkbox($data); ?></div>
				<?php echo form_label('Backbone', 'backbone', array( 'class' => 'col-sm-3 control-label')); ?>
          		<div class="col-sm-3"><?php $backbones[0] = 'None'; 
          		
          		if (set_value('backbone') == ''){
					echo form_dropdown('backbone', $backbones, '0', 'id="backbone" class="form-control"'); 
				} else {
					echo form_dropdown('backbone', $backbones, set_value('backbone'), 'id="backbone" class="form-control"'); 
				}
          		
          		
          		?></div>


          		<?php echo form_label('Publication', 'publication', array( 'class' => 'col-sm-3 control-label')); ?>
          		<div class="col-sm-9"><?php echo form_input('publication', set_value('publication'), 'id="publication" placeholder="Pubmed ID" class="form-control"'); ?></div>
          		<?php echo form_label('Website', 'website', array( 'class' => 'col-sm-3 control-label')); ?>
          		<div class="col-sm-9"><?php echo form_input('website', set_value('website'), 'id="website" placeholder="http://www..." class="form-control"'); ?></div>


          		<?php echo form_label('Vector type', 'v_type', array( 'class' => 'col-sm-3 control-label')); ?>
          		<div class="col-sm-9"><?php echo form_dropdown('v_type', $v_type, set_value('v_type'), 'id="v_type" class="form-control"'); ?></div>

          		<?php echo form_label('Bacterial resistance', 'b_res', array( 'class' => 'col-sm-3 control-label')); ?>
          		<div class="col-sm-3"><?php 
          		
          		if (set_value('b_res') == '') {			
					echo form_dropdown('b_res', $b_res, 'None', 'id="b_res" class="form-control"');
				} else {
					echo form_dropdown('b_res', $b_res, set_value('b_res'), 'id="b_res" class="form-control"');
				}
          		
          		 ?></div>

          		<?php echo form_label('Plant resistance', 'p_res', array( 'class' => 'col-sm-3 control-label')); ?>
          		<div class="col-sm-3"><?php

          		if(set_value('p_res') == '') {
					echo form_dropdown('p_res', $p_res, 'None', 'id="p_res" class="form-control"');
				} else {
					echo form_dropdown('p_res', $p_res, set_value('p_res'), 'id="p_res" class="form-control"');
				} ?></div>

          		<?php echo form_label('Description', 'description', array( 'class' => 'col-sm-12 control-label')); ?>
          		<div class="col-sm-12"><?php echo form_textarea('description', set_value('description'), 'id="description" placeholder="Description" class="form-control"'); ?></div>
				
				</div>
		
 			</div>
				<?php     		
          		$data = array(
    				'name' => 'submit',
    				'id' => 'submit',
    				'value' => 'true',
    				'type' => 'submit',
    				'content' => '<span class="glyphicon glyphicon-plus"></span> Add plasmid',
    				'class' => 'btn btn-success'
				);
          		echo form_button($data); ?>
				<?php echo form_close(); ?>	
 		
 		</div>
 		
 		
		<?php 
			require_once('help/help_template.php');
			quick_help('help_add_plasmid.php');
		?>
 		
 	</div>	
</div>

<?php include('footer.php'); ?>
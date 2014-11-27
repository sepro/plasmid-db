<?php include('header.php'); ?>

<div class="container main-content">
	<h2>Edit plasmid: <?php echo $plasmid->name; ?></h2>

	<div class="row">
 		<div class="col-lg-8">
  			<?php echo form_open('plasmid/edit/' . $plasmid->plasmid_id); ?>
 			<div class="panel panel-default">

 				<div class="panel-heading">Information</div>
				<div class="panel-body">
				<?php
					if (set_value('creator') !== '')
					{
						$plasmid->creator = set_value('creator');
					}
					if (set_value('is_vector') !== '')
					{
						$plasmid->is_backbone = set_value('is_vector');
					}
					if (set_value('backbone') !== '')
					{
						$plasmid->backbone = set_value('backbone');
					}
					if (set_value('publication') !== '')
					{
						$plasmid->pubmed_id = set_value('publication');
					}
					if (set_value('website') !== '')
					{
						$plasmid->website = set_value('website');
					}
					if (set_value('description') !== '')
					{
						$plasmid->description = set_value('description');
					}

					if (set_value('v_type') !== '')
					{
						$plasmid->vector_type = set_value('v_type');
					}
					if (set_value('b_res') !== '')
					{
						$plasmid->bacterial_resistance = set_value('b_res');
					}
					if (set_value('p_res') !== '')
					{
						$plasmid->plant_resistance = set_value('p_res');
					}
				?>

          		<?php echo form_label('Plasmid name', 'name', array( 'class' => 'col-sm-3 control-label'));?>
          		<div class="col-sm-9"><?php echo form_input('name', $plasmid->name, 'id="name" placeholder="Name" class="form-control" disabled="disabled"');?></div>
          		<input type="hidden" name="name" value="<?php echo $plasmid->name;?>" />
          		<?php echo form_label('Creator', 'creator', array( 'class' => 'col-sm-3 control-label')); ?>
          		<div class="col-sm-9"><?php 
          		
          		if ($_SESSION['account'] == 'admin')
          		{
          			//only admins can create for other users
					echo form_dropdown('creator', $users, $plasmid->creator, 'id="creator" class="form-control"');
				} else {
					//disabled box for other users + hidden type to set value
					echo form_dropdown('creator', $users, $plasmid->creator, 'id="creator" class="form-control" disabled="disabled"');?>
				<input type="hidden" name="creator" value="<?php echo $plasmid->creator;?>" />	
				<?php } ?></div>

				<?php echo form_label('Empty vectory?', 'is_vector', array( 'class' => 'col-sm-3 control-label')); ?>
				<div class="col-sm-3"><?php $data = array(
							    'name'        => 'is_vector',
							    'id'          => 'is_vector',
							    'value'       => '1',
							    'checked'     => (bool)$plasmid->is_backbone,
								    );

				echo form_checkbox($data); ?></div>
				<?php echo form_label('Backbone', 'backbone', array( 'class' => 'col-sm-3 control-label')); ?>
          		<div class="col-sm-3"><?php $backbones[0] = 'None'; echo form_dropdown('backbone', $backbones, $plasmid->backbone, 'id="backbone" class="form-control"'); ?></div>


          		<?php echo form_label('Publication', 'publication', array( 'class' => 'col-sm-3 control-label')); ?>
          		<div class="col-sm-9"><?php echo form_input('publication', $plasmid->pubmed_id, 'id="publication" placeholder="Pubmed ID" class="form-control"'); ?></div>
          		<?php echo form_label('Website', 'website', array( 'class' => 'col-sm-3 control-label')); ?>
          		<div class="col-sm-9"><?php echo form_input('website',$plasmid->website, 'id="website" placeholder="http://www..." class="form-control"'); ?></div>


          		<?php echo form_label('Vector type', 'v_type', array( 'class' => 'col-sm-3 control-label')); ?>
          		<div class="col-sm-9"><?php echo form_dropdown('v_type', $v_type, $plasmid->vector_type, 'id="v_type" class="form-control"'); ?></div>

          		<?php echo form_label('Bacterial resistance', 'b_res', array( 'class' => 'col-sm-3 control-label')); ?>
          		<div class="col-sm-3"><?php echo form_dropdown('b_res', $b_res, $plasmid->bacterial_resistance, 'id="b_res" class="form-control"'); ?></div>

          		<?php echo form_label('Plant resistance', 'p_res', array( 'class' => 'col-sm-3 control-label')); ?>
          		<div class="col-sm-3"><?php echo form_dropdown('p_res', $p_res,  $plasmid->plant_resistance, 'id="p_res" class="form-control"'); ?></div>

          		<?php echo form_label('Description', 'description', array( 'class' => 'col-sm-12 control-label')); ?>
          		<div class="col-sm-12"><?php echo form_textarea('description', $plasmid->description, 'id="description" placeholder="Description" class="form-control"'); ?></div>
				
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
			quick_help('help_edit_plasmid.php');
		?>
 		
 	</div>	
</div>

<?php include('footer.php'); ?>
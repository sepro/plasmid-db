<?php include('header.php'); ?>

<div class="container main-content">
	<h2>Add Vector Map</h2>

	<div class="row">
 		<div class="col-lg-8">
  			<?php echo form_open_multipart('plasmid/addvectormap/' . $plasmid_id); ?>
 			<div class="panel panel-default">

 				<div class="panel-heading">Upload new vector map</div>
				<div class="panel-body">
				
				<?php echo form_upload('userfile'); ?>
				
				
				</div>
		
 			</div>
				<?php     		
          		$data = array(
    				'name' => 'submit',
    				'id' => 'submit',
    				'value' => 'true',
    				'type' => 'submit',
    				'content' => '<span class="glyphicon glyphicon-upload"></span> Upload vector map',
    				'class' => 'btn btn-success'
				);
          		echo form_button($data); ?>
				<?php echo form_close(); ?>	
 		
 		</div>
 		
 		
		<?php 
			require_once('help/help_template.php');
			quick_help('help_add_vectormap.php');
		?>
 		
 	</div>	
</div>

<?php include('footer.php'); ?>
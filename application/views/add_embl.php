<?php include('header.php'); ?>

<div class="container main-content">
	<h2>Add EMBL file to plasmid: <?php echo $plasmid->name; ?></h2>
	<div class="row">
 		<div class="col-lg-8">
  			<?php echo form_open_multipart('plasmid/add_embl/' . $plasmid->plasmid_id); ?>
 			<div class="panel panel-default">
 				<div class="panel-heading">Upload EMBL File</div>
				<div class="panel-body">
				
				<?php echo form_upload('userfile'); ?>
				
				<strong>Note: this will replace the sequence with the sequence in the EMBL file !</strong>
				</div>
		
 			</div>
 				
		
				<?php     		
          		$data = array(
    				'name' => 'submit',
    				'id' => 'submit',
    				'value' => 'true',
    				'type' => 'submit',
    				'content' => '<span class="glyphicon glyphicon-plus"></span> Add EMBL',
    				'class' => 'btn btn-success'
				);
          		echo form_button($data); ?>
				<?php echo form_close(); ?>	
 		
 		</div>
 		
 		
		<?php 
			require_once('help/help_template.php');
			quick_help('help_upload_embl.php');
		?>
 		
 	</div>	
</div>

<?php include('footer.php'); ?>
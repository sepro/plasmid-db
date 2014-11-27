<?php include('header.php'); ?>

<div class="container main-content">
	<h2>Add sequence file to plasmid: <?php echo $plasmid->name; ?></h2>
	<div class="row">
 		<div class="col-lg-8">
  			<?php echo form_open_multipart('plasmid/add_sequence/' . $plasmid->plasmid_id); ?>
 			<div class="panel panel-default">
 				<div class="panel-heading">Upload Sequence File</div>
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
    				'content' => '<span class="glyphicon glyphicon-plus"></span> Add Sequence',
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
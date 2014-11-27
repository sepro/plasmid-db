<?php include('header.php'); ?>

<div class="container main-content">
	<h2>Search results <small><?php echo $term; ?></small></h2> 
	
	<div class="row">
 		<div class="col-lg-8">
			<div class="panel panel-default">
				<?php if ($plasmids !== false) { ?>     
				<table class="table table-condensed table-hover table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Type</th>
							<th>Name</th>
							<th>Resistance</th>
							<th>Backbone</th>
						</tr>
					</thead>
					<tbody>
					<?php
						foreach($plasmids as $plasmid) {
					?>
					<tr>
						<td><?php echo $plasmid->plasmid_id;?></td>
						<td><?php echo $plasmid->vector_type;?></td>
						<td><a href="<?php echo base_url(); ?>plasmid/view/<?php echo $plasmid->plasmid_id;?>"><?php echo $plasmid->name;?></a></td>
						<td>B: <strong><?php echo $plasmid->bacterial_resistance; ?></strong> P: <strong><?php echo $plasmid->plant_resistance; ?></strong> </td>
						<?php if ($plasmid->is_backbone == 1) { ?>
						<td>empty vector/backbone</td>
						<?php } else { ?>
						<td><a href="<?php echo base_url(); ?>plasmid/view/<?php echo $plasmid->backbone;?>"><?php echo $backbones[$plasmid->backbone];?></a></td>
						<?php } ?>						
					</tr>
					<?php } ?>
					</tbody>
				</table>
				<?php } else { ?>
				<div class="panel-body">
				<p>No plasmids found.</p>
				</div>
				<?php } ?>
			</div>      	
		</div>
        
		<?php 
			require_once('help/help_template.php');
			quick_help('help_search.php');
		?>
	</div>
</div>

<?php include('footer.php'); ?>
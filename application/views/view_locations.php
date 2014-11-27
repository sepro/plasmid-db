<?php include('header.php'); ?>

<div class="container main-content">
	<h2>Locations</h2>
	<div class="row">
 		<div class="col-lg-8">
			<div class="panel panel-default">  
				<?php if ($locations !== false) { ?>
				<table class="table table-condensed table-hover table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Building</th>
							<th>Room</th>
							<th>People</th>
							<th>Samples</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
					<?php
						foreach($locations as $location) {
					?>
					<tr>
						<td><?php echo $location->location_id;?></td>
						<td><?php echo $location->building;?></td>
						<td><?php echo $location->room;?></td>
						<td><div class="text-center"><a href="<?php echo base_url(); ?>user/location/<?php echo $location->location_id;?>"><?php if (isset($users_per_location[$location->location_id])) { echo $users_per_location[$location->location_id];} else { echo '0';}?></a></div></td>
						<td><div class="text-center"><a href="<?php echo base_url(); ?>plasmid/location/<?php echo $location->location_id;?>"><?php if (isset($plasmids_per_location[$location->location_id])) {echo $plasmids_per_location[$location->location_id];} else { echo '0';}?></a></div></td>
						<td>
							<?php if ($_SESSION['account'] == 'admin') { ?>
							<a href="<?php echo base_url(); ?>location/edit/<?php echo $location->location_id;?>"><span class="glyphicon glyphicon-edit"></span></a>
							<a href="<?php echo base_url(); ?>location/delete/<?php echo $location->location_id;?>" onclick="return confirm('Warning! Continuing will delete location.')"><span class="glyphicon glyphicon-trash"></span></a> <?php } else { ?>
							<span class="glyphicon glyphicon-edit disabled"></span>
							<span class="glyphicon glyphicon-trash disabled"></span>
							<?php } ?>
							<a href="<?php echo base_url(); ?>inventory/pdf/<?php echo $location->location_id;?>"><span class="glyphicon glyphicon-file"></span></a>
						</td>						
					</tr>
					<?php } ?>
					</tbody>
				</table>
				<?php } else { ?>
				<div class="panel-body">
				<p>No locations in the database.</p>
				</div>
				<?php } ?>
			</div>
			<?php if ($_SESSION['account'] == 'admin') { ?>
			<p><a href="<?php echo base_url(); ?>location/add/" class="btn btn-primary btn"><span class="glyphicon glyphicon-plus"></span> Add location</a></p>      
			<?php } ?>
		</div>
        
		<?php 
			require_once('help/help_template.php');
			quick_help('help_locations.php');
		?>
	</div>
</div>

<?php include('footer.php'); ?>
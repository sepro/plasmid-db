<?php include('header.php'); ?>
<div class="container main-content">
	<h2>User details: <strong><?php echo $user->first_name . " " . $user->last_name; ?></strong><small> (<?php echo $user->username; ?>)</small></h2>
	<div class="row">
 		<div class="col-lg-8">
			<div class="panel panel-default">
			<div class="panel-body">
				<p><strong><a href="<?php echo base_url(); ?>user/view/<?php echo $user->username;?>"><?php echo $user->first_name . " " . $user->last_name; ?></a></strong></p>
				<p><span class="glyphicon glyphicon-earphone"></span> <?php echo $user->phone; ?></p>
				<p><span class="glyphicon glyphicon-envelope"></span> <a href="mailto:<?php echo $user->email; ?>"><?php echo $user->email; ?></a></p>
				<p><?php echo $location->building; ?></p>
				<p>Room: <?php echo $location->room; ?></p>
				<p><span class="glyphicon glyphicon-home"></span><br /><?php echo nl2br($location->address); ?></p>
				</div>
			</div>
		</div>
	</div>
	<h3>Plasmids made by <?php echo $user->first_name; ?></h3>
	<div class="row">
 		<div class="col-lg-8">
			<div class="panel panel-default"> 

			<?php if($plasmids !== false) { ?>

				<table class="sortable table table-condensed table-hover table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Type</th>
							<th>Name</th>
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
				<p>This user has not created any plasmids.</p>
			</div>
			<?php } ?>
			</div>
		</div>
	</div>
</div>

<?php include('footer.php'); ?>
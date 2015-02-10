<?php include('header.php'); ?>

<div class="container main-content">
	<h2>Plasmids</h2>
	
	<div class="row">
 		<div class="col-lg-8">
			<div class="panel panel-default">
				<?php if ($plasmids !== false) { ?>     
				<table class="sortable table table-condensed table-hover table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Type</th>
							<th>Name</th>
							<th>Creator</th>
							<th>Backbone</th>
							<th class="sorttable_nosort">Actions</th>
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
						<td><a href="<?php echo base_url(); ?>user/view/<?php echo $plasmid->username;?>"><?php echo $plasmid->first_name . " " . $plasmid->last_name;?></a></td>
						<?php if ($plasmid->is_backbone == 1) { ?>
						<td>empty vector/backbone</td>
						<?php } else { ?>
						<td><a href="<?php echo base_url(); ?>plasmid/view/<?php echo $plasmid->backbone;?>"><?php echo $backbones[$plasmid->backbone];?></a></td>
						<?php } ?>
						<td>
							<?php if ($_SESSION['account'] != 'guest' && ($_SESSION['account'] == 'admin'  || $_SESSION['userid'] == $plasmid->creator)) { ?>
								<a href="<?php echo base_url(); ?>plasmid/edit/<?php echo $plasmid->plasmid_id;?>"><span class="glyphicon glyphicon-edit"></span></a>
								<a href="<?php echo base_url(); ?>plasmid/delete/<?php echo $plasmid->plasmid_id;?>" onclick="return confirm('Warning! Continuing will delete plasmid <?php echo $plasmid->name; ?>.')"><span class="glyphicon glyphicon-trash"></span></a>
							<?php } else {?>
								<span class="glyphicon glyphicon-edit disabled"></span>
								<span class="glyphicon glyphicon-trash disabled"></span>
							<?php }?>
						</td>						
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
			
			<?php if($use_pagination) {
				echo $pagination_links;
			} ?>
			
			<?php if($_SESSION['account'] != 'guest' && ($_SESSION['account'] == 'admin' || $_SESSION['account'] == 'user')) { ?>
			<div class="btn-group">
			<a href="<?php echo base_url(); ?>plasmid/add/" class="btn btn-primary btn"><span class="glyphicon glyphicon-plus"></span> Add plasmid</a>
  			<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
    			<span class="caret"></span>
    			<span class="sr-only">Toggle Dropdown</span>
  			</button>
    		<ul class="dropdown-menu" role="menu">
    			<li><a href="<?php echo base_url(); ?>plasmid/add/"><span class="glyphicon glyphicon-plus"></span> Enter manually</a></li>
    			<li><a href="<?php echo base_url(); ?>plasmid/upload_gb/"><span class="glyphicon glyphicon-upload"></span> Upload GenBank File</a></li>
    			<li><a href="<?php echo base_url(); ?>plasmid/upload_embl/"><span class="glyphicon glyphicon-upload"></span> Upload EMBL File</a></li>
  			</ul>
			</div>
			 <?php } ?>
		</div>
        
		<?php 
			require_once('help/help_template.php');
			quick_help('help_plasmids.php');
		?>
	</div>
</div>

<?php include('footer.php'); ?>
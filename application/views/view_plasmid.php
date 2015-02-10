<?php include('header.php'); ?>

<div class="container main-content">
	<h2>Plasmid: <?php echo $plasmid->name; ?></h2>
	<div class="row">
 		<div class="col-lg-8">
			<div class="panel panel-default">       
				<div class="panel-heading">Plasmid Info</div>
				<div class="panel-body">
				<div class="col-sm-6 nopadding">
				<?php if ((int)$plasmid->is_backbone == 0) { ?>
					<p><strong>Backbone:</strong> <a href="<?php echo base_url();?>plasmid/view/<?php echo $plasmid->backbone;?>"><?php echo $backbone_name; ?></a></p>
				<?php } ?>
				<?php if ((int)$plasmid->pubmed_id > 0 && $plasmid->pubmed_id !== NULL) { ?>
					<p><strong>Publication:</strong> <a href="http://www.ncbi.nlm.nih.gov/pubmed/<?php echo $plasmid->pubmed_id;?>"><?php echo $plasmid->pubmed_id;?></a></p>
				<?php } ?>
				<?php if ($plasmid->website !== '' && $plasmid->website !== NULL) { ?>
					<p><strong>Website:</strong> <a href="<?php echo $plasmid->website;?>"><?php echo $plasmid->website;?></a></p>
				<?php } ?>				
				<p><strong>Created:</strong> <?php echo $plasmid->created;?></p>
				<p><strong>Resistance</strong></p>
				<p>Bacterial resistance: <?php echo $plasmid->bacterial_resistance;?><br />Plant resistance: <?php echo $plasmid->plant_resistance;?></p>
				</div>
				<div class="col-sm-6 nopadding">
				<?php if ($has_vectormap) { ?>
				<a href="<?php echo base_url(); ?>vectormap/show/<?php echo $plasmid->plasmid_id; ?>"><img src="<?php echo base_url(); ?>vectormap/show_thumb/<?php echo $plasmid->plasmid_id; ?>" alt="vector map" /></a>
				<?php }?>
				</div>
				</div>
				<div class="panel-body">
				<p><strong>Description</strong></p>
				<p><?php echo nl2br($plasmid->description);?></p>
				</div>
			</div>
				<ul class="nav nav-tabs">
					<li class="active"><a href="#sequence" data-toggle="tab">Sequence</a></li>
					<li <?php if (!($plasmid->embl !== '' && $plasmid->embl !== NULL)) { echo "class='disabled'"; }?>><a href="#embl" data-toggle="tab">EMBL</a></li>
					<li <?php if (!($plasmid->genbank !== '' && $plasmid->genbank !== NULL)) { echo "class='disabled'"; }?>><a href="#genbank" data-toggle="tab">GenBank</a></li>
				</ul>
				
				<div class="tab-content">
  					<div class="tab-pane active" id="sequence">
  						<div class="col-lg-12">
 						<?php if ($plasmid->sequence !== '' && $plasmid->sequence !== NULL) { ?>
							<pre class="well sequence"><?php echo str_replace(array("\r", "\n", "\s"), '', $plasmid->sequence); ?></pre>
							<a href="<?php echo base_url(); ?>plasmid/sequence/<?php echo $plasmid->plasmid_id; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-download"></span> Download</a>
				<?php } else {?>
						<strong>No sequence added for this plasmid!</strong>
				<?php }?>
  						</div>
  					</div>
  					<div class="tab-pane" id="embl">
  						<div class="col-lg-12">
 						<?php if ($plasmid->embl !== '' && $plasmid->embl !== NULL) { ?>
							<pre class="well sequence"><?php echo $plasmid->embl; ?></pre>
							<a href="<?php echo base_url(); ?>plasmid/embl/<?php echo $plasmid->plasmid_id; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-download"></span> Download</a>
				<?php } else {?>
						<strong>No EMBL file added for this plasmid!</strong>
				<?php }?>
  						</div>
  					</div>
  					<div class="tab-pane" id="genbank">
  						<div class="col-lg-12">
 						<?php if ($plasmid->genbank !== '' && $plasmid->genbank !== NULL) { ?>
							<pre class="well sequence"><?php echo $plasmid->genbank; ?></pre>
							<a href="<?php echo base_url(); ?>plasmid/genbank/<?php echo $plasmid->plasmid_id; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-download"></span> Download</a>
				<?php } else {?>
						<strong>No Genbank file added for this plasmid!</strong>
				<?php }?>
  						</div>
  					</div>
  				</div>			

							

     		<?php if($_SESSION['account'] != 'guest' && ($_SESSION['account'] == 'admin' || $_SESSION['userid'] == $plasmid->creator)) { ?>
			<div class="clearfix">
			<a href="<?php echo base_url(); ?>plasmid/edit/<?php echo $plasmid->plasmid_id; ?>"class="btn btn-primary btn"><span class="glyphicon glyphicon-edit"></span> Edit plasmid</a>
			<div class="btn-group">
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    				Add/Replace... <span class="caret"></span>
  				</button>
 				<ul class="dropdown-menu" role="menu">
    				<li><a href="<?php echo base_url(); ?>plasmid/addvectormap/<?php echo $plasmid->plasmid_id; ?>">Vector Map</a></li>
    				<li class="divider"></li>
    				<li><a href="<?php echo base_url(); ?>plasmid/add_sequence/<?php echo $plasmid->plasmid_id; ?>">Sequence</a></li>
    				<li><a href="<?php echo base_url(); ?>plasmid/add_embl/<?php echo $plasmid->plasmid_id; ?>">EMBL</a></li>
    				<li><a href="<?php echo base_url(); ?>plasmid/add_genbank/<?php echo $plasmid->plasmid_id; ?>">GenBank</a></li>	
  				</ul>
			</div>
			<div class="btn-group">
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    				Remove... <span class="caret"></span>
  				</button>
 				<ul class="dropdown-menu" role="menu">
    				<li><a href="<?php echo base_url(); ?>plasmid/remove_vectormap/<?php echo $plasmid->plasmid_id; ?>">Vector Map</a></li>
    				<li class="divider"></li>
    				<li><a href="<?php echo base_url(); ?>plasmid/remove_sequence/<?php echo $plasmid->plasmid_id; ?>">Sequence</a></li>
    				<li><a href="<?php echo base_url(); ?>plasmid/remove_embl/<?php echo $plasmid->plasmid_id; ?>">EMBL</a></li>
    				<li><a href="<?php echo base_url(); ?>plasmid/remove_genbank/<?php echo $plasmid->plasmid_id; ?>">GenBank</a></li>	
  				</ul>
			</div>
			</div>

			<?php } ?>
				
				<?php if($plasmid->is_backbone == false) { ?>
				<div class="panel panel-default">  
				<div class="panel-heading">Inserts</div>
				<?php if($inserts !== false) { ?>
				<table class="table table-condensed table-hover table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Comment</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
					<?php
						foreach($inserts as $insert) {
					?>
					<tr>
						<td><?php echo $insert->id;?></td>
						<td><a href="<?php echo base_url(); ?>insert/view/<?php echo $insert->id;?>"><?php echo $insert->name;?></a></td>
						<td><?php echo $insert->comment;?></td>
						<td>
							<?php if ($_SESSION['account'] != 'guest' && ($_SESSION['account'] == 'admin' || $_SESSION['userid'] == $plasmid->creator)) { ?>
							<a href="<?php echo base_url(); ?>insert/edit/<?php echo $insert->id;?>"><span class="glyphicon glyphicon-edit"></span></a>
							<a href="<?php echo base_url(); ?>insert/delete/<?php echo $insert->id;?>" onclick="return confirm('Warning! Continuing will delete Insert.')"><span class="glyphicon glyphicon-trash"></span></a> <?php } else {?>
							<span class="glyphicon glyphicon-edit disabled"></span>
							<span class="glyphicon glyphicon-trash disabled"></span>
							<?php } ?>								
						</td>						
					</tr>
					<?php } ?>
					</tbody>
				</table>
				<?php } else { ?>
					<div class="panel-body">
						<p>No inserts added for this plasmid.</p>
					</div>
										
				<?php }?>
				</div>	
				<?php if (($_SESSION['account'] == 'admin' || $_SESSION['userid'] == $plasmid->creator) && $plasmid->is_backbone == FALSE && $_SESSION['account'] != 'guest') { ?>
					<div class="clearfix">
					<a href="<?php echo base_url(); ?>insert/add/<?php echo $plasmid->plasmid_id; ?>"class="btn btn-primary btn"><span class="glyphicon glyphicon-plus"></span> Add insert</a>
					</div>
				<?php } ?>
				
				<?php }?>
			
			
			<div class="panel panel-default">       
				<div class="panel-heading">Locations</div>
				<?php if($locations !== false) { ?>
				<table class="table table-condensed table-hover table-striped">
					<thead>
						<tr>
							<th>Building</th>
							<th>Room</th>
							<th>Comment</th>
							<th>Label</th>
							<th>Type</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
					<?php
						foreach($locations as $location) {
					?>
					<tr>
						<td><?php echo $location->building;?></td>
						<td><?php echo $location->room;?></td>
						<td><?php echo $location->comment;?></td>
						<td><?php echo $location->label;?></td>
						<td><?php echo $location->storage_type;?></td>
						<td>
							<?php if ($_SESSION['account'] == 'admin' || $_SESSION['userid'] == $plasmid->creator) { ?>
							<a href="<?php echo base_url(); ?>plasmid_location/edit/<?php echo $location->id;?>/<?php echo $plasmid->plasmid_id; ?>"><span class="glyphicon glyphicon-edit"></span></a>
							<a href="<?php echo base_url(); ?>plasmid_location/delete/<?php echo $location->id;?>/<?php echo $plasmid->plasmid_id; ?>" onclick="return confirm('Warning! Continuing will delete location.')"><span class="glyphicon glyphicon-trash"></span></a> <?php } else {?>
							<span class="glyphicon glyphicon-edit disabled"></span>
							<span class="glyphicon glyphicon-trash disabled"></span>
							<?php } ?>								
						</td>						
					</tr>
					<?php } ?>
					</tbody>
				</table>				
				<?php } else { ?>
					<div class="panel-body">
						<p>This plasmid is currently not available.</p>
					</div>				
				<?php }?>
			</div>
			<?php if($_SESSION['account'] != 'guest' && ($_SESSION['account'] == 'admin' || $_SESSION['userid'] == $plasmid->creator)) { ?>
			<div class="clearfix">
			<a href="<?php echo base_url(); ?>plasmid_location/add/<?php echo $plasmid->plasmid_id; ?>"class="btn btn-primary btn"><span class="glyphicon glyphicon-plus"></span> Add Location</a></div>
			<?php }?>			
			
		</div>
        
		<div class="col-lg-4">
			<div class="panel panel-default">
				<div class="panel-heading">Contact creator</div>
				<div class="panel-body">
				<p><strong><a href="<?php echo base_url(); ?>user/view/<?php echo $creator->username;?>"><?php echo $creator->first_name . " " . $creator->last_name; ?></a></strong></p>
				<p><span class="glyphicon glyphicon-earphone"></span> <?php echo $creator->phone; ?></p>
				<p><span class="glyphicon glyphicon-envelope"></span> <a href="mailto:<?php echo $creator->email; ?>"><?php echo $creator->email; ?></a></p>
				<p><?php echo $creator_location->building; ?></p>
				<p>Room: <?php echo $creator_location->room; ?></p>
				<p><span class="glyphicon glyphicon-home"></span><br /><?php echo nl2br($creator_location->address); ?></p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include('footer.php'); ?>
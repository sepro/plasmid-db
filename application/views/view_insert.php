<?php include('header.php'); ?>

<div class="container main-content">
	<h2>Insert: <?php echo $insert->name; ?></h2>
	<div class="row">
 		<div class="col-lg-8">
			<div class="panel panel-default">       
				<div class="panel-heading">Insert Info</div>
				<div class="panel-body">
				<p><strong>Plasmid: </strong> <a href="<?php echo base_url();?>plasmid/view/<?php echo $plasmid->plasmid_id;?>"><?php echo $plasmid->name;?></a></p>			
				<p><strong>Comment:</strong> <?php echo $insert->comment;?></p>

				<?php if ($insert->sequence !== '') { ?>
					<p><strong>Sequence</strong></p>
					<div class="well sequence"><?php echo str_replace(array("\r", "\n", "\s"), '', $insert->sequence); ?></div>
				<?php }?>
				
				</div>			
			</div>
     		<?php if($_SESSION['account'] == 'admin' || $_SESSION['userid'] == $plasmid->creator) { ?>
			<div class="clearfix">
			<a href="<?php echo base_url(); ?>insert/edit/<?php echo $insert->id; ?>"class="btn btn-primary btn"><span class="glyphicon glyphicon-edit"></span> Edit insert</a></div>

			<?php } ?>
				
			
		</div>
        
		<?php 
			require_once('help/help_template.php');
			quick_help('help_insert.php');
		?>
	</div>
</div>
<?php include('footer.php'); ?>
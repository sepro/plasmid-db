<?php include('header.php'); ?>


    <!-- Main jumbotron for a primary marketing message or call to action -->
<div class="container main-content">
	<div class="row">
        <div class="col-lg-8">
    		<div class="jumbotron">
      			<div class="container">
        		<h1>Welcome <?php echo $_SESSION['first_name']; ?>!</h1>
        		<p>You have successfully logged in. Click on the button below to learn how to use the Plasmid DB.</p>
        		<p><a href="<?php echo base_url(); ?>about" class="btn btn-primary btn-lg">Learn more &raquo;</a></p>
      			</div>
   			 </div>
		</div>
		<?php 
			require_once('help/help_template.php');
			quick_help('help_home.php');
		?>
	</div>
</div> <!-- container -->

<?php include('footer.php'); ?>
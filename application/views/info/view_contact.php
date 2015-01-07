<?php include(APPPATH.'views/header.php'); ?>


<div class="container main-content">
	<div class="row">
        <div class="col-lg-8">
    		<h2>Contact</h2>
			
			<p>Questions, remarks, bugs, ideas ... feel free to send them in and help us improve Plasmid DB !</p>
			
			<div class="person">
			<h4><strong>Dr. Sebastian Proost</strong></h4>
			<img src="<?php echo base_url(); ?>img/picture.jpg" class="profile"/>
			<ul>
				<li><strong>Developer &amp; project leader</strong></li>
				<li><?php echo safe_mailto('proost@mpimp-golm.mpg.de', 'proost@mpimp-golm.mpg.de');?></li>
				<li>Potsdam University, Institute of Biochemistry and Biology</li>
				<li>Max-Planck Institute of Molecular Plant Physiology, Plant Signalling Group</li>
			</ul>
			</div>
			
			<div class="person">
			<h4><strong>Barbara Nobmann</strong></h4>
			<img src="<?php echo base_url(); ?>img/picture.jpg" class="profile"/>
			<ul>
				<li><strong>Beta tester</strong></li>
				<li>Potsdam University, Institute of Biochemistry and Biology</li>
				<li>Max-Planck Institute of Molecular Plant Physiology, Plant Signalling Group</li>
			</ul>
			</div>

			<div class="person">
			<h4><strong>Prof.Dr. Bernd Müller-Röber</strong></h4>
			<img src="<?php echo base_url(); ?>img/picture.jpg" class="profile"/>
			<ul>
				<li><strong>Department head</strong></li>
				<li>Potsdam University, Institute of Biochemistry and Biology</li>
				<li>Max-Planck Institute of Molecular Plant Physiology, Plant Signalling Group</li>
			</ul>
			</div>

		</div>
		
	</div>
</div> <!-- container -->

<?php include(APPPATH.'views/footer.php'); ?>
<?php include(APPPATH.'views/header.php'); ?>


<div class="container main-content">
	<div class="row">
        <div class="col-lg-12">
    		<h2>Tutorial</h2>
    		
			<ul class="nav nav-tabs">
  				<li class="active"><a href="#start" data-toggle="tab">Setting up an account</a></li>
  				<li><a href="#plasmids" data-toggle="tab">Adding Plasmids</a></li>
  				<li><a href="#admin" data-toggle="tab">Admin features</a></li>
		  	</ul>
		  	
		  	
		  	<div class="tab-content">
  				<div class="tab-pane active" id="start">
  					<div class="col-lg-12" style="padding-bottom:15px;">
  						<div class="row">
							<div class="col-xs-8 col-lg-9">
							<h4>Creating a new account</h4>
							<p>Before you can get started you need to create an account. This is simple and can be done in a few clicks, just hit <strong>Register</strong> in the Login panel and fill in the required fields. Note that a valid email address is essential.</p>
							</div>
  							<div class="col-xs-4 col-lg-3">
    						<a href="img/tutorial/01_login_panel.png" class="thumbnail">
      							<img src="img/tutorial/01_login_panel.png" alt="login panel" width=240>
      							<div class="caption">
      							<strong>Login panel</strong>, click the <strong>Register</strong> to create a new account or fill in your credentials and click <strong>Login</strong>.
      							</div>
    						</a>
  							</div>
  						</div>
  						<br />
  						<div class="row">
							<div class="col-xs-8 col-lg-9">
							<h4>Wait for approval</h4>
							<p>To avoid outsiders to register and view the plasmid collection, new users need to be approved by an administrator. Administators are automatically notified if a new user registers and you will get an email as soon as the account is approved.</p>
							</div>
  							<div class="col-xs-4 col-lg-3">
    						<a href="img/tutorial/01_pending_user.png" class="thumbnail">
      							<img src="img/tutorial/01_pending_user.png" alt="pending user alert" width=240>
      							<div class="caption">
      							As long as an account hasn't been approved users will get this message.
      							</div>
    						</a>
  							</div>
  						</div>
  						<br />
  						<div class="row">
 							<div class="col-xs-8 col-lg-9">
							<h4>Change credentials</h4>
							<p>If you need to check your type of account or wish to change your credentials you can click your name in the top right corner of the menu bar. Note you can only change your settings after your account has been approved !</p>
							</div>
  							<div class="col-xs-4 col-lg-3">
    						<a href="img/tutorial/01_change_credentials.png" class="thumbnail">
      							<img src="img/tutorial/01_change_credentials.png" alt="change credentials">
      							<div class="caption">
      							Clicking your name shows your account type and links to pages where you can change your credentials/password.
      							</div>
    						</a>
  							</div>
  						</div> 						
  					</div>
  				</div>
  				
  				<div class="tab-pane" id="plasmids">
  					<div class="col-lg-12" style="padding-bottom:15px;">
  						<div class="row">
							<div class="col-xs-8 col-lg-9">
							<h4>Adding a plasmid</h4>
							<p>First click the <strong>Plasmids</strong> button in the menu bar to go to the overview of all plasmids in the database. If you have sufficient rights to add plasmids (users and admins) a button <strong>Add Plasmid</strong> is available on the bottome of the page. You can click the button to add plasmid information manually, or you can click the triangle to see other options. Using these options you can directly upload a genbank or EMBL file and the platform will extract as much information as possible automatically. Though even when adding a plasmid manually, it is possible to add such a file later.</p>
							</div>
  							<div class="col-xs-4 col-lg-3">
    						<a href="img/tutorial/02_add_plasmid.png" class="thumbnail">
      							<img src="img/tutorial/02_add_plasmid.png" alt="add plasmid">
      							<div class="caption">
      							<strong>Add Plasmid</strong> button and additional options.
      							</div>
    						</a>
  							</div>
  						</div>
  						<br />
  						<div class="row">
							<div class="col-xs-8 col-lg-9">
							<h4>Enter details</h4>
							<p>Enter a name for the plasmid and indicate if this is a backbone or not. In case it isn't please select the backbone from the list. Always try to be as complete and correct as possible, this information is linked with your account and other users will see what you enter here. In case options are missing (e.g. for resistances) contact an admin to add the missing options. Click <strong>Add plasmid</strong> to enter the plasmid into the database. You will be asked to enter a location (and inserts in case it is not a backbone) in the next step.</p>
							</div>
  							<div class="col-xs-4 col-lg-3">
    						<a href="img/tutorial/02_add_plasmid_2.png" class="thumbnail">
      							<img src="img/tutorial/02_add_plasmid_2.png" alt="add plasmid">
      							<div class="caption">
      							Information to enter when manually entering a plasmid.
      							</div>
    						</a>
  							</div>
  						</div>
  						<br />
  						<div class="row">
							<div class="col-xs-8 col-lg-9">
							<h4>Plasmid page, add additional information</h4>
							<p>After entering the general information, the plasmid is added to the database. If you created the plasmid you can edit this information and add/remove a vectormap, sequence and/or EMBL/GenBank file. Note, when uploading a EMBL/GenBank file the sequence is automatically added from this file. You can either add an EMBL or GenBank file, to avoid inconsistencies adding both currently is not supported.</p>
							</div>
  							<div class="col-xs-4 col-lg-3">
    						<a href="img/tutorial/02_add_plasmid_details.png" class="thumbnail">
      							<img src="img/tutorial/02_add_plasmid_details.png" alt="add plasmid">
      							<div class="caption">
      							Plasmid page, here you can enter information on inserts and the locations where it is stored. Also additional information such as the sequence, a vectormap and EMBL/GenBank files can be added.
      							</div>
    						</a>
  							</div>
  						</div> 						
  					</div>
  				</div>
  				
  				<div class="tab-pane" id="admin">
  					<div class="col-lg-12" style="padding-bottom:15px;">
  						<div class="row">
							<div class="col-xs-8 col-lg-9">
							<h4>Administrator accounts</h4>
							<p>Administators can change all data included in the platform (also for plasmids they didn't enter themselves). Additionally through a special admin panel they can also perform bulk actions easier, add options (e.g. for resistances) and download/restore backups.</p>
							</div>
  							<div class="col-xs-4 col-lg-3">
    						<a href="img/tutorial/03_admin_user.png" class="thumbnail">
      							<img src="img/tutorial/03_admin_user.png" alt="add plasmid">
      							<div class="caption">
      							If you have an admin account the <strong>Admin panel</strong> will be available when clicking your name.
      							</div>
    						</a>
  							</div>
  						</div>
  						<br />
  						<div class="row">
							<div class="col-xs-8 col-lg-9">
							<h4>Administrator panel</h4>
							<p>The administrator panel offers an intuitive way to move plasmids from one user to another (e.g. when someone leaves the group) or move all plasmids from one location to another (e.g. when moving a freezer).</p>
							</div>
  							<div class="col-xs-4 col-lg-3">
    						<a href="img/tutorial/03_admin_panel.png" class="thumbnail">
      							<img src="img/tutorial/03_admin_panel.png" alt="add plasmid">
      							<div class="caption">
      							The admin panel enables admins to add options, do bulk updates and backup/restore the database.
      							</div>
    						</a>
  							</div>
  						</div>
  					</div>
  				</div>
  			</div>
		  	
		</div>
		
	</div>
</div> 

<?php include(APPPATH.'views/footer.php'); ?>
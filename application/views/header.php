<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Plasmid DB : <?php echo $title ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">

        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/main.css">

        <script src="<?php echo base_url(); ?>js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <script src="<?php echo base_url(); ?>js/vendor/sorttable.js"></script>
    </head>
    <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url(); ?>home">Plasmid DB</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE) { ?>
            <li<?php if ($controller == 'home') { ?> class="active"<?php }?>><a href="<?php echo base_url(); ?>home">Home</a></li>
            <li<?php if ($controller == 'plasmid') { ?> class="active"<?php }?>><a href="<?php echo base_url(); ?>plasmid">Plasmids</a></li>
            <li<?php if ($controller == 'user') { ?> class="active"<?php }?>><a href="<?php echo base_url(); ?>user">Users</a></li>
            <li<?php if ($controller == 'location') { ?> class="active"<?php }?>><a href="<?php echo base_url(); ?>location">Locations</a></li>
            <?php }?>
          </ul>
          <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE) { ?>
        <div class="col-sm-4 col-md-4">
        <?php echo form_open('search', 'class="navbar-form navbar-searchbar"'); ?>
        <div class="input-group search-field">
		
            <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
            <div class="input-group-btn">
                <button class="btn btn-default btn-search" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </div>
        <?php echo form_close(); ?>
        
        </div>
        <?php }?>
         <ul class="nav navbar-nav navbar-right">
          <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE) { ?>
          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name'] ?><b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li class="dropdown-header">Account type: <?php echo $_SESSION['account']; ?></li>
            <?php if ($_SESSION['account'] == 'admin') { ?>
				<li><a href="<?php echo base_url(); ?>admin/">Admin Panel</a></li>
				<li class="divider"></li>
			<?php } ?>
            <li><a href="<?php echo base_url(); ?>user/edit/<?php echo $_SESSION['username']; ?>">Edit profile</a></li>
            <li><a href="<?php echo base_url(); ?>password/change/">Change password</a></li>
            <li class="divider"></li>
          	<li><a href="<?php echo base_url(); ?>logout"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
          </ul>
          </li>	
		  <?php } else { ?>
          	<li><a href="#">Not logged in!</a></li>
          <?php } ?>
          </ul>
              
        </div><!--/.navbar-collapse -->
      </div>
    </div>
    <!--throw errors, show information, warnings, successes, .... -->
    <?php 
      if (isset($_SESSION['error'])) { ?>
      <div class="container">
      <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
      </div>
      </div>
    <?php } ?>
    
    <?php 
      if (isset($_SESSION['success'])) { ?>
      <div class="container">
      <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
      </div>
      </div>
    <?php } ?>    
    
    <?php 
      if (isset($_SESSION['info'])) { ?>
      <div class="container">
      <div class="alert alert-info">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <?php echo $_SESSION['info']; unset($_SESSION['info']); ?>
      </div>
      </div>
    <?php } ?>
    
    <?php 
      if (isset($_SESSION['warning'])) { ?>
      <div class="container">
      <div class="alert alert-warning">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <?php echo $_SESSION['warning']; unset($_SESSION['warning']); ?>
      </div>
      </div>
    <?php } ?>
<div id="content">
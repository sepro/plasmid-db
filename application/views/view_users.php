<?php include('header.php'); ?>

<div class="container main-content">
	<h2>Users</h2>
	<div class="row">
 		<div class="col-lg-8">
			<div class="panel panel-default">   
				<?php if ($users !== false) { ?>     
				<table class="sortable table table-condensed table-hover table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>User</th>
							<th>First name</th>
							<th>Last name</th>
							<th>Account</th>
							<th class="sorttable_nosort">Actions</th>
						</tr>
					</thead>
					<tbody>
					<?php
						foreach($users as $user) {
					?>
					<tr <?php if ($user->account == 'pending') { echo "class=\"warning\""; } ?>>
						<td><?php echo $user->user_id;?></td>
						<td><a href="<?php echo base_url(); ?>user/view/<?php echo $user->username;?>"><?php echo $user->username;?></a></td>
						<td><?php echo $user->first_name;?></td>
						<td><?php echo $user->last_name;?></td>
						<td><?php echo $user->account;?></td>
						<td>
							<a href="mailto:<?php echo $user->email; ?>"><span class="glyphicon glyphicon-envelope"></span></a>
							<?php if(!($_SESSION['account'] !== 'admin' && $_SESSION['username'] !== $user->username)) { ?>
							<a href="<?php echo base_url(); ?>user/edit/<?php echo $user->username;?>"><span class="glyphicon glyphicon-edit"></span></a>
							<?php } else { ?>
							<span class="glyphicon glyphicon-edit disabled"></span>
							<?php } ?>
							<?php if ($_SESSION['account'] == 'admin' && $user->account !== 'admin') { ?>
								<a href="<?php echo base_url(); ?>user/delete/<?php echo $user->username;?>" onclick="return confirm('Warning! Continuing will delete user <?php echo $user->username; ?>.')"><span class="glyphicon glyphicon-trash"></span></a>
							<?php } else {?>
								<span class="glyphicon glyphicon-trash disabled"></span>
							<?php } ?>
						</td>						
					</tr>
					<?php } ?>
					</tbody>
				</table>
				<?php } else { ?>
				<div class="panel-body">
				<p>No users found.</p>
				</div>
				<?php } ?>
			</div>       
		</div>
        
		<?php 
			require_once('help/help_template.php');
			quick_help('help_users.php');
		?>
		
	</div>
</div>

<?php include('footer.php'); ?>
<html>
	<head>
		<title>Inventory</title>
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/pdf.css">
	</head>
	<body>
		<h1>Inventory <small>(<?php date_default_timezone_set('CET'); echo date('d-m-Y H:i'); ?>)</small></h1>
		<h2>Location: <strong><?php echo $building . " " . $room; ?></strong></h2>
		<?php 
		

			echo $inventory_table
		
		?>
		
	</body>
</html>
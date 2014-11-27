<?php

function quick_help($filename)
{
	?>
		<div class="col-lg-4 quick-help">
			<div class="panel panel-default">
				<div class="panel-heading"><h3><span class="glyphicon glyphicon-question-sign"></span> Quick Help</h3></div>
				<div class="panel-body">
				<?php include($filename); ?>
				</div>
			</div>
		</div>		
<?php
}

?>
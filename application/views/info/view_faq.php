<?php include(APPPATH.'views/header.php'); ?>


<div class="container main-content">
	<div class="row">
        <div class="col-lg-8">
    		<h2>Frequently Asked Questions</h2>
			<div class="faq">
				<p class="question">I registered for an account, however I can't see the plasmids in the database after logging in. Is something wrong?</p>
				<p class="answer">Each new account has to be approved by an administrator (a security measure), once this is done you will be able to access the database.</p>
			</div>
			<div class="faq">
				<p class="question">Why can't I add my plasmids to the database?</p>
				<p class="answer">Check your account type (click on your username in the navigation bar), only users and admins can add plasmids. Contact an admin if you feel your account type should be upgraded.</p>
			</div>
			
			<div class="faq">
				<p class="question">I'm using a resistance gene that does not appear in the list, what should I do?</p>
				<p class="answer">Temporarily select "Other" and contact and administrator. They can add additional resistance genes.</p>
			</div>
			
			<div class="faq">
				<p class="question">I'm storing my plasmids in a location that isn't included in the list, what should I do?</p>
				<p class="answer">Provide the location details to an admin, they can add new locations.</p>
			</div>
			
			<div class="faq">
				<p class="question">Why can I edit some pieces of information, but not others?</p>
				<p class="answer">Default users are limited to editing information they added.</p>
			</div>
			
			<div class="faq">
				<p class="question">I found an error or bug, where can I report it?</p>
				<p class="answer">If this is a mistake with the content of the database contact either the person that added the information or an administrator. Bug and errors in the Plasmid DB software can be reported by <a href="<?php echo base_url(); ?>contact">contacting</a> the developers or filing an issue on <a href="https://github.com/sepro/plasmid-db/">GitHub</a>.</p>
			</div>
		</div>
		
		
	</div>
</div> <!-- container -->

<?php include(APPPATH.'views/footer.php'); ?>
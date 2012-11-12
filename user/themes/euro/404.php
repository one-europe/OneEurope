<?php if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); } ?>

<?php $theme->display ( 'header' ); ?>


<?php if ( $this->matched_rule->name == 'display_profile' ) { ?>

	<!--begin content-->

		<div class="centered">
			<h1>The profile you were trying to reach is not on our servers.</h1><br/>
			<h1>Check your spelling, try the search function,<br/> view a complete list of <a href="http://one-europe.info/profiles">› all profiles</a> or go to the <a href="http://one-europe.info/">› home page</a>.</h1>
		</div>
		
<?php } elseif ( $this->matched_rule->name == 'display_initiative' ) { ?>

	<!--begin content-->

		<div class="centered">
			<h1>The initiative profile you were trying to reach is not on our servers.</h1><br/>
			<h1>Check your spelling, try the search function,<br/> view a complete list of <a href="http://one-europe.info/initiatives">› all initiatives</a> or go to the <a href="http://one-europe.info/">› home page</a>.</h1>
		</div>

<?php } elseif ( $this->matched_rule->name == 'display_article' ) { ?>

	<!--begin content-->

		<div class="centered">
			<h1>The article you were trying to reach is not on our servers.</h1><br/>
			<h1>Check your spelling, try the search function,<br/> view a complete list of <a href="http://one-europe.info/initiatives">› all initiatives</a> or go to the <a href="http://one-europe.info/">› home page</a>.</h1>
		</div>

<?php } else { ?>

<!--begin content-->

	<div class="centered">
		<h1>The page you were trying to reach is not on our servers.</h1>
		<h1>Check your spelling, try the search function or go to the <a href="http://one-europe.info/">› home page</a>.</h1>
	</div>

<?php } ?>
	
<?php $theme->display ( 'footer' ); ?>

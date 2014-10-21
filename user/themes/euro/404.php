<?php if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); } ?>
<?php echo $theme->display('header'); ?>
<article class="full">
	<h1>Page Not Found</h1>
	<div class="post-content">
		<p>Sorry, the page you're looking for could not be found..</p>
		<p>Please, try one of the following pages: <a href="<?php Site::out_url( 'habari' ); ?>">home page</a></p>
	</div>
</article>
<?php echo $theme->display('footer'); ?>
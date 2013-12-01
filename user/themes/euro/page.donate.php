<?php echo $theme->display('header'); ?>
<div class="submenu">
	<ul>
		<li><a href="<?php Site::out_url( 'habari' ); ?>/about">About</a></li>
		<li><a href="<?php Site::out_url( 'habari' ); ?>/join-us">Join us</a></li>
		<li><a href="<?php Site::out_url( 'habari' ); ?>/donate"><b>Donate</b></a></li>
		<li><a href="<?php Site::out_url( 'habari' ); ?>/become-a-patron">Become a Patron</a></li>
		<li><a href="<?php Site::out_url( 'habari' ); ?>/contact">Contact</a></li>
		<li class="clear"></li>
	</ul>
</div>
<div class="content donate">
	<h1><?php echo $post->title_out; ?></h1>
	<article class="body"><?php echo $post->content_out; ?></article>
</div>
<?php if (User::identify()->loggedin) { ?>
	<span class="article-edit right" style="width: 100%;">
		<a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a>
	</span>
<?php } ?>
<form class="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
	<input type="hidden" name="cmd" value="_s-xclick">
	<input type="hidden" name="hosted_button_id" value="ZS8QKKQD3C7TG">
	<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG_global.gif" border="0" name="submit" alt="PayPal — The safer, easier way to pay online.">
	<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
<p class="flattr">Make a donation through flattr:
	<a href="https://flattr.com/donation/give/to/OneEurope"
	  title="Donate (via Flattr)"><img
	    src="<?php Site::out_url( 'theme' )?>/img/flattr_donate_normal.png"
	    title="Support my Debian work (Flattr)"
	    onmouseover="this.src='<?php Site::out_url( 'theme' )?>/img/flattr_donate_hover.png'"
	    onmouseout="this.src='<?php Site::out_url( 'theme' )?>/img/flattr_donate_normal.png'"
	    alt="Flattr donation button" />
	</a>
</p>
<?php echo $theme->display('footer'); ?>
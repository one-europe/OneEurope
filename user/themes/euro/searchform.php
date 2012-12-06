<form method="get" id="searchform" action="<?php URL::out('display_search'); ?>">
	
	<input type="text" name="criteria" id="search-box" 
	<?php if ( @$criteria ) { ?> 
		value="<?php echo $criteria; ?>"
	<?php } else { ?>
value="Search the database" onclick="clickclear(this, 'Search the database')" onblur="clickrecall(this,'Search the database')"
	<?php } ?>
	/>
	
	<input src="<?php Site::out_url( 'theme' ); ?>/img/searchbutton.gif" type="image" alt="Search" id="submitsearch" title="<?php _e( "Go" ); ?>">
</form>
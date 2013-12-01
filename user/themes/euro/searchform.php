<form method="get" id="searchform" action="<?php URL::out('display_search'); ?>">
	<input type="text" name="criteria" id="search-box" data-placeholder="Search"
		value="<?php echo (@$criteria) ? $criteria : 'Search'; ?>"	/>
	<input src="<?php Site::out_url( 'theme' ); ?>/img/searchbutton.gif" type="image" alt="Search" 
		id="submitsearch" title="<?php _e( "Go" ); ?>">
</form>
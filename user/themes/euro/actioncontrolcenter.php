<div id="searchcontrol">
	<div class="h"><span>Control</span></div>
	<form method="get" id="controlbox" action="<?php URL::out('display_search'); ?>">
		<input type="text" name="criteria" id="search-box" data-placeholder="Search our articles" 
			value="<?php echo ($criteria) ? $criteria : 'Search the articles'; ?>" />
		<input type="hidden" alt="Search" id="submitsearch" title="<?php _e( "Go" ); ?>">
	</form>
</div>
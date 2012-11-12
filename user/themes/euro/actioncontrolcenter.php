<div id="searchcontrol">

	<div class="h"><span>Control</span></div>

	<form method="get" id="controlbox" action="<?php URL::out('display_search'); ?>">
	
		<input type="text" name="criteria" id="search-box" 
		<?php if ( $criteria ) { ?> 
			value="<?php echo $criteria; ?>"
		<?php } else { ?>
			value="Search our articles" onclick="clickclear(this, 'Search our articles')" onblur="clickrecall(this,'Search our articles')"
		<?php } ?>
		/>
		
		<input type="hidden" alt="Search" id="submitsearch" title="<?php _e( "Go" ); ?>">

	</form>
	
</div>
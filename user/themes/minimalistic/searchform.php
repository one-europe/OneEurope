<form method="get" id="searchform" action="<?php URL::out('display_search'); ?>">
	<input type="text" name="criteria" id="search-box" <?php if ( isset( $criteria ) ) { ?> value="<?php htmlentities($criteria, ENT_COMPAT, 'UTF-8'); ?>" <?php } else { ?> value="Suche" onclick="clickclear(this, 'Suche')" onblur="clickrecall(this,'Suche')" <?php } ?> />
	<input src="<?php Site::out_url( 'theme' ); ?>/img/searchbutton.gif" type="image" alt="Suchen" id="submitsearch" title="<?php _e( "Go" ); ?>">
</form>
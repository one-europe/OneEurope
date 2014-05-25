<?php if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); } ?>
<?php echo $theme->display('header'); ?>
	<div id="profiles">
		<?php if ( $this->matched_rule->name == 'display_profiles' ) {
			$profiles = $allprofiles; ?>
			<div class="submenu">
				<ul>
					<li><span class="first">Profiles ›</span></li>
					<li><a href="<?php Site::out_url( 'habari' ); ?>/contributors">Contributors</a></li>
					<li><a href="<?php Site::out_url( 'habari' ); ?>/profiles" class="selected">All</a></li>
					<li class="clear"></li>
				</ul>
			</div>
			<div class="list thumbs-profile">
				<h2>All profiles:</h2>
				<?php
				foreach ( $profiles as $profile ) { 
					if ($profile->info->user) {
						$source = User::get_by_id($profile->info->user)->info;
						$title = User::get_by_id($profile->info->user)->displayname;
				 	} else {
						$source = $profile->info;
						$title = $profile->title;
					} ?>						
				<div class="item">
					<div class="img-wrap-profile">
						<a href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>">
							<img src="<?php if ( $source->photourl ) { echo $source->photourl; } elseif ( $profile->info->photourl ) { echo $profile->info->photourl; } else { echo Site::out_url( 'theme' ) ?>/img/face.jpg<?php } ?>" alt="<?php echo $title; ?>" width="100" />
						</a>
					</div>
					<h3><a href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a></h1>
				</div>
				<?php } ?>
				<div class="clear"></div>
			</div>
		<?php } elseif ( $this->matched_rule->name == 'display_contributors' ) {
			$profiles = $contributors; ?>
			<div class="submenu">
				<ul>
					<li><span class="first">Profiles ›</span></li>
					<li><a href="<?php Site::out_url( 'habari' ); ?>/contributors" class="selected">Contributors</a></li>
					<li><a href="<?php Site::out_url( 'habari' ); ?>/profiles">All</a></li>
					<li class="clear"></li>
				</ul>
			</div>
			<div class="list thumbs-profile">
				<h2>Directors:</h2>
				<?php foreach ( $directors as $profile ) { 
					if ($profile->info->user) {
					$source = User::get_by_id($profile->info->user)->info;
						$title = User::get_by_id($profile->info->user)->displayname;
				 	} else {
						$source = $profile->info;
						$title = $profile->title;
					} ?>						
				<div class="item">
					<div class="img-wrap-profile">
						<a href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>">
							<img src="<?php if ( $source->photourl ) { echo $source->photourl; } elseif ( $profile->info->photourl ) { echo $profile->info->photourl; } else { echo Site::out_url( 'theme' ) ?>/img/face.jpg<?php } ?>" alt="<?php echo $title; ?>" width="100" />
						</a>
					</div>
					<h3><a href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a></h1>
				</div>
				<?php } ?>
				<div class="clear"></div>
			</div>
			<div class="list thumbs-profile">
				<h2>Editors:</h2>
				<?php foreach ( $editors as $profile ) { 
					if ($profile->info->user) {
						$source = User::get_by_id($profile->info->user)->info;
						$title = User::get_by_id($profile->info->user)->displayname;
				 	} else {
						$source = $profile->info;
						$title = $profile->title;
					} ?>						
				<div class="item">
					<div class="img-wrap-profile">
						<a href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>">
							<img src="<?php if ( $source->photourl ) { echo $source->photourl; } elseif ( $profile->info->photourl ) { echo $profile->info->photourl; } else { echo Site::out_url( 'theme' ) ?>/img/face.jpg<?php } ?>" alt="<?php echo $title; ?>" width="100" />
						</a>
					</div>
					<h3><a href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a></h1>
				</div>
				<?php } ?>
				<div class="clear"></div>
			</div>	
			<div class="list thumbs-profile">
				<h2>Authors:</h2>
				<?php foreach ( $authors as $profile ) { 
					if ($profile->info->user) {
						$source = User::get_by_id($profile->info->user)->info;
						$title = User::get_by_id($profile->info->user)->displayname;
				 	} else {
						$source = $profile->info;
						$title = $profile->title;
					} ?>						
				<div class="item">
					<div class="img-wrap-profile">
						<a href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>">
							<img src="<?php if ( $source->photourl ) { echo $source->photourl; } elseif ( $profile->info->photourl ) { echo $profile->info->photourl; } else { echo Site::out_url( 'theme' ) ?>/img/face.jpg<?php } ?>" alt="<?php echo $title; ?>" width="100" />
						</a>
					</div>
					<h3><a href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a></h1>
				</div>
				<?php } ?>
				<div class="clear"></div>
			</div>					
			<div class="list thumbs-profile">
				<h2>Ambassadors:</h2>
				<?php foreach ( $ambassadors as $profile ) { 
					if ($profile->info->user) {
						$source = User::get_by_id($profile->info->user)->info;
						$title = User::get_by_id($profile->info->user)->displayname;
				 	} else {
						$source = $profile->info;
						$title = $profile->title;
					} ?>						
				<div class="item">
					<div class="img-wrap-profile">
						<a href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>">
							<img src="<?php if ( $source->photourl ) { echo $source->photourl; } elseif ( $profile->info->photourl ) { echo $profile->info->photourl; } else { echo Site::out_url( 'theme' ) ?>/img/face.jpg<?php } ?>" alt="<?php echo $title; ?>" width="100" />
						</a>
					</div>
					<h3><a href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a></h1>
				</div>
				<?php } ?>
				<div class="clear"></div>
			</div>			
			<div class="list thumbs-profile">
				<h2>IT Development:</h2>
				<?php foreach ( $itdept as $profile ) { 
					if ($profile->info->user) {
						$source = User::get_by_id($profile->info->user)->info;
						$title = User::get_by_id($profile->info->user)->displayname;
				 	} else {
						$source = $profile->info;
						$title = $profile->title;
					} ?>						
				<div class="item">
					<div class="img-wrap-profile">
						<a href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>">
							<img src="<?php if ( $source->photourl ) { echo $source->photourl; } elseif ( $profile->info->photourl ) { echo $profile->info->photourl; } else { echo Site::out_url( 'theme' ) ?>/img/face.jpg<?php } ?>" alt="<?php echo $title; ?>" width="100" />
						</a>
					</div>
					<h3><a href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a></h1>
				</div>
				<?php } ?>
				<div class="clear"></div>
			</div>
			<div class="list thumbs-profile">
				<h2>Fundraising:</h2>
				<?php foreach ( $fundraising as $profile ) { 
					if ($profile->info->user) {
						$source = User::get_by_id($profile->info->user)->info;
						$title = User::get_by_id($profile->info->user)->displayname;
				 	} else {
						$source = $profile->info;
						$title = $profile->title;
					} ?>						
				<div class="item">
					<div class="img-wrap-profile">
						<a href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>">
							<img src="<?php if ( $source->photourl ) { echo $source->photourl; } elseif ( $profile->info->photourl ) { echo $profile->info->photourl; } else { echo Site::out_url( 'theme' ) ?>/img/face.jpg<?php } ?>" alt="<?php echo $title; ?>" width="100" />
						</a>
					</div>
					<h3><a href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a></h1>
				</div>
				<?php } ?>
				<div class="clear"></div>
			</div>
			<div class="list thumbs-profile">
				<h2>Partner Organizations:</h2>
				<?php foreach ( $partners as $profile ) { 
					if ($profile->info->user) {
						$source = User::get_by_id($profile->info->user)->info;
						$title = User::get_by_id($profile->info->user)->displayname;
				 	} else {
						$source = $profile->info;
						$title = $profile->title;
					} ?>						
				<div class="item">
					<div class="img-wrap-profile">
						<a href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>">
							<img src="<?php if ( $source->photourl ) { echo $source->photourl; } elseif ( $profile->info->photourl ) { echo $profile->info->photourl; } else { echo Site::out_url( 'theme' ) ?>/img/face.jpg<?php } ?>" alt="<?php echo $title; ?>" width="100" />
						</a>
					</div>
					<h3><a href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a></h1>
				</div>
				<?php } ?>
				<div class="clear"></div>
			</div>
			<div class="list thumbs-profile">
				<h2>Former Partners and Associates:</h2>
				<?php foreach ( $formerpartners as $profile ) { 
					if ($profile->info->user) {
						$source = User::get_by_id($profile->info->user)->info;
						$title = User::get_by_id($profile->info->user)->displayname;
				 	} else {
						$source = $profile->info;
						$title = $profile->title;
					} ?>						
				<div class="item">
					<div class="img-wrap-profile">
						<a href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>">
							<img src="<?php if ( $source->photourl ) { echo $source->photourl; } elseif ( $profile->info->photourl ) { echo $profile->info->photourl; } else { echo Site::out_url( 'theme' ) ?>/img/face.jpg<?php } ?>" alt="<?php echo $title; ?>" width="100" />
						</a>
					</div>
					<h3><a href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a></h1>
				</div>
				<?php } ?>
				<div class="clear"></div>
			</div>
		<?php } ?>
	</div>
<?php echo $theme->display('footer'); ?>
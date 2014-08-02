<?php if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); } ?>
<?php echo $theme->display('header'); ?>
	<?php if ( $this->matched_rule->name == 'display_profiles' ) {
		$profiles = $allprofiles; ?>
		<div class="breadcrumbs">
			<a href="<?php Site::out_url( 'habari' ); ?>/contributors">Team</a>
			<b>All Profiles</b>
		</div>
		<article class="full">
		<h1>All profiles</h1>
		<?php
		foreach ( $profiles as $profile ) { 
			if ($profile->info->user) {
				$source = User::get_by_id($profile->info->user)->info;
				$title = User::get_by_id($profile->info->user)->displayname;
		 	} else {
				$source = $profile->info;
				$title = $profile->title;
			} ?>						
		<a class="profile" href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>">
			<span class="img-wrap-profile">
				<img src="<?php if ( $source->photourl ) { echo $source->photourl; } elseif ( $profile->info->photourl ) { echo $profile->info->photourl; } else { echo Site::out_url( 'theme' ) ?>/img/face.jpg<?php } ?>" alt="<?php echo $title; ?>" width="100" height="125" />
			</span>
			<h3><?php echo $title; ?></h3>
		</a>
		<?php } ?>
	<?php } elseif ( $this->matched_rule->name == 'display_contributors' ) {
		$profiles = $contributors; ?>
		<div class="breadcrumbs">
			<a href="<?php Site::out_url( 'habari' ); ?>/about">About</a>
			<a href="<?php Site::out_url( 'habari' ); ?>/join-us">Join us</a>
			<b>Team</b>
			<a href="<?php Site::out_url( 'habari' ); ?>/donate">Donate</a>
			<a href="<?php Site::out_url( 'habari' ); ?>/become-a-patron">Become a Patron</a>
			<a href="<?php Site::out_url( 'habari' ); ?>/contact">Contact</a>
			<a href="<?php Site::out_url( 'habari' ); ?>/imprint">Terms</a>
		</div>
		<article class="full">
		<h2>Directors:</h2>
		<?php foreach ( $directors as $profile ) { 
			if ($profile->info->user) {
			$source = User::get_by_id($profile->info->user)->info;
				$title = User::get_by_id($profile->info->user)->displayname;
		 	} else {
				$source = $profile->info;
				$title = $profile->title;
			} ?>						
		<a class="profile" href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>">
			<span class="img-wrap-profile">
				<img src="<?php if ( $source->photourl ) { echo $source->photourl; } elseif ( $profile->info->photourl ) { echo $profile->info->photourl; } else { echo Site::out_url( 'theme' ) ?>/img/face.jpg<?php } ?>" alt="<?php echo $title; ?>" width="100" height="125" />
			</span>
			<h3><?php echo $title; ?></h3>
		</a>
		<?php } ?>
		<h2>Editors:</h2>
		<?php foreach ( $editors as $profile ) { 
			if ($profile->info->user) {
				$source = User::get_by_id($profile->info->user)->info;
				$title = User::get_by_id($profile->info->user)->displayname;
		 	} else {
				$source = $profile->info;
				$title = $profile->title;
			} ?>						
		<a class="profile" href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>">
			<span class="img-wrap-profile">
				<img src="<?php if ( $source->photourl ) { echo $source->photourl; } elseif ( $profile->info->photourl ) { echo $profile->info->photourl; } else { echo Site::out_url( 'theme' ) ?>/img/face.jpg<?php } ?>" alt="<?php echo $title; ?>" width="100" height="125" />
			</span>
			<h3><?php echo $title; ?></h3>
		</a>
		<?php } ?>
		<h2>Authors:</h2>
		<?php foreach ( $authors as $profile ) { 
			if ($profile->info->user) {
				$source = User::get_by_id($profile->info->user)->info;
				$title = User::get_by_id($profile->info->user)->displayname;
		 	} else {
				$source = $profile->info;
				$title = $profile->title;
			} ?>						
		<a class="profile" href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>">
			<span class="img-wrap-profile">
				<img src="<?php if ( $source->photourl ) { echo $source->photourl; } elseif ( $profile->info->photourl ) { echo $profile->info->photourl; } else { echo Site::out_url( 'theme' ) ?>/img/face.jpg<?php } ?>" alt="<?php echo $title; ?>" width="100" height="125" />
			</span>
			<h3><?php echo $title; ?></h3>
		</a>
		<?php } ?>
		<h2>Ambassadors:</h2>
		<?php foreach ( $ambassadors as $profile ) { 
			if ($profile->info->user) {
				$source = User::get_by_id($profile->info->user)->info;
				$title = User::get_by_id($profile->info->user)->displayname;
		 	} else {
				$source = $profile->info;
				$title = $profile->title;
			} ?>						
		<a class="profile" href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>">
			<span class="img-wrap-profile">
				<img src="<?php if ( $source->photourl ) { echo $source->photourl; } elseif ( $profile->info->photourl ) { echo $profile->info->photourl; } else { echo Site::out_url( 'theme' ) ?>/img/face.jpg<?php } ?>" alt="<?php echo $title; ?>" width="100" height="125" />
			</span>
			<h3><?php echo $title; ?></h3>
		</a>
		<?php } ?>
		<h2>IT Development:</h2>
		<?php foreach ( $itdept as $profile ) { 
			if ($profile->info->user) {
				$source = User::get_by_id($profile->info->user)->info;
				$title = User::get_by_id($profile->info->user)->displayname;
		 	} else {
				$source = $profile->info;
				$title = $profile->title;
			} ?>						
		<a class="profile" href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>">
			<span class="img-wrap-profile">
				<img src="<?php if ( $source->photourl ) { echo $source->photourl; } elseif ( $profile->info->photourl ) { echo $profile->info->photourl; } else { echo Site::out_url( 'theme' ) ?>/img/face.jpg<?php } ?>" alt="<?php echo $title; ?>" width="100" height="125" />
			</span>
			<h3><?php echo $title; ?></h3>
		</a>
		<?php } /* ?>
		<h2>Fundraising:</h2>
		<?php foreach ( $fundraising as $profile ) { 
			if ($profile->info->user) {
				$source = User::get_by_id($profile->info->user)->info;
				$title = User::get_by_id($profile->info->user)->displayname;
		 	} else {
				$source = $profile->info;
				$title = $profile->title;
			} ?>						
		<a class="profile" href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>">
			<span class="img-wrap-profile">
				<img src="<?php if ( $source->photourl ) { echo $source->photourl; } elseif ( $profile->info->photourl ) { echo $profile->info->photourl; } else { echo Site::out_url( 'theme' ) ?>/img/face.jpg<?php } ?>" alt="<?php echo $title; ?>" width="100" height="125" />
			</span>
			<h3><?php echo $title; ?></h3>
		</a>
		<?php } */ ?>
		<h2>Partner Organizations:</h2>
		<?php foreach ( $partners as $profile ) { 
			if ($profile->info->user) {
				$source = User::get_by_id($profile->info->user)->info;
				$title = User::get_by_id($profile->info->user)->displayname;
		 	} else {
				$source = $profile->info;
				$title = $profile->title;
			} ?>						
		<a class="profile" href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>">
			<span class="img-wrap-profile">
				<img src="<?php if ( $source->photourl ) { echo $source->photourl; } elseif ( $profile->info->photourl ) { echo $profile->info->photourl; } else { echo Site::out_url( 'theme' ) ?>/img/face.jpg<?php } ?>" alt="<?php echo $title; ?>" width="100" height="125" />
			</span>
			<h3><?php echo $title; ?></h3>
		</a>
		<?php } ?>
	<?php } ?>
</article>
<?php echo $theme->display('footer'); ?>
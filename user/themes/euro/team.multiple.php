<?php if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); } ?>
<?php echo $theme->display('header'); ?>
<?php if ( $this->matched_rule->name == 'display_team' ) { ?>
	<div class="breadcrumbs">
		<a href="<?php Site::out_url( 'habari' ); ?>/about">About</a>
		<a href="<?php Site::out_url( 'habari' ); ?>/join-us">Join us</a>
		<b>Team</b>
		<a href="<?php Site::out_url( 'habari' ); ?>/donate">Donate</a>
		<a href="<?php Site::out_url( 'habari' ); ?>/become-a-patron">Become a Patron</a>
		<a href="<?php Site::out_url( 'habari' ); ?>/contact">Contact</a>
	</div>
	<article class="full">
		<p class="pic-here"><b>Want to see your pic here? Find out how you can <a href="<?php Site::out_url( 'habari' ); ?>/join-us">Join Us</a>!</b></p>
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
		<div class="team-left">
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
		</div>
		<div class="team-right">
			<h2>Website Development:</h2>
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
		<?php } ?>
		</div>
		<div class="team-right">
			<h2>Project Management:</h2>
			<?php foreach ( $projectManager as $profile ) { 
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
		</div>
		<div class="team-right">
			<h2>Design:</h2>
			<?php foreach ( $designers as $profile ) { 
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
		</div>
		<div class="team-left">
			<h2>Social Media Editors:</h2>
			<?php foreach ( $socialMedia as $profile ) { 
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
		</div>
		<div class="team-right">
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
		</div>
		<div class="team-left">
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
		</div>
		<div class="team-left">
			<h2>Former Editors:</h2>
			<?php foreach ( $formerEditor as $profile ) { 
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
		</div>
		<div class="team-left">
			<h2>Former Social Media Editors:</h2>
			<?php foreach ( $formerSocialMedia as $profile ) { 
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
		</div>
		<div class="team-left">
			<h2>Contributors:</h2>
			<?php foreach ( $contributors as $profile ) { 
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
		</div>
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
	</article>
<?php } ?>
<?php echo $theme->display('footer'); ?>
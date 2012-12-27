<?php if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); } ?>
<?php echo $theme->display('header'); ?>

			<div id="profiles">
								
				<!-- list of profiles ordered by date	 -->
								
				
				<?php if ( $this->matched_rule->name == 'display_profiles' ) {
					$profiles = $allprofiles; ?>
				
				
					<div class="submenu">
						<ul>
							<li><span class="first">Profiles ›</span></li>
							<li><a href="/contributors">Contributors</a></li>
							<li><a href="/profiles" class="selected">All</a></li>
							<li class="clear"></li>
						</ul>
					</div>

					<div class="list">

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

							<a href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>"><img src="<?php Site::out_url( 'theme' ); ?>/img/grey.gif" data-original="<?php if ( $source->photourl ) { echo $source->photourl; } elseif ( $profile->info->photourl ) { echo $profile->info->photourl; } else { echo Site::out_url( 'theme' ) ?>/img/face.jpg<?php } ?>" alt="<?php echo $title; ?>" width="100" /></a>

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
							<li><a href="/contributors" class="selected">Contributors</a></li>
							<li><a href="/profiles">All</a></li>
							<li class="clear"></li>
						</ul>
					</div>
								
					<div class="list">
						
						
						<div class="list">

							<h2>Founders:</h2>

							<?php foreach ( $founders as $profile ) { 
								if ($profile->info->user) {
									$source = User::get_by_id($profile->info->user)->info;
									$title = User::get_by_id($profile->info->user)->displayname;
							 	} else {
									$source = $profile->info;
									$title = $profile->title;
								} ?>						

							<div class="item">

								<a href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>"><img src="<?php Site::out_url( 'theme' ); ?>/img/grey.gif" data-original="<?php if ( $source->photourl ) { echo $source->photourl; } elseif ( $profile->info->photourl ) { echo $profile->info->photourl; } else { echo Site::out_url( 'theme' ) ?>/img/face.jpg<?php } ?>" alt="<?php echo $title; ?>" width="100" /></a>

								<h3><a href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a></h1>

							</div>

							<?php } ?>

							<div class="clear"></div>

						</div>


						
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

							<a href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>"><img src="<?php Site::out_url( 'theme' ); ?>/img/grey.gif" data-original="<?php if ( $source->photourl ) { echo $source->photourl; } elseif ( $profile->info->photourl ) { echo $profile->info->photourl; } else { echo Site::out_url( 'theme' ) ?>/img/face.jpg<?php } ?>" alt="<?php echo $title; ?>" width="100" /></a>
							
							<h3><a href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a></h1>

						</div>

						<?php } ?>
					
						<div class="clear"></div>
				
					</div>					
		
		
		
					<div class="list">
						
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

							<a href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>"><img src="<?php Site::out_url( 'theme' ); ?>/img/grey.gif" data-original="<?php if ( $source->photourl ) { echo $source->photourl; } elseif ( $profile->info->photourl ) { echo $profile->info->photourl; } else { echo Site::out_url( 'theme' ) ?>/img/face.jpg<?php } ?>" alt="<?php echo $title; ?>" width="100" /></a>
							
							<h3><a href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a></h1>

						</div>

						<?php } ?>
					
						<div class="clear"></div>
				
					</div>			
					
		
					<div class="list">

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

							<a href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>"><img src="<?php Site::out_url( 'theme' ); ?>/img/grey.gif" data-original="<?php if ( $source->photourl ) { echo $source->photourl; } elseif ( $profile->info->photourl ) { echo $profile->info->photourl; } else { echo Site::out_url( 'theme' ) ?>/img/face.jpg<?php } ?>" alt="<?php echo $title; ?>" width="100" /></a>

							<h3><a href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a></h1>

						</div>

						<?php } ?>

						<div class="clear"></div>

					</div>
					
					
					<div class="list">

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

							<a href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>"><img src="<?php Site::out_url( 'theme' ); ?>/img/grey.gif" data-original="<?php if ( $source->photourl ) { echo $source->photourl; } elseif ( $profile->info->photourl ) { echo $profile->info->photourl; } else { echo Site::out_url( 'theme' ) ?>/img/face.jpg<?php } ?>" alt="<?php echo $title; ?>" width="100" /></a>

							<h3><a href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a></h1>

						</div>

						<?php } ?>

						<div class="clear"></div>

					</div>
	
	
				<?php } ?>
		
			</div>

<?php echo $theme->display ('footer'); ?>


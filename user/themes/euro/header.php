<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" prefix="og: http://ogp.me/ns#"> <!--<![endif]-->

	<head>
				
		<title><?php echo Options::get( 'title' ); ?></title>
		
		<meta name="Generator" content="Habari" />		
		<meta name="viewport" content="width=device-width; initial-scale=1.0" />

		<link rel="sitemap" type="application/xml" title="Sitemap" href="sitemap.xml" />
		
		<!-- link rel="alternate" type="application/atom+xml" title="Atom 1.0" href="/atom/1" / -->
		<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="/rss/1" />
		
		<!-- link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php URL::out( 'rsd' ); ?>" / -->
		
		<link rel="shortcut icon" href="<?php Site::out_url( 'theme' ); ?>/img/favicon.ico" />

		<link href="<?php Site::out_url( 'theme' ); ?>/img/apple-touch-icon.png" rel="apple-touch-icon" />
		<link href="<?php Site::out_url( 'theme' ); ?>/img/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72" />
		<link href="<?php Site::out_url( 'theme' ); ?>/img/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114" />
		<link href="<?php Site::out_url( 'theme' ); ?>/img/apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144" />
		
		<link rel="stylesheet" media="screen" type="text/css" href="<?php Site::out_url( 'theme' ); ?>/css/style.css?<?php echo date_timestamp_get(date_create()); ?>" />
				
		<?php echo $theme->header(); ?>		
		
		<script src="<?php Site::out_url( 'theme' ); ?>/js/libs/modernizr-2.5.3.min.js"></script>

		<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
		<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4fe91cf356685c8e"></script>

	</head>

	<body id="top">
				
		<!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
		
		<div id="fb-root"></div>
		<script>
		(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) {return;}
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=121944181248560";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		</script>
		
		<div id="wrapper">
			
			<div id="head">
			
				<?php /** useful, but out of use <a id="headerbadge" href="<?php Site::out_url( 'habari' ); ?>/europeday"><img src="<?php Site::out_url( 'theme' ); ?>/img/static/badge.png" width="100" height="100" alt="Celebrate Europe Day with a profile banner in your language!" /></a> */ ?>

				<a id="logo" href="<?php Site::out_url( 'habari' ); ?>"><img src="<?php Site::out_url( 'theme' ); ?>/img/grey.gif" data-original="<?php Site::out_url( 'theme' ); ?>/img/logo.png" width="326" height="110" alt="OneEurope" style="margin: 15px 0 0 5px;"/></a>
					
				<nav>
					
					<ul class="sf-menu">
						<li class="menu_1">
							<a rel="section" class="sf-with-ul" href="<?php Site::out_url( 'habari' ); ?>/debates">Debate</a>
							<ul class="subnav">
								<li class="col1">
									<div>
										<h3>Information.</h3>
										<p>Here you can find a great variety of analyses and comments on both general and recent topics.</p>
									</div>
								</li>
								<li class="col2">
									<div>
										<p>Trending Debates</p>
										<ul class="cats">
											<?php foreach ($menus as $post ) { ?>

												<li>
													<a class="sf-with-ul" href="<?php echo $post->permalink; ?>"><?php echo $post->title_out; ?></a>
												</li>

											<?php } ?>

											<li class="all"><a href="<?php Site::out_url( 'habari' ); ?>/debates">› all debates</a></li>

										</ul>
									</div>
								</li>
								<li class="col3">

									<div>
										<p>In the Headlines</p>
										<ul class="cats">

											<?php $inits = Posts::get( array( 'content_type' => 'initiative', 'status' => 'published', 'limit' => 5 ) );
											foreach ($inits as $init ) { ?>

												<li>
													<a class="sf-with-ul" href="<?php echo $init->permalink; ?>"><?php echo $init->title_out; ?></a>
												</li>

											<?php } ?>

											<li class="all"><a href="<?php Site::out_url( 'habari' ); ?>/initiatives">› all initiatives</a></li>

										</ul>

									</div>

									<?php /* 
										$posts = Posts::get( array( 'content_type' => 'debate', 'status' => 'published', 'limit' => 1 /* attention: $i / ) );
										foreach ($posts as $post ) { 

											$id = $post->id;
											$teasers = Posts::get( array( 'all:info' => array( 'debate' => $id ), 'limit' => 4 ) ); 
											$i = 1;
											foreach ( $teasers as $teaser ) { ?>

												<?php if ($i == 1) { ?>
														<article>
															<header>
																<h4><a href="<?php echo $teaser->permalink; ?>"><?php echo $teaser->title_out ?></a></h4>
															</header>
															<span class="excerpt"><?php if ( $teaser->info->excerpt ) { echo $teaser->info->excerpt;} else { echo $teaser->content_excerpt; } ?></span>
															<span class="clear block"></span>
														</article>
												<?php $i++; } else { ?>
												<a href="<?php echo $teaser->permalink; ?>">› <?php echo $teaser->title; ?></a><br/>
												<?php $i++; } ?>

											<?php } ?>

										<?php } */ ?>

								</li>
							</ul>
						</li>
						<li class="menu_2">
							<a rel="section" class="sf-with-ul" href="<?php Site::out_url( 'habari' ); ?>/initiatives">Civic Action</a>
						</li>
						<li class="menu_3">
							<a rel="section" class="sf-with-ul" href="<?php Site::out_url( 'habari' ); ?>/in-brief">The Big Picture</a>
						</li>
						<li class="menu_4">
							<a rel="section" class="sf-with-ul" href="#">About</a>
							<ul class="subnav">
								<li class="col1">
									<div>
										<h3>The Platform</h3>
										<p>Find out more about this community driven platform, its purpose, the people who make it and what it aims for.</p>
									</div>
								</li>
								<li class="col2">
									<div>
										<p>Yet only available in English, OneEurope's aims will soon drive it to cross new borders.
											<a href="<?php Site::out_url( 'habari' ); ?>/about">Learn more ›</a>
										</p>
										<p>Whether you're from an organisation, whether you are a blogger, journalist, activist or individual - if you
											can identify yourself with our goal, try to find out more about the many ways to <a href="<?php Site::out_url( 'habari' ); ?>/join-us">join our network of partners and contributors ›</a></p>
										<p>Please also consider <a href="<?php Site::out_url( 'habari' ); ?>/become-a-patron">supporting us financially ›</a></p>
									</div>
								</li>
								<li class="col3">
									<div>
										<p>More:</p>
										<ul class="cats">
											<li><a href="<?php Site::out_url( 'habari' ); ?>/about">› The Project</a></li>
											<li><a href="<?php Site::out_url( 'habari' ); ?>/contributors">› The Team</a></li>
											<li><a href="<?php Site::out_url( 'habari' ); ?>/become-a-patron">› Become a patron</a></li>
											<li><a href="<?php Site::out_url( 'habari' ); ?>/join-us">› How to get involved</a></li>
											<li><a href="<?php Site::out_url( 'habari' ); ?>/contact">› Contact</a></li>
										</ul>
									</div>
								</li>
							</ul>
						</li>
						<li class="menu_5">
							<?php echo $theme->display ('searchform' ); ?>
						</li>
					</ul>
					
				</nav>

				<div class="sm-buttons">
				
					<ul>
						<li><a href="https://facebook.com/OneEurope" target="_new"><img height="25" width="25" src="<?php Site::out_url( 'theme' ); ?>/img/social/facebook.png" title="Find us on Facebook" alt=""/></a></li>
						<li><a href="https://twitter.com/one1europe" target="_new"><img height="25" width="25" src="<?php Site::out_url( 'theme' ); ?>/img/social/twitter.png" title="Follow us on Twitter" alt=""/></a></li>
						<li><a href="https://plus.google.com/118353934830681553476/posts" target="_new"><img height="25" width="25" src="<?php Site::out_url( 'theme' ); ?>/img/social/googleplus.png" title="Add us to your circles" alt=""/></a></li>
						<li><a href="http://pinterest.com/oneeurope" target="_new"><img height="25" width="25" src="<?php Site::out_url( 'theme' ); ?>/img/social/pinterest.png" title="Find us on Pinterest" alt=""/></a></li>
						<li><a href="http://www.stumbleupon.com/stumbler/OneEurope" target="_new"><img height="25" width="25" src="<?php Site::out_url( 'theme' ); ?>/img/social/stumbleupon.png" title="Find us on StumbleUpon" alt=""/></a></li>
						<li><a href="http://www.linkedin.com/company/oneeurope" target="_new"><img height="25" width="25" src="<?php Site::out_url( 'theme' ); ?>/img/social/linkedin.png" title="Find us on LinkedIn" alt=""/></a></li>
						<li><a href="/feeds"><img height="25" width="25" src="<?php Site::out_url( 'theme' ); ?>/img/social/feed.png" title="Subscribe via RSS" alt=""/></a></li>
						<!-- icon missing <li><a href="http://eepurl.com/pODn9" target="_new"><img height="25" width="25" src="<?php Site::out_url( 'theme' ); ?>/img/social/linkedin.png" title="Subscribe to our newsletter" alt=""/></a></li> -->
					</ul>
				
				</div>
										
				<div class="clear"></div>
				
				
				<div id="subnav">
					
					<ul>
						
						<li class="static">Debates:</li>
						
						<?php foreach($menus as $debate) {?>
							<li><a href="<?php echo $debate->permalink ?>" title="<?php echo $debate->title; ?>"><?php echo $debate->info->shorttitle; ?></a></li>
						<?php } ?>
						
						<li class="clear"></li>
						
					</ul>
					
				</div>
				
														
			</div>
			
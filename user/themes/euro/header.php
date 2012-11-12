<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" prefix="og: http://ogp.me/ns#"> <!--<![endif]-->

	<head>
				
		<title><?php $title = Options::get( 'title' ); 
			if ( isset($post) && !$request->display_debates && !$request->display_profiles && !$request->display_contributors && !$request->display_nibbles ) {
				echo "{$post->title} - {$title}"; 
			} elseif ( $request->display_debates ) {
				echo "All Debates - {$title}"; 
			} elseif ( $request->display_profiles ) {
				echo "Profiles › All Profiles - {$title}";
			} elseif ( $request->display_contributors ) {
				echo "Profiles › Contributors - {$title}";
			} elseif ( $request->display_nibbles ) {
				echo "In Brief - {$title}";
			} else { 
				Options::out( 'title' ); 
		}?></title>
		
		<meta name="Generator" content="Habari" />		
		<meta name="viewport" content="width=device-width; initial-scale=1.0" />

		<link type="application/xml" title="Sitemap" href="/sitemap.xml" />
		
		<link rel="alternate" type="application/atom+xml" title="Atom 1.0" href="/atom/1" />
		<!-- link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php URL::out( 'rsd' ); ?>" / -->
		
		<!-- link rel="shortcut icon" href="<?php Site::out_url( 'theme' ); ?>/images/favicon.ico" / -->
		<link rel="stylesheet" media="screen" type="text/css" href="<?php Site::out_url( 'theme' ); ?>/style.css" />
				
		<?php echo $theme->header(); ?>		
		
		<script src="<?php Site::out_url( 'theme' ); ?>/js/libs/modernizr-2.5.3.min.js"></script>

		<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
		<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4fe91cf356685c8e"></script>

	</head>

	<body id="top" onload="initmap()">
				
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
				
				<a id="logo" href="<?php Site::out_url( 'habari' ); ?>"><img src="<?php Site::out_url( 'theme' ); ?>/img/grey.gif" data-original="<?php Site::out_url( 'theme' ); ?>/img/logo.png" width="326" height="110" alt="OneEurope" style="margin: 15px 0 0 5px;"/></a>
					
				<nav>
					
					<ul class="sf-menu">
						<?php /*<li>
							<a href="#">YourEurope</a>
							<ul class="menu_1">
								<li>
									<h5>Why should I care?</h5>
									<p>This section is completely about the european idea, the european integration, facts about its history and perspectives and other general information about pros and cons of an united Europe.</p>
								<li>
									<a href="#">YourSociety</a></br>
									<img src="http://wirtschaft.t-online.de/b/42/00/08/12/id_42000812/tid_da/die-europaeische-zentralbank-ezb-verteidigt-das-rettungspaket-fuer-den-euro-foto-imago-.jpg" height="100" width="140" /></li>
								</li>
								<li><a href="#">YourEconomy</a></li>
								<li><a href="#">YourPolitics</a></li>
							</ul>
						</li> */ ?>
						<li class="menu_1_5">
							<a href="<?php Site::out_url( 'habari' ); ?>/forum">Forum</a>
						</li>
						<li class="menu_2">
							<a class="sf-with-ul" href="#">Debate</a>
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
								<li class="col4">
									<h3><a href="/forum">Forum ›</a></h3>
									<p>Get involved. Join the discussion, see different perspectives and come to new insights!</p>
								</li>
							</ul>
						</li>
						<li class="menu_3">
							<a href="#">Network</a>
							<ul class="subnav">
								<li class="col1">
									<div>
										<h3>The Scene.</h3>
										<p>Have a look at our database of the who is who of the European public sphere. And help us extend it.</p>
									</div>
								</li>
								<li class="col2">
									<div>
										<p>
											Have a look at our profile database of the who's who in Europe. Ask for your own profile.
											<span class="all"><a href="<?php Site::out_url( 'habari' ); ?>/profiles">Stay updated ›</a></span>
										</p>
										<p>
											Our content comes from a great range of contributors. Have a look at the individuals and organisations 
											<span class="all"><a href="<?php Site::out_url( 'habari' ); ?>/contributors">behind us ›</a></span><br/>
										</p>
									</div>
								</li>
								<li class="col3 partners">
									<div>
										<p>Become involved yourself and be OneEurope Ambassador in your area.</p>
										<p>There are so many ways of <a href="/join-us">getting involved</a>.</p>
									</div>
								</li>
							</ul>
						</li>
						<li class="menu_4">
							<a href="<?php Site::out_url( 'habari' ); ?>/about">About</a>
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
											can identify with our goals, find out more about the many ways to <a href="<?php Site::out_url( 'habari' ); ?>/join-us">join our network of partners and contributors ›</a></p>
									</div>
								</li>
								<li class="col3">
									<div>
										<p>More:</p>
										<ul class="cats">
											<li><a href="<?php Site::out_url( 'habari' ); ?>/about">› About us</a></li>
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
										
				<div class="clear"></div>
														
			</div>
			
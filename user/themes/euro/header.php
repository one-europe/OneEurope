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
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

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
		<script src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4fe91cf356685c8e"></script>

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

				<?php if ($home_page) echo '<h1>'; ?><a id="logo" href="<?php Site::out_url( 'habari' ); ?>" title="OneEurope — One Society, One Democracy, One Europe">OneEurope — One Society, One Democracy, One Europe</a><?php if ($home_page) echo '</h1>'; ?>
					
				<nav>
					
					<ul class="sf-menu">
						<li class="menu_1">
							<a rel="section" class="sf-with-ul" href="<?php Site::out_url( 'habari' ); ?>/in-brief">The Big Picture</a>
						</li>
						<li class="menu_2">
							<a rel="section" class="sf-with-ul" href="<?php Site::out_url( 'habari' ); ?>/initiatives">Initiatives</a>
						</li>
						<li class="menu_3">
							<a rel="section" class="sf-with-ul" href="<?php Site::out_url( 'habari' ); ?>/videos">Videos</a>
						</li>
						<li class="menu_4">
							<a rel="section" class="sf-with-ul" href="#">About</a>
							<ul class="subnav">
								<li class="col1">
									<div>
										<span class="subnav-header">The Platform</span>
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
					<span>Find us on:</span>
					<a href="https://facebook.com/OneEurope" class="icon-fb" title="Find us on Facebook" target="_blank"></a>
					<a href="https://twitter.com/one1europe" class="icon-tw" title="Follow us on Twitter" target="_blank"></a>
					<a href="https://plus.google.com/118353934830681553476/posts" class="icon-gp" title="Add us to your circles" target="_blank"></a>
					<a href="http://pinterest.com/oneeurope" class="icon-pi" title="Find us on Pinterest" target="_blank"></a>
					<a href="http://www.stumbleupon.com/stumbler/OneEurope" class="icon-st" title="Find us on StumbleUpon" target="_blank"></a>
					<a href="http://www.linkedin.com/company/oneeurope" class="icon-in" title="Find us on LinkedIn" target="_blank"></a>
					<a href="http://vk.com/oneeurope" class="icon-vk" title="Find us on VKontakte" target="_blank"></a>
					<a href="/feeds" class="icon-rs" title="Subscribe via RSS"></a>
				</div>
										
				<div class="clear"></div>
				
				<div id="subnav">
					<div class="debates">Debates:</div>
					<ul>
						<?php foreach($menus as $debate) {?>
							<li><a href="<?php echo $debate->permalink ?>" title="<?php echo $debate->title; ?>"><?php echo $debate->info->shorttitle; ?></a></li>
						<?php } ?>
					</ul>
				</div>
			</div>	
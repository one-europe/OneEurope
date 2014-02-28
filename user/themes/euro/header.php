<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title><?php echo Options::get( 'title' ); ?></title>
		<link rel="sitemap" type="application/xml" title="Sitemap" href="sitemap.xml" />
		<link rel="shortcut icon" href="<?php Site::out_url( 'theme' ); ?>/img/favicon.ico" />
		<link rel="stylesheet" media="screen" href="<?php Site::out_url( 'theme' ); ?>/css/style.css?<?php echo date_timestamp_get(date_create()); ?>" />
		<link rel="apple-touch-icon" href="<?php Site::out_url( 'theme' ); ?>/img/apple-touch-icon.png" />
		<link rel="apple-touch-icon" href="<?php Site::out_url( 'theme' ); ?>/img/apple-touch-icon-72x72.png" sizes="72x72" />
		<link rel="apple-touch-icon" href="<?php Site::out_url( 'theme' ); ?>/img/apple-touch-icon-114x114.png" sizes="114x114" />
		<link rel="apple-touch-icon" href="<?php Site::out_url( 'theme' ); ?>/img/apple-touch-icon-144x144.png" sizes="144x144" />
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
				<?php if ($home_page) echo '<h1>'; ?><a id="logo" href="<?php Site::out_url( 'habari' ); ?>" title="OneEurope — One Society, One Democracy, One Europe">OneEurope — One Society, One Democracy, One Europe</a><?php if ($home_page) echo '</h1>'; ?>
				<nav>
					<ul class="sf-menu">
						<li class="menu_1">
							<a rel="section" class="sf-with-ul" href="<?php Site::out_url( 'habari' ); ?>/in-brief">Images</a>
						</li>
						<li class="menu_2">
							<a rel="section" class="sf-with-ul" href="<?php Site::out_url( 'habari' ); ?>/videos">Videos</a>
						</li>
						<li class="menu_3">
							<a rel="section" class="sf-with-ul" href="<?php Site::out_url( 'habari' ); ?>/initiatives">Initiatives</a>
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
							<a rel="section" class="sf-with-ul" href="<?php Site::out_url( 'habari' ); ?>/join-us">Join us</a>
						</li>
						<li class="menu_6">
							<a rel="section" class="sf-with-ul" href="<?php Site::out_url( 'habari' ); ?>/crowdfunding">Crowdfunding</a>
						</li>
						<li class="menu_7">
							<?php echo $theme->display ('searchform' ); ?>
						</li>
					</ul>
				</nav>
				<div class="sm-buttons">
					<span>Find us on:</span>
					<a href="https://facebook.com/OneEurope" class="icon-fb" title="Find us on Facebook" target="_blank"></a>
					<a href="https://twitter.com/one1europe" class="icon-tw" title="Follow us on Twitter" target="_blank"></a>
					<a href="http://www.linkedin.com/company/oneeurope" class="icon-in" title="Find us on LinkedIn" target="_blank"></a>
					<a href="https://plus.google.com/118353934830681553476/posts" class="icon-gp" title="Add us to your circles" target="_blank"></a>
					<a href="http://pinterest.com/oneeurope" class="icon-pi" title="Find us on Pinterest" target="_blank"></a>
					<a href="http://www.stumbleupon.com/stumbler/OneEurope" class="icon-st" title="Find us on StumbleUpon" target="_blank"></a>
					<a href="http://vk.com/oneeurope" class="icon-vk" title="Find us on VKontakte" target="_blank"></a>
					<a href="/feeds" class="icon-rs" title="Subscribe via RSS"></a>
				</div>
				<div class="clear"></div>
				<?php if ($post->slug != 'crowdfunding') { ?>
				<div id="subnav">
					<div class="debates-list">
						<?php foreach($menus as $debate) {?>
							<span><a href="<?php echo $debate->permalink ?>" title="Debate – <?php echo $debate->title; ?>"><?php echo $debate->info->shorttitle; ?></a></span>
						<?php } ?>
					</div>
				</div>
				<?php } ?>
			</div>
			<a href="<?php Site::out_url( 'habari' ); ?>/crowdfunding" title="Together we build the Future of Europe!">
				<img style="margin: 0 0 20px;" src="<?php Site::out_url( 'theme' )?>/img/static/top-banner.png" width="950" height="124" />
			</a>
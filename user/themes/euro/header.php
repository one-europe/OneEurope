<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title><?php echo Options::get( 'title' ); ?></title>
	<link rel="sitemap" type="application/xml" title="Sitemap" href="sitemap.xml" />
	<link rel="shortcut icon" href="<?php Site::out_url( 'theme' ); ?>/img/favicon.ico" />
	<link rel="stylesheet" media="screen" href="<?php Site::out_url( 'theme' ); ?>/css/main.css?20140826" />
	<link rel="apple-touch-icon" href="<?php Site::out_url( 'theme' ); ?>/img/apple-touch-icon.png" />
	<link rel="apple-touch-icon" href="<?php Site::out_url( 'theme' ); ?>/img/apple-touch-icon-72x72.png" sizes="72x72" />
	<link rel="apple-touch-icon" href="<?php Site::out_url( 'theme' ); ?>/img/apple-touch-icon-114x114.png" sizes="114x114" />
	<link rel="apple-touch-icon" href="<?php Site::out_url( 'theme' ); ?>/img/apple-touch-icon-144x144.png" sizes="144x144" />
	<?php echo $theme->header(); ?>
	<!--[if lt IE 9]><script src="<?php Site::out_url( 'theme' ); ?>/js/html5shiv.min.js"></script><![endif]-->
</head>
<body>
	<header>
		<?php if ($home_page) { ?>
		<h1>
			<span>OneEurope - One Society, One Democracy, One Europe</span>
			<img src="<?php Site::out_url( 'theme' ); ?>/img/logo-normal.png" alt="OneEurope - One Society, One Democracy, One Europe" />
		</h1>
		<?php } else { ?>
		<div class="logo">
			<a href="<?php Site::out_url( 'habari' ); ?>" title="OneEurope - One Society, One Democracy, One Europe">
				<img src="<?php Site::out_url( 'theme' ); ?>/img/logo-normal.png" alt="OneEurope - One Society, One Democracy, One Europe" />
			</a>
		</div>
		<?php } ?>
		<nav>
			<a href="<?php Site::out_url( 'habari' ); ?>/in-brief">Images</a>
			<a href="<?php Site::out_url( 'habari' ); ?>/videos">Videos</a>
			<a href="<?php Site::out_url( 'habari' ); ?>/initiatives">Initiatives</a>
			<a href="<?php Site::out_url( 'habari' ); ?>/about">About</a>
			<a href="<?php Site::out_url( 'habari' ); ?>/join-us">Join Us</a>
			<a href="<?php Site::out_url( 'habari' ); ?>/donate">Donate</a>
			<form method="GET" id="searchform" action="<?php Site::out_url( 'habari' ); ?>/search">
				<input class="search-box" type="text" name="criteria" placeholder="Search" />
				<input class="search-submit" type="image" src="<?php Site::out_url( 'theme' ); ?>/img/searchbutton.gif" title="Go" />
			</form>
		</nav>
		<div class="social-buttons">
			<span>Find us on:</span>
			<a href="https://facebook.com/OneEurope" class="icon-fb" title="Find us on Facebook" target="_blank"></a>
			<a href="https://twitter.com/one1europe" class="icon-tw" title="Follow us on Twitter" target="_blank"></a>
			<a href="http://www.linkedin.com/company/oneeurope" class="icon-in" title="Find us on LinkedIn" target="_blank"></a>
			<a href="https://plus.google.com/118353934830681553476/posts" class="icon-gp" title="Add us to your circles" target="_blank"></a>
			<a href="http://pinterest.com/oneeurope" class="icon-pi" title="Find us on Pinterest" target="_blank"></a>
			<a href="http://www.stumbleupon.com/stumbler/OneEurope" class="icon-st" title="Find us on StumbleUpon" target="_blank"></a>
			<a href="http://vk.com/oneeurope" class="icon-vk" title="Find us on VKontakte" target="_blank"></a>
			<a href="<?php Site::out_url( 'habari' ); ?>/feeds" class="icon-rs" title="Subscribe via RSS"></a>
		</div>
		<div class="debates-list">
			<?php /*echo '<pre'; print_r($recent_debates); echo '</pre>';*/ ?>
			<?php foreach($recent_debates as $debate) {?>
				<span><a href="<?php echo $debate->permalink ?>" title="Debate – <?php echo $debate->title; ?>"><?php echo $debate->info->shorttitle; ?></a></span>
			<?php } ?>
		</div>
	</header>

	<main>
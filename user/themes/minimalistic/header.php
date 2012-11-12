<!DOCTYPE html>

<html>

	<head>
		
		<meta charset="utf-8" />
		
		<title><?php if($request->display_entry && isset($post)) { echo "{$post->title}"; } else { Options::out( 'title' ); } ?></title>
		
		<meta name="Generator" content="Habari" />
		
		<meta name="author" content="Valentin Kotov" />
		<meta name="license" content="Licenced under Creative Commons Licence. (cc) 2009-2011 Valentin Kotov. Some rights reserved." />
		<meta name="description" content="<?php Options::out( 'tagline' ); ?>"/>
		<meta name="keywords" content="<?php Options::out( 'tagline' ); ?>" />
		
		<meta name="robots" content="index,follow" />			
		<meta name="alexaVerifyID" content="V6FdKkThtz_pX3iPUm1QzXZqeG4" />
		<meta name="google-site-verification" content="1CMdx-yyBe9YVguCpcfFTzW142BQbvbuFUvaRTgAjqU" />
		<meta name="msvalidate.01" content="35A7FF2491C9C874540048F7FCBFCEBC" />
		<meta name="y_key" content="a266dcf1bb20f8f8" />
		
		<meta content="width=device-width; initial-scale=1.0; maximum-scale=1.5; minimum-scale=0.5; user-scalable=no" name="viewport">	

		<link rel="alternate" type="application/atom+xml" title="Atom 1.0" href="<?php $theme->feed_alternate(); ?>" />
		<link rel="edit" type="application/atom+xml" title="Atom Publishing Protocol" href="<?php URL::out( 'atompub_servicedocument' ); ?>" />
		
		<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php URL::out( 'rsd' ); ?>" />
		<link rel="shortcut icon" href="<?php Site::out_url( 'theme' ); ?>/images/favicon.ico" />
		<link rel="stylesheet" media="screen" type="text/css" href="<?php Site::out_url( 'theme' ); ?>/style.css" />

		<script type="text/javascript" src="http://static.valentinkotov.de/modernizr-1.7.min.js"></script>
		
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
				
		<?php /* <script tpye="text/javascript" src="<?php Site::out_url( 'theme' ); ?>/js/expand.js"></script> */ ?>
		<script type="text/javascript" src="<?php Site::out_url( 'theme' ); ?>/js/jqueryscrollsmoothly.js"></script>
		<script type="text/javascript">
			$(function() {
				// --- Using the default options:
				$(".expand").toggler({method: "slideFadeToggle"});
				// --- Other options:
				//$("h2.expand").toggler({method: "toggle", speed: 0});
				//$("h2.expand").toggler({method: "toggle"});
				//$("h2.expand").toggler({speed: "fast"});
				//$("h2.expand").toggler({method: "fadeToggle"});
				//$("h2.expand").toggler({method: "slideFadeToggle"});    
				$("#content").expandAll({trigger: ".expand", ref: "div.toggle", localLinks: "p.top a"});
			});
		</script>
		<script type="text/javascript">
		  $(document).ready(function(){
		    $("img.fading").hover(function() {
		      $(this).stop().animate({opacity: "0.8"}, 'fast');
		    },
		    function() {
		      $(this).stop().animate({opacity: "1"}, 'fast');
		    });
		  });
		</script>
		<script type="text/javascript">
			function clickclear(thisfield, defaulttext) {
				if (thisfield.value == defaulttext) {
					thisfield.value = "";
				}	
			}
			function clickrecall(thisfield, defaulttext) {
				if (thisfield.value == "") {
					thisfield.value = defaulttext;
				}
			}
		</script>
		

		<?php $theme->header(); ?>

		</head>

		<body id="top">
			
			<div id="wrapper">
				
				<header id="head">
					
					<?php /* if($request->display_entry && isset($post)) { ?>
				
						<h1><?php echo "{$post->title}" ?></h1>
						<a href="<?php Site::out_url( 'habari' ); ?>"><h2>&laquo; <?php Options::out( 'title' ); ?></h2></a>
				
					<?php } else { */ ?>
					
					<a id="logo" href="<?php Site::out_url( 'habari' ); ?>"><img src="<?php Site::out_url( 'theme' ); ?>/img/logo.png" width="250" height="56" alt="" /></a>
					
					<div id="search">
						<?php $theme->display ('searchform' ); ?>
					</div>
						
					<nav>
						<ul>
							<li><a rel="author" href="#">autor</a></li>
							<li><a rel="archives" href="#">sitemap</a></li>
							<li><a href="/impressum">impressum</a></li>
						</ul>
					</nav>
											
					<?php /* } */ ?>
					
					<div class="clear hbg">...</div>
															
				</header>
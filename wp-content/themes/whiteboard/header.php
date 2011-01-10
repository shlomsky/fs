<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<title>
	<?php if ( is_tag() ) {
			echo 'Tag Archive for &quot;'.$tag.'&quot; | '; bloginfo( 'name' );
		} elseif ( is_archive() ) {
			wp_title(); echo ' Archive | '; bloginfo( 'name' );
		} elseif ( is_search() ) {
			echo 'Search for &quot;'.wp_specialchars($s).'&quot; | '; bloginfo( 'name' );
		} elseif ( is_home() ) {
			bloginfo( 'name' ); echo ' | '; bloginfo( 'description' );
		}  elseif ( is_404() ) {
			echo 'Error 404 Not Found | '; bloginfo( 'name' );
		} else {
			echo wp_title( ' | ', false, right ); bloginfo( 'name' );
		} ?>
	</title>
	<!--
		Semi dynamic meta keywords and meta description. Google likes meta info that changes for each page.
		While these meta keywords are not ideal and the meta description could be better, they are better than nothing.
	-->
	<meta name="keywords" content="<?php wp_title(); echo ' , '; bloginfo( 'name' ); echo ' , '; bloginfo( 'description' ); ?>" />
	<meta name="description" content="<?php wp_title(); echo ' | '; bloginfo( 'description' ); ?>" />
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="index" title="<?php bloginfo( 'name' ); ?>" href="<?php echo get_option('home'); ?>/" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'rss2_url' ); ?>" />
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'atom_url' ); ?>" />
	<!-- The HTML5 Shim is required for older browsers, mainly older versions IE -->
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<link rel="stylesheet" href="/css/blueprint/screen.css" type="text/css" media="screen, projection">
	<link rel="stylesheet" href="/css/blueprint/print.css" type="text/css" media="print">	
	<!--[if lt IE 8]><link rel="stylesheet" href="css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->
	<link rel="stylesheet" type="text/css" href="/css/fs.css" />
	<script type="text/javascript" src="/js/jquery-1.4.4.js"></script>
	<script type="text/javascript" src="/js/bgstretcher.js"></script>
	
	<?php wp_head(); ?> <!-- this is used by many Wordpress features and for plugins to work proporly -->
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-20508859-1']);
	  _gaq.push(['_trackPageview']);

	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>
</head>

<body <?php body_class(); ?>>

<script type="text/javascript" src="/js/loader.js"></script>
<script type="text/javascript" src="/js/menu.js"></script>
<div id="page"><!-- this encompasses the entire Web site -->
	<header>
		
		
				<div class="logo_container"><a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('description'); ?>"><img src="./images/full_stop_logo.png" /></a></div>
		
		
		
	
	</header>
	<div class="clear"></div>
	<div class="container">
<div class="sidebar">
	<?php if ( ! dynamic_sidebar( 'Sidebar' )) : ?>

	
				<?php wp_nav_menu( array('menu' => 'Sidebar Menu' )); ?> <!-- editable within the Wordpress backend -->
	

	<?php endif; ?>
	
	<div id="social-links">
	  <a href="https://www.facebook.com/pages/FullStop-Collective/141297850740" target="_blank" title="fullstop on facebook"><img src="<?php bloginfo('url'); ?>/images/facebook_icon.png"></a>
	  <a href="http://twitter.com/fullstoptweet" target="_blank" title="we're all about the tweet"><img src="<?php bloginfo('url'); ?>/images/twitter_icon.png"></a>
	  <a href="http://www.youtube.com/user/FullStopCollective" target="_blank" title="fullstop videos, yo"><img src="<?php bloginfo('url'); ?>/images/video_youtube_icon.png"></a>
	  <a href="https://www.fracturedatlas.org/site/contribute/donate/2103" target="_blank" title="please help support us!"><img src="<?php bloginfo('url'); ?>/images/support-icon.png"></a>
	</div>
	
	<div id="twitter-feed">
	  <script src="http://widgets.twimg.com/j/2/widget.js"></script>
    <script>
    new TWTR.Widget({
     version: 2,
     type: 'profile',
     rpp: 1,
     interval: 30000,
     width: 183,
     height: 125,
     theme: {
      shell: {
        background: '#050505',
        color: '#ffffff'
      },
      tweets: {
        background: '#1e1e1e',
        color: '#ffffff',
        links: '#fe0000'
      }
     },
     features: {
      scrollbar: false,
      loop: false,
      live: true,
      hashtags: true,
      timestamp: true,
      avatars: false,
      behavior: 'all'
     }
    }).render().setUser('FullStopTweet').start();
    </script>
	</div>
	

	
</div><!--sidebar-->
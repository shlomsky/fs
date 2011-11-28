<?php get_header(); ?>
<div id="content-blog">

	<h1>
		<?php if ( is_day() ) : ?> <!-- if the daily archive is loaded -->
			<?php printf( __( 'Daily Archives: <span>%s</span>' ), get_the_date() ); ?>
		<?php elseif ( is_month() ) : ?> <!-- if the montly archive is loaded -->
			<?php printf( __( 'Monthly Archives: <span>%s</span>' ), get_the_date('F Y') ); ?>
		<?php elseif ( is_year() ) : ?> <!-- if the yearly archive is loaded -->
			<?php printf( __( 'Yearly Archives: <span>%s</span>' ), get_the_date('Y') ); ?>
		<?php else : ?> <!-- if anything else is loaded, ex. if the tags or categories template is missing this page will load -->
			Blog Archives
		<?php endif; ?>
	</h1>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <div class="post">
		<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<?php echo '<div class="featured-thumbnail">'; the_post_thumbnail(); echo '</div>'; ?> <!-- loades the post's featured thumbnail, requires Wordpress 3.0+ -->

		<p class="byline">
			<?php the_time('M j, Y') ?>&nbsp;&nbsp;<span class="sep">|</span>&nbsp;&nbsp;<span class="name"><?php the_author() ?></span>
		</p>
		<div class="post-excerpt">
			<?php the_content(); ?> <!-- the excerpt is loaded to help avoid duplicate content issues -->
		</div>
    <div class="more">
      <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"> → Read More</a>
    </div>
		<div class="post-meta">
			<p>
				<?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?>
				<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink() ?>" data-text="<?php the_title(); ?>" data-count="horizontal" data-via="fullstoptweet">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
			</p>
		</div><!--.postMeta-->
  </div>

<!-- ADD BREAK BTWN POSTS, padding-bottom: 10-15px -->
		
	<?php endwhile; else: ?>
		<div class="no-results">
			<p><strong>There has been an error.</strong></p>
			<p>We apologize for any inconvenience, please <a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('description'); ?>">return to the home page</a> or use the search form below.</p>
			<?php get_search_form(); ?> <!-- outputs the default Wordpress search form-->
		</div><!--noResults-->
	<?php endif; ?>
		
	<nav class="oldernewer">
		<div class="older">
			<p>
				<?php next_posts_link('&laquo; Older Entries') ?>
			</p>
		</div><!--.older-->
		<div class="newer">
			<p>
				<?php previous_posts_link('Newer Entries &raquo;') ?>
			</p>
		</div><!--.older-->
	</nav><!--.oldernewer-->

</div><!--#content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>

<?php get_header(); ?>
<?php get_sidebar(); ?>
<div id="content-blog">
 
	<h1><?php  printf( __( '%s' ), '' . single_cat_title( '', false ) . '' );  ?></h1>
	<!-- displays the category's description from the Wordpress admin -->
	<?php echo category_description(); ?>
	
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
				<fb:like href="<?php the_permalink() ?>" send="false" layout="button_count" width="110" show_faces="false"></fb:like>
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

<?php get_footer(); ?>
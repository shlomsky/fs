<?php get_header(); ?>
<?php get_sidebar(); ?>
<!--[if IE]>       <style>#content{background-color:#fff;}</style>          <![endif]-->
<div id="content-blog" class="single"> 

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
			<article>
				<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			
				<div id="post-content">
					<p class="byline">
      			<?php the_time('M j, Y') ?>&nbsp;&nbsp;<span class="sep">|</span>&nbsp;&nbsp;<span class="name"><?php the_author() ?></span>
      		</p>
      		<div class="share">
      		  <a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-url="<?php the_permalink() ?>" data-via="fullstoptweet" data-text="<?php the_title(); ?>">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
      		  <br />
      		  <fb:like href="<?php the_permalink() ?>" send="false" layout="button_count" width="110" show_faces="false"></fb:like>
      		</div>
					<?php the_content(); ?>
					<div class="pagination">
						<?php wp_link_pages('before=<div class="pagination">&after=</div>'); ?>
					</div><!--.pagination-->
				</div><!--#post-content-->
			<article>
				
			<div id="post-meta">
			
				<p>
					<?php comments_popup_link('No comments', 'One comment', '% comments', 'comments-link', 'Comments are closed'); ?> 
				</p>
			
			
			</div><!--#post-meta-->
			
			
			

		</div><!-- #post-## -->

		<div class="newer-older">
			<div class="older">
				<p>
					<?php previous_post_link('%link', '&laquo; Previous post') ?> <!-- outputs a link to the previous post, if there is one -->
				</p>
			</div><!--.older-->
			<div class="newer">
				<p>
					<?php next_post_link('%link', 'Next Post &raquo;') ?> <!-- outputs a link to the next post, if there is one -->
				</p>
			</div><!--.older-->
		</div><!--.newer-older-->

		<?php comments_template( '', true ); ?>

	<?php endwhile; ?><!--end loop-->

</div><!--#content-->

<?php get_footer(); ?>
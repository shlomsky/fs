<?php get_header(); ?>
<?php get_sidebar(); ?>
<!--[if IE]>       <style>#content{background-color:#fff;}</style>          <![endif]-->
<div id="content"> 
	<div class="content-item">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
			<article>
				<h1><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			
				<div id="post-content">
					<p style="color: #666; font-size: 12px; font-style: italic;">Posted at <?php the_time() ?> by <?php the_author_posts_link() ?></p>
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
	</div>
</div><!--#content-->

<?php get_footer(); ?>
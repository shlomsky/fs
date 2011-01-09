<?php get_header(); ?>
<?php get_sidebar(); ?>
<div id="content">
	<div class="content-item">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
			<article>
				<h1><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			
				<div id="post-content">
					<?php the_content(); ?>
					<div class="pagination">
						<?php wp_link_pages('before=<div class="pagination">&after=</div>'); ?>
					</div><!--.pagination-->
				</div><!--#post-content-->
			<article>
				
			<div id="post-meta">
				<p>
					Posted on <?php the_time('F j, Y'); ?> at <?php the_time() ?>
				</p>
				<p>
					<?php comments_popup_link('No comments', 'One comment', '% comments', 'comments-link', 'Comments are closed'); ?> 
				</p>
				<p>
					Categories: <?php the_category(', ') ?>
					<br />
					<?php the_tags('Tags: ', ', ', ' '); ?>
				</p>
			
			</div><!--#post-meta-->
			
			<!-- If a user fills out their bio info, it's included here -->
			<div id="post-author">
				<h3>Written by <?php the_author_posts_link() ?></h3>
				<!-- This avatar is the user's gravatar (http://gravatar.com) based on their administrative email address -->
				<p class="gravatar"><?php if(function_exists('get_avatar')) { echo get_avatar( get_the_author_email(), '80' ); } ?></p>
				<div id="authorDescription">
					<?php the_author_meta('description') ?> 
					
				</div><!--#author-description -->
			</div><!--#post-author-->

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
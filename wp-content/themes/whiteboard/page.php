<?php get_header(); ?>

<?php if (is_page(105)) { ?>

	<div id="random">
		<a href="<?php bloginfo('url'); ?>/2012-season/outfoxed/" />
			<img src="<?php bloginfo('url'); ?>/images/glow_button_new.gif" />
		</a>
		
	</div>
	

<?php } else { ?>

<?php get_sidebar(); ?>
<!--[if lt IE 9]>
<style>
#content{background-color:#ffffff !important;}
</style>
<![endif]-->

<?php if (is_page(811)) { ?>
<div id="content" class="season">
  <?php } else { ?>
    <div id="content" class="post-<?php the_ID(); ?>">
<?php } ?>
		<?php if (is_page(array(1001, 1054, 1057))) { ?>
			<div class="postcard">
		<?php } else { ?>		
	<div class="content-item">
		<?php } ?>
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('page'); ?>>
		
				
				<?php if (is_page(array(1001, 1054, 1057))) { 
					/* ALSO UPDATE FS.CSS!!!!!!!!!!!!!! */?>
				<?php } else { ?>
				<h1 class="title"><?php the_title(); ?></h1>
				
				<?php } ?>
	
				<div id="page-content">
					
					<?php if (is_page(11)) { ?>
						
						<?php wp_nav_menu( array('menu' => 'The Collective',
						 						'link_after' => '</span><br />View Bio' ,
												'before' => '<span class=name>' 
											,)); ?>
						
					<?php } else { ?>
					
					<?php the_content(); ?>
					<div class="pagination">
						<?php wp_link_pages('before=<div class="pagination">&after=</div>'); ?>
					</div><!--.pagination-->
					
						<?php } ?>
			
				</div><!--#pageContent -->
			

		
		</div><!--#post-# .post-->

	

	<?php endwhile; ?>
	</div>
</div><!--#content-->

<?php get_footer(); ?>

<?php } ?>
<?php
/*
Template Name: Full Width - No Footer
*/
?>
<?php get_header(); ?>
	    <div class="page_fullwidth" role="main">
	        <!-- Begin The loop -->
	        <?php if ( have_posts() ) : ?>
	            <?php while ( have_posts() ) : the_post(); ?>
	                <?php the_content(); ?>
	            <?php endwhile; ?>
	        <?php endif; ?>
	        <!-- End The loop -->
	    </div> <!-- /.main -->
	</div> <!-- /#top.site -->

	<?php wp_footer(); ?>
</body>
</html>
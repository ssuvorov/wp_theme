<?php
/*
Template Name: Full Width - No Header
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php
	if ( function_exists('wp_site_icon') ) :
		wp_site_icon();
	elseif ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) :
		$favicon = noo_organici_get_image_option('noo_custom_favicon', '');
	if ($favicon != ''): ?>
	<!-- Favicon-->
	<link rel="shortcut icon" href="<?php echo esc_url($favicon); ?>"/>
	<?php
	endif;
	endif;
	?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php $loading = noo_organici_get_option('noo_css_loading',0);
		if( $loading ):
			?>
		<div class="noo-spinner">
			<div class="spinner">
				<div class="cube1"></div>
				<div class="cube2"></div>
			</div>
		</div>
	<?php endif; ?>
	<div class="site slideout-panel" id="noo-site-wraper">
		<div class="page_fullwidth" role="main">
			<!-- Begin The loop -->
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; ?>
			<?php endif; ?>
			<!-- End The loop -->
		</div> <!-- /.main -->
	
<?php get_footer(); ?>
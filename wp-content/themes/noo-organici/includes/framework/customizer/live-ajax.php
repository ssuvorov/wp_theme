<?php

if( !function_exists( 'noo_organici_cusomizer_upload_settings' ) ) :
	function noo_organici_cusomizer_upload_settings(){
		$file_name = $_FILES['noo-customizer-settings-upload']['name'];
		$file_ext  = pathinfo($file_name, PATHINFO_EXTENSION);
		// $file_size = $_FILES['noo-customizer-settings-upload']['size'];
		if ( $file_ext == 'json' ) {
			$file = array(
				'name' => $_FILES['noo-customizer-settings-upload']['name'] . '.txt',
				'type' => $_FILES['noo-customizer-settings-upload']['type'],
				'tmp_name' => $_FILES['noo-customizer-settings-upload']['tmp_name'],
				'error' => $_FILES['noo-customizer-settings-upload']['error'],
				'size' => $_FILES['noo-customizer-settings-upload']['size'],
				);
			$file = noo_organici_handle_upload_file($file);

			if( !$file || !is_array( $file ) ) {
				exit('-1');
			}

			$encode_options = wp_remote_retrieve_body( wp_remote_get( wp_get_attachment_url( $file['id'] ) ) );
			if( !empty($encode_options) ) {
				echo ( $encode_options );
				exit();
			}
		}

		exit('-1');
	}
endif;

add_action( 'wp_ajax_noo_organici_cusomizer_upload_settings', 'noo_organici_cusomizer_upload_settings' );

if( !function_exists( 'noo_organici_get_customizer_css_layout' ) ) :
function noo_organici_get_customizer_css_layout(){
	check_ajax_referer('noo_customize_live_css', 'nonce');

	ob_start();

    require_once get_template_directory() . '/includes/customizer/css-php/layout.php';

	$css = ob_get_contents(); ob_end_clean();

	// Remove comment
	$css = preg_replace( '#/\*.*?\*/#s', '', $css );

	// Remove space
	$css = preg_replace( '/\s*([{}|:;,])\s+/', '$1', $css );

	// Remove start space
	$css = preg_replace( '/\s\s+(.*)/', '$1', $css );

	echo ($css);
	exit();
}

endif;

add_action( 'wp_ajax_noo_organici_get_customizer_css_layout', 'noo_organici_get_customizer_css_layout' );
add_action( 'wp_ajax_nopriv_noo_organici_get_customizer_css_layout', 'noo_organici_get_customizer_css_layout' );

if( !function_exists( 'noo_organici_get_customizer_css_design' ) ) :
function noo_organici_get_customizer_css_design(){
	check_ajax_referer('noo_customize_live_css', 'nonce');

	ob_start();

    require_once get_template_directory() . '/includes/customizer/css-php/design.php';

	$css = ob_get_contents(); ob_end_clean();

	// Remove comment
	$css = preg_replace( '#/\*.*?\*/#s', '', $css );

	// Remove space
	$css = preg_replace( '/\s*([{}|:;,])\s+/', '$1', $css );

	// Remove start space
	$css = preg_replace( '/\s\s+(.*)/', '$1', $css );

	echo ($css);
	exit();
}

endif;

add_action( 'wp_ajax_noo_organici_get_customizer_css_design', 'noo_organici_get_customizer_css_design' );
add_action( 'wp_ajax_nopriv_noo_organici_get_customizer_css_design', 'noo_organici_get_customizer_css_design' );

if( !function_exists( 'noo_organici_get_customizer_css_typography' ) ) :
function noo_organici_get_customizer_css_typography(){
	check_ajax_referer('noo_customize_live_css', 'nonce');

	ob_start();

    require_once get_template_directory() . '/includes/customizer/css-php/typography.php';

	$css = ob_get_contents(); ob_end_clean();

	// Remove comment
	$css = preg_replace( '#/\*.*?\*/#s', '', $css );

	// Remove space
	$css = preg_replace( '/\s*([{}|:;,])\s+/', '$1', $css );

	// Remove start space
	$css = preg_replace( '/\s\s+(.*)/', '$1', $css );

	echo ($css);
	exit();
}

endif;

add_action( 'wp_ajax_noo_organici_get_customizer_css_typography', 'noo_organici_get_customizer_css_typography' );
add_action( 'wp_ajax_nopriv_noo_organici_get_customizer_css_typography', 'noo_organici_get_customizer_css_typography' );

if( !function_exists( 'noo_organici_get_customizer_css_header' ) ) :
function noo_organici_get_customizer_css_header(){
	check_ajax_referer('noo_customize_live_css', 'nonce');

	ob_start();

    require_once get_template_directory() . '/includes/customizer/css-php/header.php';

	$css = ob_get_contents(); ob_end_clean();

	// Remove comment
	$css = preg_replace( '#/\*.*?\*/#s', '', $css );

	// Remove space
	$css = preg_replace( '/\s*([{}|:;,])\s+/', '$1', $css );

	// Remove start space
	$css = preg_replace( '/\s\s+(.*)/', '$1', $css );

	echo ($css);
	exit();
}

endif;

add_action( 'wp_ajax_noo_organici_get_customizer_css_header', 'noo_organici_get_customizer_css_header' );
add_action( 'wp_ajax_nopriv_noo_organici_get_customizer_css_header', 'noo_organici_get_customizer_css_header' );

if( !function_exists( 'noo_organici_ajax_get_attachment_url' ) ) :
function noo_organici_ajax_get_attachment_url(){
	check_ajax_referer('noo_customize_attachment', 'nonce');

	if ( ! isset( $_POST['attachment_id'] ) ) {
		exit();
	}
				
	$attachment_id = $_POST['attachment_id'];

	echo wp_get_attachment_url( $attachment_id );
	exit();
}

endif;

add_action( 'wp_ajax_noo_organici_ajax_get_attachment_url', 'noo_organici_ajax_get_attachment_url' );
add_action( 'wp_ajax_nopriv_noo_organici_ajax_get_attachment_url', 'noo_organici_ajax_get_attachment_url' );

if( !function_exists( 'noo_organici_ajax_get_menu' ) ) :
function noo_organici_ajax_get_menu(){
	check_ajax_referer('noo_customize_menu', 'nonce');

	if ( ! isset( $_POST['menu_location'] ) ) {
		exit();
	}

	$menu_location = $_POST['menu_location'];
	?>
	<div class="topbar-content">
				
	<?php if ( has_nav_menu( $menu_location ) ) :
		wp_nav_menu( array(
			'theme_location'    => $menu_location,
			'container'         => false,
			'depth'				=> 1,
			'menu_class'        => 'noo-menu'
			) );
	else :
		echo '<ul class="noo-menu"><li><a href="' . esc_url(admin_url( 'nav-menus.php' )) . '">' . esc_html__( 'Assign a menu', 'noo-organici' ) . '</a></li></ul>';
	endif; ?>

	</div>
	<?php
	exit();
}

endif;

add_action( 'wp_ajax_noo_organici_ajax_get_menu', 'noo_organici_ajax_get_menu' );
add_action( 'wp_ajax_nopriv_noo_organici_ajax_get_menu', 'noo_organici_ajax_get_menu' );

if( !function_exists( 'noo_organici_ajax_get_social_icons' ) ) :
function noo_organici_ajax_get_social_icons(){
	check_ajax_referer('noo_customize_social_icons', 'nonce');
	noo_organici_social_icons();
	exit();
}

endif;

add_action( 'wp_ajax_noo_organici_ajax_get_social_icons', 'noo_organici_ajax_get_social_icons' );
add_action( 'wp_ajax_nopriv_noo_organici_ajax_get_social_icons', 'noo_organici_ajax_get_social_icons' );


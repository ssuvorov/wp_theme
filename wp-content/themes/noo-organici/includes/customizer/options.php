<?php
/**
 * NOO Customizer Package.
 *
 * Register Options
 * This file register options used in NOO-Customizer
 *
 * @package    NOO Framework
 * @version    1.0.0
 * @author     Kan Nguyen <khanhnq@nootheme.com>
 * @copyright  Copyright (c) 2014, NooTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://nootheme.com
 */
// =============================================================================


// 0. Remove Unused WP Customizer Sections
if ( ! function_exists( 'noo_organici_customizer_remove_wp_native_sections' ) ) :
	function noo_organici_customizer_remove_wp_native_sections( $wp_customize ) {
		// $wp_customize->remove_section( 'title_tagline' );
		// $wp_customize->remove_section( 'colors' );
		// $wp_customize->remove_section( 'background_image' );
		$wp_customize->remove_section( 'nav' );
		$wp_customize->remove_section( 'static_front_page' );
	}

add_action( 'customize_register', 'noo_organici_customizer_remove_wp_native_sections' );
endif;


//
// Register NOO Customizer Sections and Options
//

// 1. Site Enhancement options.
if ( ! function_exists( 'noo_organici_customizer_register_options_general' ) ) :
	function noo_organici_customizer_register_options_general( $wp_customize ) {

		// declare helper object.
		$helper = new NOO_Organici_Customizer_Helper( $wp_customize );

		// Section: Site Enhancement
		$helper->add_section(
			'noo_customizer_section_site_enhancement',
			esc_html__( 'Site Enhancement', 'noo-organici' ),
			esc_html__( 'Enable/Disable some features for your site.', 'noo-organici' )
		);

		// Control: Favicon
        if ( ! function_exists( 'has_site_icon' ) ) :
            $helper->add_control(
                'noo_custom_favicon',
                'noo_image',
                esc_html__( 'Custom Favicon', 'noo-organici' ),
                '',
                array(),
                array( 'transport' => 'postMessage' )
            );
        endif;

		noo_organici_customizer_add_controls(
			$wp_customize,
			array(
				'noo_back_to_top' => array(
					'type'		=> 'noo_switch',
					'label'		=> esc_html__( 'Back To Top Button', 'noo-organici' ),
					'default'	=> 1,
					'preview_type' => 'custom'
				),
                'noo_css_loading' => array(
					'type'		=> 'noo_switch',
					'label'		=> esc_html__( 'Enable Loading', 'noo-organici' ),
					'default'	=> 1,
					'preview_type' => 'custom'
				),
				'noo_page_heading' => array(
					'type'		=> 'noo_switch',
					'label'		=> esc_html__( 'Enable Page Heading', 'noo-organici' ),
					'default'	=> 1
				)
			)
		);
	}
add_action( 'customize_register', 'noo_organici_customizer_register_options_general' );
endif;

// 2. Design and Layout options.
if ( ! function_exists( 'noo_organici_customizer_register_options_layout' ) ) :
	function noo_organici_customizer_register_options_layout( $wp_customize ) {

		// declare helper object.
		$helper = new NOO_Organici_Customizer_Helper( $wp_customize );

		// Section: Layout
		$helper->add_section(
			'noo_customizer_section_layout',
			esc_html__( 'Design and Layout', 'noo-organici' ),
			esc_html__( 'Set Style and Layout for your site. Boxed Layout will come with additional setting options for background color and image.', 'noo-organici' )
		);

		noo_organici_customizer_add_controls(
			$wp_customize,
			array(
				'noo_site_layout' => array(
					'type' => 'noo_radio',
					'label' => esc_html__( 'Site Layout', 'noo-organici' ),
					'default' => 'fullwidth',
					'control' => array(
						'choices' => array( 'fullwidth' => esc_html__( 'Fullwidth', 'noo-organici' ), 'boxed' => esc_html__( 'Boxed', 'noo-organici' ) ),
						'json'  => array(
							'child_options' => array(
								'boxed' => 'noo_layout_site_width
											,noo_layout_site_max_width
											,noo_layout_bg_color
		                                    ,noo_layout_bg_image_sub_section
		                                    ,noo_layout_bg_image
		                                    ,noo_layout_bg_repeat
		                                    ,noo_layout_bg_align
		                                    ,noo_layout_bg_attachment
		                                    ,noo_layout_bg_cover'
							)
						),
						'preview_type' => 'custom'
					)
				),
				'noo_layout_site_width' => array(
					'type' => 'ui_slider',
					'label' => esc_html__( 'Site Width (%)', 'noo-organici' ),
					'default' => '90',
					'control' => array(
						'json' => array(
							'data_min' => 60,
							'data_max' => 100,
						),
						'preview_type' => 'custom'
					)
				),
				'noo_layout_site_max_width' => array(
					'type' => 'ui_slider',
					'label' => esc_html__( 'Site Max Width (px)', 'noo-organici' ),
					'default' => '1200',
					'control' => array(
						'json' => array(
							'data_min'  => 980,
							'data_max'  => 1600,
							'data_step' => 10,
						),
						'preview_type' => 'custom'
					)
				),
				'noo_layout_bg_color' => array(
					'type' => 'color_control',
					'label' => esc_html__( 'Background Color', 'noo-organici' ),
					'default' => '#ffffff',
					'preview_type' => 'custom'
				)
			)
		);

		// Sub-section: Background Image
		$helper->add_sub_section(
			'noo_layout_bg_image_sub_section',
			esc_html__( 'Background Image', 'noo-organici' ),
			noo_organici_kses( __( 'Upload your background image here, you have various settings for your image:<br/><strong>Repeat Image</strong>: enable repeating your image, you will need it when using patterned background.<br/><strong>Alignment</strong>: Set the position to align your background image.<br/><strong>Attachment</strong>: Make your image scroll with your site or fixed.<br/><strong>Auto resize</strong>: Enable it to ensure your background image always fit the windows.', 'noo-organici' ) )
		);

		// Control: Background Image
		$helper->add_control(
			'noo_layout_bg_image',
			'noo_image',
			esc_html__( 'Background Image', 'noo-organici' ),
			'',
			array( 'preview_type' => 'custom' )
		);

		// Control: Repeat Image
		$helper->add_control(
			'noo_layout_bg_repeat',
			'radio',
			esc_html__( 'Background Repeat', 'noo-organici' ),
			'no-repeat',
			array(
				'choices' => array(
					'repeat' => esc_html__( 'Repeat', 'noo-organici' ),
					'no-repeat' => esc_html__( 'No Repeat', 'noo-organici' ),
				),
				'preview_type' => 'custom'
			)
		);

		// Control: Align Image
		$helper->add_control(
			'noo_layout_bg_align',
			'select',
			esc_html__( 'BG Image Alignment', 'noo-organici' ),
			'left top',
			array(
				'choices' => array(
					'left top'       => esc_html__( 'Left Top', 'noo-organici' ),
					'left center'     => esc_html__( 'Left Center', 'noo-organici' ),
					'left bottom'     => esc_html__( 'Left Bottom', 'noo-organici' ),
					'center top'     => esc_html__( 'Center Top', 'noo-organici' ),
					'center center'     => esc_html__( 'Center Center', 'noo-organici' ),
					'center bottom'     => esc_html__( 'Center Bottom', 'noo-organici' ),
					'right top'     => esc_html__( 'Right Top', 'noo-organici' ),
					'right center'     => esc_html__( 'Right Center', 'noo-organici' ),
					'right bottom'     => esc_html__( 'Right Bottom', 'noo-organici' ),
				),
				'preview_type' => 'custom'
			)
		);

		// Control: Enable Scrolling Image
		$helper->add_control(
			'noo_layout_bg_attachment',
			'radio',
			esc_html__( 'BG Image Attachment', 'noo-organici' ),
			'fixed',
			array(
				'choices' => array(
					'fixed' => esc_html__( 'Fixed Image', 'noo-organici' ),
					'scroll' => esc_html__( 'Scroll with Site', 'noo-organici' ),
				),
				'preview_type' => 'custom'
			)
		);

		// Control: Auto Resize
		$helper->add_control(
			'noo_layout_bg_cover',
			'noo_switch',
			esc_html__( 'Auto Resize', 'noo-organici' ),
			0,
			array( 'preview_type' => 'custom' )
		);

		// Sub-Section: Links Color
		$helper->add_sub_section(
			'noo_general_sub_section_links_color',
			esc_html__( 'Color', 'noo-organici' ),
			esc_html__( 'Here you can set the color for links and various elements on your site.', 'noo-organici' )
		);

		// Control: Site Links Hover Color
		$helper->add_control(
			'noo_site_primary_color',
			'color_control',
			esc_html__( 'Primary Color', 'noo-organici' ),
			noo_organici_get_theme_default( 'primary_color' ),
			array( 'preview_type' => 'update_css', 'preview_params' => array( 'css' => 'design' ) )
		);
	}
add_action( 'customize_register', 'noo_organici_customizer_register_options_layout' );
endif;

// 3. Typography options.
if ( ! function_exists( 'noo_organici_customizer_register_options_typo' ) ) :
	function noo_organici_customizer_register_options_typo( $wp_customize ) {

		// declare helper object.
		$helper = new NOO_Organici_Customizer_Helper( $wp_customize );

		// Section: Typography
		$helper->add_section(
			'noo_customizer_section_typo',
			esc_html__( 'Typography', 'noo-organici' ),
			noo_organici_kses( __( 'Customize your Typography settings. Merito integrated all Google Fonts. See font preview at <a target="_blank" href="http://www.google.com/fonts/">Google Fonts</a>.', 'noo-organici' ) )
		);

		// Sub-Section: Headings
		$helper->add_sub_section(
			'noo_typo_sub_section_headings',
			esc_html__( 'Headings', 'noo-organici' )
		);

		// Control: Use Custom Fonts
		$helper->add_control(
			'noo_typo_use_custom_headings_font',
			'noo_switch',
			esc_html__( 'Use Custom Headings Font?', 'noo-organici' ),
			0,
			array( 'json' => array( 
				'on_child_options'  => 'noo_typo_headings_font,
										noo_typo_headings_font_color,
										noo_typo_headings_uppercase'
				),
				'preview_type' => 'update_css',
				'preview_params' => array( 'css' => 'typography' )
			)
		);

		// Control: Headings font
		$helper->add_control(
			'noo_typo_headings_font',
			'google_fonts',
			esc_html__( 'Headings Font', 'noo-organici' ),
			noo_organici_get_theme_default( 'headings_font_family' ),
			array(
				'weight' => '700',
				'style'	=> 'italic',
				'preview_type' => 'custom'
			)
		);

		// Control: Headings Font Color
		$helper->add_control(
			'noo_typo_headings_font_color',
			'color_control',
			esc_html__( 'Font Color', 'noo-organici' ),
			noo_organici_get_theme_default( 'headings_color' ),
			array( 'preview_type' => 'custom' )
		);

		// Control: Headings Font Uppercase
		$helper->add_control(
			'noo_typo_headings_uppercase',
			'checkbox',
			esc_html__( 'Transform to Uppercase', 'noo-organici' ),
			0,
			array( 'preview_type' => 'custom' )
		);

		// Sub-Section: Body
		$helper->add_sub_section(
			'noo_typo_sub_section_body',
			esc_html__( 'Body', 'noo-organici' )
		);

		// Control: Use Custom Fonts
		$helper->add_control(
			'noo_typo_use_custom_body_font',
			'noo_switch',
			esc_html__( 'Use Custom Body Font?', 'noo-organici' ),
			0,
			array( 'json' => array( 
				'on_child_options'  => 'noo_typo_body_font,
										noo_typo_body_font_color,
										noo_typo_body_font_size' 
				),
				'preview_type' => 'update_css',
				'preview_params' => array( 'css' => 'typography' )
			)
		);
		
		// Control: Body font
		$helper->add_control(
			'noo_typo_body_font',
			'google_fonts',
			esc_html__( 'Body Font', 'noo-organici' ),
			noo_organici_get_theme_default( 'font_family' ),
			array( 'preview_type' => 'custom' )
		);

		// Control: Body Font Color
		$helper->add_control(
			'noo_typo_body_font_color',
			'color_control',
			esc_html__( 'Font Color', 'noo-organici' ),
			noo_organici_get_theme_default( 'text_color' ),
			array(
				'preview_type' => 'custom'
			)
		);

		// Control: Body Font Size
		$helper->add_control(
			'noo_typo_body_font_size',
			'font_size',
			esc_html__( 'Font Size (px)', 'noo-organici' ),
			noo_organici_get_theme_default( 'font_size' ),
			array( 'preview_type' => 'custom' )
		);
		
	}
add_action( 'customize_register', 'noo_organici_customizer_register_options_typo' );
endif;


// 4. Header options.
if ( ! function_exists( 'noo_organici_customizer_register_options_header' ) ) :
	function noo_organici_customizer_register_options_header( $wp_customize ) {

		// declare helper object.
		$helper = new NOO_Organici_Customizer_Helper( $wp_customize );

		// Section: Header
		$helper->add_section(
			'noo_customizer_section_header',
			esc_html__( 'Header', 'noo-organici' ),
			esc_html__( 'Customize settings for your Header, including Navigation Bar (Logo and Navigation) and an optional Top Bar.', 'noo-organici' ),
			true
		);

		// Sub-section: General Options
		$helper->add_sub_section(
			'noo_header_sub_section_general',
			esc_html__( 'General Options', 'noo-organici' ),
			''
		);

		// Sub-Section: Navigation Bar
        $helper->add_sub_section(
            'noo_header_sub_section_style',
            esc_html__( 'Header style', 'noo-organici' ),
            esc_html__( 'Choose style for header', 'noo-organici' )
        );

        // Control: Header Style
        $helper->add_control(
            'noo_header_nav_style',
            'noo_radio',
            esc_html__( 'Header Style', 'noo-organici' ),
            'header1',
            array(
                'choices' => array(
                    'header1'     => esc_html__( 'Header Default', 'noo-organici' ),
                    'header2'     => esc_html__( 'Header Business', 'noo-organici' ),
                    'header3'     => esc_html__( 'Header Agency', 'noo-organici' ),
                    'header4'     => esc_html__( 'Header Fullwidth', 'noo-organici' ),
                    'header5'     => esc_html__( 'Header Shop', 'noo-organici' ),
                    'header6'     => esc_html__( 'Header Logo Center', 'noo-organici' )
                )
            )
        );

		// Sub-Section: Navigation Bar
		$helper->add_sub_section(
			'noo_header_sub_section_nav',
			esc_html__( 'Navigation Bar', 'noo-organici' ),
			esc_html__( 'Adjust settings for Navigation Bar. You also can customize some settings for the Toggle Button on Mobile in this section.', 'noo-organici' )
		);

		// Control: NavBar Position
		$helper->add_control(
			'noo_header_nav_position',
			'noo_radio',
			esc_html__( 'NavBar Position', 'noo-organici' ),
			'static_top', 
			array(
				'choices' => array(
					'static_top'       => esc_html__( 'Static Top', 'noo-organici' ),
					'fixed_top'     => esc_html__( 'Fixed Top', 'noo-organici' )
				),
				'json' => array(
					'child_options' => array(
						'fixed_top'   => 'noo_header_logo_image_sticky'
					)
				)
			)
		);

		// Control: Logo Image Sticky
		$helper->add_control(
			'noo_header_logo_image_sticky',
			'noo_image',
			esc_html__( 'Upload Your Logo Sticky', 'noo-organici' ),
			'',
			array(
				'preview_type' => 'custom'
			)
		);

		if( NOO_WOOCOMMERCE_EXIST ) {
			// Control: Show Cart Icon
			$helper->add_control(
				'noo_header_nav_icon_cart',
				'noo_switch',
				esc_html__( 'Show Shopping Cart', 'noo-organici' ),
				0
			);
		}

		// Control: Show Search
		$helper->add_control(
			'noo_header_nav_icon_search',
			'noo_switch',
			esc_html__( 'Show Search Icon', 'noo-organici' ),
			1,
			array(
				'json' => array(
					'on_child_options'  => ''
				)
			)
		);

		// Control: Show Wishlist
		$helper->add_control(
			'noo_header_nav_icon_user',
			'noo_switch',
			esc_html__( 'Show User Icon', 'noo-organici' ),
			0,
			array(
				'json' => array(
					'on_child_options'  => ''
				)
			)
		);

		// Control: Show Wishlist
		$helper->add_control(
			'noo_header_nav_icon_wishlist',
			'noo_switch',
			esc_html__( 'Show Wishlist Icon', 'noo-organici' ),
			0,
			array(
				'json' => array(
					'on_child_options'  => ''
				)
			)
		);

		// Control: Divider 3
		$helper->add_control( 'noo_header_nav_divider_3', 'divider', '' );

		// Control: NavBar Height (px)
		$helper->add_control(
			'noo_header_nav_height',
			'ui_slider',
			esc_html__( 'NavBar Height (px)', 'noo-organici' ),
			'80',
			array(
				'json' => array(
					'data_min' => 20,
					'data_max' => 150,
				),
				'preview_type' => 'custom'
			)
		);

		// Control: NavBar Link Spacing (px)
		$helper->add_control(
			'noo_header_nav_link_spacing',
			'ui_slider',
			esc_html__( 'NavBar Link Spacing (px)', 'noo-organici' ),
			'20',
			array(
				'json' => array(
					'data_min' => 10,
					'data_max' => 50,
				),
				'preview_type' => 'custom'
			)
		);

		// Control: Divider 2
		$helper->add_control( 'noo_header_nav_divider_2', 'divider', '' );

		// Control: Custom NavBar Font
		$helper->add_control(
			'noo_header_custom_nav_font',
			'noo_switch',
			esc_html__( 'Use Custom NavBar Font and Color?', 'noo-organici' ),
			0,
			array( 'json' => array( 
					'on_child_options'  => 'noo_header_nav_font,
											noo_header_nav_link_color,
											noo_header_nav_link_hover_color,
											noo_header_nav_font_size,
											noo_header_nav_uppercase'
				),
				'preview_type' => 'update_css',
				'preview_params' => array( 'css' => 'header' )
			)
		);

		// Control: NavBar font
		$helper->add_control(
			'noo_header_nav_font',
			'google_fonts',
			esc_html__( 'NavBar Font', 'noo-organici' ),
			noo_organici_get_theme_default( 'headings_font_family' ),
			array(
				'weight' => '700',
				'style'	=> 'normal',
				'preview_type' => 'custom',
			)
		);

		// Control: NavBar Font Size
		$helper->add_control(
			'noo_header_nav_font_size',
			'ui_slider',
			esc_html__( 'Font Size (px)', 'noo-organici' ),
			'16',
			array(
				'json' => array(
					'data_min' => 9,
					'data_max' => 30,
				),
				'preview_type' => 'custom'
			)
		);

		// Control: NavBar Link Color
		$helper->add_control(
			'noo_header_nav_link_color',
			'color_control',
			esc_html__( 'Link Color', 'noo-organici' ),
			'',
			array(
				'preview_type' => 'custom'
			)
		);

		// Control: NavBar Link Hover Color
		$helper->add_control(
			'noo_header_nav_link_hover_color',
			'color_control',
			esc_html__( 'Link Hover Color', 'noo-organici' ),
			''
		);

		// Control: NavBar Font Uppercase
		$helper->add_control(
			'noo_header_nav_uppercase',
			'checkbox',
			esc_html__( 'Transform to Uppercase', 'noo-organici' ),
			1,
			array(
				'preview_type' => 'custom'
			)
		);

		// Sub-Section: Logo
		$helper->add_sub_section(
			'noo_header_sub_section_logo',
			esc_html__( 'Logo', 'noo-organici' ),
			esc_html__( 'All the settings for Logo go here. If you do not use Image for Logo, plain text will be used.', 'noo-organici' )
		);

		// Control: Use Image for Logo
		$helper->add_control(
			'noo_header_use_image_logo',
			'noo_switch',
			esc_html__( 'Use Image for Logo?', 'noo-organici' ),
			0,
			array(
				'json' => array(
					'on_child_options'   => 'noo_header_logo_image,noo_header_fix_logo_image_height',
					'off_child_options'  => 'blogname
										,noo_header_logo_font
                                        ,noo_header_logo_font_size
                                        ,noo_header_logo_font_color
                                        ,noo_header_logo_uppercase'
				)
			)
		);

		// Control: Blog Name
		$helper->add_control(
			'blogname',
			'text',
			esc_html__( 'Blog Name', 'noo-organici' ),
			get_bloginfo( 'name' ),
			array(
				'preview_type' => 'custom'
			)
		);

		// Control: Logo font
		$helper->add_control(
			'noo_header_logo_font',
			'google_fonts',
			esc_html__( 'Logo Font', 'noo-organici' ),
			noo_organici_get_theme_default( 'logo_font_family' ),
			array(
				'weight' => '400',
				'style'	=> 'normal',
				'preview_type' => 'custom'
			)
		);

		// Control: Logo Font Size
		$helper->add_control(
			'noo_header_logo_font_size',
			'ui_slider',
			esc_html__( 'Font Size (px)', 'noo-organici' ),
			'30',
			array(
				'json' => array(
					'data_min' => 15,
					'data_max' => 80,
				),
				'preview_type' => 'custom'
			)
		);

		// Control: Logo Font Color
		$helper->add_control(
			'noo_header_logo_font_color',
			'color_control',
			esc_html__( 'Font Color', 'noo-organici' ),
			noo_organici_get_theme_default( 'logo_color' ),
			array(
				'preview_type' => 'custom'
			)
		);

		// Control: Logo Font Uppercase
		$helper->add_control(
			'noo_header_logo_uppercase',
			'checkbox',
			esc_html__( 'Transform to Uppercase', 'noo-organici' ),
			0,
			array(
				'preview_type' => 'custom'
			)
		);

		// Control: Logo Image
		$helper->add_control(
			'noo_header_logo_image',
			'noo_image',
			esc_html__( 'Upload Your Logo', 'noo-organici' ),
			'',
			array(
				'preview_type' => 'custom'
			)
		);

		// Control: Use Image for Logo
		$helper->add_control(
			'noo_header_fix_logo_image_height',
			'noo_switch',
			esc_html__( 'Fix Logo Image Height?', 'noo-organici' ),
			0,
			array(
				'json' => array(
					'on_child_options'   => 'noo_header_logo_image_height',
				)
			)
		);

		// Control: Logo Image Height
		$helper->add_control(
			'noo_header_logo_image_height',
			'ui_slider',
			esc_html__( 'Image Height (px)', 'noo-organici' ),
			'40',
			array(
				'json' => array(
					'data_min' => 15,
					'data_max' => 120,
				),
				'preview_type' => 'custom'
			)
		);

		// Sub-Section: NavBar Top
        $helper->add_sub_section(
            'noo_header_sub_nav_top',
            esc_html__( 'NavBar Top', 'noo-organici' ),
            esc_html__( 'NavBar Top only using for Header (2) & (4)', 'noo-organici' ),
            ''
        );
        $helper->add_control(
            'noo_header_top_phone',
            'text',
            esc_html__( 'Phone', 'noo-organici' )
        );
        $helper->add_control(
            'noo_header_top_email',
            'text',
            esc_html__( 'Email', 'noo-organici' )
        );

	}
add_action( 'customize_register', 'noo_organici_customizer_register_options_header' );
endif;

// 5. Footer options.
if ( ! function_exists( 'noo_organici_customizer_register_options_footer' ) ) :
	function noo_organici_customizer_register_options_footer( $wp_customize ) {

		// declare helper object.
		$helper = new NOO_Organici_Customizer_Helper( $wp_customize );

		// Section: Footer
		$helper->add_section(
			'noo_customizer_section_footer',
			esc_html__( 'Footer', 'noo-organici' ),
			esc_html__( 'Footer contains Widgetized area and Footer Bottom. You can change any parts.', 'noo-organici' )
		);

		// Control: Footer Columns (Widgetized)
		$helper->add_control(
			'noo_footer_widgets',
			'select',
			esc_html__( 'Footer Columns (Widgetized)', 'noo-organici' ),
			'4',
			array(
				'choices' => array(
					0       => esc_html__( 'None (No Footer Main Content)', 'noo-organici' ),
					1     => esc_html__( 'One', 'noo-organici' ),
					2     => esc_html__( 'Two', 'noo-organici' ),
					3     => esc_html__( 'Three', 'noo-organici' ),
					4     => esc_html__( 'Four', 'noo-organici' )
				)
			)
		);

		// Control: Footer Style
        $helper->add_control(
            'noo_footer_style',
            'noo_radio',
            esc_html__( 'Footer Style', 'noo-organici' ),
            'footer1',
            array(
                'choices' => array(
                    // 'footer1'     => esc_html__( 'Footer Default', 'noo-organici' ),
                    'footer2'     => esc_html__( 'Footer Business', 'noo-organici' ),
                    'footer3'     => esc_html__( 'Footer Business Dark', 'noo-organici' ),
                    'footer4'     => esc_html__( 'Footer Agency', 'noo-organici' )
                ),
                'json' => array(
					'child_options' => array(
						// 'footer1'   => 'noo_footer_left_widgets_background,noo_footer_widgets',
						'footer2'   => 'noo_bottom_bar_content,noo_footer_style2_background,noo_footer_widgets',
						'footer3'   => 'noo_bottom_bar_content,noo_footer_widgets',
						'footer4'   => 'noo_bottom_bar_content,noo_footer_style4_background,noo_footer_nav_menu',
					)
				)
            )
        );

        // Control: Footer Columns (Widgetized)
		$helper->add_control(
			'noo_footer_widgets',
			'select',
			esc_html__( 'Footer Columns (Widgetized)', 'noo-organici' ),
			'4',
			array(
				'choices' => array(
					0       => esc_html__( 'None (No Footer Main Content)', 'noo-organici' ),
					1     => esc_html__( 'One', 'noo-organici' ),
					2     => esc_html__( 'Two', 'noo-organici' ),
					3     => esc_html__( 'Three', 'noo-organici' ),
					4     => esc_html__( 'Four', 'noo-organici' )
				)
			)
		);

        // Control: Background image for footer left
		// $helper->add_control(
		// 	'noo_footer_left_widgets_background',
		// 	'noo_image',
		// 	esc_html__( 'Footer Left Background Image', 'noo-organici' ),
		// 	'',
		// 	array(
		// 		'preview_type' => 'custom'
		// 	)
		// );

		// Control: Background image for footer left
		$helper->add_control(
			'noo_footer_style2_background',
			'noo_image',
			esc_html__( 'Footer Business Background Image', 'noo-organici' ),
			'',
			array(
				'preview_type' => 'custom'
			)
		);

		// Control: Background image for footer left
		$helper->add_control(
			'noo_footer_style4_background',
			'noo_image',
			esc_html__( 'Footer Agency Background Image', 'noo-organici' ),
			'',
			array(
				'preview_type' => 'custom'
			)
		);

		// Control: Footer Nav Menu
		$menus = wp_get_nav_menus();
		$menus_fix[0] = esc_html__( '- Menu Select -', 'noo-organici' );
        foreach ( $menus as $menu ) :
        	$menus_fix[$menu->term_id] = $menu->name;
        endforeach;
		$helper->add_control(
			'noo_footer_nav_menu',
			'select',
			esc_html__( 'Footer Nav Menu', 'noo-organici' ),
			'',
			array(
				'choices' => $menus_fix
			)
		);

		// Control: Divider 2
		$helper->add_control( 'noo_footer_divider_2', 'divider', '' );

		// Control: Bottom Bar Content
		$helper->add_control(
			'noo_bottom_bar_content',
			'textarea',
			esc_html__( 'Footer Bottom Content (HTML)', 'noo-organici' ),
			'&copy; 2016. Designed with <i class="fa fa-heart text-primary" ></i> by NooTheme',
			array(
				'preview_type' => 'custom'
			)
		);
		// Control: Divider 2
		$helper->add_control( 'noo_footer_divider_2', 'divider', '' );

		// Control: Bottom Bar Content
		$helper->add_control(
			'noo_footer_top_content',
			'textarea',
			esc_html__( 'Footer Top Content (HTML)', 'noo-organici' ),
			'Only show in defaut page',
			array(
				'preview_type' => 'custom'
			)
		);

	}
add_action( 'customize_register', 'noo_organici_customizer_register_options_footer' );
endif;

// 6. WP Sidebar options.
if ( ! function_exists( 'noo_organici_customizer_register_options_sidebar' ) ) :
	function noo_organici_customizer_register_options_sidebar( $wp_customize ) {

		global $wp_version;
		if ( $wp_version >= 4.0 ) {
			// declare helper object.
			$helper = new NOO_Organici_Customizer_Helper( $wp_customize );

			// Change the sidebar panel priority
			$widget_panel = $wp_customize->get_panel('widgets');
			if(!empty($widget_panel)) {
				$widget_panel->priority = $helper->get_new_section_priority();
			}
		}
	}
add_action( 'customize_register', 'noo_organici_customizer_register_options_sidebar' );
endif;

// 7. Blog options.
if ( ! function_exists( 'noo_organici_customizer_register_options_blog' ) ) :
	function noo_organici_customizer_register_options_blog( $wp_customize ) {

		// declare helper object.
		$helper = new NOO_Organici_Customizer_Helper( $wp_customize );

		// Section: Blog
		$helper->add_section(
			'noo_customizer_section_blog',
			esc_html__( 'Blog', 'noo-organici' ),
			esc_html__( 'In this section you have settings for your Blog page, Archive page and Single Post page.', 'noo-organici' ),
			true
		);

		// Sub-section: Blog Page (Index Page)
		$helper->add_sub_section(
			'noo_blog_sub_section_blog_page',
			esc_html__( 'Post List', 'noo-organici' ),
			esc_html__( 'Choose Layout settings for your Post List', 'noo-organici' )
		);

		// Control: Blog Layout
		$helper->add_control(
			'noo_blog_layout',
			'noo_radio',
			esc_html__( 'Blog Layout', 'noo-organici' ),
			'sidebar',
			array(
				'choices' => array(
					'fullwidth'   => esc_html__( 'Full-Width', 'noo-organici' ),
					'sidebar'   => esc_html__( 'With Right Sidebar', 'noo-organici' ),
					'left_sidebar'   => esc_html__( 'With Left Sidebar', 'noo-organici' )
				),
				'json' => array(
					'child_options' => array(
						'fullwidth'   => '',
						'sidebar'   => 'noo_blog_sidebar',
						'left_sidebar'   => 'noo_blog_sidebar'
					)
				)
			)
		);

		// Control: Blog Sidebar
		$helper->add_control(
			'noo_blog_sidebar',
			'widgets_select',
			esc_html__( 'Blog Sidebar', 'noo-organici' ),
			'sidebar-main'
		);

		// Control: Divider 1
		$helper->add_control( 'noo_blog_divider_1', 'divider', '' );

		// Control: Heading Title
		$helper->add_control(
			'noo_blog_heading_title',
			'text',
			esc_html__( 'Heading Title', 'noo-organici' ),
			esc_html__('Blog', 'noo-organici')
		);

		// Control: Heading Image
		$helper->add_control(
			'noo_blog_heading_image',
			'noo_image',
			esc_html__( 'Heading Background Image', 'noo-organici' ),
			''
		);

		// Control: Divider 2
		$helper->add_control( 'noo_blog_divider_2', 'divider', '' );

		// Control: Show Readmore link
		$helper->add_control(
			'noo_blog_show_readmore',
			'checkbox',
			esc_html__( 'Show Readmore link', 'noo-organici' ),
			1
		);

		// Control: Show Post Meta
		$helper->add_control(
			'noo_blog_show_post_meta',
			'checkbox',
			esc_html__( 'Show Post Meta', 'noo-organici' ),
			1
		);

		// Control: Show Post Tags
		$helper->add_control(
			'noo_blog_show_post_tag',
			'checkbox',
			esc_html__( 'Show Post Tags', 'noo-organici' ),
			1
		);

		// Control: Excerpt Length
		$helper->add_control(
			'noo_blog_excerpt_length',
			'text',
			esc_html__( 'Excerpt Length', 'noo-organici' ),
			'60'
		);

		// Control: Divider 2
		$helper->add_control( 'noo_blog_post_divider_2', 'divider', '' );

		// Control: Enable Social Sharing
		$helper->add_control(
			'noo_blog_social',
			'noo_switch',
			esc_html__( 'Enable Social Sharing', 'noo-organici' ),
			1,
			array(
				'json' => array( 'on_child_options' => 'noo_blog_social_title,
		                                                noo_blog_social_facebook,
		                                                noo_blog_social_twitter,
		                                                noo_blog_social_google,
		                                                noo_blog_social_pinterest,
		                                                noo_blog_social_linkedin'
				)
			)
		);

		// Control: Sharing Title
		$helper->add_control(
			'noo_blog_social_title',
			'text',
			esc_html__( 'Sharing Title', 'noo-organici' ),
			esc_html__( 'Share This Post', 'noo-organici' )
		);

		// Control: Facebook Share
		$helper->add_control(
			'noo_blog_social_facebook',
			'checkbox',
			esc_html__( 'Facebook Share', 'noo-organici' ),
			1
		);

		// Control: Twitter Share
		$helper->add_control(
			'noo_blog_social_twitter',
			'checkbox',
			esc_html__( 'Twitter Share', 'noo-organici' ),
			1
		);

		// Control: Google+ Share
		$helper->add_control(
			'noo_blog_social_google',
			'checkbox',
			esc_html__( 'Google+ Share', 'noo-organici' ),
			1
		);

		// Control: Pinterest Share
		$helper->add_control(
			'noo_blog_social_pinterest',
			'checkbox',
			esc_html__( 'Pinterest Share', 'noo-organici' ),
			0
		);

		// Control: LinkedIn Share
		$helper->add_control(
			'noo_blog_social_linkedin',
			'checkbox',
			esc_html__( 'LinkedIn Share', 'noo-organici' ),
			0
		);

		// Sub-section: Single Post
		$helper->add_sub_section(
			'noo_blog_sub_section_post',
			esc_html__( 'Single Post', 'noo-organici' )
		);

		// Control: Post Layout
		$helper->add_control(
			'noo_blog_post_layout',
			'noo_same_as_radio',
			esc_html__( 'Post Layout', 'noo-organici' ),
			'same_as_blog',
			array(
				'choices' => array(
					'same_as_blog'   => esc_html__( 'Same as Blog Layout', 'noo-organici' ),
					'fullwidth'   => esc_html__( 'Full-Width', 'noo-organici' ),
					'sidebar'   => esc_html__( 'With Right Sidebar', 'noo-organici' ),
					'left_sidebar'   => esc_html__( 'With Left Sidebar', 'noo-organici' ),
				),
				'json' => array(
					'child_options' => array(
						'fullwidth'   => '',
						'sidebar'   => 'noo_blog_post_sidebar',
						'left_sidebar'   => 'noo_blog_post_sidebar',
					)
				)
			)
		);

		// Control: Post Sidebar
		$helper->add_control(
			'noo_blog_post_sidebar',
			'widgets_select',
			esc_html__( 'Post Sidebar', 'noo-organici' ),
			'sidebar-main'
		);
		
		// Control: Divider 1
		$helper->add_control( 'noo_blog_post_divider_1', 'divider', '' );
		
		// Control: Show Post Meta
		$helper->add_control(
			'noo_blog_post_show_post_meta',
			'checkbox',
			esc_html__( 'Show Post Meta', 'noo-organici' ),
			1
		);

		// Control: Show Post Tags
		$helper->add_control(
			'noo_blog_post_show_post_tag',
			'checkbox',
			esc_html__( 'Show Post Tags', 'noo-organici' ),
			1
		);

		// Control: Show Author Bio
		$helper->add_control(
			'noo_blog_post_author_bio',
			'checkbox',
			esc_html__( 'Show Author\'s Bio', 'noo-organici' ),
			1
		);

		$helper->add_control(
			'noo_blog_post_social',
			'noo_switch',
			esc_html__( 'Enable Social Sharing', 'noo-organici' ),
			1
		);

	}
add_action( 'customize_register', 'noo_organici_customizer_register_options_blog' );
endif;

// 8. Custom Post Type options
if ( ! function_exists( 'noo_organici_customizer_register_options_post_type' ) ) :
	function noo_organici_customizer_register_options_post_type( $wp_customize ) {
		global $noo_post_types;
		if( empty( $noo_post_types ) ) return;

		// declare helper object.
		$helper = new NOO_Organici_Customizer_Helper( $wp_customize );

		foreach ($noo_post_types as $post_type => $args) {
			if( !isset( $args['customizer'] ) || empty( $args['customizer'] ) )
				continue;

			$pt_customizer = $args['customizer'];

			$pt_customizer['panel'] = isset( $pt_customizer['panel'] ) ? $pt_customizer['panel'] : array( 'single' );

			$helper->add_section(
				array(
					'id' => "noo_customizer_section_{$post_type}",
					'label' => $args['name'],
					'description' => sprintf( esc_html__( 'Firstly assign a page as your %s page from dropdown list. %s page can be any page. Once you chose a page as %s Page, its slug will be your %s\'s main slug.', 'noo-organici' ), $args['name'], $args['name'], $args['name'], $args['name'] ),
					'is_panel' => count( $pt_customizer['panel'] ) > 1
				)
			);

			if( in_array('list', $pt_customizer['panel'] ) ) {
				// Sub-section: List
				$helper->add_sub_section(
					"{$post_type}_archive_sub_section",
					sprintf( esc_html__( 'List %s', 'noo-organici' ), $args['name'] )
				);
			}

			if( in_array('page', $pt_customizer) ) {
				// Control: Post type Page
				$helper->add_control(
					array(
						'id' => "{$post_type}_archive_page",
						'type' => 'pages_select',
						'label' => sprintf( esc_html__( '%s Page', 'noo-organici' ), $args['name'] ),
						'default' => '',
					)
				);
			}

			if( in_array('heading-title', $pt_customizer) ) {
				$default = isset( $args['heading-title'] ) ? $args['heading-title'] : sprintf( esc_html__( '%s List', 'noo-organici' ), $args['name'] );

				// Control: Heading Title
				$helper->add_control(
					array(
						'id' => "{$post_type}_heading_title",
						'type' => 'text',
						'label' => sprintf( esc_html__( '%s Heading Title', 'noo-organici' ), $args['name'] ),
						'default' => $default,
					)
				);
			}

			if( in_array('heading-image', $pt_customizer) ) {
				// Control: Heading Title
				$helper->add_control(
					array(
						'id' => "{$post_type}_heading_image",
						'type' => 'noo_image',
						'label' => sprintf( esc_html__( '%s Heading Background Image', 'noo-organici' ), $args['name'] ),
						'default' => '',
					)
				);
			}

			if( in_array('list-layout', $pt_customizer) ) {
				// Control: List Layout
				$helper->add_control(
					array(
						'id' => "{$post_type}_archive_layout",
						'type' => 'noo_radio',
						'label' => sprintf( esc_html__( '%s List Layout', 'noo-organici' ), $args['name'] ),
						'default' => 'sidebar',
						'control' => array(
								'choices' => array(
									'fullwidth'   => esc_html__( 'Full-Width', 'noo-organici' ),
									'sidebar'   => esc_html__( 'With Right Sidebar', 'noo-organici' ),
									'left_sidebar'   => esc_html__( 'With Left Sidebar', 'noo-organici' )
								),
								'json' => array(
									'child_options' => array(
										'fullwidth'   => '',
										'sidebar'   => "{$post_type}_archive_sidebar",
										'left_sidebar'   => "{$post_type}_archive_sidebar"
									)
								)
							),
					)
				);

				// Control: Event List Sidebar
				$helper->add_control(
					array(
						'id' => "{$post_type}_archive_sidebar",
						'type' => 'widgets_select',
						'label' => sprintf( esc_html__( '%s List Sidebar', 'noo-organici' ), $args['name'] ),
						'default' => 'sidebar-main',
					)
				);
			}

			if( in_array('layout', $pt_customizer) ) {
				// Control: List Layout
				$helper->add_control(
					array(
						'id' => "{$post_type}_archive_layout",
						'type' => 'noo_radio',
						'label' => sprintf( esc_html__( '%s Layout', 'noo-organici' ), $args['name'] ),
						'default' => 'sidebar',
						'control' => array(
								'choices' => array(
									'fullwidth'   => esc_html__( 'Full-Width', 'noo-organici' ),
									'sidebar'   => esc_html__( 'With Right Sidebar', 'noo-organici' ),
									'left_sidebar'   => esc_html__( 'With Left Sidebar', 'noo-organici' )
								),
								'json' => array(
									'child_options' => array(
										'fullwidth'   => '',
										'sidebar'   => "{$post_type}_archive_sidebar",
										'left_sidebar'   => "{$post_type}_archive_sidebar"
									)
								)
							),
					)
				);

				// Control: Event List Sidebar
				$helper->add_control(
					array(
						'id' => "{$post_type}_archive_sidebar",
						'type' => 'widgets_select',
						'label' => sprintf( esc_html__( '%s Sidebar', 'noo-organici' ), $args['name'] ),
						'default' => 'sidebar-main',
					)
				);
			}

			do_action( "{$post_type}_archive_customizer", $wp_customize );

			if( in_array('list_num', $pt_customizer) ) {
				// Control: Number of Item per Page
				$helper->add_control(
					array(
						'id' => "{$post_type}_num",
						'type' => 'ui_slider',
						'label' => esc_html__( 'Items Per Page', 'noo-organici' ),
						'8',
		 				'control' => array(
		 					'json' => array(
		 						'data_min'  => '4',
		 						'data_max'  => '50',
		 						'data_step' => '2'
		 					)
		 				),
					)
				);
			}

			if( in_array('single', $pt_customizer['panel'] ) ) {
				// Sub-section: Single
				$helper->add_sub_section(
					"{$post_type}_single_sub_section",
					sprintf( esc_html__( 'Single %s', 'noo-organici' ), $args['singular_name'] )
				);
			}

			if( in_array('single-layout', $pt_customizer) ) {
				// Control: Single Layout
				$helper->add_control(
					array(
						'id' => "{$post_type}_single_layout",
						'type' => 'noo_same_as_radio',
						'label' => sprintf( esc_html__( 'Single %s Layout', 'noo-organici' ), $args['singular_name'] ),
						'default' => "same_as_archive",
						'control' => array(
								'choices' => array(
									"same_as_archive"   => sprintf( esc_html__( 'Same as %s List Layout', 'noo-organici' ), $args['name'] ),
									'fullwidth'   => esc_html__( 'Full-Width', 'noo-organici' ),
									'sidebar'   => esc_html__( 'With Right Sidebar', 'noo-organici' ),
									'left_sidebar'   => esc_html__( 'With Left Sidebar', 'noo-organici' ),
								),
								'json' => array(
									'child_options' => array(
										'fullwidth'   => '',
										'sidebar'   => "{$post_type}_single_sidebar",
										'left_sidebar'   => "{$post_type}_single_sidebar",
									)
								)
							),
					)
				);

				// Control: Single Sidebar
				$helper->add_control(
					array(
						'id' => "{$post_type}_single_sidebar",
						'type' => 'widgets_select',
						'label' => sprintf( esc_html__( '%s Sidebar', 'noo-organici' ), $args['singular_name'] ),
						'default' => 'sidebar-main',
					)
				);
			}



			do_action( "{$post_type}_single_customizer", $wp_customize );

			if( in_array('single-social', $pt_customizer) ) {
				$helper->add_control(
				 	array(
						'id' => "{$post_type}_single_divider_1",
						'type' => 'divider'
					)
				);

				// Control: Enable Social Sharing
		        $helper->add_control(
		        	array(
						'id' => "{$post_type}_single_social",
						'type' => 'noo_switch',
						'label' => esc_html__( 'Enable Social Sharing', 'noo-organici' ),
						'default' => 1,
						'control' => array(
			                'json' => array( 'on_child_options' => "{$post_type}_single_social_facebook,
					                                                {$post_type}_single_social_twitter,
					                                                {$post_type}_single_social_google,
					                                                {$post_type}_single_social_pinterest,
					                                                {$post_type}_single_social_linkedin"
			                )
			            )
					)
		        );

				// Control: Facebook Share
				$helper->add_control(
					array(
						'id' => "{$post_type}_single_social_facebook",
						'type' => 'noo_switch',
						'label' => esc_html__( 'Facebook Share', 'noo-organici' ),
						'default' => 1,
					)
				);

				// Control: Twitter Share
				$helper->add_control(
					array(
						'id' => "{$post_type}_single_social_twitter",
						'type' => 'noo_switch',
						'label' => esc_html__( 'Twitter Share', 'noo-organici' ),
						'default' => 1,
					)
				);

				// Control: Google+ Share
				$helper->add_control(
					array(
						'id' => "{$post_type}_single_social_google",
						'type' => 'noo_switch',
						'label' => esc_html__( 'Google+ Share', 'noo-organici' ),
						'default' => 1,
					)
				);

				// Control: Pinterest Share
				$helper->add_control(
					array(
						'id' => "{$post_type}_single_social_pinterest",
						'type' => 'noo_switch',
						'label' => esc_html__( 'Pinterest Share', 'noo-organici' ),
						'default' => 1,
					)
				);

				// Control: LinkedIn Share
				$helper->add_control(
					array(
						'id' => "{$post_type}_single_social_linkedin",
						'type' => 'noo_switch',
						'label' => esc_html__( 'LinkedIn Share', 'noo-organici' ),
						'default' => 1,
					)
				);
			}
		}
        
	}
	add_action( 'customize_register', 'noo_organici_customizer_register_options_post_type' );
endif;

// 9. Portfolio options.

// 10. WooCommerce options.
 if( NOO_WOOCOMMERCE_EXIST ) :
 	if ( ! function_exists( 'noo_organici_customizer_register_options_woocommerce' ) ) :
 		function noo_organici_customizer_register_options_woocommerce( $wp_customize ) {

 			// declare helper object.
 			$helper = new NOO_Organici_Customizer_Helper( $wp_customize );

 			// Section: Revolution Slider
 			$helper->add_section(
 				'noo_customizer_section_shop',
 				esc_html__( 'WooCommerce', 'noo-organici' ),
 				'',
 				true
 			);

 			// Sub-section: Shop Page
 			$helper->add_sub_section(
 				'noo_woocommerce_sub_section_shop_page',
 				esc_html__( 'Shop Page', 'noo-organici' ),
 				esc_html__( 'Choose Layout and Headline Settings for your Shop Page.', 'noo-organici' )
 			);

 			// Control: Shop Layout
 			$helper->add_control(
 				'noo_shop_layout',
 				'noo_radio',
 				esc_html__( 'Shop Layout', 'noo-organici' ),
 				'fullwidth',
 				array(
 					'choices' => array(
 						'fullwidth'   => esc_html__( 'Full-Width', 'noo-organici' ),
 						'sidebar'   => esc_html__( 'With Right Sidebar', 'noo-organici' ),
 						'left_sidebar'   => esc_html__( 'With Left Sidebar', 'noo-organici' )
 					),
 					'json' => array(
 						'child_options' => array(
 							'fullwidth'   => '',
 							'sidebar'   => 'noo_shop_sidebar',
 							'left_sidebar'   => 'noo_shop_sidebar',
 						)
 					)
 				)
 			);

 			// Control: Shop Sidebar
 			$helper->add_control(
 				'noo_shop_sidebar',
 				'widgets_select',
 				esc_html__( 'Shop Sidebar', 'noo-organici' ),
 				''
 			);

 			// Control: Divider 1
 			$helper->add_control( 'noo_shop_divider_1', 'divider', '' );

 			// Control: Heading Title
 			$helper->add_control(
 				'noo_shop_heading_title',
 				'text',
 				esc_html__( 'Shop Heading', 'noo-organici' ),
 				esc_html__('Shop', 'noo-organici')
 			);

 			// Control: Heading Image
 			$helper->add_control(
 				'noo_shop_heading_image',
 				'noo_image',
 				esc_html__( 'Heading Background Image', 'noo-organici' ),
 				''
 			);

 			$helper->add_control(
 				'noo_shop_default_layout',
 				'noo_radio',
 				esc_html__( 'Shop Default View Style', 'noo-organici' ),
 				'grid',
 				array(
 					'choices' => array(
 						'grid'   => esc_html__( 'Grid', 'noo-organici' ),
 						'list'   => esc_html__( 'List', 'noo-organici' ),
 					)
 				)
 			);

 			 $helper->add_control(
 			 	'noo_shop_grid_column',
 			 	'ui_slider',
 			 	esc_html__( 'Products Grid Columns', 'noo-organici' ),
 			 	'4',
 			 	array(
 			 		'json' => array(
 			 			'data_min'  => 1,
 			 			'data_max'  => 4,
 			 			'data_step' => 1
 			 		)
 			 	)
 			 );

 			// Control: Number of Product per Page
 			$helper->add_control(
 				'noo_shop_num',
 				'ui_slider',
 				esc_html__( 'Products Per Page', 'noo-organici' ),
 				'12',
 				array(
 					'json' => array(
 						'data_min'  => 4,
 						'data_max'  => 50,
 						'data_step' => 2
 					)
 				)
 			);

 			// Sub-section: Single Product
 			$helper->add_sub_section(
 				'noo_woocommerce_sub_section_product',
 				esc_html__( 'Single Product', 'noo-organici' )
 			);

 			// Control: Product Layout
 			$helper->add_control(
 				'noo_woocommerce_product_layout',
 				'noo_same_as_radio',
 				esc_html__( 'Product Layout', 'noo-organici' ),
 				'same_as_shop',
 				array(
 					'choices' => array(
 						'same_as_shop'   => esc_html__( 'Same as Shop Layout', 'noo-organici' ),
 						'fullwidth'   => esc_html__( 'Full-Width', 'noo-organici' ),
 						'sidebar'   => esc_html__( 'With Right Sidebar', 'noo-organici' ),
 						'left_sidebar'   => esc_html__( 'With Left Sidebar', 'noo-organici' ),
 					),
 					'json' => array(
 						'child_options' => array(
 							'fullwidth'   => '',
 							'sidebar'   => 'noo_woocommerce_product_sidebar',
 							'left_sidebar'   => 'noo_woocommerce_product_sidebar',
 						)
 					)
 				)
 			);

 			// Control: Product Sidebar
 			$helper->add_control(
 				'noo_woocommerce_product_sidebar',
 				'widgets_select',
 				esc_html__( 'Product Sidebar', 'noo-organici' ),
 				''
 			);

 			// Control: Products related
 		    $helper->add_control(
 			    'noo_woocommerce_product_related',
 			    'text',
 			    esc_html__( 'Related Products Count', 'noo-organici' ),
 			    ''
 		    );

 		}
 	add_action( 'customize_register', 'noo_organici_customizer_register_options_woocommerce' );
 	endif;
 endif;



// 11. Social Media options
if ( ! function_exists( 'noo_organici_customizer_register_options_social' ) ) :
	function noo_organici_customizer_register_options_social( $wp_customize ) {

		// Declare helper object.
		$helper = new NOO_Organici_Customizer_Helper( $wp_customize );

		// Section: Social Media
		$helper->add_section(
			'noo_customizer_section_social',
			esc_html__( 'Social Media', 'noo-organici' ),
			esc_html__( 'Input URLs of your social media profile. Inputting URL here means that corresponding social icon will be displayed when Social Icon is enabled on Top Bar and/or on Bottom Bar.', 'noo-organici' )
		);

		// Control: Facebook Profile URL
		$helper->add_control(
			'noo_social_facebook',
			'text',
			esc_html__( 'Facebook Profile URL', 'noo-organici' ),
			''
		);

		// Control: Twitter Profile URL
		$helper->add_control(
			'noo_social_twitter',
			'text',
			esc_html__( 'Twitter Profile URL', 'noo-organici' ),
			''
		);

		// Control: Google+ Profile URL
		$helper->add_control(
			'noo_social_google-plus',
			'text',
			esc_html__( 'Google+ Profile URL', 'noo-organici' ),
			''
		);

		// Control: Pinterest Profile URL
		$helper->add_control(
			'noo_social_pinterest',
			'text',
			esc_html__( 'Pinterest Profile URL', 'noo-organici' ),
			''
		);

		// Control: LinkedIn Profile URL
		$helper->add_control(
			'noo_social_linkedin',
			'text',
			esc_html__( 'LinkedIn Profile URL', 'noo-organici' ),
			''
		);

		// Control: RSS Feed URL
		$helper->add_control(
			'noo_social_rss',
			'text',
			esc_html__( 'RSS Feed URL', 'noo-organici' ),
			''
		);

		// Control: Youtube Profile URL
		$helper->add_control(
			'noo_social_youtube',
			'text',
			esc_html__( 'Youtube Profile URL', 'noo-organici' ),
			''
		);

		// Control: Instagram Profile URL
		$helper->add_control(
			'noo_social_instagram',
			'text',
			esc_html__( 'Instagram Profile URL', 'noo-organici' ),
			''
		);

	}
	// add_action( 'customize_register', 'noo_organici_customizer_register_options_social' );
endif;

// 12. Custom Code
if ( ! function_exists( 'noo_organici_customizer_register_options_custom_code' ) ) :
	function noo_organici_customizer_register_options_custom_code( $wp_customize ) {

		// declare helper object.
		$helper = new NOO_Organici_Customizer_Helper( $wp_customize );

		// Section: Custom Code
		$helper->add_section(
			'noo_customizer_section_custom_code',
			esc_html__( 'Custom Code', 'noo-organici' ),
			esc_html__( 'In this section you can add custom JavaScript and CSS to your site.<br/>Your Google analytics tracking code should be added to Custom JavaScript field.', 'noo-organici' )
		);

		// Control: Custom JS (Google Analytics)
		$helper->add_control(
			'noo_custom_javascript',
			'textarea',
			esc_html__( 'Custom JavaScript', 'noo-organici' ),
			'',
			array( 'preview_type' => 'custom' )
		);

		// Control: Custom CSS
		$helper->add_control(
			'noo_custom_css',
			'textarea',
			esc_html__( 'Custom CSS', 'noo-organici' ),
			'',
			array( 'preview_type' => 'custom' )
		);
	}
add_action( 'customize_register', 'noo_organici_customizer_register_options_custom_code' );
endif;

// 13. Import/Export Settings.
if ( ! function_exists( 'noo_organici_customizer_register_options_tools' ) ) :
	function noo_organici_customizer_register_options_tools( $wp_customize ) {

		// declare helper object.
		$helper = new NOO_Organici_Customizer_Helper( $wp_customize );

		// Section: Custom Code
		$helper->add_section(
			'noo_customizer_section_tools',
			esc_html__( 'Import/Export Settings', 'noo-organici' ),
			esc_html__( 'All themes from NooTheme share the same theme setting structure so you can export then import settings from one theme to another conveniently without any problem.', 'noo-organici' )
		);

		// Sub-section: Import Settings
		$helper->add_sub_section(
			'noo_tools_sub_section_import',
			esc_html__( 'Import Settings', 'noo-organici' ),
			noo_organici_kses( __( 'Click Upload button then choose a JSON file (.json) from your computer to import settings to this theme.<br/>All the settings will be loaded for preview here and will not be saved until you click button "Save and Publish".', 'noo-organici' ) )
		);

		// Control: Upload Settings
		$helper->add_control(
			'noo_tools_import',
			'import_settings',
			esc_html__( 'Upload', 'noo-organici' )
		);

		// Sub-section: Export Settings
		$helper->add_sub_section(
			'noo_tools_sub_section_export',
			esc_html__( 'Export Settings', 'noo-organici' ),
            noo_organici_kses( __( 'Simply click Download button to export all your settings to a JSON file (.json).<br/>You then can use that file to restore theme settings to any theme of NooTheme.', 'noo-organici' ) )
		);

		// Control: Download Settings
		$helper->add_control(
			'noo_tools_export',
			'export_settings',
			esc_html__( 'Download', 'noo-organici' )
		);

	}
add_action( 'customize_register', 'noo_organici_customizer_register_options_tools' );
endif;


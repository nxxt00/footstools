<?php
/**
 * Furnish Lite Theme Customizer
 *
 * @package Furnish Lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function furnish_lite_customize_register( $wp_customize ) {
	
function furnish_lite_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		
	$wp_customize->add_setting('color_scheme', array(
		'default' => '#ffa200',
		'sanitize_callback'	=> 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'color_scheme',array(
			'label' => __('Color Scheme','furnish-lite'),
			'description'	=> __('Select color from here.','furnish-lite'),
			'section' => 'colors',
			'settings' => 'color_scheme'
		))
	);
	
	$wp_customize->add_setting('header_color', array(
		'default' => '#ffffff',
		'sanitize_callback'	=> 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'header_color',array(
			'description'	=> __('Select background color for header.','furnish-lite'),
			'section' => 'colors',
			'settings' => 'header_color'
		))
	);
	
	$wp_customize->add_setting('menu_color', array(
		'default' => '#ffa200',
		'sanitize_callback'	=> 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'menu_color',array(
			'description'	=> __('Select hover color for menu.','furnish-lite'),
			'section' => 'colors',
			'settings' => 'menu_color'
		))
	);
	
	$wp_customize->add_setting('footer_color', array(
		'default' => '#282a2b',
		'sanitize_callback'	=> 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'footer_color',array(
			'description'	=> __('Select background color for footer.','furnish-lite'),
			'section' => 'colors',
			'settings' => 'footer_color'
		))
	);
	
	// Slider Section Start		
	$wp_customize->add_section(
        'slider_section',
        array(
            'title' => __('Slider Settings', 'furnish-lite'),
            'priority' => null,
			'description'	=> __('Recommended image size (1420x567). Slider will be visible only when you select static front page.','furnish-lite'),	
        )
    );
	
	$wp_customize->add_setting('page-setting7',array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('page-setting7',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide one:','furnish-lite'),
			'section'	=> 'slider_section'
	));	
	
	$wp_customize->add_setting('page-setting8',array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('page-setting8',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide two:','furnish-lite'),
			'section'	=> 'slider_section'
	));	
	
	$wp_customize->add_setting('page-setting9',array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('page-setting9',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide three:','furnish-lite'),
			'section'	=> 'slider_section'
	));	
	
	$wp_customize->add_setting('slide_text',array(
		'default'	=> __('Read More','furnish-lite'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('slide_text',array(
		'label'	=> __('Add slider link button text.','furnish-lite'),
		'section'	=> 'slider_section',
		'setting'	=> 'slide_text',
		'type'	=> 'text'
	));
	
	$wp_customize->add_setting('hide_slider',array(
			'default' => true,
			'sanitize_callback' => 'furnish_lite_sanitize_checkbox',
			'capability' => 'edit_theme_options',
	));	 

	$wp_customize->add_control( 'hide_slider', array(
		   'settings' => 'hide_slider',
    	   'section'   => 'slider_section',
    	   'label'     => __('Check this to hide slider','furnish-lite'),
    	   'type'      => 'checkbox'
     ));	
	
	// Slider Section End	
	
	// Topbar Info		
	$wp_customize->add_section(
        'topbar_section',
        array(
            'title' => __('Topbar Info', 'furnish-lite'),
            'priority' => null,
			'description'	=> __('Add content for topbar','furnish-lite'),	
        )
    );

	$wp_customize->add_setting('email',array(
			'default' => null,
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'sanitize_email'
	));
	
	$wp_customize->add_control('email',array(
			'type'	=> 'text',
			'label'	=> __('Add email address.','furnish-lite'),
			'section'	=> 'topbar_section'
	));
	
	
	$wp_customize->add_setting('phone',array(
			'default' => null,
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('phone',array(
			'type'	=> 'text',
			'label'	=> __('Add phone number.','furnish-lite'),
			'section'	=> 'topbar_section'
	));
	
	// Social icons here
	
	// First section for social icon
	
	$wp_customize->add_setting('scname1',array(
			'default' => null,
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('scname1',array(
			'type'	=> 'text',
			'label'	=> __('Social Section 1.','furnish-lite'),
			'description' => __('Add social icon name here. All the letters should be in lowercase.','furnish-lite'),
			'section'	=> 'topbar_section'
	));
	
	$wp_customize->add_setting('sclink1',array(
			'default' => null,
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('sclink1',array(
			'type'	=> 'text',
			'description' => __('Add social icon link here.','furnish-lite'),
			'section'	=> 'topbar_section'
	));	 
	
	// Second section for social icon
	
	$wp_customize->add_setting('scname2',array(
			'default' => null,
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('scname2',array(
			'type'	=> 'text',
			'label'	=> __('Social Section 2.','furnish-lite'),
			'description' => __('Add social icon name here. All the letters should be in lowercase.','furnish-lite'),
			'section'	=> 'topbar_section'
	));
	
	$wp_customize->add_setting('sclink2',array(
			'default' => null,
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('sclink2',array(
			'type'	=> 'text',
			'description' => __('Add social icon link here.','furnish-lite'),
			'section'	=> 'topbar_section'
	));
	
	
	// Third section for social icon
	
	$wp_customize->add_setting('scname3',array(
			'default' => null,
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('scname3',array(
			'type'	=> 'text',
			'label'	=> __('Social Section 3.','furnish-lite'),
			'description' => __('Add social icon name here. All the letters should be in lowercase.','furnish-lite'),
			'section'	=> 'topbar_section'
	));
	
	$wp_customize->add_setting('sclink3',array(
			'default' => null,
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('sclink3',array(
			'type'	=> 'text',
			'description' => __('Add social icon link here.','furnish-lite'),
			'section'	=> 'topbar_section'
	));
	
	// Fourth section for social icon
	
	$wp_customize->add_setting('scname4',array(
			'default' => null,
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('scname4',array(
			'type'	=> 'text',
			'label'	=> __('Social Section 4.','furnish-lite'),
			'description' => __('Add social icon name here. All the letters should be in lowercase.','furnish-lite'),
			'section'	=> 'topbar_section'
	));
	
	$wp_customize->add_setting('sclink4',array(
			'default' => null,
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('sclink4',array(
			'type'	=> 'text',
			'description' => __('Add social icon link here.','furnish-lite'),
			'section'	=> 'topbar_section'
	));	
	
	$wp_customize->add_setting('hide_topbar',array(
			'default' => true,
			'sanitize_callback' => 'furnish_lite_sanitize_checkbox',
			'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'hide_topbar', array(
		   'settings' => 'hide_topbar',
    	   'section'   => 'topbar_section',
    	   'label'     => __('Check this to hide topbar','furnish-lite'),
    	   'type'      => 'checkbox'
     ));
	
}
	
	
add_action( 'customize_register', 'furnish_lite_customize_register' );	

function furnish_lite_css(){
		?>
        <style>
				a, 
				.tm_client strong,
				.postmeta a:hover,
				#sidebar ul li a:hover,
				.blog-post h3.entry-title,
				.home-section .home-left h3{
					color:<?php echo esc_html(get_theme_mod('color_scheme','#ffa200')); ?>;
				}
				.main-nav ul li a:hover,
				.sitenav ul li a:hover, 
				.sitenav ul li.current_page_item a, 
				.sitenav ul li:hover a.parent,
				.sitenav ul li ul.sub-menu li a:hover, 
				.sitenav ul li.current_page_item ul.sub-menu li a:hover, 
				.sitenav ul li ul.sub-menu li.current_page_item a{
					color:<?php echo esc_html(get_theme_mod('menu_color','#ffa200')); ?>;
				}
				a.blog-more:hover,
				#commentform input#submit,
				input.search-submit,
				.nivo-controlNav a.active,
				.blog-date .date,
				.home-section .home-left a.ReadMore,
				.nav-links .current, .nav-links a:hover{
					background-color:<?php echo esc_html(get_theme_mod('color_scheme','#ffa200')); ?>;
				}
				.header-top{
					background-color:<?php echo esc_html(get_theme_mod('topbar_color','#000000')); ?>;
				}
				.copyright-wrapper{
					background-color:<?php echo esc_html(get_theme_mod('footer_color','#282a2b')); ?>;
				}
				#header{
					background-color:<?php echo esc_html(get_theme_mod('header_color','#ffffff')); ?>;
				}
				@media screen and (max-width: 980px){
					.header_right .sitenav ul li a:hover{
							color:<?php echo esc_html(get_theme_mod('menu_color','#fdc300')); ?> !important;
						}	
				}
		</style>
	<?php }
add_action('wp_head','furnish_lite_css');

function furnish_lite_customize_preview_js() {
	wp_enqueue_script( 'furnish-lite-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20141216', true );
}
add_action( 'customize_preview_init', 'furnish_lite_customize_preview_js' );
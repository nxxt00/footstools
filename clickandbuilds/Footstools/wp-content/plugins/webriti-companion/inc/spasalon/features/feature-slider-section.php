<?php
function webriti_companion_spasalon_slider_customizer( $wp_customize ) {

//Home slider Section
	
	$wp_customize->add_section(
        'slider_section_settings',
        array(
            'title' => __('Slider settings','webriti-companion'),
			'panel'  => 'section_settings',
			'priority'       => 1,
			)
    );
	

	//Show and hide slider section
	$wp_customize->add_setting(
	'spa_theme_options[home_slider_enabled]'
    ,
    array(
        'default' => true,
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option',
    )	
	);
	$wp_customize->add_control(
    'spa_theme_options[home_slider_enabled]',
    array(
        'label' => __('Enable Home slider section','webriti-companion'),
        'section' => 'slider_section_settings',
        'type' => 'checkbox',
    )
	);
	
	//Show and hide banner strip
	$wp_customize->add_setting(
	'spa_theme_options[slider_bannerstrip_enable]'
    ,
    array(
        'default' => true,
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option',
    )	
	);
	$wp_customize->add_control(
    'spa_theme_options[slider_bannerstrip_enable]',
    array(
        'label' => __('Enable Banner strip section','webriti-companion'),
        'section' => 'slider_section_settings',
        'type' => 'checkbox',
    )
	);
	
	
	
	// //Banner Title
	$wp_customize->add_setting(
    'spa_theme_options[line_one]',
    array(
        'default' => __('Producing','webriti-companion'),
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option',
		)
	);	
	$wp_customize->add_control('spa_theme_options[line_one]',array(
    'label'   => __('Banner title','webriti-companion'),
    'section' => 'slider_section_settings',
	 'type' => 'text',)  );	
	 
	//Banner subtitle 
	 $wp_customize->add_setting(
    'spa_theme_options[line_two]',
    array(
        'default' => __('Experience','webriti-companion'),
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option',
		)
	);	
	
	$wp_customize->add_control( 'spa_theme_options[line_two]',array(
    'label'   => __('Banner subtitle','webriti-companion'),
    'section' => 'slider_section_settings',
	 'type' => 'text',)  );
	
	//Banner description
	$wp_customize->add_setting(
    'spa_theme_options[description]',
    array(
        'default' => 'Donec justo odio, lobortis eget congue sed, rutrum sit amet mauris. Curabitur sed lectus nulla. Curabitur sed lectus nulla.lobortis eget congue sed, rutrum sit amet mauris. Curabitur sed lectus nulla rutrum sit amet mauris.',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option',
		)
	);
	
	$wp_customize->add_control( 'spa_theme_options[description]',array(
    'label'   => __('Banner description','webriti-companion'),
    'section' => 'slider_section_settings',
	 'type' => 'text',)  );
	 
	//Banner call title
	$wp_customize->add_setting(
    'spa_theme_options[call_us_text]',
    array(
        'default' => __('Call us on','spasalon'),
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option',
		)
	);
	
	$wp_customize->add_control( 'spa_theme_options[call_us_text]',array(
    'label'   => __('Banner call title','webriti-companion'),
    'section' => 'slider_section_settings',
	 'type' => 'text',)  );
	 
	 
	 //Banner call title
	$wp_customize->add_setting(
    'spa_theme_options[call_us]',
    array(
        'default' => __('201 567 89785','spasalon'),
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option',
		)
	);
	
	$wp_customize->add_control( 'spa_theme_options[call_us]',array(
    'label'   => __('Banner call number','webriti-companion'),
    'section' => 'slider_section_settings',
	 'type' => 'text',)  );
	
	$current_options = get_option( 'spa_theme_options');

	$ImagePath = isset($current_options['slider_post'])? get_the_post_thumbnail_url( $current_options['slider_post']):'';
	 
	$slider_post = isset($current_options['slider_post'])? $ImagePath : WC__PLUGIN_URL .'/inc/spasalon/images/slider/home_banner.jpg';
	 
 
	//slider image
	$wp_customize->add_setting( 'spa_theme_options[slider_post]',array('default' => $slider_post,
	'type' => 'option', 'sanitize_callback' => 'esc_url_raw'));
 
 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'spa_theme_options[slider_post]',
			array(
				'label' => __('Slider Image','spasalon'),
				'settings' =>'spa_theme_options[slider_post]',
				'section' => 'slider_section_settings',
				'type' => 'upload',
			)
		)
	);
	
	
	//Show and hide thumbnail strip
	$wp_customize->add_setting(
	'spa_theme_options[slider_thumbnails_enable]'
    ,
    array(
        'default' => true,
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option',
    )	
	);
	$wp_customize->add_control(
    'spa_theme_options[slider_thumbnails_enable]',
    array(
        'label' => __('Enable Thumbnail section','webriti-companion'),
        'section' => 'slider_section_settings',
        'type' => 'checkbox',
    )
	);
	

	$slider_thumnail_one = isset($current_options['slider_thumbnail_one'])? get_the_post_thumbnail_url($current_options['slider_thumbnail_one']) : WC__PLUGIN_URL .'inc/spasalon/images/slider/home_thumb.jpg';
	 
	//thumbnail one image
	$wp_customize->add_setting( 'spa_theme_options[slider_thumbnail_one]',array('default' => $slider_thumnail_one,
	'type' => 'option','sanitize_callback' => 'esc_url_raw',));
 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'spa_theme_options[slider_thumbnail_one]',
			array(
				'label' => __('Thumbnail Image','spasalon'),
				'settings' =>'spa_theme_options[slider_thumbnail_one]',
				'section' => 'slider_section_settings',
				'type' => 'upload',
			)
		)
	);
	

	$slider_thumnail_two = isset($current_options['slider_thumbnail_two'])? get_the_post_thumbnail_url($current_options['slider_thumbnail_two']) : WC__PLUGIN_URL .'/inc/spasalon/images/slider/home_thumb.jpg';
	 
	//thumbnail two image
	$wp_customize->add_setting( 'spa_theme_options[slider_thumbnail_two]',array('default' => $slider_thumnail_two,
	'type' => 'option','sanitize_callback' => 'esc_url_raw',));
 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'spa_theme_options[slider_thumbnail_two]',
			array(
				'label' => __('Thumbnail Image','spasalon'),
				'settings' =>'spa_theme_options[slider_thumbnail_two]',
				'section' => 'slider_section_settings',
				'type' => 'upload',
			)
		)
	);
	
	
	$slider_thumnail_three = isset($current_options['slider_thumbnail_three'])? get_the_post_thumbnail_url($current_options['slider_thumbnail_three']) : WC__PLUGIN_URL .'/inc/spasalon/images/slider/home_thumb.jpg';
	 
	
	//thumbnail three image
	$wp_customize->add_setting( 'spa_theme_options[slider_thumbnail_three]',array('default' => $slider_thumnail_three,
	'type' => 'option','sanitize_callback' => 'esc_url_raw',));
 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'spa_theme_options[slider_thumbnail_three]',
			array(
				'label' => __('Thumbnail Image','spasalon'),
				'settings' =>'spa_theme_options[slider_thumbnail_three]',
				'section' => 'slider_section_settings',
				'type' => 'upload',
			)
		)
	);
}		
	add_action( 'customize_register', 'webriti_companion_spasalon_slider_customizer' );
	
	/**
 * Add selective refresh for Front page project section controls.
 */
function spasalon_register_slider_section_partials( $wp_customize ){

/* Banner Title*/
$wp_customize->selective_refresh->add_partial( 'spa_theme_options[line_one]', array(
		'selector'            => '.topbar-detail h4',
		'settings'            => 'spa_theme_options[line_one]',
	
	) );
$wp_customize->selective_refresh->add_partial( 'spa_theme_options[line_two]', array(
		'selector'            => '.topbar-detail h1',
		'settings'            => 'spa_theme_options[line_two]',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'spa_theme_options[description]', array(
		'selector'            => '.topbar-detail p.description',
		'settings'            => 'spa_theme_options[description]',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'spa_theme_options[call_us_text]', array(
		'selector'            => '.addr-detail address',
		'settings'            => 'spa_theme_options[call_us_text]',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'spa_theme_options[call_us]', array(
		'selector'            => '.addr-detail address > strong',
		'settings'            => 'spa_theme_options[call_us]',
	
	) );
	
	
	$wp_customize->selective_refresh->add_partial( 'spa_theme_options[slider_post]', array(
		'selector'            => 'ul.slide-img',
		'settings'            => 'spa_theme_options[slider_post]',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'spa_theme_options[slider_thumbnail_one]', array(
		'selector'            => '.one-slide-thumb',
		'settings'            => 'spa_theme_options[slider_thumbnail_one]',
	
	) );
	
	
	
	$wp_customize->selective_refresh->add_partial( 'spa_theme_options[slider_thumbnail_two]', array(
		'selector'            => '.two-slide-thumb',
		'settings'            => 'spa_theme_options[slider_thumbnail_two]',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'spa_theme_options[slider_thumbnail_three]', array(
		'selector'            => '.three-slide-thumb',
		'settings'            => 'spa_theme_options[slider_thumbnail_three]',
	
	) );
	
	
	

	
}

add_action( 'customize_register', 'spasalon_register_slider_section_partials' );
	?>
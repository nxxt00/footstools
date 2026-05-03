<?php
if ( ! function_exists( 'quality_service_customize_register' ) ) :
function quality_service_customize_register($wp_customize){
	//Service section panel
//$wp_customize->add_panel( 'quality_service_options', array(
//		'priority'       => 600,
//		'capability'     => 'edit_theme_options',
//		'title'      => __('Service settings', 'webriti-companion'),
//	) );
	$wp_customize->add_section(
				'service_settings', array(
					'title'    => __( 'Service settings', 'webriti-companion' ),
					//'panel'    => 'quality_service_options',
					'panel'  => 'quality_homepage_section_setting',
					'priority' => 2,
				)
			);
			
			//Hide Index Service Section
			
			$wp_customize->add_setting(
			'quality_pro_options[service_enable]',
			array(
				'default' => true,
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
				'type' => 'option',
			)	
			);
			
			$wp_customize->add_control(
			'quality_pro_options[service_enable]',
			array(
				'label' => __('Enable Services on homepage.','webriti-companion'),
				'section' => 'service_settings',
				'type' => 'checkbox',
			)
			);
	
	$wp_customize->add_setting(
    'quality_pro_options[service_title]',
    array(
        'default' => __('Our services','webriti-companion'),
		'capability'     => 'edit_theme_options',
		'type' => 'option',
    )	
	);
	$wp_customize->add_control(
    'quality_pro_options[service_title]',
    array(
        'label' => __('Title','webriti-companion'),
        'section' => 'service_settings',
        'type' => 'text',
    )
	);
	
	$wp_customize->add_setting(
    'quality_pro_options[service_description]',
    array(
        'default' => __('Our <b>Awesome</b> Services','webriti-companion'),
		'type' => 'option',
    )	
	);
	$wp_customize->add_control(
    'quality_pro_options[service_description]',
    array(
        'label' => __('Description',''),
        'section' => 'service_settings',
        'type' => 'text',
		'sanitize_callback' => 'sanitize_text_field',
    )
	);	
	
	if ( class_exists( 'Quality_Repeater' ) ) {
			$wp_customize->add_setting( 'quality_pro_options[quality_service_content]', array(
			'type'=> 'option',
			) );

			$wp_customize->add_control( new Quality_Repeater( $wp_customize, 'quality_pro_options[quality_service_content]', array(
				'label'                             => esc_html__( 'Service content', 'webriti-companion' ),
				'section'                           => 'service_settings',
				'add_field_label'                   => esc_html__( 'Add new service', 'webriti-companion' ),
				'item_name'                         => esc_html__( 'Service', 'webriti-companion' ),
				'customizer_repeater_title_control' => true,
				'customizer_repeater_text_control'  => true,
				'customizer_repeater_link_control'  => true,
				'customizer_repeater_icon_control'  => true,
				'customizer_repeater_checkbox_control' => true,
				'customizer_repeater_image_control' => true,
				) ) );
		}
}
add_action( 'customize_register', 'quality_service_customize_register' );

/**
 * Add selective refresh for Front page section section controls.
 */
function quality_register_service_section_partials( $wp_customize ){

$wp_customize->selective_refresh->add_partial( 'quality_pro_options[service_title]', array(
		'selector'            => '.service .section-header p',
		'settings'            => 'quality_pro_options[service_title]',
	
	) );

$wp_customize->selective_refresh->add_partial( 'quality_pro_options[service_description]', array(
		'selector'            => '.service .section-header h1.widget-title',
		'settings'            => 'quality_pro_options[service_description]',
	
	) );
	
$wp_customize->selective_refresh->add_partial( 'quality_pro_options[quality_service_content]', array(
		'selector'            => '.service #service_content_section',
		'settings'            => 'quality_pro_options[quality_service_content]',
	
	) );
	
	
}

add_action( 'customize_register', 'quality_register_service_section_partials' );


endif;
?>
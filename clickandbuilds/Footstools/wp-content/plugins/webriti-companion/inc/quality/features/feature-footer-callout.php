<?php
function quality_callout_customizer( $wp_customize ) {
	
	$wp_customize->add_section(
        'callout_section_settings',
        array(
            'title' => __('Footer callout settings','webriti-companion'),
            'description' => '',
			'panel'  => 'quality_footer_setting',)
    );
    
    
    	// Upgrade to Pro Control
	    class quality_customize_ctb_upgrade extends WP_Customize_Control {
			public function render_content() { ?>
	        <h3><?php echo sprintf(__("Want to add CTA at the bottom? <a href='http://webriti.com/quality' target='_blank'>Upgrade to Pro</a>","webriti-companion"));?></h3>
			<?php }
		}
	

			// Upgrade to Pro Label
		$wp_customize->add_setting( 'site_bottom_intro_message', array(
		'default'				=> false,
		'capability'			=> 'edit_theme_options',
		'sanitize_callback'	=> 'wp_filter_nohtml_kses',
		));
		$wp_customize->add_control(
			new quality_customize_ctb_upgrade(
			$wp_customize,
			'site_bottom_intro_message',
				array(
					'label'					=> __('Upgrade to Pro','webriti-companion'),
					'section'				=> 'callout_section_settings',
					'settings'				=> 'site_bottom_intro_message',
				)
			)
		);
	
	
	// add section to manage callout
	$wp_customize->add_setting(
    'quality_pro_options[call_out_title]',
    array(
        'default' => __('Are You Ready To Enjoy? Get This Perfect Theme Now!','webriti-companion'),
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option',
		)
	);	
	$wp_customize->add_control( 'quality_pro_options[call_out_title]',array(
    'label'   => __('Title','webriti-companion'),
    'section' => 'callout_section_settings',
	 'type' => 'text','input_attrs' => array( 'disabled' =>'disabled' ),)  );	
	 
	 
	 $wp_customize->add_setting(
    'quality_pro_options[call_out_text]',
    array(
        'default' => 'Feel free to contact us if you have any questions on how you can use Quality.',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option',
		)
	);	
	$wp_customize->add_control('quality_pro_options[call_out_text]',array(
    'label'   => __('Description','webriti-companion'),
    'section' => 'callout_section_settings',
	 'type' => 'text','input_attrs' => array( 'disabled' =>'disabled' ),)  );	

	 
	$wp_customize ->add_setting (
	'quality_pro_options[call_out_button_text]',
	array( 
	'default' => __('Purchase Now','webriti-companion'),
	'capability'     => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'type' => 'option',
	) 
	);

	$wp_customize->add_control (
	'quality_pro_options[call_out_button_text]',
	array (  
	'label' => __('Button Text','webriti-companion'),
	'section' => 'callout_section_settings',
	'type' => 'text','input_attrs' => array( 'disabled' =>'disabled' ),
	) );
	
	$wp_customize ->add_setting (
	'quality_pro_options[call_out_button_link]',
	array( 
	'default' => '#',
	'capability'     => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'type' => 'option',
	) );

	$wp_customize->add_control (
	'quality_pro_options[call_out_button_link]',
	array (  
	'label' => __('Button Link','webriti-companion'),
	'section' => 'callout_section_settings',
	'type' => 'text','input_attrs' => array( 'disabled' =>'disabled' ),
	) );

	$wp_customize->add_setting(
		'quality_pro_options[call_out_button_link_target]',
		array('capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option',
		'default'=> true ,
		));

	$wp_customize->add_control(
		'quality_pro_options[call_out_button_link_target]',
		array(
			'type' => 'checkbox',
			'label' => __('Open link in new tab','webriti-companion'),
			'section' => 'callout_section_settings',
			'input_attrs' => array( 'disabled' =>'disabled' ),
		)
	);
	}
	add_action( 'customize_register', 'quality_callout_customizer' );
	?>
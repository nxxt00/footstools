<?php
function quality_team_customizer( $wp_customize ) {

//Home team Section
	$wp_customize->add_section(
        'team_section_settings',
        array(
            'title' => __('Team settings','webriti-companion'),
            'description' => '',
			'priority'       => 7,
			'panel'  => 'quality_homepage_section_setting',)
    );
    
    	//Upgrade to pro
		class quality_customize_team_upgrade_pro_message extends WP_Customize_Control {
			public function render_content() { ?>
			<h3><?php echo sprintf(__("Want to add team? <a href='http://webriti.com/quality' target='_blank'>Upgrade to Pro</a>","webriti-companion"));?></h3>
			<?php
			}
		}
		
		
		$wp_customize->add_setting( 'team_upgrade', array(
			'capability'			=> 'edit_theme_options',
			'sanitize_callback'	=> 'wp_filter_nohtml_kses',
		));
		$wp_customize->add_control(
			new quality_customize_team_upgrade_pro_message(
			$wp_customize,
			'about_upgrade',
				array(
					'section'				=> 'team_section_settings',
					'settings'				=> 'team_upgrade',
				)
			)
		);
	
	// add section to manage Testimonial Title
	$wp_customize->add_setting(
    'quality_pro_options[home_team_title]',
    array(
        'default' => __("Our Team","webriti-companion"),
		'capability'     => 'edit_theme_options',
		'type' => 'option',
		)
	);	
	$wp_customize->add_control( 'quality_pro_options[home_team_title]',array(
    'label'   => __('Title','webriti-companion'),
    'section' => 'team_section_settings',
	 'type' => 'text',
	 'input_attrs' => array('disabled' => 'disabled'),
	 )  );	
	 
	 
	 $wp_customize->add_setting(
    'quality_pro_options[home_team_desciption]',
    array(
        'default' => __('The <b>Best</b> Team','webriti-companion'),
		'capability'     => 'edit_theme_options',
		'type' => 'option',
		)
	);	
	$wp_customize->add_control( 'quality_pro_options[home_team_desciption]',array(
    'label'   => __('Description','webriti-companion'),
    'section' => 'team_section_settings',
	 'type' => 'text',
	 'input_attrs' => array('disabled' => 'disabled'),
	 )  );
	 
	 
	if ( class_exists( 'Quality_Repeater' ) ) {
			$wp_customize->add_setting(
				'quality_team_content', array(
				)
			);

			$wp_customize->add_control(
				new Quality_Repeater(
					$wp_customize, 'quality_team_content', array(
						'label'                            => esc_html__( 'Team content', 'webriti-companion' ),
						'section'                          => 'team_section_settings',
						'priority'                         => 15,
						'add_field_label'                  => esc_html__( 'Add new Team Member', 'webriti-companion' ),
						'item_name'                        => esc_html__( 'Team Member', 'webriti-companion' ),
						'customizer_repeater_image_control' => true,
						'customizer_repeater_title_control' => true,
						'customizer_repeater_subtitle_control' => true,
						'customizer_repeater_link_control' => true,
						'customizer_repeater_checkbox_control' => true,
						'customizer_repeater_repeater_control' => true,
						
					)
				)
			);
	 
	 }
	 
	 
	 	$wp_customize->add_setting(
		'quality_pro_options[team_animationSpeed]',
		array(
			'default' => '3000',
			'type' => 'option',
			'sanitize_callback' => 'sanitize_text_field',
			
		)
		);

		$wp_customize->add_control(
		'quality_pro_options[team_animationSpeed]',
		array(
			'type' => 'select',
			'label' => __('Animation speed','webriti-companion'),
			'section' => 'team_section_settings',
			'priority'   => 300,
			 'choices' => array( '2000'=>'2.0',
						'3000'=>'3.0',
						'4000'=>'4.0',
						'5000'=>'5.0',
						'6000'=>'6.0' )));	
						
		$wp_customize->add_setting(
		'quality_pro_options[team_smoothSpeed]',
		array(
			'default' => '1000',
			'type' => 'option',
			'sanitize_callback' => 'sanitize_text_field',
			
		)
		);

		$wp_customize->add_control(
		'quality_pro_options[team_smoothSpeed]',
		array(
			'type' => 'select',
			'label' => __('Smooth speed','webriti-companion'),
			'section' => 'team_section_settings',
			'priority'   => 300,
			'choices' => array( '500'=>'0.5',
						'1000'=>'1.0',
						'1500'=>'1.5',
						'2000'=>'2.0',
						'2500'=>'2.5',
						'3000'=>'3.0')));

}
	add_action( 'customize_register', 'quality_team_customizer' );
?>
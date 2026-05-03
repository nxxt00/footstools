<?php
function quality_shop_customizer( $wp_customize ) {

//Home shop Section
	$wp_customize->add_section(
        'shop_section_settings',
        array(
            'title' => __('Shop settings','webriti-companion'),
            'description' => '',
			'priority'       => 765,'panel'  => 'quality_homepage_section_setting',)
    );
    
    
    	//Upgrade to pro
		class quality_customize_shop_upgrade_pro_message extends WP_Customize_Control {
			public function render_content() { ?>
			<h3><?php echo sprintf(__("Want to sell products? <a href='http://webriti.com/quality' target='_blank'>Upgrade to Pro</a>","webriti-companion"));?></h3>
			<?php
			}
		}
		
		
		$wp_customize->add_setting( 'shop_upgrade', array(
			'capability'			=> 'edit_theme_options',
			'sanitize_callback'	=> 'wp_filter_nohtml_kses',
		));
		$wp_customize->add_control(
			new quality_customize_shop_upgrade_pro_message(
			$wp_customize,
			'shop_upgrade',
				array(
					'section'				=> 'shop_section_settings',
					'settings'				=> 'shop_upgrade',
				)
			)
		);
    
	
	// add section to manage Testimonial Title
	$wp_customize->add_setting(
    'quality_pro_options[home_shop_title]',
    array(
        'default' => __("Best Shop","webriti-companion"),
		'capability'     => 'edit_theme_options',
		'type' => 'option',
		)
	);	
	$wp_customize->add_control( 'quality_pro_options[home_shop_title]',array(
    'label'   => __('Title','webriti-companion'),
    'section' => 'shop_section_settings',
	 'type' => 'text',
	 'input_attrs' => array( 'disabled' =>'disabled' ),
	 )  );	
	 
	 
	 $wp_customize->add_setting(
    'quality_pro_options[home_shop_desciption]',
    array(
        'default' => __('Our <b>Featured</b> Products','webriti-companion'),
		'capability'     => 'edit_theme_options',
		'type' => 'option',
		)
	);	
	$wp_customize->add_control( 'quality_pro_options[home_shop_desciption]',array(
    'label'   => __('Description','webriti-companion'),
    'section' => 'shop_section_settings',
	 'type' => 'text','input_attrs' => array( 'disabled' =>'disabled' ),)  );
	 
	 
	 //link
	class WP_shop_section_Customize_Control extends WP_Customize_Control {
    public $type = 'new_menu';
    /**
    * Render the control's content.
    */
    public function render_content() {
    ?>
    
    <?php _e( 'To have access to a shop section please install and configure', 'webriti-companion' ); ?>
    </br></br><a href="https://wordpress.org/plugins/woocommerce/" class="button"  target="_blank"><?php _e( 'WooCommerce Plugin', 'webriti-companion' ); ?></a>
    <?php
   
    }
}
	 
	 
	 $wp_customize->add_setting(
	    'shop_section',
	    array(
	        'default' => '',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
	    )	
	);
	
	$wp_customize->add_control( new WP_shop_section_Customize_Control( $wp_customize, 'shop_section', array(	
			'section' => 'shop_section_settings',
	    ))
	);
	
	$wp_customize->add_setting(
		'quality_pro_options[shop_animationSpeed]',
		array(
			'default' => '3000',
			'type' => 'option',
			'sanitize_callback' => 'sanitize_text_field',
			
		)
		);

		$wp_customize->add_control(
		'quality_pro_options[shop_animationSpeed]',
		array(
			'type' => 'select',
			'label' => __('Animation speed','webriti-companion'),
			'section' => 'shop_section_settings',
			'priority'   => 300,
			 'choices' => array( '2000'=>'2.0',
						'3000'=>'3.0',
						'4000'=>'4.0',
						'5000'=>'5.0',
						'6000'=>'6.0' )));	
						
		$wp_customize->add_setting(
		'quality_pro_options[shop_smoothSpeed]',
		array(
			'default' => '1000',
			'type' => 'option',
			'sanitize_callback' => 'sanitize_text_field',
			
		)
		);

		$wp_customize->add_control(
		'quality_pro_options[shop_smoothSpeed]',
		array(
			'type' => 'select',
			'label' => __('Smooth speed','webriti-companion'),
			'section' => 'shop_section_settings',
			'priority'   => 300,
			'choices' => array( '500'=>'0.5',
						'1000'=>'1.0',
						'1500'=>'1.5',
						'2000'=>'2.0',
						'2500'=>'2.5',
						'3000'=>'3.0'))); 


	 
}
	add_action( 'customize_register', 'quality_shop_customizer' );
?>
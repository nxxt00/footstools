<?php
$repeater_path = trailingslashit( get_template_directory() ) . '/functions/customizer-repeater/functions.php';
if ( file_exists( $repeater_path ) ) {
require_once( $repeater_path );
}

function quality_client_customizer( $wp_customize ) {
//Front Client section
	
	$wp_customize->add_section(
        'client_section_settings',
        array(
            'title' => __('Clients settings','webriti-companion'),
            'description' => '',
			'priority'       => 755,
			'panel'  => 'quality_homepage_section_setting',)
    );
	
	
		//Upgrade to pro
		class quality_customize_client_upgrade_pro_message extends WP_Customize_Control {
			public function render_content() { ?>
			
			<h3><?php echo sprintf(__("Want to add client? <a href='http://webriti.com/quality' target='_blank'>Upgrade to Pro</a>","webriti-companion"));?></h3>
			<?php
			}
		}
		
		
		$wp_customize->add_setting( 'client_upgrade', array(
			'capability'			=> 'edit_theme_options',
			'sanitize_callback'	=> 'wp_filter_nohtml_kses',
		));
		$wp_customize->add_control(
			new quality_customize_client_upgrade_pro_message(
			$wp_customize,
			'client_upgrade',
				array(
					'section'				=> 'client_section_settings',
					'settings'				=> 'client_upgrade',
				)
			)
		);
	
	
	// Enable client section
	$wp_customize->add_setting( 'client_section_enable' , array( 'default' => 'on') );
	$wp_customize->add_control(	'client_section_enable' , array(
					'label'    => __( 'Enable Home Client section', 'webriti-companion' ),
					'section'  => 'client_section_settings',
					'type'     => 'radio',
					'choices' => array(
						'on'=>__('ON', 'webriti-companion'),
						'off'=>__('OFF', 'webriti-companion')
					)
	));
	
	
	if ( class_exists( 'Quality_Repeater' ) ) {
			$wp_customize->add_setting(
				'quality_clients_content', array(
				)
			);

			$wp_customize->add_control(
				new Quality_Repeater(
					$wp_customize, 'quality_clients_content', array(
						'label'                            => esc_html__( 'Clients content', 'webriti-companion' ),
						'section'                          => 'client_section_settings',
						'add_field_label'                  => esc_html__( 'Add new client', 'webriti-companion' ),
						'item_name'                        => esc_html__( 'Clients', 'webriti-companion' ),
						'customizer_repeater_image_control' => true,
						'customizer_repeater_link_control' => true,
						'customizer_repeater_checkbox_control' => true,
					)
				)
			);
		}
		

		$wp_customize->add_setting(
		'quality_pro_options[client_animationSpeed]',
		array(
			'default' => '3000',
			'type' => 'option',
			'sanitize_callback' => 'sanitize_text_field',
			
		)
		);

		$wp_customize->add_control(
		'quality_pro_options[client_animationSpeed]',
		array(
			'type' => 'select',
			'label' => __('Animation speed','webriti-companion'),
			'section' => 'client_section_settings',
			'priority'   => 300,
			 'choices' => array( '2000'=>'2.0',
						'3000'=>'3.0',
						'4000'=>'4.0',
						'5000'=>'5.0',
						'6000'=>'6.0' )));	
						
		$wp_customize->add_setting(
		'quality_pro_options[client_smoothSpeed]',
		array(
			'default' => '1000',
			'type' => 'option',
			'sanitize_callback' => 'sanitize_text_field',
			
		)
		);

	$wp_customize->add_control(
    'quality_pro_options[client_smoothSpeed]',
    array(
        'type' => 'select',
        'label' => __('Smooth speed','webriti-companion'),
        'section' => 'client_section_settings',
		'priority'   => 300,
		'choices' => array( '500'=>'0.5',
					'1000'=>'1.0',
					'1500'=>'1.5',
					'2000'=>'2.0',
					'2500'=>'2.5',
					'3000'=>'3.0')));	
		
	
	}
	add_action( 'customize_register', 'quality_client_customizer' );
	
?>
<?php 
// Home page section settings

add_action('customize_register','spasalon_homepage_customizer');

function spasalon_homepage_customizer($wp_customize)
{
	$wp_customize->add_panel( 'section_settings', array(
		'priority'       => 125,
		'capability'     => 'edit_theme_options',
		'title'      => __('Homepage section settings', 'spasalon'),
	) );


	/* settings */
		$wp_customize->add_section( 'news_settings' , array(
			'title'      => __('News section', 'spasalon'),
			'panel'  => 'section_settings',
			'priority'       => 4,
		) );
			
			// news enable / disable 
			$wp_customize->add_setting( 'spa_theme_options[enable_news]' , array(
			'default' => true,
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			) );
			
			$wp_customize->add_control('spa_theme_options[enable_news]' , array(
			'label'          => __('Enable News section', 'spasalon' ),
			'section'        => 'news_settings',
			'type'           => 'checkbox',
			) );
			
			// news layout
			$wp_customize->add_setting( 'spa_theme_options[news_layout]' , array(
			'default' => 2,
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			) );
			$wp_customize->add_control('spa_theme_options[news_layout]' , array(
			'label'          => __('Select column layout', 'spasalon' ),
			'section'        => 'news_settings',
			'type'           => 'select',
			'choices' => array(
				1 => 1,
				2 => 2,
				3 => 3,
				4 => 4,
			) ) );
			
			// news title
			$wp_customize->add_setting( 'spa_theme_options[news_title]' , array(
			'sanitize_callback' => 'spasalon_home_page_sanitize_text',
			'type'=>'option',
			'default' => __('Our Latest News & Events','spasalon'),
			) );
			$wp_customize->add_control('spa_theme_options[news_title]' , array(
			'label'          => __( 'Title', 'spasalon' ),
			'section'        => 'news_settings',
			'type'           => 'text'
			) );
			
			// news desc
			$wp_customize->add_setting( 'spa_theme_options[news_contents]' , array(
			'type'=>'option',
			'sanitize_callback' => 'spasalon_home_page_sanitize_text',
			'default' => 'The SpaSalon Produc Heading Title In commodo pulvinar metus, id tristique massa ultrices at. Nulla auctor turpis ut mi pulvinar eu accumsan risus sagittis. Mauris nunc ligula, ullamcorper vitae accumsan eu, congue in nulla. Cras hendrerit mi quis nisi semper in sodales nisl faucibus. Sed quis quam eu ante ornare hendrerit.',
			
			) );
			$wp_customize->add_control('spa_theme_options[news_contents]' , array(
			'label'          => __( 'Description', 'spasalon' ),
			'section'        => 'news_settings',
			'type'           => 'textarea'
			) );
}

function spasalon_home_page_sanitize_text( $input ) {

			return wp_kses_post( force_balance_tags( $input ) );

			}
			
			
/**
 * Add selective refresh for Front page section section controls.
 */
function spasalon_register_news_section_partials( $wp_customize ){

$wp_customize->selective_refresh->add_partial( 'spa_theme_options[news_title]', array(
		'selector'            => '.home-post .section-header h1',
		'settings'            => 'spa_theme_options[news_title]',
	
	) );

$wp_customize->selective_refresh->add_partial( 'spa_theme_options[news_contents]', array(
		'selector'            => '.home-post .section-subtitle',
		'settings'            => 'spa_theme_options[news_contents]',
	
	) );
	
	
}

add_action( 'customize_register', 'spasalon_register_news_section_partials' );			
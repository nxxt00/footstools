<?php
function quality_template_customizer( $wp_customize ) {

//Template panel 
	$wp_customize->add_panel( 'quality_template', array(
		'priority'       => 1010,
		'capability'     => 'edit_theme_options',
		'title'      => __('Template settings', 'webriti-companion'),
	) );
	
	
	// add section to manage Section heading
	$wp_customize->add_section(
        'section_heading',
        array(
            'title' => __('About Us page settings','webriti-companion'),
			'panel'  => 'quality_template',
			'priority'   => 100,
			
			)
    );
	
	//Upgrade to pro
	class quality_customize_about_us_upgrade_pro_message extends WP_Customize_Control {
		public function render_content() { ?>
		
		<h3><?php echo sprintf(__("Want to use about us template and settings. Then? <a href='http://webriti.com/quality' target='_blank'>Upgrade to Pro</a>","webriti-companion"));?></h3>
		<?php
		}
	}
		
		
		$wp_customize->add_setting( 'about_us_upgrade', array(
			'capability'			=> 'edit_theme_options',
			'sanitize_callback'	=> 'wp_filter_nohtml_kses',
		));
		$wp_customize->add_control(
			new quality_customize_about_us_upgrade_pro_message(
			$wp_customize,
			'about_us_upgrade',
				array(
					'section'				=> 'section_heading',
					'settings'				=> 'about_us_upgrade',
				)
			)
		);
	
	// enable/disable funfact section from about page
	$wp_customize->add_setting(
		'quality_pro_options[about_funfact_enable]',
		array('capability'  => 'edit_theme_options',
		'default' => true,
		'type' => 'option',
		));

	$wp_customize->add_control(
		'quality_pro_options[about_funfact_enable]',
		array(
			'type' => 'checkbox',
			'label' => __('Enable funfact section','webriti-companion'),
			'section' => 'section_heading',
		)
	);
	
	// enable/disable team section from about page
	$wp_customize->add_setting(
		'quality_pro_options[about_team_enable]',
		array('capability'  => 'edit_theme_options',
		'default' => true,
		'type' => 'option',
		));

	$wp_customize->add_control(
		'quality_pro_options[about_team_enable]',
		array(
			'type' => 'checkbox',
			'label' => __('Enable team section','webriti-companion'),
			'section' => 'section_heading',
		)
	);
	
	
	// enable/disable Footer Callout Section
	$wp_customize->add_setting(
		'quality_pro_options[footer_callout_enable]',
		array('capability'  => 'edit_theme_options',
		'default' => true,
		'type' => 'option',
		));

	$wp_customize->add_control(
		'quality_pro_options[footer_callout_enable]',
		array(
			'type' => 'checkbox',
			'label' => __('Enable Footer Callout section','webriti-companion'),
			'section' => 'section_heading',
		)
	);
	
	 
	 //enable/disable blog post meta content
	$wp_customize->add_section( 'blog_template' , array(
		'title'      => __('Blog meta settings', 'webriti-companion'),
		'panel'  => 'quality_template',
		'priority'   => 200,
   	) );
	
	
	
	//Upgrade to pro
	class quality_customize_blog_meta_upgrade_pro_message extends WP_Customize_Control {
		public function render_content() { ?>
		
		<h3><?php echo sprintf(__("Want to use blog template and settings. Then? <a href='http://webriti.com/quality' target='_blank'>Upgrade to Pro</a>","webriti-companion"));?></h3>
		<?php
		}
	}
		
		
		$wp_customize->add_setting( 'blog_meta_upgrade', array(
			'capability'			=> 'edit_theme_options',
			'sanitize_callback'	=> 'wp_filter_nohtml_kses',
		));
		$wp_customize->add_control(
			new quality_customize_blog_meta_upgrade_pro_message(
			$wp_customize,
			'blog_meta_upgrade',
				array(
					'section'				=> 'blog_template',
					'settings'				=> 'blog_meta_upgrade',
				)
			)
		);
	
	
	$wp_customize->add_setting(
    'quality_pro_options[blog_meta_section_settings]',
    array(
        'default' => false,
		'capability'     => 'edit_theme_options',
		'type' => 'option',
		
    )	
	);
	$wp_customize->add_control(
    'quality_pro_options[blog_meta_section_settings]',
    array(
        'label' => __('Hide post meta from blog pages.','webriti-companion'),
        'section' => 'blog_template',
        'type' => 'checkbox',
    )
	);
	
	$wp_customize->add_setting(
    'quality_pro_options[archive_page_meta_section_settings]',
    array(
        'default' => 0,
		'capability'     => 'edit_theme_options',
		'type' => 'option',
		
    )	
	);
	$wp_customize->add_control(
    'quality_pro_options[archive_page_meta_section_settings]',
    array(
        'label' => __('Hide post meta from archive pages.','webriti-companion'),
        'section' => 'blog_template',
        'type' => 'checkbox',
    )
	);
	
	
	// add section to manage Section heading
	$wp_customize->add_section(
        'service_page_setting',
        array(
            'title' => __('Service page settings','webriti-companion'),
			'panel'  => 'quality_template',
			'priority'   => 300,
			
			)
    );
	
	
	//Upgrade to pro
	class quality_customize_service_page_upgrade_pro_message extends WP_Customize_Control {
		public function render_content() { ?>
		
		<h3><?php echo sprintf(__("Want to use service template and settings. Then? <a href='http://webriti.com/quality' target='_blank'>Upgrade to Pro</a>","webriti-companion"));?></h3>
		<?php
		}
	}
		
		
		$wp_customize->add_setting( 'service_page_upgrade', array(
			'capability'			=> 'edit_theme_options',
			'sanitize_callback'	=> 'wp_filter_nohtml_kses',
		));
		$wp_customize->add_control(
			new quality_customize_service_page_upgrade_pro_message(
			$wp_customize,
			'service_page_upgrade',
				array(
					'section'				=> 'service_page_setting',
					'settings'				=> 'service_page_upgrade',
				)
			)
		);
	
	// enable/disable funfact section from about page
	$wp_customize->add_setting(
		'quality_pro_options[service_funfact_enable]',
		array('capability'  => 'edit_theme_options',
		'default' => true,
		'type' => 'option',
		));

	$wp_customize->add_control(
		'quality_pro_options[service_funfact_enable]',
		array(
			'type' => 'checkbox',
			'label' => __('Enable funfact section','webriti-companion'),
			'section' => 'service_page_setting',
		)
	);
	
	// enable/disable team section from about page
	$wp_customize->add_setting(
		'quality_pro_options[service_testimonial_enable]',
		array('capability'  => 'edit_theme_options',
		'default' => true,
		'type' => 'option',
		));

	$wp_customize->add_control(
		'quality_pro_options[service_testimonial_enable]',
		array(
			'type' => 'checkbox',
			'label' => __('Enable testimonial section','webriti-companion'),
			'section' => 'service_page_setting',
		)
	);
	
	
	
	// enable/disable Client section from Service page
	$wp_customize->add_setting(
		'quality_pro_options[service_client_enable]',
		array('capability'  => 'edit_theme_options',
		'default' => true,
		'type' => 'option',
		));

	$wp_customize->add_control(
		'quality_pro_options[service_client_enable]',
		array(
			'type' => 'checkbox',
			'label' => __('Enable client section','webriti-companion'),
			'section' => 'service_page_setting',
		)
	);
	
	
	// enable/disable Footer Callout Section
	$wp_customize->add_setting(
		'quality_pro_options[service_footer_callout_enable]',
		array('capability'  => 'edit_theme_options',
		'default' => true,
		'type' => 'option',
		));

	$wp_customize->add_control(
		'quality_pro_options[service_footer_callout_enable]',
		array(
			'type' => 'checkbox',
			'label' => __('Enable Footer Callout section','webriti-companion'),
			'section' => 'service_page_setting',
		)
	);
	
	// add section to manage Post type Slug
	$wp_customize->add_section(
        'posttype_slug_settings',
        array(
            'title' => __("Post type slug setting","webriti-companion"),
			'panel'  => 'quality_template',
			'priority'   => 400,
			
			)
    );
	
	
	
	//Upgrade to pro
	class quality_customize_project_slug_upgrade_pro_message extends WP_Customize_Control {
		public function render_content() { ?>
		
		<h3><?php echo sprintf(__("Want to use project slug setting. Then? <a href='http://webriti.com/quality' target='_blank'>Upgrade to Pro</a>","webriti-companion"));?></h3>
		<?php
		}
	}
		
		
		$wp_customize->add_setting( 'project_slug_upgrade', array(
			'capability'			=> 'edit_theme_options',
			'sanitize_callback'	=> 'wp_filter_nohtml_kses',
		));
		$wp_customize->add_control(
			new quality_customize_project_slug_upgrade_pro_message(
			$wp_customize,
			'project_slug_upgrade',
				array(
					'section'				=> 'posttype_slug_settings',
					'settings'				=> 'project_slug_upgrade',
				)
			)
		);
	
	
	//Portfolio/Project Slug 
	 $wp_customize->add_setting(
    'quality_pro_options[portfolio_slug]',
    array(
        'default' => 'quality_portfolio',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option',
		)
	);	
	$wp_customize->add_control( 'quality_pro_options[portfolio_slug]',array(
    'label'   => __('Project slug','webriti-companion'),
    'section' => 'posttype_slug_settings',
	 'type' => 'text',
	  'input_attrs' => array('disabled' => 'disabled'),
	 )  );	
	
	
	//Conatct Page
	// add section to manage Section heading
	$wp_customize->add_section(
        'conatact_page',
        array(
            'title' => __('Contact page setting','webriti-companion'),
			'panel'  => 'quality_template',
			'priority'   => 600,
			
			)
    );
	
	
	//Upgrade to pro
	class quality_customize_contact_page_upgrade_pro_message extends WP_Customize_Control {
		public function render_content() { ?>
		
		<h3><?php echo sprintf(__("Want to use contact page and setting. Then? <a href='http://webriti.com/quality' target='_blank'>Upgrade to Pro</a>","webriti-companion"));?></h3>
		<?php
		}
	}
		
		
		$wp_customize->add_setting( 'contact_us_upgrade', array(
			'capability'			=> 'edit_theme_options',
			'sanitize_callback'	=> 'wp_filter_nohtml_kses',
		));
		$wp_customize->add_control(
			new quality_customize_contact_page_upgrade_pro_message(
			$wp_customize,
			'contact_us_upgrade',
				array(
					'section'				=> 'conatact_page',
					'settings'				=> 'contact_us_upgrade',
				)
			)
		);
	
	// Conatct address title
	$wp_customize->add_setting(
		'quality_pro_options[contact_address_title]',
		array('capability'  => 'edit_theme_options',
		'default' => __('Address title','webriti-companion'), 
		'type' => 'option',
		));

	$wp_customize->add_control(
		'quality_pro_options[contact_address_title]',
		array(
			'type' => 'text',
			'label' => __('Address title','webriti-companion'),
			'section' => 'conatact_page',
			 'input_attrs' => array('disabled' => 'disabled'),
		)
	);
	
	// Conatct send message heading
	$wp_customize->add_setting(
		'quality_pro_options[contact_address]',
		array('capability'  => 'edit_theme_options',
		'default' => '25, Lorem Lis 1650 Park Street, <br />Alabama (US).', 
		'type' => 'option',
		));

	$wp_customize->add_control(
		'quality_pro_options[contact_address]',
		array(
			'type' => 'text',
			'label' => __('Address','webriti-companion'),
			'section' => 'conatact_page',
			 'input_attrs' => array('disabled' => 'disabled'),
		)
	);
	
	// Conatct address title
	$wp_customize->add_setting(
		'quality_pro_options[contact_email_title]',
		array('capability'  => 'edit_theme_options',
		'default' => __('Email title','webriti-companion'), 
		'type' => 'option',
		));

	$wp_customize->add_control(
		'quality_pro_options[contact_email_title]',
		array(
			'type' => 'text',
			'label' => __('Email title','webriti-companion'),
			'section' => 'conatact_page',
			'input_attrs' => array('disabled' => 'disabled'),
		)
	);
	
	// Conatct Email
	$wp_customize->add_setting(
		'quality_pro_options[contact_email]',
		array('capability'  => 'edit_theme_options',
		'default' => 'themes@webriti.com', 
		'type' => 'option',
		));

	$wp_customize->add_control(
		'quality_pro_options[contact_email]',
		array(
			'type' => 'text',
			'label' => __('Email','webriti-companion'),
			'section' => 'conatact_page',
			'input_attrs' => array('disabled' => 'disabled'),
		)
	);
	
	// Conatct address title
	$wp_customize->add_setting(
		'quality_pro_options[contact_phone_title]',
		array('capability'  => 'edit_theme_options',
		'default' => __('Support title','webriti-companion'), 
		'type' => 'option',
		));

	$wp_customize->add_control(
		'quality_pro_options[contact_phone_title]',
		array(
			'type' => 'text',
			'label' => __('Phone title','webriti-companion'),
			'section' => 'conatact_page',
			'input_attrs' => array('disabled' => 'disabled'),
		)
	);
	
	
	// Conatct send message heading
	$wp_customize->add_setting(
		'quality_pro_options[contact_phone_number]',
		array('capability'  => 'edit_theme_options',
		'default' => '00386 40 000 111', 
		'type' => 'option',
		));

	$wp_customize->add_control(
		'quality_pro_options[contact_phone_number]',
		array(
			'type' => 'text',
			'label' => __('Phone','webriti-companion'),
			'section' => 'conatact_page',
			 'input_attrs' => array('disabled' => 'disabled'),
		)
	);
	
	
	// Conatct address title
	$wp_customize->add_setting(
		'quality_pro_options[contact_form_shortcode]',
		array('capability'  => 'edit_theme_options',
		'default' => '', 
		'type' => 'option',
		));

	$wp_customize->add_control(
		'quality_pro_options[contact_form_shortcode]',
		array(
			'type' => 'text',
			'label' => __('Enter Contact Form 7 Shortcode','webriti-companion'),
			'section' => 'conatact_page',
			 'input_attrs' => array('disabled' => 'disabled'),
		)
	);
	
	
	
	// Conatct Google map
	$wp_customize->add_section(
        'conatact_page_map',
        array(
            'title' => __('Google Maps','webriti-companion'),
			'panel'  => 'quality_template',
			'priority'   => 700,
			
			)
    );
	
	
	//Upgrade to pro
	class quality_customize_google_map_upgrade_pro_message extends WP_Customize_Control {
		public function render_content() { ?>
		
		<h3><?php echo sprintf(__("Want to show Google maps. Then? <a href='http://webriti.com/quality' target='_blank'>Upgrade to Pro</a>","webriti-companion"));?></h3>
		<?php
		}
	}
		
		
		$wp_customize->add_setting( 'google_map_upgrade', array(
			'capability'			=> 'edit_theme_options',
			'sanitize_callback'	=> 'wp_filter_nohtml_kses',
		));
		$wp_customize->add_control(
			new quality_customize_google_map_upgrade_pro_message(
			$wp_customize,
			'google_map_upgrade',
				array(
					'section'				=> 'conatact_page_map',
					'settings'				=> 'google_map_upgrade',
				)
			)
		);
	
	
	// Contact Office time:
	$wp_customize->add_setting(
		'quality_pro_options[contact_google_map_enabled]',
		array('capability'  => 'edit_theme_options',
		'default' => 'on', 
		'type' => 'option',
		));

	$wp_customize->add_control(
		'quality_pro_options[contact_google_map_enabled]',
		array(
			'type' => 'checkbox',
			'label' => __('Enable Google Maps','webriti-companion'),
			'section' => 'conatact_page_map',
		)
	);
	
	//Google map URL
	
	$wp_customize->add_setting(
		'quality_pro_options[contact_google_map_url]',
		array('capability'  => 'edit_theme_options',
		'default' => 'https://maps.google.co.in/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Kota+Industrial+Area,+Kota,+Rajasthan&amp;aq=2&amp;oq=kota+&amp;sll=25.003049,76.117499&amp;sspn=0.020225,0.042014&amp;t=h&amp;ie=UTF8&amp;hq=&amp;hnear=Kota+Industrial+Area,+Kota,+Rajasthan&amp;z=13&amp;ll=25.142832,75.879538', 
		'type' => 'option',
		));

	$wp_customize->add_control(
		'quality_pro_options[contact_google_map_url]',
		array(
			'type' => 'textarea',
			'label' => __('Google Maps URL','webriti-companion'),
			'section' => 'conatact_page_map',
			 'input_attrs' => array('disabled' => 'disabled'),
		)
	);
	
	
	}
	add_action( 'customize_register', 'quality_template_customizer' );
	

?>
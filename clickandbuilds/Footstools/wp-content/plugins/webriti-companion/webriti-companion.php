<?php
/*
Plugin Name: Webriti Companion
Plugin URI:
Description: Enhances Webriti themes with extra functionality.
Version: 0.8.8
Author: Webriti
Author URI: https://github.com
Text Domain: webriti-companion
*/
define( 'WC__PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'WC__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

function webriti_companion_activate() {
	$theme = wp_get_theme(); // gets the current theme
	
	if ( 'Quality' == $theme->name || 'Quality blue' == $theme->name || 'Quality orange' == $theme->name|| 'Quality green' == $theme->name || 'Mazino' == $theme->name || 'Heroic' == $theme->name || 'Quality child' == $theme->name ){
		
		require_once('inc/quality/features/feature-service-section.php');
		require_once('inc/quality/features/feature-project-section.php');
		require_once('inc/quality/features/feature-funfact-section.php');
		require_once('inc/quality/features/feature-testimonial-section.php');
		require_once('inc/quality/features/feature-team.php');
		require_once('inc/quality/features/feature-shop.php');
		require_once('inc/quality/features/customizer-client.php');
		require_once('inc/quality/features/feature-footer-callout.php');
		require_once('inc/quality/sections/quality-portfolio-section.php');
		require_once('inc/quality/sections/quality-features-section.php');
		require_once('inc/quality/sections/quality-funfact-section.php');
		require_once('inc/quality/sections/quality-testimonial-section.php');
		require_once('inc/quality/features/customizer-template.php');
		require_once('inc/quality/features/customizer-layout.php');
		require_once('inc/quality/features/customizer-typography.php');
		
		require_once('inc/quality/customizer.php');
		
	}
	
	if ( 'Spasalon' == $theme->name || 'Spasalon child' == $theme->name){
		require_once('inc/spasalon/features/feature-slider-section.php');
		require_once('inc/spasalon/features/feature-service-section.php');
		require_once('inc/spasalon/features/feature-project-section.php');
		require_once('inc/spasalon/sections/spasalon-slider-section.php');
		require_once('inc/spasalon/sections/spasalon-portfolio-section.php');
		require_once('inc/spasalon/sections/spasalon-features-section.php');
		require_once('inc/spasalon/customizer.php');
		
	}
	
	if ( 'Dream Spa' == $theme->name){
		require_once('inc/dreamspa/features/feature-slider-section.php');
		require_once('inc/spasalon/features/feature-service-section.php');
		require_once('inc/spasalon/features/feature-project-section.php');
		require_once('inc/dreamspa/sections/dreamspa-slider-section.php');
		require_once('inc/spasalon/sections/spasalon-portfolio-section.php');
		require_once('inc/spasalon/sections/spasalon-features-section.php');
		require_once('inc/spasalon/customizer.php');
		
	}
	

}
add_action( 'init', 'webriti_companion_activate' );


$theme = wp_get_theme();
if ( 'Quality' == $theme->name || 'Quality blue' == $theme->name || 'Quality orange' == $theme->name|| 'Quality green' == $theme->name || 'Mazino' == $theme->name || 'Heroic' == $theme->name || 'Quality child' == $theme->name){
		
	
register_activation_hook( __FILE__, 'webriti_companion_install_function');
function webriti_companion_install_function()
{
    $item_details_page = get_option('item_details_page'); 
    if(!$item_details_page){
        //post status and options
        $post = array(
              'comment_status' => 'closed',
              'ping_status' =>  'closed' ,
              'post_author' => 1,
              'post_date' => date('Y-m-d H:i:s'),
              'post_name' => 'Home',
              'post_status' => 'publish' ,
              'post_title' => 'Home',
              'post_type' => 'page',
        );  
        //insert page and save the id
        $newvalue = wp_insert_post( $post, false );
        if ( $newvalue && ! is_wp_error( $newvalue ) ){
            update_post_meta( $newvalue, '_wp_page_template', 'template-business.php' );
            
            // Use a static front page
            $page = get_page_by_title('Home');
            update_option( 'show_on_front', 'page' );
            update_option( 'page_on_front', $page->ID );
            
        }
        //save the id in the database
        update_option( 'item_details_page', $newvalue );
    }
}

}

else if ( 'Spasalon' == $theme->name || 'Spasalon child' == $theme->name ){
		
	
register_activation_hook( __FILE__, 'webriti_companion_install_function');
function webriti_companion_install_function()
{
    $ThemeFrontPage = get_option('spasalon_theme_front_page'); 
    if(!$ThemeFrontPage){
        //post status and options
        $post = array(
              'comment_status' => 'closed',
              'ping_status' =>  'closed' ,
              'post_author' => 1,
              'post_date' => date('Y-m-d H:i:s'),
              'post_name' => 'Home',
              'post_status' => 'publish' ,
              'post_title' => 'Home',
              'post_type' => 'page',
        );  
        //insert page and save the id
        $newvalue = wp_insert_post( $post, false );
        if ( $newvalue && ! is_wp_error( $newvalue ) ){
            update_post_meta( $newvalue, '_wp_page_template', 'template-front-page.php' );
            
            // Use a static front page
            $page = get_page_by_title('Home');
            update_option( 'show_on_front', 'page' );
            update_option( 'page_on_front', $page->ID );
            
        }
        //save the id in the database
        update_option( 'spasalon_theme_front_page', $newvalue );
    }
}
}


else if ( 'Dream Spa' == $theme->name){
		
	
register_activation_hook( __FILE__, 'webriti_companion_install_function');
function webriti_companion_install_function()
{
    $ThemeFrontPage = get_option('spasalon_theme_front_page'); 
    if(!$ThemeFrontPage){
        //post status and options
        $post = array(
              'comment_status' => 'closed',
              'ping_status' =>  'closed' ,
              'post_author' => 1,
              'post_date' => date('Y-m-d H:i:s'),
              'post_name' => 'Home',
              'post_status' => 'publish' ,
              'post_title' => 'Home',
              'post_type' => 'page',
        );  
        //insert page and save the id
        $newvalue = wp_insert_post( $post, false );
        if ( $newvalue && ! is_wp_error( $newvalue ) ){
            update_post_meta( $newvalue, '_wp_page_template', 'template-front-page.php' );
            
            // Use a static front page
            $page = get_page_by_title('Home');
            update_option( 'show_on_front', 'page' );
            update_option( 'page_on_front', $page->ID );
            
        }
        //save the id in the database
        update_option( 'spasalon_theme_front_page', $newvalue );
    }
}


}
?>
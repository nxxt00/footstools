<?php
/**
 * Template Name: Business Template
 *
 * @package WordPress
 * @subpackage spasalon
 */
	get_header(); 

	$spa_theme_options=default_data(); 
	$current_options = wp_parse_args(  get_option( 'spa_theme_options', array() ), $spa_theme_options );
	do_action( 'spasalon_sections', false );

	get_template_part('index','news');

	get_footer(); 
?>
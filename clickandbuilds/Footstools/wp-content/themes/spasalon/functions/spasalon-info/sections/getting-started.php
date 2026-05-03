<?php
/**
 * Getting started template
 */

$customizer_url = admin_url() . 'customize.php' ;
?>

<div id="getting_started" class="spasalon-tab-pane active">

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1 class="spasalon-info-title text-center"><?php echo __('About SpaSalon Lite','spasalon'); ?><?php if( !empty($spasalon['Version']) ): ?> <sup id="spasalon-theme-version"><?php echo esc_attr( $spasalon['Version'] ); ?> </sup><?php endif; ?></h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="spasalon-tab-pane-half spasalon-tab-pane-first-half">
				<p><?php esc_html_e( 'SpaSalon is a responsive multipurpose WordPress theme best suitable for the beauty industry, to build websites for cosmetologists, hair styling, SPAs, beauty salons, massage and therapy centres, beauty care, etc. In any case, SpaSalon is not limited to the beauty sector, so you can use it for any type of business.','spasalon');?></p>

				<p><?php esc_html_e( 'You can use this theme for any type of activity. SpaSalon is compatible with popular plugins like WPML and Polylang, and has predefined versions of Contact pages, Services pages, Portfolio columned layout pages, About Us and Blog layout pages to help you create an effective and impactful web presence.','spasalon');?></p>
				
				<h1 style="margin-top: 73px;"><?php esc_html_e( "Getting Started", 'spasalon' ); ?></h1>
				<div style="border-top: 1px solid #eaeaea;">
				<p style="margin-top: 16px;">
				
				<?php esc_html_e( 'Install and activate the Webriti Companion plugin to take full advantage of all the features this theme has to offer. Go to Customize and install the Webriti Companion plugin.', 'spasalon' ); ?>
				
				</p>
				<p><a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Go to the Customizer','spasalon');?></a></p>
				</div>
				
				</div>
			</div>
			<div class="col-md-6">
				<div class="spasalon-tab-pane-half spasalon-tab-pane-first-half">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/functions/spasalon-info/img/spasalon.png'; ?>" />
				</div>
			</div>	
		</div>
	
	
		 <div class="row">
		 
			<div class="spasalon-tab-center">

				<h1><?php esc_html_e( "Useful Links", 'spasalon' ); ?></h1>

			</div>
			
			<div class="col-md-6"> 
				<div class="spasalon-tab-pane-half spasalon-tab-pane-first-half">

					<a href="<?php echo esc_url('http://webriti.com/demo/wp/lite/spasalon/'); ?>" target="_blank"  class="info-block"><div class="dashicons dashicons-desktop info-icon"></div>
					<p class="info-text"><?php echo __('Lite Demo','spasalon'); ?></p></a>
					
					
					<a href="<?php echo esc_url('http://webriti.com/demo/wp/preview/?prev=spasalon/'); ?>" target="_blank"  class="info-block"><div class="dashicons dashicons-book-alt info-icon"></div>
					<p class="info-text"><?php echo __('View PRO','spasalon'); ?></p></a>
					
					<a href="<?php echo esc_url('http://webriti.com/support/categories/spasalon'); ?>" target="_blank"  class="info-block"><div class="dashicons dashicons-sos info-icon"></div>
					<p class="info-text"><?php echo __('Premium Theme Support','spasalon'); ?></p></a>
					
				</div>
			</div>
			
			<div class="col-md-6">	
				<div class="spasalon-tab-pane-half spasalon-tab-pane-first-half">
					
					<a href="<?php echo esc_url('https://wordpress.org/support/theme/spasalon/reviews/#new-post'); ?>" target="_blank"  class="info-block"><div class="dashicons dashicons-smiley info-icon"></div>
					<p class="info-text"><?php echo __('Rate this theme','spasalon'); ?></p></a>
					
					<a href="<?php echo esc_url('https://wordpress.org/support/theme/spasalon'); ?>" target="_blank"  class="info-block"><div class="dashicons dashicons-sos info-icon"></div>
					<p class="info-text"><?php echo __('Support','spasalon'); ?></p></a>
				</div>
			</div>
			
		</div>	
	</div>
</div>	
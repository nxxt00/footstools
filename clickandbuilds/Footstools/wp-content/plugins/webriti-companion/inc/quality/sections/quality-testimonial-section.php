<?php
if ( ! function_exists( 'quality_testimonial' ) ) :
function quality_testimonial() {
	$funfact_enable = get_theme_mod('testimonial_enable',true);
if($funfact_enable == true){
$testimonial_background = get_theme_mod('testimonial_background');	
 if($testimonial_background != '') {
 ?>

<section  id="section-block"  class="testimonial left-right-half" style="background-image:url('<?php echo esc_url($testimonial_background);?>'); background-size: cover; background-position: fixed; background-rapeat: no-repeat; position: relative; ">
	
	<?php } else { ?>
<section id="section-block"  class="testimonial left-right-half">
	<?php } ?>
		<div class="container">
	<?php 	$quality_pro_options= companion_testimonial_theme_data_setup(); 
			$current_theme_content = wp_parse_args(  get_option( 'quality_pro_options', array() ),$quality_pro_options );
			
			
			$testimonial_title = get_theme_mod('testimonial_title','Sed ut Perspiciatis Unde Omnis Iste');
			$testimonial_descripton = get_theme_mod('testimonial_descripton','Sed ut Perspiciatis Unde Omnis Iste Sed ut perspiciatis  unde omnis iste natu error sit voluptatem accu tium
			neque fermentum veposu miten a tempor nise. Duis autem vel eum iriure dolor in hendrerit in vulputate velit consequat in velit esse.');
			$testimonial_name = get_theme_mod('testimonial_name','Bella Robbertson');
			$testimonial_position = get_theme_mod('testimonial_position',__('Developer','webriti-companion'));
			$testimonial_image = get_theme_mod('testimonial_image', WC__PLUGIN_URL .'/inc/quality/images/user1.jpg');
			
			
			$current_options = get_option( 'quality_pro_options');
			if(($current_theme_content['home_testimonial_title']) || ($current_theme_content['home_testimonial_desciption']!='' )) {
			 ?>
		<div class="row">
			<div class="section-header">
				<?php if($current_theme_content['home_testimonial_title']) { ?>
				<p><?php echo $current_theme_content['home_testimonial_title']; ?></p>
				<?php }
				if($current_theme_content['home_testimonial_desciption']) { ?>
				<h1 class="widget-title"><?php echo $current_theme_content['home_testimonial_desciption']; ?></h1>
				<?php } ?>
				<hr class="divider">
			</div>
		</div>
		 <?php } ?>
		
	<div class="row">
	
			<div id="testimonial-carousel" class="owl-carousel owl-theme col-md-12">
				<div class="item">
						<blockquote class="testmonial-block text-center">
							<div class="description">
								<h3 class="title"><?php echo $testimonial_title; ?></h3>
								<p><?php  echo $testimonial_descripton; ?></p>
							</div>									
							<figure class="avatar">
								<img class="img-responsive img-circle" src="<?php echo $testimonial_image; ?>" />
							</figure>
							<figcaption>
								<cite class="name"><?php echo $testimonial_name; ?></cite>
								<span class="designation"><?php echo $testimonial_position; ?></span>
							</figcaption>
						</blockquote>	
				</div>
				
	    </div>
    </div>

</div>
</section>
<?php } } endif;?>
<?php
if ( function_exists( 'quality_testimonial' ) ) {
		$section_priority = apply_filters( 'quality_section_priority', 14, 'quality_testimonial' );
		add_action( 'quality_sections', 'quality_testimonial', absint( $section_priority ) );
}

function companion_testimonial_theme_data_setup()
{	
	return $theme_options=array(

			'home_testimonial_title' => __("Client's Feedback","webriti-companion"),
			'home_testimonial_desciption' => __("What <b>People</b> Say","webriti-companion"),
		);
}
?>
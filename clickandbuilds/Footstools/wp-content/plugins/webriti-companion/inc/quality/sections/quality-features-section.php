<?php
/**
 * Services section for the homepage.
 */
if ( ! function_exists( 'quality_features' ) ) :

	function quality_features() {

		$current_options = get_option( 'quality_pro_options');
		$hide_section = isset($current_options['service_enable'])? $current_options['service_enable']:true;
	
		$quality_service_title    = isset($current_options['service_title'])? $current_options['service_title'] : __('Our services','webriti-companion');
		$quality_service_subtitle = isset($current_options['service_description'])?$current_options['service_description']: __('Our <b>Awesome</b> Services','webriti-companion');
		$quality_service_content  = ! empty($current_options['quality_service_content']) ? $current_options['quality_service_content'] : quality_get_service_default();
		$section_is_empty = empty( $quality_service_content ) && empty( $quality_service_subtitle ) && empty( $quality_service_title );

	if (  $hide_section == true ) {
		?>
		<section id="section-block" class="service">
			
			<div class="container">
				<?php if(($quality_service_title) || ($quality_service_subtitle!='' )) {?>
				<div class="row">
					<div class="section-header">
						<?php
							if ( ! empty( $quality_service_title ) || is_customize_preview() ) {
								echo '<p>' . $quality_service_title . '</p>';
							}
							
							if ( ! empty( $quality_service_subtitle ) || is_customize_preview() ) {
								echo '<h1 class="widget-title">' . $quality_service_subtitle  . '</h1>';
							}
							echo '<hr class="divider">';
							?>
					</div>	 
				</div>
				<?php
				}
				quality_service_content( $quality_service_content );
				?>
			</div>
		</section>
		<?php
	}
	}

endif;


function quality_service_content( $quality_service_content, $is_callback = false ) {
	if ( ! $is_callback ) {
	?>
<div id="service_content_section">
	<div class="row">
		<?php
	}
	if ( ! empty( $quality_service_content ) ) :

		$quality_service_content = json_decode( $quality_service_content );
		if ( ! empty( $quality_service_content ) ) {
			$i = 1;
			foreach ( $quality_service_content as $service_item ) :
				$icon = ! empty( $service_item->icon_value ) ?  $service_item->icon_value : '';
				$image = ! empty( $service_item->image_url ) ?  $service_item->image_url: '';
				$title = ! empty( $service_item->title ) ? $service_item->title : '';
				$text = ! empty( $service_item->text ) ?  $service_item->text : '';
				$link = ! empty( $service_item->link ) ? $service_item->link : '';
				$color = ! empty( $service_item->color ) ? $service_item->color : '';
				$open_new_tab = ! empty( $service_item->open_new_tab ) ? $service_item->open_new_tab : 'no';
				
				if(!isset($service_item->choice)){
					$service_item->choice = 'customizer_repeater_icon';
				}
				
				?>
				<div class="col-md-4 col-sm-6 col-xs-12">
					<!--<div class="service_area">-->
					<article class="post text-center">
					    
						<?php if($service_item->choice == 'customizer_repeater_image'){ ?>
							<?php if ( ! empty( $image ) ) : ?>
							<figure class="post-thumbnail"> 
								<?php if ( ! empty( $link ) ) : ?>
									<a href="<?php echo $link; ?>" <?php if($open_new_tab== 'yes' || $open_new_tab== 'on') { echo "target='_blank'"; } ?>>
									   <img class="img-responsive" src="<?php echo esc_url( $image ); ?>" <?php if ( ! empty( $title ) ) : ?> alt="<?php echo esc_attr( $title ); ?>" title="<?php echo esc_attr( $title ); ?>" <?php endif; ?> />
									</a>
								<?php endif; ?>	
								<?php if ( empty( $link ) ) : ?>	
										<img class="img-responsive" src="<?php echo esc_url( $image ); ?>" <?php if ( ! empty( $title ) ) : ?> alt="<?php echo esc_attr( $title ); ?>" title="<?php echo esc_attr( $title ); ?>" <?php endif; ?> />
                                <?php endif; ?>	
                            </figure>								
							<?php endif; ?>
						<?php } else if($service_item->choice =='customizer_repeater_icon'){ ?>
							<?php if ( ! empty( $icon ) ) :?>
							<figure class="post-thumbnail">
									<?php if ( ! empty( $link ) ) : ?>
											<a href="<?php echo $link; ?>" <?php if($open_new_tab== 'yes' || $open_new_tab== 'on') { echo "target='_blank'"; } ?>><i class="fa <?php echo esc_html( $icon ); ?>"></i></a>
									<?php endif; ?>
									<?php if ( empty( $link ) ) : ?>
											<i class="fa <?php echo esc_html( $icon ); ?>"></i>	
									<?php endif; ?>
							</figure>
							<?php endif; ?>
						<?php } ?>
			            
							
							<?php if ( ! empty( $title ) ) : 
								if(empty($link)){ ?>
									<div class="entry-header">
									<h3 class="entry-title"><?php echo esc_html( $title ); ?></h3></div><?php
								}else{
									?>
									<div class="entry-header">
									<h3 class="entry-title"><a href="<?php echo $link; ?>" <?php if($open_new_tab!='no'){?>target="_blank" <?php }?> ><?php echo esc_html( $title ); ?></a></h3></div><?php
								}
							?>
							<?php endif; ?>
							
							<?php if ( ! empty( $text ) ) : ?>
								<div class="entry-content"><p><?php echo wp_kses_post( html_entity_decode( $text ) ); ?></p></div>
							<?php endif; ?>
				    </article>
			    </div>	
				<?php
			endforeach;
			echo '</div>';
		}// End if().
		endif;
	if ( ! $is_callback ) {
	?>
	</div></div>	
		<?php
	}
}

/**
 * Get default values for service section.
 *
 * @since 1.1.31
 * @access public
 */
function quality_get_service_default() {
	
	$old_theme_servives = wp_parse_args(  get_option( 'quality_pro_options', array() ), plugin_data_setup() );
	
	//if(get_option( 'quality_pro_options')!=''){
	if($old_theme_servives['service_one_icon']!= '' || $old_theme_servives['service_one_title']!= '' || $old_theme_servives['service_one_text']!= '' 
			|| $old_theme_servives['service_two_icon']!= '' || $old_theme_servives['service_two_title']!= '' || $old_theme_servives['service_two_text']!= '' 
			|| $old_theme_servives['service_three_icon']!= '' || $old_theme_servives['service_three_title']!= '' || $old_theme_servives['service_three_text']!= ''
			 || $old_theme_servives['service_four_icon']!= '' || $old_theme_servives['service_four_title']!= '' || $old_theme_servives['service_four_text']!= '' || $old_theme_servives['service_five_icon']!= '' || $old_theme_servives['service_five_title']!= '' || $old_theme_servives['service_five_text']!= '' || $old_theme_servives['service_six_icon']!= '' || $old_theme_servives['service_six_title']!= '' || $old_theme_servives['service_six_text']!= '')
		 {
			 //$old_theme_servives = get_option( 'quality_pro_options');
			 
			 return apply_filters(
		'quality_service_default_content', json_encode(
			array(
				array(
						 'icon_value' => isset($old_theme_servives['service_one_icon'])? $old_theme_servives['service_one_icon']:'',
						 'title'      => isset($old_theme_servives['service_one_title'])? $old_theme_servives['service_one_title']:'',
						'text'       => isset($old_theme_servives['service_one_text'])? $old_theme_servives['service_one_text']:'',
						'choice'    => 'customizer_repeater_icon',
						'link'       => '',
						'open_new_tab' => 'no',
						 ),
						array(
						 'icon_value' => isset($old_theme_servives['service_two_icon'])? $old_theme_servives['service_two_icon']:'',
						 'title'      => isset($old_theme_servives['service_two_title'])? $old_theme_servives['service_two_title']:'',
						 'text'       => isset($old_theme_servives['service_two_text'])? $old_theme_servives['service_two_text']:'',
						 'choice'    => 'customizer_repeater_icon',
						 'link'       => '',
						 'open_new_tab' => 'no',
						 ),
						 array(
						 'icon_value' => isset($old_theme_servives['service_three_icon'])? $old_theme_servives['service_three_icon']:'',
						 'title'      => isset($old_theme_servives['service_three_title'])? $old_theme_servives['service_three_title']:'',
						 'text'       => isset($old_theme_servives['service_three_text'])? $old_theme_servives['service_three_text']:'',
						 'choice'    => 'customizer_repeater_icon',
						 'link'       => '',
						 'open_new_tab' => 'no',
						),
						
						 array(
						 'icon_value' => isset($old_theme_servives['service_four_icon'])? $old_theme_servives['service_four_icon']:'',
						 'title'      => isset($old_theme_servives['service_four_title'])? $old_theme_servives['service_four_title']:'',
						 'text'       => isset($old_theme_servives['service_four_text'])? $old_theme_servives['service_four_text']:'',
						 'choice'    => 'customizer_repeater_icon',
						 'link'       => '',
						 'open_new_tab' => 'no',
						),
						
						array(
						 'icon_value' => isset($old_theme_servives['service_five_icon'])? $old_theme_servives['service_five_icon']:'',
						 'title'      => isset($old_theme_servives['service_five_title'])? $old_theme_servives['service_five_title']:'',
						 'text'       => isset($old_theme_servives['service_five_text'])? $old_theme_servives['service_five_text']:'',
						 'choice'    => 'customizer_repeater_icon',
						 'link'       => '',
						 'open_new_tab' => 'no',
						),
						
						array(
						 'icon_value' => isset($old_theme_servives['service_six_icon'])? $old_theme_servives['service_six_icon']:'',
						 'title'      => isset($old_theme_servives['service_six_title'])? $old_theme_servives['service_six_title']:'',
						 'text'       => isset($old_theme_servives['service_six_text'])? $old_theme_servives['service_six_text']:'',
						 'choice'    => 'customizer_repeater_icon',
						 'link'       => '',
						 'open_new_tab' => 'no',
						),
			)
		)
	);	 
		 } 
		 //}
	else {
	return apply_filters(
		'quality_service_default_content', json_encode(
			array(
				array(
					'icon_value' => 'fa fa-cogs txt-pink',
					'title'      => esc_html__( 'Highly Customizable', 'webriti-companion' ),
					'text'       => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed dosit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.',
					'choice'    => 'customizer_repeater_icon',
					'link'       => '#',
					'open_new_tab' => 'no',
				),
				array(
					'icon_value' => 'fa fa-mobile txt-pink',
					'title'      => esc_html__( 'Fully Responsive Layout', 'webriti-companion' ),
					'text'       => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed dosit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.',
					'link'       => '#',
					'choice'    => 'customizer_repeater_icon',
					'open_new_tab' => 'no',
				),
				array(
					'icon_value' => 'fa fa-users txt-pink',
					'title'      => esc_html__( 'User Experience', 'webriti-companion' ),
					'text'       => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed dosit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.',
					'choice'    => 'customizer_repeater_icon',
					'link'       => '#',
					'open_new_tab' => 'no',
				),
				array(
					'icon_value' => 'fa fa-laptop txt-pink',
					'title'      => esc_html__( 'Creative Web Design', 'webriti-companion' ),
					'text'       => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed dosit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.',
					'choice'    => 'customizer_repeater_icon',
					'link'       => '#',
					'open_new_tab' => 'no',
				),
				
				array(
					'icon_value' => 'fa fa-file-code-o txt-pink',
					'title'      => esc_html__( 'Unique and Clean', 'webriti-companion' ),
					'text'       => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed dosit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.',
					'choice'    => 'customizer_repeater_icon',
					'link'       => '#',
					'open_new_tab' => 'no',
				),
				
				array(
					'icon_value' => 'fa fa-star-half-full txt-pink',
					'title'      => esc_html__( 'Creative Ideas', 'webriti-companion' ),
					'text'       => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed dosit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.',
					'choice'    => 'customizer_repeater_icon',
					'link'       => '#',
					'open_new_tab' => 'no',
				),
			)
		)
	);
	}
}

if ( function_exists( 'quality_features' ) ) {
	$section_priority = apply_filters( 'quality_section_priority', 10, 'quality_features' );
	add_action( 'quality_sections', 'quality_features', absint( $section_priority ) );
	
}

function plugin_data_setup()
{	

			return $theme_options=array(
			'service_one_title' => __('Highly Customizable','webriti-companion'),
			'service_two_title' => __('Fully Responsive Layout','webriti-companion'),
			'service_three_title' => __('User Experience','webriti-companion'),
			'service_four_title' => __('Creative Web Design','webriti-companion'),
			'service_five_title' => __('Unique and Clean','webriti-companion'),
			'service_six_title' => __('Creative Ideas','webriti-companion'),
			
			'service_one_icon' => 'fa fa-cogs txt-pink',
			'service_two_icon' => 'fa fa-mobile txt-pink',
			'service_three_icon' => 'fa fa-users txt-pink',
			'service_four_icon' => 'fa fa-laptop txt-pink',
			'service_five_icon' => 'fa fa-file-code-o txt-pink',
			'service_six_icon' => 'fa fa-star-half-full txt-pink',
			
			'service_one_text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed dosit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.',
			'service_two_text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed dosit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.',
			'service_three_text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed dosit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.',
			'service_four_text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed dosit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.',
			'service_five_text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed dosit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.',
			'service_six_text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed dosit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.',
			
		);
}
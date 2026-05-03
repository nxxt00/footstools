<?php
//Pro Button
function quality_layout_customizer( $wp_customize ) {
class WP_layout_Customize_Control extends WP_Customize_Control {
    public $type = 'new_menu';
    /**
    * Render the control's content.
    */
    public function render_content() {
		
	$quality_pro_options=theme_data_setup(); 
	$current_options = wp_parse_args(  get_option( 'quality_pro_options', array() ), $quality_pro_options );
	$data_enable = is_array($current_options['front_page_data']) ? $current_options['front_page_data'] : explode(",",$current_options['front_page_data']);
	$defaultenableddata=array('service','funfact','portfolio','testimonials','client','blog','team','shop','calloutarea','footerwidget');
	$layout_disable=array_diff($defaultenableddata,$data_enable);

    ?>
 <h3><?php _e('Enabled','webriti-companion'); ?></h3>
  <ul class="sortable customizer_layout" id="enable">
  <?php if( !empty($data_enable[0]) )    { foreach( $data_enable as $value ){ ?>
  <li class="ui-state" id="<?php echo $value; ?>"><?php echo $value; ?></li>
  <?php } } ?>
  </ul>
  
  
 <h3><?php _e('Disabled','webriti-companion'); ?></h3> 
 <ul class="sortable customizer_layout" id="disable">
 <?php if(!empty($layout_disable)){ foreach($layout_disable as $val){ ?>
  <li class="ui-state" id="<?php echo $val; ?>"><?php echo $val; ?></li>
  <?php } } ?>
 </ul>
 <div class="section">
		<p> <b><?php _e('Slider has fixed position on homepage.','webriti-companion'); ?></b></p>
		<p> <b><?php _e('Note','webriti-companion'); ?> </b> <?php _e('By default, all sections are enabled on homepage. If you wish not to display a section, just drag it onto the "disabled" box.','webriti-companion'); ?><p>
		</div>
<script>
jQuery(document).ready(function($) {
    $( ".sortable" ).sortable({
		connectWith: '.sortable'
	});
  });
   
jQuery(document).ready(function($){	
	
	// Get items id you can chose
	function webritiItems(webriti)
	{
		var columns = [];
		$(webriti + ' #enable').each(function(){
			columns.push($(this).sortable('toArray').join(','));
		});
		return columns.join('|');
	}
	
	function webritiItems_disable(webriti)
	{
		var columns = [];
		$(webriti + ' #disable').each(function(){
			columns.push($(this).sortable('toArray').join(','));
		});
		return columns.join('|');
	}
	
	//onclick check id
	$('#enable .ui-state,#disable .ui-state').mouseleave(function(){ 
		var enable = webritiItems('#customize-control-quality_pro_options-layout_manager');
		var disable = webritiItems_disable('#customize-control-quality_pro_options-layout_manager');

		$("#customize-control-quality_pro_options-front_page_data input[type = 'text']").val(enable);
		$("#customize-control-quality_pro_options-layout_textbox_disable input[type = 'text']").val(disable);
		$("#customize-control-quality_pro_options-front_page_data input[type = 'text']").change();		
	});

  });
</script>

    <?php
    }
}

$wp_customize->add_panel( 'quality_layout_setting', array(
		'priority'       => 1000,
		'capability'     => 'edit_theme_options',
		'title'      => __('Theme Layout Manager', 'webriti-companion'),
	) );


$wp_customize->add_section( 'quality_layout_section' , array(
		'title'      => __('Theme Layout Manager', 'webriti-companion'),
		'panel' => 'quality_layout_setting',
   	) );

$wp_customize->add_setting(
    'quality_pro_options[layout_manager]',
    array(
        'default' => '',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type'=>'option'
		
    )	
);
$wp_customize->add_control( new WP_layout_Customize_Control( $wp_customize, 'quality_pro_options[layout_manager]', array(
		'section' => 'quality_layout_section',
		'setting' => 'quality_pro_options[layout_manager]',
    ))
);

$wp_customize->add_setting(
    'quality_pro_options[front_page_data]',
    array(
        'default' =>'service,funfact,portfolio,testimonials,client,blog,team,shop,calloutarea,footerwidget',
		
		'type'=>'option'
    )
	
);
$wp_customize->add_control(
    'quality_pro_options[front_page_data]',
    array(
        'label' => __('Enabled','webriti-companion'),
        'section' => 'quality_layout_section',
        'type' => 'text',
		));
		
	
$wp_customize->add_setting(
    'quality_pro_options[layout_textbox_disable]',
    array(
        'default' => '',
		'type'=>'option'
    )
	
);
$wp_customize->add_control(
    'quality_pro_options[layout_textbox_disable]',
    array(
        'label' => __('Disabled','webriti-companion'),
        'section' => 'quality_layout_section',
        'type' => 'text',
		));	


}
add_action( 'customize_register', 'quality_layout_customizer' );
?>
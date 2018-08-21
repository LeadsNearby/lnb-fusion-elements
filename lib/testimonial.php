<?php

function register_test_element_styles() {
			wp_register_style( 'test-element-styles', plugins_url( 'assets/testimonials-element.css', dirname( __FILE__ ) ), array(), null );
		}
			add_action('wp_enqueue_scripts', 'register_test_element_styles');

 function custom_testimonial_element() {
 
	fusion_builder_map( 
		array(
			'name'       => esc_attr__( 'Custom Testimonials', 'fusion-builder' ),
			'shortcode'  => 'fusion_custom_testimonial',
			'icon'       => 'fusiona-image',
			'preview'    => FUSION_BUILDER_PLUGIN_DIR . 'inc/templates/previews/fusion-image-frame-preview.php',
			'preview_id' => 'fusion-builder-block-module-image-frame-preview-template',
			'params'     => array(
				array(
					'type'        => 'colorpickeralpha',
					'heading'     => esc_attr__( 'Select Stars Background Color', 'fusion-builder' ),
					'param_name'  => 'stars_background_color',
					'value'       => '#000',
				),
				array(
					'type'        => 'colorpickeralpha',
					'heading'     => esc_attr__( 'Select Stars Color', 'fusion-builder' ),
					'param_name'  => 'stars_color',
					'value'       => '#fee300',
				),
				array(
					'type'        => 'colorpickeralpha',
					'heading'     => esc_attr__( 'Select Review Background Color', 'fusion-builder' ),
					'param_name'  => 'reviewbg',
					'value'       => '#fee300',
				),
				array(
					'type'        => 'colorpickeralpha',
					'heading'     => esc_attr__( 'Select Review Text Color', 'fusion-builder' ),
					'param_name'  => 'textbody',
					'value'       => '#000',
				),
				array(
					'type'        => 'colorpickeralpha',
					'heading'     => esc_attr__( 'Select Author Text Color', 'fusion-builder' ),
					'param_name'  => 'authortext',
					'value'       => '#000',
				),
				array(

				  'type'        => 'radio_button_set',
				  'heading'     => esc_attr__( 'Select styles', 'fusion-builder' ),
				  'description' => esc_attr__( 'Generate Button?', 'fusion-builder' ),
				  'param_name'  => 'display_button',
				  'default'     => 'yes',
				  'value'       => array(
				        'yes' => esc_attr__( 'Yes', 'fusion-builder' ),
				        'no'  => esc_attr__( 'No', 'fusion-builder' ),
				   ),

				),
				array(

  					'type'        => 'textfield',
					'heading'     => esc_attr__( 'Name', 'fusion-builder' ),
					'description' => esc_attr__( 'Button Text', 'fusion-builder' ),
					'param_name'  => 'button_text',
					'value'       => 'Button Text',
				),
				array(

  					'type'        => 'link_selector',
  					'heading'     => esc_attr__( 'Link', 'fusion-builder' ),
  					'description' => esc_attr__( 'Link For Button', 'fusion-builder' ),
  					'param_name'  => 'url',
  					'value'       => '',
				),
				array(

  					'type'        => 'textfield',
					'heading'     => esc_attr__( 'Button Width', 'fusion-builder' ),
					'description' => esc_attr__( 'Button Width', 'fusion-builder' ),
					'param_name'  => 'button_width',
					'value'       => '200px',
				),
				array(
					'type'        => 'colorpickeralpha',
					'heading'     => esc_attr__( 'Select Button Color', 'fusion-builder' ),
					'param_name'  => 'button_color',
					'value'       => '#000',
				),
				array(
					'type'        => 'colorpickeralpha',
					'heading'     => esc_attr__( 'Select Button Hover Color', 'fusion-builder' ),
					'param_name'  => 'button_hover_color',
					'value'       => '#000',
				),
				array(
					'type'        => 'colorpickeralpha',
					'heading'     => esc_attr__( 'Select Button Text Color', 'fusion-builder' ),
					'param_name'  => 'button_text_color',
					'value'       => '#fff',
				),
				array(
					'type'        => 'colorpickeralpha',
					'heading'     => esc_attr__( 'Select Button Text Hover Color', 'fusion-builder' ),
					'param_name'  => 'button_text_hover_color',
					'value'       => '#000',
					'default'     => '#000',
				),
				array(

				  'type'        => 'dimension',
				  'heading'     => esc_attr__( 'Set Padding', 'fusion-builder' ),
				  'description' => esc_attr__( 'default is 20px', 'fusion-builder' ),
				  'param_name'  => 'padding',
				  'value'       => array(
				        'padding_top'    => '',
				        'padding_right'  => '',
				        'padding_bottom' => '',
				        'padding_left'   => '',
				   ),

				),
				array(

				  'type'        => 'dimension',
				  'heading'     => esc_attr__( 'Set Margins', 'fusion-builder' ),
				  'description' => esc_attr__( 'default is 20px', 'fusion-builder' ),
				  'param_name'  => 'margin',
				  'value'       => array(
				        'margin_top'    => '',
				        'margin_bottom' => '',
				   ),

				),
			),
		)
	);
}
add_action( 'fusion_builder_before_init', 'custom_testimonial_element' );

function custom_testimonial_shortcode( $atts = [], $content = null ) {
	wp_enqueue_style( 'test-element-styles' );
	ob_start(); 
	
	  echo do_shortcode('[dyn-test-widget background='.$atts['stars_background_color'].' stars='.$atts['stars_color'].' reviewbg='.$atts['reviewbg'].' textbody='.$atts['textbody'].' authortext='.$atts['authortext'].']'); 

	 if ($atts['display_button'] == 'yes') { ?>
	 	<a class="lnbTestimonialsWidget__button" href="<?php echo $atts['url']; ?>" style="--button-width:<?php echo $atts['button_width']; ?>; --padding-top:<?php echo $atts['padding_top'];?>; --padding-right:<?php echo $atts['padding_right'];?>; --padding-bottom:<?php echo $atts['padding_bottom'];?>; --padding-left:<?php echo $atts['padding_left'];?>; --button-color:<?php echo $atts['button_color'];?>; --button-hover-color:<?php echo $atts['button_hover_color'];?>; --button-text-color:<?php echo $atts['button_text_color'];?>; --text-hover:<?php echo $atts['button_text_hover_color'];?>; --margin-top:<?php echo $atts['margin_top'];?>; --margin-bottom:<?php echo $atts['margin_bottom'];?>;"><?php echo $atts['button_text'];?></a>
	 

	<?php } 

	return ob_get_clean();
}

add_shortcode( 'fusion_custom_testimonial', 'custom_testimonial_shortcode' );

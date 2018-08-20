<?php

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
			),
		)
	);
}
add_action( 'fusion_builder_before_init', 'custom_testimonial_element' );

function custom_testimonial_shortcode( $atts = [], $content = null ) {
	
	ob_start(); ?>
	
	 <?php echo do_shortcode('[dyn-test-widget background='.$atts['stars_background_color'].' stars='.$atts['stars_color'].' reviewbg='.$atts['reviewbg'].' textbody='.$atts['textbody'].' authortext='.$atts['authortext'].']'); ?>
	<?php return ob_get_clean();
}

add_shortcode( 'fusion_custom_testimonial', 'custom_testimonial_shortcode' );

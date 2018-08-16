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
					'heading'     => esc_attr__( 'Select Background Color', 'fusion-builder' ),
					'param_name'  => 'background_color',
					'value'       => '#000',
				),
			),
		)
	);
}
add_action( 'fusion_builder_before_init', 'custom_testimonial_element' );

function custom_testimonial_shortcode( $atts = [], $content = null ) {
	
	ob_start(); ?>
	
	 <?php echo do_shortcode('[dyn-test-widget]'); ?>
	<?php return ob_get_clean();
}

add_shortcode( 'fusion_custom_testimonial', 'custom_testimonial_shortcode' );
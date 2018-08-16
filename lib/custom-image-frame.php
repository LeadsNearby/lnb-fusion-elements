<?php

function register_cif_styles() {
			wp_register_style( 'lnb-fusion-custom-image-frame-styles', plugins_url( 'assets/custom-image-frame.css',  dirname(__FILE__  )), array(), null );
		}
add_action ('wp_enqueue_scripts', 'register_cif_styles');

/* CUSTOM IMAGEFRAME */
function custom_fusion_builder_element() {
 
	fusion_builder_map( 
		array(
			'name'       => esc_attr__( 'Custom Image Frame', 'fusion-builder' ),
			'shortcode'  => 'fusion_custom_imageframe',
			'icon'       => 'fusiona-image',
			'preview'    => FUSION_BUILDER_PLUGIN_DIR . 'inc/templates/previews/fusion-image-frame-preview.php',
			'preview_id' => 'fusion-builder-block-module-image-frame-preview-template',
			'params'     => array(
				array(
					'type'        => 'upload',
					'heading'     => esc_attr__( 'Image', 'fusion-builder' ),
					'description' => esc_attr__( 'Upload an image to display.', 'fusion-builder' ),
					'param_name'  => 'element_content',
					'value'       => '',
				),
				array(
					'type'        => 'colorpickeralpha',
					'heading'     => esc_attr__( 'Select Overlay Color', 'fusion-builder' ),
					'param_name'  => 'overlay_color',
					'value'       => 'rgba(78,117,116,.75)',
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_attr__( 'Image ID', 'fusion-builder' ),
					'description' => esc_attr__( 'Image ID from Media Library.', 'fusion-builder' ),
					'param_name'  => 'image_id',
					'value'       => '',
					'hidden'      => true,
				),
				// array(
				// 	'type'        => 'textfield',
				// 	'heading'     => esc_attr__( 'Image Alt Text', 'fusion-builder' ),
				// 	'description' => esc_attr__( 'The alt attribute provides alternative information if an image cannot be viewed.', 'fusion-builder' ),
				// 	'param_name'  => 'alt',
				// 	'value'       => '',
				// ),
				array(
					'type'        => 'radio_button_set',
					'heading'     => esc_attr__( 'CTA Position', 'fusion-builder' ),
					// 'description' => __( '_self = open in same window<br />_blank = open in new window.', 'fusion-builder' ),
					'param_name'  => 'cta_position',
					'value'       => array(
						'left'  => esc_attr__( 'Left', 'fusion-builder' ),
						'right' => esc_attr__( 'Right', 'fusion-builder' ),
					),
					'default'     => 'left',
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_attr__( 'CTA Title', 'fusion-builder' ),
					// 'description' => esc_attr__( 'The alt attribute provides alternative information if an image cannot be viewed.', 'fusion-builder' ),
					'param_name'  => 'cta_title',
					'value'       => '',
				),
				array(
					'type'        => 'textarea',
					'heading'     => esc_attr__( 'CTA Text', 'fusion-builder' ),
					// 'description' => esc_attr__( 'The alt attribute provides alternative information if an image cannot be viewed.', 'fusion-builder' ),
					'param_name'  => 'cta_text',
					'value'       => '',
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_attr__( 'CTA Button Text', 'fusion-builder' ),
					// 'description' => esc_attr__( 'The alt attribute provides alternative information if an image cannot be viewed.', 'fusion-builder' ),
					'param_name'  => 'cta_button_text',
					'value'       => 'Contact Us',
				),
				array(
					'type'        => 'link_selector',
					'heading'     => esc_attr__( 'CTA Button Link', 'fusion-builder' ),
					// 'description' => esc_attr__( 'Add the URL the picture will link to, ex: http://example.com.', 'fusion-builder' ),
					'param_name'  => 'cta_button_link',
					'value'       => '',
				),
				array(

				  'type'        => 'dimension',

				  'heading'     => esc_attr__( 'Set Margin', 'fusion-builder' ),

				  'description' => esc_attr__( 'Default for all fields is 20px.', 'fusion-builder' ),

				  'param_name'  => 'margin',

				  'value'       => array(
						'margin_top'    => '',
						'margin_right'  => '',
						'margin_bottom' => '',
						'margin_left'   => '',
				   ),

				),
			),
		)
	);
}
add_action( 'fusion_builder_before_init', 'custom_fusion_builder_element' );

function custom_fusion_builder_element_shortcode( $atts = [], $content = null ) {
	wp_enqueue_style( 'lnb-fusion-custom-image-frame-styles' );
	ob_start(); ?>
	<div class="lnbImageFrame<?php if($atts['cta_position'] == 'right') echo ' lnbImageFrame--rightOverlay'; ?>" style="background-image:url('<?php echo $content; ?>');--margin-top:<?php echo $atts['margin_top']; ?>;--margin-bottom:<?php echo $atts['margin_bottom']; ?>;--margin-right:<?php echo $atts['margin_right']; ?>;--margin-left:<?php echo $atts['margin_left']; ?>;--overlay-color:<?php echo $atts['overlay_color']; ?>;">
		<div class="lnbImageFrame__content">
			<h3 class="lnbImageFrame__title"><?php echo $atts['cta_title']; ?></h3>
			<p class="lnbImageFrame__text"><?php echo $atts['cta_text']; ?></p>
			<a class="lnbImageFrame__button" href="<?php echo $atts['cta_button_link']; ?>"><span class="lnbImageFrame__buttonText"><?php echo $atts['cta_button_text']; ?></span></a>
		</div>
	</div>
	<?php return ob_get_clean();
}

add_shortcode( 'fusion_custom_imageframe', 'custom_fusion_builder_element_shortcode' );
/* CUSTOM IMAGE FRAME END */
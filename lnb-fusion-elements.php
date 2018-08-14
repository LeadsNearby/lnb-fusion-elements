<?php
/*
Plugin Name: LNB Fusion Elements
Description: Includes custom fusion elements created by LeadsNearby Developers
Version: 1.0
Author: Michael Layao
*/
function register_styles() {
			wp_register_style( 'lnb-fusion-elements-styles', plugins_url( 'assets/lnb-fusion-elements.css',  __FILE__  ), array(), null );
		}
add_action ('wp_enqueue_scripts', 'register_styles');
/* CUSTOM CTA BAR */
function custom_fusion_builder_element() {
 
	fusion_builder_map( 
		array(
			'name'       => esc_attr__( 'Custom CTA Bar', 'fusion-builder' ),
			'shortcode'  => 'fusion_custom_cta',
			'icon'       => 'fusiona-image',
			'preview'    => FUSION_BUILDER_PLUGIN_DIR . 'inc/templates/previews/fusion-image-frame-preview.php',
			'preview_id' => 'fusion-builder-block-module-image-frame-preview-template',
			'params'     => array(
				array(
					'type'        => 'colorpicker',
					'heading'     => esc_attr__( 'Select Background Color', 'fusion-builder' ),
					'param_name'  => 'background_color',
					'value'       => '#000',
				),
				array(
					'type'        => 'colorpicker',
					'heading'     => esc_attr__( 'Select Text Color', 'fusion-builder' ),
					'param_name'  => 'text_color',
					'value'       => '#fff',
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_attr__( 'Left Side Text', 'fusion-builder' ),
					'description' => esc_attr__( 'Text on left side of bar.', 'fusion-builder' ),
					'param_name'  => 'left_text',
					'value'       => '919-758-8420',
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_attr__( 'Right Side Text', 'fusion-builder' ),
					'description' => esc_attr__( 'Text on right side of bar.', 'fusion-builder' ),
					'param_name'  => 'right_text',
					'value'       => 'Insert unique client-based call to action content.',
				),
				array(

				  'type'        => 'dimension',

				  'heading'     => esc_attr__( 'Set Padding', 'fusion-builder' ),

				  'description' => esc_attr__( 'Default for all fields is 20px.', 'fusion-builder' ),

				  'param_name'  => 'padding',

				  'value'       => array(
						'padding_top'    => '',
						'padding_right'  => '',
						'padding_bottom' => '',
						'padding_left'   => '',
				   ),

				)
			),
		)
	);
}
add_action( 'fusion_builder_before_init', 'custom_fusion_builder_element' );

function custom_fusion_builder_element_shortcode( $atts = [], $content = null ) {
	wp_enqueue_style( 'lnb-fusion-elements-styles' );
 /* print_r ($atts['padding_top']); */
	ob_start(); ?>
	
<div class="lnbCustomCTA" style="--background-color:<?php echo $atts['background_color']; ?>; --text-color:<?php echo $atts['text_color']; ?>;--padding-top:<?php echo $atts['padding_top']; ?>;--padding-bottom:<?php echo $atts['padding_bottom']; ?>;--padding-right:<?php echo $atts['padding_right']; ?>;--padding-left:<?php echo $atts['padding_left']; ?>;">
		<div class="lnbCustomCTA__leftTextContainer lnbCustomCTA__textContainer">
			<div class="lnbCustomCTA__leftText lnbCustomCTA__text"><i class="fas fa-mobile-alt"></i><span class="text"><?php echo $atts['left_text']; ?></span></div>
		</div>
	<div class="lnbCustomCTA__rightTextContainer lnbCustomCTA__textContainer">
			<div class="lnbCustomCTA__rightText lnbCustomCTA__text"><?php echo $atts['right_text']; ?></div>
		</div>
	</div>
	<?php return ob_get_clean();
}

add_shortcode( 'fusion_custom_cta', 'custom_fusion_builder_element_shortcode' );
/* CUSTOM CTA BAR END */

require_once( plugin_dir_path( __FILE__ ) . 'inc/updater/github-updater.php' );

if ( is_admin() ) {
    new GitHubPluginUpdater( __FILE__, 'LeadsNearby', 'lnb-fusion-elements');
}


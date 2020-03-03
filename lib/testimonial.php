<?php

function register_test_element_styles() {
    wp_register_style('test-element-styles', plugins_url('assets/testimonials-element.css', dirname(__FILE__)), array(), null);
}
add_action('wp_enqueue_scripts', 'register_test_element_styles');

function custom_testimonial_element() {

    fusion_builder_map(
        array(
            'name' => esc_attr__('Custom Testimonials', 'fusion-builder'),
            'shortcode' => 'fusion_custom_testimonial',
            'icon' => 'fusiona-bubbles',
            'params' => array(
                array(
                    'type' => 'range',
                    'heading' => esc_attr__('Review Count', 'fusion-builder'),
                    'description' => esc_attr__('Select the Number of Reviews That Show in Widget', 'fusion-builder'),
                    'param_name' => 'review_count',
                    'value' => '3',
                    'min' => '1',
                    'max' => '3',
                    'step' => '1',
                ),
                array(
                    'type' => 'radio_button_set',
                    'heading' => esc_attr__('Generate Button?', 'fusion-builder'),
                    'description' => esc_attr__('Generate Button For Main Reviews Page', 'fusion-builder'),
                    'param_name' => 'display_button',
                    'value' => array(
                        'yes' => esc_attr__('Yes', 'fusion-builder'),
                        'no' => esc_attr__('No', 'fusion-builder'),
                    ),
                    'default' => 'no',
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_attr__('Button Text', 'fusion-builder'),
                    'description' => esc_attr__('Text For Button', 'fusion-builder'),
                    'param_name' => 'button_text',
                    'value' => 'Read All Reviews',
                ),
                array(
                    'type' => 'link_selector',
                    'heading' => esc_attr__('Link', 'fusion-builder'),
                    'description' => esc_attr__('Link For Button', 'fusion-builder'),
                    'param_name' => 'url',
                    'value' => '',
                ),
            ),
        )
    );
}
add_action('fusion_builder_before_init', 'custom_testimonial_element');

function custom_testimonial_shortcode($atts = [], $content = null) {
    wp_enqueue_style('test-element-styles');
    ob_start();

    echo do_shortcode("[dyn-test-widget review_count={$atts['review_count']}]");

    if ($atts['display_button'] == 'yes') {?>
	 	<a class="lnbTestimonialsWidget__button" href="<?php echo $atts['url']; ?>"><?php echo $atts['button_text']; ?></a>
	<?php }

    return ob_get_clean();
}

add_shortcode('fusion_custom_testimonial', 'custom_testimonial_shortcode');

<?php
/*
Plugin Name: LeadsNearby Fusion Elements
Description: Includes custom fusion elements created by LeadsNearby Developers
Version: 1.4.1
Author: Michael Layao
 */

require_once plugin_dir_path(__FILE__) . '/lib/testimonial.php';
require_once plugin_dir_path(__FILE__) . '/lib/custom-cta.php';
require_once plugin_dir_path(__FILE__) . '/lib/custom-image-frame.php';
require_once plugin_dir_path(__FILE__) . 'inc/updater/github-updater.php';

if (is_admin()) {
    new GitHubPluginUpdater(__FILE__, 'LeadsNearby', 'lnb-fusion-elements');
}

add_action('fusion_builder_before_init', function () {
    global $all_fusion_builder_elements;
    $params = $all_fusion_builder_elements['fusion_accordion']['params'];
    $faq_option = array(
        'is_faq' => array(
            'heading' => 'This is an FAQ',
            'type' => 'radio_button_set',
            'param_name' => 'is_faq',
            'value' => array(
                'yes' => 'Yes',
                'no' => 'No',
            ),
            'default' => 'no',
            'option_map' => 'select',
        ),
    );
    $all_fusion_builder_elements['fusion_accordion']['params'] = $faq_option + $params;
}, 11);

add_filter('do_shortcode_tag', function ($raw_output, $tag, $attr) {
    if ($tag != 'fusion_accordion') {
        return $raw_output;
    }
    $output = preg_replace("/[\n|\r]/", "", $raw_output);
    preg_match_all('/fusion-toggle-heading">(.*?)<\/span/', $output, $title_matches);
    preg_match_all('/panel-body[a-z,\s,\-]+">(.*?)<\/div/', $output, $content_matches);
    $questions = array();
    foreach ($title_matches[1] as $i => $value) {
        $questions[] = array(
            '@type' => 'Question',
            'name' => $value,
            'acceptedAnswer' => array(
                '@type' => 'Answer',
                'text' => wp_strip_all_tags($content_matches[1][$i]),
            ),
        );
    }
    $json = array(
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => $questions,
    );
    $output .= '<script type="application/ld+json">' . json_encode($json) . '</script>';
    return $output;
}, 11, 3);

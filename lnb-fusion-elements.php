<?php
/*
Plugin Name: LeadsNearby Fusion Elements
Description: Includes custom fusion elements created by LeadsNearby Developers
Version: 1.5.3
Author: LeadsNearby
 */

require_once plugin_dir_path(__FILE__) . '/lib/testimonial.php';
require_once plugin_dir_path(__FILE__) . '/lib/custom-cta.php';
require_once plugin_dir_path(__FILE__) . '/lib/custom-image-frame.php';

add_action('admin_init', function () {
    if (class_exists('\lnb\core\GitHubPluginUpdater')) {
        new \lnb\core\GitHubPluginUpdater(__FILE__, 'lnb-fusion-elements');
    }
}, 99);

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
    $is_faq = $attr['is_faq'];
    if ($is_faq !== 'yes') {
        return $raw_output;
    }
    $output = preg_replace("/[\n|\r]/", "", $raw_output);
    preg_match_all('/fusion-toggle-heading">(.*?)<\//', $output, $title_matches);
    preg_match_all('/panel-body[a-z,\s,\-]+">(.*?)<\/div/', $output, $content_matches);
    $questions = array();
    foreach ($title_matches[1] as $i => $value) {
        $questions[] = array(
            '@type' => 'Question',
            'name' => $value,
            'acceptedAnswer' => array(
                '@type' => 'Answer',
                'text' => strip_tags($content_matches[1][$i], '<h1><h2><h3><h4><br><ol><ul><li><a><p><div><b><strong><i><em>'),
            ),
        );
    }
    $current_questions = get_option('fusion_temp_faqs');
    if (is_array($current_questions)) {
        $new_questions = array_merge($current_questions, $questions);
    } else {
        $new_questions = $questions;
    }
    update_option('fusion_temp_faqs', $new_questions);
    return $output;
}, 11, 3);

add_filter('wp_footer', function () {
    $questions = get_option('fusion_temp_faqs');
    update_option('fusion_temp_faqs', null);
    $json = array(
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => $questions,
    );
    $output = '<script type="application/ld+json">' . json_encode($json) . '</script>';
    echo $output;
}, 10);

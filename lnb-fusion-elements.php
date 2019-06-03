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

<?php

/*
	Plugin Name: Are You Paying Attention Quiz
	Description: Give your readers a multiple choice questions.
	Version: 1.0
	Author: Abed Bashir
*/

if(!defined('ABSPATH')) exit; // Exit if accessed directly

class AreYouPayingAttention {
  function __construct() {
    add_action('init' , array($this , 'adminAssets'));
  }

  function adminAssets() {
    wp_register_style('quizeditcss' , plugin_dir_url(__FILE__) . 'build/index.css');
    wp_register_script('ournewblogtype' , plugin_dir_url(__FILE__) . 'build/index.js' , array('wp-blocks' , 'wp-element' , 'wp-editor'));
    register_block_type('ourplugin/are-you-paying-attention' , array(
      'editor_script' => 'ournewblogtype',
      'editor_style' => 'quizeditcss',
      'render_callback' => array($this , 'theHTML')
    ));
  }

  function theHTML($attrs) {
    ob_start(); ?>
    <!-- WRITE YOUR HTML HERE -->
      <h3>Today the sky is <?php echo esc_html($attrs['skyColor']); ?> and the grass is <?php echo esc_html($attrs['grassColor']); ?>!!!</h3>
    <!-- END OF YOUR HTML -->
    <?php 
      return ob_get_clean();
  }

}

$areYouPayingAttention = new AreYouPayingAttention();
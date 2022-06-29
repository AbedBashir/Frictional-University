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
    add_action('enqueue_block_editor_assets' , array($this , 'adminAssets'));
  }

  function adminAssets() {
    wp_enqueue_script('ournewblogtype' , plugin_dir_url(__FILE__) . 'build/index.js' , array('wp-blocks'));
  }

}

$areYouPayingAttention = new AreYouPayingAttention();
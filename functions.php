<?php
/**
 * TNA forms
 *
 */

function enqueue_form_styles() {
	wp_register_style( 'tna-form-styles', plugin_dir_url(__FILE__) . 'tna-forms.css', array(), '1.0.0'  );
	global $post;
	if (has_shortcode($post->post_content, 'tna-form')) {
		wp_enqueue_style('tna-form-styles');
	}
}
add_action('wp_enqueue_scripts', 'enqueue_form_styles');

function enqueue_form_scripts() {
	wp_register_script( 'tna-form-scripts', plugin_dir_url(__FILE__) . 'js/tna-forms.js', array(), '1.0.0', true  );
	global $post;
	if (has_shortcode($post->post_content, 'tna-form')) {
		wp_enqueue_script('tna-form-scripts');
	}
}
add_action('wp_enqueue_scripts', 'enqueue_form_scripts');




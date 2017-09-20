<?php
/**
 * TNA forms
 *
 */

function enqueue_form_styles() {
	wp_register_style( 'tna-form-styles', plugin_dir_url(__FILE__) . 'css/tna-forms.css', array(), '1.4.1'  );
	global $post;
	if (has_shortcode($post->post_content, 'tna-form') || has_shortcode($post->post_content, 'form-builder')) {
		wp_enqueue_style('tna-form-styles');
	}
}
add_action('wp_enqueue_scripts', 'enqueue_form_styles');

function enqueue_form_scripts() {
	wp_register_script( 'tna-form-scripts', plugin_dir_url(__FILE__) . 'js/compiled/tna-forms-compiled.min.js', array(), '1.0.0', true  );
	wp_register_script( 'jquery-validate', plugin_dir_url(__FILE__) . 'js/jquery.validate.min.js', array(), '1.15.0', true  );
	wp_register_script( 'additional-methods', plugin_dir_url(__FILE__) . 'js/additional-methods.min.js', array(), '1.15.0', true  );

	global $post;
	if (has_shortcode($post->post_content, 'tna-form') || has_shortcode($post->post_content, 'form-builder')) {
		wp_enqueue_script('tna-form-scripts');
		wp_enqueue_script('jquery-validate');
		wp_enqueue_script('additional-methods');
	}
}
add_action('wp_enqueue_scripts', 'enqueue_form_scripts');

if ( !function_exists('wp_mail_set_text_body') ) :
	function wp_mail_set_text_body( $phpmailer ) {
		if ( empty( $phpmailer->AltBody ) ) {
			$phpmailer->AltBody = strip_tags( $phpmailer->Body );
		}
	}
	add_action( 'phpmailer_init', 'wp_mail_set_text_body' );
endif;

add_action( 'add_meta_boxes', 'cf_add_contact_forms_meta_box' );
add_action( 'save_post', 'cf_meta_box_save' );

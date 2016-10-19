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

class TNAvalidation
{
    public function __construct()
    {
        add_action('wp_footer', array($this, 'enqueueAssets'));
    }

    public function enqueueAssets()
    {
        wp_register_script( 'tna-validation-js', plugin_dir_url(__FILE__) . 'js/compiled/tna-forms.min.js', array(), '1.0.0', true  );
        wp_enqueue_script('tna-validation-js');

    }
}

function get_newsletter_form($placehold = "you@example.co.uk"){ ?>
        <form name="signup" id="signup" action="http://r1.wiredemail.net/signup.ashx" method="post" role="form">
            <input type="hidden" name="addressbookid" value="636353">
            <input type="hidden" name="userid" value="173459">
            <input type="hidden" name="ReturnURL" value="http://nationalarchives.gov.uk/news/subscribe-confirmation.htm">
            <label for="Email">Sign up for our newsletter</label>
            <input type="email" name="Email" id="Email" placeholder="<?php echo $placehold ?>" required="required"><input id="newsletterSignUp" type="submit" name="Submit" value="Sign up now" class="margin-left-medium">
        </form>
<?php

    new TNAvalidation;

}


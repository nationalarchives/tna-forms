<?php
/**
 * Created by PhpStorm.
 * User: mdiaconita
 * Date: 22/09/2016
 * Time: 11:18
 */

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

} ?>
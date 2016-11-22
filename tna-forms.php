<?php
/**
 * Plugin Name: TNA Forms validation
 * Plugin URI: https://github.com/nationalarchives/tna-forms
 * Description: The National Archives forms validation Wordpress plugin.
 * Version: 0.1
 * Author: Mihai Diaconita
 * Author URI: https://github.com/nationalarchives
 * License: GPL2
 */

/* Included functions */
include 'functions.php';
include 'tna-forms-builder.php';
include 'tna-forms-functions.php';
include 'tna-forms-validation.php';
include 'tna-forms-shortcode.php';

/* Included forms */
include 'forms/form-newsletter-signup.php';
include 'forms/form-british-citizenship.php';
include 'forms/form-records-research-enquiry.php';
include 'forms/form-contact-us.php';
include 'forms/form-default.php';
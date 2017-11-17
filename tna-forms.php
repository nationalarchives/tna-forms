<?php
/**
 * Plugin Name: TNA Forms validation
 * Plugin URI: https://github.com/nationalarchives/tna-forms
 * Description: The National Archives forms validation Wordpress plugin.
 * Version: 1.5
 * Author: The National Archives
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
include 'forms/form-your-views.php';
include 'forms/form-general.php';
include 'forms/form-public-sector.php';
include 'forms/form-iacs-training.php';
include 'forms/form-apply-to-film.php';
include 'forms/form-pronom.php';
include 'forms/form-document-condition-feedback.php';
include 'forms/form-foi-corporate.php';
include 'forms/form-foi-closed-record.php';
include 'forms/form-archive-update.php';
include 'forms/form-paid-search.php';
include 'forms/form-default.php';
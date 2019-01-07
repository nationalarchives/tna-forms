<?php
/**
 * TNA forms shortcode
 *
 */

function tna_forms_shortcode( $atts, $content = '' ) {

	$a = shortcode_atts( array(
		'name' => 'form',
		'sessions' => '(Training, No session time 1, No session time 2)'
	), $atts );

	switch ( $a['name'] ) {
		case 'British citizenship':
			return return_form_british_citizenship( $content );
			break;
		case 'Records and research enquiry':
			return return_form_rre( $content );
			break;
		case 'Your views':
			return return_form_your_views( $content );
			break;
		case 'General enquiries':
			return return_form_general( $content );
			break;
		case 'Public sector':
			return return_form_public_sector( $content );
			break;
		case 'IA training':
			return return_form_iacs_training( explode(', ', $a['sessions']), $content );
			break;
		case 'Apply to film':
			return return_form_apply_to_film( $content );
			break;
		case 'PRONOM':
			return return_form_pronom( $content );
			break;
		case 'Document condition feedback':
			return return_form_dcf( $content );
			break;
        case 'Archive update':
            return return_form_archive_update ($content);
            break;
        case 'Request a paid search':
            return return_form_paid_search ($content);
            break;
        case 'Request an assessment of a document':
            return return_form_request_assessment_document ($content);
            break;
		case 'Apply for training':
			return return_form_apply_for_training( explode(', ', $a['sessions']), $content );
			break;
        case 'Letters of no evidence':
            return return_form_letters_of_no_evidence ($content);
            break;
		default:
			return return_form_default( $content );
			break;
	}
}

add_shortcode( 'tna-form', 'tna_forms_shortcode' );

function tnafb_shortcode( $atts ) {

	$a = shortcode_atts( array(
		'type' => 'text',
		'name' => 'Full name',
		'error' => '',
		'hint'  => ''
	), $atts );

	$html = new Form_Builder;

	switch ( $a['type'] ) {
		case 'start':
			$id = strtolower( str_replace(' ', '_', $a['name']) );
			$value = strtolower( str_replace(' ', '-', $a['name']) );
			return $html->form_begins( $id, $value ) .
			       $html->fieldset_begins( $a['name'] );
			break;
		case 'end':
			$id = strtolower( str_replace(' ', '_', $a['name']) );
			$name = strtolower( str_replace(' ', '-', $a['name']) );
			return $html->submit_form( $name, $id ) .
			       $html->fieldset_ends() .
			       $html->form_ends();
			break;
		case 'text':
			$id = strtolower( str_replace(' ', '_', $a['name']) );
			$name = strtolower( str_replace(' ', '-', $a['name']) );
			return $html->form_text_input( $a['name'], $id, $name, $a['error'], $a['hint'] );
			break;
		case 'textarea':
			$id = strtolower( str_replace(' ', '_', $a['name']) );
			$name = strtolower( str_replace(' ', '-', $a['name']) );
			return $html->form_textarea_input( $a['name'], $id, $name, $a['error'], $a['hint'] );
			break;
	}
}

add_shortcode( 'form-builder', 'tnafb_shortcode' );

// Function to create a static content panels shortcode
function static_content_panels($atts) {
	// This needs to stay empty. Thank you!
	$pan = '';
	
	$enquiry = '<style>.box {border: 1px solid #ccc;margin: 20px 0px 40px;}.box-height .entry-content {padding: 10px 20px;}.center-text {text-align: center;}.contact-icon {margin: 10px 0 20px;}</style><div class="row"><div class="col-sm-6"><div class="box box-height clearfix"><div class="entry-content center-text"><h3><a href="https://www.nationalarchives.gov.uk/contact-us/make-a-records-and-research-enquiry/make-a-records-and-research-enquiry-form/" title="">Use our enquiry form</a></h3><a href="https://www.nationalarchives.gov.uk/contact-us/make-a-records-and-research-enquiry/make-a-records-and-research-enquiry-form/"><img class="contact-icon" src="./img/form-icon.png" alt="" /></a><p>For more detailed research enquiries</p><p><b>Typical response time via email within 10 working days</b></p></div></div></div></div>';
	$chat = '<style>.box {border: 1px solid #ccc;margin: 20px 0px 40px;}.box-height .entry-content {padding: 10px 20px;}.center-text {text-align: center;}.contact-icon {margin: 10px 0 20px;}</style><div class="row"><div class="col-sm-6"><div class="box box-height clearfix"><div class="entry-content center-text"><h3><a href="#">Chat to an advisor online</a></h3><div id="ciEvtM" class="clearfix"></div><div id="scEvtM" class="contact-icon"></div><div id="sdEvtM"></div><script type="text/javascript">var seEvtM=document.createElement("script");seEvtM.type="text/javascript";var seEvtMs=(location.protocol.indexOf("https")==0?"https":"http")+"://image.providesupport.com/js/0or0ihkh4hylp1qnz87w7c01gr/safe-standard.js?ps_h=EvtM&ps_t="+new Date().getTime();setTimeout("seEvtM.src=seEvtMs;document.getElementById(\"sdEvtM\").appendChild(seEvtM)",1)</script><noscript><a href="http://www.providesupport.com?messenger=0or0ihkh4hylp1qnz87w7c01gr">Live Help Desk</a></noscript><p>For quick pointers</p><p><b>Available from Tuesday to Saturday between 09:00 and 17:00</b></p></div></div></div></div>';
	$both = '<style>.box {border: 1px solid #ccc;margin: 20px 0px 40px;}.box-height .entry-content {padding: 10px 20px;}.center-text {text-align: center;}.contact-icon {margin: 10px 0 20px;}</style><div class="row"><div class="col-sm-6"><div class="box box-height clearfix"><div class="entry-content center-text"><h3><a href="https://www.nationalarchives.gov.uk/contact-us/make-a-records-and-research-enquiry/make-a-records-and-research-enquiry-form/" title="">Use our enquiry form</a></h3><a href="https://www.nationalarchives.gov.uk/contact-us/make-a-records-and-research-enquiry/make-a-records-and-research-enquiry-form/"><img class="contact-icon" src="./img/form-icon.png" alt="" /></a><p>For more detailed research enquiries</p><p><b>Typical response time via email within 10 working days</b></p></div></div></div><div class="col-sm-6"><div class="box box-height clearfix"><div class="entry-content center-text"><h3><a href="#">Chat to an advisor online</a></h3><div id="ciEvtM" class="clearfix"></div><div id="scEvtM" class="contact-icon"></div><div id="sdEvtM"></div><script type="text/javascript">var seEvtM=document.createElement("script");seEvtM.type="text/javascript";var seEvtMs=(location.protocol.indexOf("https")==0?"https":"http")+"://image.providesupport.com/js/0or0ihkh4hylp1qnz87w7c01gr/safe-standard.js?ps_h=EvtM&ps_t="+new Date().getTime();setTimeout("seEvtM.src=seEvtMs;document.getElementById(\"sdEvtM\").appendChild(seEvtM)",1)</script><noscript><a href="http://www.providesupport.com?messenger=0or0ihkh4hylp1qnz87w7c01gr">Live Help Desk</a></noscript><p>For quick pointers</p><p><b>Available from Tuesday to Saturday between 09:00 and 17:00</b></p></div></div></div></div>';
	
	// Define the shortcode parameter and add a default value if the parameter is not present in the shortcode
	$a = shortcode_atts( array(
		'type' => 'both'
	), $atts );
	
	// Check the shortcode parameter and display accordingly
	if(isset($a['type'])){
		if($a['type'] == 'enquiry') {
			$pan = $enquiry;
		} elseif ($a['type'] == 'chat') {
			$pan = $chat;
		} elseif ($a['type'] == 'both') {
			$pan = $both;
		} else {
			$pan = 'The panel does not exists';
		}
	}
	
    return $pan;
}
add_shortcode('tna-panels', 'static_content_panels');

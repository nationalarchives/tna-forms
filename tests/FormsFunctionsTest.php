<?php
/**
 * Tests for tna-forms-function
 */

namespace FormsFunctionsTest;


use FormBuilderTest\FormBuilderTest;

class FormsFunctionsTest extends \PHPUnit_Framework_TestCase {

	public function testSetValue()
	{
		$this->assertTrue(function_exists('set_value'));
	}
	public function testSetValueText()
	{
		$_POST['surname'] = 'Smith';
		$data = set_value( 'surname' );
		$this->assertEquals($data, ' value="Smith" ');
	}
	public function testSetValueTextarea()
	{
		$_POST['enquiry'] = 'What time does the TNA open?';
		$data = set_value( 'enquiry', 'textarea' );
		$this->assertEquals($data, 'What time does the TNA open?');
	}
	public function testSetValueCheckbox()
	{
		$_POST['gender'] = 'female';
		$data = set_value( 'gender', 'radio', 'female' );
		$this->assertEquals($data, ' checked="checked" ');
	}
	public function testSetValueSelect()
	{
		$_POST['country'] = 'Germany';
		$data = set_value( 'country', 'select', 'Germany' );
		$this->assertEquals($data, ' selected="selected" ');
	}
	public function testFieldErrorMessage()
	{
		$this->assertTrue(function_exists('field_error_message'));
	}
	public function testFieldErrorMessageRequired()
	{
		global $tna_error_messages;
		$_POST['tna-form'] = 'form';
		$_POST['surname'] = '';
		$tna_error_messages['Surname'] = 'Please enter your surname';
		$data = field_error_message( 'surname', 'Surname' );
		$this->assertEquals($data, '<span class="form-error form-hint">Please enter your surname</span>');
	}
	public function testFieldErrorMessageReconfirm()
	{
		global $tna_error_messages;
		$_POST['tna-form'] = 'form';
		$_POST['email'] = 'info@domain.com';
		$_POST['confirm-email'] = 'info@domain.net';
		$tna_error_messages['Confirm email'] = 'Please re-type your email address';
		$data = field_error_message( 'confirm-email', 'Confirm email', 'reconfirm', 'email' );
		$this->assertEquals($data, '<span class="form-error form-hint">Please re-type your email address</span>');
	}
	public function testRefNumber()
	{
		$this->assertTrue(function_exists('ref_number'));
	}
	public function testDisplayCompiledFormData()
	{
		$this->assertTrue(function_exists('display_compiled_form_data'));
	}
	public function testDisplayCompiledFormDataOutput()
	{
		$data = display_compiled_form_data( array( 'Name' => 'John Smith') );
		$this->assertEquals($data, '<div class="form-data"><ul><li>Name: John Smith</li></ul></div>');
	}
	public function testDisplayErrorMessage()
	{
		$this->assertTrue(function_exists('display_error_message'));
	}
	public function testDisplayErrorMessageOutput()
	{
		global $tna_error_messages;
		$tna_error_messages['Name'] = 'Please enter your name';
		$tna_error_messages['Email'] = 'Please enter your email address';
		$data = display_error_message( array( 'Name' => false, 'Email' => 'info@domain.com'  ) );
		$this->assertEquals($data, '<div class="emphasis-block error-message" role="alert"><h3>Sorry, there was a problem</h3><p>Please check the highlighted fields to proceed.</p></div>');
	}
	public function testFormToken()
	{
		$this->assertTrue(function_exists('form_token'));
	}
	public function testGetTnaEmail()
	{
		$this->assertTrue(function_exists('get_tna_email'));
	}
	public function testFormNewsletter()
	{
		$this->assertTrue(function_exists('subscribe_to_newsletter_post'));
	}
	public function testConfirmationEmailContent()
	{
		$this->assertTrue(function_exists('confirmation_email_content'));
	}
	public function testReceiptEmailMarkup()
	{
		$this->assertTrue(function_exists('cf_receipt_email_markup'));
	}
	public function testGetTnaEmailMarkup()
	{
		$this->assertTrue(function_exists('cf_get_tna_email_markup'));
	}
	public function testCFMetaBoxSave()
	{
		$this->assertTrue(function_exists('cf_meta_box_save'));
	}
	public function testAddContactFormsMetaBox()
	{
		$this->assertTrue(function_exists('cf_add_contact_forms_meta_box'));
	}
}

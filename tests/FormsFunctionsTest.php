<?php
/**
 * Tests for tna-forms-function
 */

namespace FormsFunctionsTest;


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
		global $error_messages;
		$_POST['surname'] = '';
		$error_messages['surname'] = 'Please enter your surname';
		$data = field_error_message( 'surname' );
		$this->assertEquals($data, '<span class="form-error form-hint">Please enter your surname</span>');
	}
	public function testFieldErrorMessageReconfirm()
	{
		global $error_messages;
		$_POST['email'] = 'info@domain.com';
		$_POST['confirm-email'] = 'info@domain.net';
		$error_messages['confirm-email'] = 'Please re-type your email address';
		$data = field_error_message( 'confirm-email', 'reconfirm', 'email' );
		$this->assertEquals($data, '<span class="form-error form-hint">Please re-type your email address</span>');
	}
	public function testRefNumber()
	{
		$this->assertTrue(function_exists('ref_number'));
	}
	public function testRefNumberOutput()
	{
		$data = ref_number( 'Smith', '1477476797' );
		$this->assertEquals($data, 'TNA1477476797SMI');
	}
	public function testRefNumberOutputShortSurname()
	{
		$data = ref_number( 'Ho', '1477476797' );
		$this->assertEquals($data, 'TNA1477476797HO');
	}
	public function testDisplayRefNumber()
	{
		$this->assertTrue(function_exists('display_ref_number'));
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
		global $error_messages;
		$error_messages['Name'] = 'Please enter your name';
		$error_messages['Email'] = 'Please enter your email address';
		$data = display_error_message( array( 'Name' => false, 'Email' => 'info@domain.com'  ) );
		$this->assertEquals($data, '<div class="emphasis-block error-message"><h3>Error</h3><ul><li>Please enter your name</li></ul></div>');
	}
}

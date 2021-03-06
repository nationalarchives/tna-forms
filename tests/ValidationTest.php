<?php
/**
 * Tests for tna-forms-validation
 */

namespace ValidationTest;


class ValidationTest extends \PHPUnit_Framework_TestCase {

	public function testIsMandatoryTextFieldValid()
	{
		$this->assertTrue(function_exists('is_mandatory_text_field_valid'));
	}
	public function testIsMandatoryTextFieldValidFalse()
	{
		$data = is_mandatory_text_field_valid('');
		$this->assertFalse( $data );
	}
	public function testIsTextFieldValid()
	{
		$this->assertTrue(function_exists('is_text_field_valid'));
	}
	public function testIsTextFieldValidEmpty()
	{
		$data = is_text_field_valid('');
		$this->assertEquals($data, '-');
	}
	public function testIsMandatoryTextareaFieldValid()
	{
		$this->assertTrue(function_exists('is_mandatory_textarea_field_valid'));
	}
	public function testIsMandatoryTextareaFieldValidFalse()
	{
		$data = is_mandatory_textarea_field_valid('');
		$this->assertFalse( $data );
	}
	public function testIsMandatoryEmailFieldValid()
	{
		$this->assertTrue(function_exists('is_mandatory_email_field_valid'));
	}
	public function testIsMandatoryEmailFieldValidFalse()
	{
		$data = is_mandatory_email_field_valid('');
		$this->assertFalse( $data );
	}
	public function testIsEmailFieldValid()
	{
		$this->assertTrue(function_exists('is_email_field_valid'));
	}
	public function testIsEmailFieldValidEmpty()
	{
		$data = is_email_field_valid('');
		$this->assertEquals($data, '-');
	}
	public function testDoesFieldsMatch()
	{
		$this->assertTrue(function_exists('does_fields_match'));
	}
	public function testDoesFieldsMatchFalse()
	{
		$data = does_fields_match('info@domain.com', 'info@domain.net');
		$this->assertFalse( $data );
	}
	public function testDoesFieldsMatchTrue()
	{
		$data = does_fields_match('info@domain.com', 'info@domain.com');
		$this->assertTrue( $data );
	}

	public function testMandatoryEmailFieldIsValidFalse() {
		$data = is_mandatory_email_field_valid('');
		$this->assertFalse($data);
	}

	public function testIsEmailFieldValidLeftEmpty() {
		$data = is_email_field_valid('');
		$this->assertEquals($data, '-');
	}
}

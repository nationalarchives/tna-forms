<?php
/**
 * Tests for tna-forms-builder
 */

namespace FormBuilderTest;


class FormBuilderTest extends \PHPUnit_Framework_TestCase {

	public function testFormBuilder()
	{
		$this->assertTrue( class_exists('Form_Builder') );
	}
	public function testFormBuilderMethodFormBegins()
	{
		$class = new \Form_Builder();
		$this->assertTrue( method_exists($class, 'form_begins') );
	}
	public function testFormBuilderMethodFormEnds()
	{
		$class = new \Form_Builder();
		$this->assertTrue( method_exists($class, 'form_ends') );
	}
	public function testFormBuilderMethodFieldsetBegins()
	{
		$class = new \Form_Builder();
		$this->assertTrue( method_exists($class, 'fieldset_begins') );
	}
	public function testFormBuilderMethodFieldsetEnds()
	{
		$class = new \Form_Builder();
		$this->assertTrue( method_exists($class, 'fieldset_ends') );
	}
	public function testFormBuilderMethodFormTextInput()
	{
		$class = new \Form_Builder();
		$this->assertTrue( method_exists($class, 'form_text_input') );
	}
	public function testFormBuilderMethodFormTextareaInput()
	{
		$class = new \Form_Builder();
		$this->assertTrue( method_exists($class, 'form_textarea_input') );
	}
	public function testFormBuilderMethodFormEmailInput()
	{
		$class = new \Form_Builder();
		$this->assertTrue( method_exists($class, 'form_email_input') );
	}
	public function testFormBuilderMethodFormCheckboxInput()
	{
		$class = new \Form_Builder();
		$this->assertTrue( method_exists($class, 'form_checkbox_input') );
	}
	public function testFormBuilderMethodSubmitForm()
	{
		$class = new \Form_Builder();
		$this->assertTrue( method_exists($class, 'submit_form') );
	}
	public function testFormBuilderMethodHelpText()
	{
		$class = new \Form_Builder();
		$this->assertTrue( method_exists($class, 'help_text') );
	}
	public function testFormBuilderMethodRequiredAtts()
	{
		$class = new \Form_Builder();
		$this->assertTrue( method_exists($class, 'required_atts') );
	}
	public function testFormBuilderMethodIsOptional()
	{
		$class = new \Form_Builder();
		$this->assertTrue( method_exists($class, 'is_optional') );
	}
	public function testFormBuilderMethodHintText()
	{
		$class = new \Form_Builder();
		$this->assertTrue( method_exists($class, 'hint_text') );
	}
	public function testFormBuilderMethodInputErrorMessage()
	{
		$class = new \Form_Builder();
		$this->assertTrue( method_exists($class, 'input_error_message') );
	}
}

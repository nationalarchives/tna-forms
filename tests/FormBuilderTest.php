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
	public function testFormBuilderMethodFormEndsReturns()
	{
		$class = new \Form_Builder();
		$html = $class->form_ends();
		$this->assertEquals($html, '</form>');
	}
	public function testFormBuilderMethodFieldsetBegins()
	{
		$class = new \Form_Builder();
		$this->assertTrue( method_exists($class, 'fieldset_begins') );

	}
	public function testFormBuilderMethodFieldsetBeginsReturns()
	{
		$class = new \Form_Builder();
		$html = $class->fieldset_begins('Legend');
		$this->assertEquals($html, '<fieldset><legend>Legend</legend>');
	}
	public function testFormBuilderMethodFieldsetEnds()
	{
		$class = new \Form_Builder();
		$this->assertTrue( method_exists($class, 'fieldset_ends') );
	}
	public function testFormBuilderMethodFieldsetEndsReturns()
	{
		$class = new \Form_Builder();
		$html = $class->fieldset_ends();
		$this->assertEquals($html, '</fieldset>');
	}
	public function testFormBuilderMethodFormTextInput()
	{
		$class = new \Form_Builder();
		$this->assertTrue( method_exists($class, 'form_text_input') );
	}
	public function testFormBuilderMethodFormTextInputReturns()
	{
		$class = new \Form_Builder();
		$html = $class->form_text_input( 'Label', 'id', 'name', 'Error message', 'Hint text');
		$this->assertEquals($html, '<div class="form-row"><label for="id">Label</label><p class="form-hint">Hint text</p><input type="text" id="id" name="name"  aria-required="true" required ></div>');
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

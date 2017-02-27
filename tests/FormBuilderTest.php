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
	public function testFormBuilderMethodSetGetValueExists(){
		$class = new \Form_Builder();
		$this->assertTrue( method_exists($class, 'set_get_value'));
	}
	public function testFormBuilderMethodSetGetValue()
	{
		$class = new \Form_Builder();
		$_GET['DOCREF'] = 'J 132/103';
		$data_class = $class->set_get_value( 'DOCREF' );
		$this->assertEquals($data_class, ' value="J 132/103" ');
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
	public function testFormBuilderMethodFormTextareaInputReturn()
	{
		$class = new \Form_Builder();
		$html = $class->form_textarea_input( 'Label', 'id', 'name', 'Error message', 'Hint text');
		$this->assertEquals($html, '<div class="form-row"><label for="id">Label</label><p class="form-hint">Hint text</p><textarea id="id" name="name"  aria-required="true" required ></textarea></div>');
	}
	public function testFormBuilderMethodFormEmailInput()
	{
		$class = new \Form_Builder();
		$this->assertTrue( method_exists($class, 'form_email_input') );
	}
	public function testFormBuilderMethodFormEmailInputReturns()
	{
		$class = new \Form_Builder();
		$html = $class->form_email_input( 'Label', 'id', 'name', 'Error message' );
		$this->assertEquals($html, '<div class="form-row"><label for="id">Label</label><input type="email" id="id" name="name"  aria-required="true" required ></div>');
	}
	public function testFormBuilderMethodFormCheckboxInput()
	{
		$class = new \Form_Builder();
		$this->assertTrue( method_exists($class, 'form_checkbox_input') );
	}
	public function testFormBuilderMethodFormCheckboxInputReturns()
	{
		$class = new \Form_Builder();
		$html = $class->form_checkbox_input( 'Label', 'id', 'name' );
		$this->assertEquals($html, '<div class="form-row checkbox"><input type="checkbox" id="id" name="name" value="Yes" ><label for="id">Label</label></div>');
	}
	public function testFormBuilderMethodFormRadioGroup()
	{
		$class = new \Form_Builder();
		$this->assertTrue( method_exists($class, 'form_radio_group') );
	}
	public function testFormBuilderMethodFormRadioGroupReturns()
	{
		$class = new \Form_Builder();
		$html = $class->form_radio_group( 'Title', 'name', array('Email', 'Post') );
		$this->assertEquals($html, '<div class="form-row"><p>Title</p><div class="radio"><input type="radio" id="email" name="name" value="Email" checked><label for="email">Email</label></div><div class="radio"><input type="radio" id="post" name="name" value="Post" ><label for="post">Post</label></div></div>');
	}
	public function testFormBuilderMethodFormSelectInput()
	{
		$class = new \Form_Builder();
		$this->assertTrue( method_exists($class, 'form_select_input') );
	}
	public function testFormBuilderMethodFormSelectInputReturns()
	{
		$class = new \Form_Builder();
		$html = $class->form_select_input( 'Label', 'id', 'name', array( 'one', 'two', 'three' ) );
		$this->assertEquals($html, '<div class="form-row"><label for="id">Label <span class="optional">(optional)</span></label><select id="id" name="name" ><option value="">Please select</option><option value="one" >one</option><option value="two" >two</option><option value="three" >three</option></select></div>');
	}
	public function testFormBuilderMethodSubmitForm()
	{
		$class = new \Form_Builder();
		$this->assertTrue( method_exists($class, 'submit_form') );
	}
	public function testFormBuilderMethodSubmitFormReturns()
	{
		$class = new \Form_Builder();
		$html = $class->submit_form( 'submit', 'submit' );
		$this->assertEquals($html, '<div class="form-row"><input type="submit" name="submit" id="submit" value="Submit"></div>');
	}
	public function testFormBuilderMethodHelpText()
	{
		$class = new \Form_Builder();
		$this->assertTrue( method_exists($class, 'help_text') );
	}
	public function testFormBuilderMethodHelpTextReturns()
	{
		$class = new \Form_Builder();
		$html = $class->help_text( 'Help text' );
		$this->assertEquals($html, '<div class="form-row"><p>Help text</p></div>');
	}
	public function testFormBuilderMethodRequiredAtts()
	{
		$class = new \Form_Builder();
		$this->assertTrue( method_exists($class, 'required_atts') );
	}
	public function testFormBuilderMethodRequiredAttsReturns()
	{
		$class = new \Form_Builder();
		$html = $class->required_atts( 'Error message' );
		$this->assertEquals($html, ' aria-required="true" required ');
	}
	public function testFormBuilderMethodIsOptional()
	{
		$class = new \Form_Builder();
		$this->assertTrue( method_exists($class, 'is_optional') );
	}
	public function testFormBuilderMethodIsOptionalReturns()
	{
		$class = new \Form_Builder();
		$html = $class->is_optional( '' );
		$this->assertEquals($html, ' <span class="optional">(optional)</span>');
	}
	public function testFormBuilderMethodHintText()
	{
		$class = new \Form_Builder();
		$this->assertTrue( method_exists($class, 'hint_text') );
	}
	public function testFormBuilderMethodHintTextReturns()
	{
		$class = new \Form_Builder();
		$html = $class->hint_text( 'Hint text' );
		$this->assertEquals($html, '<p class="form-hint">Hint text</p>');
	}
	public function testFormBuilderMethodInputErrorMessage()
	{
		$class = new \Form_Builder();
		$this->assertTrue( method_exists($class, 'input_error_message') );
	}
	public function testFormBuilderMethodInputErrorMessageReturns()
	{
		$class = new \Form_Builder();
		$_POST['tna-form'] = 'form';
		$_POST['full-name'] = '';
		$html = $class->input_error_message( 'full-name', 'Please enter your full name' );
		$this->assertEquals($html, '<span class="form-error form-hint">Please enter your full name</span>');
	}
	public function testFormBuilderMethodInputErrorMessageMatchReturns()
	{
		$class = new \Form_Builder();
		$_POST['tna-form'] = 'form';
		$_POST['email'] = 'test@test.com';
		$_POST['confirm-email'] = 'test@nomatch.com';
		$html = $class->input_error_message( 'email', 'Please retype your email', 'confirm-email' );
		$this->assertEquals($html, '<span class="form-error form-hint">Please retype your email</span>');
	}
	public function testFormBuilderMethodInputErrorClass()
	{
		$class = new \Form_Builder();
		$this->assertTrue( method_exists($class, 'input_error_class') );
	}
	public function testFormBuilderMethodInputErrorClassReturns()
	{
		$class = new \Form_Builder();
		$_POST['tna-form'] = 'form';
		$_POST['full-name'] = '';
		$html = $class->input_error_class( 'full-name', 'Please enter your full name' );
		$this->assertEquals($html, ' class="form-warning" ');
	}
	public function testFormBuilderMethodNoValidateForTesting()
	{
		$class = new \Form_Builder();
		$this->assertTrue( method_exists($class, 'novalidate_for_testing') );
	}
	public function testFormBuilderMethodNoValidateForTestingReturn()
	{
		$class = new \Form_Builder();
		$html = $class->novalidate_for_testing( true );
		$this->assertEquals($html, 'novalidate');
	}
	public function testFormBuilderMethodNewsletter()
	{
		$class = new \Form_Builder();
		$this->assertTrue( method_exists($class, 'form_newsletter_checkbox') );
	}
}

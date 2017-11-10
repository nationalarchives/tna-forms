<?php
/**
 * Tests for tna-forms-builder
 */

namespace FormProcessorTest;


class FormProcessorTest extends \PHPUnit_Framework_TestCase {

	public function test_Form_Processor()
	{
		$this->assertTrue( class_exists('Form_Processor') );
	}
	public function test_sanitize_value()
	{
		$class = new \Form_Processor();
		$this->assertTrue( method_exists($class, 'sanitize_value') );
	}
}

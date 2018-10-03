<?php
/**
 * Tests for tna-forms-builder
 */

namespace FormProcessorTest;


class FormProcessorTest extends \PHPUnit_Framework_TestCase
{

    public function test_Form_Processor()
    {
        $this->assertTrue(class_exists('Form_Processor'));
    }

    public function test_sanitize_value()
    {
        $class = new \Form_Processor();
        $this->assertTrue(method_exists($class, 'sanitize_value'));
    }

    public function test_display_data()
    {
        $class = new \Form_Processor();
        $this->assertTrue(method_exists($class, 'display_data'));
    }

    public function test_display_data_returns()
    {
        $class = new \Form_Processor();
        $data = array('name' => 'John', 'email' => 'email@email.com');
        $html = $class->display_data($data);
        $this->assertEquals($html, '<div class="form-data"><ul><li>Name: John</li><li>Email: email@email.com</li></ul></div>');
    }

    public function test_get_data()
    {
        $class = new \Form_Processor();
        $this->assertTrue(method_exists($class, 'get_data'));
    }

    public function test_process_data()
    {
        $class = new \Form_Processor();
        $this->assertTrue(method_exists($class, 'process_data'));
    }

    public function test_ref_number()
    {
        $class = new \Form_Processor();
        $this->assertTrue(method_exists($class, 'ref_number'));
    }

    public function test_error_message()
    {
        $class = new \Form_Processor();
        $this->assertTrue(method_exists($class, 'error_message'));
    }

    public function test_message()
    {
        $class = new \Form_Processor();
        $this->assertTrue(method_exists($class, 'message'));
    }

    public function test_message_returns()
    {
        $class = new \Form_Processor();
        $form_name = 'Default';
        $data = array('name' => 'John', 'email' => 'email@email.com');
        $form_content = $class->display_data($data);
        $ref_number = 'TNA01';
        $id = 1;
        $html = $class->message($form_name, $form_content, $ref_number, $id);
        $this->assertEquals($html, '<div class="reference-number emphasis-block success-message"><span>Reference number:</span><h2>TNA01</h2></div><h3>Default</h3><h3>Summary of enquiry</h3><div class="form-data"><ul><li>Name: John</li><li>Email: email@email.com</li></ul></div>');
    }

    public function test_send_email()
    {
        $class = new \Form_Processor();
        $this->assertTrue(method_exists($class, 'send_email'));
    }

    public function test_get_tna_email()
    {
        $class = new \Form_Processor();
        $this->assertTrue(method_exists($class, 'get_tna_email'));
    }

    public function test_log_spam()
    {
        $class = new \Form_Processor();
        $this->assertTrue(method_exists($class, 'log_spam'));
    }

    public function test_display_data_xml_exists()
    {
        $class = new \Form_Processor();
        $this->assertTrue(method_exists($class, 'display_data_xml'));
    }
}

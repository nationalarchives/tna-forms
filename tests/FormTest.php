<?php

require dirname(__DIR__) . '/src/Form.php';

class FormTest extends PHPUnit_Framework_TestCase
{
    public function testConstructorSetsActionURL()
    {
        $actionURL = 'http://www.nationalarchives.gov.uk';
        $contactForm = new TNAContactForms\Form($actionURL);
        $this->assertEquals($contactForm->getActionUrl(), $actionURL);
    }
}


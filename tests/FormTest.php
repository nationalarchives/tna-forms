<?php

class FormTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->actionURL = 'http://www.nationalarchives.gov.uk';
        $this->contactForm = new TNAContactForms\Form($this->actionURL);
    }

    public function testConstructorSetsActionURL()
    {
        $this->assertEquals($this->contactForm->getActionUrl(), $this->actionURL);
    }

    public function testActionInRenderedForm()
    {
        $this->assertEquals($this->contactForm->render(), sprintf('<form action="%s"></form>', $this->actionURL));
    }
    
}


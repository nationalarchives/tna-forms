<?php
/**
 * From Class
 */

namespace TNAContactForms;

class Form
{
    /**
     * @var string representing the URL that will be used for the form action
     */
    private $actionUrl;

    private $template = '<form action="%s"></form>';

    /**
     * @return string
     */
    public function getActionUrl()
    {
        return $this->actionUrl;
    }

    /**
     * @param string $actionUrl
     */
    public function setActionUrl($actionUrl)
    {
        $this->actionUrl = $actionUrl;
    }

    public function render()
    {
        return sprintf($this->template, $this->actionUrl);
    }

    /**
     * Form constructor.
     * @param $actionUrl string representing the URL that will be used for the form action
     */
    public function __construct($actionUrl)
    {
        $this->setActionUrl($actionUrl);
    }
}
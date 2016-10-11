<?php
/**
 * Created by PhpStorm.
 * User: gwynjones
 * Date: 11/10/2016
 * Time: 12:19
 */

namespace TNAContactForms;

class Form
{
    /**
     * @var string representing the URL that will be used for the form action
     */
    private $actionUrl;

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

    /**
     * Form constructor.
     * @param $actionUrl string representing the URL that will be used for the form action
     */
    public function __construct($actionUrl)
    {
        $this->setActionUrl($actionUrl);
    }
}
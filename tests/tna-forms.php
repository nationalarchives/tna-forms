<?php
    class TnaFormsTest extends PHPUnit_Framework_TestCase
    {
        /**
         *  Test if tna-forms tests file exists
         * If deleted a php error will be displayed in debug mode
         */
        public function testIfTnaFormsFileExists()
        {
            $this->assertFileExists('/tests/tna-forms.php');
        }
    }

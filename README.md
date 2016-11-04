[![Build Status](https://travis-ci.org/nationalarchives/tna-forms.svg?branch=master)](https://travis-ci.org/nationalarchives/tna-forms)

# tna-forms
TNA forms Wordpress plugin

## Usage

### Shortcode

Add the shortcode to the desired page to display a form

Check for a certificate of British citizenship form:

```[tna-form name="British citizenship"]```

## Development setup

### 1.0 Clone the repository

Click 'Remote' in SourceTree and you will be shown a full list of repositories you have access to. Then: 

* Create a folder called ```tna-forms``` in the plugins directory of your WordPress installation
* Select the ```tna-forms``` repository in SourceTree and clone it to your newly created 'tna-forms' directory

### 2.0 Create a new project in PhpStorm

* Select 'Create New Project from Existing Files' 
* Select 'Web server is installed locally, source files are located under its document root' 
* Browse to the newly cloned files' directory and set as 'Project Root'
* Specify parameters for the server as your Wordpress installation

### 3.0 Running Grunt

Assuming that the Grunt CLI has been installed follow the instructions on the [Grunt website] (http://gruntjs.com/getting-started#working-with-an-existing-grunt-project).

### 4.0 Composer dependency management

Composer is used for dependency management, initially for PHPUnit but extending to other dependencies as needed. 

#### 4.1 Installing Composer

To install Composer, from within the ```tna-forms``` directory open the Terminal and execute this command: 

```curl -sS https://getcomposer.org/installer | php```

This downloads the Composer installer script with ```curl``` and executes it with PHP, resulting in a ```composer.phar``` file (the Composer binary) being placed in the current working directory. 

Having done this follow these steps:

* Type ```sudo mv composer.phar /usr/local/bin/composer``` into the Terminal
* Append this line to your ```~/.bash_profile``` file ```PATH=/usr/local/bin:$PATH```

At this stage you should be able to execute the ```composer``` command in the Terminal to see all the available options.

#### 4.2 Obtaining dependencies via Composer

Having followed the steps above you will be able to install dependencies by typing ```composer install``` at the Terminal.

### 5.0 PHPUnit

Having followed the steps under 'Installing Composer' type ```vendor/bin/phpunit -c phpunit.xml``` from within the ```tna-forms``` directory to run Unit Tests for the project.

Note: PhpStorm allows for PHPUnit integration - allowing your tests to be run automatically. Search the JetBrains website to find out how to configure this.

### 6.0 QUnit

Any JavaScript written for this theme should be unit tested with QUnit. See the ```js/tests/example``` directory for an example QUnit test and fixture.
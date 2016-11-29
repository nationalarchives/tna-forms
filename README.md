[![Build Status](https://travis-ci.org/nationalarchives/tna-forms.svg?branch=master)](https://travis-ci.org/nationalarchives/tna-forms)

# tna-forms
TNA forms Wordpress plugin

## Usage

### Shortcode

Add the shortcode to the desired page to display a form

**Check for a certificate of British citizenship** form:

`[tna-form name="British citizenship"]`

**Records and research enquiry** form:

`[tna-form name="Records and research enquiry"]`

**Your views** form:

`[tna-form name="Your views"]`

**General enquiries** form:

`[tna-form name="General enquiries"]`

**Public sector information enquiry** form:

`[tna-form name="Public sector"]`

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

## Form Builder

This form builder is a simple object-oriented PHP framework developed for TNA's HTML forms.

* Consistent and rapid development of HTML forms
* Reduces repetition of writing HTML
* Reduces human error via unit tests

Below you'll find a sample enquiry form.

Code sample

```php
<?php
$html = new Form_Builder;
return  $html->form_begins( 'enquiry-form', 'enquiry-form' ) .
        $html->fieldset_begins( 'Your enquiry' ) .
        $html->form_text_input( 'Full name', 'full_name', 'full-name' ) .
        $html->form_email_input( 'Email address', 'email', 'email', 'Please provide your email address' ) .
        $html->form_textarea_input( 'Your enquiry', 'enquiry', 'enquiry' ) .
        $html->submit_form( 'submit', 'submit' ) .
        $html->fieldset_ends() .
        $html->form_ends();
```

And this is the HTML it will return:

```html
<form action="" id="enquiry-form" method="POST">
    <input type="hidden" name="tna-form" value="enquiry-form">
    <input type="hidden" name="token" value="e19c9f1992ebaaf63d4b6bc9fafa624f">
    <fieldset>
        <legend>Your enquiry</legend>
        <div class="form-row">
            <label for="full_name">Full name <span class="optional">(optional)</span></label>
            <input type="text" id="full_name" name="full-name">
        </div>
        <div class="form-row">
            <label for="email">Email address</label>
            <input type="email" id="email" name="email" aria-required="true" required>
        </div>
        <div class="form-row">
            <label for="enquiry">Your enquiry</label>
            <textarea id="enquiry" name="enquiry" aria-required="true" required></textarea>
        </div>
        <div class="form-row">
            <input type="submit" name="submit" id="submit" value="Submit">
        </div>
    </fieldset>
</form>
```

### Usage

#### `form_begins( $id, $value, $no_validate = false )`

* `$id` Required - Form ID
* `$value` Required - Hidden input form common identifier
* `$no_validate` Optional, boolean - adds novalidate attribute for testing purposes

Example

```php
<?php
$html = new Form_Builder;
return $html->form_begins( 'my-form-id', 'my-new-form' )
```

Returns

```html
<form action="" id="my-form-id" method="POST">
    <input type="hidden" name="tna-form" value="my-new-form">
    <input type="hidden" name="token" value="cec38fc30d24fb4ed9bcedee66de2c83">
```

#### `form_ends()`

* Outputs closing form tag

Example

```php
<?php
$html = new Form_Builder;
return $html->form_ends()
```

Returns

```html
</form>
```

#### `fieldset_begins( $legend )`

* `$legend` Required - Fieldset legend title

Example

```php
<?php
$html = new Form_Builder;
return $html->fieldset_begins('Your details')
```

Returns

```html
<fieldset>
    <legend>Your details</legend>
```

#### `fieldset_ends()`

* Outputs closing fieldset tag

Example

```php
<?php
$html = new Form_Builder;
return $html->fieldset_ends()
```

Returns

```html
</fieldset>
```

#### `form_text_input( $label, $id, $name, $error = '', $hint = '' )`

* `$label` Required - Input label
* `$id` Required - Input ID
* `$name` Required - Input name
* `$error` Optional - Input error message
* `$hint` Optional - Input hint text

Example

```php
<?php
$html = new Form_Builder;
return $html->form_text_input('Full name', 'full_name', 'full-name', 'Please enter your full name', 'First and last name')
```

Returns

```html
<div class="form-row">
    <label for="full_name">Full name</label>
    <p class="form-hint">First and last name</p>
    <input type="text" id="full_name" name="full-name" aria-required="true" required>
</div>
```

#### `form_textarea_input( $label, $id, $name, $error = '', $hint = '' )`

* `$label` Required - Input label
* `$id` Required - Input ID
* `$name` Required - Input name
* `$error` Optional - Input error message
* `$hint` Optional - Input hint text

Example

```php
<?php
$html = new Form_Builder;
return $html->form_textarea_input('Your enquiry', 'enquiry', 'enquiry', 'Please enter your enquiry', 'Please provide specific details of the information you are looking for')
```

Returns

```html
<div class="form-row">
    <label for="enquiry">Your enquiry</label>
    <p class="form-hint">Please provide specific details of the information you are looking for</p>
    <textarea id="enquiry" name="enquiry" aria-required="true" required></textarea>
</div>
```

#### `form_email_input( $label, $id, $name, $error = '', $match = '' )`

* `$label` Required - Input label
* `$id` Required - Input ID
* `$name` Required - Input name
* `$error` Optional - Input error message
* `$match` Optional - Input name of another input to match exactly

Example

```php
<?php
$html = new Form_Builder;
return $html->form_email_input('Email address', 'email', 'email', 'Please enter your email address')
```

Returns

```html
<div class="form-row">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" aria-required="true" required>
</div>
```

#### `form_checkbox_input( $label, $id, $name, $error = '' )`

* `$label` Required - Checkbox label
* `$id` Required - Checkbox ID
* `$name` Required - Checkbox name
* `$error` Optional - Checkbox error message

Example

```php
<?php
$html = new Form_Builder;
return $html->form_checkbox_input('Tick here if you would like to receive our newsletter', 'newsletter', 'newsletter')
```

Returns

```html
<div class="form-row checkbox">
    <input type="checkbox" id="newsletter" name="newsletter" value="Yes">
    <label for="newsletter">Tick here if you would like to receive our newsletter</label>
</div>
```

#### `form_radio_group( $title, $name, $radios = array() )`

* `$title` Optional - Radio group heading
* `$name` Required - Radio group name
* `$radios` Required - Radio elements

Example

```php
<?php
$html = new Form_Builder;
return $html->form_radio_group('How would you like to be contacted?', 'contact', arrry('Email', 'Post'))
```

Returns

```html
<div class="form-row">
    <p>How would you like to be contacted?</p>
    <div class="radio">
        <input type="radio" id="email" name="contact" value="Email" checked>
        <label for="email">Email</label>
    </div>
    <div class="radio">
        <input type="radio" id="post" name="contact" value="Post">
        <label for="post">Post</label>
    </div>
</div>
```

#### `form_select_input( $label, $id, $name, $options = array(), $error = '', $hint = '' )`

* `$label` Required - Select label
* `$id` Required - Select ID
* `$name` Required - Select name
* `$options` Required - Select options in an array
* `$error` Optional - Select error message
* `$hint` Optional - Select hint text

Example

```php
<?php
$html = new Form_Builder;
return $html->form_select_input('Reason for contact', 'reason', 'reason', array('Compliment', 'Suggestion', 'Criticism', 'Complaint'))
```

Returns

```html
<div class="form-row">
    <label for="reason">Reason for contact</label>
    <select id="reason" name="reason">
        <option value="">Please select</option>
        <option value="Compliment">Compliment</option>
        <option value="Suggestion">Suggestion</option>
        <option value="Criticism">Criticism</option>
        <option value="Complaint">Complaint</option>
    </select>
</div>
```

#### `submit_form( $name, $id, $value = 'Submit' )`

* `$name` Required - Input name
* `$id` Required - Input ID
* `$value` Optional - Input value

Example

```php
<?php
$html = new Form_Builder;
return $html->submit_form('submit', 'submit')
```

Returns

```html
<div class="form-row">
    <input type="submit" name="submit" id="submit" value="Submit">
</div>
```

#### `help_text( $text )`

* `$text` Required - Help text or instructions

Example

```php
<?php
$html = new Form_Builder;
return $html->help_text('Please enter an order number or Catalogue reference if either are relevant to this message.')
```

Returns

```html
<div class="form-row">
    <p>Please enter an order number or Catalogue reference if either are relevant to this message.</p>
</div>
```

## Client-Side validation
Jquery Validation plugin is used to validate all the contact forms.

### How to add client-side validation

Template checklist available inside form-default.js's header (js/forms/).

### Error representation

Inside validate() function, error element used to represent the error is a ```html <span>``` tag, followed by .form-error and .form-hint classes.

Example

```javascript
   errorElement: 'span',
   errorClass: 'form-error form-hint',
```

Return

```html
<span id="certificate_name-error" class="form-error form-hint">
    Please enter the certificate holder’s name(s)
</span>
```

### Methods

Custom methods to handle some extra user validation.

Example

* 1. White space method
* Checking for white space at the beginning of each input

``` javascript
    $.validator.addMethod("noSpace",
        function(value, element) {
            // allow any non-whitespace characters as the host part
        return this.optional( element ) || /(?=\S)/.test( value );
    }, 'Please complete the field'); // Global message if there's only white space for required fields
```

Return

```html
    <span id="certificate_name-error" class="form-error form-hint">
        Please complete the field
    </span>
```

Example

* 2. Advance email validation method
* Checking for white space at the beginning of each input

``` javascript
    $.validator.addMethod("advEmail",
        function(value, element) {
            return this.optional( element ) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
        },
        "Please insert a valid email address"
    );
```

Return

```html
   <span id="confirm_email-error" class="form-error form-hint">
        Please enter a valid email address.
   </span>
```

Example

* 3. Exact length method
* Checking for white space at the beginning of each input

``` javascript
     $.validator.addMethod(
            "exactLength",
        function(value, element, parameter) {
            return this.optional(element) || value.length === parameter;
     });
```

Return

```html
   <span id="inputGroup-error" class="form-error form-hint">
        Please enter a valid date
   </span>
```

### Rules

Field rules example using the custom methods.

Example

```javascript
     "full-name": {
        required: true,
        noSpace: true
     },
      email: {
         required: true,
         email:true,
         advEmail:true
     },
     "confirm-email": {
         equalTo: "#email"
     },
     "certificate-year":{
         digits:true,
         exactLength:4
     },
```

### Messages

Example

```javascript
    messages: {
        "full-name": {
            required: "Please enter your full name"
        },
        email: "Please enter your email address",
            "confirm-email": {
                required:"Please enter your email address",
                equalTo: "Please enter your email address again"
            },
        "certificate-year":{
            required: "Year",
            digits: "Only digits",
            exactLength:"Please enter a valid date"
        },
    }
```

## Credits

### Jquery

Website URL: https://jquery.com/

### Jquery validation

Website URL: https://jqueryvalidation.org/

### PHP-unit
Website URL: https://phpunit.de/





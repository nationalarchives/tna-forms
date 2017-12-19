/**
 * THE NATIONAL ARCHIVES
 * ------------------------------------------------------------------------------
 * Form JQuery validation for HTML
 * ------------------------------------------------------------------------------
 */

(function ($) {

    $.fn.newsletterValidation = function () {

        if ($.html5ValidationAvailable() === false) {
            return;
        }

        return this.each(function () {

            var $this = $(this),
                $email = $this.find('input[type=email]'),
                $submit = $this.find('input[type=submit]');

            $.manageState($email, $submit);

            $email.on('keyup change', function () {
                $.manageState($(this), $submit);
            });
        });
    };

    $.html5ValidationAvailable = function () {
        return (typeof document.createElement('input').checkValidity == 'function');
    };

    $.isEmail = function (str) {
        return (/^[\w.%+\-]+@[\w.\-]+\.[A-Za-z]{2,6}$/.test(str));
    };

    $.manageState = function ($email, $submit) {
        $submit.prop('disabled', !$.isEmail($email.val()));
    };

}(jQuery));function formMethods(){
    /** Exact length method
     * 5.1 Is checking for exact length on dob fields
     * */
    $.validator.addMethod(
        "exactLength",
        function(value, element, parameter) {
            return this.optional(element) || value.length === parameter;
        });

    /** White space method
     * 5.2 Is checking for white space at the beginning of fields
     * */

    $.validator.addMethod("noSpace",
        function(value, element) {
            // allow any non-whitespace characters as the host part
            return this.optional( element ) || /(?=\S)/.test( value );
        }, 'Please complete the field'); // Global message if there's only white space for required fields


    /** Custom email message
     * */
    $.extend($.validator.messages, {
        email: "Please enter a valid email address"
    });

    /**
     * Custom regex for email validation
     * */
    $.validator.addMethod("emailCustom", function(value, element) {
        return this.optional(element) || /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);
    }, "Please enter a valid email address");

    $.validator.addMethod("telNumber", function(value, element) {
        return this.optional(element) || /(\d)\w+/i.test(value);
    }, "Please enter a valid telephone number");


    /*$.validator.addMethod("sessions_val_not_equal", function(value, element) {

        firstSession = $('#session_first_choice').val();
        secondSession = $('#session_second_choice').val();

        return firstSession !== secondSession

    }, "* Session choice should not match");*/

}

;/**
 * @contact-form-name: Naturalisation Form Validation
 *
 * ----- Table of contents ------------------------------------------------------------------------------------------
 *
 * 1. Define variables
 * 2. If JS is enabled hide all sections
 * 3. It will not submit the form unless the user reaches last section
 * 4. If JS is enabled show continue buttons
 * 5. Form validation
 * 6. Show / hide Email / address
 * 7. Back button on step two
 * 8. Back button on step three
 * */


function naturalisationForm(){
    /**
     * 1. Define variables
     * */
    var emailWrapper= '.email-wrapper',
        addressWrapper = '.address-wrapper',
        contactEmail = '#contact_email',
        contactPostal = '#contact_postal',
        formStepOne = '.form-step-1',
        formStepTwo = '.form-step-2',
        formStepThree = '.form-step-3',
        button = '.button',
        buttonBack = '.button-back',
        radio = 'input[type="radio"]',
        submit = 'input[type="submit"]',
        certificateYear = 'certificate-year',
        certificateMonth = 'certificate-month',
        certificateDay = 'certificate-day',
        groupErrorPlacement = '#groupErrorPlacement',
        preferredContact = 'preferred-contact',
        formName = "#naturalisation";

    /**
     * 2. If JS is enabled hide all sections
     * */
    $(emailWrapper).hide();
    $(addressWrapper).hide();
    $(formStepTwo).hide();
    $(formStepThree).hide();

    /**
     * 4. If JS is enabled show continue buttons and progress bar
     * */
    $(button,'.form-step-1,.form-step-2').css("display","block");
    $(buttonBack,'.form-step-2,.form-step-3').css("display","block");
    $('.arrow-steps').css("display","block");

    History.pushState({state:1},'Certificate holder\'s details', '#step-1');

    // History JS
    $(window).on('popstate', function() {
        if(window.location.hash == "#step-2"){
            $(formStepTwo).show();
            $(formStepThree).hide();
            $(formStepOne).hide();
            $('.arrow-steps li:nth-child(2)').addClass("current");
            $('.arrow-steps li:nth-child(1)').addClass("current");
            $('.arrow-steps li:nth-child(3)').removeClass("current");

        } else if(window.location.hash == "#step-3"){
            $(formStepThree).show();
            $(formStepTwo).hide();
            $(formStepOne).hide();
            $('.arrow-steps li:nth-child(3)').addClass("current");

        } else if (window.location.hash == "#step-1") {
            $(formStepOne).show();
            $(formStepTwo).hide();
            $(formStepThree).hide();
            $('.arrow-steps li:nth-child(1)').addClass("current");
            $('.arrow-steps li:nth-child(2)').removeClass("current");
            $('.arrow-steps li:nth-child(3)').removeClass("current");

        }

    });


    /**
     * DOB validation
     * */

    $('.dob-col').wrapAll('<div id="groupErrorPlacement"></div>');
    $('.pref_contact').wrapAll('<div id="groupErrorPlacement"></div>');



    $(submit, formName).prop('disabled', true);


    /**
     * 5. Form validation
     * */
    $(".button,input[name='submit-bc']").on('click',function(){
        var form = $(formName);
        /**
         * Included custom form validation methods from methods.js
         * */
        formMethods();


        form.validate({
            errorElement: 'span',
            errorClass: 'form-error form-hint',
            errorPlacement: function (error, element) {

                if (element.attr('name') === certificateYear) {
                    error.insertAfter(groupErrorPlacement);
                }
                    else if (element.attr('name') === certificateMonth) {
                    error.insertAfter(groupErrorPlacement);
                }
                    else if (element.attr('name') === certificateDay) {
                    error.insertAfter(groupErrorPlacement);
                }
                     else {
                    error.insertAfter(element);
                }
            },
            highlight: function(element, errorClass, validClass) {
                $(element).closest('input[type="text"]').addClass("form-warning");
                $(element).closest('input[type="email"]').addClass("form-warning");
                $(element).closest('input[type="number"]').addClass("form-warning");
                $(element).closest('textarea').addClass("form-warning");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).closest('input[type="text"]').removeClass("form-warning");
                $(element).closest('input[type="email"]').removeClass("form-warning");
                $(element).closest('input[type="number"]').removeClass("form-warning");
                $(element).closest('textarea').removeClass("form-warning");
            },
            rules: {
                /* Form Step One */
                "certificate-day":{
                    digits:true,
                    range: [1, 31]

                },
                "certificate-month":{
                    digits:true,
                    range: [1, 12]
                },
                "certificate-year":{
                    digits:true,
                    exactLength:4
                },
                forename: {
                    required: true,
                    noSpace: true
                },
                surname: {
                    required: true,
                    noSpace:true
                },
                preferred_contact: {
                    required:true,
                    noSpace: true
                },
                email: {
                    required: true,
                    email:true
                },
                "confirm-email": {
                    equalTo: "#email"
                },

                "postal-address":{
                    required:true,
                    noSpace: true
                },

                /* Form Step Two */
                "certificate-name":{
                    required:true,
                    noSpace:true
                },

                /* Form Step Three */
                "full-name": {
                    required: true,
                    noSpace: true
                },
                contact_email:{
                    required: function(element) {
                        return $("#contact-postal:checked").length <= 0;
                    }
                },
                "preferred-contact":{
                    required: function(element) {
                        return $("#contact-email:checked").length <= 0;
                    }
                }

            },
            messages: {
                "certificate-day":{
                    required: "Day",
                    digits: "Only digits",
                    range:"Please enter a valid date"
                },
                "certificate-month":{
                    required: "Month",
                    digits: "Only digits",
                    range: "Please enter a valid date"

                },
                "certificate-year":{
                    required: "Year",
                    digits: "Only digits",
                    exactLength:"Please enter a valid date"
                },
                forename: {
                    required: "Please enter your first name"
                },
                surname: {
                    required: "Please enter your last name"
                },
                email: "Please enter your email address",
                "confirm-email": {
                    required:"Please enter your email address",
                    equalTo: "Please enter your email address again"
                },
                "postal-address":{
                    required:"Please enter your postal address"
                },
                /* Form Step Two */
                "certificate-name":{
                    required:"Please enter the certificate holder’s name(s)"
                },
                /* Form Step Three */
                "full-name": {
                    required: "Please enter your full name"
                },
                "preferred-contact":{
                    required: "Please select one option"
                }
            },
            groups: {
                inputGroup: "certificate-day certificate-month certificate-year",
            }
        });

        /**
         * 5.3 If form is valid do following things
         * */
        if (form.valid() === true){

            $('.emphasis-block.error-message').hide();

            /**
             * 5.3.1 If form step 1 is visible
             * */
            if ($(formStepOne).is(":visible")){
                current_fs = $(formStepOne);
                next_fs = $(formStepTwo);

                /* Show progress bar */
                $('.arrow-steps li:nth-child(2)').addClass("current");
                $("html, body").animate({ scrollTop: 0 }, "slow");
                History.pushState({state:2},'Certificate details (optional)', '#step-2');

                $(submit).prop('disabled', true);

            }
            /**
             * 5.3.2 If form step 2 is visible
             * */
            else if($(formStepTwo).is(":visible")) {
                current_fs = $(formStepTwo);
                next_fs = $(formStepThree);

                /* Show progress bar */
                $('.arrow-steps li:nth-child(3)').addClass("current");
                $(submit, formName).prop('disabled', false);
                $("html, body").animate({ scrollTop: 0 }, "slow");
                History.pushState({state:3},'Contact details', '#step-3');

            }

            next_fs.show();
            current_fs.hide();

        } else {
            // Scroll back to top
            $("html, body").animate({ scrollTop: 0 }, "slow");
            if ($('.form-error').is(':visible')) {
                var emphAlert = ($('.emphasis-block.error-message').length === 1);
                if(emphAlert) {
                    $('.emphasis-block.error-message').show();
                } else {
                    $('.arrow-steps').before().prepend('<div class="emphasis-block error-message" role="alert"><p class="h3">Sorry, there was a problem</p><p>Please check the highlighted fields to proceed.</p></div>');
                }
            }
        }
    });

    /**
     * 6. Show / hide Email / address
     * */
    $(radio).on('click', function(){
        if ($(contactEmail).is(':checked')){
            $(emailWrapper).show();
            $(addressWrapper).hide();


        } else if ($(contactPostal).is(':checked')) {
            $(addressWrapper).show();
            $(emailWrapper).hide();

        }
    });

    /**
     * 7. Back button on step two
     * */
    $(buttonBack, formStepTwo).on('click', function(e) {
        e.preventDefault();
        $(formStepOne).show();
        $(formStepTwo).hide();
        $('.arrow-steps li:nth-child(2)').removeClass("current");
        $('.arrow-steps li:nth-child(3)').removeClass("current");
        History.pushState({state:1},'Certificate holder\'s details', '#step-1');
    });

    /**
     * 8. Back button on step three
     * */
    $(buttonBack, formStepThree).on('click', function(e) {
        e.preventDefault();
        $(formStepTwo).show();
        $(formStepThree).hide();
        $('.arrow-steps li:nth-child(3)').removeClass("current");

        History.pushState({state:2},'Certificate details (optional)', '#step-2');
    });
};;/**
 * @contact-form-name: Default form
 *
 * ----- Table of contents -------------------------------------
 *
 * 1. Define variables
 * 2. Include custom form methods from methods.js
 * 3. Add the validation rules
 * */

/**
 * Template checklist
 * --- Before creating a new form please make sure the the form was generated using the OOP PHP ---
 *
 * 1. Copy/Paste default.js and change the name to the new form
 * 2. Include new form js file in Gruntfile.js under Concat plugin before tna-call-plugin.js
 * 3. Change the function name to match the new form name e.g. generalForm() etc
 * 4. Grab/Copy the ID of the form generated by the OOP
 * 5. Include the new function name inside the tna-call-plugin under else if(THE NEW ID).is(':visible') statement
 * 6. Change the default form ID from #default to match the actual <form> ID generated in OOP
 * 7. Add/Remove rules/messages to match the new form's fields by using their ID or name attribute
 * */

function defaultForm(){
    /**
     * 1. Declare variables
     * */
    var formName = "#default";
    var form = $(formName);

    /**
     * 2. Included custom form validation methods from methods.js
     * */
    formMethods();

    /**
     * 3. Add the validation rules
     * */
    form.validate({
        errorElement: 'span',
        errorClass: 'form-error form-hint',
        highlight: function(element, errorClass, validClass) {
            $(element).closest('input[type="text"]').addClass("form-warning");
            $(element).closest('input[type="email"]').addClass("form-warning");
            $(element).closest('textarea').addClass("form-warning");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('input[type="text"]').removeClass("form-warning");
            $(element).closest('input[type="email"]').removeClass("form-warning");
            $(element).closest('textarea').removeClass("form-warning");
        },
        rules: {
            "full-name-required": {
                required: true,
                noSpace: true
            },
            "email-required": {
                required: true,
                email:true
            },
            "confirm-email-required": {
                equalTo: "#email"
            },
            "country-required":{
                required:true,
                noSpace:true
            },
            "enquiry-required":{
                required:true,
                noSpace:true
            }

        },
        /**
         * Error messages
         * */
        messages: {
            "full-name-required": {
                required: "Please enter your full name"
            },
            "email-required": "Please enter your email address",
            "confirm-email-required": {
                required:"Please enter your email address",
                equalTo: "Please enter your email address again"
            },
            "country-required":{
                required:"Please enter your country"
            },
            "enquiry-required":{
                required:"Please enter your enquiry"
            }
        }
    });

    $("input[name='submit-default']").on('click', function(){
        var emphAlert = ($('.emphasis-block.error-message').length === 1);
        if(form.valid() !== true) {
            if(emphAlert) {
                $('.emphasis-block.error-message').show();
            } else {
                $(form).before().prepend('<div class="emphasis-block error-message" role="alert"><p class="h3">Sorry, there was a problem</p><p>Please check the highlighted fields to proceed.</p></div>');
            }
        }
    });
};/**
 * @contact-form-name: Records Research Enquiry form
 *
 * ----- Table of contents -------------------------------------
 *
 * 1. Define variables
 * 2. Include custom form methods from methods.js
 * 3. Add the validation rules
 *
 * */

function recordsResearchEnquiryForm(){
    /**
     * 1. Declare variables
     * */
    var formName = "#records-research-enquiry";
    var form = $(formName);

    /**
     * 2. Included custom form validation methods from methods.js
     * */
    formMethods();

    /**
     * 3. Add the validation rules
     * */
    form.validate({
        errorElement: 'span',
        errorClass: 'form-error form-hint',
        highlight: function(element, errorClass, validClass) {
            $(element).closest('input[type="text"]').addClass("form-warning");
            $(element).closest('input[type="email"]').addClass("form-warning");
            $(element).closest('textarea').addClass("form-warning");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('input[type="text"]').removeClass("form-warning");
            $(element).closest('input[type="email"]').removeClass("form-warning");
            $(element).closest('textarea').removeClass("form-warning");
        },
        rules: {
            "full-name-required":{
                required:true,
                noSpace:true
            },
            "email-required": {
                required: true,
                email:true
            },
            "confirm-email-required": {
                equalTo: "#email"
            },
            "enquiry-required":{
                required:true,
                noSpace:true
            }

        },
        /**
         * Error messages
         * */
        messages: {
            "full-name-required":{
                required:"Please insert your full name"
            },
            "email-required": "Please enter your email address",
            "confirm-email-required": {
                required:"Please enter your email address",
                equalTo: "Please enter your email address again"
            },
            "enquiry-required":{
                required:"Please enter your enquiry"
            }
        }
    });

    $("input[name='submit-rre']").on('click', function(){
        var emphAlert = ($('.emphasis-block.error-message').length === 1);
        if(form.valid() !== true) {
            if(emphAlert) {
                $('.emphasis-block.error-message').show();
            } else {
                $(form).before().prepend('<div class="emphasis-block error-message" role="alert"><p class="h3">Sorry, there was a problem</p><p>Please check the highlighted fields to proceed.</p></div>');
            }
        }
    });

};/**
 * @contact-form-name: Your Views form
 *
 * ----- Table of contents -------------------------------------
 *
 * 1. Define variables
 * 2. Include custom form methods from methods.js
 * 3. Add the validation rules
 * */

function yourViewsForm(){
    /**
     * 1. Declare variables
     * */
    var formName = "#your-views";
    var form = $(formName);

    /**
     * 2. Included custom form validation methods from methods.js
     * */
    formMethods();

    /**
     * 3. Add the validation rules
     * */
    form.validate({
        errorElement: 'span',
        errorClass: 'form-error form-hint',
        highlight: function(element, errorClass, validClass) {
            $(element).closest('input[type="text"]').addClass("form-warning");
            $(element).closest('input[type="email"]').addClass("form-warning");
            $(element).closest('textarea').addClass("form-warning");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('input[type="text"]').removeClass("form-warning");
            $(element).closest('input[type="email"]').removeClass("form-warning");
            $(element).closest('textarea').removeClass("form-warning");
        },
        rules: {
            "full-name": {
                noSpace: true
            },
            "email": {
                email:true
            },
            "confirm-email": {
                equalTo: "#email"
            },
            "reason-required":{
                required: true,
                noSpace: true
            },
            "enquiry-required":{
                required:true,
                noSpace:true
            }

        },
        /**
         * Error messages
         * */
        messages: {
            "confirm-email": {
                equalTo: "Please enter your email address again"
            },
            "reason-required":{
                required: "Please select an option"
            },
            "enquiry-required":{
                required:"Please enter your enquiry"
            }
        }
    });

    $("input[name='submit-yv']").on('click', function(){
        var emphAlert = ($('.emphasis-block.error-message').length === 1);
        if(form.valid() !== true) {
            if(emphAlert) {
                $('.emphasis-block.error-message').show();
            } else {
                $(form).before().prepend('<div class="emphasis-block error-message" role="alert"><p class="h3">Sorry, there was a problem</p><p>Please check the highlighted fields to proceed.</p></div>');
            }
        }
    });
};/**
 * @contact-form-name: General form
 *
 * ----- Table of contents -------------------------------------
 *
 * 1. Define variables
 * 2. Include custom form methods from methods.js
 * 3. Add the validation rules
 * */

function generalEnquiriesForm(){
    /**
     * 1. Declare variables
     * */
    var formName = "#general";
    var form = $(formName);

    /**
     * 2. Included custom form validation methods from methods.js
     * */
    formMethods();

    /**
     * 3. Add the validation rules
     * */
    form.validate({
        errorElement: 'span',
        errorClass: 'form-error form-hint',
        highlight: function(element, errorClass, validClass) {
            $(element).closest('input[type="text"]').addClass("form-warning");
            $(element).closest('input[type="email"]').addClass("form-warning");
            $(element).closest('textarea').addClass("form-warning");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('input[type="text"]').removeClass("form-warning");
            $(element).closest('input[type="email"]').removeClass("form-warning");
            $(element).closest('textarea').removeClass("form-warning");
        },
        rules: {
            "full-name-required": {
                required: true,
                noSpace: true
            },
            "email-required": {
                required: true,
                email:true
            },
            "confirm-email-required": {
                equalTo: "#email"
            },
            "country-required":{
                required:true,
                noSpace:true
            },
            "reason-required":{
                required:true,
                noSpace:true
            },
            "enquiry-required":{
                required:true,
                noSpace:true
            }

        },
        /**
         * Error messages
         * */
        messages: {
            "full-name-required": {
                required: "Please enter your full name"
            },
            "email-required": "Please enter your email address",
            "confirm-email-required": {
                required:"Please enter your email address",
                equalTo: "Please enter your email address again"
            },
            "country-required":{
                required:"Please enter your country"
            },
            "reason-required":{
                required:"Please select an option"
            },
            "enquiry-required":{
                required:"Please enter your enquiry"
            }
        }
    });

    $("input[name='submit-ge']").on('click', function(){
        var emphAlert = ($('.emphasis-block.error-message').length === 1);
        if(form.valid() !== true) {
            if(emphAlert) {
                $('.emphasis-block.error-message').show();
            } else {
                $(form).before().prepend('<div class="emphasis-block error-message" role="alert"><p class="h3">Sorry, there was a problem</p><p>Please check the highlighted fields to proceed.</p></div>');
            }
        }
    });
};/**
 * @contact-form-name: Public sector form
 *
 * ----- Table of contents -------------------------------------
 *
 * 1. Define variables
 * 2. Include custom form methods from methods.js
 * 3. Add the validation rules
 * */

function publicSectorForm(){
    /**
     * 1. Declare variables
     * */
    var formName = "#public-sector";
    var form = $(formName);

    /**
     * 2. Included custom form validation methods from methods.js
     * */
    formMethods();

    /**
     * 3. Add the validation rules
     * */
    form.validate({
        errorElement: 'span',
        errorClass: 'form-error form-hint',
        highlight: function(element, errorClass, validClass) {
            $(element).closest('input[type="text"]').addClass("form-warning");
            $(element).closest('input[type="email"]').addClass("form-warning");
            $(element).closest('textarea').addClass("form-warning");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('input[type="text"]').removeClass("form-warning");
            $(element).closest('input[type="email"]').removeClass("form-warning");
            $(element).closest('textarea').removeClass("form-warning");
        },
        rules: {
            "full-name-required": {
                required: true,
                noSpace: true
            },
            "email-required": {
                required: true,
                email:true
            },
            "confirm-email-required": {
                equalTo: "#email"
            },
            "enquiry-required":{
                required:true,
                noSpace:true
            }

        },
        /**
         * Error messages
         * */
        messages: {
            "full-name-required": {
                required: "Please enter your full name"
            },
            "email-required": "Please enter your email address",
            "confirm-email-required": {
                required:"Please enter your email address",
                equalTo: "Please enter your email address again"
            },
            "enquiry-required":{
                required:"Please enter your enquiry"
            }
        }
    });

    $("input[name='submit-psi']").on('click', function(){
        var emphAlert = ($('.emphasis-block.error-message').length === 1);
        if(form.valid() !== true) {
            if(emphAlert) {
                $('.emphasis-block.error-message').show();
            } else {
                $(form).before().prepend('<div class="emphasis-block error-message" role="alert"><p class="h3">Sorry, there was a problem</p><p>Please check the highlighted fields to proceed.</p></div>');
            }
        }
    });

};/**
 * @contact-form-name: IACS Training form
 *
 * ----- Table of contents -------------------------------------
 *
 * 1. Define variables
 * 2. Include custom form methods from methods.js
 * 3. Check if value in drop down sessions does not match
 * 4. Add the validation rules
 * */

function iacsTrainingForm(){
    /**
     * 1. Declare variables
     * */
    var formName = "#iacs_training";
    var form = $(formName);

    /**
     * 2. Included custom form validation methods from methods.js
     * */
    formMethods();

    /**
     * 3. Check if value in drop down sessions does not match
     * */

    // Declare self executing function and keep all my variables inside this scope
    (function(){

        // Declare variables
        var $firstSession = $('#session_first_choice');
        var $secondSession = $('#session_second_choice');

        // Declare anonymous function
        var compareSessions = function (sessionOne, sessionTwo){
            sessionOne.change(function() {
                sessionTwo.find('option').prop("disabled", false);
                var selectedItem = $(this).val();
                if (selectedItem) {
                    sessionTwo.find('option[value="' + selectedItem + '"]').prop("disabled", true);
                }
            });
        }

        // Compare session 1 with 2
        compareSessions($firstSession,$secondSession);
        // Compare session 2 with 1
        compareSessions($secondSession,$firstSession);
    })();

    /**
     * 4. Add the validation rules
     * */
    form.validate({
        errorElement: 'span',
        errorClass: 'form-error form-hint',
        highlight: function(element, errorClass, validClass) {
            $(element).closest('input[type="text"]').addClass("form-warning");
            $(element).closest('input[type="email"]').addClass("form-warning");
            $(element).closest('input[type="tel"]').addClass("form-warning");
            $(element).closest('textarea').addClass("form-warning");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('input[type="text"]').removeClass("form-warning");
            $(element).closest('input[type="email"]').removeClass("form-warning");
            $(element).closest('input[type="tel"]').removeClass("form-warning");
            $(element).closest('textarea').removeClass("form-warning");
        },
        rules: {
            "full-name-required": {
                required: true,
                noSpace: true
            },
            "email-required": {
                required: true,
                email:true
            },
            "confirm-email-required": {
                equalTo: "#email"
            },
            "telephone-required":{
                required: true,
                noSpace: true
            },
            "job-title-required":{
                required:true,
                noSpace: true
            },
            "organisation-required":{
                required:true,
                noSpace: true
            },
            "address-required":{
                required:true,
                noSpace:true
            },
            "organisation-type-required":{
                required:true,
                noSpace: true
            },
            "your-role-required":{
                required:true,
                noSpace: true
            },
           "session-first-choice-required": {
                required:true,
                noSpace: true
            },
            "session-second-choice-required": {
                required:true,
                noSpace: true
            }

        },
        /**
         * Error messages
         * */
        messages: {
            "full-name-required": {
                required: "Please enter your full name"
            },
            "email-required": "Please enter your email address",
            "confirm-email-required": {
                required:"Please enter your email address",
                equalTo: "Please enter your email address again"
            },
            "telephone-required":{
                required: "Please enter your telephone number"
            },
            "job-title-required":{
                required:"Please enter your job title"
            },
            "organisation-required":{
                required:"Please enter a department/agency/organisation"
            },
            "address-required":{
                required:"Please enter an address"
            },
            "organisation-type-required":{
                required:"Please select an option"
            },
            "your-role-required":{
                required:"Please select an option"
            },
            "session-first-choice-required": {
                required:"Please select an option"
            },
            "session-second-choice-required": {
                required:"Please select an option"
            }
        }
    });

    $("input[name='submit-iacs']").on('click', function(){
        var emphAlert = ($('.emphasis-block.error-message').length === 1);
        if(form.valid() !== true) {
            if(emphAlert) {
                $('.emphasis-block.error-message').show();
            } else {
                $(form).before().prepend('<div class="emphasis-block error-message" role="alert"><p class="h3">Sorry, there was a problem</p><p>Please check the highlighted fields to proceed.</p></div>');
            }
        }
    });
};/**
 * @contact-form-name: Apply to film
 *
 * ----- Table of contents -------------------------------------
 *
 * 1. Define variables
 * 2. Include custom form methods from methods.js
 * 3. Add the validation rules
 * */

function applyToFilmForm(){
    /**
     * 1. Declare variables
     * */
    var formName = "#apply-to-film";
    var form = $(formName);

    /**
     * 2. Included custom form validation methods from methods.js
     * */
    formMethods();

    /**
     * 3. Add the validation rules
     * */
    form.validate({
        errorElement: 'span',
        errorClass: 'form-error form-hint',
        highlight: function(element, errorClass, validClass) {
            $(element).closest('input[type="text"]').addClass("form-warning");
            $(element).closest('input[type="email"]').addClass("form-warning");
            $(element).closest('textarea').addClass("form-warning");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('input[type="text"]').removeClass("form-warning");
            $(element).closest('input[type="email"]').removeClass("form-warning");
            $(element).closest('textarea').removeClass("form-warning");
        },
        rules: {
            "full-name-required": {
                required: true,
                noSpace: true
            },
            "email-required": {
                required: true,
                email:true,
                emailCustom:true
            },
            "confirm-email-required": {
                equalTo: "#email"
            },
            "date-required":{
                required:true,
                noSpace: true
            },
            "policy-required":{
                required:true,
                noSpace: true
            }

        },
        /**
         * Error messages
         * */
        messages: {
            "full-name-required": {
                required: "Please enter your full name"
            },
            "email-required": "Please enter your email address",
            "confirm-email-required": {
                required:"Please enter your email address",
                equalTo: "Please enter your email address again"
            },
            "date-required":{
                required:"Please enter your filming date"
            },
            "policy-required":{
                required:"Please agree to the terms and conditions"
            }
        }
    });

    $("input[name='submit-atf']").on('click', function(){
        var emphAlert = ($('.emphasis-block.error-message').length === 1);
        if(form.valid() !== true) {
            if(emphAlert) {
                $('.emphasis-block.error-message').show();
            } else {
                $(form).before().prepend('<div class="emphasis-block error-message" role="alert"><p class="h3">Sorry, there was a problem</p><p>Please check the highlighted fields to proceed.</p></div>');
            }
        }
    });
};/**
 * @contact-form-name: Apply to film
 *
 * ----- Table of contents -------------------------------------
 *
 * 1. Define variables
 * 2. Include custom form methods from methods.js
 * 3. Add the validation rules
 * */

function pronomForm(){
    /**
     * 1. Declare variables
     * */
    var formName = "#pronom";
    var form = $(formName);

    /**
     * 2. Included custom form validation methods from methods.js
     * */
    formMethods();

    /**
     * 3. Add the validation rules
     * */
    form.validate({
        errorElement: 'span',
        errorClass: 'form-error form-hint',
        highlight: function(element, errorClass, validClass) {
            $(element).closest('input[type="text"]').addClass("form-warning");
            $(element).closest('input[type="email"]').addClass("form-warning");
            $(element).closest('textarea').addClass("form-warning");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('input[type="text"]').removeClass("form-warning");
            $(element).closest('input[type="email"]').removeClass("form-warning");
            $(element).closest('textarea').removeClass("form-warning");
        },
        rules: {
            "full-name-required": {
                required: true,
                noSpace: true
            },
            "email-required": {
                required: true,
                email:true
            },
            "confirm-email-required": {
                equalTo: "#email"
            },
            "file-format-required":{
                required: true,
                noSpace: true
            }

        },
        /**
         * Error messages
         * */
        messages: {
            "full-name-required": {
                required:"Please enter your full name"
            },
            "email-required": "Please enter your email address",
            "confirm-email-required": {
                required:"Please enter your email address",
                equalTo: "Please enter your email address again"
            },
            "file-format-required":{
                required:"Please enter the file format"
            }
        }
    });

    $("input[name='submit-pr']").on('click', function(){
        var emphAlert = ($('.emphasis-block.error-message').length === 1);
        if(form.valid() !== true) {
            if(emphAlert) {
                $('.emphasis-block.error-message').show();
            } else {
                $(form).before().prepend('<div class="emphasis-block error-message" role="alert"><p class="h3">Sorry, there was a problem</p><p>Please check the highlighted fields to proceed.</p></div>');
            }
        }
    });
};/**
 * @contact-form-name: Your Views form
 *
 * ----- Table of contents -------------------------------------
 *
 * 1. Define variables
 * 2. Include custom form methods from methods.js
 * 3. Add the validation rules
 *
 * */
function radForm(){
    /**
     * 1. Declare variables
     * */
    var formName = "#request-assessment-document";
    var form = $(formName);

    /**
     * 2. Included custom form validation methods from methods.js
     * */
    formMethods();

    /**
     * 3. Add the validation rules
     * */
    form.validate({
        errorElement: 'span',
        errorClass: 'form-error form-hint',
        highlight: function(element, errorClass, validClass) {
            $(element).closest('input[type="text"]').addClass("form-warning");
            $(element).closest('input[type="email"]').addClass("form-warning");
            $(element).closest('textarea').addClass("form-warning");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('input[type="text"]').removeClass("form-warning");
            $(element).closest('input[type="email"]').removeClass("form-warning");
            $(element).closest('textarea').removeClass("form-warning");
        },
        rules: {
            "full-name-required": {
                required: true,
                noSpace: true
            },
            "email-required": {
                email:true
            },
            "confirm-email-required": {
                equalTo: "#email"
            }
        },
        /**
         * Error messages
         * */
        messages: {
            "full-name-required":{
                required:"Please insert your full name"
            },
            "email-required": "Please enter your email address",
            "confirm-email-required": {
                required:"Please enter your email address",
                equalTo: "Please enter your email address again"
            }
        }
    });

    $("input[name='submit-request-assessment-document']").on('click', function(){
        var emphAlert = ($('.emphasis-block.error-message').length === 1);
        if(form.valid() !== true) {
            if(emphAlert) {
                $('.emphasis-block.error-message').show();
            } else {
                $(form).before().prepend('<div class="emphasis-block error-message" role="alert"><p class="h3">Sorry, there was a problem</p><p>Please check the highlighted fields to proceed.</p></div>');
            }
        }
    });


};/**
 * @contact-form-name: Apply to film
 *
 * ----- Table of contents -------------------------------------
 *
 * 1. Define variables
 * 2. Include custom form methods from methods.js
 * 3. Add the validation rules
 * */

function archiveUpdateForm(){
    /**
     * 1. Declare variables
     * */
    var formName = "#archive_update";
    var form = $(formName);

    /**
     * 2. Included custom form validation methods from methods.js
     * */
    formMethods();

    /**
     * 3. Add the validation rules
     * */
    form.validate({
        errorElement: 'span',
        errorClass: 'form-error form-hint',
        highlight: function(element, errorClass, validClass) {
            $(element).closest('input[type="text"]').addClass("form-warning");
            $(element).closest('input[type="email"]').addClass("form-warning");
            $(element).closest('textarea').addClass("form-warning");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('input[type="text"]').removeClass("form-warning");
            $(element).closest('input[type="email"]').removeClass("form-warning");
            $(element).closest('textarea').removeClass("form-warning");
        },
        rules: {
            "full-name-required": {
                required: true,
                noSpace: true
            },
            "email-required": {
                required: true,
                email:true
            },
            "confirm-email-required": {
                equalTo: "#email"
            },
            "file-format-required":{
                required: true,
                noSpace: true
            },
            "type-of-entry-required":{
                required: true
            },
            "name-of-repository-required":{
                required:true,
                noSpace:true
            }
        },
        /**
         * Error messages
         * */
        messages: {
            "full-name-required": {
                required:"Please enter your full name"
            },
            "email-required": "Please enter your email address",
            "confirm-email-required": {
                required:"Please enter your email address",
                equalTo: "Please enter your email address again"
            },
            "file-format-required":{
                required:"Please enter the file format"
            },
            "type-of-entry-required": {
                required:"Please select from the dropdown"
            },
            "name-of-repository-required":{
                required:"Please enter the name of the repository"
            }
        }
    });

    $("input[name='submit-aup']").on('click', function(){
        var emphAlert = ($('.emphasis-block.error-message').length === 1);
        if(form.valid() !== true) {
            if(emphAlert) {
                $('.emphasis-block.error-message').show();
            } else {
                $(form).before().prepend('<div class="emphasis-block error-message" role="alert"><p class="h3">Sorry, there was a problem</p><p>Please check the highlighted fields to proceed.</p></div>');
            }
        }
    });
}

;/**
 * @contact-form-name: Public sector form
 *
 * ----- Table of contents -------------------------------------
 *
 * 1. Define variables
 * 2. Include custom form methods from methods.js
 * 3. Add the validation rules
 * */

function paidSearchForm(){
    /**
     * 1. Declare variables
     * */
    var formName = "#paid_search";
    var form = $(formName);

    /**
     * 2. Included custom form validation methods from methods.js
     * */
    formMethods();

    /**
     * 3. Add the validation rules
     * */
    form.validate({
        errorElement: 'span',
        errorClass: 'form-error form-hint',
        highlight: function(element, errorClass, validClass) {
            $(element).closest('input[type="text"]').addClass("form-warning");
            $(element).closest('input[type="email"]').addClass("form-warning");
            $(element).closest('textarea').addClass("form-warning");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('input[type="text"]').removeClass("form-warning");
            $(element).closest('input[type="email"]').removeClass("form-warning");
            $(element).closest('textarea').removeClass("form-warning");
        },
        rules: {
            "full-name-required": {
                required: true,
                noSpace: true
            },
            "email-required": {
                required: true,
                email:true
            },
            "confirm-email-required": {
                equalTo: "#email"
            },
            "country-required":{
                required:true,
                noSpace:true
            },
            "your-enquiry-required":{
                required:true,
                noSpace:true
            }

        },
        /**
         * Error messages
         * */
        messages: {
            "full-name-required": {
                required: "Please enter your full name"
            },
            "email-required": "Please enter your email address",
            "confirm-email-required": {
                required:"Please enter your email address",
                equalTo: "Please enter your email address again"
            },
            "country-required":{
                required:"Please enter your country"
            },
            "your-enquiry-required": {
                required:"Please provide specific details of the information you are looking for, including any relevant catalogue references."
            }   
        }
    });

    $("input[name='submit-paid-search']").on('click', function(){
        var emphAlert = ($('.emphasis-block.error-message').length === 1);
        if(form.valid() !== true) {
            if(emphAlert) {
                $('.emphasis-block.error-message').show();
            } else {
                $(form).before().prepend('<div class="emphasis-block error-message" role="alert"><p class="h3">Sorry, there was a problem</p><p>Please check the highlighted fields to proceed.</p></div>');
            }
        }
    });
};/**
 * @contact-form-name: Your Views form
 *
 * ----- Table of contents -------------------------------------
 *
 * 1. Define variables
 * 2. Include custom form methods from methods.js
 * 3. Add the validation rules
 *
 * */
function dcfForm(){
    /**
     * 1. Declare variables
     * */
    var formName = "#dcf";
    var form = $(formName);

    /**
     * 2. Included custom form validation methods from methods.js
     * */
    formMethods();

    /**
     * 3. Add the validation rules
     * */
    form.validate({
        errorElement: 'span',
        errorClass: 'form-error form-hint',
        highlight: function(element, errorClass, validClass) {
            $(element).closest('input[type="text"]').addClass("form-warning");
            $(element).closest('input[type="email"]').addClass("form-warning");
            $(element).closest('textarea').addClass("form-warning");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('input[type="text"]').removeClass("form-warning");
            $(element).closest('input[type="email"]').removeClass("form-warning");
            $(element).closest('textarea').removeClass("form-warning");
        },
        rules: {
            "full-name": {
                noSpace: true
            },
            "email": {
                email:true
            },
            "confirm-email": {
                equalTo: "#email"
            },
            "catalogue-reference-required":{
                required: true,
                noSpace: true
            },
            "additional-details":{
                noSpace:true
            }
        },
        /**
         * Error messages
         * */
        messages: {
            "confirm-email": {
                equalTo: "Please enter your email address again"
            },
            "catalogue-reference-required":{
                required: "Please enter your catalogue reference number"
            }
        }
    });

    $("input[name='submit-dcf']").on('click', function(){
        var emphAlert = ($('.emphasis-block.error-message').length === 1);
        if(form.valid() !== true) {
            if(emphAlert) {
                $('.emphasis-block.error-message').show();
            } else {
                $(form).before().prepend('<div class="emphasis-block error-message" role="alert"><p class="h3">Sorry, there was a problem</p><p>Please check the highlighted fields to proceed.</p></div>');
            }
        }
    });


};/**
 * @name  : Newsletter and Contact forms Wordpress plugin
 * @author: TNA WebTeam
 * @owner : The National Archives
 */
$(document).ready(function() {
    (function() {

        /**
         * Call the Newsletter validation plugin
         * */
        $('#signup').newsletterValidation();

        /**
         * Contact forms
         * */

        if ($('#naturalisation').is(':visible')) {
            naturalisationForm();
        }
        else if($('#records-research-enquiry').is(':visible')){
            recordsResearchEnquiryForm();
        }
        else if($('#your-views').is(':visible')){
            yourViewsForm();
        }
        else if ($('#general').is(':visible')){
            generalEnquiriesForm();
        }
        else if ($('#public-sector').is(':visible')){
            publicSectorForm();
        }
        else if ($('#iacs_training').is(':visible')){
            iacsTrainingForm();
        }
        else if ($('#apply-to-film').is(':visible')){
            applyToFilmForm();
        }
        else if ($('#pronom').is(':visible')){
            pronomForm();
        }
        else if ($('#dcf').is(':visible')) {
            dcfForm();
        }
        else if ($('#archive_update').is(':visible')) {
            archiveUpdateForm();
        }
        else if ($('#paid_search').is(':visible')) {
            paidSearchForm();
        }
        else if ($('#request-assessment-document').is(':visible')) {
            radForm();
        }
        else {
            defaultForm();
        }
    }());
});


;typeof JSON!="object"&&(JSON={}),function(){"use strict";function f(e){return e<10?"0"+e:e}function quote(e){return escapable.lastIndex=0,escapable.test(e)?'"'+e.replace(escapable,function(e){var t=meta[e];return typeof t=="string"?t:"\\u"+("0000"+e.charCodeAt(0).toString(16)).slice(-4)})+'"':'"'+e+'"'}function str(e,t){var n,r,i,s,o=gap,u,a=t[e];a&&typeof a=="object"&&typeof a.toJSON=="function"&&(a=a.toJSON(e)),typeof rep=="function"&&(a=rep.call(t,e,a));switch(typeof a){case"string":return quote(a);case"number":return isFinite(a)?String(a):"null";case"boolean":case"null":return String(a);case"object":if(!a)return"null";gap+=indent,u=[];if(Object.prototype.toString.apply(a)==="[object Array]"){s=a.length;for(n=0;n<s;n+=1)u[n]=str(n,a)||"null";return i=u.length===0?"[]":gap?"[\n"+gap+u.join(",\n"+gap)+"\n"+o+"]":"["+u.join(",")+"]",gap=o,i}if(rep&&typeof rep=="object"){s=rep.length;for(n=0;n<s;n+=1)typeof rep[n]=="string"&&(r=rep[n],i=str(r,a),i&&u.push(quote(r)+(gap?": ":":")+i))}else for(r in a)Object.prototype.hasOwnProperty.call(a,r)&&(i=str(r,a),i&&u.push(quote(r)+(gap?": ":":")+i));return i=u.length===0?"{}":gap?"{\n"+gap+u.join(",\n"+gap)+"\n"+o+"}":"{"+u.join(",")+"}",gap=o,i}}typeof Date.prototype.toJSON!="function"&&(Date.prototype.toJSON=function(e){return isFinite(this.valueOf())?this.getUTCFullYear()+"-"+f(this.getUTCMonth()+1)+"-"+f(this.getUTCDate())+"T"+f(this.getUTCHours())+":"+f(this.getUTCMinutes())+":"+f(this.getUTCSeconds())+"Z":null},String.prototype.toJSON=Number.prototype.toJSON=Boolean.prototype.toJSON=function(e){return this.valueOf()});var cx=/[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,escapable=/[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,gap,indent,meta={"\b":"\\b","	":"\\t","\n":"\\n","\f":"\\f","\r":"\\r",'"':'\\"',"\\":"\\\\"},rep;typeof JSON.stringify!="function"&&(JSON.stringify=function(e,t,n){var r;gap="",indent="";if(typeof n=="number")for(r=0;r<n;r+=1)indent+=" ";else typeof n=="string"&&(indent=n);rep=t;if(!t||typeof t=="function"||typeof t=="object"&&typeof t.length=="number")return str("",{"":e});throw new Error("JSON.stringify")}),typeof JSON.parse!="function"&&(JSON.parse=function(text,reviver){function walk(e,t){var n,r,i=e[t];if(i&&typeof i=="object")for(n in i)Object.prototype.hasOwnProperty.call(i,n)&&(r=walk(i,n),r!==undefined?i[n]=r:delete i[n]);return reviver.call(e,t,i)}var j;text=String(text),cx.lastIndex=0,cx.test(text)&&(text=text.replace(cx,function(e){return"\\u"+("0000"+e.charCodeAt(0).toString(16)).slice(-4)}));if(/^[\],:{}\s]*$/.test(text.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g,"@").replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,"]").replace(/(?:^|:|,)(?:\s*\[)+/g,"")))return j=eval("("+text+")"),typeof reviver=="function"?walk({"":j},""):j;throw new SyntaxError("JSON.parse")})}(),function(e,t){"use strict";var n=e.History=e.History||{},r=e.jQuery;if(typeof n.Adapter!="undefined")throw new Error("History.js Adapter has already been loaded...");n.Adapter={bind:function(e,t,n){r(e).bind(t,n)},trigger:function(e,t,n){r(e).trigger(t,n)},extractEventData:function(e,n,r){var i=n&&n.originalEvent&&n.originalEvent[e]||r&&r[e]||t;return i},onDomLoad:function(e){r(e)}},typeof n.init!="undefined"&&n.init()}(window),function(e,t){"use strict";var n=e.document,r=e.setTimeout||r,i=e.clearTimeout||i,s=e.setInterval||s,o=e.History=e.History||{};if(typeof o.initHtml4!="undefined")throw new Error("History.js HTML4 Support has already been loaded...");o.initHtml4=function(){if(typeof o.initHtml4.initialized!="undefined")return!1;o.initHtml4.initialized=!0,o.enabled=!0,o.savedHashes=[],o.isLastHash=function(e){var t=o.getHashByIndex(),n;return n=e===t,n},o.isHashEqual=function(e,t){return e=encodeURIComponent(e).replace(/%25/g,"%"),t=encodeURIComponent(t).replace(/%25/g,"%"),e===t},o.saveHash=function(e){return o.isLastHash(e)?!1:(o.savedHashes.push(e),!0)},o.getHashByIndex=function(e){var t=null;return typeof e=="undefined"?t=o.savedHashes[o.savedHashes.length-1]:e<0?t=o.savedHashes[o.savedHashes.length+e]:t=o.savedHashes[e],t},o.discardedHashes={},o.discardedStates={},o.discardState=function(e,t,n){var r=o.getHashByState(e),i;return i={discardedState:e,backState:n,forwardState:t},o.discardedStates[r]=i,!0},o.discardHash=function(e,t,n){var r={discardedHash:e,backState:n,forwardState:t};return o.discardedHashes[e]=r,!0},o.discardedState=function(e){var t=o.getHashByState(e),n;return n=o.discardedStates[t]||!1,n},o.discardedHash=function(e){var t=o.discardedHashes[e]||!1;return t},o.recycleState=function(e){var t=o.getHashByState(e);return o.discardedState(e)&&delete o.discardedStates[t],!0},o.emulated.hashChange&&(o.hashChangeInit=function(){o.checkerFunction=null;var t="",r,i,u,a,f=Boolean(o.getHash());return o.isInternetExplorer()?(r="historyjs-iframe",i=n.createElement("iframe"),i.setAttribute("id",r),i.setAttribute("src","#"),i.style.display="none",n.body.appendChild(i),i.contentWindow.document.open(),i.contentWindow.document.close(),u="",a=!1,o.checkerFunction=function(){if(a)return!1;a=!0;var n=o.getHash(),r=o.getHash(i.contentWindow.document);return n!==t?(t=n,r!==n&&(u=r=n,i.contentWindow.document.open(),i.contentWindow.document.close(),i.contentWindow.document.location.hash=o.escapeHash(n)),o.Adapter.trigger(e,"hashchange")):r!==u&&(u=r,f&&r===""?o.back():o.setHash(r,!1)),a=!1,!0}):o.checkerFunction=function(){var n=o.getHash()||"";return n!==t&&(t=n,o.Adapter.trigger(e,"hashchange")),!0},o.intervalList.push(s(o.checkerFunction,o.options.hashChangeInterval)),!0},o.Adapter.onDomLoad(o.hashChangeInit)),o.emulated.pushState&&(o.onHashChange=function(t){var n=t&&t.newURL||o.getLocationHref(),r=o.getHashByUrl(n),i=null,s=null,u=null,a;return o.isLastHash(r)?(o.busy(!1),!1):(o.doubleCheckComplete(),o.saveHash(r),r&&o.isTraditionalAnchor(r)?(o.Adapter.trigger(e,"anchorchange"),o.busy(!1),!1):(i=o.extractState(o.getFullUrl(r||o.getLocationHref()),!0),o.isLastSavedState(i)?(o.busy(!1),!1):(s=o.getHashByState(i),a=o.discardedState(i),a?(o.getHashByIndex(-2)===o.getHashByState(a.forwardState)?o.back(!1):o.forward(!1),!1):(o.pushState(i.data,i.title,encodeURI(i.url),!1),!0))))},o.Adapter.bind(e,"hashchange",o.onHashChange),o.pushState=function(t,n,r,i){r=encodeURI(r).replace(/%25/g,"%");if(o.getHashByUrl(r))throw new Error("History.js does not support states with fragment-identifiers (hashes/anchors).");if(i!==!1&&o.busy())return o.pushQueue({scope:o,callback:o.pushState,args:arguments,queue:i}),!1;o.busy(!0);var s=o.createStateObject(t,n,r),u=o.getHashByState(s),a=o.getState(!1),f=o.getHashByState(a),l=o.getHash(),c=o.expectedStateId==s.id;return o.storeState(s),o.expectedStateId=s.id,o.recycleState(s),o.setTitle(s),u===f?(o.busy(!1),!1):(o.saveState(s),c||o.Adapter.trigger(e,"statechange"),!o.isHashEqual(u,l)&&!o.isHashEqual(u,o.getShortUrl(o.getLocationHref()))&&o.setHash(u,!1),o.busy(!1),!0)},o.replaceState=function(t,n,r,i){r=encodeURI(r).replace(/%25/g,"%");if(o.getHashByUrl(r))throw new Error("History.js does not support states with fragment-identifiers (hashes/anchors).");if(i!==!1&&o.busy())return o.pushQueue({scope:o,callback:o.replaceState,args:arguments,queue:i}),!1;o.busy(!0);var s=o.createStateObject(t,n,r),u=o.getHashByState(s),a=o.getState(!1),f=o.getHashByState(a),l=o.getStateByIndex(-2);return o.discardState(a,s,l),u===f?(o.storeState(s),o.expectedStateId=s.id,o.recycleState(s),o.setTitle(s),o.saveState(s),o.Adapter.trigger(e,"statechange"),o.busy(!1)):o.pushState(s.data,s.title,s.url,!1),!0}),o.emulated.pushState&&o.getHash()&&!o.emulated.hashChange&&o.Adapter.onDomLoad(function(){o.Adapter.trigger(e,"hashchange")})},typeof o.init!="undefined"&&o.init()}(window),function(e,t){"use strict";var n=e.console||t,r=e.document,i=e.navigator,s=!1,o=e.setTimeout,u=e.clearTimeout,a=e.setInterval,f=e.clearInterval,l=e.JSON,c=e.alert,h=e.History=e.History||{},p=e.history;try{s=e.sessionStorage,s.setItem("TEST","1"),s.removeItem("TEST")}catch(d){s=!1}l.stringify=l.stringify||l.encode,l.parse=l.parse||l.decode;if(typeof h.init!="undefined")throw new Error("History.js Core has already been loaded...");h.init=function(e){return typeof h.Adapter=="undefined"?!1:(typeof h.initCore!="undefined"&&h.initCore(),typeof h.initHtml4!="undefined"&&h.initHtml4(),!0)},h.initCore=function(d){if(typeof h.initCore.initialized!="undefined")return!1;h.initCore.initialized=!0,h.options=h.options||{},h.options.hashChangeInterval=h.options.hashChangeInterval||100,h.options.safariPollInterval=h.options.safariPollInterval||500,h.options.doubleCheckInterval=h.options.doubleCheckInterval||500,h.options.disableSuid=h.options.disableSuid||!1,h.options.storeInterval=h.options.storeInterval||1e3,h.options.busyDelay=h.options.busyDelay||250,h.options.debug=h.options.debug||!1,h.options.initialTitle=h.options.initialTitle||r.title,h.options.html4Mode=h.options.html4Mode||!1,h.options.delayInit=h.options.delayInit||!1,h.intervalList=[],h.clearAllIntervals=function(){var e,t=h.intervalList;if(typeof t!="undefined"&&t!==null){for(e=0;e<t.length;e++)f(t[e]);h.intervalList=null}},h.debug=function(){(h.options.debug||!1)&&h.log.apply(h,arguments)},h.log=function(){var e=typeof n!="undefined"&&typeof n.log!="undefined"&&typeof n.log.apply!="undefined",t=r.getElementById("log"),i,s,o,u,a;e?(u=Array.prototype.slice.call(arguments),i=u.shift(),typeof n.debug!="undefined"?n.debug.apply(n,[i,u]):n.log.apply(n,[i,u])):i="\n"+arguments[0]+"\n";for(s=1,o=arguments.length;s<o;++s){a=arguments[s];if(typeof a=="object"&&typeof l!="undefined")try{a=l.stringify(a)}catch(f){}i+="\n"+a+"\n"}return t?(t.value+=i+"\n-----\n",t.scrollTop=t.scrollHeight-t.clientHeight):e||c(i),!0},h.getInternetExplorerMajorVersion=function(){var e=h.getInternetExplorerMajorVersion.cached=typeof h.getInternetExplorerMajorVersion.cached!="undefined"?h.getInternetExplorerMajorVersion.cached:function(){var e=3,t=r.createElement("div"),n=t.getElementsByTagName("i");while((t.innerHTML="<!--[if gt IE "+ ++e+"]><i></i><![endif]-->")&&n[0]);return e>4?e:!1}();return e},h.isInternetExplorer=function(){var e=h.isInternetExplorer.cached=typeof h.isInternetExplorer.cached!="undefined"?h.isInternetExplorer.cached:Boolean(h.getInternetExplorerMajorVersion());return e},h.options.html4Mode?h.emulated={pushState:!0,hashChange:!0}:h.emulated={pushState:!Boolean(e.history&&e.history.pushState&&e.history.replaceState&&!/ Mobile\/([1-7][a-z]|(8([abcde]|f(1[0-8]))))/i.test(i.userAgent)&&!/AppleWebKit\/5([0-2]|3[0-2])/i.test(i.userAgent)),hashChange:Boolean(!("onhashchange"in e||"onhashchange"in r)||h.isInternetExplorer()&&h.getInternetExplorerMajorVersion()<8)},h.enabled=!h.emulated.pushState,h.bugs={setHash:Boolean(!h.emulated.pushState&&i.vendor==="Apple Computer, Inc."&&/AppleWebKit\/5([0-2]|3[0-3])/.test(i.userAgent)),safariPoll:Boolean(!h.emulated.pushState&&i.vendor==="Apple Computer, Inc."&&/AppleWebKit\/5([0-2]|3[0-3])/.test(i.userAgent)),ieDoubleCheck:Boolean(h.isInternetExplorer()&&h.getInternetExplorerMajorVersion()<8),hashEscape:Boolean(h.isInternetExplorer()&&h.getInternetExplorerMajorVersion()<7)},h.isEmptyObject=function(e){for(var t in e)if(e.hasOwnProperty(t))return!1;return!0},h.cloneObject=function(e){var t,n;return e?(t=l.stringify(e),n=l.parse(t)):n={},n},h.getRootUrl=function(){var e=r.location.protocol+"//"+(r.location.hostname||r.location.host);if(r.location.port||!1)e+=":"+r.location.port;return e+="/",e},h.getBaseHref=function(){var e=r.getElementsByTagName("base"),t=null,n="";return e.length===1&&(t=e[0],n=t.href.replace(/[^\/]+$/,"")),n=n.replace(/\/+$/,""),n&&(n+="/"),n},h.getBaseUrl=function(){var e=h.getBaseHref()||h.getBasePageUrl()||h.getRootUrl();return e},h.getPageUrl=function(){var e=h.getState(!1,!1),t=(e||{}).url||h.getLocationHref(),n;return n=t.replace(/\/+$/,"").replace(/[^\/]+$/,function(e,t,n){return/\./.test(e)?e:e+"/"}),n},h.getBasePageUrl=function(){var e=h.getLocationHref().replace(/[#\?].*/,"").replace(/[^\/]+$/,function(e,t,n){return/[^\/]$/.test(e)?"":e}).replace(/\/+$/,"")+"/";return e},h.getFullUrl=function(e,t){var n=e,r=e.substring(0,1);return t=typeof t=="undefined"?!0:t,/[a-z]+\:\/\//.test(e)||(r==="/"?n=h.getRootUrl()+e.replace(/^\/+/,""):r==="#"?n=h.getPageUrl().replace(/#.*/,"")+e:r==="?"?n=h.getPageUrl().replace(/[\?#].*/,"")+e:t?n=h.getBaseUrl()+e.replace(/^(\.\/)+/,""):n=h.getBasePageUrl()+e.replace(/^(\.\/)+/,"")),n.replace(/\#$/,"")},h.getShortUrl=function(e){var t=e,n=h.getBaseUrl(),r=h.getRootUrl();return h.emulated.pushState&&(t=t.replace(n,"")),t=t.replace(r,"/"),h.isTraditionalAnchor(t)&&(t="./"+t),t=t.replace(/^(\.\/)+/g,"./").replace(/\#$/,""),t},h.getLocationHref=function(e){return e=e||r,e.URL===e.location.href?e.location.href:e.location.href===decodeURIComponent(e.URL)?e.URL:e.location.hash&&decodeURIComponent(e.location.href.replace(/^[^#]+/,""))===e.location.hash?e.location.href:e.URL.indexOf("#")==-1&&e.location.href.indexOf("#")!=-1?e.location.href:e.URL||e.location.href},h.store={},h.idToState=h.idToState||{},h.stateToId=h.stateToId||{},h.urlToId=h.urlToId||{},h.storedStates=h.storedStates||[],h.savedStates=h.savedStates||[],h.normalizeStore=function(){h.store.idToState=h.store.idToState||{},h.store.urlToId=h.store.urlToId||{},h.store.stateToId=h.store.stateToId||{}},h.getState=function(e,t){typeof e=="undefined"&&(e=!0),typeof t=="undefined"&&(t=!0);var n=h.getLastSavedState();return!n&&t&&(n=h.createStateObject()),e&&(n=h.cloneObject(n),n.url=n.cleanUrl||n.url),n},h.getIdByState=function(e){var t=h.extractId(e.url),n;if(!t){n=h.getStateString(e);if(typeof h.stateToId[n]!="undefined")t=h.stateToId[n];else if(typeof h.store.stateToId[n]!="undefined")t=h.store.stateToId[n];else{for(;;){t=(new Date).getTime()+String(Math.random()).replace(/\D/g,"");if(typeof h.idToState[t]=="undefined"&&typeof h.store.idToState[t]=="undefined")break}h.stateToId[n]=t,h.idToState[t]=e}}return t},h.normalizeState=function(e){var t,n;if(!e||typeof e!="object")e={};if(typeof e.normalized!="undefined")return e;if(!e.data||typeof e.data!="object")e.data={};return t={},t.normalized=!0,t.title=e.title||"",t.url=h.getFullUrl(e.url?e.url:h.getLocationHref()),t.hash=h.getShortUrl(t.url),t.data=h.cloneObject(e.data),t.id=h.getIdByState(t),t.cleanUrl=t.url.replace(/\??\&_suid.*/,""),t.url=t.cleanUrl,n=!h.isEmptyObject(t.data),(t.title||n)&&h.options.disableSuid!==!0&&(t.hash=h.getShortUrl(t.url).replace(/\??\&_suid.*/,""),/\?/.test(t.hash)||(t.hash+="?"),t.hash+="&_suid="+t.id),t.hashedUrl=h.getFullUrl(t.hash),(h.emulated.pushState||h.bugs.safariPoll)&&h.hasUrlDuplicate(t)&&(t.url=t.hashedUrl),t},h.createStateObject=function(e,t,n){var r={data:e,title:t,url:n};return r=h.normalizeState(r),r},h.getStateById=function(e){e=String(e);var n=h.idToState[e]||h.store.idToState[e]||t;return n},h.getStateString=function(e){var t,n,r;return t=h.normalizeState(e),n={data:t.data,title:e.title,url:e.url},r=l.stringify(n),r},h.getStateId=function(e){var t,n;return t=h.normalizeState(e),n=t.id,n},h.getHashByState=function(e){var t,n;return t=h.normalizeState(e),n=t.hash,n},h.extractId=function(e){var t,n,r,i;return e.indexOf("#")!=-1?i=e.split("#")[0]:i=e,n=/(.*)\&_suid=([0-9]+)$/.exec(i),r=n?n[1]||e:e,t=n?String(n[2]||""):"",t||!1},h.isTraditionalAnchor=function(e){var t=!/[\/\?\.]/.test(e);return t},h.extractState=function(e,t){var n=null,r,i;return t=t||!1,r=h.extractId(e),r&&(n=h.getStateById(r)),n||(i=h.getFullUrl(e),r=h.getIdByUrl(i)||!1,r&&(n=h.getStateById(r)),!n&&t&&!h.isTraditionalAnchor(e)&&(n=h.createStateObject(null,null,i))),n},h.getIdByUrl=function(e){var n=h.urlToId[e]||h.store.urlToId[e]||t;return n},h.getLastSavedState=function(){return h.savedStates[h.savedStates.length-1]||t},h.getLastStoredState=function(){return h.storedStates[h.storedStates.length-1]||t},h.hasUrlDuplicate=function(e){var t=!1,n;return n=h.extractState(e.url),t=n&&n.id!==e.id,t},h.storeState=function(e){return h.urlToId[e.url]=e.id,h.storedStates.push(h.cloneObject(e)),e},h.isLastSavedState=function(e){var t=!1,n,r,i;return h.savedStates.length&&(n=e.id,r=h.getLastSavedState(),i=r.id,t=n===i),t},h.saveState=function(e){return h.isLastSavedState(e)?!1:(h.savedStates.push(h.cloneObject(e)),!0)},h.getStateByIndex=function(e){var t=null;return typeof e=="undefined"?t=h.savedStates[h.savedStates.length-1]:e<0?t=h.savedStates[h.savedStates.length+e]:t=h.savedStates[e],t},h.getCurrentIndex=function(){var e=null;return h.savedStates.length<1?e=0:e=h.savedStates.length-1,e},h.getHash=function(e){var t=h.getLocationHref(e),n;return n=h.getHashByUrl(t),n},h.unescapeHash=function(e){var t=h.normalizeHash(e);return t=decodeURIComponent(t),t},h.normalizeHash=function(e){var t=e.replace(/[^#]*#/,"").replace(/#.*/,"");return t},h.setHash=function(e,t){var n,i;return t!==!1&&h.busy()?(h.pushQueue({scope:h,callback:h.setHash,args:arguments,queue:t}),!1):(h.busy(!0),n=h.extractState(e,!0),n&&!h.emulated.pushState?h.pushState(n.data,n.title,n.url,!1):h.getHash()!==e&&(h.bugs.setHash?(i=h.getPageUrl(),h.pushState(null,null,i+"#"+e,!1)):r.location.hash=e),h)},h.escapeHash=function(t){var n=h.normalizeHash(t);return n=e.encodeURIComponent(n),h.bugs.hashEscape||(n=n.replace(/\%21/g,"!").replace(/\%26/g,"&").replace(/\%3D/g,"=").replace(/\%3F/g,"?")),n},h.getHashByUrl=function(e){var t=String(e).replace(/([^#]*)#?([^#]*)#?(.*)/,"$2");return t=h.unescapeHash(t),t},h.setTitle=function(e){var t=e.title,n;t||(n=h.getStateByIndex(0),n&&n.url===e.url&&(t=n.title||h.options.initialTitle));try{r.getElementsByTagName("title")[0].innerHTML=t.replace("<","&lt;").replace(">","&gt;").replace(" & "," &amp; ")}catch(i){}return r.title=t,h},h.queues=[],h.busy=function(e){typeof e!="undefined"?h.busy.flag=e:typeof h.busy.flag=="undefined"&&(h.busy.flag=!1);if(!h.busy.flag){u(h.busy.timeout);var t=function(){var e,n,r;if(h.busy.flag)return;for(e=h.queues.length-1;e>=0;--e){n=h.queues[e];if(n.length===0)continue;r=n.shift(),h.fireQueueItem(r),h.busy.timeout=o(t,h.options.busyDelay)}};h.busy.timeout=o(t,h.options.busyDelay)}return h.busy.flag},h.busy.flag=!1,h.fireQueueItem=function(e){return e.callback.apply(e.scope||h,e.args||[])},h.pushQueue=function(e){return h.queues[e.queue||0]=h.queues[e.queue||0]||[],h.queues[e.queue||0].push(e),h},h.queue=function(e,t){return typeof e=="function"&&(e={callback:e}),typeof t!="undefined"&&(e.queue=t),h.busy()?h.pushQueue(e):h.fireQueueItem(e),h},h.clearQueue=function(){return h.busy.flag=!1,h.queues=[],h},h.stateChanged=!1,h.doubleChecker=!1,h.doubleCheckComplete=function(){return h.stateChanged=!0,h.doubleCheckClear(),h},h.doubleCheckClear=function(){return h.doubleChecker&&(u(h.doubleChecker),h.doubleChecker=!1),h},h.doubleCheck=function(e){return h.stateChanged=!1,h.doubleCheckClear(),h.bugs.ieDoubleCheck&&(h.doubleChecker=o(function(){return h.doubleCheckClear(),h.stateChanged||e(),!0},h.options.doubleCheckInterval)),h},h.safariStatePoll=function(){var t=h.extractState(h.getLocationHref()),n;if(!h.isLastSavedState(t))return n=t,n||(n=h.createStateObject()),h.Adapter.trigger(e,"popstate"),h;return},h.back=function(e){return e!==!1&&h.busy()?(h.pushQueue({scope:h,callback:h.back,args:arguments,queue:e}),!1):(h.busy(!0),h.doubleCheck(function(){h.back(!1)}),p.go(-1),!0)},h.forward=function(e){return e!==!1&&h.busy()?(h.pushQueue({scope:h,callback:h.forward,args:arguments,queue:e}),!1):(h.busy(!0),h.doubleCheck(function(){h.forward(!1)}),p.go(1),!0)},h.go=function(e,t){var n;if(e>0)for(n=1;n<=e;++n)h.forward(t);else{if(!(e<0))throw new Error("History.go: History.go requires a positive or negative integer passed.");for(n=-1;n>=e;--n)h.back(t)}return h};if(h.emulated.pushState){var v=function(){};h.pushState=h.pushState||v,h.replaceState=h.replaceState||v}else h.onPopState=function(t,n){var r=!1,i=!1,s,o;return h.doubleCheckComplete(),s=h.getHash(),s?(o=h.extractState(s||h.getLocationHref(),!0),o?h.replaceState(o.data,o.title,o.url,!1):(h.Adapter.trigger(e,"anchorchange"),h.busy(!1)),h.expectedStateId=!1,!1):(r=h.Adapter.extractEventData("state",t,n)||!1,r?i=h.getStateById(r):h.expectedStateId?i=h.getStateById(h.expectedStateId):i=h.extractState(h.getLocationHref()),i||(i=h.createStateObject(null,null,h.getLocationHref())),h.expectedStateId=!1,h.isLastSavedState(i)?(h.busy(!1),!1):(h.storeState(i),h.saveState(i),h.setTitle(i),h.Adapter.trigger(e,"statechange"),h.busy(!1),!0))},h.Adapter.bind(e,"popstate",h.onPopState),h.pushState=function(t,n,r,i){if(h.getHashByUrl(r)&&h.emulated.pushState)throw new Error("History.js does not support states with fragement-identifiers (hashes/anchors).");if(i!==!1&&h.busy())return h.pushQueue({scope:h,callback:h.pushState,args:arguments,queue:i}),!1;h.busy(!0);var s=h.createStateObject(t,n,r);return h.isLastSavedState(s)?h.busy(!1):(h.storeState(s),h.expectedStateId=s.id,p.pushState(s.id,s.title,s.url),h.Adapter.trigger(e,"popstate")),!0},h.replaceState=function(t,n,r,i){if(h.getHashByUrl(r)&&h.emulated.pushState)throw new Error("History.js does not support states with fragement-identifiers (hashes/anchors).");if(i!==!1&&h.busy())return h.pushQueue({scope:h,callback:h.replaceState,args:arguments,queue:i}),!1;h.busy(!0);var s=h.createStateObject(t,n,r);return h.isLastSavedState(s)?h.busy(!1):(h.storeState(s),h.expectedStateId=s.id,p.replaceState(s.id,s.title,s.url),h.Adapter.trigger(e,"popstate")),!0};if(s){try{h.store=l.parse(s.getItem("History.store"))||{}}catch(m){h.store={}}h.normalizeStore()}else h.store={},h.normalizeStore();h.Adapter.bind(e,"unload",h.clearAllIntervals),h.saveState(h.storeState(h.extractState(h.getLocationHref(),!0))),s&&(h.onUnload=function(){var e,t,n;try{e=l.parse(s.getItem("History.store"))||{}}catch(r){e={}}e.idToState=e.idToState||{},e.urlToId=e.urlToId||{},e.stateToId=e.stateToId||{};for(t in h.idToState){if(!h.idToState.hasOwnProperty(t))continue;e.idToState[t]=h.idToState[t]}for(t in h.urlToId){if(!h.urlToId.hasOwnProperty(t))continue;e.urlToId[t]=h.urlToId[t]}for(t in h.stateToId){if(!h.stateToId.hasOwnProperty(t))continue;e.stateToId[t]=h.stateToId[t]}h.store=e,h.normalizeStore(),n=l.stringify(e);try{s.setItem("History.store",n)}catch(i){if(i.code!==DOMException.QUOTA_EXCEEDED_ERR)throw i;s.length&&(s.removeItem("History.store"),s.setItem("History.store",n))}},h.intervalList.push(a(h.onUnload,h.options.storeInterval)),h.Adapter.bind(e,"beforeunload",h.onUnload),h.Adapter.bind(e,"unload",h.onUnload));if(!h.emulated.pushState){h.bugs.safariPoll&&h.intervalList.push(a(h.safariStatePoll,h.options.safariPollInterval));if(i.vendor==="Apple Computer, Inc."||(i.appCodeName||"")==="Mozilla")h.Adapter.bind(e,"hashchange",function(){h.Adapter.trigger(e,"popstate")}),h.getHash()&&h.Adapter.onDomLoad(function(){h.Adapter.trigger(e,"hashchange")})}},(!h.options||!h.options.delayInit)&&h.init()}(window)
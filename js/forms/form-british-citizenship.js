/**
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

    /**
     * 5. Form validation
     * */
    $(button).on('click',function(){
        var form = $(formName);

        /**
         * Included custom form validation methods from methods.js
         * */
        formMethods();


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
                /* Form Step One */
                "certificate-day":{
                    digits:true

                },
                "certificate-month":{
                    digits:true
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
                    email:true,
                    advEmail:true
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
                    digits: "Only digits"
                },
                "certificate-month":{
                    required: "Month",
                    digits: "Only digits"

                },
                "certificate-year":{
                    required: "Year",
                    digits: "Only digits",
                    exactLength:"Four digits"
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
                "preferred-contact":{
                    required: "Please select one option"
                }
            }
        });

        /**
         * 5.3 If form is valid do following things
         * */

        if (form.valid() === true){

            /**
             * 5.3.1 If form step 1 is visible
             * */
            if ($(formStepOne).is(":visible")){
                current_fs = $(formStepOne);
                next_fs = $(formStepTwo);

                /* Show progress bar */
                $('.arrow-steps li:nth-child(2)').addClass("current");

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
                $(submit).prop('disabled', false);
            }

            next_fs.show();
            current_fs.hide();

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
    $(buttonBack, formStepTwo).on('click', function() {
        $(formStepOne).show();
        $(formStepTwo).hide();
        $('.arrow-steps li:nth-child(2)').removeClass("current");
        $('.arrow-steps li:nth-child(3)').removeClass("current");
    });

    /**
     * 8. Back button on step three
     * */
    $(buttonBack, formStepThree).on('click', function() {
        $(formStepTwo).show();
        $(formStepThree).hide();
        $('.arrow-steps li:nth-child(3)').removeClass("current");
    });
};



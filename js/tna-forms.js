/**
 * THE NATIONAL ARCHIVES
 * ------------------------------------------------------------------------------
 * Form JQuery validation for HTML
 * ------------------------------------------------------------------------------
 */

(function ($) {

    $.fn.firstStepValidation = function () {

        /*// ID's of all required fields
         required = ["forename", "surname"];

         // The text to show up within a field when it is incorrect
         emptyerror = "Please fill out this field.";
         emailerror = "Please enter a valid e-mail.";

         //Validate required fields
         for (var i=0;i<required.length;i++) {

         var input = $('#' + required[i]),
         error = $('.error.form-hint');

         if ((input.val() == "") || (input.val() == emptyerror)) {
         input.addClass('warning');
         error.css('display','block');
         } else {
         input.removeClass("warning");
         error.css('display','none');
         }
         }*/

    };


    $.isEmail = function (str) {
        return (/^[\w.%+\-]+@[\w.\-]+\.[A-Za-z]{2,6}$/.test(str));
    };

    var emailWrapper = '.email-wrapper',
        addressWrapper = '.address-wrapper',
        contactEmail = '#contact-email',
        contactPostal = '#contact-postal',
        formStepOne = '.form-step-1',
        formStepTwo = '.form-step-2',
        formStepThree = '.form-step-3',
        button = '.button',
        buttonBack = '.button-back';


    $(emailWrapper).hide();
    $(addressWrapper).hide();
    $(formStepTwo).hide();
    $(formStepThree).hide();

    /* Show / hide Email / address */
    $('input[type="radio"]').on('click', function(){
        if ($(contactEmail).is(':checked')){

            $(emailWrapper).show();
            $(addressWrapper).hide();

        } else if ($(contactPostal).is(':checked')) {

            $(addressWrapper).show();
            $(emailWrapper).hide();
        }
    });



    $(button, formStepOne).on('click', function() {
        $(formStepTwo).show();
        $(formStepOne).hide();
    });

    $(button, formStepTwo).on('click', function() {
        $(formStepThree).show();
        $(formStepTwo).hide();
    });

    $(buttonBack, formStepTwo).on('click', function() {
        $(formStepOne).show();
        $(formStepTwo).hide();
    });

    $(buttonBack, formStepThree).on('click', function() {
        $(formStepTwo).show();
        $(formStepThree).hide();
    });





}(jQuery));

$('#naturalisation').firstStepValidation();




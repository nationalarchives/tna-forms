/**
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

        else {
            defaultForm();
        }

    }());
});



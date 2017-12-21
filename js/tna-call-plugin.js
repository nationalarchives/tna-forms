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
        else if ($('#apply-for-training').is(':visible')) {
            applyForTrainingForm();
        }
        else {
            defaultForm();
        }
    }());
});



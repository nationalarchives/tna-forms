function formMethods(){
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


    /** Advance email validation method
     * */
    $.validator.addMethod("advEmail",
        function(value, element) {
            return this.optional( element ) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
        },
        "Please insert a valid email address"
    );
}


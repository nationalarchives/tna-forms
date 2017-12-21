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


    /** Custom email message
     * */
    $.extend($.validator.messages, {
        email: "Please enter a valid email address"
    });

    /**
     * Custom regex for email validation
     * */
    $.validator.addMethod("email", function(value, element) {
        return this.optional(element) || /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);
    }, "Please enter a valid email address");

    $.validator.addMethod("telNumber", function(value, element) {
        return this.optional(element) || /(\d)\w+/i.test(value);
    }, "Please enter a valid telephone number");
}


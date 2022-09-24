$(document).ready( function () {
    //initializing datepickers with required format
    $('#start_date').datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $('#end_date').datepicker({
        dateFormat: 'yy-mm-dd'
    });


});
//client side validations
$(function () {
    $.validator.addMethod('dateBefore', function (value, element, params) {
        // if end date is valid, validate it as well
        var end = $(params);
        if (!end.data('validation.running')) {
            $(element).data('validation.running', true);
            setTimeout($.proxy(

                function () {
                    this.element(end);
                }, this), 0);
            // Ensure clearing the 'flag' happens after the validation of 'end' to prevent endless looping
            setTimeout(function () {
                $(element).data('validation.running', false);
            }, 0);
        }
        return this.optional(element) || this.optional(end[0]) || new Date(value) <= new Date(end.val());

    }, 'Must be before corresponding end date');

    $.validator.addMethod('dateAfter', function (value, element, params) {
        // if start date is valid, validate it as well
        var start = $(params);
        if (!start.data('validation.running')) {
            $(element).data('validation.running', true);
            setTimeout($.proxy(

                function () {
                    this.element(start);
                }, this), 0);
            setTimeout(function () {
                $(element).data('validation.running', false);
            }, 0);
        }
        return this.optional(element) || this.optional(start[0]) || new Date(value) >= new Date($(params).val());

    }, 'Must be after corresponding start date');

    $('#historical-data-form').validate({
        rules: {
            company_symbol: {
                required: true
            },
            start_date:{
                dateBefore: '#end_date',
                required: true
            },
            end_date:{
                dateAfter: '#start_date',
                required: true
            },
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            company_symbol: {
                required: "Company Symbol is required",
            },
            start_date: {
                dateBefore: "Start Date should be before End Date",
                required: "Start Date is required"
            },
            end_date: {
                dateAfter: "End Date should be after Start Date",
                required: "End Date is required"
            },
            email: {
                required: "Email is required",
                email: "Email must be a valid email address"
            }
        }
    });
});

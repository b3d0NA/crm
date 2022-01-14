$(function () {
    "use strict";
    $(function () {
        // validate signup form on keyup and submit
        $("#signupForm").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                },
                password: {
                    required: true,
                    minlength: 5,
                },
                confirm_password: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password",
                },
                email: {
                    required: true,
                    email: true,
                },
                topic: {
                    required: "#newsletter:checked",
                    minlength: 2,
                },
                agree: "required",
            },
            messages: {
                name: {
                    required: "Please enter a name",
                    minlength: "Name must consist of at least 3 characters",
                },
                password: {
                    required: "Please provide a password",
                    minlength:
                        "Your password must be at least 5 characters long",
                },
                confirm_password: {
                    required: "Please provide a password",
                    minlength:
                        "Your password must be at least 5 characters long",
                    equalTo: "Please enter the same password as above",
                },
                email: "Please enter a valid email address",
            },
            errorPlacement: function (label, element) {
                label.addClass("mt-1 tx-13 text-danger");
                label.insertAfter(element);
            },
            highlight: function (element, errorClass) {
                $(element).parent().addClass("validation-error");
                $(element).addClass("border-danger");
            },
        });

        $("#claimForm").validate({
            rules: {
                customerName: {
                    required: true,
                    minlength: 2,
                },
                email: {
                    required: true,
                    email: true,
                },
                registeredBy: {
                    required: true,
                    minlength: 2,
                },
                email: {
                    required: true,
                    email: true,
                },
                quantity: {
                    required: true,
                    number: true,
                },
                serialNumber: {
                    required: true,
                },
                purchasedDateInp: {
                    required: true,
                    dateISO: true,
                },
                customerInvoiceNumber: {
                    required: true,
                    number: true,
                },
                failureType: {
                    required: true,
                },
                problemDescription: {
                    required: true,
                    min: 3,
                },
                customerOrderDate: {
                    required: true,
                    dateISO: true,
                },
            },
            messages: {
                customerName: {
                    required: "Please enter a name",
                    minlength: "Name must consist of at least 2 characters",
                },
                email: {
                    required: "Please enter your email address",
                    email: "Please enter a valid email address",
                },
                registeredBy: {
                    required: "Please enter a name",
                    minlength: "Name must consist of at least 2 characters",
                },
                quantity: {
                    required: "Please enter quantity",
                    number: "Quantity must be number",
                },
                serialNumber: {
                    required: "Please enter serial number",
                },
                purchasedDateInp: {
                    required: "Please select a purchased date",
                    dateISO: "Please select a valid date",
                },
                customerInvoiceNumber: {
                    required: "Please enter invoice number",
                    number: "It must be a number",
                },
                failureType: {
                    required: "Please select failure type",
                },
                problemDescription: {
                    required: "Please write your problem description",
                    min: "Description must consist of at least 3 chaarcter",
                },
                customerOrderDate: {
                    required: "Please select a order date",
                    dateISO: "Please select a valid date",
                },
            },
            errorPlacement: function (label, element) {
                label.addClass("mt-1 tx-13 text-danger");
                label.insertAfter(element);
            },
            highlight: function (element, errorClass) {
                $(element).parent().addClass("validation-error");
                $(element).addClass("border-danger");
            },
        });
    });
});

$(function () {
    "use strict";
    var date = new Date();
    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
    if ($("#orderDatePicker").length) {
        $("#orderDatePicker").datepicker({
            format: "yyyy-m-d",
            todayHighlight: true,
            autoclose: true,
        });
        $("#orderDatePicker").datepicker("setDate", today);
    }
    if ($("#purhcasedDate").length) {
        $("#purhcasedDate").datepicker({
            format: "yyyy-m-d",
            todayHighlight: true,
            autoclose: true,
        });
        $("#purhcasedDate").datepicker("setDate", today);
    }
});

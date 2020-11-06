/*!
    * Start Bootstrap - Grayscale v6.0.2 (https://startbootstrap.com/themes/grayscale)
    * Copyright 2013-2020 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-grayscale/blob/master/LICENSE)
    */
    (function ($) {
    "use strict"; // Start of use strict

    // Smooth scrolling using jQuery easing
    $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function () {
        if (
            location.pathname.replace(/^\//, "") ==
                this.pathname.replace(/^\//, "") &&
            location.hostname == this.hostname
        ) {
            var target = $(this.hash);
            target = target.length
                ? target
                : $("[name=" + this.hash.slice(1) + "]");
            if (target.length) {
                $("html, body").animate(
                    {
                        scrollTop: target.offset().top - 70,
                    },
                    1000,
                    "easeInOutExpo"
                );
                return false;
            }
        }
    });

    // Closes responsive menu when a scroll trigger link is clicked
    $(".js-scroll-trigger").click(function () {
        $(".navbar-collapse").collapse("hide");
    });

    // Activate scrollspy to add active class to navbar items on scroll
    $("body").scrollspy({
        target: "#mainNav",
        offset: 100,
    });

    // Collapse Navbar
    var navbarCollapse = function () {
        if ($("#mainNav").offset().top > 100) {
            $("#mainNav").addClass("navbar-shrink");
        } else {
            $("#mainNav").removeClass("navbar-shrink");
        }
    };
    // Collapse now if page is not at top
    navbarCollapse();
    // Collapse the navbar when page is scrolled
    $(window).scroll(navbarCollapse);

    /*Datatable part*/
    let dataTable = $('#dataTable').DataTable();

    $.ajax({
        type: "get",
        url: "/getValues",
        dataType: "json",
        success: function (values) {
            $.each(values, function (key, obj) {
                addRow(dataTable,obj);
            });
        },
        error: function (data) {
            alert('Error getting existing data');
        }
    });

    $.ajax({
        type: "get",
        url: "/getCurrencies",
        dataType: "json",
        success: function (values) {
            if(values.status){
                $.each(values.currencies, function (key, obj) {
                    $("select").append('<option value='+obj.value+'>'+obj.label+'</option>');
                });
            }else{
                alert('Error getting currencies');
            }
        },
        error: function (data) {
            alert('Error getting existing data');
        }
    });
 
    $('#addValue').on( 'click', function () {
        if($("#amount").val() == ""){
            alert('Input a value');
        }else{
            $("#addValue").attr('disabled','disabled');
            $.ajax({
                type: "POST",
                url: "/convert",
                data: {
                    initialCurrency :  $("#initial_currency").val(),
                    finalCurrency : $("#final_currency").val(),
                    initialValue : $("#amount").val()
                },
                async: true,
                success: function (result) {
                    if(result.status){
                        save(result.final_value,dataTable);
                    }else{
                        alert('Error converting value');
                    }
                },
                error: function (data) {
                    alert('Error converting value');
                }
            });
        }
    });

    $("#amount").maskMoney({thousands:'', decimal:'.'});
    $('select').select2();

})(jQuery); // End of use strict

function save(final_value, dt){
    let object = {
        initialCurrency :  $("#initial_currency").val(),
        finalCurrency : $("#final_currency").val(),
        initialValue : $("#amount").val(),
        finalValue : final_value
    };

    $("#amount").val('');

    $.ajax({
        type: "POST",
        url: "/save",
        data: object,
        success: function (result) {
            if(result.status){
                addRow(dt,object);
                $("#addValue").removeAttr('disabled');
            }else{
                alert('Error saving values');
            }
        },
        error: function (data) {
            alert('Error saving values');
        }
    });
}

function addRow(dataTable,object){
    dataTable.row.add( [
        object.initialCurrency,
        object.finalCurrency,
        object.initialValue,
        object.finalValue
    ] ).draw( false );
}
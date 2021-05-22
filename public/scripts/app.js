function numberFormat(numberString) {
    numberString += '';
    var x = numberString.split('.'),
        x1 = x[0],
        x2 = x.length > 1 ? ',' + x[1] : '',
        rgxp = /(\d+)(\d{3})/;

    while (rgxp.test(x1)) {
        x1 = x1.replace(rgxp, '$1' + ' ' + '$2');
    }

    return x1 + x2;
}

$(function () {

    var topButtonDisplay;

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-tooltip="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })


    // Example starter JavaScript for disabling form submissions if there are invalid fields
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })




    $('#profilButton').on('click', function (event) {
        $('.dropdown-menu').toggleClass('show');
    });


    $(window).scroll(function () {
        // Az oldal tetejére gomb
        topButtonDisplay = $(this).scrollTop() > 500 ? "block" : "none";
        $("#topButton").css("display", topButtonDisplay);

        // Az oldalsó menü követi a görgetést
        if ($(this).scrollTop() < $("#left").height() - $("#sideCategory").height() + ($("#left").offset().top - 60)) {

            $("#sideCategory")
                .addClass("sticky-top")
                .css("top", "60px");
        } else {
            $('#sideCategory')
                .removeClass("sticky-top")
                .css("top", ($("#left").height() - $("#sideCategory").height()) > 0 ? $("#left").height() - $("#sideCategory").height() : "0");
        }
    });

    $('#topButton').on('click', function (e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        });
    });

    if ($("#shipping_same").prop('checked')) {
        $("#shippingData :input").each(function () {
            $(this).attr("disabled", "disabled");
        });
    } else {
        $("#shippingData :input").each(function () {
            $(this).removeAttr("disabled");
        });
    }

    if ($("#is_company").prop('checked')) {
        $("#taxnumDiv").show();
        $("#taxnum").removeAttr("disabled");
    }
    else {
        $("#taxnumDiv").hide();
        $("#taxnum").attr("disabled", "disabled");
    }


    $(document)
        .on("click", function (e) {
            if (!$('div.dropdown').is(e.target)
                && $('div.dropdown').has(e.target).length === 0
                && $('.show').has(e.target).length === 0
            ) {
                $('div.dropdown-menu').removeClass('show');
            }
        })
        .on('click', '#is_company', function () {
            $("#taxnumDiv").fadeIn(500);
            $("#taxnum").removeAttr("disabled");
        })
        .on('click', '#is_person', function () {
            $("#taxnumDiv").fadeOut(500);
            $("#taxnum").attr("disabled", "disabled");
        })
        .on('click', '#shipping_same', function () {
            $("#shippingData").fadeToggle(500);
            if ($("#shipping_same").prop('checked')) {
                $("#shippingData :input").each(function () {
                    $(this).attr("disabled", "disabled");
                });
            } else {
                $("#shippingData :input").each(function () {
                    $(this).removeAttr("disabled");
                });

            }

            $("#shipping_name").val($("#billing_name").val());
            $("#shipping_city").val($("#billing_city").val());
            $("#shipping_address").val($("#billing_address").val());
            $("#shipping_zip").val($("#billing_zip").val());
        }
        )
        .on('submit', '#regForm', function () {
        })

        // Termék szűrő
        .on('input', '#minPrice', function () {
            $('#minPrice_value').html(numberFormat($(this).val()) + " Ft.");
        })
        .on('input', '#maxPrice', function () {
            $('#maxPrice_value').html(numberFormat($(this).val()) + " Ft.");
        })

        .on('click', '#resetButton', function () {
            $(".form-check-input").removeAttr("checked");
        })
        .on('submit', '#productFilter', function () {
            $(this).find(":input").filter(function () {
                return !this.value;
            }).attr("disabled", "disabled");
        });



});
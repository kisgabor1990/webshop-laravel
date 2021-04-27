$(function () {

    function topFunction() {
        $("html").stop().animate({
            scrollTop: 0
        }, ($(window).scrollTop() * 0.5));
        return false;
    }

    var confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));

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
        if ($(window).scrollTop() > 500) {
            $("#topButton").css("display", "block");
        } else {
            $("#topButton").css("display", "none");
        }

        // Az oldalsó menü követi a görgetést
        if ($(window).scrollTop() < $("#mainContent").height() + 10) {

            $("#sideCategory")
                .addClass("sticky-top")
                .css("top", "60px");
        } else {
            $('#sideCategory')
                .removeClass("sticky-top")
                .css("top", ($("#mainContent").height() - $("#sideCategory").height()) > 0 ? $("#mainContent").height() - $("#sideCategory").height() : "0");
        }
    });

    $("#topButton").click(function (e) {
        e.preventDefault();
        topFunction();
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

    $(document)
        .on("click", function (e) {
            if (!$('div.dropdown').is(e.target)
                && $('div.dropdown').has(e.target).length === 0
                && $('.show').has(e.target).length === 0
            ) {
                $('.dropdown-menu').removeClass('show');
            }
        })
        .on('click', '#is_company', function () {
            $("#taxnum").fadeIn(500);
            $("#billing_taxnum").removeAttr("disabled");
        })
        .on('click', '#is_person', function () {
            $("#taxnum").fadeOut(500);
            $("#billing_taxnum").attr("disabled", "disabled");
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
        .on('click', '#resetButton', function () {
            $(".form-check-input").removeAttr("checked");
        })
        .on('submit', '#productFilter', function () {
            $(this).find(":input").filter(function () {
                return !this.value;
            }).attr("disabled", "disabled");
        })

    // Confirm Modal

    .on("click", ".table .delete", function (e) {
        e.preventDefault();
        $("#confirmModal a.delete")
            .data("href", $(this).data("href"))
            .data("header", $(this).data("header"))
            .data("name", $(this).data("name"))
            .data("email", $(this).data("email"));
        $("#confirmModal .modal_header").html($(this).data("header"));
        $("#confirmModal .name").html($(this).data("name"));
        $("#confirmModal .email").html($(this).data("email"));
        confirmModal.show();
    });

    $("#confirmModal a.delete").click(function (e) {
        e.preventDefault();
        confirmModal.hide();
        window.location.replace($(this).data("href"));
    });

});
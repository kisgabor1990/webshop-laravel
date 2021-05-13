$(function () {

    function topFunction() {
        $("html").stop().animate({
            scrollTop: 0
        }); // , ($(window).scrollTop() * 0.5) Ha a bootstrap 5 is úgy akarja....
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
            .data("id", $(this).data("id"))
            .data("name", $(this).data("name"))
            .data("user", $(this).data("user"))
            .data("address", $(this).data("address"))
            .data("brand", $(this).data("brand"))
            .data("category", $(this).data("category"))
            .data("email", $(this).data("email"));
        $("#confirmModal .modal_header").html($(this).data("header"));
        $("#confirmModal .id").html($(this).data("id"));
        $("#confirmModal .name").html($(this).data("name"));
        $("#confirmModal .user").html($(this).data("user"));
        $("#confirmModal .address").html($(this).data("address"));
        $("#confirmModal .email").html($(this).data("email"));
        $("#confirmModal .brand").html($(this).data("brand"));
        $("#confirmModal .category").html($(this).data("category"));
        confirmModal.show();
    });

    $("#confirmModal a.delete").click(function (e) {
        e.preventDefault();
        confirmModal.hide();
        window.location.replace($(this).data("href"));
    });

    // Admin - Tulajdonságok létrehozása, értékekkel
    
    if ($("#add_values").prop("checked")) {
        $("div#values").fadeIn(500);
        $("fieldset").removeAttr("disabled");
    } else {
        $("div#values").fadeOut(500);
        $("fieldset").attr("disabled", "disabled");
    }

    $("#add_values").click(function () {
        if ($("#add_values").prop("checked")) {
            $("div#values").fadeIn(500);
            $("fieldset").removeAttr("disabled");
        } else {
            $("div#values").fadeOut(500);
            $("fieldset").attr("disabled", "disabled");
        }
    });
 
    let value_count = 0;
    
    $("#add_value").click(function (e) {
        e.preventDefault();
        value_count++;
        let input_field =   '<div class="input-group mb-5 value'+ value_count +'">'
                            + '<div class="col form-floating position-relative">'
                            + '<input type="tel" class="form-control" name="values[]" placeholder="Érték" required>'
                            + '<label>Érték</label>'
                            + '<div class="invalid-tooltip">'
                            + 'Az érték megadása kötelező!'
                            + '</div>'
                            + '</div>'
                            + '<div class="input-group-prepend d-flex align-items-stretch">'
                            + '<div class="input-group-text" id="btnGroupAddon">'
                            + '<a class="btn btn-danger btn-sm remove_value" data-id="value'+ value_count +'" href="#" role="button">'
                            + '<i class="fa fa-minus" aria-hidden="true"></i>'
                            + '</a>'
                            + '</div>'
                            + '</div>'
                            + '</div>"';

        $(input_field).appendTo("#values");
        $(".value"+value_count+" input").val("");
    });

    $("#maincontent").on('click', 'a.remove_value', function (e) {
        e.preventDefault();
        let id = $(this).data("id");
        $("."+id).remove();
    });

});
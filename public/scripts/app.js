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
        if ($(this).scrollTop() > 500) {
            $("#topButton").fadeIn();
        } else {
            $("#topButton").fadeOut();
        }

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
        $('html, body').scrollTop(0);
    });

    if ($("#is_company").prop('checked')) {
        $("#taxnumDiv").show();
        $("#taxnum").removeAttr("disabled");
    }
    else {
        $("#taxnumDiv").hide();
        $("#taxnum").attr("disabled", "disabled");
    }

    if ($("#shipping_same").prop('checked')) {
        $("#billing_name, #shipping_name").on("input", function () {
            if ($("#shipping_same").prop('checked')) {
                $("#shipping_name").val(this.value);
                $("#billing_name").val(this.value);
            }
        });
        $("#billing_city, #shipping_city").on("input", function () {
            if ($("#shipping_same").prop('checked')) {
                $("#shipping_city").val(this.value);
                $("#billing_city").val(this.value);
            }
        });
        $("#billing_address, #shipping_address").on("input", function () {
            if ($("#shipping_same").prop('checked')) {
                $("#shipping_address").val(this.value);
                $("#billing_address").val(this.value);
            }
        });
        $("#billing_address2, #shipping_address2").on("input", function () {
            if ($("#shipping_same").prop('checked')) {
                $("#shipping_address2").val(this.value);
                $("#billing_address2").val(this.value);
            }
        });
        $("#billing_zip, #shipping_zip").on("input", function () {
            if ($("#shipping_same").prop('checked')) {
                $("#shipping_zip").val(this.value);
                $("#billing_zip").val(this.value);
            }
        });
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
            if ($("#shipping_same").prop('checked')) {
                $("#shipping_name").val($("#billing_name").val());
                $("#shipping_city").val($("#billing_city").val());
                $("#shipping_address").val($("#billing_address").val());
                $("#shipping_address2").val($("#billing_address2").val());
                $("#shipping_zip").val($("#billing_zip").val());

                $("#billing_name, #shipping_name").on("input", function () {
                    if ($("#shipping_same").prop('checked')) {
                        $("#shipping_name").val(this.value);
                        $("#billing_name").val(this.value);
                    }
                });
                $("#billing_city, #shipping_city").on("input", function () {
                    if ($("#shipping_same").prop('checked')) {
                        $("#shipping_city").val(this.value);
                        $("#billing_city").val(this.value);
                    }
                });
                $("#billing_address, #shipping_address").on("input", function () {
                    if ($("#shipping_same").prop('checked')) {
                        $("#shipping_address").val(this.value);
                        $("#billing_address").val(this.value);
                    }
                });
                $("#billing_address2, #shipping_address2").on("input", function () {
                    if ($("#shipping_same").prop('checked')) {
                        $("#shipping_address2").val(this.value);
                        $("#billing_address2").val(this.value);
                    }
                });
                $("#billing_zip, #shipping_zip").on("input", function () {
                    if ($("#shipping_same").prop('checked')) {
                        $("#shipping_zip").val(this.value);
                        $("#billing_zip").val(this.value);
                    }
                });
            }

        }
        )
        .on('submit', '#regForm', function () {
        })
        .on('click', '#addToCartButton', function () {
            let this_r = $(this);

            $.get(this_r.data('href'), function (data) {
                let cart_quantity = Number($('.cart_quantity').html());
                let cart_price = Number($('.cart_price').html().replace(/\s+/g, ''));
                if (cart_quantity == 0) {
                    $('nav .cart_quantity').removeClass('d-none').addClass('d-inline');
                }
                $('.cart_quantity').html(cart_quantity + 1);
                $('.cart_price').html(numberFormat(cart_price + Number(data.price)));
                var myModal = new bootstrap.Modal(document.getElementById('addToCartSuccess'))
                myModal.show();
                setTimeout(function () {
                    myModal.hide();
                }, 1500)
            });
        })
        .on('click', '.cart-increase', function () {
            let this_r = $(this);

            $.get(this_r.data('href'), function (data) {
                let cart_quantity = Number($('.cart_quantity').html());
                let cart_price = Number($('.cart_price').html().replace(/\s+/g, ''));
                let cart_total_price = Number($('.cart_total_price').html().replace(/\s+/g, ''));
                let product_total_price = Number($('.product' + this_r.data('id') + ' .product_total_price').html().replace(/\s+/g, ''));
                $('.cart_quantity').html(cart_quantity + 1);
                $('.cart_price').html(numberFormat(cart_price + Number(data.price)));
                $('.cart_total_price').html(numberFormat(cart_total_price + Number(data.price)));
                $('.product' + this_r.data('id') + ' .product_total_price').html(numberFormat(product_total_price + Number(data.price)));
                $('.product' + this_r.data('id') + ' input').attr('value', data.quantity);
            });
        })
        .on('click', '.cart-decrease', function () {
            let this_r = $(this);

            $.get(this_r.data('href'), function (data) {
                let cart_quantity = Number($('.cart_quantity').html());
                let cart_price = Number($('.cart_price').html().replace(/\s+/g, ''));
                let cart_total_price = Number($('.cart_total_price').html().replace(/\s+/g, ''));
                let product_total_price = Number($('.product' + this_r.data('id') + ' .product_total_price').html().replace(/\s+/g, ''));
                if (cart_quantity == 1) {
                    $('nav .cart_quantity').removeClass('d-inline').addClass('d-none');
                }
                $('.cart_quantity').html(cart_quantity - 1);
                $('.cart_price').html(numberFormat(cart_price - Number(data.price)));
                $('.cart_total_price').html(numberFormat(cart_total_price - Number(data.price)));
                if (data.quantity > 0) {
                    $('.product' + this_r.data('id') + ' .product_total_price').html(numberFormat(product_total_price - Number(data.price)));
                    $('.product' + this_r.data('id') + ' input').attr('value', data.quantity);
                } else {
                    $('.product' + this_r.data('id')).fadeOut(500, function () {
                        $(this).remove();
                        if ($("#products").children('div').length == 0) {
                            $('hr').remove();
                            $('#orderButtonDiv').remove();
                            $('#products').html('<p class="h3 text-center">A kosár üres!</p>');
                            $('#cart_header').html('');
                            $('#cart_footer').html('');
                        }
                    });
                }
            });
        })
        .on('click', '.removeFromCart', function () {
            let this_r = $(this);

            $.get(this_r.data('href'), function () {
                let cart_quantity = Number($('.cart_quantity').html());
                let cart_price = Number($('.cart_price').html().replace(/\s+/g, ''));
                let cart_total_price = Number($('.cart_total_price').html().replace(/\s+/g, ''));
                let product_total_quantity = Number($('.product' + this_r.data('id') + ' input').attr('value'));
                let product_total_price = Number($('.product' + this_r.data('id') + ' .product_total_price').html().replace(/\s+/g, ''));
                if (cart_quantity - product_total_quantity == 0) {
                    $('nav .cart_quantity').removeClass('d-inline').addClass('d-none');
                }
                $('.cart_quantity').html(cart_quantity - product_total_quantity);
                $('.cart_price').html(numberFormat(cart_price - product_total_price));
                $('.cart_total_price').html(numberFormat(cart_total_price - product_total_price));
                $('.product' + this_r.data('id')).fadeOut(500, function () {
                    $(this).remove();
                    if ($("#products").children('div').length == 0) {
                        $('hr').remove();
                        $('#orderButtonDiv').remove();
                        $('#products').html('<p class="h3">A kosár üres!</p>');
                        $('#cart_header').html('');
                        $('#cart_footer').html('');
                    }
                });
            });
        })
        .on('click', '.cartButton', function () {
            let this_r = $(this);
            $.get(this_r.data("href"), function (data) {
                $("#offcanvasCart .offcanvas-body").html(data);
            });
        })

        // Termék szűrő
        .on('input', '#minPrice', function () {
            $('#minPrice_value').html(numberFormat($(this).val()) + " Ft.");
            $('#maxPrice').attr('min', $('#minPrice').val());
        })
        .on('input', '#maxPrice', function () {
            $('#maxPrice_value').html(numberFormat($(this).val()) + " Ft.");
            $('#minPrice').attr('max', $('#maxPrice').val());
        })

        .on('click', '#resetButton', function (e) {
            e.preventDefault();
            $('#minPrice').val(0);
            $('#minPrice_value').html("0 Ft.");
            $('#maxPrice').val($('#maxPrice').attr('max'));
            $('#maxPrice').attr('min', 0);
            $('#minPrice').attr('max', $('#maxPrice').val());
            $('#maxPrice_value').html(numberFormat($('#maxPrice').attr('max')) + " Ft.");
            $('input:checkbox').prop('checked', false);
        })
        .on('submit', '#productFilter', function () {
            if ($('#minPrice').val() == 0 && $('#maxPrice').val() == $('#maxPrice').attr('max')) {
                $('#minPrice').prop('disabled', true);
                $('#maxPrice').prop('disabled', true);
            }
        })

        // infoModal
        .on('click', '.info', function () {
            let this_r = $(this);
            $("#infoModal .modal-body").html("");
            $("#infoModal .modal-title").html(this_r.html());
            $.get(this_r.data("href"), function (data) {
                $("#infoModal .modal-body").html(data);
            })
        });

});

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

        
    // Admin - Tulajdonságok létrehozása, értékekkel // Kategóriák alkategóriákkal
    
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
    // --------------------------------------------------------- //

    $("#listProducts").DataTable({
        "order": [[1, 'asc'], [2, 'asc']],
        "language": {
            url: "http://cdn.datatables.net/plug-ins/1.10.24/i18n/Hungarian.json"
        }
    });
    $("#list").DataTable({
        "language": {
            url: "http://cdn.datatables.net/plug-ins/1.10.24/i18n/Hungarian.json"
        }
    });
})
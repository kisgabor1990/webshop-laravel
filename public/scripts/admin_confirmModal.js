$(function () {
    
    var confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));

    $(document)

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

})
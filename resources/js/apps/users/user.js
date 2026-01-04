let tableUrl = $("#table-url").val();

// datatable
$("#table").DataTable({
    order: [[0, 'desc']],
    ordering: true,
    serverSide: true,
    processing: true,
    autoWidth: false,
    responsive: true,
    ajax: {
        url: tableUrl,
    },
    columns: [
        { data: "updated_at", name: "updated_at", className: "d-none"},
        {
            data: "DT_RowIndex",
            name: "DT_RowIndex",
            width: "40px",
            orderable: false,
            searchable: false,
        },
        { data: "name", name: "name", orderable: true, searchable: true},
        { data: "email", name: "email", orderable: true, searchable: true},
        { data: "opsi", name: "opsi", orderable: false, searchable: false },
    ],
    columnDefs: [
        { responsivePriority: 1, targets: 0 },
        { responsivePriority: 2, targets: 1 },
        { responsivePriority: 3, targets: 3 },
    ],
});

$("#btn-add").click(function () {
    $("#modal-user").modal('show');
    $(".modal-title").empty().append("Add New User");
    $(".password-label").append(` <span style="color:red">*</span>`);
    $('#user_id').val(null).trigger('change');
    resetValidation();
});

$(".btn-close").click(function () {
    $(".password-label span").remove();
});

// submit form
$("#form-user").submit(function (e) {
    e.preventDefault();

    let id = $("#id").val();
    let formData = new FormData(this);
    let btn = "#btn-submit";
    let table = "#table";
    let form = "#form-user";
    let modal = "#modal-user";

    if (id !== "") {
        var url = $("#update-url").val();
    } else {
        var url = $("#create-url").val();
    }

    // send data
    ajaxPost(url, formData, btn).done(function (res) {
        notifySuccess(res.message);
        reloadTable(table);
        $(modal).modal("hide");
        $(form)[0].reset();
    });
});

// edit
$("#table").on("click", ".edit", function () {
    let id = $(this).data("id");
    let url = $("#edit-url").val();
    url = url.replace(":id", id);

    ajaxGet(url).done(function (res) {
        $(".modal-title").empty().append("Edit User");
        $("#id").val(res.data.id);
        $("#name").val(res.data.name);
        $("#email").val(res.data.email);
        $(".password-label span").remove();
        $("#user_id").val(res.data.user_id).trigger('change');

        $("#modal-user").modal("show");
        resetValidation();
    });
});

$("#table").on("click", ".delete", function () {
    let id = $(this).data("id");
    let url = $("#delete-url").val();
    let table = "#table";

    ajaxDel(url, id, false, 'sweetSuccess', table);
});

function resetValidation() {
    $(".form-control").removeClass("is-invalid");
    $(".form-select").removeClass("is-invalid");
}

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
        { data: "updated_at", name: "updated_at", className: "d-none" },
        {
            data: "DT_RowIndex",
            name: "DT_RowIndex",
            width: "40px",
            orderable: false,
            searchable: false,
        },
        { data: "name", name: "name", orderable: true, searchable: true},
        { data: "is_active", name: "is_active", orderable: false, searchable: false},
        { data: "opsi", name: "opsi", width: "80px", orderable: false, searchable: false },
    ],
    columnDefs: [
        { responsivePriority: 1, targets: 0 },
        { responsivePriority: 2, targets: 1 },
        { responsivePriority: 3, targets: 2 },
    ],
});

$("#btn-add").click(function () {
    $("#modal-category").modal('show');
    $(".modal-title").empty().append("Add Category");
    resetValidation();
});

// submit form
$("#form-category").submit(function (e) {
    e.preventDefault();

    let id = $("#id").val();
    let formData = new FormData(this);
    let btn = "#btn-submit";
    let table = "#table";
    let form = "#form-category";
    let modal = "#modal-category";

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
        $(".modal-title").empty().append("Edit Category");
        $("#id").val(res.data.id);
        $("#name").val(res.data.name);

        $("#modal-category").modal("show");
        resetValidation();
    });
});

// delete
$("#table").on("click", ".delete", function () {
    let id = $(this).data("id");
    let url = $("#delete-url").val();
    let table = "#table";

    ajaxDel(url, id, false, 'sweetSuccess',table);
});

// change status
$('#table').on('click', '.change-status', function () {
    let id = $(this).data('id');
    let url = $('#change-status-url').val();
    url = url.replace(':id', id);
    Swal.fire({
        title: "Are you sure?",
        // text: "The data will be deleted and cannot be restored",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#2d3192",
        confirmButtonText: "OK"
    }).then((result) => {
        if (result.value) {
            new ajaxGet(url)
                .done(function (response) {
                    new sweetSuccess(response.message);
                    new reloadTable('#table');
                });
        } else {
            new reloadTable('#table');
        }
    });
});

function resetValidation() {
    $(".form-control").removeClass("is-invalid");
    $(".form-select").removeClass("is-invalid");
}

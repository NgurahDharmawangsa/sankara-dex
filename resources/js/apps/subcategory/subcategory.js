let tableUrl = $("#table-url").val();

$(".select2").select2({
    dropdownParent: $('#modal-subcategory'),
    width: "100%"
});

$(".filter-select2").select2();

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
        { data: "created_at", name: "created_at", className: "d-none" },
        {
            data: "DT_RowIndex",
            name: "DT_RowIndex",
            width: "40px",
            orderable: false,
            searchable: false,
        },
        { data: 'category.name', name: 'category_id', orderable: true, searchable: true},
        { data: "name", name: "name", orderable: true, searchable: true},
        { data: "is_active", name: "is_active", orderable: false},
        { data: "opsi", name: "opsi", width: "80px", orderable: false, searchable: false },
    ],
    columnDefs: [
        { responsivePriority: 1, targets: 0 },
        { responsivePriority: 2, targets: 1 },
        { responsivePriority: 3, targets: 2 },
        { responsivePriority: 4, targets: 3 },
    ],
});

$("#btn-add").click(function () {
    $("#modal-subcategory").modal('show');
    $(".modal-title").empty().append("Add Sub Category");
    $('#category_id').val(null).trigger('change');
    resetValidation();
});

// submit form
$("#form-subcategory").submit(function (e) {
    e.preventDefault();

    let id = $("#id").val();
    let formData = new FormData(this);
    let btn = "#btn-submit";
    let table = "#table";
    let form = "#form-subcategory";
    let modal = "#modal-subcategory";

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
        console.log(res.data);
        $(".modal-title").empty().append("Edit Sub Category");
        $("#id").val(res.data.id);
        $("#name").val(res.data.name);
        $("#category_id").val(res.data.category_id).trigger('change');

        $("#modal-subcategory").modal("show");
        resetValidation();
    });
});

$("#table").on("click", ".delete", function () {
    let id = $(this).data("id");
    let url = $("#delete-url").val();
    let table = "#table";

    ajaxDel(url, id, false, 'sweetSuccess', table);
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

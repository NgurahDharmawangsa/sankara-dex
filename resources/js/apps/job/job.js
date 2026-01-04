import { ajaxPost, handleValidation } from "../../helper.js";

$(document).on('keyup', '.duration', function () {
    var inputValue = $(this).val();

    if (inputValue === '0' && inputValue.length === 1) {
        $(this).val('1');
    }
});

let tableUrl = $("#table-url").val();

$(".select2").select2({
    dropdownParent: $('#modal-job'),
    width: "100%"
});

$(".users-select2").select2();

$(".project-select2").select2();

// datatable
$("#table").DataTable({
    ordering: true,
    serverSide: true,
    processing: true,
    autoWidth: false,
    responsive: true,
    ajax: {
        url: tableUrl,
        data: function (d) {
            if($("#date-from").val() != "") {
                d.date_from = $("#date-from").val();
            }
            if($("#date-to").val() != "") {
                d.date_to = $("#date-to").val();
            }
            if($("#user-id").val() != "") {
                d.user_id = $("#user-id").val();
            }
            if($("#category").val() != "") {
                d.category = $("#category").val();
            }
            if($("#subcategory").val() != "") {
                d.subcategory = $("#subcategory").val();
            }
        }
    },
    columns: [
        {
            data: "DT_RowIndex",
            name: "DT_RowIndex",
            width: "40px",
            orderable: false,
            searchable: false,
        },
        { data: "employee", name: "user.name", width: "200px", className: "text-wrap"},
        { data: "title", name: "title", width: "200px", className: "text-wrap"},
        { data: "subcat", name: "subcategory.name", width: "100px", className: "text-wrap"},
        { data: "duration", name: "duration", width: "100px"},
        { data: "opsi", name: "opsi", orderable: false, searchable: false, width: "30px"},
    ],
    columnDefs: [
        { responsivePriority: 1, targets: 0 },
        { responsivePriority: 2, targets: 1 },
        { responsivePriority: 3, targets: 2 },
        { responsivePriority: 4, targets: 3 },
        { responsivePriority: 5, targets: 4 },
        { responsivePriority: 6, targets: 5 },
    ],
});

$("#btn-filter").click(function() {
    reloadTable("#table");
});

// edit
$("#table").on("click", ".edit", function () {
    let id = $(this).data("id");
    let url = $("#edit-url").val();
    url = url.replace(":id", id);

    ajaxGet(url).done(function (res) {
        console.log(res.data);
        $(".modal-title").empty().append("Edit Job");
        $("#id").val(res.data.id);
        $("#subcategory-id").val(res.data.subcategory_id).trigger('change');
        $("#user-edit-id").val(res.data.user_id).trigger('change');
        $("#title").val(res.data.title);
        $("#description").val(res.data.description);
        $("#duration").val(res.data.duration);
        let date = new Date(res.data.created_at);
        $("#date").val(date.toString('yyyy-M-dd'));
        $("#modal-job").modal("show");
        resetValidation();
    });
});

$("#form-job").submit(function (e) {
    e.preventDefault();

    let id = $("#id").val();
    let formData = new FormData(this);
    let btn = "#btn-submit";
    let table = "#table";
    let form = "#form-job";
    let modal = "#modal-job";
    if (id !== "") {
        var url = $("#update-url").val();
    } else {
        var url = $("#save-url").val();
    }


    // send data
    ajaxPost(url, formData, btn).done(function (res) {
        notifySuccess(res.message);
        reloadTable(table);
        $(modal).modal("hide");
        $(form)[0].reset();
        $(".select2").val('').trigger('change');
    });
});

$("#table").on("click", ".delete", function () {
    let id = $(this).data("id");
    let url = $("#delete-url").val();
    let table = "#table";

    ajaxDel(url, id, false, 'sweetSuccess', table);
});

//show modal create admin
$("#btn-add").click(function () {
    $("#modal-job").modal('show');
    $(".modal-title").empty().append("Add Category");
    let form = "#form-job";
    $(form)[0].reset();
    $(".select2").val('').trigger('change');
    $('#id').val('');
    resetValidation();
});

function resetValidation() {
    $(".form-control").removeClass("is-invalid");
    $(".form-select").removeClass("is-invalid");
}

function customHandleValidation(messages) {
    $('.invalid-feedback').remove();
    $('.custom-invalid-feedback').remove();
    for (let i in messages) {
        const escapedName = i.replace(/\./g, '\.');

        $(`[name=${escapedName}]`).addClass('is-invalid').after('<div class="text-left invalid-feedback">' + messages[i][0] + '</div>');

        $(`[name=${escapedName}]`).keypress(function () {
            $(`[name=${escapedName}]`).removeClass('is-invalid');
        });

        $(`[name=${escapedName}]`).change(function () {
            $(`[name=${escapedName}]`).removeClass('is-invalid');
            $('.custom-invalid-feedback').remove();
        });

        break;
    }
}

$("#category").change(function() {
    changeCategory($(this).val(), null, '#subcategory', 'All');
})

function changeCategory(id, selectedId = "", element = "", prefix = "") {
    let url = $("#subcategory-url").val();
    url = url.replace(':id', id);

    $(element).empty();
    $(element).append(new Option(prefix + ' Sub Category', ''));

    if (id != "") {
        ajaxGet(url, true).done(function (res) {
            $(element).empty();
            $(element).append(new Option(prefix + ' Sub Category', ''));

            res.data.forEach(function (v) {
                $(element).append(new Option(v.name, v.id));
            })
            $(element).prop('disabled', false);

            if(selectedId !== "") {
                $(element).val(selectedId).trigger('change');
            }
        })
    } else {
        $(element).prop('disabled', true);
    }
}



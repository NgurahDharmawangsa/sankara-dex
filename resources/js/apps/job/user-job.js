import {ajaxPost} from "../../helper.js";
import {convertMinuteToHourMinute} from "../dashboard/dashboard.js";

let dataJob = [];
let number = 1;
let subcategoriesUrl = $("#subcategory-url").val();
let optionHtml = "";
let index;
let elementModal;
let elementTrJob;

ajaxGet(subcategoriesUrl).done(function (res) {
    res.data.forEach(function(item, key) {
        optionHtml += `<option value="${item.id}">${item.category.name} - ${item.name}</option>`;
    });
});

function totalWorkingHour() {
    let durationMinute = document.querySelectorAll("#duration");
    let totalHour = 0;

    if (durationMinute.length > 0) {
        durationMinute.forEach(function(item, key) {
            totalHour += parseInt(item.innerHTML);
        })
    }
    $(".total-working-hour").html(convertMinuteToHourMinute(totalHour));
}

function createModalJob()
{
    elementModal = `<div class="modal fade" id="modal-category" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="modalLabel">Add Job</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-add-job-user">
                    <div class="modal-body">
                         <div class="row">
                                <div class="col-lg-12 col-md-12 col-12 mb-2">
                                    <div class="form-group">
                                    <label for="subcategory_id" class="form-label required">Project</label>
                                    <select class="form-select select1 subcategory_id" data-select2-id="project1" id="modal-subcategory_id" name="subcategory_id" required>
                                        <option value="">Select Project</option>
                                        ${optionHtml}
                                    </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-12 mb-2">
                                   <div class="form-group">
                                    <label for="duration" class="form-label required">Duration (Minutes)</label>
                                    <input type="number" class="form-control duration" id="modal-duration"
                                           name="duration" value="" placeholder="ex : 120" required>
                                   </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-12 mb-2">
                                  <div class="form-group">
                                    <label for="title" class="form-label required">Detail</label>
                                    <textarea name="title" id="modal-title" class="form-control" rows="2" placeholder="Ex: create feature..." value="" required></textarea>
                                  </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="btn-modal-submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>`;

    $('body').append(elementModal);
    $('#modal-category').on('shown.bs.modal', function () {
        $(".select1").select2({
            width: '100%',
            placeholder: "Select Project",
            dropdownParent: $('#modal-category')
        });
    });
}

function showModal(job = null) {
    if (!elementModal) {
        createModalJob();
    }

    $('#modal-category').modal('show');
    $('#modal-title').val(job?.title);
    $('#modal-duration').val(job?.duration);
    $('#modal-subcategory_id').val(job?.subcategory_id);
    // $('#modal-description').val(job?.description);
}

function resetFormModal(form)
{
    $(form)[0].reset();
    $('#modal-subcategory_id').val(null).trigger('change');
}

$(document).on('keyup', '.duration', function () {
    if ($(this).val() === '0' && $(this).val().length === 1) {
        $(this).val('1');
    }
});

$(document).on("submit", "#modal-category #form-add-job-user",function (e) {
    e.preventDefault();

    let title = $('#modal-title').val();
    let duration = $('#modal-duration').val();
    let subcategory_id = $('#modal-subcategory_id').val();
    // let description = $('#modal-description').val();

    if (duration < 0) {
        return sweetInfo("Please enter a duration greater than 0");
    }

    if (index === undefined || index === null) {
        dataJob.push({
            id : number,
            subcategory_id: subcategory_id,
            // description: description,
            title: title,
            duration: duration
        });

        let newRowHtml = `
            <tr>
                <td id="title" style="width: 60%;" class="text-wrap">${title}</td>
                <td id="duration" style="width: 25%;" class="text-wrap">${duration}</td>
                <td style="width: 15%;">
                    <a href="javascript:void(0)" id="edit-${number}" data-id="${number}" class="btn btn-outline-warning btn-edit"><i class="bx bx-pencil"></i></a>
                    <a href="javascript:void(0)" id="delete-${number}" data-id="${number}" class="btn btn-outline-danger btn-delete"><i class="bx bx-trash"></i></a>
                </td>
            </tr>`;
        $("#task-data").append(newRowHtml);
    } else {
        dataJob[index] = {
            id: dataJob[index].id,
            subcategory_id: subcategory_id,
            // description: description,
            title: title,
            duration: duration
        };

        elementTrJob.find('td:nth-child(1)').text(title);
        elementTrJob.find('td:nth-child(2)').text(duration);
    }

    totalWorkingHour();
    $('#modal-category').modal('hide');
    $('#modal-title').val('');
    number++;
    index = undefined;
    elementTrJob = undefined;
});

$(document).on("submit", "#form-job", function (e) {
    e.preventDefault();
    let btn = "#btn-save";
    let url = $("#save-url").val();
    let formHtml = '';

    dataJob.forEach(function (item, key) {
        formHtml += `
            <input type="hidden" id="title" name="title[]" value="${item.title}">
            <input type="hidden" id="duration" name="duration[]" value="${item.duration}">
            <input type="hidden" id="subcategory-id" name="subcategory_id[]" value="${item.subcategory_id}">
        `;
    });

    $(".container-form-job").html(formHtml);

    let formData = new FormData(this);

    if (dataJob.length == 0) {
        sweetInfo("Please insert your data!");
    } else {
        Swal.fire({
            title: "Are you sure?",
            text: "Data can't edit after save, click Yes to continue",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#0d6efd",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Save it!"
        }).then((result) => {
            if (result.value) {
                ajaxPost(url, formData, btn).done(function (res) {
                    Swal.fire({
                        title: "Succeed!",
                        text: "Data created successfully",
                        type: "success"
                    });

                    $("#form-job .container-form-job").empty();
                    $("#task-data").empty();
                    dataJob = [];
                    number = 1;
                });
            }
        });
    }
});

$(document).on('click', '#form-job .table .btn-delete', function () {
    let elementTr = $(this).closest('tr');
    let id = $(this).data('id');

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to return this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#0d6efd",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete!"
    }).then((result) => {
        if (result.value) {
            Swal.fire({
                title: "Deleted!",
                text: "Data has been delete.",
                type: "success"
            });
            elementTr.remove();
            dataJob.splice(dataJob.findIndex(item => item.id === id), 1);
            totalWorkingHour();
        }
    });
});

$(document).on('click', '#form-job .table #task-data .btn-edit', function () {
    let id = $(this).data('id');
    elementTrJob = $(this).closest('tr');
    index = dataJob.findIndex(item => item.id === id);
    let job = dataJob[index];

    showModal(job);

    $(document).on('hidden.bs.modal', '#modal-category', function () {
        index = undefined;
        elementTrJob = undefined;
    });

    $("#modalLabel").empty().html("Edit Job");
    $("#btn-modal-submit").empty().html("Edit");
});

$(document).on('hidden.bs.modal', '#modal-category', function () {
    resetFormModal("#form-add-job-user");
});

$(document).on("click", "#btn-new", function () {
    showModal();
    $("#modalLabel").empty().html("Add Job");
    $("#btn-modal-submit").empty().html("Add");
});

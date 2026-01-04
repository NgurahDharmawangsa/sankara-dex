import {convertMinuteToHourMinute} from "../dashboard/dashboard.js";

let tableUrl = $("#table-url").val();
const tableId = "#table";

$('.daterangepick').daterangepicker({
    startDate: moment().nowDate,
    endDate: moment().nowDate,
    locale: {
        format: 'DD/MM/YYYY'
    },
});

$(".select2").select2();

let totalDuration = 0;

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
        data: function (d) {
            const dates = $('#dates').val()
            if($("#subcategory_id").val() != "") {
                d.subcategory_id = $("#subcategory_id").val();
            }
            if(typeof dates !== 'undefined') {
                const date = dates.split(' - ')
                d.start_date = date[0]
                d.end_date = date[1]
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
        { data: "subcategory", name: "subcategory", searchable: false, orderable: false },
        { data: "title", name: "title", searchable: true, orderable: false },
        { data: "duration", name: "duration", searchable: true },
    ],
    columnDefs: [
        { responsivePriority: 1, targets: 0 },
        { responsivePriority: 2, targets: 1 },
        { responsivePriority: 3, targets: 2 },
    ],
    preDrawCallback: function() {
        totalDuration = 0;
    },
    // createdRow: function (row, data, dataIndex) {
    //     totalDuration += parseInt(data.duration);
    //     $("#total-duration").text("Total Jam Kerja: " + convertMinuteToHourMinute(totalDuration));
    // },
});


$("#btn-filter").click(function() {
    totalDuration = 0;
    reloadTable(tableId);
    loadWorkingHour();
});

function loadWorkingHour() {
    let start_date = "";
    let end_date = "";
    const datesWorking = $('#dates').val();
    const workingHoursUrl = $("#working-hours-url").val();
    if(typeof dates !== 'undefined') {
        const dateWorking = datesWorking.split(" - ");
        start_date = dateWorking[0].replace(/\//g, "-");;
        end_date = dateWorking[1].replace(/\//g, "-");;
    }
    let formData = new FormData();
    formData.append('date_from', start_date);
    formData.append('date_to', end_date);
    formData.append('subcategory_id', $("#subcategory_id").val());
    
    ajaxPost(workingHoursUrl, formData)
        .done(function (res) {
            console.log(res);
        $("#total-duration").html(convertMinuteToHourMinute(res));
    });
}

document.addEventListener("DOMContentLoaded", function () {
    loadWorkingHour();
})

const roleAdmin = "Admin";
const currentRole = $("#role").val();

if (currentRole == roleAdmin) {
    document.addEventListener("DOMContentLoaded", function () {
        const chartUrl = $('#chart-url').val();
        let options = {
            series: [],
            chart: {
                height: 350,
                type: 'area'
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            xaxis: {
                type: 'datetime',
                categories: []
            },
            yaxis: {
                labels: {
                    formatter: function (val) {
                        return val.toFixed(0);
                    },
                }
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy'
                },
            },
        };

        let chart = new ApexCharts(document.getElementById('chart-mentions'), options);
        chart.render();

        ajaxGet(chartUrl, false)
            .done(function (res) {
                let job = res.data.chart.job;
                const labels = res.labels;

                let isJobEmpty = job.every(function(item) {
                    return item === 0;
                })

                if (!isJobEmpty) {
                    chart.updateOptions({
                        series : [{
                            name: 'Job',
                            data: job
                        },],
                        xaxis : {
                            type: 'datetime',
                            categories: labels
                        },
                    });
                }
            });
    });

    document.addEventListener("DOMContentLoaded", function () {
        const userUrl = $('#all-user-url').val();
        const workingHoursUrl = $("#all-working-hours-url").val();
        const jobUrl = $("#all-job-url").val();

        ajaxGet(workingHoursUrl, true)
            .done(function (res) {
                const workingHour = convertMinuteToHourMinute(res);
                $("#all-working-hours").html(workingHour);
            });

        ajaxGet(userUrl, true)
            .done(function (res) {
                $('#all-user').html(res.length);
            });

        ajaxGet(jobUrl, true)
            .done(function (res) {
                $('#all-job').html(res.length);
            });
    });
}

function convertMinuteToHourMinute(minute) {
    const hour = Math.floor(minute / 60);
    const remainingMinutes = minute % 60;

    let conversionResult = "";

    if (hour > 0) {
        conversionResult += hour + " Hours ";
    }

    if (remainingMinutes > 0) {
        conversionResult += remainingMinutes + " Minutes";
    }

    return conversionResult;
}

export {convertMinuteToHourMinute}


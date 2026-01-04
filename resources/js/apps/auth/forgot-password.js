$("#digit-1").focus();

let digitValidate = function (e) {
    e.value = e.value.replace(/[^0-9]/g, '');
}

// OTP Input Mover / Displacement Value
let tabChange = function (val) {
    let e = document.querySelectorAll('.input-digit');
    groupCode();
    if (e[val - 1].value != '') {
        e[val].focus()
    } else if (e[val - 1].value == '') {
        e[val - 2].focus()
    }
}

function groupCode() {
    let d1 = $('#digit-1').val();
    let d2 = $('#digit-2').val();
    let d3 = $('#digit-3').val();
    let d4 = $('#digit-4').val();
    let d5 = $('#digit-5').val();
    let d6 = $('#digit-6').val();

    let group = `${d1}${d2}${d3}${d4}${d5}${d6}`;

    if (group == "") {
        group = 0;
    }

    $('#code').val(parseInt(group));
}

document.querySelectorAll('.input-digit').forEach(function (el) {
    el.addEventListener('paste', function (e) {
        e.stopPropagation();
        e.preventDefault();

        var clipboardData, pastedData;

        clipboardData = e.clipboardData || window.clipboardData;
        pastedData = clipboardData.getData('Text');

        let arrNumber = pastedData.toString().split('');
        for (let i in arrNumber) {
            $(`#digit-${ parseInt(i)+ parseInt(1)}`).val(parseInt(arrNumber[i]))
        }
    });
})

function startTimer(duration, display) {
    let url = $('#resend-url').val();
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            $('#time').empty().append('<a\n' +
                'href="'+url+'">Verification Code</a>');
        }
    }, 1000);
}

window.onload = function () {
    var fiveMinutes = 60 * 3,
        display = document.querySelector('#time');
    startTimer(fiveMinutes, display);
};

// submit form
$("#form-confirmation").submit(function (e) {
    e.preventDefault();

    let formData = new FormData(this);
    let btn = "#btn-submit";
    let form = "#form-confirmation";
    var url = $("#submit-url").val();

    // send data
    ajaxPost(url, formData, btn).done(function (res) {
        snackbar(res.message);

        setTimeout(function () {
            location.href = res.data.redirect;
        },1300);
    });
});

$("#form-confirmation-email").submit(function (e) {
    e.preventDefault();

    let formData = new FormData(this);
    let btn = "#btn-submit";
    let form = "#form-confirmation-email";
    var url = $("#submit-url").val();

    // send data
    ajaxPost(url, formData, btn).done(function (res) {
        snackbar(res.message);

        setTimeout(function () {
            location.href = res.data.redirect;
        },1300);
    });
});

$("#form-reset").submit(function (e) {
    e.preventDefault();

    let formData = new FormData(this);
    let btn = "#btn-submit";
    var url = $("#submit-url").val();

    // send data
    ajaxPost(url, formData, btn).done(function (res) {
        snackbar(res.message);

        setTimeout(function () {
            location.href = res.data.redirect;
        },1300);
    });
});



window.digitValidate = digitValidate
window.tabChange = tabChange
window.groupCode = groupCode
window.startTimer = startTimer

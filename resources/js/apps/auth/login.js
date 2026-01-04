$('#form-login').submit(function (e) {
    e.preventDefault();

    let url = $('#login-url').val();
    let formData = new FormData(this);
    let btn = '#btn-login';

    new ajaxPost(url, formData, btn, 'snackbarError')
        .done(function (res) {
            snackbar(res.message);

            setTimeout(function () {
                location.href = res.data.redirect;
            },1300);
        });
});

$('#form-register').submit(function (e) {
    e.preventDefault();

    let url = $('#register-url').val();
    let formData = new FormData(this);
    let btn = '#btn-register';

    new ajaxPost(url, formData, btn, true)
        .done(function (res) {
            snackbar(res.message);

            setTimeout(function () {
                location.href = res.data.redirect;
            },1300);
        });
});

$('#form-forgot').submit(function (e) {
    e.preventDefault();

    let url = $('#forgot-url').val();
    let formData = new FormData(this);
    let btn = '#btn-forgot';

    new ajaxPost(url, formData, btn, 'snackbarError')
        .done(function (res) {
            snackbar(res.message);

            setTimeout(function () {
                location.href = res.data.redirect;
            },1300);
        });
});
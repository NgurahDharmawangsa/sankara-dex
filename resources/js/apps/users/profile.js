const togglePassword = document.querySelector('#togglePassword1');
const togglePassword2 = document.querySelector('#togglePassword2');
const password = document.querySelector('#new-password');
const password2 = document.querySelector('#confirm-password');
togglePassword.addEventListener('click', () => {
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    if(type == 'text') {
        togglePassword.setAttribute('class', 'bx bxs-show');
    } else {
        togglePassword.setAttribute('class', 'bx bxs-hide');
    }
});
togglePassword2.addEventListener('click', () => {
    const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
    password2.setAttribute('type', type);
    if(type == 'text') {
        togglePassword2.setAttribute('class', 'bx bxs-show');
    } else {
        togglePassword2.setAttribute('class', 'bx bxs-hide');
    }
});

// submit form
$("#form-profile").submit(function (e) {
    e.preventDefault();

    let formData = new FormData(this);
    let btn = "#btn-submit";
    var url = $("#submit-url").val();

    // send data
    ajaxPost(url, formData, btn).done(function (res) {
        notifySuccess(res.message);

        setTimeout(function () {
            location.reload();
        },1300);
    });
});

$('#uploadProfile').on('change', function () {
    var file = this.files[0];
    var reader = new FileReader();
    reader.onload = function (e) {
        $('.avatar-photo').attr('src', e.target.result);
    };

    reader.readAsDataURL(file);
});

$('#form-avatar').on('submit', function (e) {
    e.preventDefault();

    let oldImage = $('#old_image').val();
    let url = $('#avatar-url').val();
    let btn = '#btn-avatar';

    if ($('#uploadProfile')[0].files.length === 0) {
        notifyWarning("File not selected!");
        return;
    }

    let formData = new FormData(this);
    formData.append('old_image', oldImage);
    ajaxPost(url, formData, btn)
        .done(function (res) {
            notifySuccess(res.message);

            setTimeout(function () {
                location.reload();
            },1300);
        })
        .fail(function (res) {
            $('.invalid-feedback').hide();
            let response = res.responseJSON;
            notifyError(response.errors.image);
        });
});

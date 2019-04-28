let isSubmitted;

$('#signup').on('submit', function () {
    isSubmitted = true;

    let valid = checkSignUpForm($('#signup'));

    if(isOkay(valid)) {
        $.ajax({
            url: '/signupAction',
            method: 'POST',
            data: {
                login: $('#login').val(),
                email: $('#email').val(),
                pass: $('#password').val()
            },
            success: function (res) {
               if(res.status == 'error') {
                   $('#error').show().html(res.errors.msg);
                   isInvalid($('#email'), '');
                   isInvalid($('#login'), '');
               } else {
                   window.location.replace('/private');
               }
            }
        });
    }

    return false;
});

$('#signup').on('change', function () {
    if(isSubmitted) {
        checkSignUpForm($('#signup'));
    }
});

function isOkay(arr) {
    for (let i = 0; i < arr.length; i++) {
        if(arr[i]) {
            return false;
        }
    }

    return true;
}

function checkSignUpForm(form) {

    let errors = [];

    $(form).find('input').each(function () {

        if(isInputEmpty($(this))){

            isInvalid($(this), 'Cannot be empty');
            errors.push(true);

        } else if(isInputLength($(this), 4, 16) && $(this).attr('id') != 'email') {

            isInvalid($(this), 'The length must be from ' + min + 'to ' + max);
            errors.push(true);

        } else if($(this).attr('id') == 'email' && isEmailPregMatch($(this))) {

            isInvalid($(this), 'Email format is invalid');
            errors.push(true);

        } else if($(this).attr('id') == 'password1' && areInputsSame($(this), $('#password'))) {

            isInvalid($(this), "Passwords don't match");
            errors.push(true);

        } else {

            isValid($(this));
            errors.push(false);

        }
    });

    return errors;
}
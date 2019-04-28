function isInvalid(node, resmsg) {
    $(node).removeClass('is-valid').addClass('is-invalid');
    $(node).next().html(resmsg).removeClass('valid-feedback').addClass('invalid-feedback');
}

function isValid(node) {
    $(node).removeClass('is-invalid').addClass('is-valid');
    $(node).next().html("It's okay").removeClass('invalid-feedback').addClass('valid-feedback');
}

function isInputEmpty(node) {
    let value = $(node).val();

    if(value == "") {
        return true;
    }

    return false;
}

function isInputLength(node, min, max) {
    let str = $(node).val();

    if(str.length < min || str.length > max) {
        return true
    }

    return false;
}

function areInputsSame(node, secNode) {
    let str = $(node).val();
    let secStr = $(secNode).val();

    if(str != secStr) {
        return true;
    }

    return false;
}

function isEmailPregMatch(node) {
    let str = $(node).val();

    if(str.search(/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})$/) == -1){
        return true;
    }

    return false;
}
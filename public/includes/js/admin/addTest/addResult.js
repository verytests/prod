$('button[data-bind="addResult"]').on('click', function () {
    let counter = $(this).attr('data-counter');

    let counterInc = +counter+1;

    let newResult = $('#testResult').clone(true).attr('id','testResult' + counterInc).show();
    $(newResult).find('#resultInp').attr('id', 'resultInp' + counterInc).attr('placeholder', 'Result ' + counterInc);
    $(newResult).find('#resultInpVal').attr('id', 'resultInpVal' + counterInc);
    $(newResult).find('#resultImage').attr('id', 'resultImage' + counterInc);
    $(newResult).find('button[data-bind="addResult"]').attr('data-counter', counterInc).attr('data-value', counterInc);
    $(newResult).find('button[data-bind="removeResult"]').attr('data-counter', counterInc).attr('data-value', counterInc);

    for(let i = 0; i <= +counter+1; i++) {
        $('#testResult' + i).find('button[data-bind="removeResult"]').attr('data-counter', counterInc);
        $('#testResult' + i).find('button[data-bind="addResult"]').attr('data-counter', counterInc);
    }

    $('#testResults').append(newResult);
});

$('button[data-bind="removeResult"]').on('click', function () {
    let resultNum = $(this).attr('data-value');
    let counter = $(this).attr('data-counter');

    $('#testResult' + resultNum).remove();
    let inc = +resultNum+1;
    let counterInc = +counter+1;
    let counterDec = +counter-1;

    for(let i = inc; i <= counterInc; i++) {
        let dec = +i - 1;
        $('#resultInp'+ i).attr('id', 'resultInp'+ dec)
            .attr('placeholder', 'Result ' + dec);
        $('#resultInpVal' + i).attr('id', 'resultInpVal'+ dec);
        $('#resultImage' + i).attr('id', 'resultImage' + dec);
        $('#testResult' + i).find('button[data-bind="addResult"][data-value='+i+']').attr('data-value', dec);
        $('#testResult' + i).find('button[data-bind="removeResult"][data-value='+i+']').attr('data-value', dec);
        $('#testResults').find('#testResult' + i).attr('id','testResult' + dec);
    }

    for(let i = 0; i <= counter; i++) {
        $('#testResult' + i).find('button[data-bind="removeResult"][data-value='+i+']').attr('data-counter', counterDec);
        $('#testResult' + i).find('button[data-bind="addResult"][data-value='+i+']').attr('data-counter', counterDec);
    }
});

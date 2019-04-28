$('button[data-bind="addQuestion"]').on('click', function () {
    let counter = $(this).attr('data-counter');
    let counterInc = +counter+1;

    let question = $('#question').clone(true).attr('id','question'+ counterInc).show();
    $(question).find('#questionAnswers').attr('id', 'questionAnswers'+ counterInc + '_1');
    $(question).find('#questionInp').attr('id', 'questionInp'+ counterInc).attr('placeholder', 'Question '+ counterInc);
    $(question).find('#questionNum').attr('id', 'questionNum' + counterInc).html('Question ' + counterInc);
    $(question).find('#questionInpAns').attr('id', 'questionInpAns'+ counterInc + '_1').attr('placeholder', 'Answer 1');
    $(question).find('#questionInpAnsVal').attr('id', 'questionInpAnsVal'+ counterInc + '_1');
    $(question).find('button[data-bind="addAnswer"]').attr('data-counter', '1').attr('data-value', counterInc).attr('data-content', '1');
    $(question).find('button[data-bind="removeAnswer"]').attr('data-counter', '1').attr('data-value', counterInc).attr('data-content', '1');
    $(question).find('button[data-bind="addQuestion"]').attr('data-counter', counterInc).attr('data-value', counterInc);
    $(question).find('button[data-bind="removeQuestion"]').attr('data-counter', counterInc).attr('data-value', counterInc);

    for(let i = 1; i <= counterInc; i++) {
        $('#question' + i).find('button[data-bind="removeQuestion"]').attr('data-counter', counterInc);
        $('#question' + i).find('button[data-bind="addQuestion"]').attr('data-counter', counterInc);
    }

    $('#questions').append(question);
});

$('button[data-bind="removeQuestion"]').on('click', function () {
    let questionNum = $(this).attr('data-value');
    let counter = +($(this).attr('data-counter'));

    $('#questions').find('#question' + questionNum).remove();

    for (let i = questionNum; i <= counter; i++) {
        let dec = +i-1;

        $('#questions').find('#question' + i).attr('id', 'question' + dec);
        $('#question' + dec).find('#questionNum' + i).attr('id', 'questionNum' + dec).html('Question ' + dec);
        $('#question' + dec).find('#questionInp' + i).attr('id', 'questionInp' + dec).attr('placeholder', 'Question ' + dec);
        $('#question' + dec).find('#question' + i).attr('id', 'question' + dec);
        $('#question' + dec).find('button[data-bind="addAnswer"]').attr('data-value', dec);
        $('#question' + dec).find('button[data-bind="removeAnswer"]').attr('data-value', dec);
        $('#question' + dec).find('button[data-bind="addQuestion"]').attr('data-value', dec);
        $('#question' + dec).find('button[data-bind="removeQuestion"]').attr('data-value', dec);

        let answersCounter = +($('#question'+dec).find('button[data-bind="addAnswer"]').attr('data-counter'));
        for(let x = 1; x <= answersCounter; x++) {
            $('#questionAnswers' + i + '_' + x).attr('id', 'questionAnswers' + dec + '_' + x);
            $('#questionAnswers' + dec + '_' + x).find('#questionInpAns' + i + '_' + x).attr('id', 'questionInpAns' + dec + '_' + x);
            $('#questionAnswers' + dec + '_' + x).find('#questionInpAnsVal' + i + '_' + x).attr('id', 'questionInpAnsVal' + dec + '_' + x);
        }
    }
    let counterDec = counter-1;
    for (let i = 1; i <= counter; i++) {
        $('#question' + i).find('button[data-bind="removeQuestion"]').attr('data-counter', counterDec);
        $('#question' + i).find('button[data-bind="addQuestion"]').attr('data-counter', counterDec);
    }
});

$('button[data-bind="addAnswer"]').on('click', function () {
    let questionNum = $(this).attr('data-value');
    let counter = $(this).attr('data-counter');

    let counterInc = +counter+1;

    let questionAnswer = $('#questionAnswers').clone(true).attr('id','questionAnswers'+ questionNum + '_' + counterInc);
    $(questionAnswer).find('#questionInpAns').attr('id', 'questionInpAns'+ questionNum + '_' + counterInc).attr('placeholder', 'Answer ' + counterInc);
    $(questionAnswer).find('#questionInpAnsVal').attr('id', 'questionInpAnsVal'+ questionNum + '_' + counterInc);
    $(questionAnswer).find('button[data-bind="addAnswer"]').attr('data-counter', counterInc).attr('data-value', questionNum).attr('data-content', counterInc);
    $(questionAnswer).find('button[data-bind="removeAnswer"]').attr('data-counter', counterInc).attr('data-value', questionNum).attr('data-content', counterInc);

    for(let i = 0; i <= +counter+1; i++) {
        $('#question' + questionNum).find('button[data-bind="removeAnswer"]').attr('data-counter', counterInc);
        $('#question' + questionNum).find('button[data-bind="addAnswer"]').attr('data-counter', counterInc);
    }

    $('#question' + questionNum).append(questionAnswer);
});

$('button[data-bind="removeAnswer"]').on('click', function () {
    let questionNum = $(this).attr('data-value');
    let answerNum = $(this).attr('data-content');
    let ansCounter = $(this).attr('data-counter');

    $('#questionAnswers'+questionNum+'_'+answerNum).remove();
    let inc = +answerNum+1;
    let counterInc = +ansCounter+1;
    let counterDec = +ansCounter-1;

    for(let i = inc; i <= counterInc; i++) {
        let dec = +i - 1;
        $('#question' + questionNum).find('#questionInpAns'+questionNum+'_'+ i).attr('id', 'questionInpAns'+questionNum+'_'+ dec)
            .attr('placeholder', 'Answer ' + dec);
        $('#question' + questionNum).find('#questionInpAnsVal'+ questionNum +'_' + i).attr('id', 'questionInpAnsVal'+ questionNum + '_' + dec);
        $('#question' + questionNum).find('button[data-bind="addAnswer"][data-content='+i+']').attr('data-content', dec);
        $('#question' + questionNum).find('button[data-bind="removeAnswer"][data-content='+i+']').attr('data-content', dec);
        $('#question' + questionNum).find('#questionAnswers' +questionNum+ '_' + i).attr('id','questionAnswers'+ questionNum + '_' + dec);
    }

    for(let i = 0; i <= ansCounter; i++) {
        $('#question' + questionNum).find('button[data-bind="removeAnswer"][data-content='+i+']').attr('data-counter', counterDec);
        $('#question' + questionNum).find('button[data-bind="addAnswer"][data-content='+i+']').attr('data-counter', counterDec);
    }
});

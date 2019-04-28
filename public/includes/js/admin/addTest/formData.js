$('#btnCreate').on('click', function () {
    let data = formDataFromForm();

    $.ajax(
        {
            url: "/admin/addtest/send",
            method: "POST",
            data: {
                testData: data
            },
            success: function (res) {
                alert('ok');
            }
        }
    )
});

function formDataFromForm() {
    let data = {};
    let testName = $('#testName').val();
    let testDesc = $('#testDescription').val();
    let testImage = $('#testImage').val();
    let questions = [];
    let questionsCounter = $('#question1').find('button[data-bind="addQuestion"]').attr('data-counter');
    let resultCounter = $('#testResult1').find('button[data-bind="addResult"]').attr('data-counter');

    for (let i = 1; i <= questionsCounter; i++) {
        let question = {};
        question.text = $('#question' + i).find('#questionInp' + i).val();
        question.answers = [];

        let answersCounter = $('#question' + i).find('button[data-bind="addAnswer"]').attr('data-counter');
        for (let x = 1; x <= answersCounter; x++) {
            let answer = {};
            let answerText = $('#question' + i).find('#questionInpAns' + i + '_' + x).val();
            let answerVal = $('#question' + i).find('#questionInpAnsVal' + i + '_' + x).val();

            answer.text = answerText;
            answer.value = answerVal;
            question.answers.push(answer);
        }
        questions.push(question);
    }

    let results = [];
    for(let i = 1; i <= resultCounter; i++) {
        let result = {};
        result.text = $('#resultInp' + i).val();
        result.value = $('#resultInpVal' + i).val();
        result.image = $('#resultImage' + i).val();

        results.push(result);
    }

    data.name = testName;
    data.desc = testDesc;
    data.testImage = testImage;
    data.questions = questions;
    data.results = results;
    data.category = $('#category').val();

    return data;
}

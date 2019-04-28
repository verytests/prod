$('#save').on('click', function () {
   let data = formData();

   $.ajax({
       url: '/admin/managetests/update',
       method: "POST",
       data: {
           'testData': data
       },
       success: function () {

       }
   })

});



function formData() {
   let questions = [];
   let test = {};
   let answers = [];
   let results = [];
   let resultImgs = [];

   $('input').each(function () {

       if($(this).attr('data-type') === 'question') {
           let question = {};

           question.text = $(this).val();
           question.id = $(this).attr('data-id');

           questions.push(question);
       }

       if($(this).attr('data-type') === 'header') {
           let header = {};

           header.text = $(this).val();
           header.id = $(this).attr('data-id');

           test.header = header;
       }

       if($(this).attr('data-type') === 'desc') {
           let desc = {};

           desc.text = $(this).val();
           desc.id = $(this).attr('data-id');

           test.desc = desc;
       }

       if($(this).attr('data-type') === 'mainImage') {
           let mainImage = {};

           mainImage.url = $(this).val();
           mainImage.id = $(this).attr('data-id');

           test.mainImage = mainImage;
       }

       if($(this).attr('data-type') === 'answer') {
           let answer = {};

           answer.text = $(this).val();
           answer.id = $(this).attr('data-id');

           answers.push(answer);
       }

       if($(this).attr('data-type') === 'result') {
           let result = {};

           result.text = $(this).val();
           result.id = $(this).attr('data-id');

           results.push(result);
       }

       if($(this).attr('data-type') === 'resultImg') {
           let result = {};

           result.url = $(this).val();
           result.id = $(this).attr('data-id');

           resultImgs.push(result);
       }

       if($(this).attr('data-type') === 'imageUrl') {
           let imageUrl = {};

           imageUrl.url = $(this).val();
           imageUrl.id = $(this).attr('data-id');

           test.imageUrl = imageUrl;
       }

   });

    test.questions = questions;
    test.answers = answers;
    test.results = results;
    test.resultsImgs = resultImgs;

    return test;
}


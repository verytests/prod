$('.saveBtn').each(function (e) {
   $(this).on('click', function (e) {
       let btn = e.target;

       $.ajax({
           url: '/private/savetest',
           method: "POST",
           data: {
               testId: $(btn).attr('data-id')
           },
           beforeSend: function() {
               $(btn).prop('disabled', true)
           },
           success: function (res) {
               if(res.status === 'success') {
                   $(btn).html('saved');
               }
           }
       })
   })
});
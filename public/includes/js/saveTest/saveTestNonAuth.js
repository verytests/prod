$('.saveBtn').each(function (e) {
    $(this).on('click', function (e) {
        let btn = e.target;

        $(btn).html('Only for auth users')
    })
});
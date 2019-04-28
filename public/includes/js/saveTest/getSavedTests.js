$(document).ready(function () {
$.ajax({
    url: '/private/getsavedtests',
    method: "GET",
    success: function (res) {
        setSaved(res.data.saved);
    }
})
});

function setSaved(saved) {
    $('.saveBtn').each(function () {
        for(let i = 0; i < saved.length; i++) {
            if($(this).attr('data-id') == saved[i]) {
                $(this).html('Saved').prop('disabled', true);
            }
        }
    })
}
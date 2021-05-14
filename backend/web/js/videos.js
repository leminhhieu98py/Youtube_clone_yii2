$(function() {
    $('#videoFile').change(function(e) {
        $(e.target).closest('form').trigger('submit');
    })
})
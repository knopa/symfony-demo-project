/**
 * Created by sergey@slepokurov.com on 29.10.2014.
 */
$(function() {
    $('#comment-form').on('submit', function() {
        var text = $('#comment').val();
        if(text.length < 10) {
            alert('Please enter at least 10 characters!');
            return false;
        }
        return true;
    });
});

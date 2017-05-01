/**
 * Created by Tarun on 4/30/2017.
 */
$(document).ready(function() {

    // csrf token for every ajax request
    var csrftokenname = $('#csrf').attr('csrftokenname'),
        csrftokenhash = $('#csrf').attr('csrftokenhash');

    // Log out
    $(document).on('click', '#logout', function() {
        // make ajax request data
        var request_data = {};
        request_data[csrftokenname] = csrftokenhash;

        $.ajax({
            url: base_url + 'Login/Logout',
            type: 'POST',
            data: request_data,
            success: function (response) {
                if (response == 'success') {
                    location.href = base_url + 'login';
                }
            }
        });
    });
});

$(document).ready(function(){

    // Login action after clicking on login image
    $(document).on('click', '#login_btn', function() {
        var username = $.trim($('#username').val()),
            password = $.trim($('#password').val()),
            error_found = 0,
            base_url = $('#base_url').val(),
            csrftokenname = $('#csrf').attr('csrftokenname'),
            csrftokenhash = $('#csrf').attr('csrftokenhash'),
            request_data = {};

        // hide error message
        $('#errorMsg').hide();

        // null validation
        $('#username, #password').css('border-color', ''); // remove border color at the time of login clicking
        if (username == '') {
            $('#username').css('border-color', 'red');
            error_found = 1;
        }
        if (password == '') {
            $('#password').css('border-color', 'red');
            error_found = 1;
        }
        if (error_found == 1) return false;

        // ajax to check login data and if matched then redirect to dashboard page
        request_data['username'] = username;
        request_data['password'] = password;
        request_data[csrftokenname] = csrftokenhash;
        $.ajax({
            url: base_url + 'Login/Checklogin',
            type: 'POST',
            data: request_data,
            success: function(response) {
                if (response != '') {
                    var html = '<div class="input-group">\
                                    <input type="text" class="form-control" id="otp" placeholder="Enter OTP">\
                                    <span class="input-group-btn">\
                                        <button class="btn btn-secondary" id="go_btn" type="button">Go!</button>\
                                    </span>\
                                </div>';
                    $('#details_text').html('Please enter OTP which is sent to your email');
                    $('#login_section').html(html);
                } else {
                    $('#username, #password').css('border-color', 'red');
                    $('#errorMsg').fadeIn('1500');
                }
            }
        });

    });

    // Redirect after entering OTP
    $(document).on('click', '#go_btn', function () {
        var otp = $('#otp').val(),
            base_url = $('#base_url').val(),
            csrftokenname = $('#csrf').attr('csrftokenname'),
            csrftokenhash = $('#csrf').attr('csrftokenhash'),
            request_data = {};

        // make ajax request data
        request_data['otp'] = otp;
        request_data[csrftokenname] = csrftokenhash;

        $.ajax({
            url: base_url + 'Login/Otpcheck',
            type: 'POST',
            data: request_data,
            success: function (response) {
                if (response == 'success') {
                    location.href = base_url + 'distributor/dashboard';
                }
            }
        });
    });
});
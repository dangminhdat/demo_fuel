$(document).ready(function () {
    // VALIDATE LOGIN
    $error = $('#error');

    $('#btnLogin').click(function (event) {
        var username = $('#username').val();
        var password = $('#password').val();
        if (username === '' || password === '') {
            $error.show();
            $error.empty('p');
            $error.append("<p>Username or password is required</p>");
        } else {
            if (username.length < 5 || password.length < 5) {
                $error.show();
                $error.empty('p');
                $error.append("Username or password min length is 5");
            } else if (username.length > 50 || password.length > 50) {
                $error.show();
                $error.empty('p');
                $error.append("<p>Username or password max length is 50</p>");
            } else {
                $.ajax({
                    url: './api/login',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        username: username,
                        password: password,
                    },
                    success: function (data) {
                        if (data.success) {
                            location.href = './';
                        } else {
                            $error.show();
                            $error.empty('p');
                            $error.append("<p>" + data.message + "</p>");
                        }
                    },
                    error: function () {
                        alert('Error server.');
                    }
                });
            }
        }
    });

    // VALIDATE SIGNUP
    $('#btnSignup').click(function (event) {
        var username = $('#username').val();
        var password = $('#password').val();
        var email    = $('#email').val();
        var fullname = $('#fullname').val();

        if (username === '' || password === '' || email === '' || fullname === '') {
            $error.show();
            $error.empty('p');
            $error.append("<p>All field is required</p>");
        } else {
            if (username.length < 5 || password.length < 5) {
                $error.show();
                $error.empty('p');
                $error.append("Username or password min length is 5");
            } else if (username.length > 50 || password.length > 50 || email.length > 50) {
                $error.show();
                $error.empty('p');
                $error.append("<p>Username, Email or password max length is 50</p>");
            } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)){
                $error.show();
                $error.empty('p');
                $error.append("<p>Email is invalid</p>");
            } else {
                $.ajax({
                    url: './api/signup',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        username: username,
                        password: password,
                        email: email,
                        fullname: fullname,
                    },
                    success: function (data) {
                        if (data.success) {
                            location.href = './login';
                        } else {
                            $error.show();
                            $error.empty('p');
                            $error.append("<p>" + data.message + "</p>");
                        }
                    },
                    error: function () {
                        alert('Error Server.');
                    }
                });
            }
        }
    });
});
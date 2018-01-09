$(document).ready(function () {

    $("form[name='signup']").validate({

        rules: {

            name: "required",
            email: "required",
            username: "required",
            password: {

                required: true,
                minlength: 5
            },
            confirmPassword: {

                equalTo: "#password"
            }
        },
        messages: {

            name: "please enter fullname",
            email: "please enter an email",
            username: "please enter username",
            password: {
                required: "please provide a password",
                minlength: "password should be atleast 5 characters long",
            },
            confirmPassword: {

                equalTo: "Passwords do not match."
            }
        },

        submitHandler: function (form) {
            form.submit();
        }
    })
})
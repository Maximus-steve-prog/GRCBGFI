$(document).ready(function () {


    const sign_in_btn = $("#sign-in-btn"),
        verifyAdminbtn = $("#btnverify"),
        sign_up_btn = $("#sign-up-btn"),
        signupform = $(".sign-up-form"),
        VerifyForm = $("#check-admin-form"),
        signinform = $(".sign-in-form"),
        forgotpassform = $(".forgot-password-form"),
        forgotpass = $(".forgotpassword"),
        backlogin = $(".back-login"),
        container = $(".container"),
        Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        $("input.images").change(function () {
            var file = this.files[0];
            var url = URL.createObjectURL(file);
            $(this).closest(".rows").find(".preview_img").attr("src", url);
        });

    sign_in_btn.click(function (e) {
        container.removeClass("sign-up-mode");
    });

    sign_up_btn.click(function (e) {
        container.removeClass("sign-up-mode signupform");
        container.removeClass("forgotpass-mode");
        container.addClass("sign-up-mode");
    });

    backlogin.click(function (e) {
        container.removeClass("forgotpass-mode");
    });

    forgotpass.click(function (e) {
        container.addClass("forgotpass-mode");
    });

    verifyAdminbtn.click(function (e) {
        if (VerifyForm[0].checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
            $.ajax({
                url: "../../../GRCBGFI/Controllers/PHPControllers/userController.php",
                type: "POST",
                data: VerifyForm.serialize() + "&action=verify",
                success: function (response) {
                    var response = JSON.parse(response);
                    console.log(response);
                    switch (response.answer) {
                        case response.answer = 10:
                            Toast.fire({
                                icon: "warning",
                                title: "GRCBGFI",
                                text: response.message
                            });
                            emailconnexion.val('');
                            break;
                        case response.answer = 15:
                            Toast.fire({
                                icon: "warning",
                                title: "GRCBGFI",
                                text: response.message
                            });
                            emailconnexion.val('');
                            break;
                        case response.answer = 25:
                            Toast.fire({
                                icon: "warning",
                                title: "GRCBGFI",
                                text: response.message
                            });
                            passwordconnexion.val('');
                            break;
                        case response.answer = 40:
                            changepassemail.val('');
                            Toast.fire({
                                icon: "warning",
                                title: "GRCBGFI",
                                text: response.message
                            });
                            break;
                        case response.answer = 30:
                            container.addClass("sign-up-mode signupform");
                            VerifyForm[0].reset();
                            break;
                        default:
                            break;
                    }
                }
            });

        }
    });

    //This function is used to display image before uploading it
    $("input.images").change(function () {
        var file = this.files[0];
        var url = URL.createObjectURL(file);
        $(this).closest(".row").find(".preview_img").attr("src", url);
    });

    // Ajax Controller for the Sign up Form
    let userpassword = $("#userpassword"),
        emailchangepass = $("#emailchangepass"),
        userconfpassword = $("#userconfpassword"),
        useremail = $("#useremail"),
        userphoto = $(".images");
    signupform.on("submit", function (e) {
        //btnCreateUser.attr("disabled","disabled");
        if (signupform[0].checkValidity()) {
            e.preventDefault();
            $.ajax({
                url: "../../../GRCBGFI/Controllers/PHPControllers/userController.php?action=createuser",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    var response = JSON.parse(response);
                    console.log(response);
                    switch (response.answer) {
                        case response.answer = 25:
                            Toast.fire({
                                icon: "success",
                                title: "GRCBGFI",
                                text: response.message
                            });
                            container.removeClass("sign-up-mode signupform");
                            container.removeClass("sign-up-mode");
                            signupform[0].reset();
                            $(".preview_img").attr("src", "");
                            break;
                        case response.answer = 50:
                            Toast.fire({
                                icon: "success",
                                title: "GRCBGFI",
                                text: response.message
                            });
                            container.removeClass("sign-up-mode");
                            signupform[0].reset();
                            $(".preview_img").attr("src", "");
                            break;
                        case response.answer = 100:
                            Toast.fire({
                                icon: "warning",
                                title: "GRCBGFI",
                                text: response.message
                            });
                            userpassword.val('');
                            userconfpassword.val('');
                            break;
                        case response.answer = 150:
                            Toast.fire({
                                icon: "warning",
                                title: "GRCBGFI",
                                text: response.message
                            });
                            userpassword.val('');
                            userconfpassword.val('');
                            break;
                        case response.answer = 200:
                            Toast.fire({
                                icon: "warning",
                                title: "GRCBGFI",
                                text: response.message
                            });
                            useremail.val('');
                            break;
                        case response.answer = 250:
                            Toast.fire({
                                icon: "warning",
                                title: "GRCBGFI",
                                text: response.message
                            });
                            userphoto.val('');
                            $(".preview_img").attr("src", "");
                            break;
                        case response.answer = 300:
                            useremail.val('');
                            Toast.fire({
                                icon: "warning",
                                title: "GRCBGFI",
                                text: response.message
                            });

                            break;
                        default:
                            break;
                    }

                }
            });
        }
    });

    // Ajax Controller for the Sign in Form   
    const btnconnexion = $("#btnconnexion"),
        emailconnexion = $("#emailconnexion"),
        newURL = document.querySelector('a'),
        passwordconnexion = $("#passwordconnexion");
    btnconnexion.click(function (e) {
        if (signinform[0].checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
            $.ajax({
                url: "../../../GRCBGFI/Controllers/PHPControllers/userController.php",
                type: "POST",
                data: signinform.serialize() + "&action=connexion",
                success: function (response) {
                    var response = JSON.parse(response);
                    console.log(response);
                    switch (response.answer) {
                        case response.answer = 10:
                            Toast.fire({
                                icon: "warning",
                                title: "GRCBGFI",
                                text: response.message
                            });
                            emailconnexion.val('');
                            break;
                        case response.answer = 15:
                            Toast.fire({
                                icon: "warning",
                                title: "GRCBGFI",
                                text: response.message
                            });
                            emailconnexion.val('');
                            break;
                        case response.answer = 25:
                            Toast.fire({
                                icon: "warning",
                                title: "GRCBGFI",
                                text: response.message
                            });
                            passwordconnexion.val('');
                            break;
                        case response.answer = 40:
                            Toast.fire({
                                icon: "warning",
                                title: "GRCBGFI",
                                text: response.message
                            });
                            emailchangepass.val(emailconnexion.val());
                            container.addClass("forgotpass-mode");
                            break;
                        case response.answer = 30:
                            newURL.href = response.message;
                            document.body.appendChild(newURL);
                            newURL.click();
                            signinform[0].reset();
                            break;
                        default:
                            break;
                    }
                }
            });
        }
    });

    // Ajax Controller for changing forgot password by user email
    const btnmodify = $("#btnmodify"),
        changepassemail = $("#emailchangepass"),
        newpass = $("#newpass"),
        newconfpass = $("#newconfpass");
    btnmodify.click(function (e) {
        if (forgotpassform[0].checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
            $.ajax({
                url: "../../../GRCBGFI/Controllers/PHPControllers/userController.php",
                type: "POST",
                data: forgotpassform.serialize() + "&action=modify",
                success: function (response) {
                    var response = JSON.parse(response);
                    console.log(response);
                    switch (response.answer) {
                        case response.answer = 10:
                            Toast.fire({
                                icon: "success",
                                title: "GRCBGFI",
                                text: response.message
                            });
                            container.removeClass("forgotpass-mode");
                            forgotpassform[0].reset();
                            break;
                        case response.answer = 20:
                            Toast.fire({
                                icon: "success",
                                title: "GRCBGFI",
                                text: response.message
                            });
                            newpass.val('');
                            newconfpass.val('');
                            break;
                        case response.answer = 30:
                            Toast.fire({
                                icon: "warning",
                                title: "GRCBGFI",
                                text: response.message
                            });
                            break;
                        case response.answer = 40:
                            changepassemail.val('');
                            Toast.fire({
                                icon: "warning",
                                title: "GRCBGFI",
                                text: response.message
                            });
                            break;
                        case response.answer = 50:
                            changepassemail.val('');
                            Toast.fire({
                                icon: "warning",
                                title: "GRCBGFI",
                                text: response.message
                            });
                            break;
                        default:
                            break;
                    }
                }
            });
        }

    });

    document.addEventListener('visibilitychange', () => {
        if (document.visibilityState === 'hidden') {
            Toast.fire({
                icon: "warning",
                title: "GRCBGFI",
                text: "response.message"
            });
            // alert('come back please');
            // Notification.requestPermission().then(perm => {
            //     if (perm === 'granted') {
            //         const notification = new Notification("a notification", {
            //             body: "Come back please !!!",
            //             data: { hello: "hello word" }
            //         })
            //     }
            // });
        }
    });
});
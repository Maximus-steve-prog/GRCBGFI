$(document).ready(function () {

    const EditUserProfileForm = $(".EditUserProfileForm"),
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

    EditUserProfileForm.on("submit", function (e) {
        e.preventDefault();
        e.stopPropagation();
        $.ajax({
            url: "../../../GRCBGFI/Controllers/PHPControllers/userController.php?action=ChangeProfile",
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
                        EditUserProfileForm[0].reset();
                        $(".preview_img").attr("src", "");
                        break;
                    case response.answer = 50:
                        Toast.fire({
                            icon: "success",
                            title: "GRCBGFI",
                            text: response.message
                        });
                        EditUserProfileForm[0].reset();
                        $(".preview_img").attr("src", "");
                        break;
                    case response.answer = 100:
                        Toast.fire({
                            icon: "warning",
                            title: "GRCBGFI",
                            text: response.message
                        });
                        break;
                    case response.answer = 150:
                        Toast.fire({
                            icon: "warning",
                            title: "GRCBGFI",
                            text: response.message
                        });
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
        })

    });

});
$(document).ready(function () {
    console.clear();
    LoadUserInfo();
    GetProfileUserConnected();

    const btnsend = $(".btnSend"),
        btnNoter = $("#btnNoter"),
        ReclamForm = $("#ReclamationForm"),
        NoteServiceForm = $("#NoteServiceForm"),
        ModalNoterService = $("#ModalNoterService"),
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

    function LoadUserInfo() {
        $.ajax({
            url: "../../../GRCBGFI/Controllers/PHPControllers/ClientController.php",
            type: "POST",
            data: { action: "getuserdata" },
            success: function (response) {
                var response = JSON.parse(response);
                $("#userprofile").html(response.userdata);
                $("#TypeReclam").html(response.ListType);
                $("#ReclamationForm #CliEmail").val(response.ClientData.CliEmail);
                $("#CliEmailNote").val(response.ClientData.CliEmail);
                $("#ReclamationForm #CliFname").val(response.ClientData.CliFname);
                $("#TableService").html(response.ListNotation);
                //  $("table").DataTable();
            }
        });
    }

    function GetProfileUserConnected() {
        $.ajax({
            url: "../../../GRCBGFI/Controllers/PHPControllers/ClientController.php",
            type: "POST",
            data: { action: "getuserdata" },
            success: function (response) {
                var response = JSON.parse(response);
                console.log(response.ClientData.CliPhoto);
                $(".Username").html(response.ClientData.CliFname);
                $(".Profiles #imageProfile").attr("src", "../images/UploadImages/" + response.ClientData.CliPhoto + "");
                $("#ClientProfiles").html(response.ClientProfiles);
                $(".EditClientProfileForm .preview_img").attr("src", "../images/UploadImages/" + response.ClientData.CliPhoto + "");
                $("#CliFname").val(response.ClientData.CliFname);
                $("#CliUsername").val(response.ClientData.CliUsername);
                $("#CliEmail").val(response.ClientData.CliEmail);
                $("#CliDate_naiss").val(response.ClientData.CliDate_naiss);
                $("#CliPhone").val(response.ClientData.CliPhone);
                $(".ClientForm select[name='Sexe']").val(response.ClientData.Sexe);
                $("#Ville").val(response.ClientData.Ville);
                $(".ClientForm select[name='country']").val(response.ClientData.Pays);
                $(".ClientForm input[name='imageclient']").val(response.ClientData.CliPhoto);

            }
        });
    }


    btnsend.click(function (e) {
        if (ReclamForm[0].checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
            $.ajax({
                url: "../../../GRCBGFI/Controllers/PHPControllers/ReclamationController.php",
                type: "POST",
                data: ReclamForm.serialize() + "&action=send",
                success: function (response) {
                    var response = JSON.parse(response);
                    console.log(response);
                    switch (response.answer) {
                        case response.answer = 5:
                            Toast.fire({
                                icon: "success",
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


    btnNoter.click(function (e) {
        if (NoteServiceForm[0].checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
            $.ajax({
                url: "../../../GRCBGFI/Controllers/PHPControllers/ClientController.php",
                type: "POST",
                data: NoteServiceForm.serialize() + "&action=noter",
                success: function (response) {
                    var response = JSON.parse(response);
                    console.log(response);
                    switch (response.answer) {
                        case response.answer = 5:
                            Toast.fire({
                                icon: "success",
                                title: "GRCBGFI",
                                text: response.message
                            });
                            break;
                        default:
                            break;
                    }
                    LoadUserInfo();
                    ModalNoterService.modal('hide');
                }
            });
        }
    });


    $("body").on("click", ".btnNoteService", function (e) {
        e.preventDefault();
        $("#IdNotation").val($(this).attr('id'));
    });

}); 
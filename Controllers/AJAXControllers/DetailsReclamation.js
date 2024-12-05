$(document).ready(function () {

    const Toast = Swal.mixin({
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
    LoardDetailsReclamInfo();
    function LoardDetailsReclamInfo() {
        $.ajax({
            url: "../../../GRCBGFI/Controllers/PHPControllers/ReclamationController.php",
            type: "POST",
            data: { action: "getReclam" },
            success: function (response) {
                var response = JSON.parse(response);
                console.log(response);
                $("#Titre").html(response.details.Titre);
                $("#ReclamId").val(response.details.reclamId);
                $("#Resume").html(response.details.ResumeReclamation);
                $("#DateReclam").html(response.details.Date_Reclam);
                $("#CliEmail").html(response.details.CliEmail);
                $("#CliFname").html(response.details.CliFname);
                $("#Cliname").html(response.details.CliFname);
                $(".getImgSender #imgReclamSend").attr("src", "../images/UploadImages/" + response.details.CliPhoto + "");

            }
        })
    }
    let ReponseForm = $(".ReponseForm");
    $("#Repondre").click(function (e) {
        if (ReponseForm[0].checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
            $.ajax({
                url: "../../../GRCBGFI/Controllers/PHPControllers/ReclamationController.php",
                type: "POST",
                data: ReponseForm.serialize() + "&action=Response",
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
    })

})
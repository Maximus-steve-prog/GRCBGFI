$(document).ready(function () {

    LoadClientData();
    LoadClientNoteInfo();
    const ClientForm = $(".ClientForm"),
        btnRetour = $("#retour"),
        ModalClient = $("#ModalClient");

            $("input.images").change(function () {
                var file = this.files[0];
                var url = URL.createObjectURL(file);
                $(this).closest(".rows").find(".preview_img").attr("src", url);
            });
            ClientForm.on("submit", function (e) {
                if (ClientForm[0].checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();
                    $.ajax({
                        url: "../../../GRCBGFI/Controllers/PHPControllers/ClientController.php?action=createClient",
                        type: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (response) {
                            var response = JSON.parse(response);
                            $(".ClientForm .preview_img").attr("src", "");
                            ModalClient.modal("hide");
                            ClientForm[0].reset();
                            LoadClientData();
                        }
                    });
                }
            });
    btnRetour.click(function () {
        ModalClient.modal("hide");
        ClientForm[0].reset();
    });

    

    $("body").on("click", ".btnEditClient", function (e) {
        e.preventDefault();
        Edit_Client_Id = $(this).attr('id');
        $.ajax({
            url: "../../../GRCBGFI/Controllers/PHPControllers/ClientController.php",
            type: "POST",
            data: { Edit_Client_Id: Edit_Client_Id },
            success: function (response) {
                data = JSON.parse(response);
                $(".ClientForm .preview_img").attr("src", "../images/UploadImages/" + data.CliPhoto + "");
                $("#CliFname").val(data.CliFname);
                $("#CliUsername").val(data.CliUsername);
                $("#CliEmail").val(data.CliEmail);
                $("#CliDate_naiss").val(data.CliDate_naiss);
                $("#CliPhone").val(data.CliPhone);
                $(".ClientForm select[name='Sexe']").val(data.Sexe);
                $("#Ville").val(data.Ville);
                $(".ClientForm select[name='country']").val(data.Pays);
                $(".ClientForm input[name='imageclient']").val(data.CliPhoto);
            }
        })


    });

    $("body").on("click", ".btnDelClient", function (e) {
        e.preventDefault();
        Del_Client_Id = $(this).attr('id');
        Swal.fire({
            title: 'Are you sure ?',
            text: "You won't be able to revert this !",
            icon: 'warning',
            showCancelButton: true,
            confirmBtuttonColor: '#3085d5',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "../../../GRCBGFI/Controllers/PHPControllers/ClientController.php",
                    type: "POST",
                    data: { Del_Client_Id: Del_Client_Id },
                    success: function (response) {
                        Swal.fire(
                            'Deleted',
                            'User deleted successfully',
                            'success'
                        )
                        LoadClientData();
                    }
                });
            }
        });

    });

    function LoadClientData() {
        $.ajax({
            url: "../../../GRCBGFI/Controllers/PHPControllers/dashboardController.php",
            type: "POST",
            data: { action: "GetAllCards" },
            success: function (response) {
                var response = JSON.parse(response);
                $("#ClientTable").html(response.ClientTable);
                
            }
        })
    }

    function LoadClientNoteInfo() {
        $.ajax({
            url: "../../../GRCBGFI/Controllers/PHPControllers/ClientController.php",
            type: "POST",
            data: { action: "ListNoteClient" },
            success: function (response) {
                var response = JSON.parse(response);
                $("#TableNoteClientService").html(response.ListNotationByClient);

            }
        });
    }

});
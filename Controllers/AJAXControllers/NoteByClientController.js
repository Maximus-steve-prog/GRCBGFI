$(document).ready(function (e){

    LoadNoteByClientInfo();
    function LoadNoteByClientInfo() {
        $.ajax({
            url: "../../../GRCBGFI/Controllers/PHPControllers/ClientController.php",
            type: "POST",
            data: { action: "ListNoteClient" },
            success: function (response) {
                var response = JSON.parse(response);
                $("#TableNoteClientService").html(response.ListNotationByClient);
                $("table").DataTable();
            }
        });
    }
})
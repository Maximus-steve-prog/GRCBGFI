$(document).ready(function () {

    DisplayReclamation();
    function DisplayReclamation() {
        $.ajax({
            url: "../../../GRCBGFI/Controllers/PHPControllers/ReclamationController.php",
            type: "POST",
            data: { action: "DisplayListClient" },
            success: function (response) {
                var response = JSON.parse(response);
                $(".listReclamationClient").html(response.displayClient);
                // $("table").DataTable();
            }
        });
    }
    let newURL = document.querySelector('a');
    $("body").on("click", ".btn-getReclamationClient", function (e) {
        e.preventDefault();
        Reclam_IdClient = $(this).attr('id');
        $.ajax({
            url: "../../../GRCBGFI/Controllers/PHPControllers/ReclamationController.php",
            type: "POST",
            data: { Reclam_IdClient: Reclam_IdClient },
            success: function (response) {
                var response = JSON.parse(response);
                console.log(response);
                newURL.href = "../views/DetailReclamationClient.html";
                document.body.appendChild(newURL);
                newURL.click();
            }
        })
    });
})
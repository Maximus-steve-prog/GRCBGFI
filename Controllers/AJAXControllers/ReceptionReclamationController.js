$(document).ready(function () {


    DisplayReclamation();

    setInterval(() => {
        LoardBadgeInfo();
    }, 500);


    LoadUserInfo();

    function DisplayReclamation() {
        $.ajax({
            url: "../../../GRCBGFI/Controllers/PHPControllers/ReclamationController.php",
            type: "POST",
            data: { action: "Display" },
            success: function (response) {
                var response = JSON.parse(response);
                $(".listReclamation").html(response.display);
            }
        });
    }

    function LoadUserInfo() {
        $.ajax({
            url: "../../../GRCBGFI/Controllers/PHPControllers/dashboardController.php",
            type: "POST",
            data: { action: "getuserdata" },
            success: function (response) {
                var response = JSON.parse(response);
                console.log(response.userdata);
                $("#userprofile").html(response.userdata);
            }
        });
    }

    function LoardBadgeInfo() {
        $.ajax({
            url: "../../../GRCBGFI/Controllers/PHPControllers/dashboardController.php",
            type: "POST",
            data: { action: "GetAllCards" },
            success: function (response) {
                var response = JSON.parse(response);
                $(".TotalUntraitedReclamation").html(response.TotalUntraitedReclamation);
                $(".TotalReclamation").html(response.TotalReclamation);
                $(".TotalTraitedReclamation").html(response.TotalTraitedReclamation);

            }
        })
    }

    let newURL = document.querySelector('a');
    $("body").on("click", ".btn-getReclamation", function (e) {
        e.preventDefault();
        Reclam_Id = $(this).attr('id');
        $.ajax({
            url: "../../../GRCBGFI/Controllers/PHPControllers/ReclamationController.php",
            type: "POST",
            data: { Reclam_Id: Reclam_Id },
            success: function (response) {
                var response = JSON.parse(response);
                console.log(response);
                newURL.href = "../views/DetailsReclamation.html";
                document.body.appendChild(newURL);
                newURL.click();
            }
        })
    });
})


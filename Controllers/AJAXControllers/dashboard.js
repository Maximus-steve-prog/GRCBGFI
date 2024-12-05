$(document).ready(function () {
    LoadUserInfo();
    setInterval(() => {
        LoardCardInfo();
    }, 500);

    function LoadUserInfo() {
        $.ajax({
            url: "../../../GRCBGFI/Controllers/PHPControllers/dashboardController.php",
            type: "POST",
            data: { action: "getuserdata" },
            success: function (response) {
                var response = JSON.parse(response);
                $(".Profiles #imageProfile").attr("src", "../images/UploadImages/" + response.data.userphoto + "");
                $("#userprofile").html(response.userdata);
                $("#username").val(response.data.username);
                $("#useremail").val(response.data.useremail);
                $("#username").val(response.data.username);
                $("#Statut").html(response.data.userstatut);
                $("#UserProfiles").html(response.UserProfiles);
                $(".EditUserProfileForm .preview_img").attr("src", "../images/UploadImages/" + response.data.userphoto + "");
            }
        });
    }

    //This function is used to display image before uploading it
    $("input.images").change(function () {
        var file = this.files[0];
        var url = URL.createObjectURL(file);
        $(this).closest(".rows").find(".preview_img").attr("src", url);
    });

    function LoardCardInfo() {
        $.ajax({
            url: "../../../GRCBGFI/Controllers/PHPControllers/dashboardController.php",
            type: "POST",
            data: { action: "GetAllCards" },
            success: function (response) {
                var response = JSON.parse(response);
                $("#Cards").html(response.Cards);
                $(".TotalUntraitedReclamation").html(response.TotalUntraitedReclamation);
                $(".TotalReclamation").html(response.TotalReclamation);
                $(".TotalTraitedReclamation").html(response.TotalTraitedReclamation);
            }
        })
    }

});
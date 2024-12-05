$(document).ready(function (){

    LoardServiceInfo();
    let timerInterval;
    const btnSaveService =$("#btnSaveService"),
          ServiceForm = $(".ServiceForm"),
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


        btnSaveService.click(function (e){
          e.preventDefault();
          e.stopPropagation();
          if(ServiceForm[0].checkValidity()){
              $.ajax({
                url:"../../../GRCBGFI/Controllers/PHPControllers/ServiceController.php",
                type:"POST",
                data: ServiceForm.serialize() +"&action=SaveService",
                success : function (response){
                  var response = JSON.parse(response);
                  switch (response.answer) {
                    case 5:
                      Swal.fire({
                        icon :'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1000,
                        timerProgressBar : true,
                        toast: true,
                        didOpen:(toast)=>{
                          Swal.showLoading();
                          toast.onmouseenter = Swal.stopTimer;
                          toast.onmouseleave = Swal.resumeTimer;
                        },
                        willClose: ()=>{
                          clearInterval(timerInterval);
                        }
                    }).then((result)=>{
                      if(result.dismiss === Swal.DismissReason.timer){
                        console.log("I was closed by the timer");
                      }
                    });
                    break;
                    case 10:
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
          }
        });


        function LoardServiceInfo() {
          $.ajax({
            url: "../../../GRCBGFI/Controllers/PHPControllers/ServiceController.php",
            type: "POST",
            data: { action: "GetServiceList" },
            success: function (response) {
              var response = JSON.parse(response);
              $("#ServiceTable").html(response.listservice);
              $("table").DataTable();
            }
          });
        }



});
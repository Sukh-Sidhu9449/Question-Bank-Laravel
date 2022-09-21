$(document).ready(function () {

    $(function () {
        var timer = $('#quiz_timer').val();
        var quizStartTime = $('#quiz_started_at').val();

        var d2 = new Date();
        var cHour = d2.getHours();
        var cMin = d2.getMinutes();
        var cSec = d2.getSeconds();
        var d2sec = parseInt(cHour * 3600) + parseInt(cMin * 60) + parseInt(cSec);

        var d1 = new Date(quizStartTime);
        var d1cHour = d1.getHours();
        var d1cMin = d1.getMinutes();
        var d1cSec = d1.getSeconds();
        var d1sec = parseInt(d1cHour * 3600) + parseInt(d1cMin * 60) + parseInt(d1cSec) + parseInt(timer * 60);


        var diff = (parseInt(d1sec - d2sec));
        // alert(diff);
        $('#getting').countdown({ until: diff, onExpiry: disableFunction });

        function disableFunction() {

            $('.edit').hide();
            $('.enter').hide();
            $('.update').hide();
            $('.skipAnswer').hide();
            $('.text-info').attr('readonly', true);
            submitQuiz();
         }

         function submitQuiz(){
            $('#msg').show();
            let block_id = $(document).find('#block_id').val();
            // console.log(block_id);
            $.ajax({

                type: "put",
                url: "/upatestatus",
                data: {
                    block_id: block_id
                },
                dataType: "json",
                success: function (response) {
                    // console.log(response);
                    $('#msg').empty();
                   if(response.status==200)
                   {
                    Swal.fire({
                        position: 'top-bottom',
                        icon: 'success',
                        title: 'Your work has been saved',
                        timer: 1500
                      }).then(function () {
                        window.location = "/dashboard";
                    })


                   }
                   else{
                    $.toast({
                        heading: 'Error',
                        text: 'Something Went Wrong',
                        showHideTransition: 'slide',
                        position: 'top-center',
                        icon: 'error',
                        show: 1000
                    })
                   }


                }
            });
        }
    });


});



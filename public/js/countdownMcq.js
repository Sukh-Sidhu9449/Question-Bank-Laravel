$(document).ready(function () {

    $(function () {
        var mcqTimer = $('#mcqTimer').val();
        var mcqStartTime = $('#mcqStartTime').val();
        // console.log(mcqStartTime);
        // console.log(mcqTimer);
        if (mcqTimer == '') {
            $('#gettingMcqTimer').hide();
        } else {
            if (mcqStartTime == '') {
                var d4 = new Date();
                var cHour = d4.getHours();
                var cMin = d4.getMinutes();
                var cSec = d4.getSeconds();
                var d4sec = parseInt(cHour * 3600) + parseInt(cMin * 60) + parseInt(cSec);

                var d3 = new Date();
                var d3cHour = d3.getHours();
                var d3cMin = d3.getMinutes();
                var d3cSec = d3.getSeconds();
                var d3sec = parseInt(d3cHour * 3600) + parseInt(d3cMin * 60) + parseInt(d3cSec) + parseInt(mcqTimer * 60);
            } else {

                var d4 = new Date();
                var cHour = d4.getHours();
                var cMin = d4.getMinutes();
                var cSec = d4.getSeconds();
                var d4sec = parseInt(cHour * 3600) + parseInt(cMin * 60) + parseInt(cSec);

                var d3 = new Date(mcqStartTime);
                var d3cHour = d3.getHours();
                var d3cMin = d3.getMinutes();
                var d3cSec = d3.getSeconds();
                var d3sec = parseInt(d3cHour * 3600) + parseInt(d3cMin * 60) + parseInt(d3cSec) + parseInt(mcqTimer * 60);
            }

            var diff = (parseInt(d3sec - d4sec));
            console.log(diff);
            $('#gettingMcqTimer').countdown({ until: diff });

            function disableFunction() {
                $('.enter').each(function () {
                    let answer = $(this).parent().find('.text-info').val();
                    let question_id = $(this).parent().find('input').val();
                    let quiz_id = $(this).parent().find('#quiz_id').val();;
                    let last_id = $(this).parent().find('.last_id').val();

                    if (last_id == '') {
                        if (answer == '') {
                            var ans ='Skipped Answer';
                        }else{
                            var ans =answer;
                        }
                        $.ajax({
                            type: "post",
                            url: "/insertanswer",
                            data: {
                                answer: ans,
                                question_id: question_id,
                                quiz_id: quiz_id
                            },
                            dataType: "json",
                            success: function (response) {
                                if (response.success == true) {
                                    $.toast({
                                        text: 'Yes! Inserted succesfully>.',
                                        hideAfter: 1000,
                                        icon: 'success',
                                        position: 'bottom-center',
                                        showHideTransition: 'slide'
                                    })
                                }
                            }
                        });
                    }
                });
                submitQuiz();
            }

            function submitQuiz() {
                $('#msg').show();
                let block_id = $(document).find('#block_id').val();
                $.ajax({

                    type: "put",
                    url: "/upatestatus",
                    data: {
                        block_id: block_id
                    },
                    dataType: "json",
                    success: function (response) {
                        $('#msg').empty();
                        if (response.status == 200) {
                            Swal.fire({
                                position: 'top-bottom',
                                icon: 'success',
                                title: 'Your work has been saved',
                                timer: 1500
                            }).then(function () {
                                window.location = "/dashboard";
                            })
                        }
                        else {
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
        }
    });
});



$(document).ready(function () {
    $('#mcq_submit').click(function (e) {
        e.preventDefault();
        var mcqcorrect = 0;
        let totalQuestions=$('#totalMcqQuestions').val();
        let mcqBlockQuestionId=$('#mcqBlockQuestionId').val();
        let mcqQuizId=$('#mcqQuizId').val();


        $('.mcq_insert').each(function () {
            let answer = $(this).parent().find('input:radio.answerRadio:checked');
            $(answer).each(function () {
                let idVal = $(this).attr("id");
                var insertedmcq = ($("label[for='" + idVal + "']").text());
                var correctmcqanswer = ($(this).parent().parent().find('input[name="correctAnswer"]').val());

                if (insertedmcq == correctmcqanswer) {
                    var marksPerQues = 1;
                    mcqcorrect++;
                }else{
                    var marksPerQues = 0;
                }
                $.ajax({
                    type: "post",
                    url: "/user/mcq-insert",
                    data: {
                        mcqQuizId:mcqQuizId,
                        mcqBlockQuestionId:mcqBlockQuestionId,
                        insertedmcq:insertedmcq,
                        marksPerQues:marksPerQues
                    },
                    dataType: "json",
                    success: function (response) {
                        if(response.status == 200){
                            $.toast({
                                text: 'Yes! Inserted succesfully>.',
                                hideAfter: 1000,
                                icon: 'success',
                                position: 'bottom-center',
                                showHideTransition: 'slide'
                            })
                        }else {
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
            });
        });
        let mcqAggregate = ((parseInt(mcqcorrect)/parseInt(totalQuestions))*100)+'%';
        // console.log(mcqAggregate);

        if(mcqAggregate != ""){
            Swal.fire({
                position: 'bottom',
                icon: 'success',
                title: 'Your aggregate is'+mcqAggregate,
                timer: 1500
            }).then(function () {
                submitMcqQuiz(mcqAggregate);
                window.location = "/dashboard";
            })
        }
    });

    function submitMcqQuiz(mcqAggregate) {
        // $('#msg').show();
        let mcqQuizId=$('#mcqQuizId').val();
        // console.log(block_id);
        $.ajax({

            type: "put",
            url: "/user/mcq-statusupdate",
            data: {
                mcqQuizId: mcqQuizId,
                mcqAggregate:mcqAggregate
            },
            dataType: "json",
            success: function (response) {
                // console.log(response);

            }
        });
    }
});


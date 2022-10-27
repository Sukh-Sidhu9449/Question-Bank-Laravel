$(document).ready(function () {
    $('#mcq_submit').click(function (e) {
        e.preventDefault();
        var mcqcorrect = 0;
        let totalQuestions=$('#totalMcqQuestions').val();
        $('.mcq_insert').each(function () {
            let answer = $(this).parent().find('input:radio.answerRadio:checked');
            $(answer).each(function () {
                var idVal = $(this).attr("id");
                var insertedmcq = ($("label[for='" + idVal + "']").text());
                var correctmcqanswer = ($(this).parent().parent().find('input[name="correctAnswer"]').val());

                if (insertedmcq == correctmcqanswer) {
                    mcqcorrect++;
                }
            });
        });
        // console.log(mcqcorrect);
        // console.log(totalQuestions);
        let mcqAggregate = ((parseInt(mcqcorrect)/parseInt(totalQuestions))*100)+'%';
        console.log(mcqAggregate);
    });
});


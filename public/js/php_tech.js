$(document).ready(function(){
    $('#tech_question_display').hide();
    $('.link').click(function(){
        var id= $(this).data("id");
        // alert(id);
        $('#tech_question_display').toggle();
        $('.div1').hide();
    });

});

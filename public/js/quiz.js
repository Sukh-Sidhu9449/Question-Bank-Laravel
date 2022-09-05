$(document).ready(function () {
    $('#load_frameworks_quiz').hide();
    $('#load_question_quiz').hide();

    var quiz_count =0;
      $(document).on('click','#clickable_quiz',function (e) {
        e.preventDefault();
        // alert();
        let id = $(this).data('id');
        $('#load_technologies_quiz').hide();
        $('#load_frameworks_quiz').show();
        $('#dynamic_frameworks_quiz').empty();
        $('.spinner-grow').show();

        $.ajax({
            type: "get",
            url: "/admin/frameworks/"+id,
            dataType: "json",
            success: function (response) {
                // window.history.pushState('new','title','/admin/frameworks/'+id);
                if (response.status == 200) {
                    $frame_data = '<div class="row justify-content-left">';
                    // console.log(response);
                    $.each(response.frameworks, function (key, value) {
                        $frame_data += `<div class="col-lg-4 col-md-12">
                                        <div id="white_boxx">
                                            <div id="clickframeworkquiz" data-id="`+ value.id + `" data-name="` + value.framework_name + `">
                                                <h4>`+ value.framework_name + ` &nbsp;<i class="bi bi-arrow-right-circle icon_hover"></i></h4>
                                            </div>
                                        </div>
                                    </div>`;
                        $('#quiz_technology_id').val(value.technology_id);
                        $('#quiz_technology_name').val(value.technology_name);
                    });
                    $frame_data += '</div>';
                    $('.spinner-grow').hide();
                    $('#dynamic_frameworks_quiz').append($frame_data);

                } else if (response.status == 404) {
                    $.each(response.technology, function (key, value) {
                        $('#quiz_technology_id').val(value.id);
                        $('#quiz_technology_name').val(value.technology_name);
                        $('.spinner-grow').hide();
                    $('#dynamic_frameworks_quiz').append('<img src="/img/no-record-found.gif" width=100%>');

                        // $('#frame_technology_id').val(value.id);
                        // $('#frame_technology_name').val(value.technology_name);
                    });
                }


            }
        });
    });

    function FetchQuizQuestion(tech_id,id,exp_id,limit) {
        // $('#test_table').html('');
        $("#test_table > tbody"). empty();
        quiz_count=0;
        $.ajax({
            type: "get",
            url: "/admin/quiz/questions",
            data: {
                tech_id:tech_id,
                frame_id:id,
                exp_id:exp_id,
                limit:limit,
                quiz_count:quiz_count
            },
            dataType: "json",
            success: function (response) {
                // console.log(response);
                if(response.status==200)
                {
                    let i = 1;
                    var questions_data = "";
                    $.each(response.questions, function (key, value) {
                        questions_data+=`<tr>
                                            <td><input type="checkbox" value="`+value.id+`"></td>
                                            <td>`+i+`</td>
                                            <td>`+value.question+`</td>
                                         </tr>`;
                                         i++;
                    });
                    $('#test_table').append(questions_data);
                    // $('#pageloader_quiz_button').show();
                    if(response.questions.length==limit){
                        $('#pageloader_quiz_button').show();
                    }else{
                        $('#pageloader_quiz_button').hide();

                    }
                }
                else
                if(response.status==404)
                {
                    $('#pageloader_quiz_button').hide();
                    $("#test_table > tbody"). empty();
                    // $('#test_table').html('<img src="/img/no-record-found.gif" width=100%>');

                }
            }
        });
    }
    $(document).on('click', '#clickframeworkquiz',function (e) {
        e.preventDefault();
        $('#load_frameworks_quiz').hide();
        $('#load_question_quiz').show();
        let tech_id= $('#quiz_technology_id').val();
        let id = $(this).data('id');
        let exp_id=0;
        let limit=$('#quiz_page_limit').find(":selected").text();
        $('#quiz_framework_id').val(id);
        // console.log(limit);
        FetchQuizQuestion(tech_id,id,exp_id,limit)

    });

    $('#select-all').click(function(event) {
        var $that = $(this);
        $(':checkbox').each(function() {
            this.checked = $that.is(':checked');
        });
    });

    //Page Loader
    $('#pageloader_quiz_button').click(function () {
        let frame_id = $('#quiz_framework_id').val();
        let tech_id= $('#quiz_technology_id').val();
        let experience_id=$('#quiz_experience').find(":selected").val();
        let limit=$('#quiz_page_limit').find(":selected").text();
        quiz_count++;
        // alert(count);
        $('#pageloader_quiz_button').hide();
        $('#quiz_page_loader_image').show();
        $.ajax({
            type: "get",
            url: "/admin/quiz/questions",
            data: {
                tech_id:tech_id,
                frame_id:frame_id,
                exp_id:experience_id,
                limit:limit,
                quiz_count:quiz_count
            },
            dataType: "json",
            success: function (response) {
                // console.log(response);
                if(response.status==200)
                {
                    let i=parseInt((quiz_count*limit)+1);
                    var questions_data = "";
                    $.each(response.questions, function (key, value) {
                        questions_data+=`<tr>
                                            <td><input type="checkbox" value="`+value.id+`"></td>
                                            <td>`+i+`</td>
                                            <td>`+value.question+`</td>
                                         </tr>`;
                                         i++;
                    });
                    $('#test_table').append(questions_data);
                    $('#quiz_page_loader_image').hide();
                    let total=parseInt(quiz_count*limit)+parseInt(limit);

                    let totalrecord=parseInt(quiz_count*limit)+parseInt(response.questions.length);

                    if(total==totalrecord){
                         $('#pageloader_quiz_button').show();
                    }else{
                        $('#pageloader_quiz_button').hide();
                    }
                }
                else
                if(response.status==404)
                {
                    // $("#test_table > tbody"). empty();
                    // $('#test_table').html('<img src="/img/no-record-found.gif" width=100%>');

                }
            }
        });

    });

    //Page Limit
    $('#quiz_page_limit').on('change', function() {
        let page_limit= this.value ;
        let frame_id = $('#quiz_framework_id').val();
        let tech_id= $('#quiz_technology_id').val();
        let experience_id=$('#quiz_experience').find(":selected").val();

        FetchQuizQuestion(tech_id,frame_id,experience_id,page_limit);
        // alert(page_limit);
      });

      //Select experience
    $('#quiz_experience').on('change', function() {
        let experience_id= this.value ;
        let frame_id = $('#quiz_framework_id').val();
        let tech_id= $('#quiz_technology_id').val();
        let limit=$('#quiz_page_limit').find(":selected").text();
        // alert(tech_id);
        FetchQuizQuestion(tech_id,frame_id,experience_id,limit);
        // alert($page_limit);
    });


});

$(document).ready(function () {
    $('#tech_question_display').hide();
    $('#tech_question_display_1').hide();
    $('#page_loader_image').hide();
    $('#icon-back').click(function () {
        $('#tech_question_display').hide();
        $('.div2').show();
    });
    $('#icon-back_1').click(function () {
        $('#tech_question_display_1').hide();
        $('.framework_div').show();
    });
   var loc= $(location).attr('pathname');
   var idloc =loc.split('/');
   var pathname=idloc[idloc.length-2];
   var lastEl = idloc[idloc.length-1];
//    console.log(lastEl);
//    console.log(pathname);
   if(pathname=='user_tech')
   {

       var nav=$(this).find(".tech-link");
       nav.each(function() {
        var navData=$(this).data("id");
        if(navData==lastEl){
           let litag= $(this).closest('li');
           litag.addClass('active2');
            // console.log(litag);
        }

       });
   }


    var limit = 10;
    var count = 0;
    var onuserchange=0;



    function FetchUserQuestions(fid,experience_id,limit,count){

        count=0;
        $.ajax({
            method: "get",
            url: "/core_php",
            data: {
                fid: fid,
                experience_id: experience_id,
                limit: limit,
                count:count
            },
            dataType: "json",
            success: function (response) {
                // console.log(response);
                if (response.status == 200) {
                    $question_data = '';
                    let i = 1;
                    $.each(response.ques, function (key, value) {
                        $question_data += `<div class="col-lg-12 col-md-12">
                        <h4 class="mb-4 fw-bold"><span>Q`+ i + `.</span>` + value.question + `</h4>
                        <p><span><b>Ans</b>.</span>&nbsp;&nbsp;&nbsp;`+ value.answer + `</p>
                        </div><hr>`;
                        i++;

                    });
                    $('#ques').append($question_data);
                    $('#page_loader_image').hide();
                    let total = parseInt(count * limit) + parseInt(limit);

                    let totalrecord = parseInt(count * limit) + parseInt(response.ques.length);

                    if (total == totalrecord) {
                        $('#pageloader_button').show();
                    } else {
                        $('#pageloader_button').hide();
                    }

                }else if(response.status==404){
                    $('#pageloader_button').hide();
                    $('#page_loader_image').hide();
                    var url = '/user_img/img/100465-no-data-found.gif';
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'No record Found!',
                        timer:1000
                    })

                    $('#ques').append('<img src="'+url+'" style="width:90%; height:400px;">');


                }

            }
        });
    }

    // $('.nav-framework-link').click(function(e){
    //     e.preventDefault();
    //     var id= $(this).data("id");
    //     // console.log(id);
    //     if(id == null || id == undefined){
    //         return false;
    //     }
   

    
    //     $.ajax({
    //         method:"get",
    //         url:"/user_framework/"+id,
    //         success:function(response){
    //          if(response)
    //          {
    //             // window.location.href="/user_tech/"+id;
    //          }
    //         }

    //     });
    // });

    $('.framework-link').click(function () {
        var fid = $(this).data("id");
        // var tech_id = $(this).data("techid");
        // $('#tech_id').val(tech_id);
        $('#frame_id').val(fid);


        var experience_id =0;
        // console.log(fid);
        // console.log(tech_id);
        $('#tech_question_display').toggle();
        $('.div2').hide();
        $('#ques').empty();
        FetchUserQuestions(fid,experience_id,limit,count);

    });


    // ***************experience fetching code********************************

    $('#experience_id').on('change', function () {

        let experience_id = $('#experience_id').find(":selected").val();
        onuserchange=1;
        // console.log( experience_id);

        // var tech_id = $('#tech_id').val();
        var fid = $('#frame_id').val();
        $('#frame_id').val(fid);
        $('#experiance_id').val(experience_id);
        // console.log(fid);
        // console.log( tech_id);
         $('#ques').empty();
         FetchUserQuestions(fid,experience_id,limit,count);

    });

    $('#pageloader_button').click(function() {
        if(onuserchange==1){
            count=0;
            onuserchange=0;
        }
        count++;
        $('#page_loader_image').show();
        $('#pageloader_button').hide();
        let experience_id = $('#experience_id').find(":selected").val();
        // console.log( experience_id);

        var fid = $('#frame_id').val();


        $.ajax({
            method: "get",
            url: "/core_php",
            data: {
                fid: fid,
                experience_id: experience_id,
                limit: limit,
                count:count
            },
            dataType: "json",
            success: function (response) {
                // console.log(response);
                if (response.status == 200) {
                    $question_data = '';
                    let i = (count * limit) + 1;
                    $.each(response.ques, function (key, value) {
                        $question_data += `<div class="col-lg-12 col-md-12">
                        <h4 class="mb-4 fw-bold"><span>Q`+ i + `.</span>` + value.question + `</h4>
                        <p><span>Ans.</span>&nbsp;&nbsp;&nbsp;`+ value.answer + `</p>
                        </div><hr>`;
                        i++;

                    });
                    $('#ques').append($question_data);
                    $('#page_loader_image').hide();
                    let total = parseInt(count * limit) + parseInt(limit);

                    let totalrecord = parseInt(count * limit) + parseInt(response.ques.length);

                    if (total == totalrecord) {
                        $('#pageloader_button').show();
                    } else {
                        $('#pageloader_button').hide();
                    }

                 }else if(response.status==404){
                    $('#pageloader_button').hide();
                    $('#page_loader_image').hide();
                 }

            }
        });
    });


    function FetchFrameQuestions(fid,experience_id,limit = 10,count = null){
    
        count=0;
        $.ajax({
            method: "get",
            url: "/core_php",
            data: {
                fid: fid,
                experience_id: experience_id,
                limit: limit,
                count:count
            },
            dataType: "json",
            success: function (response) {
                // console.log(response);
                if (response.status == 200) {
                    $question_data = '';
                    let i = 1;
                    $.each(response.ques, function (key, value) {
                        $question_data += `<div class="col-lg-12 col-md-12">
                        <h4 class="mb-4 fw-bold"><span>Q`+ i + `.</span>` + value.question + `</h4>
                        <p><span><b>Ans</b>.</span>&nbsp;&nbsp;&nbsp;`+ value.answer + `</p>
                        </div><hr>`;
                        i++;
    
                    });
                    $('#ques_1').append($question_data);
                    $('#page_loader_image_1').hide();
                    let total = parseInt(count * limit) + parseInt(limit);
    
                    let totalrecord = parseInt(count * limit) + parseInt(response.ques.length);
    
                    if (total == totalrecord) {
                        $('#pageloader_button_1').show();
                    } else {
                        $('#pageloader_button_1').hide();
                    }
    
                }else if(response.status==404){
                    $('#pageloader_button_1').hide();
                    $('#page_loader_image_1').hide();
                    var url = '/user_img/img/100465-no-data-found.gif';
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'No record Found!',
                        timer:1000
                    })
    
                    $('#ques_1').append('<img src="'+url+'" style="width:90%; height:400px;">');
                }
    
            }
        });
    }
    
    $('.framework-ques-link').click(function () {
        let fid = $(this).data("id");
        // var tech_id = $(this).data("techid");
        // $('#tech_id').val(tech_id);
        $('#frame_id_1').val(fid);
    
    // alert(fid);
        let experience_id =0;
        // console.log(fid);
        // console.log(tech_id);
        $('#tech_question_display_1').show();
        $('.framework_div').hide();
        $('#ques_1').empty();
        FetchFrameQuestions(fid,experience_id);
    
    });
    
    $('#experience_id_1').on('change', function () {
    
        let experience_id = $('#experience_id_1').find(":selected").val();
        onuserchange=1;
        // console.log( experience_id);
    
        // var tech_id = $('#tech_id').val();
        let fid = $('#frame_id_1').val();
        // $('#frame_id_1').val(fid);
        $('#experiance_id_2').val(experience_id);
        // console.log(fid);
        // console.log( tech_id);
         $('#ques_1').empty();
        //  console.log(experience_id,"experience_id");
        //  console.log(fid,"fid");
         FetchFrameQuestions(fid,experience_id);
    
    });
    
    $('#pageloader_button_1').click(function() {
        if(onuserchange==1){
            count=0;
            onuserchange=0;
        }
        count++;
        $('#page_loader_image_1').show();
        $('#pageloader_button_1').hide();
        let experience_id = $('#experience_id_1').find(":selected").val();
        // console.log( experience_id);
    
        var fid = $('#frame_id_1').val();
    
    
        $.ajax({
            method: "get",
            url: "/core_php",
            data: {
                fid: fid,
                experience_id: experience_id,
                limit: limit,
                count:count
            },
            dataType: "json",
            success: function (response) {
                // console.log(response);
                if (response.status == 200) {
                    $question_data = '';
                    let i = (count * limit) + 1;
                    $.each(response.ques, function (key, value) {
                        $question_data += `<div class="col-lg-12 col-md-12">
                        <h4 class="mb-4 fw-bold"><span>Q`+ i + `.</span>` + value.question + `</h4>
                        <p><span>Ans.</span>&nbsp;&nbsp;&nbsp;`+ value.answer + `</p>
                        </div><hr>`;
                        i++;
    
                    });
                    $('#ques_1').append($question_data);
                    $('#page_loader_image_1').hide();
                    let total = parseInt(count * limit) + parseInt(limit);
    
                    let totalrecord = parseInt(count * limit) + parseInt(response.ques.length);
    
                    if (total == totalrecord) {
                        $('#pageloader_button_1').show();
                    } else {
                        $('#pageloader_button_1').hide();
                    }
    
                 }else if(response.status==404){
                    $('#pageloader_button_1').hide();
                    $('#page_loader_image_1').hide();
                 }
    
            }
        });
    });
});

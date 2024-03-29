
$(document).ready(function(){

    //JqValidation for Create  quiz block
    $('#McqDescriptionForm').validate({
       rules:{
           test_description: {
               required: true,
           }
       },
       messages: {
           test_description: {
               required: "Please add description",
           },
       },
       errorPlacement: function(error, element) {
           error.appendTo('#errorspan');
         },success:function(){
           $('.make_test').removeAttr('disabled');
         }
   });

//fetch frameworks with technology
   $("#load_Mcq_quiz").hide();
   $("#frameWorksT").hide();
   $(document).on ('click','#GoNext',function(e){
       e.preventDefault();
      // alert("hwll");
       var technologyId=[];
       $('.technologyCheck').each(function() {
           if($(this).is(":checked")){
               technologyId.push($(this).data('id'));
              // console.log(technologyId);
           }
       });
       technologyId=technologyId.toString();
      // $('#quiz_technology_id').val(technologyId);
       //console.log(technologyId);
       $(".technologyName").hide();
       $("#GoNext").hide();
       $("#frameWorksT").show();
       $("#Technologynmae").hide();
       $.ajax({
           type:"get",
           url:"/admin/QuizBlocks/Frameworks",
           data:{technologyId:technologyId},
           dataType:"json",
           success:function(response){
               //console.log(response);
               if(response.status==200){
                   $frame ='<div class="row justify-content-left">';
                   $.each(response.frameworks, function(key,value){
                       $frame +=`<div class="col-lg-4 col-md-12">
                                       <div id="whiteBox">
                                           <div id="clickFrameworksQuiz" data-id="`+ value.id + `" data-name="` + value.framework_name + `">
                                               <h4>`+ value.framework_name +`</h4>
                                           </div>
                                           <div id="iconsGap">
                                               <input type="checkbox" data-id="`+ value.id + `" class="frameworksCheck">
                                           </div>
                                       </div>
                                   </div>`;
                       //console.log($frame);
                   });
                   $frame += `</div>
                   <div>
                   <button id="mcqGoBtn" class="btn btn-success">Next </button>
                   </div>`;
                      //console.log($frame);
                      $("#frameworksNamee").append($frame);
               }
           }
       });
   });

   //for mcq questions
   $(document).on("click",'#mcqGoBtn',function(e){
       e.preventDefault();
       $(".content").hide();
       $("#load_Mcq_quiz").show();
       let frameworkId = [];
       $('.frameworksCheck').each(function () {
           if($(this).is(":checked")){
               frameworkId.push($(this).data('id'));
           }
       });
       frameworkId=frameworkId.toString();
       $('#mcq_framework_id').val(frameworkId);
       let experienceId = 0;
       let limitt = $('#McqPageLimit').find(":selected").val();
       FetchMcqQuestions(frameworkId, experienceId, limitt);
   });

   //Function for Fetching Mcq
   function FetchMcqQuestions(frameworkId,experienceId,limitt){
       QuizCount = 0;
       $.ajax({
           type:"get",
           url:"/admin/Mcq/questions/",
           data:{
               frameworkId: frameworkId,
               experienceId: experienceId,
               limitt: limitt,
               QuizCount: QuizCount},
           dataType:"json",
           success : function(response){
               if(response.status==200){
                   let i = 1;
                   var questionsName = "";
                          //console.log(questionsName);
                   $.each(response.mcq_questions, function(key,value){
                       questionsName += `<tr>
                                           <td><input type="checkbox" class="mcq_checkbox" data-id="`+ value.id + `"></td>
                                           <td>`+ i + `</td>
                                           <td>`+ value.mcq_questions + `</td>
                                       </tr>`;
                                       i++;
                   });
                   $('#Mcqquestions > tbody').html(questionsName);
                   if(response.mcq_questions.length == limitt){
                       $("#pageloader_mcq_button").show();
                   }else{
                       $("#pageloader_mcq_button").hide();
                   }
               }
           }
       });
   }
   //Select experience
   $("#mcq_experience").on('change',function(){
       let frameworkId = $('#mcq_framework_id').val();
       let experienceId =this.value;
       let limitt = $('#McqPageLimit').find(":selected").val();
       FetchMcqQuestions(frameworkId, experienceId,limitt);
   });
   //page limit
   $("#McqPageLimit").on ('change', function(){
       let page_limitt = this.value;
       let frameworkId = $('#mcq_framework_id').val();
       let experienceId = $('#mcq_experience').find(":selected").val();
       FetchMcqQuestions(frameworkId,experienceId,page_limitt);
   });

   //Select all Functionality
   $(document).on('click','#select-all-mcq',function(e){
       e.preventDefault();
       var $selectMcq = $(this);
       $('.mcq_checkbox').each (function(){
           this.checked = $selectMcq.is(':checked');
       });
   });

   //Create a mcq module
   $('.mcq_test').on('click', function(e){
       e.preventDefault();
       $('#McqDescriptionForm').valid();
       let block_name=$('#mcqDescription').val();
       let timer=$('#mcqTimer').val();
       let type=$('#typeMCQ').val();
       // console.log(type);

       var insert = [];
       $('.mcq_checkbox').each(function () {
           if ($(this).is(":checked")) {
               insert.push($(this).data('id'));
           }
       });
       insert=insert.toString();
       $(this).attr('disabled', true);
       if(insert==''){
           $.toast({
               heading: 'Warning',
               text: 'Please select any question. ;)',
               showHideTransition: 'plain',
               position: {
                   right: 50,
                   bottom: 30
               },
               icon: 'warning'
           })
           return false;
       }
          //console.log(insert);
          $.ajax({
           type: "Post",
           url: "/admin/quiz/questions",
           data: {
               block_name:block_name,
               insert:insert,
               timer:timer,
               type:type
           },
           dataType: "json",
           success: function (response) {
               if(response.status==200){

                   swal.fire({
                       title: 'Added',
                       text: 'Quiz Block Added Successfully',
                       icon: 'success',
                       timer: 1000
                   }).then(function () {
                       window.location='/admin/indexblock';
                   });
               }
           }
       });
   });
});



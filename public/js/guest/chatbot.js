'use strict'
Swal.fire({
  title: "Are you ready for Interview?",
  html:  
  "<br>" +
  '<button type="button" role="button" tabindex="0" class="start_interview customSwalBtn">' + 'Start' + '</button>' ,
  icon: "warning",
  showConfirmButton: false,
  showCancelButton: false
});
let dataArray =[];
let outputArray =[];
let storedData ;
let nextTranscript = '' ;
// var blob;
let log = console.log.bind(console),
  id = val => document.getElementById(val),
  ul = id('ul'),
  gUMbtn = id('gUMbtn'),
  start = id('start'),
  stop = id('stop'),
  video =id('video'),
  stream,
  recorder,
  counter=1,
  chunks,
  media;

  $(document).on('click', '.start_interview', function() {
    // window.location = "/video";
    // window.location = "/video/" + quiz_id;
    start.click();
    swal.clickConfirm();
  });
  start.onclick = e => {
  // let mv = id('mediaVideo'),
  let mv = true,

      mediaOptions = {
        video: {
          tag: 'video',
          type: 'video/webm',
          ext: '.mp4',
          gUM: {video: true, audio: true}
        },
        audio: {
          tag: 'audio',
          type: 'audio/ogg',
          ext: '.ogg',
          gUM: {audio: true}
        }
      };
  media = mv ? mediaOptions.video : mediaOptions.audio;
  navigator.mediaDevices.getUserMedia(media.gUM).then(_stream => {
    stream = _stream;
    
    video.srcObject = stream;
    video.muted = true;
    // id('gUMArea').style.display = 'none';
    // id('btns').style.display = 'inherit';
    start.removeAttribute('disabled');
    recorder = new MediaRecorder(stream);
    startRecording();
    startchatbot();
    recorder.ondataavailable = e => {
      chunks.push(e.data);
      if(recorder.state == 'inactive')  makeLink();
    };
    log('got media successfully');
  }).catch(log);
}
function startRecording(){
  start.disabled = true;
  stop.removeAttribute('disabled');
  chunks=[];
  recorder.start();
}
// start.onclick = e => {
  
// }


stop.onclick = e => {
  stop.disabled = true;
  recorder.stop();
  start.removeAttribute('disabled');
}







let i = 0;
const skipQues = document.getElementById("skip");
skipQues.addEventListener("click", skipQuestion);
const nextQues = document.getElementById("nextQues");
const repeatQues = document.getElementById("repeatQues");
nextQues.addEventListener("click", nextQuestion);
repeatQues.addEventListener("click", repeatQuestion);
const chatBtn = document.getElementById("chatquestion-btn");
chatBtn.addEventListener("click", play);
const botQuizId = document.getElementById("botQuizId").value;

function startchatbot() {
  $(document).ready(function() { 
    $.ajax({
      url: '/chatbot-questions',
      type: 'get',
      data:{
        quiz_id : botQuizId
      },
      dataType: 'json',
      success:async function(data) {
        if(data.length > 0){
          dataArray = data;
          botActivated();
        }
      }
    });
  });
}

async function botActivated(){
  if((dataArray.length) == i){
    skipQues.style.visibility = 'hidden';
    nextQues.style.visibility = 'hidden';
  }else{
    skipQues.style.visibility = 'visible';
    nextQues.style.visibility = 'visible';
    repeatQues.style.visibility = 'visible';

  }
  storedData = {'technology':dataArray[i].technology,'question':dataArray[i].question,'correctAnswer':dataArray[i].answer,'userAnswer':"skipped"};
  var countVar =false;
  let counter = 10000;
  let countRep = 0 ;
  document.getElementById("chatquestion").innerHTML = dataArray[i].question;
  document.getElementById("chatanswer").innerHTML = '';
  chatBtn.innerHTML = dataArray[i].question;
  chatBtn.click();
  document.getElementById("date").innerHTML = currentTime();
  // getting answer for user in audio
  await setSleep(1000);
  chatBtn.innerHTML = "you can speak now";
  chatBtn.click();
  document.getElementById("user-date").innerHTML = currentTime();
  const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
  const recognition = new SpeechRecognition();
  // recognition.lang= 'en-MX';
  recognition.continuous = true;
  recognition.interimResults = true;
  recognition.start();
  // recognition.Timeouts.EndSilenceTimeout = ;
  recognition.onsoundstart = () => {
    console.log("Some sound is being received");
  };
  recognition.onspeechend = () => {
    console.log("Speech has stopped being detected","------>");
  };

  recognition.onresult = function(event) {
    
    // console.log(event.results,"res");
    // console.log(SpeechRecognition,"????????????????")
    var transcript = event.results[event.results.length - 1][0].transcript;
    // console.log(transcript, ">>>>>>>>>>>>>>>>>>>>>>>>>>>");
    
    if(transcript){
      countVar  = true;
    }
   
    if (event.results[event.results.length - 1].isFinal == true) {
      countRep++;
      var countDownDate = new Date().getTime() + counter;
      findDiff(countDownDate,countRep);
      let str = outputHandler(event.results);
      document.getElementById("chatanswer").innerHTML = str;
      nextTranscript = str;
    }
    function findDiff(countDownDate,count){
      // console.log(countVar,"countVar");
      // console.log(countRep);
      if(countVar){
        countVar = false;
        countDownDate = new Date().getTime() + counter;
        // return;
      }
      let currentCountTime = new Date().getTime();
      diff = countDownDate - currentCountTime;
      // console.log(diff,"diff");
      if(diff < 0){
          if(count == countRep){
            // console.log(event.results[0],"timer finish");
            // opArray.push(event.results);
            let userInput = outputHandler(event.results);
            // console.log(userInput,"user");
            document.getElementById("chatanswer").innerHTML = userInput;
              storedData.userAnswer = userInput;
              outputArray = [...outputArray,storedData]
              i++;
              if (i < dataArray.length) {
                botActivated();
              }else{
                recognition.stop();
                // console.log(outputArray,"outputArray");
                // console.log(JSON.stringify(outputArray),"json");
                dispatchArray(outputArray);
              }
          }
        return;
      }
      setTimeout(()=>{findDiff(countDownDate,count)},1000); 
    }   
  };
}

async function dispatchArray(opArr) {
  stop.click();
  // console.log(blob,"blobblobblob");
  // let optionalSkills = $('#optionalSkills').val();
  // let mandatorySkills = $('#mandatorySkills').val();
  // $('#cover-spin').show(0);
  // $.ajax({
  //     url: 'https://questionbankapi.appsndevs.com/upload/',
  //     type: 'post',
  //     data:{
  //       Optional:optionalSkills,
  //       Mandatory:mandatorySkills,
  //       quiz_id:dataArray[0].quiz_id,
  //       file: JSON.stringify(opArr),
  //       video: blob
  //     },
  //     success: function(response) {
  //       console.log(response);
  //       if(response != null){
  //         $.ajax({
  //           url: '/api/v1/interview-data',
  //           // url: 'https://questionbank.appsndevs.com/api/v1/interview-data',
  //           type: 'post',
  //           data:{
  //             quizId:dataArray[0].quiz_id,
  //             interviewData: JSON.stringify(response)
  //           },
  //           success: function(response) {
  //             console.log(response);
  //             $('#cover-spin').hide(0);
  //             window.location.href = '/dashboard';
  //           },
  //           error: function (error) {
  //             $('#cover-spin').hide(0);
  //             window.location.href = '/dashboard';
  //           }
  //         });
  //       }
  //     }
  // });
}

function play() {
  if ("speechSynthesis" in window) {
    // console.log(,"e");
    let working = new SpeechSynthesisUtterance(chatBtn.innerHTML);
    working.rate = 0.90;
    window.speechSynthesis.speak(working);
  } else {
    console.log("Browser not supported");
  }
}

function currentTime(){
  return new Date().toLocaleString();
}

function setSleep(ms) {
  return new Promise((resolve) => setTimeout(resolve, ms));
}

function outputHandler(value) {
  let str ='';
  Object.values(value).forEach(val => {
    if(str == ""){
      str = val[0].transcript;
    }else{
      str += " " +val[0].transcript;
    }
  });
  // console.log(str,"str");
  return str? str:"";
}


function insertAnswer() {
  // $.ajax({
    //   url: 'insertanswer',
    //   type: 'post',
    //   headers:{'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
    //   dataArray: {
      //     question_id: dataArray[i].id,
      //     quiz_id: dataArray[i].quiz_id,
      //  // audio: transcript,
      //     answer: transcript
      //   },
      //   success: function(response) {
        //     console.log(response);
        //   }
        // });
}
      
function skipQuestion() {
  window.speechSynthesis.cancel();
  outputArray = [...outputArray,storedData]
  i++;
  if (i < dataArray.length) {
    botActivated();
  }else{
    skipQues.style.visibility = 'hidden';
    nextQues.style.visibility = 'hidden';
    repeatQues.style.visibility = 'hidden';
    // console.log(outputArray,"outputArray");
    dispatchArray(outputArray);
    }
}

function nextQuestion(){
  window.speechSynthesis.cancel();
  if(nextTranscript != "" && nextTranscript != undefined){
    storedData.userAnswer = nextTranscript;
    outputArray = [...outputArray,storedData]
    nextTranscript = '';
  }else{
    outputArray = [...outputArray,storedData]
  }
  i++;
  if (i < dataArray.length) {
    botActivated();
  }else{
    skipQues.style.visibility = 'hidden';
    nextQues.style.visibility = 'hidden';
    repeatQues.style.visibility = 'hidden';
    // console.log(outputArray,"outputArray");
    dispatchArray(outputArray);
  }
}

function repeatQuestion() {
  window.speechSynthesis.cancel();
  botActivated();
}


function makeLink(){
  video.srcObject = null;
  let blob = new Blob(chunks, {type: media.type })

//    , url = URL.createObjectURL(blob)
//    , li = document.createElement('li')
//    , mt = document.createElement(media.tag)
//    , hf = document.createElement('a')
//  ;
//  mt.controls = true;
//  mt.src = url;
//  hf.href = url;
//  hf.download = `${counter++}${media.ext}`;
//  hf.innerHTML = `donwload ${hf.download}`;
//  li.appendChild(mt);
//  li.appendChild(hf);
//  ul.appendChild(li);

// console.log(blob,"blob");
//   const formData = new FormData();
//   formData.append('_token',  $('meta[name="csrf-token"]').attr('content'));
//   formData.append('video', blob);
//   fetch('/save', {
//     method: 'POST',
//     body:  
//   })
//   .then(response => {
//       console.log(response);
//   })
//   .catch(error => {});

// console.log(blob,"blobblobblob");
jQuery.noConflict();
  let optionalSkills = jQuery('#optionalSkills').val();
  let mandatorySkills = jQuery('#mandatorySkills').val();
  const formData = new FormData();
  formData.append('Optional', optionalSkills);
  formData.append('Mandatory', mandatorySkills);
  formData.append('quiz_id', dataArray[0].quiz_id);
  formData.append('file', JSON.stringify(outputArray));
  formData.append('blob', blob );
  jQuery('#cover-spin').show(0);
  jQuery.ajax({
      // url: 'https://questionbankapi.appsndevs.com/upload/',http://10.8.14.83:9099/upload/
      // url:'http://10.8.14.83:9099/upload/',
      url:'/save-chatbot-questions',
      type: 'post',
      data:formData,
      cache : false,
      processData: false,
      success: function(response) {
        // console.log(response);
        if(response != null){
          return false;
          jQuery.ajax({
            url: '/api/v1/interview-data',
            // url: 'https://questionbank.appsndevs.com/api/v1/interview-data',
            type: 'post',
            data:{
              quizId:dataArray[0].quiz_id,
              interviewData: JSON.stringify(response),
              userInput:JSON.stringify(outputArray),
            },
            success: function(response) {
              // console.log(response);
              jQuery('#cover-spin').hide(0);
              window.location.href = '/dashboard';
            },
            error: function (error) {
              jQuery('#cover-spin').hide(0);
              window.location.href = '/dashboard';
            }
          });
        }
      }
  });
}
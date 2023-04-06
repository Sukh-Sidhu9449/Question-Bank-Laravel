
let i = 0;
const skipQues = document.getElementById("skip");
skipQues.addEventListener("click", skipQuestion);
const chatBtn = document.getElementById("chatquestion-btn");
chatBtn.addEventListener("click", play);
const botQuizId = document.getElementById("botQuizId").value;
// console.log(botQuizId,"botQuizId");
let dataArray =[];
let outputArray =[];
let storedData ;
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
          // console.log(data[0].quiz_id);
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
  }else{
    skipQues.style.visibility = 'visible';
  }
  storedData = {'technology':dataArray[i].technology,'question':dataArray[i].question,'correctAnswer':dataArray[i].answer,'userAnswer':"skipped"};
//  console.log(dataArray[i].technology,"dataArray[i].technology"); 
  var countVar =false;
  let counter = 10000;
  let countRep = 0 ;
  // if(i != 0) await setSleep(4000);
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
    console.log(transcript, ">>>>>>>>>>>>>>>>>>>>>>>>>>>");
    if(transcript){
      countVar  = true;
    }
   
    if (event.results[event.results.length - 1].isFinal == true) {
      countRep++;
      var countDownDate = new Date().getTime() + counter;
      findDiff(countDownDate,countRep);
      let str = outputHandler(event.results);
      document.getElementById("chatanswer").innerHTML = str;
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
            console.log(event.results[0],"timer finish");
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
                console.log(outputArray,"outputArray");
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

function dispatchArray(opArr) {
  $('#cover-spin').show(0);
  stop.click();
  $.ajax({
      url: 'http://10.8.14.83:9099/upload/',
      type: 'post',
      data:{
        quiz_id:dataArray[0].quiz_id,
        file: JSON.stringify(opArr)
      },
      success: function(response) {
        console.log(response);
        if(response != null){
          $.ajax({
            // url: '/api/v1/interview-data',
            url: 'https://questionbank.appsndevs.com/api/v1/interview-data',
            type: 'post',
            data:{
              quizId:2,
              interviewData: JSON.stringify(response)
            },
            success: function(response) {
              console.log(response);
              $('#cover-spin').hide(0);
              window.location.href = '/dashboard';
            },
            error: function (error) {
              $('#cover-spin').hide(0);
              window.location.href = '/dashboard';
            }
          });
        }
      }
  });
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
  console.log(str,"str");
  return str? str:"";
}

function skipQuestion() {
  outputArray = [...outputArray,storedData]
  i++;
  if (i < dataArray.length) {
    botActivated();
  }else{
    skipQues.style.visibility = 'hidden';
    console.log(outputArray,"outputArray");
    dispatchArray(outputArray);
  }
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



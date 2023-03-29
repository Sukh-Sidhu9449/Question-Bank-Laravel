let op = [];
     let storedData = {'question':"what is comp",'correctAnswer':"dataArray[i].answer",'userAnswer':"userInput"};
        op =[...op,storedData];
        sp={'question':"what is comp",'correctAnswer':"dataArray[i].answer",'userAnswer':"userInput"};
        op = [...op,sp];
        dispatchArray(op);  

let i = 0;
const chatBtn = document.getElementById("chatquestion-btn");
chatBtn.addEventListener("click", play);
let dataArray =[];
let outputArray =[];
function startchatbot() {
  $(document).ready(function() {
    $.ajax({
      url: 'chatbot-questions',
      type: 'get',
      data:{
        quiz_id : 2
      },
      dataType: 'json',
      success:async function(data) {
        if(data.length > 0){
          console.log(data);
          dataArray = data;
          botActivated();
        }
      }
    });
  });
}

async function botActivated(){
 console.log(dataArray[i].technology,"dataArray[i].technology"); 
  var countVar =false;
  let counter = 10000;
  let countRep = 0 ;
  let opArray = [];
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
              let storedData = {'question':dataArray[i].question,'correctAnswer':dataArray[i].answer,'userAnswer':userInput};
              outputArray = [...outputArray,storedData]
              i++;
              if (i < dataArray.length) {
                botActivated();
              }else{
                recognition.stop();
                console.log(outputArray,"outputArray");
                dispatchArray(outputArray);
              }
          }
        return;
      }
      setTimeout(()=>{findDiff(countDownDate,count)},1000); 
    }
          
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
   
  };
}

function dispatchArray(opArr) {
  $.ajax({
      url: 'http://10.8.21.185:8000/upload/',
      type: 'post',
      // headers:{'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
      data:{
        file: JSON.stringify(opArr)
      },
      success: function(response) {
        console.log(response);
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



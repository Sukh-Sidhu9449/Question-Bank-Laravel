// 'use strict'
// Swal.fire({
//   title: "Are you ready for Interview?",
//   html:  
//   "<br>" +
//   '<button type="button" role="button" tabindex="0" class="start_interview customSwalBtn">' + 'Start' + '</button>' ,
//   icon: "warning",
//   showConfirmButton: false,
//   showCancelButton: false
// });

// var blob;
// let log = console.log.bind(console),
//   id = val => document.getElementById(val),
//   ul = id('ul'),
//   gUMbtn = id('gUMbtn'),
//   start = id('start'),
//   stop = id('stop'),
//   video =id('video'),
//   stream,
//   recorder,
//   counter=1,
//   chunks,
//   media;

//   $(document).on('click', '.start_interview', function() {
//     // window.location = "/video";
//     // window.location = "/video/" + quiz_id;
//     start.click();
//     swal.clickConfirm();
//   });
//   start.onclick = e => {
//   // let mv = id('mediaVideo'),
//   let mv = true,

//       mediaOptions = {
//         video: {
//           tag: 'video',
//           type: 'video/webm',
//           ext: '.mp4',
//           gUM: {video: true, audio: true}
//         },
//         audio: {
//           tag: 'audio',
//           type: 'audio/ogg',
//           ext: '.ogg',
//           gUM: {audio: true}
//         }
//       };
//   media = mv ? mediaOptions.video : mediaOptions.audio;
//   navigator.mediaDevices.getUserMedia(media.gUM).then(_stream => {
//     stream = _stream;
    
//     video.srcObject = stream;
//     video.muted = true;
//     // id('gUMArea').style.display = 'none';
//     // id('btns').style.display = 'inherit';
//     start.removeAttribute('disabled');
//     recorder = new MediaRecorder(stream);
//     startRecording();
//     startchatbot();
//     recorder.ondataavailable = e => {
//       chunks.push(e.data);
//       if(recorder.state == 'inactive')  makeLink();
//     };
//     log('got media successfully');
//   }).catch(log);
// }
// function startRecording(){
//   start.disabled = true;
//   stop.removeAttribute('disabled');
//   chunks=[];
//   recorder.start();
// }
// // start.onclick = e => {
  
// // }


// stop.onclick = e => {
//   stop.disabled = true;
//   recorder.stop();
//   start.removeAttribute('disabled');
// }



// function makeLink(){
//    blob = new Blob(chunks, {type: media.type })
//   video.srcObject = null;

//   //   , url = URL.createObjectURL(blob)
//   //   , li = document.createElement('li')
//   //   , mt = document.createElement(media.tag)
//   //   , hf = document.createElement('a')
//   // ;
//   // mt.controls = true;
//   // mt.src = url;
//   // hf.href = url;
//   // hf.download = `${counter++}${media.ext}`;
//   // hf.innerHTML = `donwload ${hf.download}`;
//   // li.appendChild(mt);
//   // li.appendChild(hf);
//   // ul.appendChild(li);

// console.log(blob,"blob");
// //   const formData = new FormData();
// //   formData.append('_token',  $('meta[name="csrf-token"]').attr('content'));
// //   formData.append('video', blob);
// //   fetch('/save', {
// //     method: 'POST',
// //     body:  
// //   })
// //   .then(response => {
// //       console.log(response);
// //   })
// //   .catch(error => {});
// }
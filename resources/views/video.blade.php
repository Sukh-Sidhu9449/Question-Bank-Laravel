<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questionbank BOT</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.js"
        integrity="sha512-nO7wgHUoWPYGCNriyGzcFwPSF+bPDOR+NvtOYy2wMcWkrnCNPKBcFEkU80XIN14UVja0Gdnff9EmydyLlOL7mQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <style>
        h1 {
            font-family: sans-serif;
            color: #333;
        }

        body {

            margin-top: 0px;
            margin-bottom: 50px;
        }

        #video {
            width: 481px;
            height: 355px;
            background-color: #666;
        }

        #container {
            margin-top: 20px;
            width: 500px;
            height: 375px;
            border: 10px #3333333b solid;

        }

        #container2 {
            margin-top: 170px; 
            /* margin-left: 702px;
            /* /* width: 500px; */
            height: 560px; 
            /* border: 10px #333 solid;
            background-color: #333; */

        }





        .button {
            margin-right: 60px;
            margin-left: 29px;
            display: inline-block;
            padding: 15px 25px;
            font-size: 24px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            border-radius: 15px;
            box-shadow: 0 9px #999;
        }

        .button1 {
            background-color: white;
            color: black;
            border: 2px solid #4CAF50;
        }

        .button1:hover {
            background-color: #4CAF50;
            color: white;
        }

        .button2 {
            background-color: white;
            color: black;
            border: 2px solid #eb0b0b;
        }

        .button2:hover {
            background-color: #d31010;
            color: white;
        }

        .button3 {
            display: inline-block;
            border-radius: 4px;
            background-color: #f4511e;
            border: none;
            color: #FFFFFF;
            text-align: center;
            font-size: 17px;
            padding: 13px;
            width: 132px;
            transition: all 0.5s;
            cursor: pointer;
            margin: -7px;
            margin-top: 138px;
        }

        .button3 span {
            cursor: pointer;
            display: inline-block;
            position: relative;
            transition: 0.5s;
        }

        .button3 span:after {
            content: '\00bb';
            position: absolute;
            opacity: 0;
            top: 0;
            right: -20px;
            transition: 0.5s;
        }

        .button3:hover span {
            padding-right: 25px;
        }

        .button3:hover span:after {
            opacity: 1;
            right: 0;
        }

        .py-5 {
            padding-top: 0rem !important;
            padding-bottom: 0rem !important;
        }

        .col-xl-4 {
            flex: 0 0 auto;
            width: 100.33333333%;
        }

        ;

        section.style {
            background-color: #eee;
            margin-left: 676px;
            margin-top: -558px;
        }

        section {
            margin-left: 558px;
            margin-top: -558px;
        }

        #searchbox {
            margin-left: 530px;
            width: 225.333334px;
            height: 43.333334px;
        }

        #searchbutton {
            margin-left: 767px;
            margin-top: -68px;


        }

        #nav1 {
            background-color: #f68d2cdb;
        }

        #form {

            width: 500px;
            height: 40px;

        }

        .card {
            margin-right: 45px;
            margin-left: 72px;
        }
    </style>

</head>

<body>

    <div id="container" enctype="multipart/form-data">
        <p><video id="video" autoplay="True" width=320></p>
        <p><button class="button button1" id="start" 
                >Start Call</button>
                {{-- onclick=" startFunction(); startchatbot();  startaudioRec()" --}}
            <button class="button button2" id="stop" > Stop Call</button>
            {{-- onclick="download(); stopaudioRec();" --}}
        </p>
    </div>
    {{-- <a href="{% url 'binaryvideos' %}"><button class="button3" style="vertical-align:middle"><span>Go to video </span></button></a> --}}


    <section  style="background-color: #eee;">
        <div id="container2" class="container py-5">

            <div class="row d-flex justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">

                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center p-3"
                            style="border-top: 4px solid #ffa900;">
                            <h5 class="mb-0">Chat messages</h5>
                            <div class="d-flex flex-row align-items-center">
                                <span class="badge bg-warning me-3"></span>
                                <i class="fas fa-minus me-3 text-muted fa-xs"></i>
                                <i class="fas fa-comments me-3 text-muted fa-xs"></i>
                                <i class="fas fa-times text-muted fa-xs"></i>
                            </div>
                        </div>
                        <div class="card-body" data-mdb-perfect-scrollbar="true"
                            style="position: relative; height: 400px">

                            <div class="d-flex justify-content-between">
                                <p class="small mb-1">CHATBOT</p>
                                <p class="small mb-1 text-muted", id="date"></p>
                            </div>
                            <div class="d-flex flex-row justify-content-start">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava5-bg.webp"
                                    alt="avatar 1" style="width: 45px; height: 100%;">
                                <div>
                                    <p class="small p-2 ms-3 mb-3 rounded-3" id="chatquestion"
                                        style="background-color: #f5f6f7;"></p>
                                    <button id="chatquestion-btn" hidden></button>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <p class="small mb-1 text-muted" id="user-date"></p>
                                <p class="small mb-1">User</p>
                            </div>
                            <div class="d-flex flex-row justify-content-end mb-4 pt-1">
                                <div>
                                    <p class="small p-2 me-3 mb-3 text-white rounded-3 bg-warning" id="chatanswer"></p>
                                </div>
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp"
                                    alt="avatar 1" style="width: 45px; height: 100%;">
                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </div>
    </section>
    <script src='{{ asset('js/chatbot.js') }}'></script>
    <script src='{{ asset('js/video.js') }}'></script>
</body>

</html>




{{-- <!DOCTYPE html>
<html>
  <head>
    <title>Questionbank</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="WebRTC getUserMedia MediaRecorder API">
    <link type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
      button{
        margin: 10px 5px;
      }
      li{
        margin: 10px;
      }
      body{
        width: 90%;
        max-width: 960px;
        margin: 0px auto;
      }
      #btns{
        display: none;
      }
      h1{
        margin: 100px;
      }
    </style>
  </head>
  <body>
    <h1> MediaRecorder</h1>

    {{-- <p> For now it is supported only in Firefox(v25+) and Chrome(v47+)</p> --}}
{{-- <div id='gUMArea'>
      <div>
      Record:
        <input type="radio" name="media" value="video" checked id='mediaVideo'>Video
        <input type="radio" name="media" value="audio">audio
      </div>
      <button class="btn btn-default"  id='gUMbtn'>Request Stream</button>
    </div>
    <div id='btns'>
      <button  class="btn btn-default" id='start'>Start</button>
      <button  class="btn btn-default" id='stop'>Stop</button>
    </div>
    <div>
      <ul  class="list-unstyled" id='ul'></ul>
    </div> --}}
{{-- <button id="close_account">Show</button> --}}
{{-- <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script src='{{ asset('js/video.js') }}'></script>

  </body> --}}
{{-- </html> --}}

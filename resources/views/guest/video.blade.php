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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>

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
            width: 100%;
            height: 355px;
            background-color: #666;
            margin: 0 auto;
        }

        #container {
            max-width: 100%;
            height: 375px;
            border: 10px #3333333b solid;

        }

        #container2 {
            margin-top: 170px;
            height: 560px;
        }

        .button {
            padding: 5px 10px 5px 10px;
            display: inline-block;
            font-size: 18px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 11px #e7e7e7;
            transition: 1s
        }

        .button1 {
            visibility: hidden;
            margin: 0 auto;
            background-color: white;
            color: black;
            border: 2px solid #4CAF50;
        }

        .button1:hover {
            background-color: #4CAF50;
            color: white;
        }

        .button2 {
            visibility: hidden;
            background-color: white;
            color: black;
            border: 2px solid #eb0b0b;
        }

        .button2:hover {
            background-color: #d31010;
            color: white;
        }

        .button4 {
            width: 50%;
            visibility: hidden;
            background-color: white;
            color: black;
            border: 2px solid #f0ed3f;
            margin: 20px 10px 20px auto;
        }

        .swal2-modal .swal2-icon,
        .swal2-modal .swal2-success-ring {
            margin-top: 20px !important;
            margin-bottom: 42px;
        }

        .customSwalBtn {
            background-color: #1f3bb3;
            border: 0;
            border-radius: 3px;
            box-shadow: none;
            color: #fff;
            cursor: pointer;
            font-size: 17px;
            font-weight: 500;
            margin: 30px 5px 0px 5px;
            padding: 10px 32px;
        }

        @media (min-width:576px) {
            .button4 {
                width: 30%;
            }

        }

        .button4:hover {
            background-color: #696413;
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



        .col-xl-4 {
            flex: 0 0 auto;
            width: 100.33333333%;
        }

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


        #cover-spin {
            position: fixed;
            width: 100%;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.7);
            z-index: 9999;
            display: none;
        }

        @-webkit-keyframes spin {
            from {
                -webkit-transform: rotate(0deg);
            }

            to {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        #cover-spin::after {
            content: '';
            display: block;
            position: absolute;
            left: 48%;
            top: 40%;
            width: 40px;
            height: 40px;
            border-style: solid;
            border-color: black;
            border-top-color: transparent;
            border-width: 4px;
            border-radius: 50%;
            -webkit-animation: spin .8s linear infinite;
            animation: spin .8s linear infinite;
        }
    </style>

</head>

<body>
    <header>
        <div class="d-flex justify-content-between align-items-center py-3 px-4"
            style=" 
        background: #F4F5F7;
    ">
            <a href="#">
                <img class="w-25" src="{{ asset('images/Question-Bank-Logo.webp') }}" alt="logo" />
            </a>

            <h3 class="pe-5">Good Afternoon, {{ $username }}</h3>
        </div>
    </header>
    <div class="container-fluid">
        <div class="p-xl-5 py-3">

            <div class="row gy-4">
                <div class="col-lg-5">
                    <div class="mx-auto " enctype="multipart/form-data">
                        <div class="mb-3 mx-auto  " id="container">
                            <video id="video" autoplay="True" min-width=320px>
                        </div>
                        <div class=" d-flex flex-column justify-content-center align-items-center "><button
                                class="button button1" id="start">Start Call</button>
                            {{-- onclick=" startFunction(); startchatbot();  startaudioRec()" --}}
                            <button class="button button2" id="stop"> Stop Call</button>
                            {{-- onclick="download(); stopaudioRec();" --}}
                        </div>

                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card w-lg-75  me-xl-auto mx-auto">
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
                        <div style="display:flex; ">
                            <button class="button button4" id="repeatQues">Repeat Question</button>
                            <button class="button button4" id="skip">Skip Question</button>
                            <button class="button button4" id="nextQues">Next Question</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <div id="cover-spin"></div>
    {{-- <a href="{% url 'binaryvideos' %}"><button class="button3" style="vertical-align:middle"><span>Go to video </span></button></a> --}}


    <section>
        <input type="text" name="quizId" id="botQuizId" value="{{ $quizId }}" hidden>
        <input type="text" name="mandatorySkills" id="mandatorySkills" value="{{ $mandatorySkills }}" hidden>
        <input type="text" name="optionalSkills" id="optionalSkills" value="{{ $optionalSkills }}" hidden>

    </section>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src='{{ asset('js/guest/chatbot.js') }}'></script>
    <script src='{{ asset('js/guest/video.js') }}'></script>

</body>

</html>


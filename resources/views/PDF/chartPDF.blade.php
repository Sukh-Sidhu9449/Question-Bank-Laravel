<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
             *{
            font-family: Arial, Helvetica, sans-serif
            }
            .body{
                padding: 10px;
            }
            .logo{
                position: fixed;
                margin-top: -100px;
                /* text-align: center; */
                margin-bottom: 0px;
            }
            .flex-container{
                display: flex;
                flex-wrap: wrap;
                /* font-size: 30px; */
                text-align: center;
            }
            .text-center{
                text-align: center;
            }
            .mb-2{
                margin-bottom: 50px;
            }
            /* .left{
                float: left;
            }
            .right{
                float: right;
            }
            .flex{
                display: flex;
            } */
            /* .center{
                display: flex;
                justify-content: center;
            } */
            .flex-item-left {
                display: inline-flex;
                justify-content: start;
                /* background-color: #f1f1f1; */
                padding: 10px;
                flex: 40%;
            }

            .flex-item-left p{
                margin: 0px;
                text-align:justify;
                font-size: 14px;
                
            }

            .flex-item-right {
                /* background-color: rgb(255, 255, 255); */
                margin-left: 20px;
                padding: 10px;
                flex: 30%;
            }
            .bio-div{
                width: 200px;
            }
            .flex-item-center{
                display: inline-flex;
                /* background-color: #f1f1f1; */
                padding: 10px;
                flex: 30%;
            }
            .m-0{
                margin: 0px;
            }
            .candidate-assessment-left{
                display: inline-flex;
                /* justify-content: start; */
                /* background-color: #f1f1f1; */
                padding: 10px;
                flex: 33%;
            }
            .candidate-assessment-center{
                display: inline-flex;
                /* background-color: #f1f1f1; */
                padding: 10px;
                flex: 33%;
            }
            .candidate-assessment-right{
                display: inline-flex;
                /* margin-left: 20px; */
                padding: 10px;
                flex: 34%;
            }
        </style>
    </head>
    {{-- @dd($techChart); --}}
    <body class="antialiased">
        <div>
            <img src="{{ public_path('img/19862.jpg') }}" alt="" width="100%" height="100px">
        </div>
        <div class="logo">
            <img src="{{ public_path('img/seasialogo.png') }}" alt="" height="50px">
        </div>
        <h2 class="text-center mb-2">Candidate Feedback Report</h2>
        <div class="flex-container">
                <div class="flex-item-left">
                  <p>#IN002{{random_int(1000, 9999)}}</p>
                  @if($userData)
                    <p style="font-size: 20px; font-weight: 500;">{{$userData['name']?$userData['name']:'Username'}}</p>  
                    <p>{{$userData['designation']?$userData['designation']:'React Developer'}}</p>  
                    <p>{{$userData['phoneNumber']?$userData['phoneNumber']:'9990979450'}} |{{$userData['email']?$userData['email']:'anoopa.p@codilar.com'}} </p>  
                    <p>Exp.{{$userData['experience']?($userData['experience']):'6'}}</p>  
                    <p>{{$userData['submittedAt']?$userData['submittedAt']:'July 29, 2022 05:30:00 pm IST'}}</p>   
                  @else
                    <p style="font-size: 20px; font-weight: 500;">Username</p>  
                    <p>React Developer</p>  
                    <p>9990979450 | anoopa.p@codilar.com</p>  
                    <p>Exp. 6</p>  
                    <p>July 29, 2022 05:30:00 pm IST</p>
                  @endif
                </div>
                <img class="flex-item-center" src="https://quickchart.io/chart?w=130&h=100&c={{ $charts['mainChart'][0] }}" width="175px"  />
                <img class="flex-item-right" src="{{ public_path('img/dummy-profile-pic.jpg') }}" width="125px"/>
        </div>
        <h2 class="text-center ">Analytics</h2>
        <div class="flex-container">
            <img style="text-align: center" src="https://quickchart.io/chart?c={{ $charts['mainChart'][1] }}" width="50%" height="300px"/>
        </div>
        <h2 class="text-center mb-2">Candidate Assessment</h2>
        <div class="flex-container">
            <div class="candidate-assessment-left">
                {{-- <div class="candidate-assessment-center"> --}}
                    <img class="" src="https://quickchart.io/chart?w=120&h=100&c={{ $charts['techChart'][0] }}" width="175px" />
                    <br>
                    <span >Some text is written here</span>
                {{-- </div> --}}
            </div>
            <div class="candidate-assessment-center">
                <img class="" src="https://quickchart.io/chart?w=120&h=100&c={{ $charts['techChart'][1] }}" width="175px" />
                <br>
                <span >Some text is written here</span>
            </div>
            <div class="candidate-assessment-right">
                <img class="" src="https://quickchart.io/chart?w=120&h=100&c={{ $charts['techChart'][2] }}" width="175px" />
                <br>
                <span >Some text is written here</span>
            </div>
        </div>

    </body>
</html>

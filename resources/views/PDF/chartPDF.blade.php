<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Interview-PDF</title>
    <!-- Fonts -->

    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            /* border: 1px solid yellow; */
        }

        body {
            background: #F5F6FA;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <table style="max-width: 813px; margin: 0 auto;  background: #F5F6FA; font-size: 13px;">
        <!-- top-bar -->
        <tbody>
            <tr>
                <td>
                    <img src="{{ public_path('images/top-bar.png') }}"
                        style="margin-bottom: 15px; width: 100%; height: auto;" alt="logo">
                </td>
            </tr>
            <!-- feedback-report -->
            <tr>
                <td style=" padding:0 30px;">
                    <h3
                        style="text-align:center; font-size: 22px; color: #202529; padding: 20px 0 0 5px; font-weight: 700;">
                        Candidate Feedback Report
                    </h3>
                </td>

            </tr>
            <tr>
                <td>
                    <table style="width: 100%; padding:20px 30px;">
                        <tbody>
                            <tr>
                                <td style="width: 40%;  padding-left: 30px;">
                                    <p style="  padding: 5px 0; color: #6C737B; font-size: 14px;">
                                        #IN0053{{ random_int(1000, 9999) }}</p>
                                    @isset($userData)
                                        <h2 style="color: #13B1B7; font-weight: 500; font-size: 18px; padding-bottom: 5px;">
                                            {{ $userData['name'] ? $userData['name'] : 'Username' }}</h2>
                                        <p style=" padding: 5px 0;color: #6C737B; font-size: 14px;">
                                            {{ $userData['designation'] ? $userData['designation'] : 'React Developer' }}
                                        </p>
                                        <p style=" padding: 5px 0;color: #6C737B; font-size: 14px;">
                                            {{ $userData['phoneNumber'] ? $userData['phoneNumber'] : '9990979450' }}
                                            |{{ $userData['email'] ? $userData['email'] : 'anoopa.p@codilar.com' }}
                                        </p>
                                        <p style=" padding: 5px 0;color: #6C737B; font-size: 14px;">Exp.
                                            {{ $userData['experience'] ? $userData['experience'] : '6' }}</p>
                                        <p style=" padding: 5px 0;color: #6C737B; font-size: 14px;">
                                            {{ $userData['submittedAt'] ? $userData['submittedAt'] : 'July 29, 2022 05:30:00 pm IST' }}
                                        </p>
                                    @else
                                        <h2 style="color: #13B1B7; font-weight: 500; font-size: 18px; padding-bottom: 5px;">
                                            Username</h2>
                                        <p style=" padding: 5px 0;color: #6C737B; font-size: 14px;">React Developer</p>
                                        <p style=" padding: 5px 0;color: #6C737B; font-size: 14px;">9990979450 |
                                            anoopa.p@codilar.com
                                        </p>
                                        <p style=" padding: 5px 0;color: #6C737B; font-size: 14px;">Exp. 6</p>
                                        <p style=" padding: 5px 0;color: #6C737B; font-size: 14px;">July 29, 2022
                                            05:30:00pm
                                            IST
                                        </p>
                                    @endisset

                                </td>

                                <td style="width: 25%;">
                                    <img src="https://quickchart.io/chart?w=130&h=100&c={{ $charts['mainChart'][0] }}"
                                        style="width:175px" alt="chart" />
                                </td>
                                <td style="width: 35%; text-align: end; padding-right: 40px;">
                                    <img src="{{ public_path('img/dummy-profile-pic.jpg') }}"
                                        style="width:180px; height:140px" alt="profile-pik" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <!-- analytics -->
            <tr>
                <td>
                    <table style="width:100%; padding:10px 30px;">
                        <tbody>
                            <tr>
                                <td style=" border-bottom: 1px solid #DCDBE0;">
                                    <h2
                                        style="text-align:center; font-size: 26px; color: #202529; padding:10px 0 4px 0; line-height: 40px;">
                                        Analytics</h2>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h3 style="text-align:center; margin:0; color:#202529; padding: 15px 0 ;">Avg Global
                                        Skills vs Candidate Skills
                                    </h3>
                                </td>
                            </tr>
                            <tr>
                                <td style=" text-align: center;">
                                    <img src="https://quickchart.io/chart?c={{ $charts['mainChart'][1] }}"
                                        style="max-width:80%; height:300px" alt="chart" />
                                </td>
                            </tr>
                            <!-- candidate-assessment -->
                            <tr>
                                <td>
                                    <h3
                                        style=" margin: 25px 0 0px 0; text-align:center; font-size: 18px; font-weight: normal;">
                                        Candidate Assessment
                                    </h3>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table style="width: 100%; padding:  0 30px;  border-collapse: separate; border-spacing: 20px 0px;">
                        <tbody>
                            <tr>
                                @foreach ($charts['topTechChart'] as $topChart)
                                    <td style="width: 30%; text-align: center;">
                                        <img src="https://quickchart.io/chart?w=120&h=100&c={{ $topChart }}"
                                            style="width:150px;" alt="chart">
                                        <p style="margin-top: 15px; font-size: 13px;">
                                            @isset($userData)
                                                <span
                                                    style=" font-weight:700;">{{ $userData['name'] ? $userData['name'] : 'Username' }}
                                                </span>
                                            @else
                                                <span style=" font-weight:700;">User
                                                </span>
                                            @endisset
                                            scored
                                            less than
                                            <span style=" font-weight:700;">66.7% </span> of the
                                            Total Candidates Interviewed
                                        </p>
                                    </td>
                                @endforeach
                                {{-- <td style="width: 30%; text-align: center; ">
                                    <img src="https://quickchart.io/chart?w=120&h=100&c={{ $charts['techChart'][1] }}"
                                        style="width:150px;" alt="chart">
                                    <p style="margin-top: 15px; font-size: 13px;">
                                        @isset($userData)
                                            <span
                                                style=" font-weight:700;">{{ $userData['name'] ? $userData['name'] : 'Username' }}
                                            </span>
                                        @else
                                            <span style=" font-weight:700;">User
                                            </span>
                                        @endisset
                                        scored
                                        less than
                                        <span style="font-weight:700;">66.7% </span> of the
                                        Total Candidates Interviewed
                                    </p>
                                </td>
                                <td style="width: 30%; text-align: center; ">
                                    <img src="https://quickchart.io/chart?w=120&h=100&c={{ $charts['techChart'][2] }}"
                                        style="width:150px; " alt="chart">
                                    <p style="margin-top: 15px; font-size: 13px;">
                                        @isset($userData)
                                            <span
                                                style=" font-weight:700;">{{ $userData['name'] ? $userData['name'] : 'Username' }}
                                            </span>
                                        @else
                                            <span style=" font-weight:700;">User
                                            </span>
                                        @endisset

                                        scored
                                        less than
                                        <span style=" font-weight:700;">66.7% </span> of the Total Candidates
                                        Interviewed
                                    </p>
                                </td> --}}
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <!-- mandatory -->
            @if (!empty($charts['mandatoryData']['mandatoryChart']))
                <tr style="page-break-before: always">
                    <td>
                        <h2
                            style="text-align:center;  font-size: 26px; color: #202529; padding:20px 0 30px 0px; line-height: 40px;">
                            Mandatory Skills
                        </h2>
                    </td>
                </tr>
                <tr>
                    <td style="padding:0 30px;">
                        <div style="border-bottom: 1px solid #DCDBE0; padding-bottom: 24px; width:100%;">
                            @foreach ($charts['mandatoryData']['mandatoryChart'] as $mandateChart)
                                <div
                                    style="width: 27%; background-color: white;padding: 13px; border-radius: 20px; display:inline-block; margin:6px 6px ">
                                    <table style="width: 100%;; background-color: #F7FDFD; border-radius:14px; ">
                                        <tbody>
                                            <tr>
                                                <td style="width: 30%;">
                                                    <img src="https://quickchart.io/chart?w=120&h=100&c={{ $mandateChart }}"
                                                        style="width: 70px; height: auto;" alt="chart-circle" />
                                                </td>
                                                <td style="text-align: start; padding: 0; margin: 0;">
                                                    <p style="margin:0; font-size:13px; font-weight: bolder;">
                                                        {{ $charts['mandatoryData']['mandatoryTechnology'][$loop->index] }}
                                                    </p>
                                                    <ul
                                                        style="padding-left:10px; margin:5px 0 0 0 ; font-size:10px; font-weight: bolder; color:#CF0A0A;">
                                                        <li>
                                                            @if ($charts['mandatoryData']['mandatoryScore'][$loop->index] <= 30)
                                                                Poor
                                                            @elseif(
                                                                $charts['mandatoryData']['mandatoryScore'][$loop->index] > 30 &&
                                                                    $charts['mandatoryData']['mandatoryScore'][$loop->index] <= 50)
                                                                Good
                                                            @elseif(
                                                                $charts['mandatoryData']['mandatoryScore'][$loop->index] > 50 &&
                                                                    $charts['mandatoryData']['mandatoryScore'][$loop->index] < 70)
                                                                Average
                                                            @else
                                                                Excellent
                                                            @endif
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                            {{-- <div style="width: 27%; background-color: white;padding: 13px; border-radius: 20px; display:inline-block; margin:6px 6px ">
                            <table style="width: 100%;; background-color: #F7FDFD; border-radius:14px; ">
                                <tbody>
                                    <tr>
                                        <td style="width: 30%;">
                                            <img src="https://quickchart.io/chart?w=120&h=100&c={{ $mandateChart }}"
                                                style="width: 70px; height: auto;" alt="chart-circle" />
                                        </td>
                                        <td style="text-align: start; padding: 0; margin: 0;">
                                            <p style="margin:0; font-size:13px; font-weight: bolder;">javascript </p>
                                            <ul
                                                style="padding-left:10px; margin:5px 0 0 0 ; font-size:10px; font-weight: bolder; color:#CF0A0A;">
                                                <li>
                                                    Poor
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div
                            style="width: 27%; background-color: white; padding: 13px; border-radius: 20px; display:inline-block; margin:6px 6px ">
                            <table style="width: 100%;; background-color: #F7FDFD; border-radius:14px; ">
                                <tbody>
                                    <tr>
                                        <td style="width: 30%;">
                                            <img src="https://quickchart.io/chart?w=120&h=100&c={{ $charts['techChart'][2] }}"
                                                style="width: 70px; height: auto;" alt="chart-circle" />
                                        </td>
                                        <td style="text-align: start; padding: 0; margin: 0;">
                                            <p style="margin:0; font-size:13px; font-weight: bolder;">HTML and CSS</p>
                                            <ul
                                                style="padding-left:10px; margin:5px 0 0 0 ; font-size:10px; font-weight: bolder; color:#CF0A0A;">
                                                <li>
                                                    Poor
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> --}}


                        </div>
                    </td>
                </tr>
            @endif
            <!-- optional-skills -->
            @if (!empty($charts['optionalData']['optionalChart']))
                <tr>
                    <td style=" padding:0 30px;">
                        <h2
                            style="text-align:center;  font-size: 26px; color: #202529; padding:20px 0 30px 0px; line-height: 40px;">
                            Optional Skills
                        </h2>
                    </td>
                </tr>
                <tr>
                    <td style="padding:0 30px; ">
                        <div style="border-bottom: 1px solid #DCDBE0; padding-bottom: 24px;">
                            @foreach ($charts['optionalData']['optionalChart'] as $opChart)
                                <div
                                    style="width: 27%; background-color: white;padding: 13px; border-radius: 20px; display:inline-block; margin:6px 6px ">
                                    <table style="width: 100%;; background-color: #F7FDFD; border-radius:14px; ">
                                        <tbody>
                                            <tr>
                                                <td style="width: 30%;">
                                                    <img src="https://quickchart.io/chart?w=120&h=100&c={{ $opChart }}"
                                                        style="width: 70px; height: auto;" alt="chart-circle" />
                                                </td>
                                                <td style="text-align: start; padding: 0; margin: 0;">
                                                    <p style="margin:0; font-size:13px; font-weight: bolder;">
                                                        {{ $charts['optionalData']['optionalTechnology'][$loop->index] }}
                                                    </p>
                                                    <ul
                                                        style="padding-left:10px; margin:5px 0 0 0 ; font-size:10px; font-weight: bolder; color:#CF0A0A;">
                                                        <li>
                                                            @if ($charts['optionalData']['optionalScore'][$loop->index] <= 30)
                                                                Poor
                                                            @elseif(
                                                                $charts['optionalData']['optionalScore'][$loop->index] > 30 &&
                                                                    $charts['optionalData']['optionalScore'][$loop->index] <= 50)
                                                                Good
                                                            @elseif(
                                                                $charts['optionalData']['optionalScore'][$loop->index] > 50 &&
                                                                    $charts['optionalData']['optionalScore'][$loop->index] < 70)
                                                                Average
                                                            @else
                                                                Excellent
                                                            @endif
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                            {{-- <div
                            style="width: 27%; background-color: white;padding: 13px; border-radius: 20px; display:inline-block; margin:6px 6px ">
                            <table style="width: 100%;; background-color: #F7FDFD; border-radius:14px; ">
                                <tbody>
                                    <tr>
                                        <td style="width: 30%;">
                                            <img src="https://quickchart.io/chart?w=120&h=100&c={{ $charts['techChart'][0] }}"
                                                style="width: 70px; height: auto;" alt="chart-circle" />
                                        </td>
                                        <td style="text-align: start; padding: 0; margin: 0;">
                                            <p style="margin:0; font-size:13px; font-weight: bolder;">MongoDB</p>
                                            <ul
                                                style="padding-left:10px; margin:5px 0 0 0 ; font-size:10px; font-weight: bolder; color:#CF0A0A;">
                                                <li>
                                                    Poor
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div
                            style="width: 27%; background-color: white;padding: 13px; border-radius: 20px; display:inline-block; margin:6px 6px ">
                            <table style="width: 100%;; background-color: #F7FDFD; border-radius:14px; ">
                                <tbody>
                                    <tr>
                                        <td style="width: 30%;">
                                            <img src="https://quickchart.io/chart?w=120&h=100&c={{ $charts['techChart'][0] }}"
                                                style="width: 70px; height: auto;" alt="chart-circle" />
                                        </td>
                                        <td style="text-align: start; padding: 0; margin: 0;">
                                            <p style="margin:0; font-size:13px; font-weight: bolder;">express js</p>
                                            <ul
                                                style="padding-left:10px; margin:5px 0 0 0 ; font-size:10px; font-weight: bolder; color:#CF0A0A;">
                                                <li>
                                                    Poor
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> --}}
                        </div>

                    </td>
                </tr>
            @endif
            <!-- other-skills -->
            @if (!empty($charts['videoProcessData']['videoProcessChart']))
                <tr>
                    <td style="padding:0 30px;">
                        <h2
                            style="text-align:center; font-size: 26px; color: #202529; padding:20px 0 30px 0px; line-height: 40px;">
                            Other Skills
                        </h2>
                    </td>
                </tr>
                <tr>
                    <td style="padding:0 30px 30px 30px;">
                        <div style="border-bottom: 1px solid #DCDBE0; padding-bottom: 24px;">
                            @foreach ($charts['videoProcessData']['videoProcessChart'] as $opChart)
                                <div
                                    style="width: 27%; background-color: white;padding: 13px; border-radius: 20px; display:inline-block; margin:6px 6px ">
                                    <table style="width: 100%;; background-color: #F7FDFD; border-radius:14px; ">
                                        <tbody>
                                            <tr>
                                                <td style="width: 30%;">
                                                    <img src="https://quickchart.io/chart?w=120&h=100&c={{ $opChart }}"
                                                        style="width: 70px; height: auto;" alt="chart-circle" />
                                                </td>
                                                <td style="text-align: start; padding: 0; margin: 0;">
                                                    <p style="margin:0; font-size:13px; font-weight: bolder;">
                                                        {{ $charts['videoProcessData']['videoProcessArray'][$loop->index] }}
                                                    </p>
                                                    <ul
                                                        style="padding-left:10px; margin:5px 0 0 0 ; font-size:10px; font-weight: bolder; color:#CF0A0A;">
                                                        <li>
                                                            @if ($charts['videoProcessData']['videoProcessScore'][$loop->index] <= 30)
                                                                Poor
                                                            @elseif(
                                                                $charts['videoProcessData']['videoProcessScore'][$loop->index] > 30 &&
                                                                    $charts['videoProcessData']['videoProcessScore'][$loop->index] <= 50)
                                                                Good
                                                            @elseif(
                                                                $charts['videoProcessData']['videoProcessScore'][$loop->index] > 50 &&
                                                                    $charts['videoProcessData']['videoProcessScore'][$loop->index] < 70)
                                                                Average
                                                            @else
                                                                Excellent
                                                            @endif
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                        </div>
                    </td>
                </tr>
            @endif
            <!-- Detailed Feedback -->
            <tr style="page-break-before: always">
                <td style="padding:0 30px;">
                    <h2
                        style="text-align:center; font-size: 26px; color: #202529; padding:20px 0 30px 0px; line-height: 40px;">
                        Detailed Feedback
                    </h2>
                </td>
            </tr>
            <!-- mandatory -->
            @if (!empty($charts['mandatoryData']['mandatoryChart']))
                <tr>
                    <td style="padding:0 30px; ">
                        <h3 style="margin: 5px 0 5px 0; font-size: 18px; font-weight: normal;">
                            Mandatory Skills
                        </h3>
                    </td>
                </tr>
                <tr>
                    <td style="padding:0 30px; ">
                        <div
                            style="border-radius: 10px; background-color: white; padding: 15px 10px; line-height: 1.4;">
                            @foreach ($charts['mandatoryData']['mandatoryTechnology'] as $mandateTechName)
                                <p style="padding:  0 0 10px 0;">
                                    <span style="
                                font-weight: bold;">
                                        {{ $mandateTechName }}:
                                    </span>
                                    @if ($charts['mandatoryData']['mandatoryScore'][$loop->index] <= 30)
                                        Doesn't know the {{ $mandateTechName }} concepts very well as per his
                                        experience.
                                    @elseif(
                                        $charts['mandatoryData']['mandatoryScore'][$loop->index] > 30 &&
                                            $charts['mandatoryData']['mandatoryScore'][$loop->index] <= 50)
                                        Doesn't know the {{ $mandateTechName }} concepts very well as per his
                                        experience.
                                        Gave multiple questions
                                        about theory overreact but was
                                        not able to answer most of them.
                                    @elseif(
                                        $charts['mandatoryData']['mandatoryScore'][$loop->index] > 50 &&
                                            $charts['mandatoryData']['mandatoryScore'][$loop->index] < 70)
                                        Know the {{ $mandateTechName }} concepts very well but lack some of concept as
                                        per his experience.
                                    @else
                                        Excellent knowledge about {{ $mandateTechName }} concepts, Answer mostly
                                        questions.
                                    @endif

                                </p>
                            @endforeach
                        </div>
                    </td>
                </tr>
            @endif
            <!-- Optional Skills -->
            @if (!empty($charts['optionalData']['optionalChart']))
                <tr>
                    <td style="padding:0 30px; ">
                        <h3 style=" margin: 25px 0 5px 0; font-size: 18px; font-weight: normal;">
                            Optional Skills
                        </h3>
                    </td>
                </tr>
                <tr>
                    <td style="padding:0 30px; ">
                        <div
                            style="border-radius: 10px; background-color: white; padding: 15px 10px; line-height: 1.4;">
                            @foreach ($charts['optionalData']['optionalTechnology'] as $optionalTechName)
                                <p style="padding:  0 0 10px 0;">
                                    <span style="
                                font-weight: bold;">
                                        {{ $optionalTechName }}:
                                    </span>
                                    @if ($charts['optionalData']['optionalScore'][$loop->index] <= 30)
                                        Doesn't know the {{ $optionalTechName }} concepts very well as per his
                                        experience.
                                    @elseif(
                                        $charts['optionalData']['optionalScore'][$loop->index] > 30 &&
                                            $charts['optionalData']['optionalScore'][$loop->index] <= 50)
                                        Doesn't know the {{ $optionalTechName }} concepts very well as per his
                                        experience.
                                        Gave multiple questions
                                        about theory overreact but was
                                        not able to answer most of them.
                                    @elseif(
                                        $charts['optionalData']['optionalScore'][$loop->index] > 50 &&
                                            $charts['optionalData']['optionalScore'][$loop->index] < 70)
                                        Know the {{ $optionalTechName }} concepts very well but lack some of concept as
                                        per his experience.
                                    @else
                                        Excellent knowledge about {{ $optionalTechName }} concepts, Answer mostly
                                        questions.
                                    @endif

                                </p>
                            @endforeach
                        </div>
                    </td>
                </tr>
            @endif
            <!-- Other Skills -->
            @if (!empty($charts['videoProcessData']['videoProcessChart']))
                <tr>
                    <td style="padding:0 30px; ">
                        <h3 style=" margin: 25px 0 5px 0; font-size: 18px; font-weight: normal;">
                            Other Skills
                        </h3>
                    </td>
                </tr>
                <tr>
                    <td style="padding:0 30px; ">
                        <div
                            style="border-radius: 10px; background-color: white; padding: 15px 10px; line-height: 1.4;">
                            @foreach ($charts['videoProcessData']['videoProcessArray'] as $videoProcessName)
                                <p style="padding:  0 0 10px 0;">
                                    <span style="
                            font-weight: bold;">
                                        {{ $videoProcessName }}:
                                    </span>
                                    @if ($charts['videoProcessData']['videoProcessScore'][$loop->index] <= 30)
                                        The {{ $videoProcessName }} was not correct to answer the questions.
                                    @elseif(
                                        $charts['videoProcessData']['videoProcessScore'][$loop->index] > 30 &&
                                            $charts['videoProcessData']['videoProcessScore'][$loop->index] <= 50)
                                        The {{ $videoProcessName }} was not correct to answer the questions.
                                    @elseif(
                                        $charts['videoProcessData']['videoProcessScore'][$loop->index] > 50 &&
                                            $charts['videoProcessData']['videoProcessScore'][$loop->index] < 70)
                                        The {{ $videoProcessName }} was correct to answer the questions but still need
                                        some improvement.
                                    @else
                                        The {{ $videoProcessName }} was excellent to answer the questions.
                                    @endif

                                </p>
                            @endforeach
                        </div>
                    </td>
                </tr>
            @endif
            <!-- Screening Questions -->
            @if (!empty($userInput))
                <tr style="page-break-before:always">
                    <td style="padding:10px 30px 0px 30px;">
                        <h3 style=" margin: 25px 0 15px 0; font-size: 18px; font-weight: normal;">
                            Screening Questions
                        </h3>
                    </td>
                </tr>
                @foreach ($userInput as $input)
                    <tr>
                        <td style="padding:0 30px; ">
                            <p style="font-weight: bold;"> {{ $loop->iteration }}. {{ $input['question'] }}</p>
                            <div
                                style="border-radius: 10px; background-color: white; margin: 5px; padding: 10px 10px; line-height: 1.4;">
                                <p>
                                    @if ($input['userAnswer'] == 'skipped')
                                        Didn't answer the question.
                                    @else
                                        {{ $input['userAnswer'] }}
                                    @endif
                                </p>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
            <!-- final-remark -->
            <tr style="page-break-before:always">
                <td style="padding:0 30px; ">
                    <h3 style=" margin: 25px 0 5px 0; font-size: 18px; font-weight: normal;">
                        Final Remarks
                    </h3>
                </td>
            </tr>
            <tr>
                <td style="padding:0 30px; ">
                    <div
                        style="border-radius: 10px; background-color: white; margin: 5px; padding: 10px 10px; line-height: 1.4;">
                        <p>
                            Gave multiple questions in JavaScript, React, HTML and CSS, but He was not able to answer
                            most of the questions as the concepts were not clear,
                            and don't have working experience on these. In coding questions as well, He tried to attempt
                            but was not able to make them work. He needs to
                            work on his basic concepts of JavaScript, React, HTML and CSS
                        </p>
                    </div>
                </td>
            </tr>
            <!-- Attachments -->
            <tr style="page-break-before:always">
                <td style="padding:0 30px; ">
                    <h3 style="  margin: 25px  0 5px 0; font-size: 18px; font-weight: normal;">
                        Attachments
                    </h3>
                </td>
            </tr>
            <tr>
                <td style="padding:20px 30px;  text-align: center;">
                    <img src="{{ public_path('/images/meet-image.png') }}"
                        style="width: 75%; height: auto; margin:20px 0 " alt="screenshot">
                    <img src="{{ public_path('/images/meet-image.png') }}"
                        style="width: 75%; height: auto;  margin:20px 0" alt="screenshot">
                </td>
            </tr>
            <!-- Screenshots -->
            <tr style="page-break-before:always">
                <td style="padding:0 30px; ">
                    <h3 style=" margin: 25px  0 5px 0; font-size: 18px; font-weight: normal;">
                        Screenshots
                    </h3>
                </td>
            </tr>
            <tr>
                <td style="padding:30px 30px; ">
                    <div style="padding-bottom: 24px;">
                        <div style="width: 31%; display:inline-block; margin:6px 6px ">
                            <img src="{{ public_path('/images/screenshot-meet.jpg') }}"
                                style="max-width: 100%; height: auto;" alt="screenshot">
                        </div>
                        <div style="width: 31%; display:inline-block; margin:6px 6px ">
                            <img src="{{ public_path('/images/screenshot-meet.jpg') }}"
                                style="max-width: 100%; height: auto;" alt="screenshot">
                        </div>
                        <div style="width: 31%; display:inline-block; margin:6px 6px ">
                            <img src="{{ public_path('/images/screenshot-meet.jpg') }}"
                                style="max-width: 100%; height: auto;" alt="screenshot">
                        </div>
                        <div style="width: 31%; display:inline-block; margin:6px 6px ">
                            <img src="{{ public_path('/images/screenshot-meet.jpg') }}"
                                style="max-width: 100%; height: auto;" alt="screenshot">
                        </div>
                        <div style="width: 31%; display:inline-block; margin:6px 6px ">
                            <img src="{{ public_path('/images/screenshot-meet.jpg') }}"
                                style="max-width: 100%; height: auto;" alt="screenshot">
                        </div>
                        <div style="width: 31%; display:inline-block; margin:6px 6px ">
                            <img src="{{ public_path('/images/screenshot-meet.jpg') }}"
                                style="max-width: 100%; height: auto;" alt="screenshot">
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>

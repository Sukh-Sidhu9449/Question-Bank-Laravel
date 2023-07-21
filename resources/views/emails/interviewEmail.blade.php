<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interview Schedule</title>
</head>

<body>
    <table style="width: 100%; margin: 0 auto;  text-align: center;background-color: #dbdbdb;">
        <thead>
            <tr style="background-color: #e8eaec;">
                <td style=" text-align: center;padding: 20px ; ">
                    <img style="width:100px; height: auto;" src="{{ asset('/images/Question-Bank-Logo.webp') }}"
                        alt="logo">
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style=" padding: 20px 10px;">
                    <div
                        style="width: 75%; margin: 0 auto; background-color: white;border-radius: 10px; text-align: left; padding: 15px;">
                        <h2>
                            Hello,
                        </h2>
                        <p style="line-height: 1;">
                            Your interview is scheduled.
                        </p>
                        <p style="line-height: 1;">
                            You can start your interview by clicking Start button below:
                        </p>
                        <div style="text-align: center; margin:10px">
                            <a href="https://questionbank.appsndevs.com/guest-interview/{{$userData['encrypt']}}">
                                <button>
                                   Start
                                </button>
                            </a>
                        </div>
                        <p>Thankyou</p>
                    </div>

                </td>
            </tr>

        </tbody>
    </table>

</body>

</html>

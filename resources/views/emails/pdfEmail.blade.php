<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interview Result</title>
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
                            Hello {{ $name }},
                        </h2>
                        <p style="line-height: 1;">
                            Thank you for coming in for an interview with us.
                        </p>
                        <p style="line-height: 1;">
                            Hope your interview was good.
                        </p>
                        <p style="line-height: 1;">
                            Kindly find the attachment to see your interview result.
                        </p>
                        <p>Thankyou</p>
                    </div>

                </td>
            </tr>

        </tbody>
    </table>

</body>

</html>

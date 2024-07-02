<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $data['title'] }}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }
        .email-header {
            text-align: center;
            padding-bottom: 20px;
        }
        .email-header h1 {
            font-size: 24px;
            color: #333;
        }
        .email-body {
            text-align: center;
        }
        .otp-code {
            font-size: 28px;
            font-weight: bold;
            color: #007bff;
            margin: 20px 0;
        }
        .email-footer {
            text-align: center;
            margin-top: 30px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>{{ $data['title'] }}</h1>
        </div>
        <div class="email-body">
            <p>OTP code:</p>
            <div class="otp-code">{{ $data['otp'] }}</div>
            <p>Please enter this OTP to proceed with your password reset.</p>
        </div>
        <div class="email-footer">
            <p>If you did not request a password reset, please ignore this email.</p>
        </div>
    </div>
</body>
</html>

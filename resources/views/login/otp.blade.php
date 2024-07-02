<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .otp-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }

        .otp-header {
            text-align: center;
            padding-bottom: 20px;
        }

        .otp-header h1 {
            font-size: 24px;
            color: #333;
        }

        .error-message {
            color: red;
            font-size: 14px;
            font-style: italic;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="otp-container">
        <div class="otp-header">
            <h1>Verify OTP</h1>
        </div>
        <div class="otp-body">
            @if ($error)
                <p class="error-message">{{ $error }}</p>
            @endif
            <form method="POST" action="{{ route('verifyOTP') }}">
                @csrf
                <div class="form-group">
                    <label for="otp">Enter OTP</label>
                    <input type="text" name="otp" class="form-control" id="otp">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Verify OTP</button>
            </form>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            display: flex;
            align-items: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #dddddd;
        }

        .email-header img {
            max-height: 50px;
            margin-right: 15px;
        }

        .email-header h1 {
            margin: 0;
            color: #333333;
            font-size: 24px;
        }

        .email-body {
            padding: 20px 0;
            color: #555555;
        }

        .email-footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #dddddd;
            color: #777777;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    @php
        $setting = App\Models\Setting::where('id', 1)->first();
    @endphp
    <div class="email-container">
        <div class="email-header">
            <!-- Add your logo here -->
            <h1>{{ $subject }}</h1>
        </div>
        <div class="email-body">
            <p>Hello,</p>
            <p>Thank you for registering with us. Please click the button below to verify your email address:</p>
            <p>
                <a href="{{ $verification_link }}" class="btn">Verify Email Address</a>
            </p>
            <p>If you did not create an account, no further action is required.</p>
        </div>
        <div class="email-footer">
            <p>Thank you,<br>{{ config('app.name') }}</p>
        </div>
    </div>
</body>

</html>

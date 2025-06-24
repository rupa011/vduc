<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Diving Lesson Completion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f9f9f9;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo img {
            height: 80px;
        }
        h2 {
            color: #0073b1;
        }
        p {
            line-height: 1.6;
        }
        .footer {
            margin-top: 40px;
            font-size: 0.9em;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="{{ asset('images/logo1.png') }}" alt="Visayan Divers Logo">
        </div>

        <h2>Hello {{ $application->user->first_name }},</h2>

        <p>
            We’re pleased to inform you that your application for the diving lesson has been <strong>successfully completed</strong>.
        </p>

        <p><strong>Lesson:</strong> {{ $application->lesson->lesson_name }}</p>
        <p><strong>Scheduled Date:</strong> {{ \Carbon\Carbon::parse($application->schedule_date)->format('F d, Y') }}</p>
        <p><strong>Status:</strong> {{ $application->status }}</p>

        <p>
            Congratulations on this milestone! Should you require an official certification, kindly coordinate with our front desk or visit our office for assistance.
        </p>

        <p>
            Thank you for choosing <strong>Visayan Divers Underwater Contractor Inc.</strong> We look forward to serving you again.
        </p>

        <p>Warm regards,<br>
        <strong>Visayan Divers Team</strong></p>

        <div class="footer">
            &copy; {{ date('Y') }} Visayan Divers Underwater Contractor Inc. All rights reserved.
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Plant Watering Reminder</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding: 10px 0;
        }
        .header img {
            max-width: 100px;
        }
        .content {
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            padding: 10px 0;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/logo.png') }}" alt="GreenScape Logo">
            <h1>Plant Watering Reminder</h1>
        </div>
        <div class="content">
            <p>Dear {{ $plant->user->name }},</p>
            <p>This is a friendly reminder to water your plants today <b>{{$plant->name}}</b> . Keeping your plants hydrated is essential for their health and growth.</p>
            <p>Here are some tips for watering your plants:</p>
            <ul>
                <li>Water your plants early in the morning or late in the evening.</li>
                <li>Ensure the water reaches the roots.</li>
                <li>Avoid overwatering to prevent root rot.</li>
            </ul>
            <p>Thank you for being a part of the GreenScape community!</p>
            <p>Best regards,<br>The GreenScape Team</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} GreenScape. All rights reserved.</p>
        </div>
    </div>
</body>
</html>

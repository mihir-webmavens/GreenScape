

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        color: #333;
    }
    .container {
        width: 80%;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h2 {
        color: #4CAF50;
    }
    p {
        line-height: 1.6;
    }
    ul {
        list-style-type: none;
        padding: 0;
    }
    ul li {
        background: #e8f5e9;
        margin: 5px 0;
        padding: 10px;
        border-radius: 4px;
    }
    .footer {
        margin-top: 20px;
        text-align: center;
        font-size: 0.9em;
        color: #777;
    }
</style>
</head>
<body>
    <div class="container">
        <h2>Order Confirmation</h2>
        <div>
            <p>Dear {{ auth()->user()->name }},</p>
            <p>Thank you for your order. Here are the details of your purchase:</p>
            <ul>
                <li>Order Number: {{ $data['OrderId'] }}</li>
                <li>Order Date: {{ $data['OrderDate'] }}</li>
            </ul>
            <p>We will notify you once your order has been shipped.</p>
            <p>Thank you for shopping with us!</p>
            <p>Best regards,</p>
            <p>The GreenScape Team</p>
        </div>
        <div>
            <p>Estimated Arrival Date: {{ \Carbon\Carbon::parse($data['OrderDate'])->addDays(3)->toFormattedDateString() }}</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} GreenScape. All rights reserved.</p>
        </div>
    </div>

</body>
</html>

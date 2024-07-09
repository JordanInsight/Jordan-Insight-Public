<!DOCTYPE html>
<html>

<head>
    <title>Reservation Successful</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            line-height: 1.6;
            color: #333;
            font-family: Arial, sans-serif;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #f8f9fa;
        }

        h1 {
            color: #000;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            text-transform: uppercase;
        }

        .text-right {
            text-align: right;
        }

        .font-weight-bold {
            font-weight: bold;
        }

        .text-muted {
            color: #6c757d;
        }

        .text-center {
            text-align: center;
        }

        .text-success {
            color: #28a745;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <h1>Reservation Successful</h1>
        <p>Dear {{ $reservationDetails['user_name'] }}</p>
        <p>Thank you for booking with us. Here are your reservation details:</p>

        <table>
            <thead>
                <tr>
                    <th scope="col" class="border-0 bg-light">
                        <div class="p-3 text-uppercase">Product</div>
                    </th>
                    <th scope="col" class="border-0 bg-light">
                        <div class="py-3 text-uppercase">Details</div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Tour Name:</strong></td>
                    <td>{{ $reservationDetails['tour_name'] }}</td>
                </tr>
                <tr>
                    <td><strong>City:</strong></td>
                    <td>{{ $reservationDetails['tour_city'] }}</td>
                </tr>
                <tr>
                    <td><strong>Price per day:</strong></td>
                    <td>${{ number_format($reservationDetails['tour_budget'], 2) }}</td>
                </tr>
                <tr>
                    <td><strong>From:</strong></td>
                    <td>{{ $reservationDetails['start_date'] }}</td>
                </tr>
                <tr>
                    <td><strong>To:</strong></td>
                    <td>{{ $reservationDetails['end_date'] }}</td>
                </tr>
                <tr>
                    <td><strong>Total Price:</strong></td>
                    <td>${{ number_format($reservationDetails['total_price'], 2) }}</td>
                </tr>
            </tbody>
        </table>

        <p>We look forward to serving you.</p>
        <p>Best regards,<br>{{ config('app.name') }}</p>
    </div>
</body>

</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order Details</title>
</head>

<body style="font-family: Arial, sans-serif;">

    <h2 style="color:#333;">Hello {{ $customer->name }},</h2>
    <p>Your order has been placed successfully. Below are your order details:</p>

    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead>
            <tr>
                <th style="padding:10px; border:1px solid #ddd; background:#f8f9fa; text-align:left;">
                    Item Name
                </th>
                <th style="padding:10px; border:1px solid #ddd; background:#f8f9fa; text-align:left;">
                    Quantity
                </th>
                <th style="padding:10px; border:1px solid #ddd; background:#f8f9fa; text-align:left;">
                    Price
                </th>
            </tr>
        </thead>

        <tbody>
            @foreach($orderDetails as $detail)
                <tr>
                    <td style="padding:10px; border:1px solid #ddd;">
                        {{ $detail->item->name }}
                    </td>
                    <td style="padding:10px; border:1px solid #ddd;">
                        {{ $detail->quantity }}
                    </td>
                    <td style="padding:10px; border:1px solid #ddd;">
                        ₹{{ number_format($detail->price, 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3 style="margin-top:20px;">
        Total Amount: ₹{{ number_format($order->total_amount, 2) }}
    </h3>

    <p style="margin-top:25px;">Thanks,<br>{{ config('app.name') }}</p>

</body>
</html>

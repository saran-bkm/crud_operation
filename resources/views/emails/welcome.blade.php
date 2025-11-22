<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{ $data['title'] }}</title>
</head>

<body style="font-family: Arial, sans-serif; background: #f4f4f4; padding: 40px;">
    <div style="max-width: 600px; margin: auto; background: #ffffff; padding: 30px; border-radius: 10px;">
        <h2 style="color: #333; text-align:center;">🎉 Welcome Aboard, {{ explode(' ', $data['body'])[1] }}!</h2>

        <p style="color: #555; font-size: 16px; line-height: 1.6;">
            We’re thrilled to have you join us.  
            Your account has been successfully created, and you’re ready to explore our services.
        </p>

        <p style="color: #555; font-size: 16px; line-height: 1.6;">
            If you have any questions or need assistance, feel free to reach out anytime — we’re here to help!
        </p>

        <div style="margin-top: 30px; text-align: center;">
            <a href="#" style="background: #4CAF50; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-size: 16px;">
                Visit Dashboard
            </a>
        </div>

        <p style="margin-top: 30px; color: #888; font-size: 14px; text-align: center;">
            Warm regards,<br>
        </p>
    </div>
</body>

</html>

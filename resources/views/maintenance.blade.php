<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Under Maintenance</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .box {
            background: white;
            border-radius: 16px;
            padding: 50px 40px;
            max-width: 480px;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            font-size: 36px;
        }
        h1 {
            font-size: 1.5rem;
            color: #1a202c;
            margin-bottom: 12px;
        }
        .message {
            color: #4a5568;
            font-size: 0.95rem;
            line-height: 1.6;
        }
        .message p { margin-bottom: 8px; }
        .footer-note {
            margin-top: 24px;
            font-size: 0.8rem;
            color: #a0aec0;
        }
    </style>
</head>
<body>
    <div class="box">
        <div class="icon">🛠️</div>
        <h1>We'll be right back!</h1>
        <div class="message">
            {!! $message !!}
        </div>
        <div class="footer-note">Thank you for your patience.</div>
    </div>
</body>
</html>
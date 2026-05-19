<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Under Maintenance</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: #ffffff;
            color: #333;
        }

        .head{
            width: 100%;
            position: absolute;
            top: 8%;
            left: 50%;
            transform: translateX(-50%);
        }
        h1 {
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: #1f2937;
        }

        p {
            font-size: 1.2rem;
            color: #4b5563;
            margin-bottom: 30px;
        }

  
        img {
          object-fit: cover;
           width: 100%;
           height: 100%;
            border-radius: 12px;
    
        }

        .footer-text {
            font-size: 0.95rem;
            color: #6b7280;
            margin-top: 15px;
            position: absolute;
            bottom: 20%;
        }

        .container {
           position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            text-align: center;
            padding: 10px;
        }

        @media (max-width: 600px) {
            h1 { font-size: 2rem; }
            p { font-size: 1rem; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="head">
            <h1>We'll Be Back Soon</h1>
            <p>Our site is currently undergoing maintenance. Thanks for your patience!</p>
        </div>
        <div>
            <img src="https://cdn.dribbble.com/userupload/20420676/file/original-aac8f7f838812fa53cd92617fad5f892.gif" alt="Maintenance Animation">
        </div>
        <p class="footer-text">Technical team is on it ⚡</p>
    </div>
</body>
</html>
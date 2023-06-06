<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forbidden - 403</title>
    <link rel="stylesheet" href="{{ asset('css/403.css') }}">
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="{{ asset('images/sosipologo.png') }}" alt="SOSIPO Logo">
        </div>
        <div class="error-message">
            <h1>403</h1>
            <h2>Interdit</h2>
            <p>Vous n’avez pas la permission d’accéder à cette page.</p>
        </div>

    </div>
    <style>
        @keyframes rotate {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .logo {
            animation: rotate 2s linear infinite;
        }

        .error-message {
            text-align: center;
            margin-top: 20px;
        }

        h1 {
            font-size: 60px;
            color: #f44336;
        }

        h2 {
            font-size: 36px;
            color: #333333;
            margin-top: 10px;
        }

        p {
            font-size: 25px;
            color: #666666;
            margin-top: 10px;
        }
    </style>
</body>

</html>

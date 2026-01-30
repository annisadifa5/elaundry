<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Auth')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            margin: 0;
            background: #f7fbfc;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        /* CARD LOGIN */
        .auth-card {
            display: flex;
            width: 900px;
            max-width: 95%;
            background: #ffffff;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,.12);
        }

        /* LEFT PANEL */
        .auth-left {
            width: 40%;
            background: linear-gradient(135deg, #1fc8b8, #16a39a);
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .auth-left h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .auth-left p {
            font-size: 14.5px;
            opacity: .95;
            line-height: 1.6;
        }

        /* RIGHT PANEL */
        .auth-right {
            width: 60%;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .auth-title {
            font-size: 22px;
            font-weight: 700;
            color: #0b2c4d;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 14px;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            font-size: 14px;
        }

        input:focus {
            outline: none;
            border-color: #16a39a;
        }

        .btn {
            background: #ff8a00;
            color: white;
            border: none;
            padding: 12px 18px;
            border-radius: 20px;
            cursor: pointer;
            font-weight: 600;
            width: 100%;
            margin-top: 10px;
        }

        .btn:hover {
            background: #e67800;
        }

        .auth-footer {
            margin-top: 20px;
            font-size: 14px;
            text-align: center;
        }

        .auth-footer a {
            color: #16a39a;
            font-weight: 600;
            text-decoration: none;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .auth-card {
                flex-direction: column;
            }

            .auth-left,
            .auth-right {
                width: 100%;
            }

            .auth-left {
                text-align: center;
            }
        }
    </style>
</head>
<body>

<div class="auth-card">
    @yield('content')
</div>

</body>
</html>

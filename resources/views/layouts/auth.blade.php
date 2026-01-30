<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Login')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    {{-- Style --}}
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            margin: 0;
            height: 100vh;
        }

        .container {
            display: flex;
            height: 100vh;
        }

        .left {
            width: 50%;
            padding: 80px;
            background: #F6FCFF;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .right {
            width: 50%;
            background: #11A99D;
        }

        h1 {
            text-align: center;
            margin-bottom: 10px;
            color: #0A254A;
        }

        p {
            text-align: center;
            color: #0A254A;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .input-wrapper {
            display: flex;
            align-items: center;
            border: 1.5px solid #0A254A;
            border-radius: 30px;
            padding: 12px 18px;
        }

        .input-wrapper input {
            border: none;
            outline: none;
            width: 100%;
            font-size: 14px;
            margin-left: 10px;
            background: transparent;
        }

        .btn {
            background: #FD8300;
            color: #F6FCFF;
            border: none;
            padding: 12px;
            width: 140px;
            border-radius: 30px;
            font-weight: 600;
            cursor: pointer;
            align-items: center;
        }

        .btn-center {
            display: flex;
            justify-content: center; 
            margin-top: 10px;
        }

        .btn:hover {
            background: #FD8300;
        }

        .footer-text {
            margin-top: 25px;
            font-size: 14px;
            text-align: center;
        }

        .footer-text a {
            color: #0A254A;
            font-weight: 600;
            text-decoration: none;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    @yield('content')
</div>

</body>
</html>

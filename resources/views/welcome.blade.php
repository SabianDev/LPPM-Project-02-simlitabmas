<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Selamat Datang - SIMLITABMAS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite('resources/css/app.css')

    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Inter', sans-serif;
            color: white;
            background: url('{{ asset('images/bghomepage.png') }}');
            background-size: cover;
        }

        .overlay {
            background-color: rgba(0, 0, 0, 0.5);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 40px 20px;
        }

        .logo {
            width: 360px;
            height: auto;
            margin-bottom: 0px;
        }

        h1 {
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 25px;
        }

        .btn-group a {
            margin: 0 10px;
            padding: 10px 30px;
            border: 2px solid white;
            background-color: transparent;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-group a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        footer {
            padding: 20px 10px;
            text-align: center;
        }

        .footer-logos {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 10px;
        }

        .footer-logos img {
            height: 50px;
            object-fit: contain;
        }

        @media (max-width: 640px) {
            h1 {
                font-size: 2rem;
            }

            .btn-group a {
                display: block;
                margin: 10px auto;
                width: 80%;
            }

            .footer-logos {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="overlay">
        <div class="content">
            <img src="{{ asset('images/logo-white.svg') }}" alt="Logo SIMLITABMAS" class="logo">
            <h1>Selamat Datang di SIMLITABMAS</h1>
            <div class="btn-group">
                <a href="{{ route('register') }}">Register</a>
                <a href="{{ route('login') }}">Login</a>
            </div>
        </div>

        <footer>
            <div class="footer-logos">
                <img src="{{ asset('images/logo-piksi.png') }}" alt="Logo Lembaga">
                <img src="{{ asset('images/logo-lppm.png') }}" alt="Logo Kampus">
            </div>
            <div class="text-sm">
                &copy; {{ date('Y') }} Tim Pengembangan LPPM. All rights reserved.
            </div>
        </footer>
    </div>
</body>
</html>

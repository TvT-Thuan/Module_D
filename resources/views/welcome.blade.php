<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trang chủ</title>
    <style>
        * {
            padding: 0;
            margin: 0;
        }

        header {
            text-align: right;
            margin: 10px;
        }

        main {
            width: 100%;
            height: 90vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        li {
            list-style: none;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <ul>
                @guest
                    <li><a href="{{ route('auth.login') }}">Login</a></li>
                @endguest
                @auth
                <li><a href="{{ route('admin.campaigns.index') }}">Dashboard</a></a></li>
                @endauth
            </ul>
        </header>
        <main>
            <h1>Trang chủ</h1>
        </main>
    </div>
</body>

</html>

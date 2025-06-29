@extends('layouts.main')

@section('body')
    <style>
        body {
            font-family: 'Inter', Arial, sans-serif;
            background: #f7f8fb;
            margin: 0;
            min-height: 100vh;
        }
        .login-wrapper {
            /*display: flex;*/
            justify-content: center;
            align-items: center;
            /*min-height: 95vh;*/
            margin-bottom: 100px;
            margin-top: 100px;
        }
        .login-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 6px 36px rgba(0,0,0,0.10);
            padding: 44px 38px 34px 38px;
            max-width: 700px;
            width: 98vw;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .login-title {
            font-size: 2rem;
            font-weight: bold;
            color: #ff9000;
            margin-bottom: 6px;
            letter-spacing: .5px;
            text-align: center;
        }
        .login-desc {
            color: #78797d;
            font-size: 1.06rem;
            margin-bottom: 25px;
            text-align: center;
        }
        .login-form {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 18px;
        }
        .login-form label {
            font-size: 1rem;
            color: #484848;
            margin-bottom: 7px;
            font-weight: 500;
        }
        .login-form input[type="email"],
        .login-form input[type="name"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 13px 12px;
            font-size: 1.05rem;
            border: 1.5px solid #ececec;
            border-radius: 8px;
            background: #f7f8fa;
            transition: border .15s;
            outline: none;
        }
        .login-form input[type="email"]:focus,
        .login-form input[type="name"]:focus,
        .login-form input[type="password"]:focus {
            border-color: #ff9000;
            background: #fffaf1;
        }
        .login-actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 10px;
        }
        .btn-login {
            background: linear-gradient(90deg,#ffa726 0%, #ff9000 100%);
            color: #fff;
            font-size: 1.09rem;
            font-weight: 700;
            border: none;
            border-radius: 8px;
            padding: 13px 0;
            cursor: pointer;
            transition: background .14s;
            margin-bottom: 4px;
        }
        .btn-login:hover {
            background: #ffd580;
            color: #ff9000;
        }
        .btn-register {
            background: #fff;
            color: #ff9000;
            border: 2px solid #ff9000;
            font-size: 1.06rem;
            font-weight: 600;
            border-radius: 8px;
            padding: 13px 0;
            cursor: pointer;
            transition: background .14s, color .14s;
        }
        .btn-register:hover {
            background: #ff9000;
            color: #fff;
        }
        .forgot-link {
            font-size: .96rem;
            color: #0070cc;
            text-decoration: none;
            text-align: right;
            display: block;
            margin-top: 6px;
            margin-bottom: 2px;
        }
        .forgot-link:hover { color: #004b97; }
        @media (max-width: 600px) {
            .login-card { padding: 18px 3vw 13px 3vw;}
            .login-title { font-size: 1.17rem;}
        }
    </style>
<body>
<div class="login-wrapper">
    <div class="login-card">
        <div class="login-title">Profile</div>
        <div class="login-desc">Informasi tentang akun kamu!</div>
        <form class="login-form" method="POST" action="{{ route('auth.updateProfile') }}">
            <div>
                <label for="email">Name</label>
                <input type="name" id="name" name="name" placeholder="{{$user->name}}">
            </div>
            <div>
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="{{$user->email}}">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password...">
            </div>
            <div class="login-actions">
                <button class="btn-login" type="submit">UPDATE</button>
            </div>
        </form>
    </div>
</div>
</body>

@endsection

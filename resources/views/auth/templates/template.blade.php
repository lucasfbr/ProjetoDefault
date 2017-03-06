<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ info_sistem()->titulo != '' ? info_sistem()->titulo : 'Titulo do sistema' }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="/css/auth.css">

</head>

<body class="hold-transition register-page">

    <div class="register-box" id="auth">
        <div class="register-logo">
            <a href="#">{{ info_sistem()->titulo != '' ? info_sistem()->titulo : 'Titulo do sistema' }}</a>
        </div>

        @yield('content')

    </div>

<script src="/js/auth.js"></script>
<script src="/js/main.js"></script>

</body>
</html>

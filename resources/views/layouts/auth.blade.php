
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Karier Sebelas</title>
    @vite(['public/assets/scss/app.scss', 'public/assets/scss/themes/dark/app-dark.scss', 'public/assets/scss/pages/auth.scss'])
    @vite(['public/assets/static/js/initTheme.js', 'public/assets/static/js/components/dark.js', 'resources/js/components/sweetalert2/auth.js'])
</head>

<body>
    <div id="auth">
        @yield('content')
    </div>
    @if (session('status'))
        <div id="status" class="d-none">
            {{ session('status') }}
        </div>
        <div id="message" class="d-none">
            {{ session('message') }}
        </div>
    @endif
</body>

</html>

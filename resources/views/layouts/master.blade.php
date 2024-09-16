<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @yield('meta');
    <title>@yield('title') - Karier Sebelas</title>
    @vite(['public/assets/scss/app.scss', 'public/assets/scss/themes/dark/app-dark.scss'])
    <link rel="shortcut icon" href="{{ asset('assets/static/images/logo/favicon.svg') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('assets/static/images/logo/favicon.png') }}" type="image/png" />
    @vite(['public/assets/static/js/initTheme.js', 'public/assets/static/js/components/dark.js', 'public/assets/js/app.js', 'resources/js/perfect-scrollbar.js'])
    @yield('assets')
</head>

<body>
    <div id="app">
        <aside id="sidebar">
            @include('partials.sidebar')
        </aside>

        <main id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <section>
                <div class="page-heading">
                    <h3>@yield('title')</h3>
                </div>
                <div class="page-content">
                    @yield('content')
                </div>
            </section>

            @include('partials.footer')

        </main>
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

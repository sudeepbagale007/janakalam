<!doctype html>
<html lang="en">
    <head>
        @include('site.layout.meta')
        <script data-ad-client="ca-pub-9447265900668036" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    </head>
    <body class="{{ $d_theme }}" id="yfline-body">
        @include('site.layout.header')
        @section('breadcrumbs')
        @show
        <main>
            @section('main-content')
            @show
        </main>
        @include('site.layout.footer')
        @include('site.layout.script')
        @yield('js')
    </body>
</html>
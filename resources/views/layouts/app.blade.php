<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Mais Saber</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <script src="//code.jivosite.com/widget/702cqDukIc" async></script>
{{--    <script src="//code.jivosite.com/widget/NpZIyOj2FD" async></script>--}}
</head>
<body>
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- @include('includes.vlibras') -->
<!--
     <script>
        (function (o, c, t, a, d, e, s, k) {
            o.octadesk = o.octadesk || {};
            s = c.getElementsByTagName("body")[0];
            k = c.createElement("script");
            k.async = 1;
            k.src = t + '/' + a + '?showButton=' +  d + '&openOnMessage=' + e;
            s.appendChild(k);
        })(window, document, 'https://chat.octadesk.services/api/widget', 'mvceditora',  true, true);
    </script> -->
</body>
</html>

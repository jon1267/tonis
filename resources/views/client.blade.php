<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Point</title>
        <script>
            window.config = {!! json_encode([
                'csrfToken' => csrf_token(),
                'point_id'  => ($point_id ?? 0)
            ]) !!};
        </script>
    </head>
    <body class="antialiased">
        <div id="app">
            <mobile-component></mobile-component>
        </div>
    </body>
{{--    <script src="{{ mix('/js/manifest.js') }}"></script>--}}
{{--    <script src="{{ mix('/js/vendor.js') }}"></script>--}}
    <script src="{{ mix('/js/app.js') }}"></script>
</html>

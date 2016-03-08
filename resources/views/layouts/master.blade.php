<html>
<head>
    <base href="{{config('app.url')}}">
    <title>
        Testing GitHub API
    </title>
    <link href="css/bs/css/bs.min.css" rel="stylesheet">
    <link href="css/fa/css/fa.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    @yield('content')
</div>
@include('partials.scripts')
</body>
</html>
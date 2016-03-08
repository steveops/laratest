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
    <div class="row">
        <br>
        <br>
        <br>
        <br>
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-body text-center">
                    <h4 class="text-center text-danger">
                        Operation Failed: Invalid password!
                    </h4>
                    <hr>
                    <a class="text-center btn btn-sm btn-default" href="{{ $back }}">
                        <span class="fa fa-arrow-circle-left"></span>
                        Go Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
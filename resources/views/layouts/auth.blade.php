<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>{{ config('app.name', 'Fourth Force') }} - @yield('title')</title>

    <!-- Additional CSS Files -->

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset(config('app.publicurl')) }}css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset(config('app.publicurl')) }}css/login.css" />

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
            </div>
            <div class="col-md-4">
            @yield('content')
            </div>
        </div>
    </div>
</body>

</html>
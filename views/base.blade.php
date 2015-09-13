<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
      @yield('browsertitle')
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/styles/style.css">
    @yield('css')
</head>

<body>
    @include('topnav')

    <div class="page-upper-margin">
      @yield('outsidecontainer')
    </div>

    <div class="container">
      <div class="row">
        <br><br>
      </div>
      <div class="row">
          <div class="col-md-2">
          </div>
          <div class="col-md-8">
            @include('errormessage')
          </div>
          <div class="col-md-2">
          </div>
      </div>

      @yield('content')

    </div>

    @include('footer')

    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js"></script>

    @yield('bottomjs')

</body>

</html>

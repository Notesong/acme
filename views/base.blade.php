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

    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js"></script>
    @if ((Acme\auth\LoggedIn::user()) && (Acme\auth\LoggedIn::user()->access_level == 20))
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.4.5/ckeditor.js"></script>
    @endif

    @yield('bottomjs')
    @include('admin.admin-js')

</body>

</html>

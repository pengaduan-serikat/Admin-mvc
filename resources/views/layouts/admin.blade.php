<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  {{-- <link rel="stylesheet" href="{{asset('css/app.css')}}"/> --}}
  <link rel="stylesheet" href="{{asset('css/templates/bootstrap.min.css')}}"/>
  <link rel="stylesheet" href="{{asset('css/templates/animate.min.css')}}"/>
  <link rel="stylesheet" href="{{asset('css/templates/light-bootstrap-dashboard.css?v=1.4.0')}}"/>
  <link rel="stylesheet" href="{{asset('css/templates/demo.css')}}"/>

  {{-- font --}}
  {{-- <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"> --}}
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
  <link href="{{asset('css/templates/pe-icon-7-stroke.css')}}" rel="stylesheet" />
  <title>Document</title>
</head>
<body>
  <div class="wrapper">
    @include('inc.sidebar')
    <div class="main-panel">
        <div class="content">
          <div class="container-fluid">
            @yield('content')
          </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                
                {{-- <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                </p> --}}
            </div>
        </footer>
    </div>
  </div>
</body>


<!--   Core JS Files   -->
<script src="{{asset('js/templates/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/templates/bootstrap.min.js')}}" type="text/javascript"></script>

<!--  Charts Plugin -->
<script src="{{asset('js/templates/chartist.min.js')}}"></script>

<!--  Notifications Plugin    -->
<script src="{{asset('js/templates/bootstrap-notify.js')}}"></script>


<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="{{asset('js/templates/light-bootstrap-dashboard.js?v=1.4.0')}}"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="{{asset('js/templates/demo.js')}}"></script>

</html>
<html>
    <head>
        <title>ACME Survey</title>
        {!! MaterializeCSS::include_css() !!}
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="/css/surveyapp.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    </head>
 
    <body>
      <div class="container">
          <!-- TOP MENU -->
          <div class="row top-spacing">
              <div class="center-align">
                <a class="btn blue waves-effect waves-light lighten-1 white-text" href="/"> Home </a>
                  @if(Auth::check())
                    <a class="btn-flat waves-effect waves-light darken-1 white black-text" href="/logout"> Logout </a>
                    <a class="btn-flat disabled" href="#" style="text-transform:none;">{{ Auth::user()->email }}</a>
                  @else
                    <a class="btn-flat waves-effect waves-light darken-1 white black-text" href="/login"> Login </a>
                    <a class="btn-flat waves-effect waves-light darken-1 white black-text" href="/register"> Register </a>
                  @endif
              </div>
          </div>
         <!-- End TOP MENU -->
         
         <!-- BODY OF PAGE -->
          <div class="row">
              <div class="col s12 m10 offset-m1 l8 offset-l2">
                @yield('content')
              </div>
          </div>
         <!-- End BODY OF PAGE -->
      </div>
    </body>
    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>   
    {!! MaterializeCSS::include_js() !!}
    <script src="/js/init.js"></script>
 
</html>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> @yield('titulo', 'Inicio') </title>
    <link rel="stylesheet" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('plugins/chosen/chosen.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/font-awesone/web-fonts-with-css/css/fontawesome-all.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/bootstrap-fileinput-master/css/fileinput.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <!-- Datepicker Files -->
    <link rel="stylesheet" href="{{asset('plugins/datepicker/css/bootstrap-datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datepicker/css/bootstrap-standalone.css')}}">
    <link rel="stylesheet" href="{{asset("plugins/css/estilo.css")}}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('plugins/trumbowyg/dist/ui/trumbowyg.min.css')}}">

  </head>
  <body>

      <div class="margen-abajo">
          @include('plantilla.partes.nav')
      </div>

      <div id="container" class="container-fluid">

          <div class="row">
            <div class="col-md-10 offset-md-1">
              @include('flash::message')
            </div>
          </div>

          <div class="row">
              @yield('contenido')
          </div>

      </div>

      <div class="clear">

      </div>

      <div id="footer" class="">
          @include('plantilla.partes.footer')
      </div>

      <script src="{{asset('plugins/jquery/jquery-3.3.1.min.js')}}"></script>
      <script src="{{asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script></script>
      <script src="{{asset('plugins/popovers/popper.min.js')}}"></script>
      <script src="{{asset('plugins/chosen/chosen.jquery.js')}}"></script>
      <script src="{{asset('plugins/bootstrap-fileinput-master/js/fileinput.min.js')}}"></script>
      <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/js/gijgo.min.js" type="text/javascript"></script>
      <script src="{{asset('plugins/datepicker/js/bootstrap-datepicker.js')}}"></script>
      <!-- Languaje del Datepicker -->
      <script src="{{asset('plugins/datepicker/locales/bootstrap-datepicker.es.min.js')}}"></script>
      <script src="{{asset('plugins/trumbowyg/dist/trumbowyg.min.js')}}"></script>
      <script src="{{asset('plugins/trumbowyg/dist/langs/es.min.js')}}"></script>
      <script src="{{asset('plugins/js/script.js')}}"></script>
  </body>
</html>

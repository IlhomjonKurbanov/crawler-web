<!DOCTYPE html>
<html>
  <head>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
  <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
  <script src="https://hpneo.github.io/gmaps/gmaps.js"></script>
  <script src="{{asset('js/functions.js')}}"></script>
  <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
  </head>
  <body onload="initialize()">
    <div id="map_canvas">    </div>
    <div class='shelf' id='shelf-1'><img class="draggable" id="draggable-1" src='{{asset('img/icon.png')}}'/><div>
    <div class="shelf" id='shelf-2'><img class="draggable" id="draggable-2" src='{{asset('img/icon2.png')}}'/><div>
  </body>
</html>
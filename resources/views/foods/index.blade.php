<html>
  <head>
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">
  <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div id="app">
    <v-app>
      <v-main>
      <food-index-component></food-index-component>
      </v-main>
    </v-app>
  </div>
  </body>
  <script src="{{ mix('js/app.js') }}"></script>
</html>


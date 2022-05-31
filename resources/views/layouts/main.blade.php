<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/img/Circle.png">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    {{-- CSS --}}
    <link rel="stylesheet" href="/css/layouts/main.css">

    {{-- Partials --}}
    <link rel="stylesheet" href="/css/partials/sidebar.css">
    <link rel="stylesheet" href="/css/partials/tables.css">


    {{-- Incomes --}}
    <link rel="stylesheet" href="/css/pages/incomes/incomes.css">
    
    {{-- Outcomes --}}
    <link rel="stylesheet" href="/css/partials/sidebar.css">

    {{-- Debts --}}
    <link rel="stylesheet" href="/css/partials/sidebar.css">


    <link rel="stylesheet" href="boxicons.min.css">

    {{-- JAVA SCRIPT JS --}}
    <link rel="javascript" href="/js/partials/sidebar.js">

    <title>Tolichris | {{ $title }}</title>

  </head>
  <body>
    <div id="overlaycategory" onclick="offCategory()"></div>

    <header>
      @include('partials.sidebar')
    </header>

    <div class="main-layout">
      @yield('gate')
    </div>
      
       @include('pages.utilities.javascript')

       <script src="https://cdn.jsdelivr.net/gh/underground-works/clockwork-browser@1/dist/toolbar.js"></script>
  </body>
</html>

<!doctype html>
<html>
<head>
    <!-- Scripts -->

    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous" defer></script>



    <!--   <script src="{{asset('/js/app.js')}}"defer></script>
    Styles-->
    <link href=" {{ request()->is('acceuil') ? asset('/css/acceuil.css')  : asset('/css/simpleLayout.css')}} " rel="stylesheet">



</head>
<body>
@include('/layout/menu')
@include('flash::message')
<!---->

<main>
    @yield('main')
    @include('/layout/icon')
</main>

<footer>
    @include('/layout/footer')
</footer>

</body>
</html>

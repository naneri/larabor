<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Fav and touch icons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="assets/ico/favicon.png">
<title>BOOTCLASIFIED - Responsive Classified Theme</title>
<!-- Bootstrap core CSS -->
<link href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

<!-- styles needed for carousel slider -->
<link href="{{asset('assets/css/owl.carousel.css')}}" rel="stylesheet">
<link href="{{asset('assets/css/owl.theme.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('assets/css/dropzone.css')}}">
@yield('styles')
<!-- Just for debugging purposes. -->
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->

<!-- include pace script for automatic web page progress bar  -->

<script>
    paceOptions = {
      elements: true
    };
</script>
<script src="{{asset('assets/js/pace.min.js')}}"></script>

</head>
<body>
  
<div id="wrapper">

  <div class="header">
    <nav class="navbar   navbar-site navbar-default" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
          <a href="{{url('/')}}" class="navbar-brand logo logo-title"> 
          <!-- Original Logo will be placed here  --> 
          <span class="logo-icon"><i class="icon icon-search-1 ln-shadow-logo shape-0"></i> </span> BOOT<span>CLASSIFIED </span> </a> </div>
        <div class="navbar-collapse collapse">
          
          <ul class="nav navbar-nav navbar-right">
            @if(!Auth::check())
              <li><a href="{{url('login')}}">Войти <i class="fa fa-key"></i></a></li>
              <li><a href="{{url('register')}}">Регистрация <i class="fa fa-user-plus"></i></a></li>
            @else
              <li><a href="{{route('profile.ads')}}">Профиль <i class="icon-user fa"></i></a></li>
              <li><a href="{{url('logout')}}">Выход <i class="glyphicon glyphicon-off"></i></a></li>
            @endif
            <li class="postadd"><a class="btn btn-block   btn-border btn-post btn-danger" href="{{url('item/add')}}">Подать объявление</a></li>
          </ul>
        </div>
        <!--/.nav-collapse --> 
      </div>
      <!-- /.container-fluid --> 
    </nav>
  </div>
  <!-- /.header -->
    
  @yield('content')
  
  <div class="footer" id="footer">
    <div class="container">
      <ul class=" pull-left navbar-link footer-nav">
      <li>
        <a href="{{url('/')}}"> Home </a> 
        <a href="{{url('about')}}"> About us </a> 
        <a href="{{url('contacts')}}"> Контакты </a> 
      </ul>
      <ul class=" pull-right navbar-link footer-nav">
        <li> &copy; 2015 BootClassified </li>
      </ul>
    </div>
    
  </div>
  <!-- /.footer --> 
</div>
<!-- /.wrapper --> 

<!-- Le javascript
================================================== --> 

<!-- Placed at the end of the document so the pages load faster --> 
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"> </script>
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script> 

<!-- include carousel slider plugin  --> 
<script src="{{asset('assets/js/owl.carousel.min.js')}}"></script> 

<!-- include equal height plugin  --> 
<script src="{{asset('assets/js/jquery.matchHeight-min.js')}}"></script> 

<!-- include jquery list shorting plugin plugin  --> 
<script src="{{asset('assets/js/hideMaxListItem.js')}}"></script> 

<!-- include jquery.fs plugin for custom scroller and selecter  --> 
<script src="{{asset('assets/plugins/jquery.fs.scroller/jquery.fs.scroller.js')}}"></script>
<script src="{{asset('assets/plugins/jquery.fs.selecter/jquery.fs.selecter.js')}}"></script>


<!-- include custom script for site  --> 
<script src="{{asset('assets/js/script.js')}}"></script>




<!-- include jquery autocomplete plugin  -->


<script type="text/javascript" src="{{asset('assets/plugins/autocomplete/jquery.autocomplete.js')}}"></script>

<script type="text/javascript" src="{{asset('assets/js/lodash.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/dropzone.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/notify.min.js')}}"></script>
@yield('scripts')

@include('_misc._footer')
@include('_partials._alerts')
</body>
</html>

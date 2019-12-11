<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<html>
  <head>

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
  </head>
<body id="LoginForm">
<link rel="stylesheet" href="{{ asset('css/backend_css/login.css') }}">
@if(Session::has('flash_message_error'))
    <div class="alert alert-success alert-block">
    	<button type="button" class="close" data-dismiss="alert">×</button>
            <strong> {!! session ('flash_message_error') !!}</strong>
    </div>
@endif

@if(Session::has('flash_message_success'))
    <div class="alert alert-success alert-block">
    	<button type="button" class="close" data-dismiss="alert">×</button>
            <strong> {!! session ('flash_message_success') !!}</strong>
    </div>

@endif



<div class="container">
<h1 class="form-heading"></h1>
<div class="login-form">
<div class="main-div">
    <div class="panel">
   <h2>Admin Login</h2>
   <p>Inserisci email e password</p>
   </div>
    <form id="Login" method="post" action="{{url('admin')}}">{{csrf_field() }}

        <div class="form-group">


            <input type="email" name="email" class="form-control" id="inputEmail" placeholder="indirizzo Email ">

        </div>

        <div class="form-group">

            <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">

        </div>
        <div class="forgot">
        <a href="reset.html"> password dimenticata?</a>
</div>
        <input type="submit" value="Login" class="btn btn-primary">

    </form>
    </div>
<p class="botto-text"> </p>
</div></div></div>

<script src="{{ asset('js/backend_js/bootstrap.min.js ') }}"></script>

</body>
</html>

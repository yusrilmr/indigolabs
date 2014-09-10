<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="images/favicon.png">

    <title>Register Admin</title>

    <!--Core CSS -->
    {{ HTML::style('bs3/css/bootstrap.min.css') }}
    {{ HTML::style('css/bootstrap-reset.css') }}
    {{ HTML::style('font-awesome/css/font-awesome.css') }}

    <!-- Custom styles for this template -->
    {{ HTML::style('css/style.css') }}
    {{ HTML::style('css/style-responsive.css') }}


    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="login-body">

    <div class="container">
    
      {{Form::open(array('url'=>'registeringAdmin'))}}
      <div class="form-signin">
        <h2 class="form-signin-heading">Register Admin</h2>

        <div class="login-wrap">
            <p>
               {{$errors->first('username')}}
               {{$errors->first('password')}}
            </p>
            <div class="user-login-info">
                {{Form::text('username', '', array('class' => 'form-control','placeholder' => 'Username','autofocus'))}}
                {{Form::password('password', array('class' => 'form-control','placeholder' => 'Password'))}}
                
            </div>
            {{Form::submit('Register Admin', array('class' => 'btn btn-primary btn-lg btn-block'))}}

        </div>


      
      </div>
      {{Form::close()}}
      
    </div>



    <!-- Placed js at the end of the document so the pages load faster -->

    <!--Core js-->
    {{ HTML::script('js/jquery.js') }}
    {{ HTML::script('bs3/js/bootstrap.min.js') }}

  </body>
</html>

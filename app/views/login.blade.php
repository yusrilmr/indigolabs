<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="images/favicon.png">

    <title>Masuk Akun</title>

    <!--Core CSS -->
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

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

      {{Form::open(array('url'=>'authenticate'))}}
      <div class="form-signin">
        <h2 class="form-signin-heading">Masuk Akun</h2>

        <div class="login-wrap">
            
            <div class="user-login-info">
			@if(Session::has('success'))
                   <div class="alert alert-info">{{ Session::get('success') }}</div>
                @endif
            <p>
               @if(Session::has('pesan_error'))
                   <div class="alert alert-danger">{{ Session::get('pesan_error') }}</div>
                @endif
            </p>
                {{Form::text('username', '', array('class' => 'form-control','placeholder' => 'Username','autofocus'))}}
                {{Form::password('password', array('class' => 'form-control','placeholder' => 'Password'))}}
                <div class="registration">
                Tidak mempunyai akun?
                    <a class="" href="register">
                        Daftar
                    </a>
                </div>
            </div>
            {{Form::submit('Masuk', array('class' => 'btn btn-primary btn-lg btn-block'))}}

        </div>


      
      </div>
      {{Form::close()}}

    </div>


    <!-- Placed js at the end of the document so the pages load faster -->

    <!--Core js-->
    <script src="js/jquery.js"></script>
    <script src="bs3/js/bootstrap.min.js"></script>

  </body>
</html>
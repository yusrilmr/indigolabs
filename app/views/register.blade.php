<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="images/favicon.png">

    <title>Daftar Akun</title>

    <!--Core CSS -->
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="js/bootstrap-fileupload/bootstrap-fileupload.css" />
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
    {{Form::open(array('url'=>'registeringPraktikan','files'=>true))}}
        <div class="form-signin">
                <h2 class="form-signin-heading">Daftar Sekarang</h2>
                <div class="login-wrap">
				<div class="alert alert-warning">
					PERHATIAN :
					
					Pastikan Nama,NIM, Kelas Anda benar, karena data tidak dapat dirubah kembali.
					
				</div>
                 <p>
                    @if(Session::has('pesan_error'))
                       <div class="alert alert-danger">{{ Session::get('pesan_error') }}</div>
                    @endif
                </p>
                {{ HTML::ul($errors->all()) }} 
                    {{Form::text('praktikan_nim', '', array('class' => 'form-control','placeholder' => 'NIM','autofocus'))}}
                    {{Form::text('praktikan_nama', '', array('class' => 'form-control','placeholder' => 'Nama Lengkap','autofocus'))}}
                    {{ Form::select('kelas_nama', $list_kelas , Input::old('kelas_nama'),array('class' => 'form-control input-sm m-bot15')) }}


                    {{Form::text('praktikan_telp', '', array('class' => 'form-control','placeholder' => 'Nomor Telephone','autofocus'))}}
                    {{Form::text('praktikan_email', '', array('class' => 'form-control','placeholder' => 'E-mail','autofocus'))}}
                    
                    <p> Informasi Akun</p>
                    {{Form::text('username', '', array('class' => 'form-control','placeholder' => 'Username','autofocus'))}}
                    {{Form::password('password', array('class' => 'form-control','placeholder' => 'Password','autofocus'))}}
                    {{Form::password('confirm_password', array('class' => 'form-control','placeholder' => 'Re-type Password','autofocus'))}}
                    
                    <div class="form-group last ">
                    <label class="control-label ">Unggah Foto Profil</label>
                        <div class="fileupload fileupload-new " data-provides="fileupload">
                            
                            <div class="fileupload-preview fileupload-exists thumbnail center-block" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <div>
                                <span class="btn btn-white btn-file">
                                <span class="fileupload-new "><i class="fa fa-paper-clip"></i> Select image</span>
                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                    {{Form::file('file', array('class' => 'default'))}}
                                   <!-- <input type="file" class="default" />-->
                                </span>
                                <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                            </div>
                         </div>
                             <span class="label label-danger ">NOTE!</span><br><br>
                              <span class="text-center">Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only
                              </span>

                     </div><br><br>

                    {{Form::submit('Daftar', array('class' => 'btn btn-lg btn-login btn-block'))}}

                    <div class="registration">
                        Sudah Mendaftar?
                        <a class="" href="login">
                            Masuk Akun
                        </a>
                    </div>

                </div>

              </div>
    {{Form::close()}}
    </div>


    <!-- Placed js at the end of the document so the pages load faster -->

    <!--Core js-->
    <script src="js/jquery.js"></script>
    <script src="bs3/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-fileupload/bootstrap-fileupload.js"></script>
    <script src="js/advanced-form.js"></script>

  </body>
</html>
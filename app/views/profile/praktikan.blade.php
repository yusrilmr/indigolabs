@include('header')
@include('menu')
	<link rel="stylesheet" type="text/css" href="js/bootstrap-fileupload/bootstrap-fileupload.css" />
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
	<style>
		.edtpass{
			padding-top:50px;
		}
	</style>
	<!--main content start-->
	<section id="main-content">
		<section class="wrapper">
		<!-- page start-->

		<div class="row">
			<div class="col-md-12">

				{{ HTML::ul($errors->all(), array('class' => 'alert alert-danger', 'style' => 'padding-left:40px')) }}  
				@if(Session::has('error'))
					<div class="alert alert-danger">{{ Session::get('error') }}</div>
				@endif
				@if(Session::has('success'))
					<div class="alert alert-success">{{ Session::get('success') }}</div>
				@endif
				<section class="panel">

					<div class="panel-body profile-information">
						<div class="col-md-3">
							<div class="profile-pic text-center">
                               <img src='uploads/user_profpic/{{ $data->praktikan_foto }}.jpeg' alt=""/>
                           </div>
						</div>
						
						<div class="col-md-9">
                           	<div class="profile-desk">
                               	<h1>{{ $data->praktikan_nama }}</h1>
                               	<h5>{{ $data->praktikan_nim }}</h5>
                           	</div>
                           	<div class="edtpass">
                           		<a href="#updatePassword" class="btn btn-primary" data-toggle="modal">Edit Password</a>
                           		<div class="modal fade" id="updatePassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	                                <div class="modal-dialog">
	                                    <div class="modal-content">
	                                        <div class="modal-header">
	                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                                            <h4 class="modal-title">Edit Password</h4>
	                                        </div>
	                                        <div class="modal-body">
	                                        	{{Form::open(array('url' => 'editPass', 'method'=>'post',  'role' => 'form', 'class' => 'form-horizontal'))}}
	                                        		<div class="form-group">
	                                        			{{Form::label('old-pass', 'Old Password', array('class' => 'col-lg-4 control-label'))}}
	                                        			<div class="col-lg-7">
	                                        			{{Form::password('passLama', array('class' => 'form-control', 'placeholder' => 'Old Password'))}}
	                                        			</div>
	                                        		</div>
	                                        		<div class="form-group">
	                                        			{{Form::label('new-pass', 'New Password', array('class' => 'col-lg-4 control-label'))}}
	                                        			<div class="col-lg-7">
	                                        			{{Form::password('passBaru', array('class' => 'form-control', 'placeholder' => 'New Password'))}}
	                                        			</div>
	                                        		</div>
	                                        		<div class="form-group">
	                                        			{{Form::label('retype', 'Re-type New Password', array('class' => 'col-lg-4 control-label'))}} 
	                                        			<div class="col-lg-7">
	                                        			{{Form::password('ulangPass', array('class' => 'form-control', 'placeholder' => 'Re-type New Password'))}}
	                                        			</div>
	                                        		</div>
	                                        		<div class="form-group">
		                                        		<div class="col-lg-offset-4 col-lg-12">
		                                        		{{Form::submit('Edit Password', array('class' => 'btn btn-success'))}}
		                                        		<button type="button" class="btn btn-warning" data-dismiss="modal" aria-hidden="true">Cancel</button>
		                                        		</div>
	                                        		</div>
	                                        	{{Form::close()}}
	                                        </div>
	                                    </div>
	                                </div>
                            	</div>
                           	</div>
                       </div>
					</div>
				</section>
			</div>
			<div class="col-md-12">
				<section class="panel">
					<header class="panel-heading tab-bg-dark-navy-blue ">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a data-toggle="tab" href="#praktikum">
                                    Praktikum
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#profile">
                                    Profile
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#edit">
                                    Edit Profile
                                </a>
                            </li>
                        </ul>
                    </header>

                    <div class="panel-body">
                        <div class="tab-content tasi-tab">
                        	<div id="praktikum" class="tab-pane active">
	                        	<div class="row">
	                        		<div class="col-md-12">
	                        			<div class="prf-contacts sttng">
		                                    <h2 class="text-center">Contoh Praktikum</h2>
		                                </div>
	                        		</div>
	                        	</div>
	                        </div>
                        	<div id="profile" class="tab-pane ">
	                        	<div class="row">
	                        		<div class="col-md-12">
	                        			<div class="prf-contacts sttng">
		                                    <h2 class="text-center">Informasi Pribadi</h2>
		                                </div>
	                        		</div>
	                        		<div class="position-center">
	                        		<div class="col-md-6">
		                                <div class="form-horizontal">
		                                	<div class="form-group">
			                                	<label class="col-lg-3 control-label">Nim </label>
			                                	<label class="col-lg-1 control-label">:</label>
		                                        <label class="col-md-6 control-label">{{ $data->praktikan_nim }}</label>
			                                </div>    
		                             		<div class="form-group">
			                                	<label class="col-lg-3 control-label">Nama </label>
			                                	<label class="col-lg-1 control-label">:</label>
			                                	<label class="col-md-6 control-label">{{ $data->praktikan_nama }}</label>
			                  				</div>    
		                             		
		                                </div>
		                            </div>
		                            <div class="col-md-6">
		                            	<div class="form-horizontal">
		                            		<div class="form-group">	
			                                	<label class="col-lg-3 control-label">Email </label>
			                                	<label class="col-lg-1 control-label">:</label>
			                                	<label class="col-md-6 control-label" >{{ $data->praktikan_email }}</label>
											</div>    
		                             		<div class="form-group">
			                                	<label class="col-lg-3 control-label">Telp </label>
			                                	<label class="col-lg-1 control-label">:</label>
			                                	<label class="col-md-6 control-label">{{ $data->praktikan_telp }}</label>
		                                    </div>
		                                </div>
		                            </div>
		                            </div>
		                            <br><br><br><br><br><br><br><br><br>
		                            <div class="prf-contacts sttng">
		                                    <h2 class="text-center">Informasi Akun</h2>
		                                </div>
		                            <div class="position-center" style="width:40%">
		                            	<div class="form-horizontal">
		                            	<div class="form-group">
			                                	<label class="col-lg-4 control-label">Tipe Akun </label>
			                                	<label class="col-lg-1 control-label">:</label>
			                                	<label class="col-md-6 control-label">Praktikan</label>
			                  				</div>
		                            		<div class="form-group">
			                                	<label class="col-lg-4 control-label">Jurusan </label>
			                                	<label class="col-lg-1 control-label">:</label>
			                                	<label class="col-md-6 control-label">Sistem Informasi</label>
			                  				</div>
			                  				<div class="form-group">
			                                	<label class="col-lg-4 control-label">Departemen </label>
			                                	<label class="col-lg-1 control-label">:</label>
			                                	<label class="col-md-6 control-label">Rekayasa Industri</label>
			                  				</div>
		                            	</div>
		                            </div>
	                        	</div>
	                       	</div>
	                       	<div id="edit" class="tab-pane ">
	                        	<div class="position-center">
		                            {{Form::open(array('url' => 'editProfile', 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form', 'files' => true))}}
		                            <div class="prf-contacts sttng">
										<h2>Data Pribadi</h2>
		                            </div>
		                            <div class="form-group">
			                            {{Form::label('nim', 'Nim', array('class' => 'col-lg-2 control-label'))}}
			                            <div class="col-lg-6">
			                            	{{Form::text('nimVal', $data->praktikan_nim, array('class' => 'form-control', 'disabled')) }}
			                        	</div>
			                        </div>
			                        <div class="form-group">
			                            {{Form::label('nama', 'Nama', array('class' => 'col-lg-2 control-label'))}}
			                            <div class="col-lg-6">
			                            	{{Form::text('namaVal', $data->praktikan_nama, array('class' => 'form-control', 'disabled')) }}
			                        	</div>
			                        </div>
			                        <div class="prf-contacts sttng">
										<h2>Avatar</h2>
		                            </div>
		                            <div class="form-group last ">
                    					<label class="control-label col-lg-2">Unggah Foto Profil</label>
                    					<div class="col-lg-6">
                        					<div class="fileupload fileupload-new " data-provides="fileupload">
                            
	                            				<div class="fileupload-preview fileupload-exists thumbnail center-block" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
	                            				<div>
	                                				<span class="btn btn-white btn-file">
		                                				<span class="fileupload-new "><i class="fa fa-paper-clip"></i> Select image</span>
		                                				<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
		                                    			{{Form::file('profilePic', array('class' => 'default'))}}
	                                				</span>
	                                				<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
	                            				</div>
                         					</div>
                             				<span class="label label-danger ">NOTE!</span><br><br>
                              				<span class="text-center">Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only</span>
										</div>
                     				</div>
			                        <div class="prf-contacts sttng">
										<h2>Informasi Kontak</h2>
		                            </div>
		                            <div class="form-group">
			                            {{Form::label('email', 'Email', array('class' => 'col-lg-2 control-label'))}}
			                            <div class="col-lg-6">
			                            	{{Form::text('email', $data->praktikan_email, array('class' => 'form-control')) }}
			                        	</div>
			                        </div>
			                        <div class="form-group">
			                            {{Form::label('telp', 'Telp', array('class' => 'col-lg-2 control-label'))}}
			                            <div class="col-lg-6">
			                            	{{Form::text('phoneNumber', $data->praktikan_telp, array('class' => 'form-control')) }}
			                        	</div>
			                        </div>
			                        <div class="form-group">
			                            <div class="col-lg-offset-2 col-lg-10">
			                            	{{Form::submit('Edit Profile', array('class' => 'btn btn-primary'))}}
			                        	</div>
			                        </div>
		                            {{Form::close()}}
	                        	</div>
	                        </div>
	                	</div>
                    </div>
				</section>
			</div>
		</div>
		<!-- page end-->
		</section>
	</section>
	<!--main content end-->
@include('footer')
<script type="text/javascript" src="js/bootstrap-fileupload/bootstrap-fileupload.js"></script>
<script src="js/advanced-form.js"></script>
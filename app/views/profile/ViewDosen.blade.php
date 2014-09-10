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
                               <img src='uploads/user_profpic/{{ $data->praktikan_foto }}' alt=""/>
                           </div>
						</div>
						
						<div class="col-md-9">
                           	<div class="profile-desk">
                               	<h1>{{ $data->praktikan_nama }}</h1>
                               	<h5>{{ $data->praktikan_nim }}</h5>
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
                                <a data-toggle="tab" href="#profile">
                                    Profile
                                </a>
                            </li>
                        </ul>
                    </header>

                    <div class="panel-body">
                        <div class="tab-content tasi-tab">
                        	<div id="profile" class="tab-pane active">
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
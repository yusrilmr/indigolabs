@include('header')
@include('dashboard/admin/menu_admin')
	<!--main content start-->
	<section id="main-content">
		<section class="wrapper">
		<!-- page start-->

		<div class="row">
                <div class="col-md-12">
                    <!--breadcrumbs start -->
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="#">Dashboard</a></li>
                        <li class="active">Current page</li>
                    </ul>
                    <!--breadcrumbs end -->
                </div>
        </div>

		<div class="row">
			<div class="col-sm-12">
				<section class="panel">
					<header class="panel-heading">
						Manage Dosen
						<span class="tools pull-right">
							<a href="javascript:;" class="fa fa-chevron-down"></a>
							<a href="javascript:;" class="fa fa-cog"></a>
							<a href="javascript:;" class="fa fa-times"></a>
						 </span>
					</header>
					<div class="panel-body">
						<p>
			               @if(Session::has('pesan_error'))
			                   <div class="alert alert-danger">{{ Session::get('pesan_error') }}</div>
			                @endif
			            </p>
						<a href="#myModal" data-toggle="modal" class="btn btn-success">Tambah Dosen</a>
						    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
	                            <div class="modal-dialog">
	                                <div class="modal-content">
	                                    <div class="modal-header">
	                                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
	                                        <h4 class="modal-title">Formulir Tanpa Dosen</h4>
	                                    </div>
	                                    <div class="modal-body">
	                                    	<div class="form">
	                                    	
	                                    		<input type="text" class="form-control form-group" placeholder="NIP"/>
	                                    	
	                                    		<input type="text" class="form-control form-group" placeholder="Nama Lengkap Dosen"/>
	                                    		<input type="text" class="form-control form-group" placeholder="Email Dosen"/>
	                                    		<input type="text" class="form-control form-group" placeholder="No Telephone Dosen"/>


	                                    		<input type="text" class="form-control form-group" placeholder="Username"/>
	                                    		<input type="text" class="form-control form-group" placeholder="Password"/>
	                                    		<input type="text" class="form-control form-group" placeholder="Konfirmasi Password"/>
	                                    		<input type="file" class="form-control form-group" placeholder="NIP"/>


	                                    		<button type="submit" class="btn btn-danger ">Batal</button>
	                                    		<button type="submit" class="btn btn-primary pull-right">Tambah</button>
	                                    		
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

@include('header')
@include('menu')
    <link href="js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
	<!--main content start-->
	<section id="main-content">
		<section class="wrapper">
		<!-- page start-->

	        <div class="row">
	            <div class="col-md-12">
	                <ul class="breadcrumb">
	                    <li><a href="/"><i class="fa fa-home"></i>Home</a></li>
	                    <li class="active">Current page</li>
	                </ul>
	            </div>
	        </div>
	        <div class="row" >
	            <div class="col-md-12">	
		        	<div class="row">

		        		@foreach ($datas as $data) 
		        			<div class="col-md-4">
		                        <!--widget start--> 
		                    <aside class="profile-nav alt">
		                        <section class="panel">
		                            <div class="user-heading alt blue-bg" style="bgcolor:blue;height:160px">
		                                <a href="#">
		                                    <img alt="" src="images/lock_thumb.jpg">
		                                </a>
		                                <h1 style="color:#A5A5A5;font-weight: bold;">{{ $data->lab_nama }}</h1>
		                                <p style="font-size:10pt">{{ $data->lab_keterangan }}</p>
		                            </div>

		                            <ul class="nav nav-pills nav-stacked">
		                                <li><a href="javascript:;"> <i class="fa fa-tasks"></i> List Asisten <span class="badge label-success pull-right r-activity">10</span></a></li>
		                                <li><a href="javascript:;"> <i class="fa fa-tasks"></i> List Praktikum <span class="badge label-danger pull-right r-activity">15</span></a></li>
		                            </ul>
		                        </section>
		                    </aside>
		                        <!--widget end-->
		                </div>
		        		
		        		@endforeach
		                
		            </div>
		        </div>
        	</div>

        </section>
	</section>
	<!--main content end-->
@include('footer')
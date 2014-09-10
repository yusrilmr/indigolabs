@include('header')
@include('dashboard/praktikan/menu_praktikan')
	<!--main content start-->
	<section id="main-content">
		<section class="wrapper">

        <div class="row">
                <div class="col-md-12">
                    <!--breadcrumbs start -->
                    <ul class="breadcrumb">
                        <li><a href="/"><i class="fa fa-home"></i> Dashboard</a></li>
                        <li><a href="/">Registrasi</a></li>
                        <li><a href="/praktikan/RegisterPraktikum">Registrasi Praktikum</a></li>
                        <li  class="active">List Praktikum</li>
                    </ul>
                    <!--breadcrumbs end -->
                </div>
        </div>


		<!-- page start-->
			<div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        List Praktikum
                    </header>


                </section>
            </div>

            <div class="row">
            <div class="col-sm-12">
                <div class="row-fluid" id="draggable_portlets">
                <!--Praktikum Prodase -->

                    @foreach ($list_praktikum as $list_lab) 
                        <div class="col-md-3 column sortable">
                            @foreach ($list_lab as $praktikum) 
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                {{ $praktikum->lab_nama }} | {{ $praktikum->praktikum_nama }}
                                            </div>
                                            <div class="panel-body">
                                                <a href="/praktikan/PilihJadwal?praktikum_id={{ $praktikum->praktikum_id }}" class="btn btn-info btn-lg btn-block">Pilih Praktikum</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>   
                    @endforeach
                    
                </div>
            </div>
        </div>


        </div>

		<!-- page end-->
		</section>
	</section>
	<!--main content end-->
@include('footer')

{{ HTML::script('js/jquery-ui/jquery-ui-1.10.1.custom.min.js') }}



<!-- END JAVASCRIPTS -->

{{ HTML::script('js/draggable-portlet.js') }}


<script>
    jQuery(document).ready(function() {
        DraggablePortlet.init();
    });
</script>

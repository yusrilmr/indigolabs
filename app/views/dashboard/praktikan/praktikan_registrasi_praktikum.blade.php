@include('header')
@include('dashboard/praktikan/menu_praktikan')
	<!--main content start-->
	<section id="main-content">
		<section class="wrapper">
		<!-- page start-->
            <div class="row">
                <div class="col-md-12">
                    <!--breadcrumbs start -->
                    <ul class="breadcrumb">
                        <li><a href="/"><i class="fa fa-home"></i> Dashboard</a></li>
                        <li><a href="#">Registrasi</a></li>
                        <li class="active">Registrasi Praktikum</li>
                    </ul>
                    <!--breadcrumbs end -->
                </div>
            </div>


			<div class="row">
            <div class="col-sm-12">
                    {{ HTML::ul($errors->all(), array('class' => 'alert alert-danger', 'style' => 'padding-left:40px')) }}  
                    @if(Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
                    @if(Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                    
                <section class="panel">
                    <header class="panel-heading">
                        Registrasi Praktikum
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                    </header>
                    <div class="panel-body">
                        <div class="adv-table editable-table ">
                            <div class="clearfix">
                                <div class="btn-group">
                                    <a data-toggle="modal" href="/praktikan/PilihPraktikum">
                                        <button class="btn btn-primary">
                                            Tambah Praktikum <i class="fa fa-plus"></i>
                                        </button>
                                    </a>
                                </div>
                                <div class="btn-group pull-right">
                                    <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="#">Print</a></li>
                                        <li><a href="#">Save as PDF</a></li>
                                        <li><a href="#">Export to Excel</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="space15"></div>
                            <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                <thead>
                                <tr>
                                    <th>Laboraturium</th>
                                    <th>Praktikum</th>
                                    <th>Hari</th>
                                    <th>Shift</th>
                                    <th></th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($datas as $data) 
                                    <tr class="">
                                    <td>{{ $data->lab_nama }}</td>
                                    <td>{{ $data->praktikum_nama }}</td>
                                    <td>
                                    @if($data->jadwal_hari == 1)
                                        Senin
                                    @elseif($data->jadwal_hari == 2)
                                        Selasa
                                    @elseif($data->jadwal_hari == 3)
                                        Rabu
                                    @elseif($data->jadwal_hari == 4)
                                        Kamis
                                    @elseif($data->jadwal_hari == 5)
                                        Jumat
                                    @elseif($data->jadwal_hari == 6)
                                        Sabtu
                                    @endif

                                    </td>
                                    <td>{{ $data->jadwal_jam_mulai }} - {{ $data->jadwal_jam_selesai}}</td>
                                    <td><a href="/praktikan/HapusPraktikum?id={{$data->jadwal_id}}" class="btn btn-danger">Hapus</a></td>
                                </tr>
                                @endforeach
                                
                                </tbody>
                            </table>
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
<!--script for this page only-->
{{ HTML::script('js/bootstrap-fileupload/bootstrap-fileupload.js') }}
{{ HTML::script('js/table-editable.js') }}
{{ HTML::script('js/iCheck/jquery.icheck.js') }}
{{ HTML::script('js/icheck-init.js') }}




<!-- END JAVASCRIPTS -->
<script>
    jQuery(document).ready(function() {
        EditableTable.init();
    });
</script>
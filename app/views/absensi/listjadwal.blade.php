@include('header')
@include('dashboard/asisten/menu_asisten')
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

		<div class="row">
			<div class="col-sm-12">
                {{ HTML::ul($errors->all(), array('class' => 'alert alert-danger', 'style' => 'padding-left:40px')) }}  
                    @if(Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
				<section class="panel">
                    

                    @if(!empty($listPraktikum))

                    <header class="panel-heading">
                        List Jadwal
                    </header>
                    <div class="panel-body">
                        <div class="adv-table editable-table ">
                            <div class="col-md-12">
                                <section id="unseen">
                                    <div class="table-responsive">
                                        <table  class="table table-striped table-hover table-bordered" id="editable-sample">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>Nama Laboratorium</th>
                                                	<th>Nama Praktikum</th>
                                                    <th>Total Modul</th>
                                                    <th>Total Peserta</th>
                                                    <th>Operasi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($listPraktikum as $praktikum)
                                                    <tr>
                                                    	<td>{{ $praktikum->lab_nama }}</td>
                                                    	<td>{{ $praktikum->praktikum_nama }}</td>
                                                    	<td>{{ $praktikum->totalModul }}</td>
                                                        <td>{{ $praktikum->totalPeserta }}</td>
                                                    	<td><a href="pilihShift?id={{ $praktikum->praktikum_id }}">Detail</a></button></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    @endif
                </section>
			</div>
		</div>
		<!-- page end-->
		</section>
	</section>
	<!--main content end-->
@include('footer')
{{ HTML::script('js/bootstrap-fileupload/bootstrap-fileupload.js') }}
{{ HTML::script('js/table-editable.js') }}
{{ HTML::script('js/iCheck/jquery.icheck.js') }}
{{ HTML::script('js/icheck-init.js') }}

<script>
    jQuery(document).ready(function() {
        EditableTable.init();
    });
</script>
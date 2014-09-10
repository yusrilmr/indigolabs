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

		<div class="row">
			<div class="col-sm-12">
				<section class="panel">
                    @if(!empty($error))
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endif

                    @if(!empty($listJadwal))

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
                                                    <th>Nama Praktikum</th>
                                                	<th>Jadwal Hari</th>
                                                    <th>Shift</th>
                                                    <th>Jam</th>
                                                    <th>Jumlah Mahasiswa</th>
                                                    <th>Operasi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($listJadwal as $jadwal)
                                                    <tr>
                                                    	<td>{{ $jadwal->praktikum_nama }}</td>
                                                    	<td>{{ $jadwal->hari }}</td>
                                                    	<td>{{ $jadwal->jadwal_shift }}</td>
                                                        <td>{{ $jadwal->jadwal_jam_mulai}} - {{ $jadwal->jadwal_jam_selesai}}</td>
                                                        <td>{{ $jadwal->jumlah }}</td>
                                                    	<td><a href="pilihModul?jadwal={{ $jadwal->jadwal_id }}">Detail</a></button></td>
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
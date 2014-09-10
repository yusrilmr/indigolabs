@include('header')
@include('dashboard/dosen/menu_dosen')
    <link href="js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
	<!--main content start-->
	<section id="main-content">
		<section class="wrapper">
		<!-- page start-->

        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li><a href="/"><i class="fa fa-home"></i>Home</a></li>
                    <li><a href="/"></i>Data Absen</a></li>
                    <li><a href="/DataAbsen/ListPraktikumLab">Daftar Laboratorium</a></li>
                    <li><a href="/DataAbsen/PilihPraktikumLab">Daftar Praktikum Laboratorium</a></li>
                    <li class="active"><a href="/DataAbsen/PilihKelas">Kelas Praktikum</a></li>
                    
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <section class="panel">

                    <div class="row">
                                    <div class="col-sm-12">
                                        <section class="panel">
                                            <header class="panel-heading">
                                               
                                               <p class="text-center">{{$labInfo->praktikum_nama}} | {{ $labInfo->lab_nama }}</p>
                                                
                                            </header>
                                            <div class="panel-body">
                                                <div class="adv-table editable-table ">
                                                    <div class="clearfix">
                                                        <div class="btn-group pull-right">
                                                            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                                                            </button>
                                                            <ul class="dropdown-menu pull-right">
                                                                <li><a href="/DataAbsen/PrintAbsen" target="_blank">Print</a></li>
                                                                <li><a href="#">Save as PDF</a></li>
                                                                <li><a href="#">Export to Excel</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="space15"></div>
                                                        <div class="col-md-12">
                                                            <section id="unseen">
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>No</th>
                                                                            <th>Nama Laboratorium</th>
                                                                            <th>Nama Praktikum</th>
                                                                            <th>Kelas</th>
                                                                            <th>Total Mahasiswa</th>
                                                                            <th>Detail</th>
                                                                            
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($labInfo->listKelas as $kelas)
                                                                                <tr> 
                                                                                <td style="font-align:center;">{{$kelas->no}}</td>
                                                                                <td>{{$labInfo->lab_nama}}</td>
                                                                                <td>{{$labInfo->praktikum_nama}}</td>
                                                                                <td>{{$kelas->kelas_nama}}</td>
                                                                                <td>{{$kelas->quota}}</td>
                                                                                <td><a href="/DataAbsen/AbsenPraktikum?praktikum={{$labInfo->praktikum_id}}&kelas={{$kelas->kelas_id}}" class="btn btn-info">Lihat Detail</a></td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </section>

                                                        </div>

                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>  

                    
                    
                </section>
            </div>
        </div>

        


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
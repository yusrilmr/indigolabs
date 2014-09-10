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
                    <li><a href="/DataAbsen/PilihKelas">Kelas Praktikum</a></li>
                    <li class="active"><a href="/DataAbsen/PilihKelas"></a>Absen Praktikum</li>
                    
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <section class="panel">
                    
                    <div class="panel-body">
                        <div class="tab-content">
                            <div id="SI3601" class="tab-pane active">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <section class="panel">
                                            <header class="panel-heading">
                                               
                                               <p class="text-center">{{$labInfo->praktikum_nama}} | {{$kelasInfo->kelas_nama}} | {{$labInfo->lab_nama}}</p>
                                                
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
                                                                            <th>NIM</th>
                                                                            <th>Nama Mahasiswa</th>
                                                                            <th>Kelas</th>
                                                                            @foreach ($totalModul as $modul) 
                                                                                <th>Modul {{$modul->no}}</th>
                                                                            @endforeach
                                                                            <th>Kehadiran</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($dataMahasiswa as $mahasiswa)
                                                                                <tr> 
                                                                                    <td>{{$mahasiswa->no}}</td>
                                                                                    <td>{{$mahasiswa->praktikan_nim}}</td>
                                                                                    <td>{{$mahasiswa->praktikan_nama}}</td>
                                                                                    <td>{{$kelasInfo->kelas_nama}}</td>
                                                                                    @foreach ($mahasiswa->absen as $absensi)
                                                                                        <td>
                                                                                        @if($absensi->absensi == null)
                                                                                            Alpha
                                                                                        @elseif($absensi->absensi->status == 1)
                                                                                            Hadir
                                                                                        @elseif($absensi->absensi->status == 2)
                                                                                            Izin
                                                                                        @endif
                                                                                        </td>
                                                                                    @endforeach
                                                                                    <td>{{ $mahasiswa->kehadiran}} %</td>
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

                            </div>

                            
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
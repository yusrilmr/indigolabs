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
                        <li><a href="/">Registrasi</a></li>
                        <li><a href="/praktikan/RegisterPraktikum">Registrasi Praktikum</a></li>
                        <li><a href="/praktikan/PilihPraktikum">List Praktikum</li>
                        <li  class="active">Pilih Jadwal</li>
                    </ul>
                    <!--breadcrumbs end -->
                </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Pilih Jadwal
                    </header>
                    <div class="panel-body">
                        
                        <div class="col-md-12">
                            <section id="unseen">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-condensed">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th width="160px">Senin</th>
                                        <th width="160px">Selasa</th>
                                        <th width="160px">Rabu</th>
                                        <th width="160px">Kamis</th>
                                        <th width="160px">Jumat</th>
                                        <th width="160px">Sabtu</th>
                                      
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($listJadwal as $jadwal) 
                                        <tr  height="50px" >
                                        @foreach ($jadwal as $row) 
                                            {{ $row }}
                                        @endforeach
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </section>
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

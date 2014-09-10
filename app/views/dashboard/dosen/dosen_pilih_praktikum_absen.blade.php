@include('header')
@include('dashboard/dosen/menu_dosen')
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">


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
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Pilih Praktikum
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                    </header>


                </section>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="row-fluid" id="draggable_portlets">
                    <!--Praktikum Prodase -->
                        @foreach($listPraktikum as $praktikum)                        
                            <div class="col-md-3 column sortable">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel">
                                                <div class="panel-heading">
                                                    {{$praktikum->lab_nama}} | {{$praktikum->praktikum_nama}}
                                                </div>
                                                <div class="panel-body">
                                                    <a href="/DataAbsen/PilihKelas?id={{$praktikum->praktikum_id}}" class="btn btn-info btn-lg btn-block">Lihat Kelas</a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
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

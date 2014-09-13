@include('header')
@include('dashboard/admin/menu_admin')
<!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- List Modul-->        
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        <ul class="breadcrumb">
                            <li>
                                <a href="/admin/datamaster/lab"><i class="fa fa-home"></i> Laboratorium</a>
                            </li>
                            <li>
                                <a href="/admin/datamaster/lab/praktikum/{{$labs->lab_id}}">{{$labs->lab_nama}}</a>
                            </li>
                            <li class="active">
                                {{$praktikum->praktikum_nama}}
                            </li>
                        </ul>
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
                                    <a data-toggle="modal" href="#myModal">
                                        <button class="btn btn-primary">
                                            Tambah Modul <i class="fa fa-plus"></i>
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
                                    <th>No</th>
                                    <th>Nama Modul</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1 ?>
                                    @foreach($moduls as $modul)
                                        <tr class="">
                                            <td><?php echo $i?></td>
                                            <td>{{ $modul->modul_nama }}</td>
											<td>{{ link_to_action('AdminController@listSoalPraktikum', 'SOAL', array($labs->lab_id, $praktikum->praktikum_id, $modul->modul_id), ['class' => 'btn btn-success'])}}</td>
                                            
                                            <td>
                                                <button onclick="getEdit('{{$modul->modul_id}}','{{$modul->modul_nama}}');" type="button" data-toggle="modal" href="#myModal-2" class="btn btn-warning">Edit</button>
                                            </td>
                                            <td>
                                                {{ link_to_action('AdminController@deleteModul', 'Delete', array($modul->modul_id, $labs->lab_id, $praktikum->praktikum_id), ['class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure ?')"])}}
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <!-- Asisten Praktikum -->
                        <div class="adv-table editable-table ">
                            <div class="clearfix">
                                <div class="btn-group">
                                    <a data-toggle="modal" href="#myModal-3">
                                        <button class="btn btn-primary">
                                            Tambah Asisten <i class="fa fa-plus"></i>
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
                            <table class="table table-striped table-hover table-bordered" id="editable-asisten">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Asisten</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1 ?>
                                    @foreach($asistens as $asisten)
                                        <tr class="">
                                            <td><?php echo $i?></td>
                                            <td>{{ $asisten->asisten_nama }}</td>
                                            <td><button class="btn btn-success">Detail</button></td>
                                            <td>
                                                {{ link_to_action('AdminController@deleteAsistenPraktikum', 'Delete', array($asisten->asisten_nim, $labs->lab_id, $praktikum->praktikum_id), ['class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure ?')"])}}
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </section>
            </div>
        </div>
    <!-- page end-->
    <!-- Modal Tambah Modul -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Tambah Modul</h4>
                    </div>
                    <div class="modal-body">
                        {{Form::open(array('action' => 'AdminController@storeModul'))}}
                        {{Form::text('modul_nama', '', array('class' => 'form-control', 'placeholder' => 'Nama Modul' ))}}
                        <br>
                        {{ Form::hidden('praktikum_id', $praktikum->praktikum_id) }}
                        {{ Form::hidden('lab_id', $labs->lab_id) }}

                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                        {{Form::submit('Submit', array('class' => 'btn btn-primary')) }}
                        <!-- <button class="btn btn-primary" type="button">Save changes</button> -->
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
        <!-- END MODAL -->
        <!-- Modal Edit Modul -->
        <div class="modal fade" id="myModal-2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Edit Data Modul</h4>
                    </div>
                    <div class="modal-body">
                        {{Form::open(array('action' => 'AdminController@updateModul'))}}

                        {{Form::text('modul_nama', '', array('class'=>'form-control', 'id'=>'modul_nama'))}}<br>
                        {{ Form::hidden('modul_id', '', array('id'=>'modul_id')) }}
                        {{ Form::hidden('praktikum_id', $praktikum->praktikum_id) }}
                        {{ Form::hidden('lab_id', $labs->lab_id) }}
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                       {{Form::submit('Submit', array('class' => 'btn btn-primary')) }}
                        <!-- <button class="btn btn-primary" type="button">Save changes</button> -->
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
        <!-- END MODAL -->
        <!-- Modal Add Asprak -->
        <div class="modal fade" id="myModal-3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Tambah Asisten {{$praktikum->praktikum_nama}}</h4>
                    </div>
                    <div class="modal-body">
                       {{Form::open(array('action' => 'AdminController@storeAsistenPraktikum'))}}
                        {{Form::text('asistenPrak_nim', '', array('class' => 'form-control', 'placeholder' => 'NIM Asisten' ))}}
                        <br>
                        {{ Form::hidden('praktikum_id', $praktikum->praktikum_id) }}
                        {{ Form::hidden('lab_id', $labs->lab_id) }}
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                       {{Form::submit('Submit', array('class' => 'btn btn-primary')) }}
                        <!-- <button class="btn btn-primary" type="button">Save changes</button> -->
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
        <!-- END MODAL -->
    </section>
</section>
<!--main content end-->
@include('footer')
<!--script for this page only-->
{{ HTML::script('js/table-editable.js') }}
<!-- <script src="js/table-editable.js"></script> -->

<!-- END JAVASCRIPTS -->
<script>
    jQuery(document).ready(function() {
        EditableTable.init();
    });
</script>
<script>
function getEdit(a, b){
    document.getElementById("modul_id").value = a;
    document.getElementById("modul_nama").value = b;
}
</script>
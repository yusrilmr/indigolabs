@include('header')
@include('menu')
<!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        <ul class="breadcrumb">
                            <li>
                                <a href="/admin/datamaster/lab"><i class="fa fa-home"></i> Laboratorium</a>
                            </li>
                            <li class="active">
                                {{$labs->lab_nama}}
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
                                    <th>Praktikum</th>
                                    <th>Keterangan</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($praktikums as $praktikum)
                                        <tr class="">
                                            <td>{{ $praktikum->praktikum_nama }}</td>
                                            <td>{{ $praktikum->praktikum_keterangan }}</td>
                                            <td>{{ link_to_action('AdminController@detailPraktikum', 'Detail', array($labs->lab_id, $praktikum->praktikum_id), ['class' => 'btn btn-success'])}}</td>
                                            <td>
                                                <button onclick="getEdit('{{$praktikum->praktikum_id}}', '{{$praktikum->praktikum_nama}}','{{$praktikum->praktikum_keterangan}}', '{{$labs->lab_id}}');" type="button" data-toggle="modal" href="#myModal-2" class="btn btn-warning">Edit</button>
                                            </td>
                                            <td>{{ link_to_action('AdminController@deletePraktikum', 'Delete', array($praktikum->praktikum_id, $labs->lab_id), ['class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure ?')"])}}</td>
                                            <!-- <td><button type="button" class="btn btn-danger">Delete</button></td> -->
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Modal Tambah Praktikum -->
                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">Tambah Praktikum</h4>
                                            </div>
                                            <div class="modal-body">
                                                {{Form::open(array('action' => 'AdminController@storePraktikum'))}}
                                                {{Form::text('praktikum_nama', '', array('class' => 'form-control', 'placeholder' => 'Nama Praktikum' ))}}
                                                <br>
                                                {{Form::textarea('praktikum_keterangan', '', array('class' => 'form-control', 'placeholder' => 'Keterangan' ))}}
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
                                <!-- Modal Edit Praktikum -->
                                <div class="modal fade" id="myModal-2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">Edit Data Praktikum</h4>
                                            </div>
                                            <div class="modal-body">
                                               {{Form::open(array('action' => 'AdminController@updatePraktikum'))}}

                                                <label>Praktikum</label>
                                                {{Form::text('praktikum_nama', '', array('class'=>'form-control', 'id'=>'praktikum_nama'))}}<br>
                                                {{Form::text('praktikum_keterangan', '', array('class'=>'form-control', 'id'=>'praktikum_keterangan'))}}<br>
                                                {{ Form::hidden('praktikum_id', '', array('id'=>'praktikum_id')) }}
                                                {{ Form::hidden('lab_id', '', array('id'=>'lab_id')) }}
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
{{ HTML::script('js/table-editable.js') }}
<!-- <script src="js/table-editable.js"></script> -->

<!-- END JAVASCRIPTS -->
<script>
    jQuery(document).ready(function() {
        EditableTable.init();
    });
</script>
<script>
function getEdit(praktikum_id, praktikum_nama, praktikum_keterangan, lab_id){
    document.getElementById("praktikum_id").value = praktikum_id;
    document.getElementById("praktikum_nama").value = praktikum_nama;
    document.getElementById("praktikum_keterangan").value = praktikum_keterangan;
    document.getElementById("lab_id").value = lab_id;
}
</script>
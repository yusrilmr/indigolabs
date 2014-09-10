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
                                Asisten {{$labs->lab_nama}}
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
                            <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                <thead>
                                <tr>
                                    <th>NIM</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Telp</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($asistens as $asisten)
                                        <tr class="">
                                            <td>{{ $asisten->asisten_nim }}</td>
                                            <td>{{ $asisten->asisten_kode }}</td>
                                            <td>{{ $asisten->asisten_nama }}</td>
                                            <td>{{ $asisten->asisten_telp }}</td>
                                            <td>
                                                <button onclick="getEdit('{{$labs->lab_id}}', '{{$asisten->asisten_nim}}','{{$asisten->asisten_kode}}', '{{$asisten->asisten_nama}}', '{{$asisten->asisten_telp}}');" type="button" data-toggle="modal" href="#myModal-2" class="btn btn-warning">Edit</button>
                                            </td>
                                            <td>{{ link_to_action('AdminController@deleteAsisten', 'Delete', array($asisten->asisten_nim, $labs->lab_id), ['class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure ?')"])}}</td>
                                            <!-- <td><button type="button" class="btn btn-danger">Delete</button></td> -->
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Modal Tambah Asisten -->
                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">Tambah Lab</h4>
                                            </div>
                                            <div class="modal-body">
                                                {{Form::open(array('action' => 'AdminController@storeAsisten'))}}
                                                {{Form::text('asisten_nim', '', array('class' => 'form-control', 'placeholder' => 'NIM' ))}}
                                                <br>
                                                {{Form::text('asisten_kode', '', array('class' => 'form-control', 'placeholder' => 'Kode Asisten' ))}}
                                                <br>
                                                {{Form::text('asisten_nama', '', array('class' => 'form-control', 'placeholder' => 'Nama' ))}}
                                                <br>
                                                {{Form::text('asisten_email', '', array('class' => 'form-control', 'placeholder' => 'Email' ))}}
                                                <br>

                                                {{Form::text('asisten_telp', '', array('class' => 'form-control', 'placeholder' => 'Telepon' ))}}
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
                            <!-- Modal Edit Asisten -->
                                <div class="modal fade" id="myModal-2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">Edit Data Lab</h4>
                                            </div>
                                            <div class="modal-body">
                                                {{Form::open(array('action' => 'AdminController@updateAsisten'))}}

                                                <label>NIM</label>
                                                {{Form::text('asisten_nim', '', array('class'=>'form-control', 'id'=>'asisten_nim'))}}<br>
                                                <label>Kode Asisten</label>
                                                {{Form::text('asisten_kode', '', array('class'=>'form-control', 'id'=>'asisten_kode'))}}<br>
                                                <label>Nama</label>
                                                {{Form::text('asisten_nama', '', array('class'=>'form-control', 'id'=>'asisten_nama'))}}<br>
                                                <label>Telepon</label>
                                                {{Form::text('asisten_telp', '', array('class'=>'form-control', 'id'=>'asisten_telp'))}}<br>
                                                {{ Form::hidden('lab_id', '', array('id'=>'lab_id')) }}
                                                {{ Form::hidden('asisten_nim_old', '', array('id'=>'asisten_nim_old')) }}

                                            </div>
                                            <div class="modal-footer">
                                                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                               <!--  <button class="btn btn-primary" type="button">Save changes</button> -->
                                                {{Form::submit('Submit', array('class' => 'btn btn-primary')) }}
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
function getEdit(lab_id, asisten_nim, asisten_kode, asisten_nama, asisten_telp){
    document.getElementById("lab_id").value = lab_id;
    document.getElementById("asisten_nim").value = asisten_nim;
    document.getElementById("asisten_kode").value = asisten_kode;
    document.getElementById("asisten_nama").value = asisten_nama;
    document.getElementById("asisten_telp").value = asisten_telp;
    document.getElementById("asisten_nim_old").value = asisten_nim;
}
</script>
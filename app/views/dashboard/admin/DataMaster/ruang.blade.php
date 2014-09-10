@include('header')
@include('dashboard/admin/menu_admin')
<!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->
            <div class="row">
                <div class="col-md-12">
                    <!--breadcrumbs start -->
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="fa fa-home"></i> Dashboard</a></li>
                        <li><a href="#">Sistem Praktikum</a></li>
                        <li class="active">Ruang</li>
                    </ul>
                    <!--breadcrumbs end -->
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                        <div class="panel-body">
                            <div class="adv-table editable-table ">
                                <div class="clearfix">
                                    <div class="btn-group">
                                        <a data-toggle="modal" href="#myModal">
                                            <button class="btn btn-primary">
                                                Tambah Ruangan <i class="fa fa-plus"></i>
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
                                        <th>Nama Ruangan</th>
                                        <th>Quota</th>
                                        <th>Keterangan</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($ruangs as $ruang)
                                            <tr class="">
                                                <td>{{ $ruang->ruang_nama }}</td>
                                                <td>{{ $ruang->ruang_quota }}</td>
                                                <td>{{ $ruang->ruang_keterangan }}</td>
                                                <td>
                                                    <button onclick="getEdit('{{$ruang->ruang_id}}', '{{$ruang->ruang_nama}}','{{$ruang->ruang_quota}}', '{{$ruang->ruang_keterangan}}');" type="button" data-toggle="modal" href="#myModal-2" class="btn btn-warning">Edit</button>
                                                </td>
                                                <td>{{ link_to_action('AdminController@deleteRuang', 'Delete', array($ruang->ruang_id), ['class' => 'btn btn-danger', 'onclick' => 'return confirm(\'Are you sure you want to delete this item?\');' ])}}</td>
                                               <!--  <td><button type="button" class="btn btn-danger">Delete</button></td> -->
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Modal Tambah Ruangan -->
                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title">Tambah Lab</h4>
                                                </div>
                                                <div class="modal-body">
                                                    {{Form::open(array('action' => 'AdminController@storeRuang'))}}
                                                    {{Form::text('ruang_nama', '', array('class' => 'form-control', 'placeholder' => 'Nama/Nomor Ruang', 'Required' => '' ))}}
                                                    <br>
                                                    {{Form::text('ruang_quota', '', array('class' => 'form-control', 'placeholder' => 'Quota', 'Required' => '' ))}}
                                                    <br>
                                                    {{Form::textarea('ruang_keterangan', '', array('class' => 'form-control', 'placeholder' => 'Keterangan', 'Required' => '' ))}}

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
                                <!-- Modal Edit Ruangan -->
                                    <div class="modal fade" id="myModal-2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title">Edit Data Lab</h4>
                                                </div>
                                                <div class="modal-body">
                                                    {{Form::open(array('action' => 'AdminController@updateRuang'))}}

                                                    <label>Nama Ruang</label>
                                                    {{Form::text('ruang_nama', '', array('class'=>'form-control', 'id'=>'ruang_nama'))}}<br>
                                                    <label>Quota</label>
                                                    {{Form::text('ruang_quota', '', array('class'=>'form-control', 'id'=>'ruang_quota'))}}<br>
                                                    <label>Keterangan</label>
                                                    {{Form::text('ruang_keterangan', '', array('class'=>'form-control', 'id'=>'ruang_keterangan'))}}<br>
                                                    {{ Form::hidden('ruang_id', '', array('id'=>'ruang_id')) }}
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
<script src="js/table-editable.js"></script>
{{ HTML::script('js/table-editable.js') }}
{{ HTML::script('js/iCheck/jquery.icheck.js') }}
{{ HTML::script('js/icheck-init.js') }}

<!-- END JAVASCRIPTS -->
<script>
    jQuery(document).ready(function() {
        EditableTable.init();
    });
</script>

<script>
function getEdit(ruang_id, ruang_nama, ruang_quota, ruang_keterangan){
    document.getElementById("ruang_id").value = ruang_id;
    document.getElementById("ruang_nama").value = ruang_nama;
    document.getElementById("ruang_quota").value = ruang_quota;
    document.getElementById("ruang_keterangan").value = ruang_keterangan;
}
</script>
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
                            <li class="active">
                                <a href="#"><i class="fa fa-home"></i> Laboratorium</a>
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
                                            Tambah Lab <i class="fa fa-plus"></i>
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
                                    <th>Nama Lab</th>
                                    <th>Keterangan</th>
                                    <th>Ruang</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($labs as $lab)
                                        <tr class="">
                                            <td>{{ $lab->lab_nama }}</td>
                                            <td>{{ $lab->lab_keterangan }}</td>
                                            <td>{{ $lab->lab_ruang }}</td>
                                            <td>{{ link_to_action('AdminController@praktikum', 'Praktikum', array($lab->lab_id), ['class' => 'btn btn-success'])}}
                                            </td>
                                            <td>{{ link_to_action('AdminController@asisten', 'Asisten', array($lab->lab_id), ['class' => 'btn btn-info'])}}
                                            </td>
                                            <td>
                                                <button onclick="getEdit('{{$lab->lab_id}}', '{{$lab->lab_nama}}','{{$lab->lab_keterangan}}', '{{$lab->lab_ruang}}');" type="button" data-toggle="modal" href="#myModal-2" class="btn btn-warning">Edit</button>
                                            </td>
                                            <td>{{ link_to_action('AdminController@deleteLab', 'Delete', array($lab->lab_id, ), ['class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure ?')"])}}</td>
                                           <!--  <td><button type="button" class="btn btn-danger">Delete</button></td> -->
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Modal Tambah Lab -->
                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">Tambah Lab</h4>
                                            </div>
                                            <div class="modal-body">
                                                {{Form::open(array('action' => 'AdminController@store'))}}
                                                {{Form::text('lab_nama', '', array('class' => 'form-control', 'placeholder' => 'Nama Lab' ))}}
                                                <br>
                                                {{Form::textarea('lab_keterangan', '', array('class' => 'form-control', 'placeholder' => 'Keterangan' ))}}
                                                <br>
                                                {{Form::text('lab_ruang', '', array('class' => 'form-control', 'placeholder' => 'Ruang' ))}}

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
                            <!-- Modal Edit Lab -->
                                <div class="modal fade" id="myModal-2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">Edit Data Lab</h4>
                                            </div>
                                            <div class="modal-body">
                                                {{Form::open(array('action' => 'AdminController@updateLab'))}}

                                                <label>Nama Lab</label>
                                                {{Form::text('lab_nama', '', array('class'=>'form-control', 'id'=>'lab_nama'))}}<br>
                                                <label>Keterangan</label>
                                                {{Form::text('lab_keterangan', '', array('class'=>'form-control', 'id'=>'lab_keterangan'))}}<br>
                                                <label>Ruang</label>
                                                {{Form::text('lab_ruang', '', array('class'=>'form-control', 'id'=>'lab_ruang'))}}<br>
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
<script src="/js/table-editable.js"></script>

<!-- END JAVASCRIPTS -->
<script>
    jQuery(document).ready(function() {
        EditableTable.init();
    });
</script>
<script>
function getEdit(lab_id, lab_nama, lab_keterangan, lab_ruang){
    document.getElementById("lab_id").value = lab_id;
    document.getElementById("lab_nama").value = lab_nama;
    document.getElementById("lab_keterangan").value = lab_keterangan;
    document.getElementById("lab_ruang").value = lab_ruang;
}
</script>
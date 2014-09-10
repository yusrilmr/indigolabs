@include('header')
{{ HTML::style('js/bootstrap-fileupload/bootstrap-fileupload.css') }}
{{ HTML::style('js/iCheck/skins/minimal/green.css') }}
{{ HTML::style('js/iCheck/skins/square/green.css') }}
{{ HTML::style('js/iCheck/skins/flat/green.css') }}
@include('dashboard/admin/menu_admin')
<!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->

        <div class="row">
                <div class="col-md-12">
                    <!--breadcrumbs start -->
                    <ul class="breadcrumb">
                        <li><a href="/"><i class="fa fa-home"></i> Dashboard </a></li>
                        <li><a href="/"> Data Master </a></li>
                        <li><a href="/"> Dosen </a></li>
                        <li class="active">Manage Dosen</li>
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
                                            Tambah Dosen <i class="fa fa-plus"></i>
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
                            {{ HTML::ul($errors->all()) }} 
                                <thead>
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama Dosen</th>
                                    <th>Email </th>
                                    <th>Kontak</th>
                                    <th>Username</th>
                                     <th>Status</th>
                                    <th>Edit</th>
                                    <th>Change</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($dosens as $dosen) 
                                        <tr class="">
                                            <td>{{ $dosen->dosen_nip  }}</td>
                                            <td>{{ $dosen->dosen_nama  }}</td>
                                            <td>{{ $dosen->dosen_email  }}</td>
                                            <td>{{ $dosen->dosen_telp  }}</td>
                                            <td>{{ $dosen->user_name  }}</td>
                                            <td>
                                            <?php 
                                                if($dosen->dosen_status==1){
                                                    echo "Active";
                                                }else{
                                                    echo "Non-Active";
                                                }
                                            ?>
                                            
                                            </td>
                                            <td>
                                                <button onclick="getEdit('{{$dosen->dosen_nip}}', '{{$dosen->dosen_nama}}','{{$dosen->dosen_email}}', '{{$dosen->dosen_telp}}', '{{$dosen->user_name}}');" type="button" data-toggle="modal" href="#myModal-2" class="btn btn-warning">Edit</button>
                                            </td>
                                            <td>
                                            {{ link_to_action('AdminController@hapusDosen', 'Deactive', array($dosen->user_id), ['class' => 'btn btn-danger'])}}
                                            {{ link_to_action('AdminController@activeDosen', 'Active', array($dosen->user_id), ['class' => 'btn btn-primary'])}}
                                            
                                            </td>
                                           <!--  <td><button type="button" class="btn btn-danger">Delete</button></td> -->
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Modal Tambah Dosen -->
                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">Tambah Dosen</h4>
                                            </div>
                                            <div class="modal-body">
                                                {{Form::open(array('url'=>'admin/datamasterdosen/insert','files'=>true))}}
                                                {{Form::text('dosen_nip', '', array('class' => 'form-control', 'placeholder' => 'NIP Dosen' ))}}
                                                <br>
                                                {{Form::text('dosen_nama', '', array('class' => 'form-control', 'placeholder' => 'Nama Dosen' ))}}
                                                <br>
                                                {{Form::text('dosen_email', '', array('class' => 'form-control', 'placeholder' => 'Email Dosen' ))}}
                                                <br>
                                                {{Form::text('dosen_telp', '', array('class' => 'form-control', 'placeholder' => 'Kontak Dosen' ))}}
                                                <br>
                                                {{Form::text('user_name', '', array('class' => 'form-control', 'placeholder' => 'Username Dosen' ))}}
                                                <br>
                                                {{Form::password('password',array('class' => 'form-control','placeholder' => 'Password'))}}
                                                <br>
                                                {{Form::password('confirm_password',array('class' => 'form-control','placeholder' => 'Re-Type Password'))}}
                                                <br>

                                               <!-- <label>Pilih Praktikum :</label>
                                                <div class="form-group  ">
                                                    @foreach ($praktikum as $praktikum)
                                                    <div class="bucket-form">
                                                        <div class="icheck ">
                                                            <div class="flat-green single-row">
                                                                <div class="radio ">
                                                                    {{Form::checkbox('praktikum_dosen[]', $praktikum->praktikum_id,true)}}
                                                                    <label>{{$praktikum->praktikum_nama}}</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                
                                                    
                                                    
                                                </div>-->


                                                <div class="form-group last ">
                                                    <div class="fileupload fileupload-new  " data-provides="fileupload">
                                                        <div class="fileupload-preview fileupload-exists thumbnail center-block" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                            <div>
                                                                <span class="btn btn-white btn-file">
                                                                <span class="fileupload-new "><i class="fa fa-paper-clip"></i> Select image</span>
                                                                <span class="fileupload-exists "><i class="fa fa-undo"></i> Change</span>
                                                                    {{Form::file('file', array('class' => 'default'))}}
                                                                   <!-- <input type="file" class="default" />-->
                                                                </span>
                                                                <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                                            </div>
                                                    </div>
                                                             <span class="label label-danger ">NOTE!</span><br><br>
                                                              <span class="text-center">Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only
                                                              </span>

                                                </div><br><br>
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




                                <!-- Tambah Dosen End -->
                                <!-- Edit Dosen-->
                                <div class="modal fade" id="myModal-2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">Edit Dosen</h4>
                                                
                                            </div>
                                            <div class="modal-body">
                                                {{Form::open(array('url'=>'admin/datamasterdosen/update','files'=>true))}}
                                                {{Form::hidden('old_username','', array('class' => 'form-control', 'id' => 'old_username'))}}
                                                {{Form::text('dosen_nip','', array('class' => 'form-control', 'placeholder', 'id'=>'dosen_nip' ))}}
                                                <br>
                                                {{Form::text('dosen_nama', '', array('class' => 'form-control', 'placeholder' => 'Nama Dosen', 'id'=>'dosen_nama' ))}}
                                                <br>
                                                {{Form::text('dosen_email', '', array('class' => 'form-control', 'placeholder' => 'Email Dosen', 'id'=>'dosen_email' ))}}
                                                <br>
                                                {{Form::text('dosen_telp', '', array('class' => 'form-control', 'placeholder' => 'Kontak Dosen', 'id'=>'dosen_telp' ))}}
                                                <br>
                                                {{Form::text('user_name', '', array('class' => 'form-control', 'placeholder' => 'Username Dosen' , 'id'=>'user_name'))}}
                                                <br>
                                                {{Form::password('password',array('class' => 'form-control','placeholder' => 'New Password', 'id'=>'password'))}}
                                                <br>
                                                {{Form::password('confirm_password',array('class' => 'form-control','placeholder' => 'Re-Type Password'))}}
                                                <br>
                                                {{ Form::hidden('user_id', '', array('id'=>'user_id')) }}
                                                {{ Form::hidden('dosen_nip_old', '', array('id'=>'dosen_nip_old')) }}
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

                                <!-- Edit Dosen End -->
                            




                        </div>

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
{{ HTML::script('js/bootstrap-fileupload/bootstrap-fileupload.js') }}
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
function getEdit(dosen_nip,dosen_nama,dosen_email,dosen_telp,user_name,password){
    document.getElementById("old_username").value = user_name;
    document.getElementById("dosen_nip").value = dosen_nip;
    document.getElementById("dosen_nama").value = dosen_nama;
    document.getElementById("dosen_email").value = dosen_email;
    document.getElementById("dosen_telp").value = dosen_telp;
    document.getElementById("user_name").value = user_name;
    document.getElementById("password").value = password;
}

</script>
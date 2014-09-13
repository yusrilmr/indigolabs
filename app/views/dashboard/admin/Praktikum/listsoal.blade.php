@include('header')
@include('dashboard/admin/menu_admin')

<!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- List Modul-->        
        <div class="row">
		
            <div class="col-sm-12">
			<ul class="breadcrumb">
                            <li>
								<i class="fa fa-home"></i>
                                <a href="/lab">Laboratorium</a>
                            </li>
                            <li>
                                <a href="/lab/praktikum/{{$labs->lab_id}}">{{$labs->lab_nama}}</a>
                            </li>
                            <li>
                                <a href="/lab/{{$labs->lab_id}}/praktikum/{{$praktikum->praktikum_id}}/detail">{{$praktikum->praktikum_nama}}</a>
                            </li>
							<li>
                                <a class="active" href="">{{$moduls->modul_nama}}</a>
                            </li>
                        </ul>
			</div>
			
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">    
						List Kelompok Soal
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
                                    <a data-toggle="modal" href="#myModal" onclick="getAdd('{{$labs->lab_id}}','{{$praktikum->praktikum_id}}','{{$moduls->modul_id}}');">
                                        <button class="btn btn-primary">
                                            Tambah Kelompok Soal <i class="fa fa-plus"></i>
                                        </button>
                                    </a>
                                    
                                </div>
                                <div class="btn-group pull-right" data-toggle="modal" href="#modalPlay">
                                    
                                </div>
                            </div>
                            <div class="space15"></div>
                            <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Soal</th>
                                    <th>Keterangan</th>
                                    <th>Durasi (menit)</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1 ?>
								@foreach($quizs as $quiz)
                                        <tr class="">
                                            <td><?php echo $i?></td>
                                            <td>{{ $quiz->quiz_nama }}</td>
                                            <td>{{ $quiz->quiz_keterangan }}</td>
                                            <td>{{ $quiz->quiz_durasi }}</td>
                                            <td>{{ link_to_action('AdminController@listDetailSoalPraktikum', 'Detail Soal', array($labs->lab_id, $praktikum->praktikum_id, $moduls->modul_id, $quiz->quiz_id), ['class' => 'btn btn-success'])}}</td>
                                            <td>
                                                <button onclick="getEdit();" type="button" data-toggle="modal" href="#myModal-2" class="btn btn-warning">Edit</button>
                                            </td>
                                            <td>
                                                {{ link_to_action('AdminController@deleteQuiz', 'Delete', array($labs->lab_id, $praktikum->praktikum_id, $moduls->modul_id, $quiz->quiz_id ), ['class' => 'btn btn-danger'])}}
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
                        {{Form::open(array('action' => 'AdminController@storeQuiz'))}}
                        
						{{ Form::hidden('praktikum_id', '', array('id'=>'praktikum_id')) }}
                        {{ Form::hidden('lab_id', '', array('id'=>'lab_id')) }}
                        {{ Form::hidden('modul_id', '', array('id'=>'modul_id')) }}
						
						
                        {{Form::text('quiz_nama', '', array('class' => 'form-control', 'placeholder' => 'Nama Soal' , 'required' ))}}<br/>
                        
						{{Form::text('quiz_keterangan', '', array('class' => 'form-control', 'placeholder' => 'Keterangan', 'required' ))}} <br/>
						Durasi (menit) : <input type="number" name="quiz_durasi" step="5" min="0" max="999999999999999999" value="0" class="form-control" placeholder="durasi (menit)"  /> <br/>
						{{Form::textarea('quiz_intro', '', array('class' => 'form-control', 'placeholder' => 'Introduction', 'required' ))}}<br/>
						Urutan : {{Form::text('quiz_urutan', '1', array('class' => 'form-control', 'placeholder' => 'Urutan' , 'required' ))}}<br/>
						Bobot (%) : <input type="number" name="quiz_bobot" step="5" min="0" max="120" value="0" class="form-control" placeholder="bobot"  /> <br/>
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
        <!-- Modal Edit Lab -->
        <div class="modal fade" id="myModal-2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Edit Data Lab</h4>
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
        <!-- Modal List Asisten Praktikum -->
        <div class="modal fade" id="myModal-3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">List Asisten Praktikum {{$praktikum->praktikum_nama}}</h4>
                    </div>
                    <div class="modal-body">
                       List asisten praktikum...
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
		
		
		<div class="modal fade" id="modalPlay" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Aktifkan Praktikum {{$praktikum->praktikum_nama}} | {{$moduls->modul_nama}} </h4>
                    </div>
                    <div class="modal-body">
						{{Form::open(array('action' => 'AdminController@storeQuiz'))}}
                        
						{{ Form::hidden('praktikum_id', '', array('id'=>'praktikum_id')) }}
                        {{ Form::hidden('lab_id', '', array('id'=>'lab_id')) }}
                        {{ Form::hidden('modul_id', '', array('id'=>'modul_id')) }}
												
						Durasi (menit) : <input type="number" name="quiz_durasi" step="5" min="0" max="120" value="0" class="form-control" placeholder="durasi (menit)"  /> <br/>
						

						
                        
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
function getAdd(lab_id, praktikum_id, modul_id){
    document.getElementById("praktikum_id").value = praktikum_id;       
    document.getElementById("lab_id").value = lab_id;
    document.getElementById("modul_id").value = modul_id;
}
function getEdit(praktikum_id, praktikum_nama, praktikum_keterangan, lab_id){
    document.getElementById("praktikum_id").value = praktikum_id;
    document.getElementById("praktikum_nama").value = praktikum_nama;
    document.getElementById("praktikum_keterangan").value = praktikum_keterangan;
    document.getElementById("lab_id").value = lab_id;
}
</script>
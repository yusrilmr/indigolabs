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
                                <a href="/lab/{{$labs->lab_id}}/praktikum/{{$praktikum->praktikum_id}}/modul/{{$moduls->modul_id}}/listsoal">{{$moduls->modul_nama}}</a>
                            </li>
							<li>
                                <a class="active" href="">{{$quizs->quiz_nama}}</a>
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
                                    <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Tambah Soal <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a data-toggle="modal" href="#modalPilgan" href="#">Pilihan ganda</a></li>
                                        <li><a data-toggle="modal" href="#modalEssay" href="#">Essay</a></li>
                                        <li><a data-toggle="modal" href="#modalUpload" href="#">Upload File</a></li>
                                    </ul>
                                    
                                </div>
                                
                            </div>
                            <div class="space15"></div>
                            <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Soal</th>
                                    <th>Point</th>
                                    <th>Tipe</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                
								<?php $i=1 ?>
								@foreach($soals as $key => $soal)
                                        <tr class="">
                                            <td><?php echo $i?></td>
                                            <td><?php echo substr($soal->soal_text,0,160) ?>
											<input type="hidden" id="soalnya" value="{{$soal->soal_text}}" name="soal_text">
											</td>
                                            <td>{{ $soal->soal_point }}</td>
                                            <td>
											
											<?php
												if($soal->soal_type == 1){
													echo "Pilihan Ganda";
												}else if($soal->soal_type == 2){
													echo "Essay";
												}else if($soal->soal_type == 3){
													echo "Upload File";
												}
											?></td>
                                            <td></td>
                                            <td>
												<input type="hidden" id=lihatSoal[{{$key}}] value='{{$soal->soal_text}}' />
                                                <button onclick="getEdit({{$key}});" type="button" data-toggle="modal" href="#modalView" class="btn btn-success">Lihat Soal</button>
                                            </td>
											<td>
                                                <button onclick="getEdit();" type="button" data-toggle="modal" href="#myModal-2" class="btn btn-warning">Delete</button>
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
        <div class="modal fade" id="modalPilgan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Tambah Soal Pilihan Ganda</h4>
                    </div>
                    <div class="modal-body">
						
                        {{Form::open(array('action' => 'AdminController@storeSoal'))}}
						<label>Soal : </label>
						
						<a href="/upload" target="_blank">Upload Berkas</a>
                        {{Form::textarea('soal_text', '', array('class' => 'form-control ckeditor', 'placeholder' => 'Detail Persoalan',  'rows'=>'6' ))}} <br/>
						<label>Bobot Soal : </label>							
							<input type="number" name="soal_point" step="5" min="0" max="100" value="0" class="form-control"  />
							
						<label>Pilihan Jawaban : </label>
						<div class="input-group m-bot15">
							<span class="input-group-addon">
								{{Form::radio('kunci', 'A', array('class' => 'form-control'))}}
							</span>
							{{Form::text('pilihanA', '', array('class' => 'form-control', 'placeholder' => 'Pilihan Jawaban A' , 'required' ))}}
						</div>
						<div class="input-group m-bot15">
							<span class="input-group-addon">
								{{Form::radio('kunci', 'B', array('class' => 'form-control'))}}
							</span>
							{{Form::text('pilihanB', '', array('class' => 'form-control', 'placeholder' => 'Pilihan Jawaban B' , 'required' ))}}
						</div>
						<div class="input-group m-bot15">
							<span class="input-group-addon">
								{{Form::radio('kunci', 'C', array('class' => 'form-control'))}}
							</span>
							{{Form::text('pilihanC', '', array('class' => 'form-control', 'placeholder' => 'Pilihan Jawaban C' , 'required' ))}}
						</div>
						<div class="input-group m-bot15">
							<span class="input-group-addon">
								{{Form::radio('kunci', 'D', array('class' => 'form-control'))}}
							</span>
							{{Form::text('pilihanD', '', array('class' => 'form-control', 'placeholder' => 'Pilihan Jawaban D' , 'required' ))}}
						</div>
						<div class="input-group m-bot15">
							<span class="input-group-addon">
								{{Form::radio('kunci', 'E', array('class' => 'form-control'))}}
							</span>
							{{Form::text('pilihanE', '', array('class' => 'form-control', 'placeholder' => 'Pilihan Jawaba E' , 'required' ))}}
						</div>
						
						
                        <br>
												
						{{ Form::hidden('soal_type', 1) }}
						{{ Form::hidden('lab_id', $labs->lab_id) }}
                        {{ Form::hidden('praktikum_id', $praktikum->praktikum_id) }}
                        {{ Form::hidden('modul_id', $moduls->modul_id) }}
						{{ Form::hidden('quiz_id', $quizs->quiz_id) }}
                        
                        

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
        <div class="modal fade" id="modalEssay" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Tambah Soal Essay</h4>
                    </div>
                    <div class="modal-body">
                       {{Form::open(array('action' => 'AdminController@storeSoal'))}}
						<label>Soal :</label>
						<a href="/upload" target="_blank">Upload Berkas</a>
                        {{Form::textarea('soal_text', '', array('class' => 'form-control ckeditor', 'placeholder' => 'Detail Persoalan', 'rows'=>'6' ))}} <br/>
						<label>Bobot Soal : </label>							
							<input type="number" name="soal_point" step="5" min="0" max="100" value="0" class="form-control"  /><br/>
						<label>Kunci Jawaban : </label>
						{{Form::textarea('jawaban', '', array('class' => 'form-control ckeditor', 'placeholder' => 'Kunci Jawaban', 'rows'=>'6' ))}} <br/>
						{{ Form::hidden('soal_type', 2) }}
						{{ Form::hidden('lab_id', $labs->lab_id) }}
                        {{ Form::hidden('praktikum_id', $praktikum->praktikum_id) }}
                        {{ Form::hidden('modul_id', $moduls->modul_id) }}
						{{ Form::hidden('quiz_id', $quizs->quiz_id) }}
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
        <div class="modal fade" id="modalUpload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Tambah Soal Upload File</h4>
                    </div>
                    <div class="modal-body">
                       {{Form::open(array('action' => 'AdminController@storeSoal'))}}
						<label>Soal :</label>
						<a href="/upload" target="_blank">Upload Berkas</a>
                        {{Form::textarea('soal_text', '', array('class' => 'form-control ckeditor', 'placeholder' => 'Detail Persoalan',  'rows'=>'6' ))}} <br/>
						<label>Bobot Soal : </label>							
							<input type="number" name="soal_point" step="5" min="0" max="100" value="0" class="form-control"  /><br/>
						<label>Kunci Jawaban : </label>
						{{Form::textarea('jawaban', '', array('class' => 'form-control ckeditor', 'placeholder' => 'Kunci Jawaban', 'rows'=>'6' ))}} <br/>
						{{ Form::hidden('soal_type', 3) }}
						{{ Form::hidden('lab_id', $labs->lab_id) }}
                        {{ Form::hidden('praktikum_id', $praktikum->praktikum_id) }}
                        {{ Form::hidden('modul_id', $moduls->modul_id) }}
						{{ Form::hidden('quiz_id', $quizs->quiz_id) }}
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
		
		<div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">View Soal</h4>
                    </div>
                    <div class="modal-body">
                       
						<div id="view_soal"></div>
						
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                       
                        <!-- <button class="btn btn-primary" type="button">Save changes</button> -->
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
<!--main content end-->
@include('footer')
<!--script for this page only-->
{{ HTML::script('js/table-editable.js') }}
{{ HTML::script('js/ckeditor/ckeditor.js') }}
{{ HTML::script('js/bootstrap-inputmask/bootstrap-inputmask.min.js') }}


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
</script>
<script>
function getEdit(key){
	var mmo = $('#lihatSoal['+key+']).data;
    document.getElementById("view_soal").innerHTML = mmo;
	//document.getElementById("view_soal").innerHTML + soal;
}
</script>
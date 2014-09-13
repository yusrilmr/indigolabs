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
                                <a href="#">Praktikum</a>
                            </li>
                            
                        </ul>
			</div>
			
			
			
			
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">    
						Data Praktikum
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
                                    <button data-toggle="modal" href="#modalAdd" class="btn btn-primary dropdown-toggle" ><i class="fa fa-plus"></i> Aktivasi Praktikum 
                                    </button>
                                    
                                    
                                </div>
                                
                            </div>
                            <div class="space15"></div>
                            <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Modul</th>
                                    <th>Shif</th>
                                    <th>Mulai</th>
                                    <th>Selesai</th>
                                    <th>Durasi</th>
									<th>Status</th>
									
                                    <th></th>
                                    <th></th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                
								<?php $i=1 ?>
								@foreach($data as $d)
									<tr class="">
										<td><?php echo $i?></td>
										<td>{{ $d->modul_nama }}</td>
										<td>{{ $d->jadwal_nama }} | {{ $d->jadwal_hari}} {{ $d->jadwal_jam_mulai}}</td>																				
										<td>{{ $d->running_start }}</td>
										<td>{{ $d->running_end }}</td>
										<td>{{ $d->running_duration }}</td>
										<td><?php
										
										$dtNow = date("Y-m-d H:i:s",time());
										if($dtNow > $d->running_start and $dtNow < $d->running_end){
											echo "<span class=\"label label-success\">Sedang Berjalan</span>";
										}else{
											echo "<span class=\"label label-default\">Sudah Berakhir</span>";
										}
										?></td>
										
										<td>
										<?php
											if($dtNow > $d->running_start and $dtNow < $d->running_end){
												?>
												{{ link_to_action('AdminController@stopRunning', 'Hentikan',array($praktikum->praktikum_id, $d->running_id), ['class' => 'btn btn-danger btn-sm'])}}
												<?php
											}else{
												?>
												<a href="#" class="btn btn-danger btn-sm" disabled>Sudah Berakhir</a>												
												<?php
											}
										?>
										</td>
										<td>
											{{ link_to_action('AdminController@praktikumKoreksiList', 'Nilai',array($d->running_id), ['class' => 'btn btn-warning btn-sm'])}}
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
    
        
    </section>
</section>

		<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Aktivasi Praktikum {{$praktikum->praktikum_nama}}</h4>
                    </div>
                    <div class="modal-body">
						{{Form::open(array('action' => 'AdminController@storeRunning'))}}
						Pilih Modul :
						<select name="modul_id" class="form-control">
							@foreach($modul as $m)
								<option value="{{$m->modul_id}}">{{$m->modul_nama}}</option>							
							@endforeach
						</select>
						<br/>
						Pilih Shift :
						<select name="jadwal_id" class="form-control">
						<?php
							$hari = array('minggu','senin','selasa','rabu','kamis','jumat','sabtu');							
						?>
							@foreach($jadwal as $j)
								<option value="{{$j->jadwal_id}}">{{$j->jadwal_nama}} | {{$hari[$j->jadwal_hari]}} {{$j->jadwal_jam_mulai}}</option>
							@endforeach
						</select>
						<br/>
						Durasi (menit) : <input type="number" name="running_duration" step="5" min="0" max="99999999999999999999" value="0" class="form-control" placeholder="durasi (menit)"  /> <br/>
                        {{ Form::hidden('praktikum_id', $praktikum->praktikum_id) }}
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
function getEdit(praktikum_id, praktikum_nama, praktikum_keterangan, lab_id){
    document.getElementById("praktikum_id").value = praktikum_id;
    document.getElementById("praktikum_nama").value = praktikum_nama;
    document.getElementById("praktikum_keterangan").value = praktikum_keterangan;
    document.getElementById("lab_id").value = lab_id;
}
</script>
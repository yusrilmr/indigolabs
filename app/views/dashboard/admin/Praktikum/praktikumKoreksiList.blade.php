@include('header')
@include('menu')
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
						Data Pengambil Praktikum
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
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Nilai</th>
                                    
									
									
                                    <th></th>
                                    
                                    
                                </tr>
                                </thead>
                                <tbody>
                                
								<?php $i=1 ?>
								@foreach($dataList as $d)
									<tr class="">
										<td><?php echo $i?></td>
										<td>{{ $d->modul_nama }}</td>
										<td>{{ $d->praktikan_nim }} </td>																				
										<td>{{ $d->praktikan_nama }}</td>
										<td><?php
											$data = DB::table('view_dataListJawaban')->where('modul_id', $d->modul_id)->where('user_id', $d->user_id)->sum('jawaban_user_point');
											echo $data;
										?></td>
										
										
										<td>
											{{ link_to_action('AdminController@praktikumKoreksiDetail', 'Detail Nilai',array($d->modul_id, $d->user_id), ['class' => 'btn btn-warning btn-sm'])}}
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
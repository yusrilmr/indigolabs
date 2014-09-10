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
                                
                            </div>
                            <div class="space15"></div>
                            <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Laboratorium</th>
                                    <th>Praktikum</th>
                                    <th></th>                                    
                                </tr>
                                </thead>
                                <tbody>
                                
								<?php $i=1 ?>
								@foreach($praktikum as $p)
									<tr class="">
										<td><?php echo $i?></td>
										<td>{{ $p->lab_nama }}</td>
										<td>{{ $p->praktikum_nama }}</td>																				
										<td>{{ link_to_action('AdminController@praktikumPraDetail', 'Detail Soal',array($p->praktikum_id), ['class' => 'btn btn-success'])}}</td>
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
                        <h4 class="modal-title">Aktivasi Praktikum</h4>
                    </div>
                    <div class="modal-body">
						
                        
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
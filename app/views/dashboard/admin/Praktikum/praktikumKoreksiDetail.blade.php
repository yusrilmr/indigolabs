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
						Data Pengerjaan Praktikum
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
                                                                  
                                    
                                </div>
                                
                            </div>
                            <div class="space15"></div>
                            
                                <section class="panel">
									<header class="panel-heading tab-bg-dark-navy-blue ">
										<ul class="nav nav-tabs">
											
											@foreach($ambilQuiz as $am)
													<li>
														<a data-toggle="tab" href="#{{ $am->quiz_id }}">{{ $am->quiz_nama }}</a>
													</li>
											@endforeach
										</ul>
									</header>
									<div class="panel-body">
										<div class="tab-content">
											@foreach($ambilQuiz as $am)
											<div id="{{ $am->quiz_id }}" class="tab-pane">
												@foreach($dataList as $dl)
												
													<?php
														$xx = 0;
														if($dl->quiz_id == $am->quiz_id){
														$xx = 1;
													?>
														
														<div class="alert alert-warning ">
															<span class="alert-icon"><i class="fa">{{$xx}}</i></span>
															<div class="notification-info">
																<ul class="clearfix notification-meta">
																	<li class="pull-left notification-sender"><h4>{{ $dl->soal_text }}</h4></li>
																	<li class="pull-right notification-time"><?php
																	if($dl->soal_type==1){
																		echo "Pilihan Ganda";
																	}else if($dl->soal_type==2){
																		echo "Essay";
																	}else if($dl->soal_type==3){
																		echo "Upload File";
																	}
																	?></li>
																</ul>
																<p>
																<form action="/nilai/updateNilai" method="POST" id="formData2" class="form-horizontal ">
																	<input type="hidden" name="soal_id" value="{{$dl->soal_id}}">
																	<input type="hidden" name="user_id" value="{{$dl->user_id}}">
																	<input type="hidden" name="link" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>">
																	Jawaban :
																	<?php if($dl->soal_type==3){ ?>																		
																		<a href="{{asset('upload_jawabloch/'.$dl->jawaban_user_text )}}">Download Jawaban</a> 
																	<?php }
																	?>
																	
																	{{ $dl->jawaban_user_text }}<br/>
																	<label>Nilai : (max {{$dl->soal_point}} point)</label><input <?php if($dl->soal_type==1){ echo "readonly";} ?> type="text" name="point" style="width:10%" class="form-control" placeholder="nilai" value="{{$dl->jawaban_user_point}}">
																</form>
																</p>
															</div>
														</div>
													<?php
													$xx++;
														}
														
													?>																								
												@endforeach
												</div>
											@endforeach
											<div id="about" class="tab-pane">About</div>
											<div id="profile" class="tab-pane">Profile</div>
											<div id="contact" class="tab-pane">Contact</div>
										</div>
									</div>
								</section>
								
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
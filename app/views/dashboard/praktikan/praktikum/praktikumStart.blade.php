@include('header')
@include('dashboard/praktikan/menu_praktikan')
	<link rel="stylesheet" type="text/css" href="js/bootstrap-fileupload/bootstrap-fileupload.css" />
    <link rel="stylesheet" type="text/css" href="js/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
	<link href="js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
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
		</div>
		
		
		<div class="row">
		
            <div class="col-sm-12">
			<section class="panel">
				<span id="countdown"></span>
			</section>
			</div>
		</div>
		

		
		<?php	
			foreach($soal as $so){
			if($so->soal_id==$no){
				if($so->soal_type==1){
						
		?>
		
		<div class="row">
            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                        Soal Praktikum
                          <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                            <a class="fa fa-cog" href="javascript:;"></a>
                            <a class="fa fa-times" href="javascript:;"></a>
                         </span>
                    </header>
                    <div class="panel-body">
                        <form action="/praktikum/update1" method="POST" id="formData" class="form-horizontal ">
						<input type="hidden" name="soal_id" value="{{$so->soal_id}}">
						<input type="hidden" name="link" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>">
                            <div class="form-group">
                                <label class="col-md-12">{{$so->soal_text}}</label>
                                <div class="col-sm-9 icheck minimal">
											<?php
												
												$huruf=array('A','B','C','D','E');
												$x=0;
												
												foreach($jawaban as $j){
												
												if($j->soal_id==$so->soal_id){
													if($getJawaban->jawaban_id == $j->jawaban_id){
															?>
															
															<div class="checkbox single-row">
																<input name="jawab" id="form{{$x}}" type="radio" value="{{$j->jawaban_id}}-{{$huruf[$x]}}" checked>
																<label id="form{{$x}}">{{$j->jawaban_text}}</label>
															</div>
															
															<?php
													}else{
													
													?>
															<div class="checkbox single-row">
																<input name="jawab" id="form{{$x}}" type="radio" value="{{$j->jawaban_id}}-{{$huruf[$x]}}">
																<label id="form{{$x}}">{{$j->jawaban_text}}</label>
															</div>
													<?php
													}
											
												$x++;
												}
												}
											?>
                                            
                                        </div>
                            </div>                            
                        </form>
                    </div>
                </section>
            </div>
        </div>	
			
        <?php
		}else if($so->soal_type==3){
		?>
		
		<div class="row">
            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                        Soal Praktikum
                          <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                            <a class="fa fa-cog" href="javascript:;"></a>
                            <a class="fa fa-times" href="javascript:;"></a>
                         </span>
                    </header>
                    <div class="panel-body">
                        <form action="/praktikum/update3" files="true"  method="POST" id="formData" class="form-horizontal" enctype="multipart/form-data">
							<input type="hidden" name="soal_id" value="{{$so->soal_id}}">
							<input type="hidden" name="link" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>">
                            <div class="form-group">
                                <label class="col-md-12">{{$so->soal_text}}</label>
                                <div class="col-md-12">
									<?php
										if($getJawaban->jawaban_user_text!=null){
											echo "Jawaban Telah Tersimpan ";
										}
									?>
                                    <input type="file" name="berkas" class="default form-control" />
									<button type="submit" name="submit" class="btn btn-warning" >Simpan Jawaban</button>
                                </div>
                            </div>                            
                        </form>
                    </div>
                </section>
            </div>
        </div>
		
		<?php
		}else if($so->soal_type==2){
		?>
		
		<div class="row">
            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                        Soal Praktikum
                              <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                            <a class="fa fa-cog" href="javascript:;"></a>
                            <a class="fa fa-times" href="javascript:;"></a>
                         </span>
                    </header>
                    <div class="panel-body">
                        <form action="/praktikum/update2" method="POST" id="formData2" class="form-horizontal ">
                            <div class="form-group">
								<input type="hidden" name="soal_id" value="{{$so->soal_id}}">
                                <label class=" col-md-12">{{$so->soal_text}}</label>
                                <div class="col-md-12">
									<input type="hidden" name="soal_id" value="{{$so->soal_id}}">
									<input type="hidden" name="link" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>">
                                    <textarea name="jawaban" class="wysihtml5 form-control" rows="9"><?php echo $getJawaban->jawaban_user_text ?></textarea><br/>
									<button type="submit" name="submit" class="btn btn-warning" >Simpan Jawaban</button>
                                </div>
								
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
		<?php
		}
		
		}
		}
		?>
		
		<div class="btn-row">
			<div class="btn-toolbar">								
				<div class="btn-group">
				<?php
					$i=1;
					//shuffle($soal);
				?>
				<form method="POST">
					<input type="hidden" name=""
				</form>			
				<a href="/praktikum/start/{{$run}}/{{$quiz}}/0" class="btn btn-info" type="button">Pembukaan</a>
				@foreach($soal as $s)
				<?php
					if($s->soal_id==$no){
				?>
					<a href="/praktikum/start/{{$run}}/{{$quiz}}/{{$s->soal_id}}" class="btn btn-info active" type="button">{{$i;}}</a>                                    
				<?php 
					}else{ ?>
					<a href="/praktikum/start/{{$run}}/{{$quiz}}/{{$s->soal_id}}" class="btn btn-info" type="button">{{$i;}}</a>                                    
				<?php } 
				$i++; ?>
				@endforeach
					<a onclick="return confirm('anda yakin dengan semua jawaban anda ?');" href="/praktikum/start/{{$run}}/{{$quiz}}/0" class="btn btn-info" type="button">Selesai</a>
				</div>
				
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


{{ HTML::script('js/bootstrap-wysihtml5/wysihtml5-0.3.0.js') }}
{{ HTML::script('js/bootstrap-wysihtml5/bootstrap-wysihtml5.js') }}

<script type="text/javascript" src="js/bootstrap-fileupload/bootstrap-fileupload.js"></script>
<script src="js/iCheck/jquery.icheck.js"></script>

<!-- <script src="js/table-editable.js"></script> -->

<!-- END JAVASCRIPTS -->
<script>

    jQuery(document).ready(function() {
        EditableTable.init();
    });
	
	$('input[type=radio]').click(function() {
		$(this).closest("form").submit();
	});
	
	
	
	// set the date we're counting down to
//var target_date = new Date("2014-09-07 29:13:09").getTime();
var target_date = new Date("{{$getTimer->buka_quiz_end}}").getTime();
 
// variables for time units
var days, hours, minutes, seconds;
 
// get tag element
var countdown = document.getElementById("countdown");

var current_date2 = new Date().getTime();
var seconds_start = (target_date - current_date2) / 1000;
// update the tag with id "countdown" every 1 second
setInterval(function () {
 
    // find the amount of "seconds" between now and target
    var current_date = new Date().getTime();
    var seconds_left = (target_date - current_date) / 1000;
 
    // do some time calculations
    days = parseInt(seconds_left / 86400);
    seconds_left = seconds_left % 86400;
     
    hours = parseInt(seconds_left / 3600);
    seconds_left = seconds_left % 3600;
     
    minutes = parseInt(seconds_left / 60);
    seconds = parseInt(seconds_left % 60);
    if(seconds < 1 && minutes < 1 && hours < 1  ){
		alert ("Waktu Anda habis, semua data anda telah tersimpan, terimakasih !");
		//form submit sini yawid="formData"		
		$("#formData2").submit();
		console.log($('#formData2').html());
		window.location.href = "/praktikan";
	}else{
		// format countdown string + set tag value
		
		
		countdown.innerHTML = "<p class=\"text-muted\" ><h1 align=\"center\">"+days +" HARI "+ hours + " JAM "	+ minutes + " MENIT " + seconds + " DETIK "+" </h1></p><div class=\"progress progress-striped active progress-sm\"> <div  class=\"progress-bar progress-bar-warning\"  role=\"progressbar\" aria-valuenow=\""+seconds_left+"\" aria-valuemin=\"0\" aria-valuemax=\"{{$getTimer->buka_quiz_durasi}}\" style=\"width: "+seconds_left/{{$getTimer->buka_quiz_durasi}}+"%\"><span ></span></div></div>"
		
	}
    
	
	
 
}, 1000);

</script>

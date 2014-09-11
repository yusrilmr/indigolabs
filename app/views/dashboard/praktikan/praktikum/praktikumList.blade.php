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
                                <a href="/lab">Praktikum</a>
                            </li>                                                        
                        </ul>
			</div>
		@foreach($run as $r)
		<?php
			$user_name 		= Session::get('user_name');
			$user			= DB::table('tb_user')->where('user_name','=', $user_name)->select('user_id')->first();
			
		
			foreach($cek as $c){
			if($r->quiz_id == $c->quiz_id and $c->user_id == $user->user_id and $c->running_id == $r->running_id  ){
			$dtEnd = $c->kunci_quiz_end;
			$dtStart = $c->kunci_quiz_start;			
			
			$dtNow = date("Y-m-d H:i:s");
			$start = $c->kunci_quiz_status;
			$status = $c->kunci_quiz_status;
			
			if($dtNow < $dtEnd and ($status ==1 or $dtNow > $dtStart)){
		?>
		
			<div class="col-md-4">
			<div class="mini-stat clearfix">
				<a href="/praktikum/start/{{$r->running_id}}/{{$r->quiz_id}}/0" class="mini-stat-icon green"><i class="fa fa-play"></i></a>
				<div class="mini-stat-info">
					<span>{{$r->quiz_nama}}</span>
					Durasi : {{$r->quiz_durasi}} menit
				</div>
			</div>
		</div>
		<?php
			}else{
		?>
		<div class="col-md-4">
			<div class="mini-stat clearfix">
				<a href="#" class="mini-stat-icon green"><i class="fa fa-lock"></i></a>
				<div class="mini-stat-info">
					<span>{{$r->quiz_nama}}</span>
					Durasi : {{$r->quiz_durasi}} menit
				</div>
			</div>
		</div>
		<?php }
			}
				
		}?>
		
		@endforeach
		
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

@include('header')
@include('menu')
    <link href="js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
	<!--main content start-->
	<section id="main-content">
		<section class="wrapper">
		<!-- page start-->

        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li><a href="/"><i class="fa fa-home"></i>Home</a></li>
                    <li><a href="jadwal">List Jadwal</a></li>
                    <li class="active">Current page</li>
                </ul>
            </div>
        </div>

		<div class="row" >
			<div class="col-sm-12" >
                {{ HTML::ul($errors->all(), array('class' => 'alert alert-danger', 'style' => 'padding-left:40px')) }}  
                    @if(Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
                    @if(Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
				<section class="panel">
                    <header class="panel-heading">
                        List Mahasiswa
                    </header>
                    <div class="panel-body">
                    <div class="adv-table editable-table ">
                        <div class="col-md-12">
                            <section id="unseen">
                                <div class="table-responsive">
                                    <table  class="table table-striped table-hover table-bordered" id="editable-sample">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Nim</th>
                                            	<th>Nama Mahasiswa</th>
                                                <th width="15%">Status Kehadiran</th>
                                                <th>Keterangan</th>
                                                <th>Operasi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($listMahasiswa as $mahasiswa)
                                            	<tr>
                                                    <td>{{ $mahasiswa->praktikan_nim }}</td>
                                            		<td>{{ $mahasiswa->praktikan_nama }}</td>
                                                    <td align="center">
                                                        <?php
                                                            if($mahasiswa->status == 0){
                                                                echo 'Absen';
                                                            }else if($mahasiswa->status == 1){
                                                                echo 'Hadir';
                                                            }else{
                                                                echo 'Izin';
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>{{ $mahasiswa->keterangan }}</td>
                                                    <td><a href="#editStatus" onclick="edit('{{ $mahasiswa->praktikan_nim}}', '{{$mahasiswa->praktikan_nama}}', '{{$mahasiswa->keterangan}}');" data-toggle="modal">Edit Absen</a></td>
                                            	</tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </section>
                        </div>
                    </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
                    
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="editStatus" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title">Form Tittle</h4>
                </div>
                                    
                <div class="modal-body">
                    {{Form::open(array('url' => 'asisten/editAbsen?jadwal='.Input::get('jadwal').'&modul='.Input::get('modul'), 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form')) }}
                        {{ Form::hidden('nimValue', '', array('id'=>'nimValue'))}}
                        <div class="form-group">
                            {{ Form::label('Nim', '', array('class' => 'col-lg-3 control-label')) }}
                            <div class="col-lg-9">
                                {{ Form::text('nim','', array('class' => 'form-control', 'id' => 'nim', 'disabled')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('Nama', '', array('class'=>'col-lg-3 control-label')) }}
                            <div class="col-lg-9">
                                {{Form::text('nama', '', array('class' => 'form-control', 'id' => 'nama', 'disabled')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('Status Kehadiran', '', array('class'=>'col-lg-3 control-label')) }}
                            <div class="col-lg-9">
                                {{Form::select('status', array('0' => 'Absen', '1' =>'Hadir', '2'=>'Izin'),'',
                                                                    array('class' => 'form-control m-bot15'))}}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('Keterangan', '', array('class'=>'col-lg-3 control-label')) }}
                            <div class="col-lg-9">
                                {{Form::textarea('keterangan', '',
                                                                    array('class' => 'form-control', 'maxlength' => '255', 'id' => 'keterangan'))}}
                                {{Form::label('*Max 255 Character')}}
                            </div>
                        </div>                   
                        <div class="form-group">
                            <div class="col-lg-offset-3 col-lg-9">
                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>
                        </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
</section>

<!--main content end-->
@include('footer')
{{ HTML::script('js/bootstrap-fileupload/bootstrap-fileupload.js') }}
{{ HTML::script('js/table-editable.js') }}
{{ HTML::script('js/iCheck/jquery.icheck.js') }}
{{ HTML::script('js/icheck-init.js') }}

<script>
    jQuery(document).ready(function() {
        EditableTable.init();
    });
</script>
<script>
    function edit(nim, nama, keterangan){
        document.getElementById('nimValue').value = nim;
        document.getElementById('nim').value = nim;
        document.getElementById('nama').value = nama;
        document.getElementById('keterangan').value = keterangan;
    }
</script>
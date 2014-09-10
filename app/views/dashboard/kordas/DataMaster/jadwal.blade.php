@include('header')
@include('dashboard/kordas/menu_kordas')
    <!--main content start-->
    <section id="main-content" >
        <section class="wrapper">
            <div class="row">
                <div class="col-md-12">
                    <!--breadcrumbs start -->
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="fa fa-home"></i> Dashboard</a></li>
                        <li><a href="#">Sistem Praktikum</a></li>
                        <li class="active">Jadwal</li>
                    </ul>
                    <!--breadcrumbs end -->
                </div>
            </div>

            <div class="row">
            <div class="col-lg-12">
            <!--tab nav start-->
            <section class="panel">
                <header class="panel-heading tab-bg-dark-navy-blue ">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#input">Input Jadwal</a>
                        </li>
                        @foreach($ruangs as $ruang)
                        <li class="">
                            <a data-toggle="tab" href="#{{ $ruang->ruang_id }}">{{ $ruang->ruang_nama }}</a>
                        </li>
                        @endforeach
                    </ul>
                </header>
                <div class="panel-body">
                    <div class="tab-content">
                        <div id="input" class="tab-pane active">

                            <div class="position-center">
                                {{Form::open(array('action' => 'KordasController@storeJadwal'))}}
                                <div class="form-group">
                                <label for="InputLab">Pilih Laboratorium</label>
                                <select name="lab_nama" id="lab_nama" class="form-control m-bot15" required >
                                    <option value="">-</option>
                                    @foreach($labs as $lab)
                                    <option value="{{ $lab->lab_nama }}">{{ $lab->lab_nama }}</option>
                                    @endforeach
                                </select>
                                </div>
                                <div class="form-group">
                                <label for="InputLab">Pilih Praktikum</label>
                                <select name="praktikum_id" id="praktikum_id" class="form-control m-bot15" required >
                                    <option value="">-</option>
                                    @foreach($praktikums as $praktikum)
                                    <option value="{{ $praktikum->praktikum_id }}">{{ $praktikum->praktikum_nama }}</option>
                                    @endforeach
                                </select>
                                </div>
                                <div class="form-group">
                                <label for="InputLab">Pilih Ruangan</label>
                                <select name="ruang_id" id="ruang_id" class="form-control m-bot15" required >
                                    <option value="">-</option>
                                    @foreach($ruangs as $ruang)
                                    <option value="{{ $ruang->ruang_id }}">{{ $ruang->ruang_nama }}</option>
                                    @endforeach
                                </select>
                                </div>
                                <div class="form-group">
                                <label for="InputLab">Pilih Hari</label>
                                <select name="jadwal_hari" id="jadwal_hari" class="form-control m-bot15" required >
                                    <option value="">-</option>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                </select>
                                </div>
                                <label for="InputLab">Pilih Shift</label>
                                <div class="form-group">
                                    <div class="col-lg-2">
                                        <select name="shift" id="shift" class="form-control m-bot15" onchange="setTime()" >
                                            <option value="">-</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <input class="form-control" name="JamMulai" id="JamMulai" type="text" placeholder="Jam Mulai" disabled>
                                    </div>
                                    <div class="col-lg-4">
                                        <input class="form-control" name="JamSelesai" id="JamSelesai" type="text" placeholder="Jam Selesai" disabled>
                                    </div>
                                    <div class="col-lg-2">
                                        <button type="submit" class="btn btn-info">Submit</button>
                                    </div>
                                </div>

                                
                            {{ Form::close() }}
                            </div>
                            
                        </div>
                        @foreach($ruangs as $ruang)
                        <div id="{{ $ruang->ruang_id }}" class="tab-pane">

                            <div class="col-lg-12">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Shift</th>
                                    <th>Senin</th>
                                    <th>Selasa</th>
                                    <th>Rabu</th>
                                    <th>Kamis</th>
                                    <th>Jumat</th>
                                    <th>Sabtu</th>
                                </tr>
                                </thead>
                                <tbody>
                                @for ($i = 0; $i < 8; $i++)
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    @for ($j = 0; $j < 6; $j++)
                                    <td style="min-width:140px;max-width:140px;">
                                        <?php $jadwal_data =  DB::table('tb_jadwal')->where('jadwal_shift', $i+1)->where('jadwal_hari', $j+1)->where('jadwal_status', 1)->where('ruangan_id', $ruang->ruang_id )->first();
                                         ?>
                                        @if (count($jadwal_data) > 0)
                                        <button onclick="getUpdate('{{$jadwal_data->jadwal_id}}', '{{$jadwal_data->ruangan_id}}', '{{$jadwal_data->jadwal_hari}}', '{{$jadwal_data->jadwal_shift}}')" type="button" data-toggle="modal" href="#myModal-2" class="btn btn-primary center-block" >
                                        {{$jadwal_data->jadwal_nama}}
                                        </button>

                                        {{ link_to_action('KordasController@deleteJadwal', 'Delete', array($jadwal_data->jadwal_id), ['class' => 'btn btn-danger center-block', 'onclick' => 'return confirm(\'Are you sure you want to delete this item?\');' ])}}


                                        @endif
                                    </td>
                                    @endfor
                                </tr>
                                @endfor
                                </tbody>
                            </table>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- Modal Edit Jadwal -->
                <div class="modal fade" id="myModal-2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Jadwal</h4>
                            </div>
                            <div class="modal-body">
                                {{Form::open(array('action' => 'KordasController@updateJadwal'))}}

                                <label>Pilih Ruangan</label>
                                <select name="update_ruang_id" id="update_ruang_id" class="form-control m-bot15" required >
                                    <option value="">-</option>
                                    @foreach($ruangs as $ruang)
                                    <option value="{{ $ruang->ruang_id }}">{{ $ruang->ruang_nama }}</option>
                                    @endforeach
                                </select>
                                <label>Pilih Hari</label>
                                <select name="update_jadwal_hari" id="update_jadwal_hari" class="form-control m-bot15" required >
                                    <option value="">-</option>
                                    <option value="1">Senin</option>
                                    <option value="2">Selasa</option>
                                    <option value="3">Rabu</option>
                                    <option value="4">Kamis</option>
                                    <option value="5">Jumat</option>
                                    <option value="6">Sabtu</option>
                                </select>
                                <label>Pilih Shift</label>
                                        <select name="update_shift" id="update_shift" class="form-control m-bot15" onchange="setTime()" >
                                            <option value="">-</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                        </select>
                                {{ Form::hidden('update_jadwal_id', '', array('id'=>'update_jadwal_id')) }}
                            </div>
                            <div class="modal-footer">
                                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                {{Form::submit('Submit', array('class' => 'btn btn-primary')) }}
                                {{ Form::close() }}
                            </div>
                            </div>
                        </div>
                    </div>
                <!-- Modal -->
                <div class="modal fade" id="ModalConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Modal Tittle</h4>
                            </div>
                            <div class="modal-body">

                                Are you sure want to delete it?

                            </div>
                            <div class="modal-footer">
                                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                <button class="btn btn-warning" type="button"> Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            <!-- END MODAL -->
            </section>
            </div>
            </div>
        </section>
    </section>
    <!--main content end-->
@include('footer')
<!--script for this page only-->
<script src="js/table-editable.js"></script>
<!--script for this page-->
<script src="js/gritter.js" type="text/javascript"></script>

<script>
function setTime() {

    var e = document.getElementById("shift");
    var shift = e.options[e.selectedIndex].value;
    
    var JamMulai="";
    var JamSelesai="";

    switch (shift) {
        case "0":
            JamMulai = "Jam Mulai";
            JamSelesai = "Jam Selesai";
            break;
        case "1":
            JamMulai = "06:30:00";
            JamSelesai = "08:10:00";
            break;
        case "2":
            JamMulai = "08:30:00";
            JamSelesai = "10:10:00";
            break;
        case "3":
            JamMulai = "10:30:00";
            JamSelesai = "12:10:00";
            break;
        case "4":
            JamMulai = "12:30:00";
            JamSelesai = "14:10:00";
            break;
        case "5":
            JamMulai = "14:30:00";
            JamSelesai = "16:10:00";
            break;
        case  "6":
            JamMulai = "16:30:00";
            JamSelesai = "18:10:00";
            break;
        case  "7":
            JamMulai = "18:30:00";
            JamSelesai = "20:10:00";
            break;
        case  "8":
            JamMulai = "20:30:00";
            JamSelesai = "22:10:00";
            break;
    }

    if(JamMulai=="Jam Mulai"){
        document.getElementById("JamMulai").value = JamMulai;
        document.getElementById("JamSelesai").value = JamSelesai;

        document.getElementById("JamMulai").disabled = true;
        document.getElementById("JamSelesai").disabled = true;
        
    }else{
        document.getElementById("JamMulai").value = JamMulai;
        document.getElementById("JamSelesai").value = JamSelesai;

        document.getElementById("JamMulai").disabled = false;
        document.getElementById("JamSelesai").disabled = false;
    }
    

}
</script>
<script>
    jQuery(document).ready(function() {
        EditableTable.init();
    });
</script>
<script>
function getUpdate(jadwal_id, update_ruang_id, update_jadwal_hari, update_shift){
    
    document.getElementById("update_ruang_id").value = update_ruang_id;
    document.getElementById("update_jadwal_hari").value = update_jadwal_hari;
    document.getElementById("update_shift").value = update_shift;
    document.getElementById("update_jadwal_id").value = jadwal_id;
}
</script>
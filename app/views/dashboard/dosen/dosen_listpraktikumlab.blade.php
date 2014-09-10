@include('header')
@include('dashboard/dosen/menu_dosen')
    <link href="js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
	<!--main content start-->
	<section id="main-content">
		<section class="wrapper">
		<!-- page start-->

        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li><a href="/"><i class="fa fa-home"></i>Home</a></li>
                    <li><a href="/"></i>Data Absen</a></li>
                    <li class="active"><a href="/DataAbsen/ListPraktikumLab">Daftar Laboratorium</a></li>
                    
                </ul>
            </div>
        </div>
        {{ HTML::ul($errors->all(), array('class' => 'alert alert-danger', 'style' => 'padding-left:40px')) }}  
        @if(Session::has('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif
        <div class="row">
            @foreach ($listLab as $lab)
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <!--widget start-->
                            <aside class="profile-nav alt">
                                <section class="panel">
                                    <div class="user-heading alt" style="background:#bdc3c7;">
                                        <a href="#">
                                            <img alt="" src="/images/lock_thumb.jpg">
                                        </a>
                                        <h1>{{ $lab->lab_nama }}</h1>
                                        <p>{{ $lab->lab_keterangan }}</p>
                                    </div>

                                    <ul class="nav nav-pills nav-stacked">
                                        <li><a href="/DataAbsen/PilihPraktikumLab?id={{$lab->lab_id}}"> <i class="fa  fa-list-ul"></i> List Praktikum </a></li>
                                    </ul>

                                </section>
                            </aside>
                            <!--widget end-->

                        </div>
                    </div>
                </div>
            @endforeach
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
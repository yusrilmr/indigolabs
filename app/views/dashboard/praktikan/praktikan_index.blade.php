@include('header')
@include('dashboard/praktikan/menu_praktikan')

 <link href="css/clndr.css" rel="stylesheet">
    <!--clock css-->
    <link href="js/css3clock/css/style.css" rel="stylesheet">
	
	<!--main content start-->
	<section id="main-content">
		<section class="wrapper">
		<!-- page start-->

		<div class="row">
		<div class="col-md-3">
        <div class="profile-nav alt">
            <section class="panel">
                <div class="user-heading alt clock-row terques-bg">
                    <h1>Selamat Datang</h1>                    
                </div>
                <ul id="clock">
                    <li id="sec"></li>
                    <li id="hour"></li>
                    <li id="min"></li>
                </ul>
            </section>
        </div>
		</div>
		<div class="col-md-9">
			<div class="event-calendar clearfix">
				<div class="col-lg-7 calendar-block">
					<div class="cal1 ">
					</div>
				</div>
				<div class="col-lg-5 event-list-block">
					<div class="cal-day">
						<span>Hari ini</span>
						<?php
							
						?>
						
						<span>Praktikum yang Aktif :</span>
						
					</div>
					<ul class="event-list">
					<?php $i=1 ?>
						@foreach($data as $d)
						<li>{{$i}} {{$d->praktikum_nama}} | {{$d->jadwal_hari}} {{$d->jadwal_jam_mulai}} - {{$d->jadwal_jam_selesai}} <a href="praktikum/list/{{$d->running_id}}" class="event-close"><i class="fa fa-play"></i></a></li>                    
						<?php $i++ ?>
						@endforeach
						
						
					</ul>
					
				</div>
			</div>
		</div>    
	</div>
		
		<!-- page end-->
		</section>
	</section>
	<!--main content end-->
<!-- @ include('footer') -->




<!--right sidebar start-->
<div class="right-sidebar">
<div class="search-row">
    <h3>Jadwal Praktikum</h3>
</div>
<div class="right-stat-bar">
<ul class="right-side-accordion">

<li class="widget-collapsible">
    <a href="#" class="head widget-head purple-bg active">
        <span class="pull-left"> Jadwal Praktikum</span>
        <span class="pull-right widget-collapse"><i class="ico-minus"></i></span>
    </a>
    <ul class="widget-container">
        @foreach($jadwal as $j)
        <li>
            <div class="prog-row">
                <div class="user-thumb rsn-activity">
                    <i class="fa fa-clock-o"></i>
                </div>
                <div class="rsn-details ">
                    <p class="text-muted">
                        <h4><a href="#">{{$j->praktikum_nama}} </a></h4>
                    </p>
                    <p>
                        <h5>{{$j->jadwal_hari}} </h5>{{$j->jadwal_jam_mulai}} - {{$j->jadwal_jam_selesai}}
                    </p>
                </div>
            </div>
            
        </li>
        @endforeach
    </ul>
</li>







<!-- ABAIKAN GK BOLEH DIHAPUS, cuma dihiden aja | START -->
<li class="widget-collapsible" style="visibility: hidden;">
    <a href="#" class="head widget-head red-bg active clearfix">
        <span class="pull-left">aa</span>
        <span class="pull-right widget-collapse"><i class="ico-minus"></i></span>
    </a>
    <ul class="widget-container">
        <li>
            <div class="prog-row side-mini-stat clearfix">
             
                <div class="side-mini-graph">
                    <div class="target-sell">
                    </div>
                </div>
            </div>                        
        </li>
    </ul>
</li>
<!-- ABAIKAN GK BOLEH DIHAPUS, cuma dihiden aja | END -->

</ul>
</div>
</div>
<!--right sidebar end-->

</section>

<!-- Placed js at the end of the document so the pages load faster -->

<!--Core js-->
{{ HTML::script('js/jquery.js') }}
{{ HTML::script('bs3/js/bootstrap.min.js') }}
{{ HTML::script('js/jquery.dcjqaccordion.2.7.js') }}
{{ HTML::script('js/jquery.scrollTo.min.js') }}
{{ HTML::script('js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js') }}
{{ HTML::script('js/jquery.nicescroll.js') }}
<!--<script src="js/jquery.js"></script>
<script src="bs3/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/jquery.scrollTo.min.js"></script>
<script src="js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>-->
<!--Easy Pie Chart-->
{{ HTML::script('js/easypiechart/jquery.easypiechart.js') }}
<!--<script src="js/easypiechart/jquery.easypiechart.js"></script>-->
<!--Sparkline Chart-->
{{ HTML::script('js/sparkline/jquery.sparkline.js') }}
<!--<script src="js/sparkline/jquery.sparkline.js"></script>-->
<!--jQuery Flot Chart-->
{{ HTML::script('js/flot-chart/jquery.flot.js') }}
{{ HTML::script('js/flot-chart/jquery.flot.tooltip.min.js') }}
{{ HTML::script('js/flot-chart/jquery.flot.resize.js') }}
{{ HTML::script('js/flot-chart/jquery.flot.pie.resize.js') }}
<!--<script src="js/flot-chart/jquery.flot.js"></script>
<script src="js/flot-chart/jquery.flot.tooltip.min.js"></script>
<script src="js/flot-chart/jquery.flot.resize.js"></script>
<script src="js/flot-chart/jquery.flot.pie.resize.js"></script>-->


<!--common script init for all pages-->
{{ HTML::script('js/scripts.js') }}
<!--<script src="js/scripts.js"></script>-->

<!--dynamic table-->
{{ HTML::script('js/advanced-datatable/js/jquery.dataTables.js') }}
{{ HTML::script('js/data-tables/DT_bootstrap.js') }}
<!--<script type="text/javascript" language="javascript" src="js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="js/data-tables/DT_bootstrap.js"></script>-->


<!--dynamic table initialization -->
{{ HTML::script('js/dynamic_table_init.js') }}
<!--<script src="js/dynamic_table_init.js"></script>-->

<script src="js/css3clock/js/css3clock.js"></script>
<script src="js/calendar/clndr.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
<script src="js/calendar/moment-2.2.1.js"></script>
<script src="js/evnt.calendar.init.js"></script

</body>
</html>


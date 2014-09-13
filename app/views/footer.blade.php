

<!--right sidebar start-->
<div class="right-sidebar">
<div class="search-row">
    <h3>Jadwal Praktikum</h3>
</div>
<div class="right-stat-bar" style="display: none;">
<ul class="right-side-accordion">

<li class="widget-collapsible">
    <a href="#" class="head widget-head purple-bg active">
        <span class="pull-left"> Praktikum ALPRO</span>
        <span class="pull-right widget-collapse"><i class="ico-minus"></i></span>
    </a>
    <ul class="widget-container">
        <?php
            for($i=0;$i<5;$i++){
        ?>
        <li>
            <div class="prog-row">
                <div class="user-thumb rsn-activity">
                    <i class="fa fa-clock-o"></i>
                </div>
                <div class="rsn-details ">
                    <p class="text-muted">
                        MODUL 1 - Pengenalan
                    </p>
                    <p>
                        <a href="#">Senin </a>15 Juli 2015
                    </p>
                </div>
            </div>
            
        </li>
        <?php } ?>
    </ul>
</li>


<li class="widget-collapsible">
    <a href="#" class="head widget-head terques-bg active">
        <span class="pull-left"> Praktikum SISOP</span>
        <span class="pull-right widget-collapse"><i class="ico-minus"></i></span>
    </a>
    <ul class="widget-container">
        <?php
            for($i=0;$i<5;$i++){
        ?>
        <li>
            <div class="prog-row">
                <div class="user-thumb rsn-activity">
                    <i class="fa fa-clock-o"></i>
                </div>
                <div class="rsn-details ">
                    <p class="text-muted">
                        MODUL 1 - Pengenalan
                    </p>
                    <p>
                        <a href="#">Senin </a>15 Juli 2015
                    </p>
                </div>
            </div>
            
        </li>
        <?php } ?>
    </ul>
</li>


<li class="widget-collapsible">
    <a href="#" class="head widget-head red-bg active">
        <span class="pull-left"> Praktikum JARKOM</span>
        <span class="pull-right widget-collapse"><i class="ico-minus"></i></span>
    </a>
    <ul class="widget-container">
        <?php
            for($i=0;$i<5;$i++){
        ?>
        <li>
            <div class="prog-row">
                <div class="user-thumb rsn-activity">
                    <i class="fa fa-clock-o"></i>
                </div>
                <div class="rsn-details ">
                    <p class="text-muted">
                        MODUL 1 - Pengenalan
                    </p>
                    <p>
                        <a href="#">Senin </a>15 Juli 2015
                    </p>
                </div>
            </div>
            
        </li>
        <?php } ?>
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



</body>
</html>

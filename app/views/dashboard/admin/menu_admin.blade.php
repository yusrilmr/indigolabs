<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->            <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
            <li>
                <a href="/">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-laptop"></i>
                    <span>Data Master</span>
                </a>
                <ul class="sub">
                  
                    <li><a href="/admin/datamasterdosen">Dosen</a></li>
                    
                    <li><a href="/admin/datamaster/lab">Laboraturium</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-laptop"></i>
                    <span>Sistem Praktikum</span>
                </a>
                <ul class="sub">
                    <li><a href="/praktikum/pra">Aktivasi Praktikum</a></li> 
					
                    <li><a href="{{ action('AdminController@jadwal'); }}">Jadwal</a></li>
                    <li><a href="{{ action('AdminController@ruang'); }}">Ruang</a></li>					
                </ul>
            </li>
            
        </ul></div>        
<!-- sidebar menu end-->
    </div>
</aside>
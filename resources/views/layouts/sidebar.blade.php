<!-- Main sidebar -->
<div class="sidebar sidebar-main">
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user-material">
            <div class="category-content">
                <div class="sidebar-user-material-content">
                    <h6>BAPPEDA</h6>
                    <span class="text-size-small">@@bappeda</span>
                </div>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">

                    <!-- Main -->
                    <li class="navigation-header">
                        <span>Main Menu</span> <i class="icon-menu" title="Main pages"></i>
                    </li>
                    <li class="{{ Request::is('/') ? 'active' : '' }}">
                        <a href="{{ url('/') }}">
                            <i class="icon-home4"></i> 
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('program*') || Request::is('kegiatan*') ? 'active' : '' }}">
                        <a href="{{ url('program') }}">
                            <i class="icon-calendar"></i> 
                            <span>Program / Kegiatan</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('anggaran*') ? 'active' : '' }}">
                        <a href="{{ url('anggaran') }}">
                            <i class="icon-cash"></i> 
                            <span>Anggaran</span>
                        </a>
                    </li>
                    

                </ul>
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>
<!-- /main sidebar -->
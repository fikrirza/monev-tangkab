<!-- Main sidebar -->
<div class="sidebar sidebar-main">
    <div class="sidebar-content">

        <!-- User menu -->
        @if (Auth::check())
        <div class="sidebar-user-material">
            <div class="category-content">
                <div class="sidebar-user-material-content">
                    @if (Auth::user()->skpd_id != null)
                        <h6>{{ Auth::user()->skpd->nama }}</h6>
                    @else
                        <h6>Publik</h6>
                    @endif
                    <span class="text-size-small">{{ '@' . Auth::user()->username }}</span>
                </div>
            </div>
        </div>
        @endif
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
                    
                    <li class="{{ Request::is('laporan*') ? 'active' : '' }}">
                        <a href="{{ url('laporan') }}">
                            <i class="icon-three-bars"></i> 
                            <span>Laporan Triwulan</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>
<!-- /main sidebar -->
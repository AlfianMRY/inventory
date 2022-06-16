<div class="leftside-menu leftside-menu-detached">

    <div class="leftbar-user">
        <a href="javascript: void(0);">
            <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="user-image" height="42" class="rounded-circle shadow-sm">
            <span class="leftbar-user-name">Dominic Keller</span>
        </a>
    </div>

    <!--- Sidemenu -->
    <ul class="side-nav">

        <li class="side-nav-title side-nav-item">Navigation</li>

        <li class="side-nav-item">
            <a href="/" class="side-nav-link">
                <i class="uil-home-alt"></i>
                <span> Landingpage </span>
            </a>
        </li>

        <li class="side-nav-item">
            <a href="/dashboard" class="side-nav-link">
                <i class=" uil-chart-bar"></i>
                <span> Dashboards </span>
            </a>
        </li>
        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#sidebarDashboards" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                <i class="dripicons-folder-open"></i>
                <span> Data Master </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarDashboards">
                <ul class="side-nav-second-level">
                    {{-- <li>
                        <a href="{{ url('/kategori') }}">Kategori</a>
                    </li> --}}
                    {{-- <li>
                        <a href="{{ url('/supplier') }}">Supplier</a>
                    </li> --}}
                    <li class="side-nav-item">
                        <a href="{{ url('/kategori') }}" class="side-nav-link ps-5">
                            <i class=" uil-game-structure"></i>
                            <span>Kategori</span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="{{ url('/supplier') }}" class="side-nav-link ps-5">
                            <i class="uil-box"></i>
                            <span>Supplier</span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="{{ url('/user') }}" class="side-nav-link ps-5">
                            <i class="uil-users-alt"></i>
                            <span>User</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="side-nav-item">
            <a href="{{ url('/barang') }}" class="side-nav-link">
                <i class="uil-dropbox"></i>
                <span> Barang</span>
            </a>
        </li>
        
        <li class="side-nav-item">
            <a href="{{ url('/barangmasuk') }}" class="side-nav-link">
                <i class=" uil-truck"></i>
                <span> Barang Masuk</span>
            </a>
        </li>

        <li class="side-nav-item">
            <a href="{{ url('/reqbarang') }}" class="side-nav-link">
                <i class="uil-shield-question"></i>
                <span> Request Barang </span>
            </a>
        </li>
        
    </ul>

    <!-- Help Box -->
    <div class="help-box help-box-light text-center">
    </div>
    <!-- end Help Box -->
    <!-- End Sidebar -->

    <div class="clearfix"></div>
    <!-- Sidebar -left -->

</div>
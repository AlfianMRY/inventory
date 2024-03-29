<div class="navbar-custom topnav-navbar topnav-navbar-dark">
    <div class="container-fluid">

        <!-- LOGO -->
        <a href="index.html" class="topnav-logo">
            <span class="topnav-logo-lg">
                <img src="{{ asset('img/icon/logoadmin.png') }}" alt="" height="50">
            </span>
            <span class="topnav-logo-sm">
                <img src="{{ asset('img/icon/logo_g.png') }}" alt="" height="70">
            </span>
        </a>

        <ul class="list-unstyled topbar-menu float-end mb-0">
            @if (Auth::user()->role == 'admin')
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" id="topbar-notifydrop" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="dripicons-bell noti-icon"></i>
                    @if (isset($reqMenunggu) && $reqMenunggu->count() >= 1)
                        <span class="position-absolute start-100 translate-middle badge rounded-pill bg-danger" style="top: 20px">
                            {{ $reqMenunggu->count() }}+
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg" aria-labelledby="topbar-notifydrop">

                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5 class="m-0">
                            Request Menunggu
                        </h5>
                    </div>

                    <div style="max-height: 230px;" data-simplebar>
                        <!-- item-->
                        @foreach ($reqMenunggu as $i)
                        <a href="{{ url('/req-barang') }}" class="dropdown-item notify-item">
                            <div class="notify-icon">
                                <img src="{{ asset('img/profile/'.$i->user->foto) }}" class="img-fluid rounded-circle" alt="" /> 
                            </div>
                            <p class="notify-details">{{ $i->user->name }}</p>
                            <p class="text-muted mb-0 user-msg">
                                <small><strong>{{ $i->barang->nama }}</strong> ~ {{ $i->quantity }} buah</small>
                            </p>
                        </a>
                        @endforeach

                    </div>

                    <!-- All-->
                    {{-- <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                        View All
                    </a> --}}

                </div>
            </li>
            @endif
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" id="topbar-userdrop" href="#" role="button" aria-haspopup="true"
                    aria-expanded="false">
                    <span class="account-user-avatar"> 
                        <img src="{{ asset('img/profile/'.Auth::user()->foto) }}" alt="user-image" class="rounded-circle">
                    </span>
                    <span>
                        <span class="account-user-name">{{ Auth::user()->name }}</span>
                        <span class="account-position">{{ Auth::user()->role }}</span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown" aria-labelledby="topbar-userdrop">
                    <!-- item-->
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>

                    <!-- item-->
                    <a href="{{ url('/profile',Auth::user()->id) }}" class="dropdown-item notify-item">
                        <i class="mdi mdi-account-circle me-1"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="{{ url('/profile/'.Auth::user()->id.'/edit') }}" class="dropdown-item notify-item">
                        <i class="mdi mdi-account-edit me-1"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item notify-item">
                            <i class="mdi mdi-logout me-1"></i>
                            <span>Logout</span>
                        </button>
                    </form>

                </div>
            </li>

        </ul>
        <a class="button-menu-mobile disable-btn">
            <div class="lines">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </a>
    </div>
</div>
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="{{url('/')}}"><img src="{{asset('landingpage/img/logolanding.png')}}"></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="{{ url('/') }}">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#portfolio">Portfolio</a></li>
          <li><a class="nav-link scrollto" href="#team">Team</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          @guest
            <li><a class="getstarted scrollto" href="{{url('/login')}}">Login</a></li>  
          @else
            <li><a href="" class="nav-link scrollto disabled">{{ Auth::user()->name }}</a></li>
            <li>
              <a class="nav-link scrollto" href="#" onclick="logout()">Logout</a> 
            </li>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                @csrf
              </form>
          @endauth
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header>

    <!-- header
    ================================================== -->
    <header class="s-header">

        <div class="header-logo">
            <a class="site-logo" href="{{ url('/') }}">
                <!-- <img class="landing" src="{{ asset('images/logos/logo_white.svg') }}" alt="Homepage"> -->
            </a>
        </div>

        <nav class="header-nav">

            <a href="#0" class="header-nav__close" title="close"><span>Close</span></a>

            <div class="header-nav__content">
                <h3>Navigation</h3>
                
                <ul class="header-nav__list">
                    
                    @if(!Auth::check())
                        <li class="current"><a class="smoothscroll"  href="{{ url('/login') }}" title="home">Login</a></li>
                        <li class="current"><a class="smoothscroll"  href="{{ url('/register') }}" title="home">Create Account</a></li>
                    @endif

                    @if(Auth::check())
                        <li class="current"><a class="smoothscroll"  href="{{ url('/dashboard') }}" title="Dashboard">Dashboard</a></li>
                    @endif
                </ul>

            </div> <!-- end header-nav__content -->

        </nav>  <!-- end header-nav -->

        <a class="header-menu-toggle" href="#0">
            <span class="header-menu-text">Menu</span>
            <span class="header-menu-icon"></span>
        </a>

    </header> <!-- end s-header -->
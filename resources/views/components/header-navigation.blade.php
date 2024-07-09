<!-- to send the data with the componenet -->
<div class="site-header__header-one-wrap">
    <header class="main-nav__header-one ">
        <nav class="header-navigation stricky">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="main-nav__logo-box">
                    <a href="{{ route('base') }}" class="main-nav__logo">
                        <img src="{{ asset('assets/images/logo-dark.png') }}" class="main-logo" width="200"
                            alt="Jordan Insight logo" />
                    </a>
                    <a href="#" class="side-menu__toggler"><i class="fa fa-bars"></i>
                        <!-- /.smpl-icon-menu --></a>
                </div><!-- /.logo-box -->
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="main-nav__main-navigation">
                    <ul class=" main-nav__navigation-box">
                        <li class="dropdown current">
                            <a href="{{ route('base') }}">Home</a>
                        </li>
                        <li class="dropdown">
                            <a href="{{ route('destinations') }}">Destinations</a>
                            <ul>

                                <li><a href="{{ route('destinationsAmman') }}">Amman</a></li>
                                <li><a href="{{ route('destinationsDeadsea') }}">Dead Sea</a></li>
                                <li><a href="{{ route('destinationsPetra') }}">Petra</a></li>
                                <li><a href="{{ route('destinations') }}">More Destinations</a></li>

                            </ul><!-- /.sub-menu -->
                        </li>
                        <li class="dropdown">
                            <a href="#">Tours</a>
                            <ul>
                                <li><a href="{{route('tour-standard.index')}}">Tours</a></li>
                                <li><a href="{{route('pageTour')}}">Users Tours</a></li>
                            </ul><!-- /.sub-menu -->
                        </li>
                        <!-- this shit need work -->
                        <li class="dropdown">
                            <a href="#">Pages</a>
                            <ul>
                                <li><a href="{{ route('pageCar') }}">Cars</a></li>
                                <li><a href="{{ route('pageHotel') }}">Hotels</a></li>
                                <li><a href="{{ route('pageHistoricalSite') }}">Historical Sites</a></li>
                                <li><a href="{{ route('pageRestaurant') }}">Restaurants</a></li>
                                <li><a href="{{ route('pageActivity') }}">Activities</a></li>
                            </ul><!-- /.sub-menu -->
                        </li>
                        <li>
                            <a href="{{ route('blog') }}">Blog</a>
                        </li>
                        <li>
                            <a href="{{route('contact')}}">Contact</a>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
                <div class="main-nav__right">

                    @auth
                        <a href="{{ route('user.profile', ['user' => Auth::id()]) }}" class="main-nav__user">
                            <i class="tripo-icon-avatar"></i> Hello, {{ Auth::user()->first_name }}
                        </a>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="main-nav__login">
                            <i class="fa fa-sign-out-alt"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            style="display: none; margin-left: 10px;">
                            @csrf
                        </form>
                    @endauth
                    @guest
                        <a href="{{ route('login') }}" class="main-nav__login">
                            <i class="tripo-icon-avatar"></i>
                        </a>
                    @endguest
                </div><!-- /.main-nav__right -->
            </div>
            <!-- /.container -->
        </nav>
    </header><!-- /.site-header -->
</div><!-- /.site-header__header-one-wrap -->

<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        <!-- Show logged-in user's info -->
        <ul class="navbar-nav">
            @if (Auth::check())
                @php $user = Auth::user(); @endphp
                <li style = "display:flex; flex-direction:column; justify-content:center;"class="dropdown-item py-2">
                    <a href="{{ route('admin.logout') }}" class="text-body ms-0"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="me-2 icon-md" data-feather="log-out"></i>
                        <span>Log Out</span>
                    </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{ route('admin.login.view') }}" class="nav-link">Login</a>
                </li>
            @endif
        </ul>
    </div>
</nav>

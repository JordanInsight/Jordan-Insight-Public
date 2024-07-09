<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('admin.index') }}" class="sidebar-brand">
            JI <span>ADMIN</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{ route('admin.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item nav-category">Components</li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.city.index') }}">
                    <i class="fa-solid fa-city"></i>
                    <span class="link-title">City</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.location.index') }}">
                    <i class="link-icon" data-feather="move"></i>
                    <span class="link-title">Location</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.Category.index') }}">
                    <i class="fa-solid fa-layer-group"></i>
                    <span class="link-title">Trip categories</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.hotel.index') }}">
                    <i class="fa-sharp fa-solid fa-hotel"></i>
                    <span class="link-title">Hotles</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.restaurant.index') }}">
                    <i class="link-icon" data-feather="coffee"></i>
                    <span class="link-title">Restaurants</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.historicalSite.index') }}">
                    <i class="fa-solid fa-landmark"></i>
                    <span class="link-title">Hitstorical sites</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.activity.index') }}">
                    <i class="fa-solid fa-cable-car"></i>
                    <span class="link-title">Activities</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.user.index') }}">
                    <i class="fa-solid fa-users"></i>
                    <span class="link-title">Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.role.index') }}">
                    <i class="fa-solid fa-user-lock"></i>
                    <span class="link-title">Roles</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.reservation.index') }}">
                    <i class="fa-solid fa-book"></i>
                    <span class="link-title">Reservations</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.car.index') }}">
                    <i class="fa-solid fa-car"></i>
                    <span class="link-title">Cars</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.tour.index') }}">
                    <i class="fa-solid fa-suitcase-rolling"></i>
                    <span class="link-title">Tours</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

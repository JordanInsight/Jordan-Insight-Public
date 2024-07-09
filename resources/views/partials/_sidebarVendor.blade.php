<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('vendor.index') }}" class="sidebar-brand">
            JI <span>VENDOR</span>
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
                <a href="{{ route('vendor.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item nav-category">Components</li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('vendor.car.index') }}">
                    <i class="fa-solid fa-car"></i>
                    <span class="link-title">Cars</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('vendor.tour.index') }}">
                    <i class="fa-solid fa-suitcase-rolling"></i>
                    <span class="link-title">Tours</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

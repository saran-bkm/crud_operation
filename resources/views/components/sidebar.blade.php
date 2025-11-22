<div class="sidebar bg-light p-3">
    <h3 class="text-primary">Admin</h3>
    <ul class="nav flex-column mt-4">
        <li class="nav-item">
            <a href="{{ url('/') }}" class="nav-link {{ Request::is('/') ? 'active' : '' }}"><i class="fa fa-tachometer-alt me-2"></i></i>Dashboard</a>
        </li>
        <li class="nav-item">
            <a href="{{ url('/customers') }}" class="nav-link {{ Request::is('/customers*') ? 'active' : '' }}"><i class="fa fa-users me-2"></i>Customers</a>
        </li>
        <li class="nav-item">
            <a href="{{ url('/items') }}" class="nav-link {{ Request::is('items*') ? 'active' : '' }}">
                <i class="fa fa-box me-2"></i> Items
            </a>
        </li>
        
    </ul>
</div>
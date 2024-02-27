<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('home') }}">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('home') }}">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown {{ $type_menu === 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
        </ul>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown {{ $type_menu === 'users' ? 'active' : '' }}">
                <a href="{{ route('users.index') }}" class="nav-link"><i class="fas fa-fire"></i><span>Users</span></a>
            </li>
        </ul>
    </aside>
</div>

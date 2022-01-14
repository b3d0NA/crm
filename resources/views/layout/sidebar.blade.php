<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            CRM<span>Admin</span>
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
            <li class="nav-item {{ active_class(['/admin/adshboard']) }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">web apps</li>
            <li class="nav-item {{ active_class(['/claims']) }}{{ active_class(['/claims*']) }}">
                <a href="{{ route('claims.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="zap"></i>
                    <span class="link-title">Claims</span>
                </a>
            </li>
            <li class="nav-item nav-category">Components</li>
            <li class="nav-item {{ active_class(['/sales-channel']) }}">
                <a href="{{ route('sales.channel') }}" class="nav-link">
                    <i class="link-icon" data-feather="truck"></i>
                    <span class="link-title">Sales Channel</span>
                </a>
            </li>
            <li class="nav-item {{ active_class(['/items']) }}">
                <a href="{{ route('items.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="archive"></i>
                    <span class="link-title">Items</span>
                </a>
            </li>
            <li class="nav-item {{ active_class(['/users']) }}">
                <a href="{{ route('users.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Users</span>
                </a>
            </li>
            
            
        </ul>
    </div>
</nav>
<nav class="settings-sidebar">
    <div class="sidebar-body">
        <a href="#" class="settings-sidebar-toggler">
            <i data-feather="settings"></i>
        </a>
        <h6 class="text-muted mb-2">Sidebar:</h6>
        <div class="mb-3 pb-3 border-bottom">
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight"
                        value="sidebar-light" checked>
                    Light
                </label>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark"
                        value="sidebar-dark">
                    Dark
                </label>
            </div>
        </div>
    </div>
</nav>
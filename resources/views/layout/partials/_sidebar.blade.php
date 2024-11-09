{{-- Sidebar --}}
<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            <h4>Galyna Heiwa</h4>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main Menu</li>
            <li class="nav-item">
                <a href="{{ url('admin/dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">Data Master</li>
            <li class="nav-item">
                <a href="{{ url('admin/category') }}" class="nav-link">
                    <i class="link-icon" data-feather="layers"></i>
                    <span class="link-title">Kategori</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="pages/apps/calendar.html" class="nav-link">
                    <i class="link-icon" data-feather="calendar"></i>
                    <span class="link-title">Produk</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="pages/apps/calendar.html" class="nav-link">
                    <i class="link-icon" data-feather="calendar"></i>
                    <span class="link-title">Pengaturan</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

{{-- End Sidebar --}}

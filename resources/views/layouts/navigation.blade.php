<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            <a href="{{ route('profile.show') }}" class="d-block font-weight-normal">{{ Auth::user()->name }}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @foreach ($navItems as $item)
                <li class="nav-item">
                    <a href="{{ route($item['route']) }}"
                        class="nav-link {{ request()->routeIs($item['route']) ? 'active' : '' }}">
                        <i class="nav-icon {{ $item['icon'] }}"></i>
                        <p>{{ $item['label'] }}</p>
                    </a>
                </li>
            @endforeach
            @foreach ($collapseNavItems as $g)
                @if (!empty($g))
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon {{ $g['pIcon'] }} "></i>
                            <p>
                                {{ $g['label'] }}
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            @foreach ($g['list'] as $gl)
                                <li class="nav-item">
                                    <a href="{{ route($gl['route']) }}"
                                        class="nav-link {{ request()->routeIs($gl['route']) ? 'active' : '' }}">
                                        <i class="{{ $gl['icon'] }} nav-icon"></i>
                                        <p>{{ $gl['label'] }}</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            @endforeach

        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->

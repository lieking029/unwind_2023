<ul class="nav flex-column pt-3 pt-md-0">
    <li class="nav-item">
        <a href="{{ route('home') }}" class="nav-link d-flex align-items-center">
            <span class="sidebar-icon me-3">
                <img src="{{ asset('images/brand/light.svg') }}" height="20" width="20" alt="Volt Logo">
            </span>
            <span class="mt-1 ms-1 sidebar-text">
                Unwind
            </span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
        <a href="{{ route('home') }}" class="nav-link">
            <span class="sidebar-icon">
                <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                    <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                </svg>
            </span>
            <span class="sidebar-text">{{ __('Dashboard') }}</span>
        </a>
    </li>

    @admin
    <li class="nav-item {{ request()->routeIs('merchant.index') ? 'active' : '' }}">
        <a href="{{ route('merchant.index') }}" class="nav-link">
            <span class="sidebar-icon me-3">
                <i class="fas fa-user-tie fa-fw"></i>
            </span>
            <span class="sidebar-text">{{ __('Merchants') }}</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('users.index') ? 'active' : '' }}">
        <a href="{{ route('users.index') }}" class="nav-link">
            <span class="sidebar-icon me-3">
                <i class="fas fa-users fa-fw"></i>
            </span>
            <span class="sidebar-text">{{ __('Clients') }}</span>
        </a>
    </li>
    @endadmin

    @merchant
    <li class="nav-item">
        <a href="" class="nav-link">
            <span class="sidebar-icon me-3">
                <i class="fas fa-user-edit"></i>
            </span>
            <span class="sidebar-text">{{ __('Bookings') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <span class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#submenu-app">
            <span>
                <span class="sidebar-icon me-3">
                    <i class="fas fa-hotel"></i>
                </span>
                <span class="sidebar-text">{{ __('Property') }}</span>
            </span>
            <span class="link-arrow">
                <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd">
                    </path>
                </svg>
            </span>
        </span>
        <div class="multi-level collapse" role="list" id="submenu-app" aria-expanded="false">
            <ul class="flex-column nav">
                <li class="nav-item">
                    <a href="{{ route('property.index') }}" class="nav-link">
                        <span class="sidebar-icon me-3">
                            <i class="fas fa-hotel"></i>
                        </span>
                        <span class="sidebar-text">{{ __('Properties') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('subhost.index') }}" class="nav-link">
                        <span class="sidebar-icon me-3">
                            <i class="fas fa-user-friends"></i>
                        </span>
                        <span class="sidebar-text">{{ __('Sub-Host') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('amenity.index') }}" class="nav-link">
                        <span class="sidebar-icon me-3">
                            <i class="fas fa-list-ul"></i>
                        </span>
                        <span class="sidebar-text">{{ __('Amenities') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('addon.index') }}" class="nav-link">
                        <span class="sidebar-icon me-3">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="sidebar-text">{{ __('AddOns') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <li class="nav-item">
        <a href="" class="nav-link">
            <span class="sidebar-icon me-3">
                <i class="fas fa-comment-alt"></i>
            </span>
            <span class="sidebar-text">{{ __('Inbox') }}</span>
        </a>
    </li>
    @endmerchant

    <li class="nav-item">
        <a href="{{ url('transaction') }}" class="nav-link">
            <span class="sidebar-icon me-3">
                <i class="fas fa-sync"></i>
            </span>
            <span class="sidebar-text">{{ __('Transaction') }}</span>
        </a>
    </li>


</ul>

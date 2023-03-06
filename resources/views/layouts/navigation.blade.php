<ul class="list-group">
    <li class="list-group-item">
        <a href="{{ route('dashboard') }}">
            {{ __('Dashboard') }}
        </a>
    </li>

    <li class="list-group-item">
        <a href="{{ route('dashboard.settings-page') }}">
            {{ __('Settings') }}
        </a>
    </li>

    <li class="list-group-item">
        <a href="{{ route('logout') }}">
            {{ __('Log Out') }}
        </a>
    </li>
</ul>
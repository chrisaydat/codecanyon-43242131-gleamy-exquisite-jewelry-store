<div class="row">
    <div class="col">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin..pending') ? 'active' : '' }}"
                    href="{{route('admin..pending')}}">@lang('Pending')
                    @if($pendingCount)
                    <span class="badge rounded-pill bg--white text-muted">{{$pendingCount}}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin..approved') ? 'active' : '' }}"
                    href="{{route('admin..approved')}}">@lang('Approved')
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin..rejected') ? 'active' : '' }}"
                    href="{{route('admin..rejected')}}">@lang('Rejected')
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin..log') ? 'active' : '' }}"
                    href="{{route('admin..log')}}">@lang('All')
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin..method.index') ? 'active' : '' }}"
                    href="{{route('admin..method.index')}}">@lang('al Methods')
                </a>
            </li>
        </ul>
    </div>
</div>

@php
    $user = auth()->user();
@endphp
<div class="col-xl-3 col-lg-4 pe-xl-4">
    <div class="dashboard_profile">
        <div class="dashboard_profile__details">
            <div class="dashboard_profile_wrap">
                <div class="profile_photo">
                    <img src="{{ getImage(getFilePath('userProfile').'/'.@$user->image, getFileSize('userProfile'))}}"
                        alt="profile-image">
                    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="photo_upload">
                            <label for="file_upload"><i class="fas fa-image"></i></label>
                            <input id="file_upload" type="file" name="image" class="upload_file"
                                onchange="this.form.submit()">
                        </div>
                    </form>

                </div>
                @if(!empty(auth()->user()))
                <h3>{{ __(auth()->user()->firstname) }} {{ auth()->user()->lastname }}</h3>
                @endif
            </div>
            <ul>
                <li>
                    <a  class='{{ Route::is('user.home') ? 'active' : '' }}' href="{{ route('user.home') }}">
                        <i class="fas fa-tachometer-alt"></i>@lang('Dashboard')
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.orders') }}" class='{{ Route::is('user.orders') ? 'active' : '' }}'>
                        <i class="fas fa-shopping-cart"></i>@lang('My Orders')
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.custom.orders') }}" class='{{ Route::is('user.custom.orders') ? 'active' : '' }}'>
                        <i class="fas fa-shopping-cart"></i>@lang('My Custom Orders')
                    </a>
                </li>

                <li>
                    <a href="{{ route('user.profile.setting') }}" class='{{ Route::is('user.profile.setting') ? 'active' : '' }}'>
                        <i class="fa fa-user"></i>@lang('Profile')
                    </a>
                </li>
                <li>
                    <a href="{{ route('ticket') }}" class="{{ Route::is('ticket') ? 'active' : '' }}">
                        <i class="fas fa fa-life-ring"></i>@lang('My Tickets')
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.change.password') }}" class='{{ Route::is('user.change.password') ? 'active' : '' }}'>
                        <i class="fa fa-lock"></i>@lang('Change Password')
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.twofactor') }}" class='{{ Route::is('user.twofactor') ? 'active' : '' }}'>
                        <i class="fas fa-key"></i>@lang('Google Authentication')
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.logout') }}" class="text-danger">
                        <i class="fas fa-sign-out-alt"></i>@lang('Log Out')
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

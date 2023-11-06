@extends($activeTemplate.'layouts.master')

@section('content')
<div class="col-xl-9 col-lg-8">
    <div class="dashboard-body">
        <div class="row gy-4 justify-content-center">
            <div class="col-lg-12">
                <div class="user-profile">
                    <form action="" method="post">
                        @csrf
                        <div class="row gy-3">
                            <div class="col-sm-12">
                                <h4>@lang('Change Password')</h4>
                            </div>
                            <div class="col-sm-12">
                                <label for="your-password" class="form--label">@lang('Current Password')</label>
                                <div class="input-group">
                                    <input id="your-password" type="password" class="form-control form--control" name="current_password" required
                                    autocomplete="current-password">
                                    <div class="password-show-hide fas fa-eye toggle-password fa-eye-slash" id="#your-password"></div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label for="new-password" class="form--label">@lang('Password')</label>
                                <div class="input-group">
                                    <input id="new-password" type="password" class="form-control form--control"name="password" required
                                    autocomplete="current-password">
                                    <div class="password-show-hide fas fa-eye toggle-password fa-eye-slash" id="#new-password"></div>
                                    @if($general->secure_password)
                                    <div class="input-popup">
                                        <p class="error lower">@lang('1 small letter minimum')</p>
                                        <p class="error capital">@lang('1 capital letter minimum')</p>
                                        <p class="error number">@lang('1 number minimum')</p>
                                        <p class="error special">@lang('1 special character minimum')</p>
                                        <p class="error minimum">@lang('6 character password')</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label for="again-your-password" class="form--label">@lang('Confirm Password')</label>
                                <div class="input-group">
                                    <input id="again-your-password" type="password" class="form-control form--control" name="password_confirmation"
                                    required autocomplete="current-password">
                                    <div class="password-show-hide fas fa-eye toggle-password fa-eye-slash" id="#again-your-password"></div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn--base w-50">@lang('Submit')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

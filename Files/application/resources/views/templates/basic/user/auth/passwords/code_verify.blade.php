@extends($activeTemplate.'layouts.frontend')
@section('content')
<section class="account py-60">
    <div class="account-inner">
        <div class="container">
            <div class="row gy-4 justify-content-center">
                <div class="col-xl-6">
                    <div class="account-form">
                        <div class="account-form__content mb-3">
                            <h3 class="account-form__title mb-2">@lang('Verify Email Address')</h3>
                        </div>

                        <form action="{{ route('user.password.verify.code') }}" method="POST" class="submit-form">
                            @csrf
                            <p class="verification-text">@lang('A 6 digit verification code sent to your email address')
                                : {{ showEmailAddress($email) }}</p>
                            <input type="hidden" name="email" value="{{ $email }}">

                            @include($activeTemplate.'partials.verification_code')

                            <div class="form-group">
                                <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                            </div>

                            <div class="form-group">
                                @lang('Please check including your Junk/Spam Folder. if not found, you can')
                                <a href="{{ route('user.password.request') }}">@lang('Try to send again')</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

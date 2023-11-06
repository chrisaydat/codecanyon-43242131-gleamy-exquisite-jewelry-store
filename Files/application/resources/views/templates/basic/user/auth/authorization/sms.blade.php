@extends($activeTemplate .'layouts.frontend')
@section('content')
<section class="account py-60">
    <div class="account-inner">
        <div class="container">
            <div class="row gy-4 justify-content-center">
                <div class="col-xl-6">
                    <div class="account-form">
                        <div class="account-form__content mb-4">
                            <h3 class="account-form__title mb-2">@lang('Verify Mobile Number')</h3>
                        </div>
                        <form action="{{route('user.verify.mobile')}}" method="POST" class="submit-form">
                            @csrf
                            <p class="verification-text">@lang('A 6 digit verification code sent to your mobile number') : +{{
                                showMobileNumber(auth()->user()->mobile) }}</p>
                            @include($activeTemplate.'partials.verification_code')
                            <div class="mb-3">
                                <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                            </div>
                            <div class="form-group">
                                <p>
                                    @lang('If you don\'t get any code'), <a href="{{route('user.send.verify.code', 'phone')}}"
                                        class="forget-pass"> @lang('Try again')</a>
                                </p>
                                @if($errors->has('resend'))
                                <br />
                                <small class="text-danger">{{ $errors->first('resend') }}</small>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
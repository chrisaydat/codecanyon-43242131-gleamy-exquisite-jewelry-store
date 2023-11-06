@extends($activeTemplate.'layouts.frontend')
@section('content')
@php
    $policyPages = getContent('policy_pages.element',false,null,true);
@endphp
<!-- Registration Start Here  -->
<section class="account py-60">
    <div class="account-inner">
        <div class="container">
            <div class="row gy-4 justify-content-center">
                <div class="col-xl-8">
                    <div class="account-form">
                        <div class="account-form__content mb-4">
                            <h3 class="account-form__title mb-2"> @lang('Sign Up Your Account') </h3>
                        </div>

                         <form action="{{ route('user.register') }}" method="POST" class="verify-gcaptcha">
                            @csrf

                            <div class="row gy-3">

                                @if(session()->get('reference') != null)
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                        <label for="username" class="form--label">@lang('Reference by')</label>
                                        <input type="text" class="form--control" name="referBy" id="referenceBy" value="{{session()->get('reference')}}" readonly>
                                        </div>
                                </div>
                                @endif

                                <div class="col-sm-6">
                                     <div class="form-group">
                                        <label for="username" class="form--label">@lang('Username')</label>
                                        <input type="text" class="form--control" id="username"  name="username" value="{{ old('username') }}" required>
                                     </div>
                                </div>
                                <div class="col-sm-6">
                                     <div class="form-group">
                                        <label for="email" class="form--label">@lang('E-Mail Address')</label>
                                        <input type="email" class="form--control" id="email" name="email" value="{{ old('email') }}" required>
                                     </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form--label">@lang('Country')</label>
                                        <div class="col-sm-12">
                                            <select class="select form--control" name="country">
                                                @foreach($countries as $key => $country)
                                                  <option data-mobile_code="{{ $country->dial_code }}" value="{{ $country->country }}" data-code="{{ $key }}">{{ __($country->country) }}</option>
                                                @endforeach
                                            </select>
                                       </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group mb-3">
                                        <label class="form--label">@lang('Mobile')</label>
                                        <div class="input-group country-code">
                                            <span class="input-group-text mobile-code">

                                            </span>
                                            <input type="hidden" name="mobile_code">
                                            <input type="hidden" name="country_code">
                                            <input type="number" class="form--control checkUser" name="mobile" value="{{ old('mobile') }}"  required>
                                        </div>
                                        <small class="text-danger mobileExist"></small>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="your-password" class="form--label">@lang('Password')</label>
                                    <div class="input-group">
                                        <input id="your-password" type="password" class="form-control form--control" name="password" required>
                                        <div class="password-show-hide fas fa-eye toggle-password fa-eye-slash" id="#your-password"></div>
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
                                <div class="col-sm-6">
                                    <label for="confirm-password" class="form--label">@lang('Confirm Password')</label>
                                    <div class="input-group">
                                        <input id="confirm-password" type="password" class="form-control form--control" name="password_confirmation" required>
                                        <div class="password-show-hide fas fa-eye toggle-password fa-eye-slash" id="#confirm-password"></div>
                                    </div>
                                </div>
                                <x-captcha></x-captcha>
                                @if($general->agree)
                                <div class="col-sm-12">
                                    <div class="form--check">
                                        <input class="form-check-input" name="agree" type="checkbox" id="remember" @checked(old('agree')) required>
                                        <div class="form-check-label">
                                            <label class="" for="remember"> @lang('I agree with') @foreach($policyPages as $policy) <a href="{{ route('policy.pages',[slug($policy->data_values->title),$policy->id]) }}">{{ __($policy->data_values->title) }}</a> @if(!$loop->last), @endif @endforeach</label>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn--base w-25">@lang('Sign Up')</button>
                                </div>
                                <div class="col-sm-12">
                                    <div class="have-account text-center">
                                        <p class="have-account__text">@lang('Already Have An Account? ') <a href="{{route('user.login')}}" class="have-account__link text--base">@lang('Login Now')</a></p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Registration End Here  -->
@endsection

@push('style')
<style>

    .country-code select{
        border: none;
    }
    .country-code select:focus{
        border: none;
        outline: none;
    }
</style>
@endpush
@push('script-lib')
<script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
@endpush
@push('script')
    <script>
      "use strict";
        (function ($) {
            @if($mobileCode)
            $(`option[data-code={{ $mobileCode }}]`).attr('selected','');
            @endif

            $('select[name=country]').change(function(){
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+'+$('select[name=country] :selected').data('mobile_code'));
            });
            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+'+$('select[name=country] :selected').data('mobile_code'));
            @if($general->secure_password)
                $('input[name=password]').on('input',function(){
                    secure_password($(this));
                });

                $('[name=password]').focus(function () {
                    $(this).closest('.form-group').addClass('hover-input-popup');
                });

                $('[name=password]').focusout(function () {
                    $(this).closest('.form-group').removeClass('hover-input-popup');
                });


            @endif

            $('.checkUser').on('focusout',function(e){
                var url = '{{ route('user.checkUser') }}';
                var value = $(this).val();
                var token = '{{ csrf_token() }}';
                if ($(this).attr('name') == 'mobile') {
                    var mobile = `${$('.mobile-code').text().substr(1)}${value}`;
                    var data = {mobile:mobile,_token:token}
                }
                if ($(this).attr('name') == 'email') {
                    var data = {email:value,_token:token}
                }
                if ($(this).attr('name') == 'username') {
                    var data = {username:value,_token:token}
                }
                $.post(url,data,function(response) {
                  if (response.data != false && response.type == 'email') {
                    $('#existModalCenter').modal('show');
                  }else if(response.data != false){
                    $(`.${response.type}Exist`).text(`${response.type} already exist`);
                  }else{
                    $(`.${response.type}Exist`).text('');
                  }
                });
            });
        })(jQuery);

    </script>
@endpush

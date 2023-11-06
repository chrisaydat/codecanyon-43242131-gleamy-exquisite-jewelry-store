@extends($activeTemplate . 'layouts.frontend')
@section('content')

    @php
        $total = 0;
            if(session('cart')){
                foreach (session('cart') as $id => $details) {
                $total += @$details['price'] * @$details['quantity'];
            }
        }
    @endphp

    <!-- ==================== Coupon area Start Here ==================== -->
    <section class="coupon-area pt-80 pb-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="cuppon-accor mb-3">
                        <h4>
                            <i class="fa-solid fa-circle-exclamation"></i> @lang('Returning customer?')
                            <span id="showlogin">@lang('Click here to login')</span>
                        </h4>
                        <!--=======-** Login start **-=======-->
                        <div id="checkout-login" class="account-form" style="display: none;">
                            <div class="account-form__content mb-4">
                                <h3 class="account-form__title mb-2">@lang('Sign Up Your Account ')</h3>
                            </div>
                            <form method="POST" action="{{ route('user.login') }}" class="verify-gcaptcha">
                                @csrf
                                <div class="row gy-3">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="name" class="form--label">@lang('Username or Email')</label>
                                            <input type="text" class="form--control" id="name" name="username" value="{{ old('username') }}"  required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="your-password" class="form--label">@lang('Password')</label>
                                            <div class="input-group">
                                                <input id="your-password" type="password" class="form-control form--control" name="password"required>
                                                <div class="password-show-hide fas fa-eye toggle-password fa-eye-slash" id="#your-password"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="d-flex flex-wrap justify-content-between">
                                            <div class="form--check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="remember">@lang('Remember me')</label>
                                            </div>
                                            <a href="{{ route('user.password.request') }}" class="forgot-password text--base">@lang('Forgot Your Password?')</a>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn--base w-50">@lang('Sign In')</button>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="have-account text-center">
                                            <p class="have-account__text">@lang('Don\'t Have An Account?') <a href="{{route('user.register')}}" class="have-account__link text--base">@lang('Create Account')</a></p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--=======-** Login End **-=======-->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="cuppon-accor mb-3">
                        <h4>
                            <i class="fa-solid fa-circle-exclamation"></i>@lang('Have a coupon?')
                            <span id="showcupon">@lang('Click here to enter your code')</span>
                        </h4>
                        <div class="product-card__cupon mb-2" id="coupon-checkout" style="display: none;">
                       <form action="{{route('apply.cupon')}}" method="post">
                        @csrf
                        <input type="text" name="cupon" class="form--control" placeholder="@lang('Cupon Code')">
                        <button type="submit" class="btn btn--base simple">@lang('Apply Coupon')</button>
                       </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==================== Coupon area End Here ==================== -->

    <!-- ==================== Checkout Area Here ==================== -->
    <section class="checkout-area pb-60">
        <div class="container">
            <label class="form--label">@lang('Payment Method')</label>
              <form action="{{ auth()->user() ? route('user.deposit.insert') : route('deposit.insert')}}" method="post">
                @csrf

                <input type="hidden" name="method_code">
                <input type="hidden" name="currency">

                <div class="row">
                    <div class="col-md-6">
                        <div class="billing-box">
                            <h4 class="mb-3">@lang('Billing Details')</h4>
                            <div class="row">
                                <div class="col-sm-6">

                                    @if(!empty(auth()->user()))

                                    <div class="form-group mb-3">
                                        <label for="firstname" class="form--label">@lang('First Name')</label>
                                        <input type="text" class="form--control" id="firstname" name="firstname" value="{{auth()->user()->firstname}}">
                                    </div>
                                    @else
                                    <div class="form-group mb-3">

                                        <label for="firstname" class="form--label">@lang('First Name')</label>
                                        <input type="text" class="form--control" id="firstname" name="firstname">
                                    </div>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    @if(!empty(auth()->user()))
                                    <div class="form-group mb-3">
                                        <label for="lastname" class="form--label">@lang('Last Name')</label>
                                        <input type="text" class="form--control" id="lastname" name="lastname" value="{{auth()->user()->lastname}}">
                                    </div>
                                    @else
                                    <div class="form-group mb-3">
                                        <label for="lastname" class="form--label">@lang('Last Name')</label>
                                        <input type="text" class="form--control" id="lastname" name="lastname">
                                    </div>
                                    @endif
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
                                            <input type="number" class="form--control checkUser" name="mobile" value="{{ old('mobile') }}">
                                        </div>
                                        <small class="text-danger mobileExist"></small>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    @if(@auth()->user())
                                    <div class="form-group mb-3">
                                        <label for="your-email" class="form--label">@lang('Email')</label>
                                        <input type="email" class="form--control" id="your-email" name="email"  value="{{auth()->user()->email}}">
                                    </div>
                                    @else
                                    <div class="form-group mb-3">
                                        <label for="your-email" class="form--label">@lang('Email')</label>
                                        <input type="email" class="form--control" id="your-email" name="email">
                                    </div>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    @if(@auth()->user())
                                    <div class="form-group mb-3">
                                        <label for="your-adress" class="form--label">@lang('Address')</label>
                                        <input type="text" class="form--control" id="your-adress" name="address"
                                        value="{{ auth()->user()->address->address}}">
                                    </div>
                                    @else
                                    <div class="form-group mb-3">
                                        <label for="your-adress" class="form--label">@lang('Address')</label>
                                        <input type="text" class="form--control" id="your-adress" name="address">
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="your-order">
                            <h4 class="mb-3">@lang('Your Order')</h4>
                            <table class="table table--responsive--lg mb-3">
                                <thead>
                                    <tr>
                                        <th>@lang('Product')</th>
                                        <th>@lang('Total')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td data-label="Trx">
                                            @if (session('cart'))
                                                @foreach (session('cart') as $id => $details)
                                                    <li>{{ $details['name'] }}</li>
                                                @endforeach
                                            @else
                                                @lang('No Product')
                                            @endif
                                        </td>

                                        <td data-label="Description">
                                            @if (Session::has('cupon'))
                                            {{ __($general->cur_sym) }} {{ ($total)- ($total * Session::get('cupon')['discount']/100 ) }}
                                            @else
                                            {{ __($general->cur_sym) }}
                                            {{ showAmount(__($total)) }}
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td data-label="Trx">@lang('Total')</td>
                                        <td data-label="Description">
                                            @if (Session::has('cupon'))
                                            {{ __($general->cur_sym) }}{{ ($total)- ($total * Session::get('cupon')['discount']/100 ) }}
                                            @else
                                            {{ __($general->cur_sym) }}
                                            {{ showAmount(__($total)) }}
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group mb-4">
                            <label class="form--label">@lang('Payment Method')</label>
                                <div class="col-sm-12">
                                    <select class="select form--control" name="gateway" required>
                                        @foreach ($gatewayCurrency as $data)
                                            <option value="{{ $data->method_code }}" @selected(old('gateway') == $data->method_code)
                                                data-gateway="{{ $data }}">{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">@lang('Amount')</label>
                                        <div class="input-group country-code mb-3">
                                            @if (Session::has('cupon'))
                                        <input type="text" step="any" name="amount" class="form-control form--control"
                                        value="{{ ($total)- ($total * Session::get('cupon')['discount']/100 ) }}" autocomplete="off" required readonly>
                                        @else
                                        <input type="text" step="any" name="amount" class="form-control form--control"
                                        value="{{ $total }}" autocomplete="off" required readonly>
                                        @endif
                                        <span class="input-group-text" id="basic-addon1">{{ $general->cur_text }}</span>
                                    </div>
                                </div>
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn--base simple">@lang('Place Order')</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- ==================== Checkout Area Here ==================== -->
@endsection


@push('script')
<script>
    (function ($) {
        "use strict";
        $('select[name=gateway]').change(function () {
            if (!$('select[name=gateway]').val()) {
                $('.preview-details').addClass('d-none');
                return false;
            }
            var resource = $('select[name=gateway] option:selected').data('gateway');
            var fixed_charge = parseFloat(resource.fixed_charge);
            var percent_charge = parseFloat(resource.percent_charge);
            var rate = parseFloat(resource.rate)
            if (resource.method.crypto == 1) {
                var toFixedDigit = 8;
                $('.crypto_currency').removeClass('d-none');
            } else {
                var toFixedDigit = 2;
                $('.crypto_currency').addClass('d-none');
            }
            $('.min').text(parseFloat(resource.min_amount).toFixed(2));
            $('.max').text(parseFloat(resource.max_amount).toFixed(2));
            var amount = parseFloat($('input[name=amount]').val());
            if (!amount) {
                amount = 0;
            }
            if (amount <= 0) {
                $('.preview-details').addClass('d-none');
                return false;
            }
            $('.preview-details').removeClass('d-none');
            var charge = parseFloat(fixed_charge + (amount * percent_charge / 100)).toFixed(2);
            $('.charge').text(charge);
            var payable = parseFloat((parseFloat(amount) + parseFloat(charge))).toFixed(2);
            $('.payable').text(payable);
            var final_amo = (parseFloat((parseFloat(amount) + parseFloat(charge))) * rate).toFixed(toFixedDigit);
            $('.final_amo').text(final_amo);
            if (resource.currency != '{{ $general->cur_text }}') {
                var rateElement = `<span class="fw-bold">@lang('Conversion Rate')</span> <span><span  class="fw-bold">1 {{__($general->cur_text)}} = <span class="rate">${rate}</span>  <span class="base-currency">${resource.currency}</span></span></span>`;
                $('.rate-element').html(rateElement)
                $('.rate-element').removeClass('d-none');
                $('.in-site-cur').removeClass('d-none');
                $('.rate-element').addClass('d-flex');
                $('.in-site-cur').addClass('d-flex');
            } else {
                $('.rate-element').html('')
                $('.rate-element').addClass('d-none');
                $('.in-site-cur').addClass('d-none');
                $('.rate-element').removeClass('d-flex');
                $('.in-site-cur').removeClass('d-flex');
            }
            $('.base-currency').text(resource.currency);
            $('.method_currency').text(resource.currency);
            $('input[name=currency]').val(resource.currency);
            $('input[name=method_code]').val(resource.method_code);
            $('input[name=amount]').on('input');
        });
        $('input[name=amount]').on('input', function () {
            $('select[name=gateway]').change();
            $('.amount').text(parseFloat($(this).val()).toFixed(2));
        });
    })(jQuery);
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


@extends($activeTemplate.'layouts.frontend')
@section('content')
  <!--=======-** Login start **-=======-->
  <section class="account py-60">
    <div class="account-inner">
        <div class="container">
            <div class="row gy-4 justify-content-center">
                <div class="col-xl-6">
                    <div class="account-form">
                        <div class="account-form__content mb-4">
                            <h3 class="account-form__title mb-2">@lang(' Sign In Your Account ')</h3>
                        </div>
                        <form method="POST" action="{{ route('user.data.submit') }}">
                            @csrf
                            <div class="row gy-3">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="form-label">@lang('First Name')</label>
                                    <input type="text" class="form--control" name="firstname"
                                        value="{{ old('firstname') }}" required>
                                </div>
                            </div>

                                <div class="col-sm-6">
                                    <div class="form-group ">
                                    <label class="form-label">@lang('Last Name')</label>
                                    <input type="text" class="form--control" name="lastname"
                                        value="{{ old('lastname') }}" required>
                                </div>
                            </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="form-label">@lang('Address')</label>
                                    <input type="text" class="form--control" name="address"
                                        value="{{ old('address') }}">
                                </div>
                            </div>
                                <div class="col-sm-6">
                                    <div class="form-group ">
                                    <label class="form-label">@lang('State')</label>
                                    <input type="text" class="form--control" name="state"
                                        value="{{ old('state') }}">
                                </div>
                            </div>
                                <div class="col-sm-6">
                                    <label class="form-label">@lang('Zip Code')</label>
                                    <input type="text" class="form--control" name="zip"
                                        value="{{ old('zip') }}">
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="form-label">@lang('City')</label>
                                    <input type="text" class="form--control" name="city"
                                        value="{{ old('city') }}">
                                </div>
                            </div>
                            </div>
                            <div class="col-sm-12 mt-3">
                                <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=======-** Login End **-=======-->
@endsection

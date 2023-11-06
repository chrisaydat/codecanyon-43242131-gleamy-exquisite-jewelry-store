@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="col-xl-9 col-lg-8">
        <div class="dashboard-body">
            <div class="row gy-4 justify-content-center">

                @if (!auth()->user()->ts)
                    <div class="col-md-6">
                        <h3 class="card-title">@lang('Add Your Account')</h3>

                        <h6 class="mb-3">
                            @lang('Use the QR code or setup key on your Google Authenticator app to add your account. ')
                        </h6>

                        <div class="form-group mx-auto text-center">
                            <img class="mx-auto" src="{{ $qrCodeUrl }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">@lang('Setup Key')</label>
                            <div class="input-group">
                                <input type="text" name="key" value="{{ $secret }}"
                                    class="form-control form--control referralURL" readonly>
                                <button type="button" class="input-group-text copytext" id="copyBoard"> <i
                                        class="fa fa-copy"></i> </button>
                            </div>
                        </div>
                    </div>
                @endif




            @if(auth()->user()->ts)
            <div class="col-md-12">
                    <h3 class="card-title">@lang('Disable 2FA Security')</h3>
                <form action="{{route('user.twofactor.disable')}}" method="POST">

                        @csrf
                        <input type="hidden" name="key" value="{{$secret}}">
                        <div class="form-group">
                            <label class="form-label">@lang('Google Authenticatior OTP')</label>
                            <input type="text" class="form-control form--control" name="code" required>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <button type="submit" class="btn btn--base w-100">@lang('Save')</button>
                        </div>

                </form>
            </div>
            @else
            <div class="col-md-6">
                    <h3 class="card-title">@lang('Enable 2FA Security')</h3>
                <form action="{{ route('user.twofactor.enable') }}" method="POST">

                        @csrf
                        <input type="hidden" name="key" value="{{$secret}}">
                        <div class="form-group">
                            <label class="form-label">@lang('Google Authenticatior OTP')</label>
                            <input type="text" class="form-control form--control" name="code" required>
                        </div>
                     <div class="col-sm-12 mt-3">
                        <button type="submit" class="btn btn--base w-100">@lang('Save')</button>
                     </div>

                </form>
            </div>
            @endif
        </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
<style>
    .copied::after {
        background-color: #{{ $general->base_color }
    }

    ;
    }
</style>
@endpush

@push('script')
<script>
    (function ($) {
        "use strict";
        $('#copyBoard').on('click', function () {
            var copyText = document.getElementsByClassName("referralURL");
            copyText = copyText[0];
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            /*For mobile devices*/
            document.execCommand("copy");
            copyText.blur();
            this.classList.add('copied');
            setTimeout(() => this.classList.remove('copied'), 1500);
        });
    })(jQuery);
</script>
@endpush

@extends($activeTemplate.'layouts.frontend')
@section('content')

<section class="contact-bottom py-80">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-12">
                <div class="contactus-form">
                    <h3 class="contact__title">@lang('Order Information')</h3>
                    <form action="{{route('custom.order.store')}}" method="post" class="verify-gcaptcha" enctype="multipart/form-data">
                        @csrf
                        <div class="row gy-md-4 gy-3">
                            <div class="col-sm-6">
                                <input type="text" class="form--control" name="name" placeholder="@lang('Your Name')" value="{{auth()->check() ? auth()->user()->firstname.auth()->user()->lastname : ''}}">
                            </div>
                            <div class="col-sm-6">
                                <input type="email" class="form--control" name="email" placeholder="@lang('Your Email Address')" value="{{auth()->check() ? auth()->user()->email: ''}}">
                            </div>
                            <div class="col-sm-12">
                                <input type="file" class="form--control"name="image">
                            </div>
                            <div class="col-sm-12">
                                <textarea class="form--control"name="short_desc" placeholder="@lang('Write Your Messege')"></textarea>
                            </div>
                            <div class="col-sm-12">
                                <button class=" btn btn--base w-50">@lang('Request Order ')<span class="button__icon ms-1"><i class="fas fa-shopping-cart"></i></span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

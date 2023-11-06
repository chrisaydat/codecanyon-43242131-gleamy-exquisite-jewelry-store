@php
$subscribe = getContent('subscribe.content', true);
@endphp
<!-- ==================== Subscribe Here ==================== -->
<section class="subscribe-section section-bg py-60 bg-img" style="background-image: url({{asset($activeTemplateTrue.'images/banner-bg.jpg')}});">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="subscribe-wrap text-center">
                    <h2>{{ __($subscribe->data_values->heading) }}</h2>
                    <p>{{ __($subscribe->data_values->subheading) }}</p>
                    <div class="subscribe-wrap__input">
                        <form action="{{route('subscribe')}}" method="POST">
                            @csrf
                        <input type="email" class="form--control" name="email" placeholder="@lang('Enter Your Mail')">
                        <button><i class="fas fa-paper-plane"></i></button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ==================== Subscribe Here ==================== -->


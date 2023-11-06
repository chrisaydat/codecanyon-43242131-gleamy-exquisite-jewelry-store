@php
$offer = getContent('offer.content', true);
@endphp
<!-- ==================== Offer Start Here ==================== -->
<section class="offer-area bg-img" style="background-image: url({{asset($activeTemplateTrue.'images/offer-img.jpg')}});">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-10">
                <div class="offer text-center py-80">
                    <h2 class="offer__title">{{ __($offer->data_values->heading) }}</h2>
                    <p class="offer__desc">@lang('Flat') {{__($offer->data_values->discount)}}% @lang('off on Diamond Jewellery')</p>
                    <a href="{{route('shop')}}" class="btn btn--base style-1">{{ __($offer->data_values->offer_btn) }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ==================== Offer End Here ==================== -->

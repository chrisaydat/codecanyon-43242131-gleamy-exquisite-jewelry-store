@php
$about = getContent('about.content', true);
@endphp
<!--========================== About Section Start ==========================-->
<div class="about-section pt-120 pb-120">
    <div class="container">
        <div class="row gy-4 align-items-center">
            <div class="col-lg-6">
                <div class="about-thumb">
                    <div class="about-thumb__offer">
                        <span>@lang('Offer')</span>
                        <h3>{{ __($about->data_values->discount) }}<i class="percent">%</i></h3>
                        <p>@lang('In') {{ __($about->data_values->discount_month) }}</p>
                    </div>
                    <div class="about-thumb__inner">
                        <img src="{{ getImage(getFilePath('about') . '/'.@$about->data_values->about_image) }}" alt="About-image">

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
               <div class="about-right-content">
                    <div class="section-heading">
                        <h2 class="section-heading__subtitle-big">{{ __($about->data_values->top_heading) }}</h2>
                        <span class="section-heading__subtitle">{{ __($about->data_values->top_heading) }}</span>
                        <h2 class="section-heading__title ">{{ __($about->data_values->heading) }}</h2>
                        <p class="section-heading__desc mb-30">{{ __($about->data_values->subheading) }}</p>
                        <a href="{{ url('/') }}/about" class="btn btn--base">{{ __($about->data_values->about_btn) }}</a>
                    </div>
               </div>
            </div>
        </div>
    </div>
</div>

<!--========================== About Section End ==========================-->

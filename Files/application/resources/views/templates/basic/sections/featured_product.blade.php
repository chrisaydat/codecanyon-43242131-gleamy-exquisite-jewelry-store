@php
$featuredProduct = getContent('featured_product.content', true);
$product = App\Models\Product::where('featured', 1)->with('producutImages')->first();
@endphp
<!-- ==================== Featured Post Star Here ==================== -->
@if($product)
<section class="ring-area py-80">
    <div class="container">
        <div class="row gy-5 align-items-center flex-wrap-reverse">
            <div class="col-lg-6">
                <div class="ring">
                    <div class="ring__thumb">
                        <img src="{{ getImage(getFilePath('productImages').'/'.@$product->producutImages[0]->url.'/'.@$product->producutImages[0]->image)}}" alt="">
                        <h4 class="ring__price">{{__($general->cur_sym)}}{{showAmount(__(@$product->price))}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
               <div class="ring-content">
                <div class="section-heading mb-0">
                    <h2 class="section-heading__subtitle-big">{{ __($featuredProduct->data_values->top_heading) }}</h2>
                    <span class="section-heading__subtitle">{{ __($featuredProduct->data_values->top_heading) }}</span>
                    <h2 class="section-heading__title ">{{ __($featuredProduct->data_values->heading) }}</h2>
                    <p class="section-heading__desc mb-30">{{ __($featuredProduct->data_values->subheading) }}</p>
                    <a href="{{route('product.detail',['id'=>@$product->id, 'slug'=>@$product->name])}}" class="btn btn--base">@lang('Purchase Now')</a>
                </div>
           </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- ==================== Featured Post End Here ==================== -->

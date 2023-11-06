@php
$product = getContent('product.content', true);
$products = App\Models\Product::orderBy('created_at','desc')->with('producutImages')->limit(6)->get();
@endphp
<!-- ==================== Our Products Start Here ==================== -->
<section class="our-products py-80 section-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="section-heading  text-center">
                    <h2 class="section-heading__subtitle-big">@lang('Products')</h2>
                    <span class="section-heading__subtitle">{{ __($product->data_values->top_heading) }}</span>
                    <h2 class="section-heading__title ">{{ __($product->data_values->heading) }}</h2>
                    <p class="section-heading__desc mb-30">{{ __($product->data_values->subheading) }}</p>
                </div>
            </div>
        </div>
        <div class="row gy-4 justify-content-center">
            @foreach($products as $product)
            <div class="col-lg-4 col-md-6">
                <div class="product text-center">
                    <div class="product__thumb">
                        <a href="{{route('product.detail',[ 'id' => $product->id ,'slug' => slug($product->name)])}}">
                            <img src="{{ getImage(getFilePath('productImages').'/'.@$product->producutImages[0]->url.'/'.'thumb_'.@$product->producutImages[0]->image)}}" alt="">
                        </a>
                    </div>
                    <div class="product__content">
                        <h3 class="title"><a href="{{route('product.detail',[ 'id' => $product->id ,'slug' => slug($product->name)])}}">
                            @if(strlen(__($product->name)) >20)
                            {{substr( __($product->name), 0,20).'...' }}
                            @else
                            {{__($product->name)}}
                            @endif
                        </a>
                    </h3>
                        @if($product->discount != 0)
                    <div class="discount-wrap d-flex justify-content-center">
                        <h4 class="text-secondary m-0"><s>{{__($general->cur_sym)}}{{showAmount(__($product->price))}}</s></h4>
                        <h4 class="px-2"> {{ $general->cur_sym }}{{ showAmount(__($product->price)- ($product->price * $product->discount/100 )) }}</h4>
                    </div>
                    @else
                    <h4>{{__($general->cur_sym)}}{{showAmount(__($product->price))}}</h4>
                    @endif
                        <a  href="{{route('product.detail',['id'=>$product->id,  'slug' =>slug($product->name)])}}" class="btn btn--base outline">@lang('Buy Now')</a>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="col-sm-12 text-center mt-5">
                <a href="{{route('shop')}}" class="btn btn--base">@lang('See More')</a>
            </div>
        </div>
    </div>
</section>
<!-- ==================== Our Products End Here ==================== -->

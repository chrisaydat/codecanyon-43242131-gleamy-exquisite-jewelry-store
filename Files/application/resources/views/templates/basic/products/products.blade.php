@extends($activeTemplate.'layouts.frontend')
@section('content')
@php
$product = getContent('product.content', true);
@endphp
<!-- ==================== Our Products Start Here ==================== -->
<section class="our-products py-80 section-bg">
    <div class="container">
        <div class="row gy-4 justify-content-center">
          @foreach( $products as $product)
          <div class="col-lg-4 col-md-6">
            <div class="product text-center">
                <div class="product__thumb">
                  <a href="{{route('product.detail',['id'=>$product->id, 'slug'=>$product->name])}}">
                    <img src="{{ getImage(getFilePath('productImages').'/'.@$product->producutImages[0]->url.'/'.'thumb_'.@$product->producutImages[0]->image)}}" alt="">
                  </a>
                </div>
                <div class="product__content">
                    <h3 class="title"><a href="{{route('product.detail',['id'=>$product->id, 'slug'=>$product->name])}}">
                        @if(strlen(__($product->name)) >20)
                        {{substr( __($product->name), 0,20).'...' }}
                        @else
                        {{__($product->name)}}
                        @endif
                    </a></h3>
                    @if($product->discount != 0)
                    <div class="discount-wrap d-flex justify-content-center">
                        <h4 class="text-secondary m-0"><s>{{__($general->cur_sym)}} {{showAmount(__($product->price))}}</s></h4>
                        <h4 class="px-2"> {{ $general->cur_sym }} {{ showAmount(__($product->price)- ($product->price * $product->discount/100 )) }}</h4>
                    </div>
                    @else
                    <h4>{{__($general->cur_sym)}} {{showAmount(__($product->price))}}</h4>
                    @endif
                    <a href="{{route('product.detail',['id'=>$product->id, 'slug'=>$product->name])}}" class="btn btn--base outline">@lang('Buy Now')</a>
                </div>
            </div>
        </div>
          @endforeach
            <div class="col-sm-12">
                <nav>
                    <ul class="pagination mt-3">
                        @if ($products->hasPages())
                        <div class="py-4">
                            {{ paginateLinks($products) }}
                        </div>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- ==================== Our Products End Here ==================== -->
@if($sections->secs != null)
@foreach(json_decode($sections->secs) as $sec)
@include($activeTemplate.'sections.'.$sec)
@endforeach
@endif
@endsection

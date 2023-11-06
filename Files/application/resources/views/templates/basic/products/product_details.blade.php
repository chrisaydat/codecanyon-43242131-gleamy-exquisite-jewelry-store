@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <!-- ==================== Product Details Start Here ==================== -->
    <section class="product-details-area py-80">
        <div class="container">
            <div class="row gy-4 align-items-center">
                <div class="col-lg-6">
                    <div class="product-details-left align-items-center">
                        <div class="product-details-left__nav">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                @foreach ($productImages as $image)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{$loop->index==0 ? 'active' : ''}}" id="home-tab{{ $loop->index }}"
                                            data-bs-toggle="tab" data-bs-target="#home-tab-pane{{ $loop->index }}"
                                            type="button" role="tab"
                                            aria-selected="true">
                                            <img src="{{ getImage(getFilePath('productImages') . '/' . $image->url . '/' . @$image->image) }}"
                                                alt="">
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="product-details-left__content">
                            <div class="tab-content" id="myTabContent">
                                @foreach ($productImages as $image)
                                    <div class="tab-pane fade {{$loop->index == 0 ? 'show active' : ''}}"
                                        id="home-tab-pane{{ $loop->index }}" role="tabpane"
                                        tabindex="0">
                                        <div class="product-details-left__thumb">
                                            <a class="image-popup"
                                                href="{{ getImage(getFilePath('productImages') .'/'. $image->url .'/'. @$image->image) }}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <img src="{{ getImage(getFilePath('productImages') .'/'. $image->url . '/'. @$image->image) }}"
                                                alt="">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form action="{{route('add.to.cart',$productDetail->id)}}"method="post" >
                        @csrf
                    <div class="product-details">
                        <div class="product-details__content">
                            <h3 class="title mb-1">{{ __($productDetail->name) }}</h3>

                            @if($productDetail->discount !=0)
                            <div class="discount-wrap d-flex justify-content-start">
                                <h4 class="text-secondary m-0"><s> {{ $general->cur_sym }}{{ showAmount(__($productDetail->price)) }}</s></h4>
                                <h4  class="px-3"> {{ $general->cur_sym }}{{ showAmount(__($productDetail->price)- ($productDetail->price * $productDetail->discount/100 )) }}</h4>
                            </div>
                            @else
                                <h4> {{ $general->cur_sym }}{{ showAmount(__($productDetail->price)) }}</h4>
                            @endif

                            @if($productDetail->quantity == 0)
                            <span class="badge badge--danger">@lang('Stockout')</span>
                            @else
                            <span class="badge badge--success">@lang('Available')</span>
                            @endif
                            <div class="project_details mb-3">
                                <div class="quantity_box">
                                    <button type="button" class="sub"><i class="fa fa-minus"></i></button>
                                    <input class="quantity" name="quantity" type="number" value="1" pattern="[1-9]">
                                    <button type="button" class="add"><i class="fa fa-plus"></i></button>
                                </div>
                                <button type="submit" class="btn--sm btn--base outline hover-white-c mr-2 mb-10 addcart" data-id="{{$productDetail->id}}" >@lang('Add To Cart')</button>
                                @if($productDetail->quantity == 0)
                                @else
                                <a href="{{route('get.checkout')}}"
                                    class="btn--sm btn--base outline hover-white-c mb-10">@lang('Buy Now')</a>
                                @endif
                            </div>
                            <div class="product-details__table mb-3">
                                <table class="table table--responsive--lg">
                                    <thead>
                                        <tr>
                                            <th>@lang('Product Details')</th>
                                            <th>@lang('Rate')</th>
                                            <th>@lang('Approx Weight')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td data-label="Trx">{{ __($productDetail->purity) }} @lang('Karat Gold')</td>
                                            <td data-label="Transacted On">
                                                {{ __($general->cur_sym) }}{{ __($productDetail->pergram_rate) }} @lang('/per gram')</td>
                                            <td data-label="Description">{{ __($productDetail->weight) }} @lang('gram')</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="product-details__number">
                                <p class="phone-number">
                                    @if (strlen(__($productDetail->short_details)) > 180)
                                        {{ substr(__($productDetail->short_details), 0, 200) . '...' }}
                                    @else
                                        {{ __($productDetail->short_details) }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ==================== Product Details End Here ==================== -->
@endsection

@push('script')
<script>
   "use strict";
   $(".add").on("click", function () {
      if ($(this).prev().val() < 999) {
        $(this)
          .prev()
          .val(+$(this).prev().val() + 1);
      }
    });
    $(".sub").on("click", function () {
     var dd = $('.quantity').val();

      if (dd > 0) {
          $('.quantity').val(--dd);
      }
    });

    // // add to cart
    // $(document).ready(function(){
    //   $('.addcart').on('click', function(){
    //      var id = $(this).data('id');
    //      if (id) {
    //          $.ajax({
    //             url:'{{ route('add.to.cart','id') }}',
    //             method:"post",
    //             dataType: "json",
    //              data: {
    //                 _token: '{{ csrf_token() }}',
    //             },
    //              success:function(data){
    //              alert('success');
    //              },
    //          });
    //      }else{
    //          alert('danger');
    //      }
    //   });
    // });

    // // end add to cart

</script>
@endpush


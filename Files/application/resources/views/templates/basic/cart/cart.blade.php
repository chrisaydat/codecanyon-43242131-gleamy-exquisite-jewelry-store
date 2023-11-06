@extends($activeTemplate . 'layouts.frontend')
@section('content')
<!-- ==================== Card Start Here ==================== -->
<section class="card-area py-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 pb-30">
                <div class="card-wrap">
                    <table class="table table--responsive--lg">
                        <thead>
                            <tr>
                                <th>@lang('Image')</th>
                                <th>@lang('Product Name')</th>
                                <th>@lang('Unit Price')</th>
                                <th>@lang('Quantity')</th>
                                <th>@lang('Total')</th>
                                <th>@lang('Remove')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0 @endphp
                            @if(session('cart'))
                            @foreach(session('cart') as $id => $details)
                            @php @$total += @$details['price'] * @$details['quantity'] @endphp
                            <tr class="cart-row" data-id="{{ $id }}">
                                <td data-label="Trx"><a href="{{route('shop')}}"><img src="{{ getImage(getFilePath('productImages').'/'.@$details['url'].'/'.@$details['image'])}}" alt="Product-image"></a></td>
                                <td data-label="Transacted On"><a href="{{route('shop')}}">{{ @$details['name'] }}</a></td>
                                <td data-label="Description">{{__($general->cur_sym)}} {{showAmount(@$details['price'])}}</td>
                                <td data-th="Quantity">
                                    <div class="project_details justify-content-center mb-3">
                                        <div class="quantity_box">
                                            <button type="button" class="sub update-cart"><i class="fa fa-minus"></i></button>
                                            <input class="quantity" type="number" value="{{ $details['quantity'] }}" pattern="[1-9]">
                                            <button type="button" class="add update-cart"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </td>

                                <td data-label="Amount"><span class="badge badge--base">{{__($general->cur_sym)}} {{showAmount( @$details['price'] * @$details['quantity'] )}}</span></td>
                                <td data-label="Remaining Blance"><a class="remove-from-cart"><i class="fa fa-times"></i></a></td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @if(!empty(session('cart')))
        <div class="row justify-content-end">
            <div class="col-md-5">
                  <div class="cart-total">
                     <h2>Cart totals</h2>
                     <ul class="mb-4">
                        <li>@lang('Total') <span>{{__($general->cur_sym)}} {{showAmount(__( $total)) }}</span></li>
                     </ul>
                     <a href="{{route('get.checkout')}}" class="btn btn--base simple">@lang('Proceed to checkout')</a>
                  </div>
            </div>
         </div>
         @else
         @endif
    </div>
</section>
<!-- ==================== Card End Here ==================== -->
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
        if ($(this).next().val() > 1) {
          if ($(this).next().val() > 1)
            $(this)
            .next()
            .val(+$(this).next().val() - 1);
        }
      });

    $(".update-cart").click(function (e) {
        e.preventDefault();

        var ele = $(this);

        $.ajax({
            url: '{{ route('update.cart') }}',
            method: "get",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.parents("tr").attr("data-id"),
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
                window.location.reload();
            }
        });
    });


    $(".remove-from-cart").click(function (e) {
        e.preventDefault();

        var ele = $(this);

         $(this).closest('.cart-row').remove();
            $.ajax({
                url: '{{ route('remove.from.cart') }}',
                method: "get",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                }
            });
    });

</script>
@endpush

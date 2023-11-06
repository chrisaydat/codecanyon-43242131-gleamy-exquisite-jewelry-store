@extends($activeTemplate.'layouts.master')

@section('content')
<div class="col-xl-9 col-lg-8">
    <div class="dashboard-body">
        <div class="row gy-4 justify-content-center">
            <div class="col-lg-12">
                <div class="user-profile">
                    <table class="table table--responsive--lg">
                        <thead>
                            <tr>
                                <th>@lang('Product Image')</th>
                                <th>@lang('Product Name')</th>
                                <th>@lang('Quantity')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Total Amount')</th>

                            </tr>
                        </thead>
                        <h5>@lang('Order No:') # {{__($order->order_number)}}</h5>
                         @foreach($order->products as $item)
                         <tr class="cart-row">
                            <td data-label="Transacted On">
                              <a href="{{route('shop')}}">
                                <img src="{{ getImage(getFilePath('productImages').'/'.@$item->producutImages[0]->url.'/'.@$item->producutImages[0]->image)}}" alt="Image" class="rounded" style="width:50px;">
                            </a>
                        </td>
                            <td data-label="Transacted On">
                                <a href="{{route('shop')}}">
                                    {{__($item->name)}}
                                </a>
                            </td>
                            <td data-label="Transacted On">{{__($item->pivot->product_quantity)}} x {{ showAmount(__($item->price)- ($item->price * $item->discount/100 )) }}</td>
                            <td data-label="Transacted On">@php echo $order->statusBadge @endphp</td>
                            <td data-label="Amount">
                            <span class="badge badge--base">
                                @if($item->discount !=0)
                                {{__($general->cur_sym)}}{{ showAmount(__($item->price)- ($item->price * $item->discount/100 )) }}
                                @else
                                {{__($general->cur_sym)}} {{__($item->price * $item->pivot->product_quantity)}}
                                @endif
                            </span>
                        </td>
                        </tr>
                         @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

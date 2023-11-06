@extends($activeTemplate.'layouts.master')
@section('content')
<div class="col-xl-9 col-lg-8">
    <div class="order-wrap">
     <h4 class="mb-4">{{__( $pageTitle)}}</h4>
         <table class="table table--responsive--lg">
             <thead>
                 <tr>
                     <th>@lang('Order Date')</th>
                     <th>@lang('Order Number')</th>
                     <th>@lang('Status')</th>
                     <th>@lang('Amount')</th>
                     <th>@lang('Action')</th>
                 </tr>
             </thead>
             <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td data-label="Trx">{{ showDateTime($order->created_at)}}</td>
                    <td data-label="Trx" class="fw-bold">{{__($order->order_number)}}</td>
                    <td data-label="Transacted On">@php echo $order->statusBadge @endphp</td>
                    <td data-label="Amount">{{__($general->cur_sym)}} {{showAmount(__($order->product_price))}}</td>
                    <td data-label="Remaining Blance"><a href="{{route('user.order.detail',$order->id)}}" title="Details"><i class="fas fa-eye"></i></a></td>
                </tr>
                @endforeach
             </tbody>
         </table>
    </div>
    <div class="col-sm-12">
        <nav>
            <ul class="pagination mt-3">
                @if ($orders->hasPages())
                <div class="py-4">
                    {{ paginateLinks($orders) }}
                </div>
                @endif
            </ul>
        </nav>
    </div>
 </div>

 @endsection

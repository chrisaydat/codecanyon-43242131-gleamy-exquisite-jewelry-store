@extends($activeTemplate.'layouts.master')
@section('content')
<div class="col-xl-9 col-lg-8">
    <div class="order-wrap">
     <h4 class="mb-4">{{__( $pageTitle)}}</h4>
         <table class="table table--responsive--lg">
             <thead>
                 <tr>
                     <th>@lang('Name')</th>
                     <th>@lang('Email')</th>
                     <th>@lang('Image')</th>
                     <th>@lang('Time')</th>
                     <th>@lang('Action')</th>
                 </tr>
             </thead>
             <tbody>
                @foreach ($customOrder as $order)
                <tr>
                    <td data-label="Trx">{{__($order->name)}}</td>
                    <td data-label="Trx">{{__($order->email)}}</td>
                    <td data-label="Trx"><img src="{{ getImage(getFilePath('customProductImages').'/'.$order->path.'/'.@$order->image)}}" alt="Image" class="rounded" style="width:50px;"></td>
                    <td data-label="Trx">{{ showDateTime($order->created_at)}}</td>

                    <td data-label="Remaining Blance"><a href="{{route('user.custom.orders.details',$order->id)}}" title="Details"><i class="fas fa-eye"></i></a></td>
                </tr>
                @endforeach
             </tbody>
         </table>
    </div>
    <div class="col-sm-12">
        <nav>
            <ul class="pagination mt-3">
                @if ($customOrder->hasPages())
                <div class="py-4">
                    {{ paginateLinks($customOrder) }}
                </div>
                @endif
            </ul>
        </nav>
    </div>
 </div>

 @endsection

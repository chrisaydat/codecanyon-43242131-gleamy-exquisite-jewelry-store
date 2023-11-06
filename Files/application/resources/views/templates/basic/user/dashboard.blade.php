@extends($activeTemplate.'layouts.master')
@section('content')
<div class="col-xl-9 col-lg-8">
    <div class="dashboard-body">
        <div class="row gy-4 justify-content-center">
            <div class="col-xl-4 col-lg-6 col-sm-6">
                <div class="dashboard-card card-primary">
                    <div class="dashboard-card__icon">
                        <i class="fa fa-cart-arrow-down"></i>
                    </div>
                    <div class="dashboard-card__content">
                       <a href="{{route('user.orders')}}">
                        <h5 class="dashboard-card__title">@lang('All Order')</h5>
                        <h4 class="dashboard-card__amount">{{__($order['allOrder'])}}</h4>
                       </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-sm-6">
                <div class="dashboard-card card-violet">
                    <div class="dashboard-card__icon">
                        <i class="fa fa-cart-arrow-down"></i>
                    </div>
                    <div class="dashboard-card__content">
                       <a href="{{route('user.orders')}}">
                        <h5 class="dashboard-card__title">@lang('Completed Order')</h5>
                        <h4 class="dashboard-card__amount">{{__($order['delivared'])}}</h4>
                       </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-sm-6">
                <div class="dashboard-card card-success">
                    <div class="dashboard-card__icon">
                        <i class="fa fa-cart-arrow-down"></i>
                    </div>
                    <div class="dashboard-card__content">
                        <a href="{{route('user.orders')}}">
                            <h5 class="dashboard-card__title">@lang('Processing Order')</h5>
                        <h4 class="dashboard-card__amount">{{__($order['Processing'])}}</h4>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-sm-6">
                <div class="dashboard-card card-danger">
                    <div class="dashboard-card__icon">
                        <i class="fa fa-cart-arrow-down"></i>
                    </div>
                    <div class="dashboard-card__content">
                        <a href="{{route('user.custom.orders')}}">
                            <h5 class="dashboard-card__title">@lang('Custom Order')</h5>
                        <h4 class="dashboard-card__amount">{{__($order['custom_order'])}}</h4>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-sm-6">
                <div class="dashboard-card card-warning">
                    <div class="dashboard-card__icon">
                        <i class="fa fa-cart-arrow-down"></i>
                    </div>
                    <div class="dashboard-card__content">
                        <a href="{{route('user.orders')}}">
                            <h5 class="dashboard-card__title">@lang('Pending Order')</h5>
                           <h4 class="dashboard-card__amount">{{__($order['pending'])}}</h4>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

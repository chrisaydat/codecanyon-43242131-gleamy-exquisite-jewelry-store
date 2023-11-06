@extends('admin.layouts.app')
@section('panel')
<div class="row mb-none-30 justify-content-center">
    <div class="col-xl-6 col-md-6 mb-30">
        <div class="card b-radius--10 overflow-hidden box--shadow1">
            <div class="card-body">
                <h5 class="mb-20 p-2 text-muted">{{$pageTitle}}</h5>
                    <img class="card-img-top" src="{{ getImage(getFilePath('customProductImages').'/'.$customOrders->path.'/'.@$customOrders->image)}}" alt="Card image cap" style="width:200px">
                    <div class="card-body">
                      <h5 class="card-title">@lang('Name'): {{$customOrders->name}}</h5>
                      <h5 class="card-title">@lang('Email'): {{$customOrders->email}}</h5>
                      <p class="card-text">{{$customOrders->short_desc}}</p>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection



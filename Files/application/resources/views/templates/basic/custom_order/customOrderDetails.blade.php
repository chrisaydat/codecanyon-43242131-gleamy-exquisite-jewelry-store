@extends($activeTemplate.'layouts.frontend')
@section('content')

<section class="contact-bottom py-80">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-12">
                <div class="contactus-form">
                    <div class="card-body">
                        <h5 class="mb-20 p-2 text-muted">{{$pageTitle}}</h5>
                            <img class="card-img-top" src="{{ getImage(getFilePath('customProductImages').'/'.$customOrder->path.'/'.@$customOrder->image)}}" alt="Card image cap" style="width:200px">
                            <div class="card-body">
                              <h5 class="card-title">@lang('Name'): {{$customOrder->name}}</h5>
                              <h5 class="card-title">@lang('Email'): {{$customOrder->email}}</h5>
                              <p class="card-text">{{$customOrder->short_desc}}</p>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

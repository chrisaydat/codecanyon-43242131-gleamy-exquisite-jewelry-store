@extends($activeTemplate.'layouts.master')
@section('content')
<div class="col-xl-9 col-lg-8">
    <div class="dashboard-body">
        <div class="row gy-4 justify-content-center">
            <div class="col-lg-12">
                <div class="user-profile">

                        <h3 class="card-title mb-3">@lang('Profile')</h3>

                    <form class="register" action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row gy-3">
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label class="form-label">@lang('First Name')</label>
                                <input type="text" class="form-control form--control" name="firstname"
                                    value="{{$user->firstname}}" required>
                            </div>
                        </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label class="form-label">@lang('Last Name')</label>
                                <input type="text" class="form-control form--control" name="lastname"
                                    value="{{$user->lastname}}" required>
                            </div>
                        </div>


                            <div class="col-sm-6">
                                <div class="form-group">
                                <label class="form-label">@lang('E-mail Address')</label>
                                <input class="form-control form--control" value="{{$user->email}}" readonly>
                            </div>
                        </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label class="form-label">@lang('Mobile Number')</label>
                                <input class="form-control form--control" value="{{$user->mobile}}" readonly>
                            </div>
                        </div>


                            <div class="col-sm-6">
                                <div class="form-group">
                                <label class="form-label">@lang('Address')</label>
                                <input type="text" class="form-control form--control" name="address"
                                    value="{{@$user->address->address}}">
                            </div>
                        </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label class="form-label">@lang('State')</label>
                                <input type="text" class="form-control form--control" name="state"
                                    value="{{@$user->address->state}}">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">@lang('Zip Code')</label>
                                <input type="text" class="form-control form--control" name="zip"
                                    value="{{@$user->address->zip}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">@lang('Country')</label>
                                <input class="form-control form--control" value="{{@$user->address->country}}" disabled>
                            </div>
                        </div>


                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label">@lang('City')</label>
                                <input type="text" class="form-control form--control" name="city"
                                    value="{{@$user->address->city}}">
                            </div>
                        </div>

                    </div>

                        <div class="col-sm-12 mt-3">
                            <button type="submit" class="btn btn--base w-50">@lang('Save')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

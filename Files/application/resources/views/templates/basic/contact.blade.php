@extends($activeTemplate.'layouts.frontend')
@section('content')
@php
    $contact = getContent('contact_us.content', true);
@endphp
<!-- ==================== Contact Form Start Here ==================== -->
<section class="contact-bottom py-80">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-5">
                <div class="contact-info" >
                    <div class="contact-info__addres-wrap mb-30">
                        <div class="single_wrapper mb-30">
                            <h4>@lang('Call Us')</h4>
                            <div class="single-info">
                                <div class="cont-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="cont-text">
                                    <h6><a href="javascript:void(0)">{{__($contact->data_values->contact_number)}}</a></h6>
                                </div>
                            </div>
                       </div>
                        <div class="single_wrapper mb-30">
                            <h4>@lang('Email')</h4>
                            <div class="single-info">
                                <div class="cont-icon">
                                    <i class="far fa-envelope"></i>
                                </div>
                                <div class="cont-text">
                                    <h6><a href="javascript:void(0)">{{__($contact->data_values->email_address)}}</a></h6>

                                </div>
                            </div>
                       </div>
                        <div class="single_wrapper mb-30">
                            <h4>@lang('Office')</h4>
                            <div class="single-info">
                                <div class="cont-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="cont-text">
                                    <h6><a href="javascript:void(0)">{{__($contact->data_values->email_address)}}</a></h6>
                                </div>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="contactus-form">
                    <h3 class="contact__title">{{__($contact->data_values->heading)}}</h3>
                    <form action="" method="post" class="verify-gcaptcha">
                        @csrf
                        <div class="row gy-md-4 gy-3">
                            <div class="col-sm-12">
                                <input type="text" class="form--control" name="name" placeholder="@lang('Your Name')">
                            </div>
                            <div class="col-sm-12">
                                <input type="email" class="form--control" name="email" placeholder="@lang('Your Email Address')">
                            </div>
                            <div class="col-sm-12">
                                <input type="text" class="form--control"name="subject" placeholder="@lang('Subject')">
                            </div>
                            <div class="col-sm-12">
                                <textarea class="form--control"name="message" placeholder="@lang('Write Your Messege')"></textarea>
                            </div>
                            <div class="col-sm-12">
                                <button class=" btn btn--base w-100">{{__($contact->data_values->button)}}<span class="button__icon ms-1"><i class="fas fa-paper-plane"></i></span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ==================== Contact Form End Here ==================== -->
<!-- ==================== Map Start Here ==================== -->
<div>
    <div class="container-fluid">
        <div class="contact-map">
            <iframe src="https://maps.google.com/maps?q={{ $contact->data_values->latitude }},{{ $contact->data_values->longitude }}&hl=es;z=14&amp;output=embed"></iframe>
        </div>
    </div>
</div>
<!-- ==================== Map Start Here ==================== -->
@endsection

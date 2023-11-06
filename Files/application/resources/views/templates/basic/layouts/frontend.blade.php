<!doctype html>
<html lang="{{ config('app.locale') }}" itemscope itemtype="http://schema.org/WebPage">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> {{ $general->siteName(__($pageTitle)) }}</title>
    @include('partials.seo')
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/global/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/global/css/all.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/global/css/line-awesome.min.css')}}">

    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/custom-animation.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/slick.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/odometer.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/main.css')}}">

    @stack('style-lib')
    @stack('style')

    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/color.php') }}?color={{ $general->base_color }}">
</head>
<body>
    <!--==================== Preloader Start ====================-->
<div id="loading">
    <div id="loading-center">
       <div id="loading-center-absolute">
          <div class="object" id="object_one"></div>
          <div class="object" id="object_two"></div>
          <div class="object" id="object_three"></div>
          <div class="object" id="object_four"></div>
          <div class="object" id="object_five"></div>
          <div class="object" id="object_six"></div>
          <div class="object" id="object_seven"></div>
          <div class="object" id="object_eight"></div>
          <div class="object" id="object_big"></div>
       </div>
    </div>
  </div>
  <!--==================== Preloader End ====================-->

  <!--==================== Overlay Start ====================-->
  <div class="body-overlay"></div>
  <!--==================== Overlay End ====================-->

  <!--==================== Sidebar Overlay End ====================-->
  <div class="sidebar-overlay"></div>
  <!--==================== Sidebar Overlay End ====================-->

  <!-- ==================== Scroll to Top End Here ==================== -->
  <a class="scroll-top"><i class="fas fa-angle-double-up"></i></a>
  <!-- ==================== Scroll to Top End Here ==================== -->

     <!--=======-** Header Start **-=======-->
     @include($activeTemplate.'partials.header')
     <!--=======-** Header End **-=======-->
     @if(request()->route()->uri != '/')
     @include($activeTemplate.'partials.breadcrumb')
     @endif


@yield('content')

@include($activeTemplate.'partials.footer')

@php
    $cookie = App\Models\Frontend::where('data_keys','cookie.data')->first();
@endphp
@if(($cookie->data_values->status == 1) && !\Cookie::get('gdpr_cookie'))
    <!-- cookies dark version start -->
    <div class="cookies-card text-center hide">
      <p class="mt-4 cookies-card__content">{{ $cookie->data_values->short_desc }} <a href="{{ route('cookie.policy') }}" target="_blank">@lang('learn more')</a></p>
      <div class="cookies-card__btn mt-4">
        <a href="javascript:void(0)" class="btn btn--base w-50 policy">@lang('Allow')</a>
      </div>
    </div>
  <!-- cookies dark version end -->
  @endif


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="{{asset('assets/global/js/jquery-3.6.0.min.js')}}"></script>

  <script src="{{asset($activeTemplateTrue.'js/popper.min.js')}}"></script>
  <script src="{{asset($activeTemplateTrue.'js/bootstrap.min.js')}}"></script>
  <script src="{{asset($activeTemplateTrue.'js/slick.min.js')}}"></script>
  <script src="{{asset($activeTemplateTrue.'js/jquery.magnific-popup.min.js')}}"></script>
  <script src="{{asset($activeTemplateTrue.'js/odometer.min.js')}}"></script>
  <script src="{{asset($activeTemplateTrue.'js/viewport.jquery.js')}}"></script>
  <script src="{{asset($activeTemplateTrue.'js/main.js')}}"></script>



@stack('script-lib')

@stack('script')

@include('partials.plugins')

@include('partials.notify')



<script>
    (function ($) {
        "use strict";

        $('.policy').on('click',function(){
            $.get('{{route('cookie.accept')}}', function(response){
                $('.cookies-card').addClass('d-none');
            });
        });


        $(".language-select").on("change", function () {
        window.location.href = "{{ route('home') }}/change/" + $(this).val();
        });


        setTimeout(function(){
            $('.cookies-card').removeClass('hide')
        },2000);

    })(jQuery);
</script>

</body>
</html>

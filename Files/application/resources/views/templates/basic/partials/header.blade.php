@php
$contact = getContent('contact_us.content', true);
$languages = App\Models\Language::all();
@endphp
<div class="header-area">
    <div class="header-top">
    <div class="container">
        <div class="top-header-wrapper">
            <div class="top-contact">
                <ul class="contact-list">
                    <li class="contact-list__item"> <span class="contact-list__item-icon"><i class="fas fa-envelope"></i></span><a href="mailto:" class="contact-list__link"> {{__($contact->data_values->email_address)}}</a></li>
                    <li class="contact-list__item"><span class="contact-list__item-icon"><i class="fas fa-phone"></i></span><a href="tel:" class="contact-list__link">{{__($contact->data_values->contact_number)}}</a></li>
                </ul>
            </div>
            <div class="top-button">
              @guest
              <ul class="login-registration-list d-flex flex-wrap justify-content-between align-items-center">
                <li class="login-registration-list__item"><span class="login-registration-list__icon"><i class="fas fa-user"></i></span><a href="{{route('user.login')}}" class="login-registration-list__link">@lang('Login')</a></li>
                <li class="login-registration-list__item"><a href="{{route('user.register')}}" class="login-registration-list__link">@lang('Register')</a></li>
                <li class="login-registration-list__item add-card"><span class="login-registration-list__icon"> <i class="fas fa-shopping-cart"></i></span><a href="{{route('get.cart')}}" class="login-registration-list__link badge badge--warning">{{ count((array) session('cart')) }}</a></li>
            </ul>
              @endguest
                @auth
                <ul class="login-registration-list d-flex flex-wrap justify-content-between align-items-center">
                    <li class="login-registration-list__item"><span class="login-registration-list__icon"> <i class="fas fa-tachometer-alt"></i></span><a href="{{route('user.home')}}" class="login-registration-list__link">@lang('Dashboard')</a></li>
                    <li class="login-registration-list__item add-card"><span class="login-registration-list__icon"> <i class="fas fa-shopping-cart"></i></span><a href="{{route('get.cart')}}" class="login-registration-list__link badge badge--warning">{{ count((array) session('cart')) }}</a></li>
                </ul>
                @endauth
                <div class="language-box">
                    <select class="language-select select">
                        <option value="default" hidden="">@lang('Language')</option>
                        @foreach($languages as $lang)
                        <option value="{{ $lang->code }}" @if(Session::get('lang')===$lang->code)
                            selected @endif>{{ __($lang->name) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="header" id="header">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand logo" href="{{route('home')}}"><img src="{{ getImage(getFilePath('logoIcon').'/logo.png', '?'
                    .time()) }}" alt="{{config('app.name')}}"></a>
                <button class="navbar-toggler header-button" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span id="hiddenNav"><i class="las la-bars"></i></span>
                </button>

                <!-- Search Box Start -->
                    <div class="toggle-search-box">
                        <button type="button" class="" data-bs-toggle="modal" data-bs-target="#search-box" data-bs-whatever="@mdo"><i class="las la-search"></i></button>
                    </div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav nav-menu ms-auto">
                        <li class="nav-item d-block d-lg-none">
                            <div class="top-button d-flex flex-wrap justify-content-between align-items-center">
                                <div class="language-box">
                                    <div class="box">
                                        <select class="language-select select wide">
                                            <option value="default" hidden="">@lang('Language')</option>
                                            @foreach($languages as $lang)
                                            <option value="{{ $lang->code }}" @if(Session::get('lang')===$lang->code)
                                                selected @endif>{{ __($lang->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                              @guest
                              <ul class="login-registration-list d-flex flex-wrap align-items-center">
                                <li class="login-registration-list__item"><a href="{{route('user.login')}}" class="login-registration-list__link"><span class="login-registration-list__icon"><i class="fas fa-user"></i></span>@lang('Login')</a></li>
                                <li class="login-registration-list__item"><a href="{{route('user.register')}}" class="login-registration-list__link">@lang('Registration')</a></li>
                            </ul>
                              @endguest
                            </div>
                        </li>
                        @php
                        $pages =
                        App\Models\Page::where('tempname',$activeTemplate)->get();
                        @endphp

                        @foreach($pages as $page)
                        <li class="nav-item">
                            <a class="nav-link {{ Request::url() == url('/').'/'.$page->slug ? 'active' : '' }}" aria-current="page" href="{{route('pages',[$page->slug])}}">{{__($page->name)}}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>

 <!--========================== Search Modal Start ==========================-->
 <div class="overlay-search-box position-relative">
  <div class="modal fade" id="search-box" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-fullscreen modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="search-overlay-close" data-bs-dismiss="modal" aria-label="Close"><i class="las la-times"></i></button>
              </div>
              <div class="modal-body">
                  <form action="{{route('search')}}" method="post">
                    @csrf
                      <div class="row">
                          <div class="col-lg-12">
                              <div class="search-box">
                                  <div class="input--group">
                                      <input type="text" name="search" class="form--control style-two" placeholder="@lang('Search....')">
                                      <button class="search-btn" type="submit"><i class="las la-search"></i></button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>
<!--========================== Search Modal End ==========================-->

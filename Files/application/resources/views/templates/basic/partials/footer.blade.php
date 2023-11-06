@php
$contact = getContent('contact_us.content', true);
$links = getContent('policy_pages.element');
$social_icon = getContent('social_icon.element', false);
$importantLinks = getContent('footer_important_links.element', false, null, true);
$companyLinks = getContent('footer_company_links.element', false, null, true);
@endphp
<!-- ==================== Footer Start Here ==================== -->
<footer class="footer-area section-bg-light bg-img">
    <div class="pb-60 pt-120">
        <div class="container">
            <div class="row justify-content-center gy-5">
                <div class="col-xl-3 col-sm-6">
                    <div class="footer-item">
                        <div class="footer-item__logo">
                            <a href="index.html"> <img src="{{ getImage(getFilePath('logoIcon').'/logo.png', '?'.time()) }}" alt="LOGO"></a>
                        </div>
                        <p class="footer-item__desc"> @if (strlen(__($contact->data_values->short_details)) > 200)
                            {{ substr(__($contact->data_values->short_details), 0, 250) . '...' }}
                            @else
                            {{ __($contact->data_values->short_details) }}
                            @endif</p>
                        <ul class="social-list">
                            @foreach($social_icon as $item)
                            <li class="social-list__item"><a href="{{ __($item->data_values->url)}}" class="social-list__link text-white">@php echo
                                $item->data_values->social_icon
                                @endphp</a> </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-xl-1 d-xl-block d-none"></div>
                <div class="col-xl-2 col-sm-6">
                    <div class="footer-item">
                        <h5 class="footer-item__title">@lang('Company')</h5>
                        <ul class="footer-menu">
                            @foreach($companyLinks as $link)
                            <li class="footer-menu__item"><a href="{{url('/').$link->data_values->url}}" class="footer-menu__link">{{ __($link->data_values->title) }}</a></li>
                            @endforeach
                            @foreach ($links as $link)
                            <li class="footer-menu__item"><a href="{{ route('policy.pages', [slug($link->data_values->title), $link->id]) }}" class="footer-menu__link">{{
                                __($link->data_values->title) }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-6">
                    <div class="footer-item">
                        <h5 class="footer-item__title">@lang('Important Link')</h5>
                        <ul class="footer-menu">
                            @foreach($importantLinks as $link)
                            <li class="footer-menu__item"><a href="{{url('/').$link->data_values->url}}" class="footer-menu__link">{{ __($link->data_values->title) }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-xl-1 d-xl-block d-none"></div>
                <div class="col-xl-3 col-sm-6">
                    <div class="footer-item">
                        <h5 class="footer-item__title">@lang('Contact With Us')</h5>
                        <ul class="footer-contact-menu">
                            <li class="footer-contact-menu__item">
                                <div class="footer-contact-menu__item-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="footer-contact-menu__item-content">
                                    <p>{{ __($contact->data_values->contact_details) }}</p>
                                </div>
                            </li>
                            <li class="footer-contact-menu__item">
                                <div class="footer-contact-menu__item-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="footer-contact-menu__item-content">
                                    <p>{{ __($contact->data_values->email_address) }}</p>
                                </div>
                            </li>
                            <li class="footer-contact-menu__item">
                                <div class="footer-contact-menu__item-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="footer-contact-menu__item-content">
                                    <p>{{ __($contact->data_values->contact_number) }}</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <!-- Footer Top End-->

    <!-- bottom Footer -->
    <div class="bottom-footer section-bg py-3">
        <div class="container">
            <div class="row gy-3">
                <div class="col-md-12 text-center">
                    <div class="bottom-footer-text text-white">  @php echo ($contact->data_values->website_footer) @endphp</div>
                </div>
            </div>
        </div>
    </div>
  </footer>
  <!-- ==================== Footer End Here ==================== -->

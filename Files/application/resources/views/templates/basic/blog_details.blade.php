@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <!-- ==================== Blog Start Here ==================== -->
    <section class="blog-detials py-60">
        <div class="container">
            <div class="row gy-5 justify-content-center">
                <div class="col-lg-8">
                    <div class="blog-details">

                        <div class="blog-item">
                            <div class="blog-item__thumb">
                                <img src="{{ getImage(getFilePath('blog') .'/'.@$blog->data_values->blog_image) }}" alt="">
                            </div>
                            <div class="blog-item__content">
                                <ul class="text-list inline">
                                    <li class="text-list__item"> <span class="text-list__item-icon"><i
                                                class="fas fa-calendar-alt"></i></span>{{ showDateTime($blog->created_at) }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="blog-details__content">
                            <h3 class="blog-details__title">{{__($blog->data_values->title)}}</h3>
                            @php echo $blog->data_values->description; @endphp
                            <div class="blog-details__share mt-4 d-flex align-items-center flex-wrap mb-4">
                                <h5 class="social-share__title mb-0 me-sm-3 me-1 d-inline-block">@lang('Share This')</h5>
                                <ul class="social-list">
                                    <li class="caption social-list__item" data-bs-toggle="tooltip" data-bs-placement="top" title="Facebook"> <a target="_blank" href="https://www.facebook.com/share.php?u={{ Request::url() }}&title={{slug(@$element->data_values->title)}}"><i class="lab la-facebook-f"></i></a> </li>
                                    <li class="caption social-list__item" data-bs-toggle="tooltip" data-bs-placement="top" title="Linkedin"> <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url={{ Request::url() }}&title={{slug(@$element->data_values->title)}}&source=behands"><i class="lab la-linkedin-in"></i></a> </li>
                                    <li class="caption social-list__item" data-bs-toggle="tooltip" data-bs-placement="top" title="Twitter"> <a target="_blank" href="https://twitter.com/intent/tweet?status={{slug(@$element->data_values->title)}}+{{ Request::url() }}"><i class="lab la-twitter"></i></a> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- ============================= Blog Details Sidebar Start ======================== -->
                    <div class="blog-sidebar-wrapper">
                        <div class="blog-sidebar">
                            <h5 class="blog-sidebar__title">@lang('Recent Post')</h5>
                            <span class="hr-line"></span>
                            <span class="border"></span>
                            @foreach($latests as $item)
                            <div class="latest-blog">
                                <div class="latest-blog__thumb">
                                    <a href="{{ route('blog.details', ['slug' => slug($item->data_values->title), 'id' => $item->id])}}"> <img src="{{ getImage(getFilePath('blog') .'/'.'thumb_'.@$item->data_values->blog_image) }}"
                                            alt=""></a>
                                </div>
                                <div class="latest-blog__content">
                                    <h6 class="latest-blog__title"><a href="{{ route('blog.details', ['slug' => slug($item->data_values->title), 'id' => $item->id])}}">{{__($item->data_values->title)}}</a></h6>
                                    <span class="latest-blog__date">{{ showDateTime($item->created_at) }}</span>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                    <!-- ============================= Blog Details Sidebar End ======================== -->
                </div>
            </div>
        </div>
    </section>
    <!-- ==================== Blog End Here ==================== -->
@endsection

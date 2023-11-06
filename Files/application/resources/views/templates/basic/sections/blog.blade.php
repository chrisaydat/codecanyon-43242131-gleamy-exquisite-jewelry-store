@php
$blog = getContent('blog.content', true);
$blogElements = getContent('blog.element', false);
@endphp
<!-- ==================== Blog Start Here ==================== -->
<section class="blog py-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="section-heading  text-center">
                    <h2 class="section-heading__subtitle-big">{{__($blog->data_values->top_heading)}}</h2>
                    <span class="section-heading__subtitle">{{__($blog->data_values->top_heading)}}</span>
                    <h2 class="section-heading__title ">{{__($blog->data_values->heading)}}</h2>
                    <p class="section-heading__desc mb-30">{{__($blog->data_values->subheading)}}</p>
                </div>
            </div>
        </div>
        <div class="row gy-4 justify-content-center">
            @foreach($blogElements as $item)
            <div class="col-lg-4 col-md-6">
                <div class="blog-item">
                    <div class="blog-item__thumb">
                        <a href="{{ route('blog.details', ['slug' => slug($item->data_values->title), 'id' => $item->id])}}" class="blog-item__thumb-link">
                            <img src="{{ getImage(getFilePath('blog') .'/'.'thumb_'.@$item->data_values->blog_image) }}" alt="">
                        </a>
                    </div>
                    <div class="blog-item__content">
                        <ul class="text-list inline">
                            <li class="text-list__item"> <span class="text-list__item-icon"><i class="fas fa-calendar-alt"></i></span>{{showDateTime($item->created_at)}}</li>
                        </ul>
                        <h4 class="blog-item__title"><a href="{{ route('blog.details', ['slug' => slug($item->data_values->title), 'id' => $item->id])}}" class="blog-item__title-link"> @if(strlen(__($item->data_values->title)) >50)
                            {{substr( __($item->data_values->title), 0,60).'...' }}
                            @else
                            {{__($item->data_values->title)}}
                            @endif</a></h4>
                        <a href="{{ route('blog.details', ['slug' => slug($item->data_values->title), 'id' => $item->id])}}" class="btn--simple">@lang('Read More') <span class="btn--simple__icon"><i class="fas fa-arrow-right"></i></span></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- ==================== Blog End Here ==================== -->

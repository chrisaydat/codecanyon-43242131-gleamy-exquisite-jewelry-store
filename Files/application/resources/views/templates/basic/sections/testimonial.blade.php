@php
$testimonial = getContent('testimonial.content', true);
$testimonialElements = getContent('testimonial.element', false);
@endphp
<!--========================== Testimonials Section Start ==========================-->
<section class="testimonials py-80 ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="section-heading  text-center">
                    <h2 class="section-heading__subtitle-big">{{__($testimonial->data_values->top_heading)}}</h2>
                    <span class="section-heading__subtitle">{{__($testimonial->data_values->top_heading)}}</span>
                    <h2 class="section-heading__title ">{{__($testimonial->data_values->heading)}}</h2>
                    <p class="section-heading__desc mb-30">{{__($testimonial->data_values->subheading)}}</p>
                </div>
            </div>
        </div>
        <div class="testimonial-slider">
            @foreach($testimonialElements as $item)
            <div class="testimonails-card">
                <div class="testimonial-item">
                    <div class="testimonial-item__quate">@php echo
                        $item->data_values->testimonial_icon @endphp </div>
                    <div class="testimonial-item__content">
                        <div class="testimonial-item__info">
                            <div class="testimonial-item__thumb">
                                <img src="{{ getImage(getFilePath('testimonial').'/'.@$item->data_values->testimonial_image)}}" alt="Testimonial-Image">
                            </div>
                            <div class="testimonial-item__details">
                                <h5 class="testimonial-item__name">{{__($item->data_values->name)}}</h5>
                                <span class="testimonial-item__designation">{{__($item->data_values->title)}}</span>
                            </div>
                        </div>
                    <p class="testimonial-item__desc">@if(strlen(__($item->data_values->description)) >120)
                        {{substr( __($item->data_values->description), 0,150).'...' }}
                        @else
                        {{__($item->data_values->description)}}
                        @endif</p>


                    <div class="testimonial-item__rating">
                        <ul class="rating-list">
                            @if($item->data_values->rating == 1)
                            <li class="rating-list__item"><i class="fas fa-star"></i></li>
                            @elseif($item->data_values->rating == 2)
                            <li class="rating-list__item"><i class="fas fa-star"></i></li>
                            <li class="rating-list__item"><i class="fas fa-star"></i></li>
                            @elseif($item->data_values->rating == 3)
                            <li class="rating-list__item"><i class="fas fa-star"></i></li>
                            <li class="rating-list__item"><i class="fas fa-star"></i></li>
                            <li class="rating-list__item"><i class="fas fa-star"></i></li>
                            @elseif($item->data_values->rating == 4)
                            <li class="rating-list__item"><i class="fas fa-star"></i></li>
                            <li class="rating-list__item"><i class="fas fa-star"></i></li>
                            <li class="rating-list__item"><i class="fas fa-star"></i></li>
                            <li class="rating-list__item"><i class="fas fa-star"></i></li>
                            @elseif($item->data_values->rating == 5)
                            <li class="rating-list__item"><i class="fas fa-star"></i></li>
                            <li class="rating-list__item"><i class="fas fa-star"></i></li>
                            <li class="rating-list__item"><i class="fas fa-star"></i></li>
                            <li class="rating-list__item"><i class="fas fa-star"></i></li>
                            <li class="rating-list__item"><i class="fas fa-star"></i></li>
                            @endif
                        </ul>
                    </div>
                </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!--========================== Testimonials Section End ==========================-->

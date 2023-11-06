@extends($activeTemplate.'layouts.frontend')
@section('content')
@php
$banner = getContent('banner.content', true);
$categories = App\Models\Category::orderBy('id','asc')->limit(6)->get();
@endphp

<!--========================== Banner Section Start ==========================-->
<!-- bg-img -->
<section class="banner-section bg-img" style="background-image: url({{asset($activeTemplateTrue.'images/banner-bg.jpg')}});">
    <div class="container">
        <div class="row gy-4 align-items-center">
            <div class="col-lg-6 col-md-6">
                  <div class="banner-left__content">
                      <span>{{ __($banner->data_values->top_heading) }}</span>
                      <h2>{{ __($banner->data_values->heading) }}</h2>
                      <p>{{ __($banner->data_values->subheading) }}</p>
                      <a href="{{route('shop')}}" class="btn btn--base">{{ __($banner->data_values->hero_btn) }}</a>
                  </div>
              </div>
            <div class="col-lg-6 col-md-6">
              <div class="banner-right-wrap">
                  <img class="animate-y-axis " src="{{ getImage(getFilePath('hero') . '/'.@$banner->data_values->hero_image) }}" alt="Hero-Image">
              </div>
            </div>
        </div>
    </div>
  </section>
  <!--========================== Banner Section End ==========================-->
  <!-- ==================== Featured Item start Here ==================== -->
<section class="featured-area py-80">
    <div class="container">
        <div class="row gy-4 justify-content-center">
           @foreach($categories as $category)
           <div class="col-lg-4 col-md-6">
            <div class="single-featured">
                <a class="link" href="{{route('category.products',['id'=>$category->id, 'slug'=>$category->name]) }}">
                    <div class="single-featured__thumb">
                        <img src="{{ getImage(getFilePath('category').'/'.@$category->image)}}" alt="Category-Image">
                    </div>
                    <div class="single-featured__content">
                        <h4>{{__($category->name)}}</h4>
                    </div>
                </a>
            </div>
        </div>
           @endforeach
        </div>
    </div>
</section>
<!-- ==================== Featured Item end Here ==================== -->
  @if($sections->secs != null)
  @foreach(json_decode($sections->secs) as $sec)
  @include($activeTemplate.'sections.'.$sec)
  @endforeach
  @endif
@endsection

@php
$faq = getContent('faq.content', true);
$faqElements = getContent('faq.element', false,12);
@endphp
<!-- ==================== Accordion Start Here ==================== -->
<section class="accordion-area py-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="section-heading  text-center">
                    <h2 class="section-heading__subtitle-big">@lang('FAQs')</h2>
                    <span class="section-heading__subtitle">{{ __($faq->data_values->top_heading) }}</span>
                    <h2 class="section-heading__title ">{{ __($faq->data_values->top_heading) }}</h2>
                    <p class="section-heading__desc mb-30">{{ __($faq->data_values->top_heading) }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="accordion custom--accordion" id="faqAccordion{{ $loop->iteration }}">
                    @foreach($faqElements as $item)
                    @if($loop->odd)
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="h-{{ $loop->iteration }}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#c-{{ $loop->iteration }}" aria-expanded="false" aria-controls="c-{{ $loop->iteration }}">
                            {{__(@$item->data_values->question)}}
                        </button>
                      </h2>
                      <div id="c-{{ $loop->iteration }}" class="accordion-collapse collapse {{$loop->index == 0 ? 'show': ''}}" aria-labelledby="h-{{ $loop->iteration }}"  data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                           {{ strLimit(strip_tags(@$item->data_values->answer),350) }}
                        </div>
                      </div>
                    </div>
                    @endif
                    @endforeach

                </div>
            </div>
            <div class="col-lg-6">
                <div class="accordion custom--accordion" id="faqAccordion">
                    @foreach($faqElements as $item)
                    @if($loop->even)
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="h-{{ $loop->iteration }}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#c-{{ $loop->iteration }}" aria-expanded="false" aria-controls="c-{{ $loop->iteration }}">
                            {{__(@$item->data_values->question)}}
                        </button>
                      </h2>
                      <div id="c-{{ $loop->iteration }}" class="accordion-collapse collapse {{$loop->index == 1 ? 'show': ''}}" aria-labelledby="h-{{ $loop->iteration }}"  data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                           {{ strLimit(strip_tags(@$item->data_values->answer),350) }}
                        </div>
                      </div>
                    </div>
                    @endif
                    @endforeach

                  </div>
            </div>
        </div>
    </div>
</section>
<!-- ==================== Accordion End Here ==================== -->

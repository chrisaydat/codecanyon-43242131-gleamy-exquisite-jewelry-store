@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body px-4">
                    <form action="{{route('admin.product.store')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <div class="col-md-3 col-xs-4 d-flex align-items-center">
                                        <label class="required"> @lang('Product Name')</label>
                                    </div>
                                    <div class="col-md-9 col-xs-12">
                                        <input class="form-control" type="text" name="name" required>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 col-xs-4 d-flex align-items-center">
                                        <label class="required"> @lang('Product Price')</label>
                                    </div>
                                    <div class="col-md-9 col-xs-12">
                                        <input class="form-control" type="number" name="price" required>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 col-xs-4 d-flex align-items-center">
                                        <label> @lang('Discount Price')%</label>
                                    </div>
                                    <div class="col-md-9 col-xs-12">
                                        <input class="form-control" type="number" name="discount">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-3 col-xs-4 d-flex align-items-center">
                                        <label class="required"> @lang('Product Quantity')</label>
                                    </div>
                                    <div class="col-md-9 col-xs-12">
                                        <input class="form-control" type="number" name="quantity" required>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-3 col-xs-4 d-flex align-items-center">
                                        <label> @lang('Product Weight')</label>
                                    </div>
                                    <div class="col-md-9 col-xs-12">
                                        <input class="form-control" type="text" name="weight" >
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-3 col-xs-4 d-flex align-items-center">
                                        <label> @lang('Product Purity')</label>
                                    </div>
                                    <div class="col-md-9 col-xs-12">
                                        <input class="form-control" type="text" name="purity" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <div class="col-md-3 col-xs-4 d-flex align-items-center">
                                        <label> @lang('Product Category')</label>
                                    </div>
                                    <div class="col-md-9 col-xs-12">
                                        <select class="form-control" name="category_id">
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{ __($category->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 col-xs-4 d-flex align-items-center">
                                        <label> @lang('Product Per Gram Rate')</label>
                                    </div>
                                    <div class="col-md-9 col-xs-12">
                                        <input class="form-control" type="text" name="pergram_rate">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 col-xs-4 d-flex align-items-center">
                                        <label> @lang('Product Short Description')</label>
                                    </div>
                                    <div class="col-md-9 col-xs-12">
                                        <textarea class="form-control" name="short_details" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 col-xs-4 d-flex align-items-center">
                                        <label class="required"> @lang('Product Images')</label>
                                    </div>
                                    <div class="col-8">
                                        <div class="file-upload-wrapper" data-text="@lang('Select your image!')">
                                            <input type="file" name="images[]" id="inputAttachments"
                                                class="file-upload-field" />
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <button type="button" class="btn btn--white extraTicketAttachment ms-0"><i
                                                class="fa fa-plus"></i></button>
                                    </div>
                                    <div class="col-12">
                                        <div id="fileUploadsContainer"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="form-group col-md-2 col-sm-6 mb-4">
                                <label class="fw-bold">@lang('Status')</label>
                                <label class="switch m-0">
                                    <input type="checkbox" class="toggle-switch" name="status">
                                    <span class="slider round"></span>
                                </label>
                            </div>

                            <div class="form-group col-md-2 col-sm-6 mb-4">
                                <label class="fw-bold">@lang('Featured')</label>
                                <label class="switch m-0">
                                    <input type="checkbox" class="toggle-switch" name="featured">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-end">
                                <button type="submit" class="btn btn--primary btn-global">@lang('Save')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <a href="{{ route('admin.products') }}" lass="btn btn-sm btn--primary "><i class="las la-arrow-left"></i>@lang('Back')</a>
@endpush


@push('script')
    <script>
        (function ($) {
        "use strict";

        var fileAdded = 0;
        $('.extraTicketAttachment').on('click', function () {
            if (fileAdded >= 2) {
                notify('error', 'You\'ve added maximum number of image');
                return false;
            }
            fileAdded++;
            $("#fileUploadsContainer").append(`
                    <div class="row mb-2">
                        <div class="col-md-3 col-xs-4 d-flex align-items-center">
                        </div>
                        <div class="col-8 mb-3">
                            <div class="file-upload-wrapper" data-text="@lang('Select your image!')"><input type="file" name="images[]" id="inputAttachments" class="file-upload-field"/></div>
                        </div>
                        <div class="col-1">
                            <button type="button" class="btn text--danger extraTicketAttachmentDelete"><i class="la la-times ms-0"></i></button>
                        </div>
                    </div>
                `)
        });
        $(document).on('click', '.extraTicketAttachmentDelete', function () {
            fileAdded--;
            $(this).closest('.row').remove();
        });




    })(jQuery);
    </script>
@endpush

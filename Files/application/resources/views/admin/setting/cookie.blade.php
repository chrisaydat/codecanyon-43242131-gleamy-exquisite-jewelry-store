@extends('admin.layouts.app')
@section('panel')
<div class="row mb-none-30">
  <div class="col-lg-12">
    <div class="card">
      <form action="" method="post">
        @csrf
        <div class="card-body">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>@lang('Status')</label>
                <label class="switch m-0">
                  <input type="checkbox" class="toggle-switch" name="status" {{ @$cookie->data_values->status ?
                  'checked' : null }}>
                  <span class="slider round"></span>
                </label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>@lang('Short Description')</label>
            <textarea class="form-control" rows="5" required
              name="short_desc">{{ @$cookie->data_values->short_desc }}</textarea>
          </div>
          <div class="form-group">
            <label>@lang('Description')</label>
            <textarea class="form-control trumEdit" rows="10"
              name="description">@php echo @$cookie->data_values->description @endphp</textarea>
          </div>
        </div>
        <div class="card-footer text-end">
          <button type="submit" class="btn btn--primary btn-global">@lang('Save')</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('breadcrumb-plugins')
<a href="{{route('admin.frontend.manage.pages')}}" class="btn btn-sm btn--primary addCupon">@lang('Go To Pages')</a>
@endpush
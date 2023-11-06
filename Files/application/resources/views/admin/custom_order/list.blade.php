
@extends('admin.layouts.app')
@section('panel')
<div class="row">
    <div class="col-lg-12">
        <div class="card b-radius--10 ">
            <div class="card-body p-0">
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two custom-data-table">
                        <thead>
                            <tr>
                                <th>@lang('Name')</th>
                                <th>@lang('Email')</th>
                                <th>@lang('Time')</th>
                                <th>@lang('Image')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($customOrders as $item)
                           <tr>
                            <td>{{__($item->name)}}</td>
                            <td>{{__($item->email)}}</td>
                            <td>{{ showDateTime($item->created_at)}}</td>
                            <td><img src="{{ getImage(getFilePath('customProductImages').'/'.$item->path.'/'.@$item->image)}}" alt="Image" class="rounded" style="width:50px;"></td>
                            <td>
                                <a href="{{route('admin.orders.custom.detail',$item->id)}}" class="btn btn-sm btn--primary ms-1" title="details">
                                    <i class="la la-eye"></i>
                                </a>
                            </td>
                         </tr>
                         @empty
                         <tr>
                           <td class="text-muted text-center" colspan="100%">{{__($emptyMessage) }}</td>
                        </tr>
                         @endforelse
                        </tbody>
                    </table><!-- table end -->
                </div>
            </div>
            @if ($customOrders->hasPages())
           <div class="card-footer py-4">
            @php echo paginateLinks($customOrders) @endphp
        </div>
        @endif
        </div><!-- card end -->
    </div>
</div>
@endsection



@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')
@section('content')
<h3 class="page-title">Vendor Details</h3>
@can('vendor_details_create')
<p>
    <a href="{{ route('admin.vendor-details.create') }}" class="btn btn-success">Add new</a>
    <a href="{{ route('admin.vendor-details.export_sample_csv') }}" class="btn btn-success">Sample CSV</a>
    <a href="{{ route('admin.vendor-details.import_vendor_show') }}" class="btn btn-success">Import CSV</a>
    @can('vendor__export')
    <a href="{{ route('admin.vendor-details.export_vendor_csv') }}" class="btn btn-success">Export CSV</a>
    @endcan
</p>
@endcan
@can('vendor_delete')
<p>
    <ul class="list-inline">
        <li><a href="{{ route('admin.vendor-details.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li>
        |
        <li><a href="{{ route('admin.vendor-details.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
    </ul>
</p>
@endcan
<div class="panel panel-default">
    <div class="panel-heading">
        @lang('quickadmin.qa_list')
    </div>
    <div class="panel-body table-responsive">
        <table id="myTable" class="table table-bordered table-striped {{ count($vendor_details) > 0 ? 'datatable' : '' }} @can('vendor_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
            <thead>
                <tr>
                    @can('vendor_delete')
                    @if ( request('show_deleted') != 1 )
                    <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                    @endcan
                    <th>Vendor Code</th>
                    <th>Name(MD)</th>
                    <th>Email(MD)</th>
                    <th>Phone(MD)</th>
                    <th>Connect(MD)</th>

                    <th>Name(Principle)</th>
                    <th>Email(Principle)</th>
                    <th>Phone(Principle)</th>
                    <th>Connect(Principle)</th>

                    <th>Name(Finance)</th>
                    <th>Email(Finance)</th>
                    <th>Phone(Finance)</th>
                    <th>Connect(Finance)</th>

                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($vendor_details) > 0)
                @foreach ($vendor_details as $list)
                <tr data-entry-id="{{ $list->id }}">
                    @can('vendor_delete')
                    @if ( request('show_deleted') != 1 )
                    <td></td>@endif
                    @endcan
                    <td>{{$list->vendor_code}}</td>
                    <td>{{$list->md_name}}</td>
                    <td>{{$list->md_email}}</td>
                    <td>{{$list->md_phone}}</td>
                    <td>{{$list->md_connect}}</td>
                    <td>{{$list->principle_name}}</td>
                    <td>{{$list->principle_email}}</td>
                    <td>{{$list->principle_phone}}</td>
                    <td>{{$list->principle_connect}}</td>
                    <td>{{$list->finance_name}}</td>
                    <td>{{$list->finance_email}}</td>
                    <td>{{$list->finance_phone}}</td>
                    <td>{{$list->finance_connect}}</td>
                    <td>
                        @can('vendor__delete')
                        {!! Form::open(array(
                        'style' => 'display: inline-block;',
                        'method' => 'DELETE',
                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                        'route' => ['admin.vendor-details.perma_del', $list->id])) !!}
                        {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                        {!! Form::close() !!}
                        @endcan
                        @can('vendor_edit')
                        <a href="{{ route('admin.vendor-details.edit',[$list->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                        @endcan
                        @can('vendor_delete')
                        {!! Form::open(array(
                        'style' => 'display: inline-block;',
                        'method' => 'DELETE',
                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                        'route' => ['admin.vendor-details.destroy', $list->id])) !!}
                        {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                        {!! Form::close() !!}
                        @endcan
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="7">@lang('quickadmin.qa_no_entries_in_table')</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@stop
@section('javascript')
<script>
$(document).ready(function() {
    //            var table = $('#myTable_Wrapper').DataTable();
    //console.log(table);
    //            table.button( '.dt-button' ).remove();
})
</script>
<script>
@can('vendor_delete')
@if(request('show_deleted') != 1) window.route_mass_crud_entries_destroy = '{{ route('
admin.folders.mass_destroy ') }}';
@endif
@endcan
</script>
@endsection
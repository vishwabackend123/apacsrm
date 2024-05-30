@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')
@section('content')
<h3 class="page-title">@lang('quickadmin.vendor.title')</h3>
@can('vendor_create')
<p>
    <a href="{{ route('admin.vendors.create') }}" class="btn btn-success">Add new</a>
    <a href="{{ route('admin.vendors.export_sample_csv') }}" class="btn btn-success">Sample CSV</a>
    <a href="{{ route('admin.vendors.import_vendor_show') }}" class="btn btn-success">Import CSV</a>
     @can('vendor__export')
    <a href="{{ route('admin.vendors.export_vendor_csv') }}" class="btn btn-success">Export CSV</a>
    @endcan
</p>
@endcan
@can('vendor_delete')
<p>
    <ul class="list-inline">
        <li><a href="{{ route('admin.vendors.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li>
        |
        <li><a href="{{ route('admin.vendors.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
    </ul>
</p>
@endcan
<div class="panel panel-default">
    <div class="panel-heading">
        @lang('quickadmin.qa_list')
    </div>
    <div class="panel-body table-responsive">
        <table id="myTable" class="table table-bordered table-striped {{ count($vendors) > 0 ? 'datatable' : '' }} @can('folder_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
            <thead>
                <tr>
                    @can('vendor_delete')
                    @if ( request('show_deleted') != 1 )
                    <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                    @endcan
                    <th>Vendor Code</th>
                    <th>ABC Analysis</th>
                    <th>Vendor Name</th>
                    <th>Vendor Website</th>
                    <th>Vendor Country</th>
                    <th>Vendor City</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($vendors) > 0)
                @foreach ($vendors as $folder)
                <tr data-entry-id="{{ $folder->id }}">
                    @can('vendor_delete')
                    @if ( request('show_deleted') != 1 )
                    <td></td>@endif
                    @endcan
                    <td>{{$folder->vendor_code}}</td>
                    <td>{{$folder->analysis}}</td>
                    <td>{{$folder->vendor_name}}</td>
                    <td>{{$folder->vendor_website}}</td>
                    <td>{{$folder->vendor_country}}</td>
                    <td>{{$folder->vendor_city}}</td>
                    <td>
                        @can('vendor__delete')
                        {!! Form::open(array(
                        'style' => 'display: inline-block;',
                        'method' => 'DELETE',
                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                        'route' => ['admin.vendors.perma_del', $folder->id])) !!}
                        {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                        {!! Form::close() !!}
                        @endcan
                        @can('vendor_edit')
                        <a href="{{ route('admin.vendors.edit',[$folder->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                        @endcan
                        @can('vendor_delete')
                        {!! Form::open(array(
                        'style' => 'display: inline-block;',
                        'method' => 'DELETE',
                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                        'route' => ['admin.vendors.destroy', $folder->id])) !!}
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
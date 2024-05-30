@extends('layouts.app')

@section('content')
    <h3 class="page-title">Vendor Details</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.vendor-details.import_csv'],'files' => true]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            Vendor Details CSV Import
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('vendor_file', "File *", ['class' => 'control-label']) !!}
                    {!! Form::file('vendor_file', old('vendor_file'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'id' => 'vendor_file']) !!}
                    <p class="help-block" id="vendor_code_error"></p>
                    @if($errors->has('vendor_file'))
                        <p class="help-block">
                            {{ $errors->first('vendor_file') }}
                        </p>
                    @endif
                </div>
            </div>
           
            
           
            
            
        </div>
        
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop


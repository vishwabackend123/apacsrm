@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.vendor.title')</h3>
    
    {!! Form::model($vendorEdit, ['method' => 'PUT', 'route' => ['admin.vendors.update', $vendorEdit->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('vendor_code', 'Vendor Code *', ['class' => 'control-label']) !!}
                    {!! Form::text('vendor_code', old('vendor_code'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('vendor_code'))
                        <p class="help-block">
                            {{ $errors->first('vendor_code') }}
                        </p>
                    @endif
                </div>
            </div>
             <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('analysis', "ABC Analysis *", ['class' => 'control-label']) !!}
                    {!! Form::text('analysis', old('analysis'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'id' => 'analysis']) !!}
                    <p class="help-block" id="analysis_error"></p>
                    @if($errors->has('analysis'))
                        <p class="help-block">
                            {{ $errors->first('analysis') }}
                        </p>
                    @endif
                </div>
            </div>
                        <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('vendor_name', "Vendor Name *", ['class' => 'control-label']) !!}
                    {!! Form::text('vendor_name', old('vendor_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'id' => 'vendor_name']) !!}
                    <p class="help-block" id="vendor_name_error"></p>
                    @if($errors->has('vendor_name'))
                        <p class="help-block">
                            {{ $errors->first('vendor_name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('vendor_website', "Vendor Website *", ['class' => 'control-label']) !!}
                    {!! Form::text('vendor_website', old('vendor_website'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'id' => 'vendor_website']) !!}
                    <p class="help-block" id="vendor_website_error"></p>
                    @if($errors->has('vendor_website'))
                        <p class="help-block">
                            {{ $errors->first('vendor_website') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('vendor_country', "Vendor Country *", ['class' => 'control-label']) !!}
                    {!! Form::text('vendor_country', old('vendor_country'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'id' => 'vendor_country']) !!}
                    <p class="help-block" id="vendor_country_error"></p>
                    @if($errors->has('vendor_country'))
                        <p class="help-block">
                            {{ $errors->first('vendor_country') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('vendor_city', "Vendor City *", ['class' => 'control-label']) !!}
                    {!! Form::text('vendor_city', old('vendor_city'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'id' => 'vendor_city']) !!}
                    <p class="help-block" id="vendor_city_error"></p>
                    @if($errors->has('vendor_city'))
                        <p class="help-block">
                            {{ $errors->first('vendor_city') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop


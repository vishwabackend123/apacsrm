@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.vendor.title')</h3>
    
    {!! Form::model($vendorEdit, ['method' => 'PUT', 'route' => ['admin.vendor-details.update', $vendorEdit->id]]) !!}


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('vendor_code', "Vendor Code *", ['class' => 'control-label']) !!}
                    {!! Form::text('vendor_code', old('vendor_code'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'id' => 'vendor_code']) !!}
                    <p class="help-block" id="vendor_code_error"></p>
                    @if($errors->has('vendor_code'))
                        <p class="help-block">
                            {{ $errors->first('vendor_code') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('md_name', "Name(MD) *", ['class' => 'control-label']) !!}
                    {!! Form::text('md_name', old('md_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'id' => 'md_name']) !!}
                    <p class="help-block" id="analysis_error"></p>
                    @if($errors->has('md_name'))
                        <p class="help-block">
                            {{ $errors->first('md_name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('md_email', "Email(MD) *", ['class' => 'control-label']) !!}
                    {!! Form::text('md_email', old('md_email'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'id' => 'md_email']) !!}
                    <p class="help-block" id="vendor_name_error"></p>
                    @if($errors->has('md_email'))
                        <p class="help-block">
                            {{ $errors->first('md_email') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('md_phone', "Phone(MD) *", ['class' => 'control-label']) !!}
                    {!! Form::text('md_phone', old('md_phone'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'id' => 'md_phone']) !!}
                    <p class="help-block" id="vendor_website_error"></p>
                    @if($errors->has('md_phone'))
                        <p class="help-block">
                            {{ $errors->first('md_phone') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('md_connect', "LinedIn Connect(MD) *", ['class' => 'control-label']) !!}
                    {!! Form::text('md_connect', old('md_connect'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'id' => 'md_connect']) !!}
                    <p class="help-block" id="vendor_country_error"></p>
                    @if($errors->has('md_connect'))
                        <p class="help-block">
                            {{ $errors->first('md_connect') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('principle_name', "Name(Principle) *", ['class' => 'control-label']) !!}
                    {!! Form::text('principle_name', old('principle_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'id' => 'principle_name']) !!}
                    <p class="help-block" id="vendor_city_error"></p>
                    @if($errors->has('principle_name'))
                        <p class="help-block">
                            {{ $errors->first('principle_name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('principle_email', "Email(Principle) *", ['class' => 'control-label']) !!}
                    {!! Form::text('principle_email', old('principle_email'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'id' => 'principle_email']) !!}
                    <p class="help-block" id="vendor_city_error"></p>
                    @if($errors->has('principle_email'))
                        <p class="help-block">
                            {{ $errors->first('principle_email') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('principle_phone', "Phone(Principle) *", ['class' => 'control-label']) !!}
                    {!! Form::text('principle_phone', old('principle_phone'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'id' => 'principle_phone']) !!}
                    <p class="help-block" id="vendor_city_error"></p>
                    @if($errors->has('principle_phone'))
                        <p class="help-block">
                            {{ $errors->first('principle_phone') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('principle_connect', "LinedIn Connect(Principle) *", ['class' => 'control-label']) !!}
                    {!! Form::text('principle_connect', old('principle_connect'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'id' => 'principle_connect']) !!}
                    <p class="help-block" id="vendor_city_error"></p>
                    @if($errors->has('principle_connect'))
                        <p class="help-block">
                            {{ $errors->first('principle_connect') }}
                        </p>
                    @endif
                </div>
            </div>
             <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('finance_name', "Name(Finance) *", ['class' => 'control-label']) !!}
                    {!! Form::text('finance_name', old('finance_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'id' => 'finance_name']) !!}
                    <p class="help-block" id="vendor_city_error"></p>
                    @if($errors->has('finance_name'))
                        <p class="help-block">
                            {{ $errors->first('finance_name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('finance_email', "Email(Finance) *", ['class' => 'control-label']) !!}
                    {!! Form::text('finance_email', old('finance_email'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'id' => 'finance_email']) !!}
                    <p class="help-block" id="vendor_city_error"></p>
                    @if($errors->has('finance_email'))
                        <p class="help-block">
                            {{ $errors->first('finance_email') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('finance_phone', "Phone(Finance) *", ['class' => 'control-label']) !!}
                    {!! Form::text('finance_phone', old('finance_phone'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'id' => 'finance_phone']) !!}
                    <p class="help-block" id="vendor_city_error"></p>
                    @if($errors->has('finance_phone'))
                        <p class="help-block">
                            {{ $errors->first('finance_phone') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('finance_connect', "LinedIn Connect(Finance) *", ['class' => 'control-label']) !!}
                    {!! Form::text('finance_connect', old('finance_connect'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'id' => 'finance_connect']) !!}
                    <p class="help-block" id="vendor_city_error"></p>
                    @if($errors->has('finance_connect'))
                        <p class="help-block">
                            {{ $errors->first('finance_connect') }}
                        </p>
                    @endif
                </div>
            </div>
             <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('head_name', "Name(Head Purchase) *", ['class' => 'control-label']) !!}
                    {!! Form::text('head_name', old('head_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'id' => 'head_name']) !!}
                    <p class="help-block" id="vendor_city_error"></p>
                    @if($errors->has('head_name'))
                        <p class="help-block">
                            {{ $errors->first('head_name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('head_email', "Email(Head Purchase) *", ['class' => 'control-label']) !!}
                    {!! Form::text('head_email', old('head_email'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'id' => 'head_email']) !!}
                    <p class="help-block" id="vendor_city_error"></p>
                    @if($errors->has('head_email'))
                        <p class="help-block">
                            {{ $errors->first('head_email') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('head_phone', "Phone(Head Purchase) *", ['class' => 'control-label']) !!}
                    {!! Form::text('head_phone', old('head_phone'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'id' => 'head_phone']) !!}
                    <p class="help-block" id="vendor_city_error"></p>
                    @if($errors->has('head_phone'))
                        <p class="help-block">
                            {{ $errors->first('head_phone') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('head_connect', "LinedIn Connect(Head Purchase) *", ['class' => 'control-label']) !!}
                    {!! Form::text('head_connect', old('head_connect'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'id' => 'head_connect']) !!}
                    <p class="help-block" id="vendor_city_error"></p>
                    @if($errors->has('head_connect'))
                        <p class="help-block">
                            {{ $errors->first('head_connect') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop


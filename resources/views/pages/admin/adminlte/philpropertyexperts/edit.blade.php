@extends('layouts.admin.' . config('view.admin') . '.application', ['menu' => 'philpropertyexperts'] )

@section('metadata')
@stop

@section('styles')
    <link rel="stylesheet" href="{!! \URLHelper::asset('libs/datetimepicker/css/bootstrap-datetimepicker.min.css', 'admin') !!}">
@stop

@section('scripts')
    <script src="{{ \URLHelper::asset('libs/moment/moment.min.js', 'admin') }}"></script>
    <script src="{{ \URLHelper::asset('libs/datetimepicker/js/bootstrap-datetimepicker.min.js', 'admin') }}"></script>
    <script>
        $('.datetime-field').datetimepicker({'format': 'YYYY-MM-DD HH:mm:ss', 'defaultDate': new Date()});

        $(document).ready(function () {
            
        });
    </script>
@stop

@section('title')
@stop

@section('header')
    Philpropertyexperts
@stop

@section('breadcrumb')
    <li><a href="{!! action('Admin\PhilpropertyexpertController@index') !!}"><i class="fa fa-files-o"></i> Philpropertyexperts</a></li>
    @if( $isNew )
        <li class="active">New</li>
    @else
        <li class="active">{{ $philpropertyexpert->id }}</li>
    @endif
@stop

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="@if($isNew) {!! action('Admin\PhilpropertyexpertController@store') !!} @else {!! action('Admin\PhilpropertyexpertController@update', [$philpropertyexpert->id]) !!} @endif" method="POST" enctype="multipart/form-data">
        @if( !$isNew ) <input type="hidden" name="_method" value="PUT"> @endif
        {!! csrf_field() !!}

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <a href="{!! URL::action('Admin\PhilpropertyexpertController@index') !!}" class="btn btn-block btn-default btn-sm" style="width: 125px;">@lang('admin.pages.common.buttons.back')</a>
                </h3>
            </div>
            <div class="box-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('title')) has-error @endif">
                            <label for="title">@lang('admin.pages.philpropertyexperts.columns.title')</label>
                            <input type="text" class="form-control" id="title" name="title" required
                                   value="{{ old('title') ? old('title') : $philpropertyexpert->title }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('postal_code')) has-error @endif">
                            <label for="postal_code">@lang('admin.pages.philpropertyexperts.columns.postal_code')</label>
                            <input type="text" class="form-control" id="postal_code" name="postal_code" required
                                   value="{{ old('postal_code') ? old('postal_code') : $philpropertyexpert->postal_code }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('country')) has-error @endif">
                            <label for="country">@lang('admin.pages.philpropertyexperts.columns.country')</label>
                            <input type="text" class="form-control" id="country" name="country" required
                                   value="{{ old('country') ? old('country') : $philpropertyexpert->country }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('province')) has-error @endif">
                            <label for="province">@lang('admin.pages.philpropertyexperts.columns.province')</label>
                            <input type="text" class="form-control" id="province" name="province" required
                                   value="{{ old('province') ? old('province') : $philpropertyexpert->province }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('city')) has-error @endif">
                            <label for="city">@lang('admin.pages.philpropertyexperts.columns.city')</label>
                            <input type="text" class="form-control" id="city" name="city" required
                                   value="{{ old('city') ? old('city') : $philpropertyexpert->city }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('address')) has-error @endif">
                            <label for="address">@lang('admin.pages.philpropertyexperts.columns.address')</label>
                            <input type="text" class="form-control" id="address" name="address" required
                                   value="{{ old('address') ? old('address') : $philpropertyexpert->address }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('building_type')) has-error @endif">
                            <label for="building_type">@lang('admin.pages.philpropertyexperts.columns.building_type')</label>
                            <input type="text" class="form-control" id="building_type" name="building_type" required
                                   value="{{ old('building_type') ? old('building_type') : $philpropertyexpert->building_type }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('latitude')) has-error @endif">
                            <label for="latitude">@lang('admin.pages.philpropertyexperts.columns.latitude')</label>
                            <input type="text" class="form-control" id="latitude" name="latitude" required
                                   value="{{ old('latitude') ? old('latitude') : $philpropertyexpert->latitude }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('longitude')) has-error @endif">
                            <label for="longitude">@lang('admin.pages.philpropertyexperts.columns.longitude')</label>
                            <input type="text" class="form-control" id="longitude" name="longitude" required
                                   value="{{ old('longitude') ? old('longitude') : $philpropertyexpert->longitude }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('completion_year')) has-error @endif">
                            <label for="completion_year">@lang('admin.pages.philpropertyexperts.columns.completion_year')</label>
                            <input type="text" class="form-control" id="completion_year" name="completion_year" required
                                   value="{{ old('completion_year') ? old('completion_year') : $philpropertyexpert->completion_year }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('number_floor')) has-error @endif">
                            <label for="number_floor">@lang('admin.pages.philpropertyexperts.columns.number_floor')</label>
                            <input type="text" class="form-control" id="number_floor" name="number_floor" required
                                   value="{{ old('number_floor') ? old('number_floor') : $philpropertyexpert->number_floor }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('number_unit')) has-error @endif">
                            <label for="number_unit">@lang('admin.pages.philpropertyexperts.columns.number_unit')</label>
                            <input type="text" class="form-control" id="number_unit" name="number_unit" required
                                   value="{{ old('number_unit') ? old('number_unit') : $philpropertyexpert->number_unit }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('developer_name')) has-error @endif">
                            <label for="developer_name">@lang('admin.pages.philpropertyexperts.columns.developer_name')</label>
                            <input type="text" class="form-control" id="developer_name" name="developer_name" required
                                   value="{{ old('developer_name') ? old('developer_name') : $philpropertyexpert->developer_name }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('facilities')) has-error @endif">
                            <label for="facilities">@lang('admin.pages.philpropertyexperts.columns.facilities')</label>
                            <textarea name="facilities" class="form-control" rows="5" required
                                      placeholder="@lang('admin.pages.philpropertyexperts.columns.facilities')">{{ old('facilities') ? old('facilities') : $philpropertyexpert->facilities }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('unit_size')) has-error @endif">
                            <label for="unit_size">@lang('admin.pages.philpropertyexperts.columns.unit_size')</label>
                            <input type="text" class="form-control" id="unit_size" name="unit_size" required
                                   value="{{ old('unit_size') ? old('unit_size') : $philpropertyexpert->unit_size }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('condo_url')) has-error @endif">
                            <label for="condo_url">@lang('admin.pages.philpropertyexperts.columns.condo_url')</label>
                            <input type="text" class="form-control" id="condo_url" name="condo_url" required
                                   value="{{ old('condo_url') ? old('condo_url') : $philpropertyexpert->condo_url }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('developer_url')) has-error @endif">
                            <label for="developer_url">@lang('admin.pages.philpropertyexperts.columns.developer_url')</label>
                            <input type="text" class="form-control" id="developer_url" name="developer_url" required
                                   value="{{ old('developer_url') ? old('developer_url') : $philpropertyexpert->developer_url }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('descriptions')) has-error @endif">
                            <label for="descriptions">@lang('admin.pages.philpropertyexperts.columns.descriptions')</label>
                            <textarea name="descriptions" class="form-control" rows="5" required
                                      placeholder="@lang('admin.pages.philpropertyexperts.columns.descriptions')">{{ old('descriptions') ? old('descriptions') : $philpropertyexpert->descriptions }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group @if ($errors->has('image_url')) has-error @endif">
                            <label for="image_url">@lang('admin.pages.condominiumsmanilas.columns.image_url')</label>
                            <input type="text" class="form-control" id="image_url" name="image_url"
                                   value="{{ old('image_url') ? old('image_url') : $philpropertyexpert->image_url }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        @if( !empty($philpropertyexpert->image_url) )
                            <img id="profile-image-preview" style="max-width: 500px; width: 100%;" src="{!! $philpropertyexpert->image_url !!}" alt="" class="margin"/>
                        @else
                            <img id="profile-image-preview" style="max-width: 500px; width: 100%;" src="{!! \URLHelper::asset('img/no_image.jpg', 'common') !!}" alt="" class="margin"/>
                        @endif
                    </div>
                </div>

            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-sm" style="width: 125px;">@lang('admin.pages.common.buttons.save')</button>
            </div>
        </div>
    </form>
@stop

@extends('layouts.admin.' . config('view.admin') . '.application', ['menu' => 'phrealestates'] )

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
    Phrealestates
@stop

@section('breadcrumb')
    <li><a href="{!! action('Admin\PhrealestateController@index') !!}"><i class="fa fa-files-o"></i> Phrealestates</a></li>
    @if( $isNew )
        <li class="active">New</li>
    @else
        <li class="active">{{ $phrealestate->id }}</li>
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

    <form action="@if($isNew) {!! action('Admin\PhrealestateController@store') !!} @else {!! action('Admin\PhrealestateController@update', [$phrealestate->id]) !!} @endif" method="POST" enctype="multipart/form-data">
        @if( !$isNew ) <input type="hidden" name="_method" value="PUT"> @endif
        {!! csrf_field() !!}

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <a href="{!! URL::action('Admin\PhrealestateController@index') !!}" class="btn btn-block btn-default btn-sm" style="width: 125px;">@lang('admin.pages.common.buttons.back')</a>
                </h3>
            </div>
            <div class="box-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('title')) has-error @endif">
                            <label for="title">@lang('admin.pages.phrealestates.columns.title')</label>
                            <input type="text" class="form-control" id="title" name="title"
                                   value="{{ old('title') ? old('title') : $phrealestate->title }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('postal_code')) has-error @endif">
                            <label for="postal_code">@lang('admin.pages.phrealestates.columns.postal_code')</label>
                            <input type="text" class="form-control" id="postal_code" name="postal_code"
                                   value="{{ old('postal_code') ? old('postal_code') : $phrealestate->postal_code }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('country')) has-error @endif">
                            <label for="country">@lang('admin.pages.phrealestates.columns.country')</label>
                            <input type="text" class="form-control" id="country" name="country"
                                   value="{{ old('country') ? old('country') : $phrealestate->country }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('province')) has-error @endif">
                            <label for="province">@lang('admin.pages.phrealestates.columns.province')</label>
                            <input type="text" class="form-control" id="province" name="province"
                                   value="{{ old('province') ? old('province') : $phrealestate->province }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('city')) has-error @endif">
                            <label for="city">@lang('admin.pages.phrealestates.columns.city')</label>
                            <input type="text" class="form-control" id="city" name="city"
                                   value="{{ old('city') ? old('city') : $phrealestate->city }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('address')) has-error @endif">
                            <label for="address">@lang('admin.pages.phrealestates.columns.address')</label>
                            <input type="text" class="form-control" id="address" name="address"
                                   value="{{ old('address') ? old('address') : $phrealestate->address }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('building_type')) has-error @endif">
                            <label for="building_type">@lang('admin.pages.phrealestates.columns.building_type')</label>
                            <input type="text" class="form-control" id="building_type" name="building_type"
                                   value="{{ old('building_type') ? old('building_type') : $phrealestate->building_type }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('latitude')) has-error @endif">
                            <label for="latitude">@lang('admin.pages.phrealestates.columns.latitude')</label>
                            <input type="text" class="form-control" id="latitude" name="latitude"
                                   value="{{ old('latitude') ? old('latitude') : $phrealestate->latitude }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('longitude')) has-error @endif">
                            <label for="longitude">@lang('admin.pages.phrealestates.columns.longitude')</label>
                            <input type="text" class="form-control" id="longitude" name="longitude"
                                   value="{{ old('longitude') ? old('longitude') : $phrealestate->longitude }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('completion_year')) has-error @endif">
                            <label for="completion_year">@lang('admin.pages.phrealestates.columns.completion_year')</label>
                            <input type="text" class="form-control" id="completion_year" name="completion_year"
                                   value="{{ old('completion_year') ? old('completion_year') : $phrealestate->completion_year }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('number_floor')) has-error @endif">
                            <label for="number_floor">@lang('admin.pages.phrealestates.columns.number_floor')</label>
                            <input type="text" class="form-control" id="number_floor" name="number_floor"
                                   value="{{ old('number_floor') ? old('number_floor') : $phrealestate->number_floor }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('number_unit')) has-error @endif">
                            <label for="number_unit">@lang('admin.pages.phrealestates.columns.number_unit')</label>
                            <input type="text" class="form-control" id="number_unit" name="number_unit"
                                   value="{{ old('number_unit') ? old('number_unit') : $phrealestate->number_unit }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('developer_name')) has-error @endif">
                            <label for="developer_name">@lang('admin.pages.phrealestates.columns.developer_name')</label>
                            <input type="text" class="form-control" id="developer_name" name="developer_name"
                                   value="{{ old('developer_name') ? old('developer_name') : $phrealestate->developer_name }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('facilities')) has-error @endif">
                            <label for="facilities">@lang('admin.pages.phrealestates.columns.facilities')</label>
                            <textarea name="facilities" class="form-control" rows="5"
                                      placeholder="@lang('admin.pages.phrealestates.columns.facilities')">{{ old('facilities') ? old('facilities') : $phrealestate->facilities }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('unit_size')) has-error @endif">
                            <label for="unit_size">@lang('admin.pages.phrealestates.columns.unit_size')</label>
                            <input type="text" class="form-control" id="unit_size" name="unit_size"
                                   value="{{ old('unit_size') ? old('unit_size') : $phrealestate->unit_size }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('condo_url')) has-error @endif">
                            <label for="condo_url">@lang('admin.pages.phrealestates.columns.condo_url')</label>
                            <input type="text" class="form-control" id="condo_url" name="condo_url"
                                   value="{{ old('condo_url') ? old('condo_url') : $phrealestate->condo_url }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('developer_url')) has-error @endif">
                            <label for="developer_url">@lang('admin.pages.phrealestates.columns.developer_url')</label>
                            <input type="text" class="form-control" id="developer_url" name="developer_url" 
                                   value="{{ old('developer_url') ? old('developer_url') : $phrealestate->developer_url }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('descriptions')) has-error @endif">
                            <label for="descriptions">@lang('admin.pages.condominiumsmanilas.columns.descriptions')</label>
                            <textarea name="descriptions" class="form-control" rows="5" placeholder="@lang('admin.pages.condominiumsmanilas.columns.descriptions')">{{ old('descriptions') ? old('descriptions') : $phrealestate->descriptions }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group @if ($errors->has('image_url')) has-error @endif">
                            <label for="image_url">@lang('admin.pages.condominiumsmanilas.columns.image_url')</label>
                            <input type="text" class="form-control" id="image_url" name="image_url"
                                   value="{{ old('image_url') ? old('image_url') : $phrealestate->image_url }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        @if( !empty($phrealestate->image_url) )
                            <img id="profile-image-preview" style="max-width: 500px; width: 100%;" src="{!! $phrealestate->image_url !!}" alt="" class="margin"/>
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

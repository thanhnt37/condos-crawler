@extends('layouts.admin.' . config('view.admin') . '.application', ['menu' => 'propertyasia'] )

@section('metadata')
@stop

@section('styles')
@stop

@section('scripts')
<script src="{!! \URLHelper::asset('js/delete_item.js', 'admin') !!}"></script>
@stop

@section('title')
@stop

@section('header')
Propertyasia
@stop

@section('breadcrumb')
<li class="active">Propertyasia</li>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">

        <div class="row">
            <div class="col-sm-6">
                <h3 class="box-title">
                    <p class="text-right">
                        <a href="{!! action('Admin\PropertyasiaController@create') !!}" class="btn btn-block btn-primary btn-sm" style="width: 125px;">@lang('admin.pages.common.buttons.create')</a>
                    </p>
                </h3>

                <form method="get" accept-charset="utf-8" action="{!! action('Admin\PropertyasiaController@index') !!}">
                    {!! csrf_field() !!}
                    <div class="row search-input">
                        <div class="col-md-12" style="margin-bottom: 10px;">
                            <div class="search-input-text">
                                <input type="text" name="l_search_keyword" class="form-control" placeholder="Search here" id="l-search-keyword" value="{{ $keyword }}">
                                <button type="submit" class="btn">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <br>
                <p style="display: inline-block;">@lang('admin.pages.common.label.search_results', ['count' => $count])</p>
            </div>
            <div class="col-sm-6 wrap-top-pagination">
                <div class="heading-page-pagination">
                    {!! \PaginationHelper::render($paginate['order'], $paginate['direction'], $paginate['offset'], $paginate['limit'], $count, $paginate['baseUrl'], [], $count, 'shared.topPagination') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="box-body" style=" overflow-x: scroll; ">
        <table class="table table-bordered">
            <tr>
                <th style="width: 10px">{!! \PaginationHelper::sort('id', 'ID') !!}</th>
                <th>{!! \PaginationHelper::sort('title', trans('admin.pages.propertyasia.columns.title')) !!}</th>
                <th>{!! \PaginationHelper::sort('postal_code', trans('admin.pages.propertyasia.columns.postal_code')) !!}</th>
                <th>{!! \PaginationHelper::sort('country', trans('admin.pages.propertyasia.columns.country')) !!}</th>
                <th>{!! \PaginationHelper::sort('province', trans('admin.pages.propertyasia.columns.province')) !!}</th>
                <th>{!! \PaginationHelper::sort('city', trans('admin.pages.propertyasia.columns.city')) !!}</th>
                <th>{!! \PaginationHelper::sort('address', trans('admin.pages.propertyasia.columns.address')) !!}</th>
                <th>{!! \PaginationHelper::sort('building_type', trans('admin.pages.propertyasia.columns.building_type')) !!}</th>
                <th>{!! \PaginationHelper::sort('completion_year', trans('admin.pages.propertyasia.columns.completion_year')) !!}</th>
                <th>{!! \PaginationHelper::sort('number_floor', trans('admin.pages.propertyasia.columns.number_floor')) !!}</th>
                <th>{!! \PaginationHelper::sort('number_unit', trans('admin.pages.propertyasia.columns.number_unit')) !!}</th>
                <th>{!! \PaginationHelper::sort('developer_name', trans('admin.pages.propertyasia.columns.developer_name')) !!}</th>

                <th style="width: 40px">@lang('admin.pages.common.label.actions')</th>
            </tr>
            @foreach( $propertyasias as $propertyasia )
                <tr>
                    <td>{{ $propertyasia->id }}</td>
                    <td>{{ $propertyasia->title }}</td>
                    <td>{{ $propertyasia->postal_code }}</td>
                    <td>{{ $propertyasia->country }}</td>
                    <td>{{ $propertyasia->province }}</td>
                    <td>{{ $propertyasia->city }}</td>
                    <td>{{ $propertyasia->address }}</td>
                    <td>{{ $propertyasia->building_type }}</td>
                    <td>{{ $propertyasia->completion_year }}</td>
                    <td>{{ $propertyasia->number_floor }}</td>
                    <td>{{ $propertyasia->number_unit }}</td>
                    <td>{{ $propertyasia->developer_name }}</td>

                    <td>
                        <a href="{!! action('Admin\PropertyasiaController@show', $propertyasia->id) !!}"
                           class="btn btn-block btn-primary btn-xs">@lang('admin.pages.common.buttons.edit')</a>
                        <a href="#" class="btn btn-block btn-danger btn-xs delete-button"
                           data-delete-url="{!! action('Admin\PropertyasiaController@destroy', $propertyasia->id) !!}">@lang('admin.pages.common.buttons.delete')</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="box-footer">
        {!! \PaginationHelper::render($paginate['order'], $paginate['direction'], $paginate['offset'], $paginate['limit'], $count, $paginate['baseUrl'], []) !!}
    </div>
</div>
@stop
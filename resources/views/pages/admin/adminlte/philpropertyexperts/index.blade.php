@extends('layouts.admin.' . config('view.admin') . '.application', ['menu' => 'philpropertyexperts'] )

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
Philpropertyexperts
@stop

@section('breadcrumb')
<li class="active">Philpropertyexperts</li>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">

        <div class="row">
            <div class="col-sm-6">
                <h3 class="box-title">
                    <p class="text-right">
                        <a href="{!! action('Admin\PhilpropertyexpertController@create') !!}" class="btn btn-block btn-primary btn-sm" style="width: 125px;">@lang('admin.pages.common.buttons.create')</a>
                    </p>
                </h3>
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
                <th>{!! \PaginationHelper::sort('title', trans('admin.pages.philpropertyexperts.columns.title')) !!}</th>
                <th>{!! \PaginationHelper::sort('postal_code', trans('admin.pages.philpropertyexperts.columns.postal_code')) !!}</th>
                <th>{!! \PaginationHelper::sort('country', trans('admin.pages.philpropertyexperts.columns.country')) !!}</th>
                <th>{!! \PaginationHelper::sort('province', trans('admin.pages.philpropertyexperts.columns.province')) !!}</th>
                <th>{!! \PaginationHelper::sort('city', trans('admin.pages.philpropertyexperts.columns.city')) !!}</th>
                <th>{!! \PaginationHelper::sort('address', trans('admin.pages.philpropertyexperts.columns.address')) !!}</th>
                <th>{!! \PaginationHelper::sort('building_type', trans('admin.pages.philpropertyexperts.columns.building_type')) !!}</th>
                <th>{!! \PaginationHelper::sort('completion_year', trans('admin.pages.philpropertyexperts.columns.completion_year')) !!}</th>
                <th>{!! \PaginationHelper::sort('number_floor', trans('admin.pages.philpropertyexperts.columns.number_floor')) !!}</th>
                <th>{!! \PaginationHelper::sort('number_unit', trans('admin.pages.philpropertyexperts.columns.number_unit')) !!}</th>
                <th>{!! \PaginationHelper::sort('developer_name', trans('admin.pages.philpropertyexperts.columns.developer_name')) !!}</th>

                <th style="width: 40px">@lang('admin.pages.common.label.actions')</th>
            </tr>
            @foreach( $philpropertyexperts as $philpropertyexpert )
                <tr>
                    <td>{{ $philpropertyexpert->id }}</td>
                    <td>{{ $philpropertyexpert->title }}</td>
                    <td>{{ $philpropertyexpert->postal_code }}</td>
                    <td>{{ $philpropertyexpert->country }}</td>
                    <td>{{ $philpropertyexpert->province }}</td>
                    <td>{{ $philpropertyexpert->city }}</td>
                    <td>{{ $philpropertyexpert->address }}</td>
                    <td>{{ $philpropertyexpert->building_type }}</td>
                    <td>{{ $philpropertyexpert->completion_year }}</td>
                    <td>{{ $philpropertyexpert->number_floor }}</td>
                    <td>{{ $philpropertyexpert->number_unit }}</td>
                    <td>{{ $philpropertyexpert->developer_name }}</td>

                    <td>
                        <a href="{!! action('Admin\PhilpropertyexpertController@show', $philpropertyexpert->id) !!}"
                           class="btn btn-block btn-primary btn-xs">@lang('admin.pages.common.buttons.edit')</a>
                        <a href="#" class="btn btn-block btn-danger btn-xs delete-button"
                           data-delete-url="{!! action('Admin\PhilpropertyexpertController@destroy', $philpropertyexpert->id) !!}">@lang('admin.pages.common.buttons.delete')</a>
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
@extends('layouts.admin.' . config('view.admin') . '.application', ['menu' => 'presellings'] )

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
Presellings
@stop

@section('breadcrumb')
<li class="active">Presellings</li>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">

        <div class="row">
            <div class="col-sm-6">
                <h3 class="box-title">
                    <p class="text-right">
                        <a href="{!! action('Admin\PresellingController@create') !!}" class="btn btn-block btn-primary btn-sm" style="width: 125px;">@lang('admin.pages.common.buttons.create')</a>
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
                <th>{!! \PaginationHelper::sort('title', trans('admin.pages.presellings.columns.title')) !!}</th>
                <th>{!! \PaginationHelper::sort('postal_code', trans('admin.pages.presellings.columns.postal_code')) !!}</th>
                <th>{!! \PaginationHelper::sort('country', trans('admin.pages.presellings.columns.country')) !!}</th>
                <th>{!! \PaginationHelper::sort('province', trans('admin.pages.presellings.columns.province')) !!}</th>
                <th>{!! \PaginationHelper::sort('city', trans('admin.pages.presellings.columns.city')) !!}</th>
                <th>{!! \PaginationHelper::sort('address', trans('admin.pages.presellings.columns.address')) !!}</th>
                <th>{!! \PaginationHelper::sort('building_type', trans('admin.pages.presellings.columns.building_type')) !!}</th>
                <th>{!! \PaginationHelper::sort('completion_year', trans('admin.pages.presellings.columns.completion_year')) !!}</th>
                <th>{!! \PaginationHelper::sort('number_floor', trans('admin.pages.presellings.columns.number_floor')) !!}</th>
                <th>{!! \PaginationHelper::sort('number_unit', trans('admin.pages.presellings.columns.number_unit')) !!}</th>
                <th>{!! \PaginationHelper::sort('developer_name', trans('admin.pages.presellings.columns.developer_name')) !!}</th>
                <th style="width: 40px">@lang('admin.pages.common.label.actions')</th>
            </tr>
            @foreach( $presellings as $preselling )
                <tr>
                    <td>{{ $preselling->id }}</td>
                    <td>{{ $preselling->title }}</td>
                    <td>{{ $preselling->postal_code }}</td>
                    <td>{{ $preselling->country }}</td>
                    <td>{{ $preselling->province }}</td>
                    <td>{{ $preselling->city }}</td>
                    <td>{{ $preselling->address }}</td>
                    <td>{{ $preselling->building_type }}</td>
                    <td>{{ $preselling->completion_year }}</td>
                    <td>{{ $preselling->number_floor }}</td>
                    <td>{{ $preselling->number_unit }}</td>
                    <td>{{ $preselling->developer_name }}</td>

                    <td>
                        <a href="{!! action('Admin\PresellingController@show', $preselling->id) !!}"
                           class="btn btn-block btn-primary btn-xs">@lang('admin.pages.common.buttons.edit')</a>
                        <a href="#" class="btn btn-block btn-danger btn-xs delete-button"
                           data-delete-url="{!! action('Admin\PresellingController@destroy', $preselling->id) !!}">@lang('admin.pages.common.buttons.delete')</a>
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
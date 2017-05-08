@extends('layouts.admin.' . config('view.admin') . '.application', ['menu' => 'condominiumsmanilas'] )

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
Condominiumsmanilas
@stop

@section('breadcrumb')
<li class="active">Condominiumsmanilas</li>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">

        <div class="row">
            <div class="col-sm-6">
                <h3 class="box-title">
                    <p class="text-right">
                        <a href="{!! action('Admin\CondominiumsmanilaController@create') !!}" class="btn btn-block btn-primary btn-sm" style="width: 125px;">@lang('admin.pages.common.buttons.create')</a>
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
                <th>{!! \PaginationHelper::sort('title', trans('admin.pages.condominiumsmanilas.columns.title')) !!}</th>
                <th>{!! \PaginationHelper::sort('postal_code', trans('admin.pages.condominiumsmanilas.columns.postal_code')) !!}</th>
                <th>{!! \PaginationHelper::sort('country', trans('admin.pages.condominiumsmanilas.columns.country')) !!}</th>
                <th>{!! \PaginationHelper::sort('province', trans('admin.pages.condominiumsmanilas.columns.province')) !!}</th>
                <th>{!! \PaginationHelper::sort('city', trans('admin.pages.condominiumsmanilas.columns.city')) !!}</th>
                <th>{!! \PaginationHelper::sort('address', trans('admin.pages.condominiumsmanilas.columns.address')) !!}</th>
                <th>{!! \PaginationHelper::sort('building_type', trans('admin.pages.condominiumsmanilas.columns.building_type')) !!}</th>
                <th>{!! \PaginationHelper::sort('completion_year', trans('admin.pages.condominiumsmanilas.columns.completion_year')) !!}</th>
                <th>{!! \PaginationHelper::sort('number_floor', trans('admin.pages.condominiumsmanilas.columns.number_floor')) !!}</th>
                <th>{!! \PaginationHelper::sort('number_unit', trans('admin.pages.condominiumsmanilas.columns.number_unit')) !!}</th>
                <th>{!! \PaginationHelper::sort('developer_name', trans('admin.pages.condominiumsmanilas.columns.developer_name')) !!}</th>
                <th>{!! \PaginationHelper::sort('unit_size', trans('admin.pages.condominiumsmanilas.columns.unit_size')) !!}</th>

                <th style="width: 40px">@lang('admin.pages.common.label.actions')</th>
            </tr>
            @foreach( $condominiumsmanilas as $condominiumsmanila )
                <tr>
                    <td>{{ $condominiumsmanila->id }}</td>
                    <td>{{ $condominiumsmanila->title }}</td>
                    <td>{{ $condominiumsmanila->postal_code }}</td>
                    <td>{{ $condominiumsmanila->country }}</td>
                    <td>{{ $condominiumsmanila->province }}</td>
                    <td>{{ $condominiumsmanila->city }}</td>
                    <td>{{ $condominiumsmanila->address }}</td>
                    <td>{{ $condominiumsmanila->building_type }}</td>
                    <td>{{ $condominiumsmanila->completion_year }}</td>
                    <td>{{ $condominiumsmanila->number_floor }}</td>
                    <td>{{ $condominiumsmanila->number_unit }}</td>
                    <td>{{ $condominiumsmanila->developer_name }}</td>
                    <td>{{ $condominiumsmanila->unit_size }}</td>

                    <td>
                        <a href="{!! action('Admin\CondominiumsmanilaController@show', $condominiumsmanila->id) !!}"
                           class="btn btn-block btn-primary btn-xs">@lang('admin.pages.common.buttons.edit')</a>
                        <a href="#" class="btn btn-block btn-danger btn-xs delete-button"
                           data-delete-url="{!! action('Admin\CondominiumsmanilaController@destroy', $condominiumsmanila->id) !!}">@lang('admin.pages.common.buttons.delete')</a>
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
@extends('layouts.admin.' . config('view.admin') . '.application', ['menu' => 'zipmatches'] )

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
Zipmatches
@stop

@section('breadcrumb')
<li class="active">Zipmatches</li>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">

        <div class="row">
            <div class="col-sm-6">
                <h3 class="box-title">
                    <p class="text-right">
                        <a href="{!! action('Admin\ZipmatchController@create') !!}" class="btn btn-block btn-primary btn-sm" style="width: 125px;">@lang('admin.pages.common.buttons.create')</a>
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
                <th>{!! \PaginationHelper::sort('title', trans('admin.pages.zipmatches.columns.title')) !!}</th>
                <th>{!! \PaginationHelper::sort('postal_code', trans('admin.pages.zipmatches.columns.postal_code')) !!}</th>
                <th>{!! \PaginationHelper::sort('country', trans('admin.pages.zipmatches.columns.country')) !!}</th>
                <th>{!! \PaginationHelper::sort('province', trans('admin.pages.zipmatches.columns.province')) !!}</th>
                <th>{!! \PaginationHelper::sort('city', trans('admin.pages.zipmatches.columns.city')) !!}</th>
                <th>{!! \PaginationHelper::sort('address', trans('admin.pages.zipmatches.columns.address')) !!}</th>
                <th>{!! \PaginationHelper::sort('building_type', trans('admin.pages.zipmatches.columns.building_type')) !!}</th>
                <th>{!! \PaginationHelper::sort('completion_year', trans('admin.pages.zipmatches.columns.completion_year')) !!}</th>
                <th>{!! \PaginationHelper::sort('number_floor', trans('admin.pages.zipmatches.columns.number_floor')) !!}</th>
                <th>{!! \PaginationHelper::sort('number_unit', trans('admin.pages.zipmatches.columns.number_unit')) !!}</th>
                <th>{!! \PaginationHelper::sort('developer_name', trans('admin.pages.zipmatches.columns.developer_name')) !!}</th>

                <th style="width: 40px">@lang('admin.pages.common.label.actions')</th>
            </tr>
            @foreach( $zipmatchs as $zipmatch )
                <tr>
                    <td>{{ $zipmatch->id }}</td>
                    <td>{{ $zipmatch->title }}</td>
                    <td>{{ $zipmatch->postal_code }}</td>
                    <td>{{ $zipmatch->country }}</td>
                    <td>{{ $zipmatch->province }}</td>
                    <td>{{ $zipmatch->city }}</td>
                    <td>{{ $zipmatch->address }}</td>
                    <td>{{ $zipmatch->building_type }}</td>
                    <td>{{ $zipmatch->completion_year }}</td>
                    <td>{{ $zipmatch->number_floor }}</td>
                    <td>{{ $zipmatch->number_unit }}</td>
                    <td>{{ $zipmatch->developer_name }}</td>

                    <td>
                        <a href="{!! action('Admin\ZipmatchController@show', $zipmatch->id) !!}"
                           class="btn btn-block btn-primary btn-xs">@lang('admin.pages.common.buttons.edit')</a>
                        <a href="#" class="btn btn-block btn-danger btn-xs delete-button"
                           data-delete-url="{!! action('Admin\ZipmatchController@destroy', $zipmatch->id) !!}">@lang('admin.pages.common.buttons.delete')</a>
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
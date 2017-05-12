@extends('layouts.admin.' . config('view.admin') . '.application', ['menu' => 'buildings'] )

@section('metadata')
@stop

@section('styles')
@stop

@section('scripts')
    <script src="{!! \URLHelper::asset('js/delete_item.js', 'admin') !!}"></script>
    <script>
        $('.merge-building').on('click', function () {
            parent = $(this).parents('tr');
            thisElement = $(this);
            $(this).addClass('active');
            $(this).html('<i class="fa fa-spinner fa-spin"></i>');

            $.ajax({
                url: "{{action('API\V1\BuildingController@merge')}}",
                method: 'POST',
                data: {
                    'model':   $('#site').val(),
                    'condo_id': $(this).attr('cid'),
                    'similar_id': $(this).attr('sid')
                },
                error: function (xhr, error) {
                    console.log(error);
                    thisElement.removeClass('active');
                    thisElement.html('Merge');

                    alert('Several error !!!');
                },
                success: function (response) {
                    console.log(response);
                    if( response.code == 100 ) {
                        parent.remove();
                        location.reload();
                    } else {
                        thisElement.removeClass('active');
                        thisElement.html('Merge');

                        alert(response.message);
                    }
                }
            });
        });

        $('.import-building').on('click', function () {
            parent = $(this).parents('tr');
            thisElement = $(this);
            $(this).addClass('active');
            $(this).html('<i class="fa fa-spinner fa-spin"></i>');

            $.ajax({
                url: "{{action('API\V1\BuildingController@import')}}",
                method: 'POST',
                data: {
                    'model':   $('#site').val(),
                    'similar_id': $(this).attr('sid')
                },
                error: function (xhr, error) {
                    console.log(error);
                    thisElement.removeClass('active');
                    thisElement.html('Merge');

                    alert('Several error !!!');
                },
                success: function (response) {
                    console.log(response);
                    if( response.code == 100 ) {
                        parent.remove();
                        location.reload();
                    } else {
                        thisElement.removeClass('active');
                        thisElement.html('Merge');

                        alert(response.message);
                    }
                }
            });
        });
    </script>
@stop

@section('title')
@stop

@section('header')
    Buldings
@stop

@section('breadcrumb')
<li class="active">Buldings</li>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="row">
            <div class="col-sm-6">
                <form action="{!! action('Admin\BuildingController@index') !!}" method="GET" enctype="multipart/form-data">
                    {!! csrf_field() !!}

                    <h3 class="box-title" style="width: 100%;">
                        <label for="site">Website</label>
                        <select class="form-control" name="site" id="site" style="margin-bottom: 15px; width: 50%; display: inline-block;" required onchange="this.form.submit()">
                            <option value="phrealestate" @if($site == 'phrealestate') selected @endif>phrealestate.com</option>
                            <option value="condominiumsmanila" @if($site == 'condominiumsmanila') selected @endif>condominiumsmanila.com</option>
                            <option value="philpropertyexpert" @if($site == 'philpropertyexpert') selected @endif>philpropertyexpert.com</option>
                            <option value="avidaland" @if($site == 'avidaland') selected @endif>avidaland.com</option>
                        </select>
                    </h3>
                    <br>
                    <p style="display: inline-block;">@lang('admin.pages.common.label.search_results', ['count' => $count])</p>
                </form>
            </div>
            <div class="col-sm-6 wrap-top-pagination">
                <div class="heading-page-pagination">
                </div>
            </div>
        </div>
    </div>
    <div class="box-body" style=" overflow-x: scroll; ">
        <table class="table table-bordered">
            <tr>
                <th style="width: 10px">ID</th>
                <th style="width: 10px">Databases</th>
                <th style="width: 10px">Similar Condos</th>
                <th style="width: 10px">Keyword Percent</th>
                <th style="width: 10px">Similar Percent</th>

                <th style="width: 40px">@lang('admin.pages.common.label.actions')</th>
            </tr>
            @foreach( $buildings as $building )
                <tr>
                    <td>{{ $building['condo_id'] }}</td>
                    <td><a target="_blank" href="{{action('Admin\PropertyasiaController@show', $building['condo_id'])}}">{{ $building['condo'] }}</a></td>
                    <td><a target="_blank" href="{{action('Admin\\' . ucfirst($site) . 'Controller@show', $building['similar_id'])}}">{{ $building['similar'] }}</a></td>
                    <td>
                        @if($building['percent_similar'] >= 75)
                            <span style="color: #3c8dbc">{{ number_format($building['percent_similar'], 2) }} % (hight)</span>
                        @elseif($building['percent_similar'] <= 10)
                            <span style="color: #8d8e6c">{{ number_format($building['percent_similar'], 2) }} %</span>
                        @else
                            {{ number_format($building['percent_similar'], 2) }}
                        %@endif
                    </td>
                    <td>
                        @if($building['percent_keyword'] >= 75)
                            <span style="color: #3c8dbc">{{ number_format($building['percent_keyword'], 2) }} % (hight)</span>
                        @elseif($building['percent_keyword'] <= 10)
                            <span style="color: #8d8e6c">{{ number_format($building['percent_keyword'], 2) }} %</span>
                        @else
                            {{ number_format($building['percent_keyword'], 2) }} %
                        @endif
                    </td>

                    <td>
                        <span style="cursor: pointer;" class="btn btn-block btn-primary btn-xs merge-building" cid="{{$building['condo_id']}}" sid="{{$building['similar_id']}}">Merge</span>
                        <span style="cursor: pointer; background: #8d8e6c;" class="btn btn-block btn-success btn-xs import-building" sid="{{$building['similar_id']}}">Import</span>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="box-footer">
    </div>
</div>
@stop
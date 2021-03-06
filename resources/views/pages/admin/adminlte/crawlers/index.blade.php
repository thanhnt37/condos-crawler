@extends('layouts.admin.' . config('view.admin') . '.application',['menu' => 'crawlers'] )

@section('metadata')
@stop

@section('styles')
@stop

@section('scripts')
@stop

@section('title')
    {{ config('site.name') }} | Admin | Crawler
@stop

@section('header')
    Crawler
@stop

@section('breadcrumb')
    <li class="active">Crawler</li>
@stop

@section('content')
    <form action="{!! action('Admin\CrawlerController@crawl') !!}" method="POST" enctype="multipart/form-data">
        {!! csrf_field() !!}

        <div class="box box-primary">
            <div class="box-header with-border">
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="url">condominiumsmanila.com URL</label>
                            <input type="text" class="form-control" id="url" name="url"  value="{{ old('url') ? old('url') : '' }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-sm" style="width: 125px;">Crawl</button>
            </div>
        </div>
    </form>

    <form action="{!! action('Admin\CrawlerController@phrealestate') !!}" method="POST" enctype="multipart/form-data">
        {!! csrf_field() !!}

        <div class="box box-primary">
            <div class="box-header with-border">
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="url">phrealestate.com URL</label>
                            <input type="text" class="form-control" id="url" name="url"  value="{{ old('url') ? old('url') : '' }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-sm" style="width: 125px;">Crawl</button>
            </div>
        </div>
    </form>

    <form action="{!! action('Admin\CrawlerController@philpropertyexpert') !!}" method="POST" enctype="multipart/form-data">
        {!! csrf_field() !!}

        <div class="box box-primary">
            <div class="box-header with-border">
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="url">philpropertyexpert.com URL</label>
                            <input type="text" class="form-control" id="url" name="url"  value="{{ old('url') ? old('url') : '' }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-sm" style="width: 125px;">Crawl</button>
            </div>
        </div>
    </form>

    <form action="{!! action('Admin\CrawlerController@propertyasia') !!}" method="POST" enctype="multipart/form-data">
        {!! csrf_field() !!}

        <div class="box box-primary">
            <div class="box-header with-border">
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="url">propertyasia.ph URL</label>
                            <input type="text" class="form-control" id="url" name="url"  value="{{ old('url') ? old('url') : '' }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-sm" style="width: 125px;">Crawl</button>
            </div>
        </div>
    </form>

    <form action="{!! action('Admin\CrawlerController@avidaland') !!}" method="POST" enctype="multipart/form-data">
        {!! csrf_field() !!}

        <div class="box box-primary">
            <div class="box-header with-border">
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="url">avidaland.com URL</label>
                            <input type="text" class="form-control" id="url" name="url"  value="{{ old('url') ? old('url') : '' }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-sm" style="width: 125px;">Crawl</button>
            </div>
        </div>
    </form>

    <form action="{!! action('Admin\CrawlerController@atayala') !!}" method="POST" enctype="multipart/form-data">
        {!! csrf_field() !!}

        <div class="box box-primary">
            <div class="box-header with-border">
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="url">atayala.com URL</label>
                            <input type="text" class="form-control" id="url" name="url"  value="http://www.atayala.com/ayala-land-properties-for-sale/properties/all-properties/for-sale">
                        </div>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-sm" style="width: 125px;">Crawl</button>
            </div>
        </div>
    </form>

    <form action="{!! action('Admin\CrawlerController@preselling') !!}" method="POST" enctype="multipart/form-data">
        {!! csrf_field() !!}

        <div class="box box-primary">
            <div class="box-header with-border">
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="url">preselling.com.ph URL</label>
                            <input type="text" class="form-control" id="url" name="url">
                        </div>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-sm" style="width: 125px;">Crawl</button>
            </div>
        </div>
    </form>

    <form action="{!! action('Admin\CrawlerController@zipmatch') !!}" method="POST" enctype="multipart/form-data">
        {!! csrf_field() !!}

        <div class="box box-primary">
            <div class="box-header with-border">
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="url">zipmatch.com URL</label>
                            <input type="text" class="form-control" id="url" name="url">
                        </div>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-sm" style="width: 125px;">Crawl</button>
            </div>
        </div>
    </form>
@stop

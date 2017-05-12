<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="@if(!empty($authUser->present()->profileImage())) {{ $authUser->present()->profileImage()->present()->url }} @else {!! \URLHelper::asset('img/user_avatar.png', 'common') !!} @endif" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>@if($authUser->name){{ $authUser->name }} @else {{ $authUser->email }} @endif</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">Main Actions</li>

            <li @if( $menu=='dashboard') class="active" @endif ><a href="{!! \URL::action('Admin\IndexController@index') !!}"><i class="fa fa-dashboard"></i> <span>@lang('admin.menu.dashboard')</span></a></li>

            @if( $authUser->hasRole(\App\Models\AdminUserRole::ROLE_ADMIN) )
                {{--<li @if( $menu=='admin_users') class="active" @endif ><a href="{!! \URL::action('Admin\AdminUserController@index') !!}"><i class="fa fa-user-secret"></i> <span>@lang('admin.menu.admin_users')</span></a></li>--}}
                {{--<li @if( $menu=='admin_user_notifications') class="active" @endif ><a href="{!! \URL::action('Admin\AdminUserNotificationController@index') !!}"><i class="fa fa-bell-o"></i> <span>@lang('admin.menu.admin_user_notifications')</span></a></li>--}}
            @endif

            @if( $authUser->hasRole(\App\Models\AdminUserRole::ROLE_SUPER_USER) )
                {{--<li @if( $menu=='users') class="active" @endif ><a href="{!! \URL::action('Admin\UserController@index') !!}"><i class="fa fa-users"></i> <span>@lang('admin.menu.users')</span></a></li>--}}
                {{--<li @if( $menu=='user_notifications') class="active" @endif ><a href="{!! \URL::action('Admin\UserNotificationController@index') !!}"><i class="fa fa-bell"></i> <span>@lang('admin.menu.user_notifications')</span></a></li>--}}
                {{--<li @if( $menu=='site_configurations') class="active" @endif ><a href="{!! \URL::action('Admin\SiteConfigurationController@index') !!}"><i class="fa fa-cogs"></i> <span>@lang('admin.menu.site_configuration')</span></a></li>--}}
                {{--<li @if( $menu=='logs') class="active" @endif ><a href="{!! \URL::action('Admin\LogController@index') !!}"><i class="fa fa-sticky-note-o"></i> <span>@lang('admin.menu.log_system')</span></a></li>--}}
                {{--<li @if( $menu=='images') class="active" @endif ><a href="{!! \URL::action('Admin\ImageController@index') !!}"><i class="fa fa-file-image-o"></i> <span>@lang('admin.menu.images')</span></a></li>--}}
                {{--<li @if( $menu=='articles') class="active" @endif ><a href="{!! \URL::action('Admin\ArticleController@index') !!}"><i class="fa fa-file-word-o"></i> <span>@lang('admin.menu.articles')</span></a></li>--}}
                <li @if( $menu=='crawlers') class="active" @endif ><a href="{!! \URL::action('Admin\CrawlerController@index') !!}"><i class="fa fa-file-word-o"></i> <span>@lang('admin.menu.crawlers')</span></a></li>
                <li @if( $menu=='buildings') class="active" @endif ><a href="{!! \URL::action('Admin\BuildingController@index') !!}"><i class="fa fa-file-word-o"></i> <span>Compare Data</span></a></li>
                <li @if( $menu=='propertyasias') class="active" @endif ><a href="{!! \URL::action('Admin\PropertyasiaController@index') !!}"><i class="fa fa-users"></i> <span>Collections</span></a></li>
            @endif

            <li class="header">Condos Crawled</li>
            <li @if( $menu=='condominiumsmanilas') class="active" @endif ><a href="{!! \URL::action('Admin\CondominiumsmanilaController@index') !!}"><i class="fa fa-users"></i> <span>Condominiumsmanilas</span></a></li>
            <li @if( $menu=='phrealestates') class="active" @endif ><a href="{!! \URL::action('Admin\PhrealestateController@index') !!}"><i class="fa fa-users"></i> <span>Phrealestates</span></a></li>
            <li @if( $menu=='philpropertyexperts') class="active" @endif ><a href="{!! \URL::action('Admin\PhilpropertyexpertController@index') !!}"><i class="fa fa-users"></i> <span>Philpropertyexperts</span></a></li>
            <li @if( $menu=='avidalands') class="active" @endif ><a href="{!! \URL::action('Admin\AvidalandController@index') !!}"><i class="fa fa-users"></i> <span>Avidalands</span></a></li>
            <!-- %%SIDEMENU%% -->
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

            <li>
                <select class="searchable-field form-control"></select>
            </li>

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('global.app_dashboard')</span>
                </a>
            </li>

            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>@lang('global.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('permission_access')
                    <li>
                        <a href="{{ route('admin.permissions.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('global.permissions.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('role_access')
                    <li>
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('global.roles.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('user_access')
                    <li>
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span>@lang('global.users.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('team_access')
                    <li>
                        <a href="{{ route('admin.teams.index') }}">
                            <i class="fa fa-users"></i>
                            <span>@lang('global.teams.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('nominated_access')
            <li>
                <a href="{{ route('admin.nominateds.index') }}">
                    <i class="fa fa-trophy"></i>
                    <span>@lang('global.nominated.title')</span>
                </a>
            </li>@endcan
            
            @can('baza_firm_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-briefcase"></i>
                    <span>@lang('global.baza-firm.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('vivodeship_access')
                    <li>
                        <a href="{{ route('admin.vivodeships.index') }}">
                            <i class="fa fa-map"></i>
                            <span>@lang('global.vivodeships.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('trade_access')
                    <li>
                        <a href="{{ route('admin.trades.index') }}">
                            <i class="fa fa-industry"></i>
                            <span>@lang('global.trades.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('company_access')
                    <li>
                        <a href="{{ route('admin.companies.index') }}">
                            <i class="fa fa-bank"></i>
                            <span>@lang('global.company.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('task_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list"></i>
                    <span>@lang('global.task-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('task_access')
                    <li>
                        <a href="{{ route('admin.tasks.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('global.tasks.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('task_status_access')
                    <li>
                        <a href="{{ route('admin.task_statuses.index') }}">
                            <i class="fa fa-server"></i>
                            <span>@lang('global.task-statuses.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('task_tag_access')
                    <li>
                        <a href="{{ route('admin.task_tags.index') }}">
                            <i class="fa fa-server"></i>
                            <span>@lang('global.task-tags.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('task_calendar_access')
                    <li>
                        <a href="{{ route('admin.task_calendars.index') }}">
                            <i class="fa fa-calendar"></i>
                            <span>@lang('global.task-calendar.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('ogłoszenium_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bullhorn"></i>
                    <span>@lang('global.ogloszenia.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('advert_access')
                    <li>
                        <a href="{{ route('admin.adverts.index') }}">
                            <i class="fa fa-bars"></i>
                            <span>@lang('global.advert.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('catadvert_access')
                    <li>
                        <a href="{{ route('admin.catadverts.index') }}">
                            <i class="fa fa-align-left"></i>
                            <span>@lang('global.catadvert.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('programy_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-500px"></i>
                    <span>@lang('global.programy.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('program_access')
                    <li>
                        <a href="{{ route('admin.programs.index') }}">
                            <i class="fa fa-certificate"></i>
                            <span>@lang('global.program.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('project_access')
                    <li>
                        <a href="{{ route('admin.projects.index') }}">
                            <i class="fa fa-product-hunt"></i>
                            <span>@lang('global.projects.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('cataward_access')
                    <li>
                        <a href="{{ route('admin.catawards.index') }}">
                            <i class="fa fa-align-justify"></i>
                            <span>@lang('global.catawards.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('award_access')
                    <li>
                        <a href="{{ route('admin.awards.index') }}">
                            <i class="fa fa-trophy"></i>
                            <span>@lang('global.awards.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('notatki_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-sticky-note-o"></i>
                    <span>@lang('global.notatki.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('catnote_access')
                    <li>
                        <a href="{{ route('admin.catnotes.index') }}">
                            <i class="fa fa-align-justify"></i>
                            <span>@lang('global.catnotes.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('note_access')
                    <li>
                        <a href="{{ route('admin.notes.index') }}">
                            <i class="fa fa-sticky-note"></i>
                            <span>@lang('global.notes.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('organization_access')
            <li>
                <a href="{{ route('admin.organizations.index') }}">
                    <i class="fa fa-tripadvisor"></i>
                    <span>@lang('global.organization.title')</span>
                </a>
            </li>@endcan
            
            @can('year_access')
            <li>
                <a href="{{ route('admin.years.index') }}">
                    <i class="fa fa-calendar-minus-o"></i>
                    <span>@lang('global.years.title')</span>
                </a>
            </li>@endcan
            

            

            
            @php ($unread = App\MessengerTopic::countUnread())
            <li class="{{ $request->segment(2) == 'messenger' ? 'active' : '' }} {{ ($unread > 0 ? 'unread' : '') }}">
                <a href="{{ route('admin.messenger.index') }}">
                    <i class="fa fa-envelope"></i>

                    <span>Messages</span>
                    @if($unread > 0)
                        {{ ($unread > 0 ? '('.$unread.')' : '') }}
                    @endif
                </a>
            </li>
            <style>
                .page-sidebar-menu .unread * {
                    font-weight:bold !important;
                }
            </style>



            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('global.app_change_password')</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('global.app_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>


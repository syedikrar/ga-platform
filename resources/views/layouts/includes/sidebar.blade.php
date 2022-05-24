   <!-- sidebar @s -->
   <div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-menu-trigger">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
        </div>
        <div class="nk-sidebar-brand">
            <a href="{{route('dashboard.home')}}" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="{{ asset('images/dashboard/logo.png') }}" srcset="{{ asset('images/dashboard/logo.png') }} 2x" alt="logo">
                <img class="logo-dark logo-img" src="{{ asset('images/dashboard/logo.png') }}" srcset="{{ asset('images/dashboard/logo.png') }} 2x" alt="logo-dark">
            </a>
        </div>
    </div><!-- .nk-sidebar-element -->
    <div class="nk-sidebar-element nk-sidebar-body">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul style="padding: 30px 0px;" class="nk-menu">
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">{{trans('menu.main', [], app()->getLocale())}}</h6>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="{{route('dashboard.home')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><img src="{{ asset('images/dashboard/menu-icon1.png') }}" alt=""> </span>
                            <span class="nk-menu-text">{{trans('menu.home', [], app()->getLocale())}}</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="{{route('dashboard.entities.index')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><img src="{{ asset('images/dashboard/entities-menu-icon.png') }}" alt=""> </span>
                            <span class="nk-menu-text">{{trans('menu.entities', [], app()->getLocale())}}</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="{{ route('dashboard.calendars.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><img src="{{ asset('images/dashboard/calendar-menu-icon.png') }}" alt=""></span>
                            <span class="nk-menu-text">{{trans('menu.calendar', [], app()->getLocale())}}</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="javascript:void(0);" class="nk-menu-link">
                            <span class="nk-menu-icon"><img src="{{ asset('images/dashboard/directory-menu-icon.png') }}" alt=""> </span>
                            <span class="nk-menu-text">{{trans('menu.directory', [], app()->getLocale())}}</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                
                  

                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">{{trans('menu.category', [], app()->getLocale())}}</h6>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="{{route('dashboard.cohorts.index')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><img src="{{ asset('images/dashboard/cohorts-menu-icon.png') }}" alt=""> </span>
                            <span class="nk-menu-text">{{trans('menu.cohorts', [], app()->getLocale())}}</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="{{route('dashboard.challenges.index')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><img src="{{ asset('images/dashboard/challenges-menu-icon.png') }}" alt=""> </span>
                            <span class="nk-menu-text">{{trans('menu.challenges', [], app()->getLocale())}}</span>
                        </a>
                    </li><!-- .nk-menu-item -->

                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">{{trans('menu.master_data', [], app()->getLocale())}}</h6>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="{{route('dashboard.entity-types.index')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><img src="{{ asset('images/dashboard/entities-menu-icon.png') }}" alt=""> </span>
                            <span class="nk-menu-text">{{trans('menu.entity_types', [], app()->getLocale())}}</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="{{route('dashboard.cohort-types.index')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><img src="{{ asset('images/dashboard/cohorts-menu-icon.png') }}" alt=""> </span>
                            <span class="nk-menu-text">{{trans('menu.cohort_types', [], app()->getLocale())}}</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="{{route('dashboard.stages.index')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><img src="{{ asset('images/dashboard/cohorts-menu-icon.png') }}" alt=""> </span>
                            <span class="nk-menu-text">{{trans('menu.stages', [], app()->getLocale())}}</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="{{route('dashboard.user.index')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><img src="{{ asset('images/dashboard/system-users-menu-icon.png') }}" alt=""> </span>
                            <span class="nk-menu-text">{{trans('menu.system_users', [], app()->getLocale())}}</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item d-none">
                        <a href="#" class="nk-menu-link">
                            <span class="nk-menu-icon"><img src="{{ asset('images/dashboard/service-providers-menu-icon.png') }}" alt=""> </span>
                            <span class="nk-menu-text">{{trans('menu.service_providers', [], app()->getLocale())}}</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="#" class="nk-menu-link">
                            <span class="nk-menu-icon"><img src="{{ asset('images/dashboard/tool-box-menu-icon.png') }}" alt=""> </span>
                            <span class="nk-menu-text">{{trans('menu.tool_box', [], app()->getLocale())}}</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="{{route('dashboard.roles.index')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><img src="{{ asset('images/dashboard/roles-menu-icon.png') }}" alt=""> </span>
                            <span class="nk-menu-text">{{trans('menu.roles', [], app()->getLocale())}}</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="#" class="nk-menu-link">
                            <span class="nk-menu-icon"><img src="{{ asset('images/dashboard/templates-menu-icon.png') }}" alt=""> </span>
                            <span class="nk-menu-text">{{trans('menu.templates', [], app()->getLocale())}}</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item d-none">
                        <a href="#" class="nk-menu-link">
                            <span class="nk-menu-icon"><img src="{{ asset('images/dashboard/lookups-menu-icon.png') }}" alt=""> </span>
                            <span class="nk-menu-text">{{trans('menu.look_ups', [], app()->getLocale())}}</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item d-none">
                        <a href="#" class="nk-menu-link">
                            <span class="nk-menu-icon"><img src="{{ asset('images/dashboard/ga-values-menu-icon.png') }}" alt=""> </span>
                            <span class="nk-menu-text">{{trans('menu.ga_values', [], app()->getLocale())}}</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item d-none">
                        <a href="#" class="nk-menu-link">
                            <span class="nk-menu-icon"><img src="{{ asset('images/dashboard/activites-templates-menu-icon.png') }}" alt=""> </span>
                            <span class="nk-menu-text">{{trans('menu.activities_templates', [], app()->getLocale())}}</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item d-none">
                        <a href="#" class="nk-menu-link">
                            <span class="nk-menu-icon"><img src="{{ asset('images/dashboard/stages-templates-menu-icon.png') }}" alt=""> </span>
                            <span class="nk-menu-text">{{trans('menu.stages_templates', [], app()->getLocale())}}</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="#" class="nk-menu-link">
                            <span class="nk-menu-icon"><img src="{{ asset('images/dashboard/question-groups-menu-icon.png') }}" alt=""> </span>
                            <span class="nk-menu-text">{{trans('menu.question_groups', [], app()->getLocale())}}</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="{{route('dashboard.translations.index')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><img src="{{ asset('images/dashboard/tool-box-menu-icon.png') }}" alt=""> </span>
                            <span class="nk-menu-text">{{trans('menu.translations', [], app()->getLocale())}}</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                   
                    


                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">{{trans('menu.account', [], app()->getLocale())}}</h6>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="#" class="nk-menu-link">
                            <span class="nk-menu-icon"><img src="{{ asset('images/dashboard/profile-menu-icon.png') }}" alt=""></span>
                            <span class="nk-menu-text">{{trans('menu.profile', [], app()->getLocale())}}</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="#" class="nk-menu-link">
                            <span class="nk-menu-icon"><img src=" {{ asset('images/dashboard/settings-menu-icon.png') }}" alt=""></span>
                            <span class="nk-menu-text">{{trans('menu.settings', [], app()->getLocale())}}</span>
                        </a>
                    </li><!-- .nk-menu-item -->

                    <li class="nk-menu-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="#" class="nk-menu-link"  onclick="event.preventDefault();
                            this.closest('form').submit();">
                                <span class="nk-menu-icon"><img src="{{ asset('images/dashboard/logout-menu-icon.png') }}" alt=""></span>
                                <span class="nk-menu-text">{{trans('menu.log_out', [], app()->getLocale())}}</span>
                            </a>
                        </form>
                        
                    </li><!-- .nk-menu-item -->
                </ul><!-- .nk-menu -->
            </div><!-- .nk-sidebar-menu -->
        </div><!-- .nk-sidebar-content -->
    </div><!-- .nk-sidebar-element -->
</div>
<!-- sidebar @e -->
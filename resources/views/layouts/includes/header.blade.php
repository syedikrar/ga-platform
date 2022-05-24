 <!-- main header @s -->
 <div class="nk-header nk-header-fixed is-light">
    <div class="container-fluid">
        <div class="nk-header-wrap">
            <div class="nk-menu-trigger d-xl-none ml-n1">
                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
            </div>
            <div class="nk-header-brand d-xl-none">
                <a href="{{route('dashboard.home')}}" class="logo-link">
                    <img class="logo-light logo-img" src="{{ asset('images/dashboard/author-img.png') }}" srcset="{{ asset('images/dashboard/author-img.png') }}" alt="logo">
                    <img class="logo-dark logo-img" src="{{ asset('images/dashboard/author-img.png') }}" srcset="{{ asset('images/dashboard/author-img.png') }}" alt="logo-dark">
                </a>
            </div><!-- .nk-header-brand -->
            <div class="nk-header-news d-none d-xl-block">
                <div class="nk-news-list">
                    <a class="nk-news-item" href="#">
                        <div class="nk-news-icon">
                           <img src="{{ asset('images/dashboard/author-img.png') }}" alt="">
                        </div>
                        <div class="nk-news-text">
                            <h6>Welcome,  {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h6>
                        </div>
                    </a>
                </div>
            </div><!-- .nk-header-news -->
            <div class="nk-header-tools">
                <ul class="nk-quick-nav">
                    <li class="dropdown notification-dropdown mr-n1">
                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-toggle="dropdown">
                            <div class="icon-status icon-status-info"><img src="{{ asset('images/dashboard/calendar.png') }}" alt=""></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right dropdown-menu-s1 calendarDiv">
                            <div class="dropdown-body">
                                <div class="calender-events">
                                    <div class="calendar-div">
                                        <div class="dropdown-head notification">
                                            <span class="sub-title nk-dropdown-title"><img src="{{ asset('images/dashboard/calendar.png') }}" alt=""> Calendar</span>
                                        </div>
                                        <div class="today-date">
                                            <span>Today</span>
                                            <p>3 December 2021</p>
                                        </div>
                                        <div id="theme-blue" class="article">
                                            <div class="calendar-blue"></div>
                                            <!-- <div class="box"></div> -->
                                        </div>

                                    </div>
                                    <div class="events-div">
                                        <div class="dropdown-head notification">
                                            <span class="sub-title nk-dropdown-title">Upcoming events</span>
                                        </div>
                                        <div class="events-row">
                                            <div class="events-box">
                                                <div class="events-img">
                                                    <span class="bg-warning-50"><img src="{{ asset('images/dashboard/events-icon1.png') }}" alt=""></span>
                                                </div>
                                                <div class="events-content">
                                                    <span class="sub-title">Food security</span>
                                                    <span class="events-sub-content"><img src="{{ asset('images/dashboard/events-calendar.png') }}" alt="">22 nov 2021- 2:00 PM</span>
                                                    <span class="events-sub-content-bottom">Location : <b>Online</b><img src="{{ asset('images/dashboard/events-status.png') }}" alt=""></span>
                                                </div>
                                            </div>
                                            <div class="events-box">
                                                <div class="events-img">
                                                    <span class="bg-violate-50"><img src=" {{ asset('images/dashboard/events-icon2.png') }}" alt=""></span>
                                                </div>
                                                <div class="events-content">
                                                    <span class="sub-title">Food security</span>
                                                    <span class="events-sub-content"><img src="{{ asset('images/dashboard/events-calendar.png') }}" alt="">22 nov 2021- 2:00 PM</span>
                                                    <span class="events-sub-content-bottom">Location : <b>Online</b><img src="{{ asset('images/dashboard/events-status.png') }}" alt=""></span>
                                                </div>
                                            </div>
                                            <div class="events-box">
                                                <div class="events-img">
                                                    <span class="bg-green-50"><img src="{{ asset('images/dashboard/events-icon3.png') }}" alt=""></span>
                                                </div>
                                                <div class="events-content">
                                                    <span class="sub-title">Food security</span>
                                                    <span class="events-sub-content"><img src="{{ asset('images/dashboard/events-calendar.png') }}" alt="">22 nov 2021- 2:00 PM</span>
                                                    <span class="events-sub-content-bottom">Location : <b>Online</b><img src="{{ asset('images/dashboard/events-status.png') }}" alt=""></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="agenda">
                                        <div class="dropdown-head notification">
                                            <span class="sub-title nk-dropdown-title">Agenda</span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .nk-dropdown-body -->
                        </div>
                    </li><!-- .dropdown -->
                    <li class="dropdown notification-dropdown mr-n1">
                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-toggle="dropdown">
                            <div class="icon-status icon-status-info"><em class="icon ni ni-bell"></em></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right dropdown-menu-s1">
                            <div class="dropdown-head notification">
                                <span class="sub-title nk-dropdown-title"><img src="{{ asset('images/dashboard/notification.png') }}" alt=""> Notification Center</span>
                            </div>
                            <div class="dropdown-body">
                                <div class="nk-notification">
                                    <div class="nk-notification-item dropdown-inner">
                                        <div class="nk-notification-icon">
                                            <em class="icon icon-circle bg-violate-50 ni ni-share"></em>
                                        </div>
                                        <div class="nk-notification-content">
                                            <div class="nk-notification-text"><span>Widthdrawl</span>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                                        </div>
                                    </div>
                                    <div class="nk-notification-item dropdown-inner">
                                        <div class="nk-notification-icon">
                                            <em class="icon icon-circle bg-success-50 ni ni-curve-down-left"></em>
                                        </div>
                                        <div class="nk-notification-content">
                                            <div class="nk-notification-text"><span>Widthdrawl</span>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                                        </div>
                                    </div>
                                    <div class="nk-notification-item dropdown-inner">
                                        <div class="nk-notification-icon">
                                            <em class="icon icon-circle bg-violate-50 ni ni-share"></em>
                                        </div>
                                        <div class="nk-notification-content">
                                            <div class="nk-notification-text"><span>Widthdrawl</span>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                                        </div>
                                    </div>
                                    <div class="nk-notification-item dropdown-inner">
                                        <div class="nk-notification-icon">
                                            <em class="icon icon-circle bg-success-50 ni ni-curve-down-left"></em>
                                        </div>
                                        <div class="nk-notification-content">
                                            <div class="nk-notification-text"><span>Widthdrawl</span>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                                        </div>
                                    </div>
                                </div><!-- .nk-notification -->
                            </div><!-- .nk-dropdown-body -->
                        </div>
                    </li><!-- .dropdown -->
                    <li class="dropdown language-dropdown d-none d-sm-block mr-n1">
                        @if(app()->getLocale() == 'en')
                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-toggle="dropdown">
                            <div class="user-avatar sm border border-light">
                                
                                <img src=" {{ asset('images/dashboard/flags/english.png') }}" alt="">
                                
                            </div>
                            <div class="user-name dropdown-indicator language_">English</div>
                        </a>
                        @elseif(app()->getLocale() == 'ar')
                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-toggle="dropdown">
                            <div class="user-avatar sm border border-light">
                                
                                <img src=" {{ asset('images/dashboard/flags/uae.png') }}" alt="">
                                
                            </div>
                            <div class="user-name dropdown-indicator language_">Arabic</div>
                        </a>
                                
                        @endif
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-s1 pb-0">
                            <ul class="language-list">
                                @if(app()->getLocale() != 'en')
                                <li>
                                    <a href="#" class="language-item" data-code="en" >
                                        <img src="{{ asset('images/dashboard/flags/english.png') }} " alt="" class="language-flag">
                                        <span class="language-name">English </span>
                                    </a>
                                </li>
                                @endif
                                @if(app()->getLocale() != 'ar')
                                <li>
                                    <a href="#" class="language-item" data-code="ar">
                                        <img src="{{ asset('images/dashboard/flags/uae.png') }}" alt="" class="language-flag">
                                        <span class="language-name">Arabic</span>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </li><!-- .dropdown -->
                </ul><!-- .nk-quick-nav -->
            </div><!-- .nk-header-tools -->
        </div><!-- .nk-header-wrap -->
    </div><!-- .container-fliud -->
</div>
<!-- main header @e -->
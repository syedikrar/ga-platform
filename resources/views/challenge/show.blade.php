@extends('layouts.app')
@section('custom-styles')
<link rel="stylesheet" href="{{asset('wizerd-assets/custom_style.css')}}" />
<style type="text/css">
    .hide_event_on {
        display: none;
    }

    .select2-container {
        width: 100% !important;
    }

    .urgent {
        background-color: #FCD7D3;
        color: #F15445 !important;
        border: 0px solid;
    }

    .medium {
        background-color: #D9F8E8;
        color: #5ED396 !important;
        border: 0px solid;
    }

    .low {
        background-color: #FCF3D3;
        color: #DBB448 !important;
        border: 0px solid;
    }

    .pending {
        color: #A2A2A2 !important;
    }
</style>
@endsection
@section('content')
<div class="nk-content cohortDetails">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="breadcrumb-title">
                            <h5><a href="{{route('dashboard.challenges.index')}}" class="text-dark"><i
                                        class="zmdi zmdi-chevron-left"></i> Challenges</a></h5>
                            <ul>
                                <li>Challenges > {{$challenge->name_en}}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mood-status">
                            <span>Mode</span>
                            <div class="mood-status-parent">
                                @foreach ($stages as $stage)
                                <button @if($challenge->stage_id == $stage->id) class="active" @endif
                                    class="stage_changer" data-stage="{{$stage->name_en}}"
                                    action='{{route("dashboard.challenges.update-stage",$challenge->uuid)}}'>{{ucfirst($stage->name_en)}}</button>

                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-area">
                    <div class="tab-section">
                        <div class="card card-preview">
                            <div class="card-inner">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <ul class="nav nav-tabs mt-n3 justify-content-start m-3" id="myTab">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab"
                                                    href="#tabItem1">SUMMARY</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#tabItem2">PLANS</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#tabItem3">CALENDAR</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#tabItem4">RISKS</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#tabItem5">Sustainability
                                                    and scalability</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#tabItem6">MEMBERS</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#tabItem7">Details</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#tabItem8">Entities</a>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tabItem1">
                                        <div class="global-bg-white">

                                            <div class="nk-block nk-block-lg bg-white">
                                                <div class="card bg-white">

                                                    <div class="challenges-description-content">
                                                        <div id="clock" style="border-top:0px;"></div>

                                                        <div class="timeline-steps aos-init aos-animate"
                                                            data-aos="fade-up">
                                                            @foreach($challenge->cohort_touchpoints as $touchpoint)
                                                            <div
                                                                class="timeline-step {{$touchpoint->is_active == 1 ? 'current' : ($touchpoint->is_active == 0 && $touchpoint->is_completed == 0 ? 'upNext' : '')}}">
                                                                <div class="timeline-content">
                                                                    <img src="{{$touchpoint->is_completed == 1 ? asset('storage/'.$touchpoint->done_image) : asset('storage/'.$touchpoint->default_image) }}"
                                                                        alt="">
                                                                    <div class="circleBdr">
                                                                        <div class="inner-circle">
                                                                            <em class="icon ni ni-check"></em>
                                                                        </div>
                                                                    </div>
                                                                    <div class="timeline_content">
                                                                        <h6
                                                                            class="{{$touchpoint->is_active == 0 && $touchpoint->is_completed == 0 ? 'pending' : '' }}">
                                                                            {{$touchpoint->title_en}}</h6>
                                                                        <p
                                                                            class="{{$touchpoint->is_active == 0 && $touchpoint->is_completed == 0 ? 'pending' : '' }}">
                                                                            {{$touchpoint->subtitle_en}}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>


                                                    <div class="challenges-description-content d-none">
                                                        <div class="descriptionContent">
                                                            <h6>Challenge Description</h6>
                                                            <p>{{$challenge->description_en}}</p>
                                                        </div>
                                                        <div class="descriptionContent-grid">
                                                            <div class="descriptionContent">
                                                                <h6>Baseline</h6>
                                                                <p>{{$challenge->baseline}}</p>
                                                            </div>
                                                            <div class="descriptionContent">
                                                                <h6>Goal</h6>
                                                                <p>{{$challenge->goal}}</p>
                                                            </div>
                                                            <div class="descriptionContent">
                                                                <h6>Final Results</h6>
                                                                <p>Not Available</p>
                                                            </div>
                                                            <div class="descriptionContent">
                                                                <h6>Email</h6>
                                                                <p>Not Available</p>
                                                            </div>
                                                            <div class="descriptionContent">
                                                                <h6>Lead Entity</h6>
                                                                <p><a
                                                                        href="{{route('dashboard.entities.show',$challenge->leadEntity->uuid)}}">{{$challenge->leadEntity->name_en}}</a>
                                                                </p>
                                                            </div>
                                                            <div class="descriptionContent">
                                                                <h6>Supporting Entities</h6>
                                                                <p><a href="#">ministry of industry and advanced
                                                                        technology</a></p>
                                                                <p>Ministry of Health</p>
                                                                <p>Road and Transportation Authority</p>
                                                                <p>Ministry of Culture & Youth</p>
                                                            </div>
                                                            <div class="descriptionContent">
                                                                <h6>Stage</h6>
                                                                @foreach($stages as $stage)
                                                                <div class="singleCheckBox">
                                                                    <input @if($stage->id == $challenge->stage_id)
                                                                    checked @endif disabled type="checkbox">
                                                                    <label for="check1">{{$stage->name_en}}</label>
                                                                </div>
                                                                @endforeach


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- .card-preview -->
                                            </div>

                                        </div>
                                    </div>

                                    <div class="tab-pane noWrap" id="tabItem2">
                                        <div class="global-bg-white">

                                            <!-- options-->
                                            <div class="page-right-dot-option dot-options">
                                                <div class="nk-file-actions">
                                                    <div class="dropdown">
                                                        <a href=""
                                                            class="dropdown-toggle btn btn-sm btn-icon btn-trigger"
                                                            data-toggle="dropdown"><em
                                                                class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="javascript:void(0);" data-act="ajax-modal1"
                                                                        data-method="get"
                                                                        data-action-url="{{ route('dashboard.acceleration-workstreams.create',$challenge->id) }}"><img
                                                                            src="{{ asset('images/dashboard/dot-icon1.png')}}"
                                                                            alt=""><span>Add
                                                                            Workstream/activity</span></a></li>
                                                                <!--<li><a href="#add-risk" data-toggle="modal"><img src="{{ asset('images/dashboard/dot-icon1.png')}}" alt=""><span>Add Risk</span></a></li>-->

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- options-->

                                            <div class="nk-block nk-block-lg bg-white table">
                                                <div class="card bg-white">
                                                    <div class="table-content" id="plans_table_data">
                                                        @include('challenge.plan.acceleration_workstreams.index')
                                                    </div>
                                                </div><!-- .card-preview -->
                                            </div><!-- nk-block -->

                                        </div>
                                    </div>

                                    <div class="tab-pane" id="tabItem4">
                                        <div class="global-bg-white">

                                            <div class="page-right-dot-option dot-options">
                                                <div class="nk-file-actions">
                                                    <div class="dropdown">
                                                        <a href=""
                                                            class="dropdown-toggle btn btn-sm btn-icon btn-trigger"
                                                            data-toggle="dropdown"><em
                                                                class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="#add-risk" data-toggle="modal"><img
                                                                            src="{{ asset('images/dashboard/dot-icon1.png')}}"
                                                                            alt=""><span>Add Risk</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="nk-block nk-block-lg bg-white table">
                                                <div class="card bg-white">
                                                    <div class="table-content">
                                                        <div class="table-search-bar-top">
                                                            <div class="row gy-4">
                                                                <div class="col-sm-4">
                                                                    <div class="table-searchbar">
                                                                        <div class="form-group">
                                                                            <div class="form-control-wrap">
                                                                                <div class="form-icon form-icon-left">
                                                                                    <em class="icon ni ni-search"></em>
                                                                                </div>
                                                                                <input type="text" class="form-control"
                                                                                    id="searchBar" placeholder="Search">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4"></div>
                                                            </div>
                                                        </div>
                                                        <table
                                                            class=" nowrap nk-tb-list nk-tb-ulist table table-style-3"
                                                            id="risks-table" data-export-title="Export">
                                                            <thead>
                                                                <tr class="nk-tb-item nk-tb-head">
                                                                    <th><input type="checkbox"></th>
                                                                    <th class="nk-tb-col">
                                                                        <div class="dropdown">
                                                                            <a class="dropdown-toggle btn btn-icon btn-trigger"
                                                                                data-toggle="dropdown"
                                                                                aria-expanded="false">Title <em
                                                                                    class="icon ni ni-caret-down-fill"></em></a>
                                                                            <div
                                                                                class="dropdown-menu dropdown-menu-right dropdown-menu-xs left115px">
                                                                                <ul class="link-list-plain">
                                                                                    <li><a href="#"><img
                                                                                                src="{{ asset('images/dashboard/reflect-icon1.png')}}"
                                                                                                alt=""> From smallest to
                                                                                            the largest</a></li>
                                                                                    <li><a href="#"><img
                                                                                                src="{{ asset('images/dashboard/reflect-icon2.png')}}"
                                                                                                alt=""> From largest to
                                                                                            smallest</a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </th>
                                                                    <th class="nk-tb-col tb-col-md">
                                                                        Impact
                                                                    </th>

                                                                    <th class="nk-tb-col tb-col-md">
                                                                        Probabilty
                                                                    </th>
                                                                    <th class="nk-tb-col">
                                                                        Status
                                                                    </th>
                                                                    <th class="nk-tb-col">
                                                                        Identification Start
                                                                    </th>
                                                                    {{-- <th class="nk-tb-col">
                                                                        Metigation Plan
                                                                    </th>
                                                                    <th></th> --}}
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div><!-- .card-preview -->
                                            </div><!-- nk-block -->

                                        </div>
                                    </div>

                                    <!---------- members tab ------->

                                    <div class="tab-pane" id="tabItem5">
                                        <div class="global-bg-white">

                                            <!-- options-->
                                            <div class="page-right-dot-option dot-options d-none">
                                                <div class="nk-file-actions">
                                                    <div class="dropdown">
                                                        <a href=""
                                                            class="dropdown-toggle btn btn-sm btn-icon btn-trigger"
                                                            data-toggle="dropdown"><em
                                                                class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li>
                                                                    <!-- <a href="javascript:void(0);" data-act="ajax-modal" data-complete-location="true" data-method="get" data-action-url="{{ url('dashboard/challenge/add_team_member_form/' . $challenge->id ) }}">
                                                                        <img src="{{ asset('images/dashboard/dot-icon1.png')}}" alt=""><span>Add Team Member</span>
                                                                    </a>
                                                                    <a href="javascript:void(0);" data-act="ajax-modal" data-complete-location="true" data-method="get" data-action-url="{{ url('dashboard/challenge/add_team_member_form/' . $challenge->id ) }}">
                                                                        <img src="{{ asset('images/dashboard/dot-icon1.png')}}" alt=""><span>Add Coach</span>
                                                                    </a>
                                                                    <a href="javascript:void(0);" data-act="ajax-modal" data-complete-location="true" data-method="get" data-action-url="{{ url('dashboard/challenge/add_team_member_form/' . $challenge->id ) }}">
                                                                        <img src="{{ asset('images/dashboard/dot-icon1.png')}}" alt=""><span>Add Team Leaders</span>
                                                                    </a>
                                                                    <a href="javascript:void(0);" data-act="ajax-modal" data-complete-location="true" data-method="get" data-action-url="{{ url('dashboard/challenge/add_team_member_form/' . $challenge->id ) }}">
                                                                        <img src="{{ asset('images/dashboard/dot-icon1.png')}}" alt=""><span>Add Leadership</span>
                                                                    </a>
                                                                    <a href="javascript:void(0);" data-act="ajax-modal" data-complete-location="true" data-method="get" data-action-url="{{ url('dashboard/challenge/add_team_member_form/' . $challenge->id ) }}">
                                                                        <img src="{{ asset('images/dashboard/dot-icon1.png')}}" alt=""><span>Add Sponsor</span>
                                                                    </a>
                                                                    <a href="javascript:void(0);" data-act="ajax-modal" data-complete-location="true" data-method="get" data-action-url="{{ url('dashboard/challenge/add_team_member_form/' . $challenge->id ) }}">
                                                                        <img src="{{ asset('images/dashboard/dot-icon1.png')}}" alt=""><span>Add Hidden Soldiers</span>
                                                                    </a> -->
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- options-->

                                            <div class="nk-block nk-block-lg bg-white table">
                                                <div class="card bg-white">
                                                    <div class="table-content">
                                                        <div class="table-search-bar-top">
                                                            <div class="row gy-4">
                                                                <div class="col-sm-4">
                                                                    <div class="table-searchbar">
                                                                        <div class="form-group">
                                                                            <div class="form-control-wrap">
                                                                                <div class="form-icon form-icon-left">
                                                                                    <em class="icon ni ni-search"></em>
                                                                                </div>
                                                                                <input type="text" class="form-control"
                                                                                    id="searchBar" placeholder="Search">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4"></div>
                                                            </div>
                                                        </div>
                                                        <table
                                                            class=" nowrap nk-tb-list nk-tb-ulist table table-style-3"
                                                            data-export-title="Export">
                                                            <thead>
                                                                <tr class="nk-tb-item nk-tb-head">
                                                                    <th><input type="checkbox"></th>
                                                                    <th class="nk-tb-col tb-col-md">
                                                                        Stage
                                                                    </th>
                                                                    <th class="nk-tb-col tb-col-md">
                                                                        Workstream
                                                                    </th>
                                                                    <th class="nk-tb-col tb-col-md">
                                                                        Lead Entity
                                                                    </th>

                                                                    <th class="nk-tb-col tb-col-md">
                                                                        Created at
                                                                    </th>
                                                                    <th class="nk-tb-col">
                                                                        Last update
                                                                    </th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr class="">
                                                                    <td><input type="checkbox"></td>
                                                                    <td class="nk-tb-col tb-col-md">
                                                                        Sustanibility
                                                                    </td>
                                                                    <td class="nk-tb-col tb-col-md">
                                                                        Digital integration with the Central Agriculture
                                                                        Platform of UAE.
                                                                    </td>
                                                                    <td class="nk-tb-col tb-col-md">
                                                                        Road AND Transportation
                                                                        Authority
                                                                    </td>

                                                                    <td class="nk-tb-col tb-col-md">
                                                                        22 NOV 2022
                                                                    </td>
                                                                    <td class="nk-tb-col">
                                                                        23 NOV 2022
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div><!-- .card-preview -->
                                            </div><!-- nk-block -->
                                        </div>
                                    </div>
                                    <!------- end of members tab ---->


                                    <!---------- members tab ------->
                                    <div class="tab-pane" id="tabItem6">
                                        <div class="global-bg-white">

                                            <!-- options-->
                                            <div class="page-right-dot-option dot-options">
                                                <div class="nk-file-actions">
                                                    <div class="dropdown">
                                                        <a href=""
                                                            class="dropdown-toggle btn btn-sm btn-icon btn-trigger"
                                                            data-toggle="dropdown"><em
                                                                class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt no-bdr">

                                                                <li>
                                                                    <a href="javascript:void(0);" data-act="ajax-modal"
                                                                        data-complete-location="true" data-method="get"
                                                                        data-action-url="{{ route('dashboard.challenge.add-user-form' , [$challenge->id, 'team member'] ) }}">
                                                                        <img src="{{ asset('images/dashboard/dot-icon1.png')}}"
                                                                            alt=""><span>Add Team Member</span>
                                                                    </a>
                                                                    <a href="javascript:void(0);" data-act="ajax-modal"
                                                                        data-complete-location="true" data-method="get"
                                                                        data-action-url="{{ route('dashboard.challenge.add-user-form' , [$challenge->id, 'challenge_coach'] ) }}">
                                                                        <img src="{{ asset('images/dashboard/dot-icon1.png')}}"
                                                                            alt=""><span>Add Coach</span>
                                                                    </a>
                                                                    <a href="javascript:void(0);" data-act="ajax-modal"
                                                                        data-complete-location="true" data-method="get"
                                                                        data-action-url="{{ route('dashboard.challenge.add-user-form' , [$challenge->id, 'team leader'] ) }}">
                                                                        <img src="{{ asset('images/dashboard/dot-icon1.png')}}"
                                                                            alt=""><span>Add Team Leaders</span>
                                                                    </a>
                                                                    <a href="javascript:void(0);" data-act="ajax-modal"
                                                                        data-complete-location="true" data-method="get"
                                                                        data-action-url="{{ route('dashboard.challenge.add-user-form' , [$challenge->id, 'chalenge_leadership'] ) }}">
                                                                        <img src="{{ asset('images/dashboard/dot-icon1.png')}}"
                                                                            alt=""><span>Add Leadership</span>
                                                                    </a>
                                                                    <a href="javascript:void(0);" data-act="ajax-modal"
                                                                        data-complete-location="true" data-method="get"
                                                                        data-action-url="{{ route('dashboard.challenge.add-user-form' , [$challenge->id, 'challenge_sponsor'] ) }}">
                                                                        <img src="{{ asset('images/dashboard/dot-icon1.png')}}"
                                                                            alt=""><span>Add Sponsor</span>
                                                                    </a>
                                                                    <a href="javascript:void(0);" data-act="ajax-modal"
                                                                        data-complete-location="true" data-method="get"
                                                                        data-action-url="{{ route('dashboard.challenge.add-user-form' , [$challenge->id, 'hidden soldier'] ) }}">
                                                                        <img src="{{ asset('images/dashboard/dot-icon1.png')}}"
                                                                            alt=""><span>Add Hidden Soldiers</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- options-->

                                            <div class="nk-block nk-block-lg bg-white table">
                                                <div class="card bg-white">
                                                    <div class="table-content">
                                                        <div class="table-search-bar-top">
                                                            <div class="row gy-4">
                                                                <div class="col-sm-4">
                                                                    <div class="table-searchbar">
                                                                        <div class="form-group">
                                                                            <div class="form-control-wrap">
                                                                                <div class="form-icon form-icon-left">
                                                                                    <em class="icon ni ni-search"></em>
                                                                                </div>
                                                                                <input type="text" class="form-control"
                                                                                    id="searchBar" placeholder="Search">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4"></div>
                                                                <div class="col-sm-4">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="table-scroll-mobile">

                                                            <table class="nk-tb-list nk-tb-ulist table table-style-3"
                                                                id="challenges-table" data-export-title="Export"
                                                                style="width: 100%;">
                                                                <thead>
                                                                    <tr class="nk-tb-item nk-tb-head">
                                                                        <th><input type="checkbox"></th>
                                                                        <th class="nk-tb-col">
                                                                            <div class="dropdown">
                                                                                <a class="dropdown-toggle btn btn-icon btn-trigger"
                                                                                    data-toggle="dropdown"
                                                                                    aria-expanded="false">Team Memeber
                                                                                    <em
                                                                                        class="icon ni ni-caret-down-fill"></em></a>
                                                                                <div
                                                                                    class="dropdown-menu dropdown-menu-right dropdown-menu-xs left115px">
                                                                                    <ul class="link-list-plain">
                                                                                        <li><a href="#"><img
                                                                                                    src="{{ asset('images/dashboard/reflect-icon1.png')}}"
                                                                                                    alt=""> From
                                                                                                smallest to the
                                                                                                largest</a></li>
                                                                                        <li><a href="#"><img
                                                                                                    src="{{ asset('images/dashboard/reflect-icon2.png')}}"
                                                                                                    alt=""> From largest
                                                                                                to smallest</a></li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </th>
                                                                        <th class="nk-tb-col tb-col-md">
                                                                            Role
                                                                        </th>
                                                                        <th class="nk-tb-col tb-col-md">
                                                                            Entity
                                                                        </th>

                                                                        <th class="nk-tb-col tb-col-md">
                                                                            Email
                                                                        </th>
                                                                        <th class="nk-tb-col">
                                                                            Phone
                                                                        </th>
                                                                        <th class="nk-tb-col">
                                                                            Action
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                            </table>

                                                        </div>
                                                    </div>
                                                </div><!-- .card-preview -->
                                            </div><!-- nk-block -->
                                        </div>
                                    </div>
                                    <!------- end of members tab ---->

                                    <!---------- details tab ------->
                                    <div class="tab-pane" id="tabItem7">
                                        <div class="global-bg-white">
                                            <div class="nk-block nk-block-lg bg-white table">
                                                <div class="card bg-white">

                                                    <div class="intitesDetails">
                                                        <form
                                                            action="{{route('dashboard.challenges.update',$challenge->id)}}"
                                                            method="POST" enctype="multipart/form-data"
                                                            data-modal="#ajax_model" data-form="ajax-form"
                                                            data-reload="true">
                                                            @csrf
                                                            @method('put')
                                                            <div class="modal-body p-0">
                                                                <div
                                                                    class="intitiesDetail-top intitiesDetail-top-2-cols">

                                                                    <div class="title">
                                                                        <div class="modal-header align-center"
                                                                            style="border-bottom:none">
                                                                            <div class="nk-file-title">
                                                                                <div class="nk-file-icon">
                                                                                    <span class="nk-file-icon-type">
                                                                                        <img class="width-sm"
                                                                                            src="{{ asset('images/dashboard/dot-icon1.png')}}"
                                                                                            alt="">
                                                                                    </span>
                                                                                </div>
                                                                                <div class="nk-file-name">
                                                                                    <div class="nk-file-name-text"><span
                                                                                            class="title">Challenge
                                                                                            Detail</span></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="delete-update-btn">
                                                                        <button type="submit"
                                                                            class="btn btn-round btn-update"><em
                                                                                class="icon ni ni-update"></em><span>UPDATE</span>
                                                                        </button>
                                                                    </div>
                                                                </div>


                                                                <div class="container px-5">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div
                                                                                class="single-form-field single-form-row">
                                                                                <label><span>*</span> Challenge name in
                                                                                    English</label>
                                                                                <input type="text" name="name_en"
                                                                                    placeholder="Challenge name in English"
                                                                                    value="{{$challenge->name_en}}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div
                                                                                class="single-form-field single-form-row">
                                                                                <label><span>*</span> Challenge Name In
                                                                                    Arabic</label>
                                                                                <input type="text"
                                                                                    placeholder="Challenge name in Arabic"
                                                                                    name="name_ar"
                                                                                    value="{{$challenge->name_ar}}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div
                                                                                class="single-form-field single-form-row">
                                                                                <label><span>*</span> Description In
                                                                                    English</label>
                                                                                <input type="text"
                                                                                    placeholder="Description in English"
                                                                                    name="description_en"
                                                                                    value="{{$challenge->description_en}}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div
                                                                                class="single-form-field single-form-row">
                                                                                <label><span>*</span> Description In
                                                                                    Arabic</label>
                                                                                <input type="text"
                                                                                    placeholder="Description in Arabic"
                                                                                    name="description_ar"
                                                                                    value="{{$challenge->description_ar}}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div
                                                                                class="single-form-field single-form-row">
                                                                                <label>Baseline</label>
                                                                                <input type="text"
                                                                                    placeholder="Baseline"
                                                                                    name="baseline"
                                                                                    value="{{$challenge->baseline}}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div
                                                                                class="single-form-field single-form-row">
                                                                                <label><span>*</span> Lead
                                                                                    Enitity</label>
                                                                                <select name="lead_entity" id=""
                                                                                    required
                                                                                    class="form-select form-control form-select-modal"
                                                                                    data-search="on">
                                                                                    <option value="" selected="">Select
                                                                                        lead entity</option>
                                                                                    @foreach ($leadEntities as
                                                                                    $leadEntity)
                                                                                    <option value="{{$leadEntity->id}}"
                                                                                        {{$challenge->lead_entity_id ==
                                                                                        $leadEntity->id ? 'selected' :
                                                                                        ''}}>{{$leadEntity->name_en}}
                                                                                    </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div
                                                                                class="single-form-field single-form-row">
                                                                                <label><span>*</span> Cohort</label>
                                                                                <select name="cohort" id=""
                                                                                    class="form-select form-control form-select-modal"
                                                                                    data-search="on">
                                                                                    <option value="" selected="">Select
                                                                                        cohort</option>
                                                                                    @foreach ($cohorts as $cohort)
                                                                                    <option value="{{$cohort->id}}"
                                                                                        {{$challenge->cohort_id ==
                                                                                        $cohort->id ? 'selected' :
                                                                                        ''}}>{{$cohort->name_en}}
                                                                                    </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div
                                                                                class="single-form-field single-form-row">
                                                                                <label>Sidebar icon (130 x 130
                                                                                    px)</label>

                                                                                <div class="row">
                                                                                    <div class="col-md-3">
                                                                                        <img
                                                                                            src="{{$challenge->sidebar_icon != null ? asset('storage/' . $challenge->sidebar_icon) : '/images/dashboard/food-safety.png' }}">
                                                                                    </div>
                                                                                    <div class="col-md-9">
                                                                                        <div class="custom-file mt-1">
                                                                                            <input type="file"
                                                                                                class="custom-file-input"
                                                                                                id="customFile2"
                                                                                                name="sidebar_icon">
                                                                                            <label
                                                                                                class="custom-file-label"
                                                                                                for="customFile">Choose
                                                                                                icon</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div
                                                                                class="single-form-field single-form-row">
                                                                                <label>Thumbnail icon (130 x 130
                                                                                    px)</label>

                                                                                <div class="row">
                                                                                    <div class="col-md-3">
                                                                                        <img
                                                                                            src="{{$challenge->thumbnail_icon ? asset('storage/' . $challenge->thumbnail_icon) : '/images/dashboard/food-safety-filled.png'}}">
                                                                                    </div>
                                                                                    <div class="col-md-9">
                                                                                        <div class="custom-file mt-1">
                                                                                            <input type="file"
                                                                                                class="custom-file-input"
                                                                                                id="customFile2"
                                                                                                name="thumbnail_icon">
                                                                                            <label
                                                                                                class="custom-file-label"
                                                                                                for="customFile">Choose
                                                                                                icon</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>




                                                </div>
                                                </form>
                                            </div><!-- .modal-body -->
                                        </div>
                                    </div><!-- .card-preview -->
                                    <div class="tab-pane" id="tabItem8">
                                        <div class="global-bg-white">
                                            <!-- options-->
                                            <div class="page-right-dot-option dot-options">
                                                <div class="nk-file-actions">
                                                    <div class="dropdown">
                                                        <a href=""
                                                            class="dropdown-toggle btn btn-sm btn-icon btn-trigger"
                                                            data-toggle="dropdown"><em
                                                                class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="javascript:void(0);" data-act="ajax-modal1"
                                                                        data-method="get"
                                                                        data-action-url="{{ route('dashboard.challenge-entity.create',$challenge->id) }}"><img
                                                                            src="{{ asset('images/dashboard/dot-icon1.png')}}"
                                                                            alt=""><span>Add Entity</span></a></li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- options-->
                                            <div class="nk-block nk-block-lg bg-white table">
                                                <div class="card bg-white">
                                                    <div class="table-content">
                                                        <div class="table-search-bar-top">
                                                            <div class="row gy-4">
                                                                <div class="col-sm-4">
                                                                    <div class="table-searchbar">
                                                                        <div class="form-group">
                                                                            <div class="form-control-wrap">
                                                                                <div class="form-icon form-icon-left">
                                                                                    <em class="icon ni ni-search"></em>
                                                                                </div>
                                                                                <input type="text" class="form-control"
                                                                                    id="entities_searchBar"
                                                                                    placeholder="Search">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4"></div>
                                                                <div class="col-sm-4">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="table-scroll-mobile">

                                                            @include('challenge.entities.index')

                                                        </div>
                                                    </div>
                                                </div><!-- .card-preview -->
                                            </div><!-- nk-block -->
                                        </div><!-- nk-block -->
                                    </div>
                                </div><!-- nk-block -->
                            </div>

                            <!---------- details tab ------->

                        </div>
                        <!------- end of details tab ---->



                    </div>
                    <!------- end of details tab ---->



                </div>
            </div>
        </div><!-- .card-preview -->
    </div>
</div>
@endsection

@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
<script type="text/javascript">
    var challenge = {!!json_encode($challenge, JSON_HEX_TAG) !!};
        $('#clock').countdown(challenge['cohort']['end_date'], function(event) {
            $(this).html(event.strftime(
                '<div class="day_wrap"> <div class="days colorRed">%D</div>days</div>  <div class="day_wrap dot">:</div> <div class="day_wrap"><div class="days">%H</div>hours</div> <div class="day_wrap dot">:</div> <div class="day_wrap"><div class="days">%M</div>minutes</div>'
            
            ));
        });
    $(document).ready(function(){
        $('#myTab a[data-toggle="tab"]').on('show.bs.tab', function(e) {
            localStorage.setItem('activeTab', $(e.target).attr('href'));
        });
        var activeTab = localStorage.getItem('activeTab');
        if (activeTab) {
            $('#myTab a[href="' + activeTab + '"]').tab('show');
        }
    });
    function get_modal() {
        var challenge = {!!json_encode($challenge, JSON_HEX_TAG) !!};

        $.ajax({
            url: "/dashboard/challenge/get_existing_user_form/" + challenge.id,
            success: function(data) {
                $('#model-target').html(data);
            }
        });
    }


    $('#add-risk').on('shown.bs.modal', function(e) {
        $('.form-select-2').select2({
            width: '100%'
        });
        $('.datepicker').datepicker({
            format: "yyyy-mm-dd",
        });
    });


    // function get_challenge_modal() {
    //     $.ajax({
    //         url: "/dashboard/challenge/get_plans?page=" + page,
    //         data: {
    //             challenge: challenge
    //         },
    //         success: function(data) {
    //             $('#plans_table_data').html(data);
    //             $('#plans_table_data table').DataTable({});
    //         }
    //     });
    // }

    // function fetch_data(page) {
    //     challenge = '{{$challenge->id}}'
    //     $.ajax({
    //         url: "/dashboard/challenge/get_plans?page=" + page,
    //         data: {
    //             challenge: challenge
    //         },
    //         success: function(data) {
    //             $('#plans_table_data').html(data);
    //             $('#plans_table_data table').DataTable({});
    //         }
    //     });
    // }
    $(document).ready(function() {
        //fetch_data(1);
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            //fetch_data(page);
        });

    });
    $('body').on('click', '[data-act=ajax-modal1]', function() {
        const _self = $(this);

        const content = $("#ajax_model_content");
        const spinner = $("#ajax_model_spinner");

        content.hide();
        spinner.show();

        $("#ajax_model").modal({
            backdrop: "static"
        });
        $("#ajax_model_title").html(_self.attr('data-title'));
        var metaData = {};
        $(this).each(function() {
            $.each(this.attributes, function() {
                if (this.specified && this.name.match("^data-post-")) {
                    var dataName = this.name.replace("data-post-", "");
                    metaData[dataName] = this.value;
                }
            });
        });

        $.ajax({
            url: _self.attr('data-action-url'),
            data: metaData,
            success: function(response) {
                spinner.hide();
                content.html(response).show();
                $('#ajax_model select').css('width', '100%');
                $('.form-select-modal').select2({
                    width: '100%',

                });
                $('.datepicker').datepicker({
                    format: "yyyy-mm-dd",
                });
            }
        })

    });
    $('body').on('submit', '[data-form=ajax-form-plans]', function(e) {
        e.preventDefault();
        const _self = $(this);
        const btn = _self.find('[data-button=submit]');
        const modal = _self.data('modal');
        axios({
                url: _self.attr('action'),
                method: _self.attr('method'),
                data: new FormData(_self[0]),
            })
            .then(response => {
                if (response.status == 200) {
                    if (modal !== '') $(modal).modal('hide');
                    toastMessage(response.data.message, 'success');
                    _self.trigger('reset');
                    //fetch_data(1);
                } else toastMessage();
            })
            .catch(error => {
                toastMessage(error.response.data.message);
            })
    });

    $(function() {

        $('#modal-challenge').on('shown.bs.modal', function(e) {
            $('.form-select-2').select2();
        });

        var table = $('#risks-table').DataTable({
            ajax: {
                url: '{{ route("dashboard.risks.datatable") }}',
                cache: false,
                "data": function(d) {
                    d.challenge = '{{$challenge->id}}';
                }
            },
            select: {
                style: 'multi',
                selector: 'td:first-child .select-checkbox',
            },
            processing: true,
            serverSide: true,
            scrollX: false,
            autoWidth: false,
            stateSave: false,
            lengthChange: false,
            bAutoWidth: false,
            language: {
                paginate: {
                    previous: "Prev",
                    next: "Next",
                },
                info: "_START_ - _END_ of _TOTAL_",
            },
            columns: [{
                    targets: 0,
                    sWidth: '5%',
                    searchable: false,
                    orderable: false,
                    className: 'dt-body-center',
                    render: function(data, type, full, meta) {
                        return '<input type="checkbox" name="id[]" value="' +
                            $('<div/>').text(data).html() + '">';
                    }
                },
                {
                    data: 'title_en',
                    name: 'title_en',
                    sClass: "nk-tb-col",
                    sWidth: '25%'
                },
                {
                    data: 'impact',
                    name: 'impact',
                    sClass: "nk-tb-col",
                    orderable: false,
                    sWidth: '15%'
                },
                {
                    data: 'probability',
                    name: 'probability',
                    sClass: "nk-tb-col",
                    orderable: false,
                    searchable: false,
                    sWidth: '10%'
                },

                {
                    data: 'status',
                    name: 'status',
                    orderable: false,
                    searchable: false,
                    sClass: "nk-tb-col",
                    sWidth: '15%'
                },

                {
                    data: 'identification_date',
                    name: 'identification_date',
                    orderable: false,
                    searchable: false,
                    sClass: "nk-tb-col",
                    sWidth: '5%'
                },
                // {data: 'identification_date', name: 'identification_date', orderable: false, searchable: false, sClass:"nk-tb-col",  sWidth: '5%'},
                // {data: 'identification_date', name: 'identification_date', orderable: false, searchable: false, sClass:"nk-tb-col",  sWidth: '5%'},
            ],
            "fnRowCallback": function(nRow, aData, iDisplayIndex) {
                $(nRow).addClass('nk-tb-item');
                $('#risks-table_info').parents('.col-md-5').css({
                    'order': '2',
                    'text-align': 'right'
                });
                $('#risks-table_paginate').parents('.col-md-7').css('order', '1');
            }
        });
        $('#searchBar').on('keyup', function() {
            table.search($('#searchBar').val()).draw();
        });
        $('.asc-sort').on('click', function() {
            table.order([
                [$(this).attr('column-order'), 'desc']
            ]).draw();
        });
        $('.dsc-sort').on('click', function() {
            table.order([
                [$(this).attr('column-order'), 'asc']
            ]).draw();
        });
        table.on("change", "th >.select-checkbox", function() {
                if ($(this).is( ":checked" )) {
                    $('.row-checks .select-checkbox').prop('checked', true);
                    table.rows().select();
                }else{
                    table.rows().deselect();
                    $('.row-checks .select-checkbox').prop('checked', false);

                }
            }).on("select deselect", function() {
                if (table.rows({
                        selected: true
                    }).count() !== table.rows().count()) {

                    $("th >.select-checkbox").prop('checked', false);
                } else {
                    $("th >.select-checkbox").prop('checked', true);

                }
            }).on( 'draw', function () {
                $("th >.select-checkbox").prop('checked', false);
            } );

    });
    $('body').on('click', '.stage_changer', function(e) {
        e.preventDefault();
        const _self = $(this);

        axios({
                url: _self.attr('action'),
                method: 'PUT',
                data: {
                    stage: $(this).data('stage')
                },
            })
            .then(response => {
                if (response.status == 200) {

                    toastMessage(response.data.message, 'success');
                    window.location.reload();

                } else toastMessage();
            })
            .catch(error => {
                toastMessage(error.response.data.message);
            })
        // alert($(this).data('stage'));
    })


    $(function() {
        var challenge = {!!json_encode($challenge, JSON_HEX_TAG) !!};
        var table = $('#challenges-table').DataTable({
            ajax: {
                url: "/dashboard/challenges-members-dt/" + challenge.id,
                cache: false,
                "data": function(d) {
                    d.challenge = challenge.id;
                }
            },
            select: {
                style: 'multi',
                selector: 'td:first-child .select-checkbox',
            },
            processing: true,
            serverSide: true,
            scrollX: false,
            autoWidth: true,
            stateSave: false,
            lengthChange: false,
            language: {
                paginate: {
                    previous: "Prev",
                    next: "Next",
                },
                info: "_START_ - _END_ of _TOTAL_",
                select: {
                    rows: {
                        _: " (%d rows selected)",
                        0: "",
                        1: " (1 row selected)",
                    }
                }
            },
            columns: [{
                    targets: 0,
                    searchable: false,
                    orderable: false,
                    className: 'row-checks',
                    render: function(data, type, full, meta) {
                        return '<input type="checkbox"  class="select-checkbox" name="id[]" value="' +
                            $('<div/>').text(data).html() + '">';
                    }
                },
                {
                    data: 'team_members',
                    name: 'Team Member',
                    sClass: "nk-tb-col",
                    sWidth: '20%'
                },
                {
                    data: 'role',
                    name: 'role',
                    sClass: "nk-tb-col",
                    orderable: false,
                    sWidth: '25%',
                },
                {
                    data: 'entity',
                    name: 'entity',
                    orderable: false,
                    searchable: false,
                    sClass: "nk-tb-col",
                    sWidth: '15%'
                },
                {
                    data: 'email',
                    name: 'email',
                    orderable: false,
                    searchable: false,
                    sClass: "nk-tb-col",
                    sWidth: '15%'
                },
                {
                    data: 'phone',
                    name: 'phone',
                    sClass: "nk-tb-col",
                    orderable: false,
                    searchable: false,
                    sWidth: '20%'
                },
                {
                    data: 'action',
                    name: 'action',
                    sClass: "nk-tb-col",
                    orderable: false,
                    searchable: false,
                    sWidth: '5%'
                },
            ],
            "fnRowCallback": function(nRow, aData, iDisplayIndex) {
                $(nRow).addClass('nk-tb-item');
                $('#challenges-table_info').parents('.col-md-5').css({
                    'order': '2',
                    'text-align': 'right'
                });
                $('#challenges-table_paginate').parents('.col-md-7').css('order', '1');
            }
        });
        $('#searchBar').on('keyup', function() {
            table.search($('#searchBar').val()).draw();
        });
        $('.asc-sort').on('click', function() {
            table.order([
                [$(this).attr('column-order'), 'desc']
            ]).draw();
        });
        $('.dsc-sort').on('click', function() {
            table.order([
                [$(this).attr('column-order'), 'asc']
            ]).draw();
        });

        $('.filter-status').on('click', function() {
            status = $(this).data('status');
            table.draw();
        });
        table.on("change", "th >.select-checkbox", function() {
            if ($(this).is(":checked")) {
                $('.row-checks .select-checkbox').prop('checked', true);
                table.rows().select();
            } else {
                table.rows().deselect();
                $('.row-checks .select-checkbox').prop('checked', false);

            }
        }).on("select deselect", function(e, dt, type, indexes) {

            if (table.rows({
                    selected: true
                }).count() !== table.rows().count()) {

                $("th >.select-checkbox").prop('checked', false);
            } else {
                $("th >.select-checkbox").prop('checked', true);

            }
        }).on('draw', function() {
            $("th >.select-checkbox").prop('checked', false);
        });
    });
    $(document).on('change','#exixting_entity',function(){
            if($(this).is(':checked')){
                $('#all_entities').removeClass('d-none');
                $('#single_entity').addClass('d-none');
            }else{
                $('#all_entities').addClass('d-none');
                $('#single_entity').removeClass('d-none');
            }
        })
     $(function() {
        var table =  $('#entities_table').DataTable({
                ajax: {
                    url: '{{ route("dashboard.challenge-entities.datatable") }}',
                    cache: false,
                    "data": function(d) {
                        d.challenge =  '{{$challenge->id}}';
                    }
                },
                processing: true,
                select: {
                    style: 'multi',
                    selector: 'td:first-child .select-checkbox',
                },
                serverSide: true,
                scrollX: false,
                autoWidth: false,
                stateSave: false,
                lengthChange: false,
                language: {
                    paginate: {
                        previous: "Prev",
                        next: "Next",
                    },
                    info:"_START_ - _END_ of _TOTAL_",
                    select:{
                        rows:{
                            _:" (%d rows selected)",
                            0:"",
                            1:" (1 row selected)",
                        }
                    }
                },
                columns: [
                    {data: 'name_en', name: 'name_en', sClass:"nk-tb-col", sWidth:'30%',},
                    {data: 'members', name: 'members', sClass:"nk-tb-col", sWidth:'15%',},
                    {data: 'sponsor', name: 'sponsor', sClass:"nk-tb-col", sWidth:'15%',},
                    {data: 'lead_entity_id', name: 'lead_entity_id', sClass:"nk-tb-col", sWidth:'15%',},
                    {data: 'actions', name: 'actions', sClass:"nk-tb-col", sWidth:'15%',},

                ],
                "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                    $(nRow).addClass('nk-tb-item');
                    $('#entities_table_info').parents('.col-md-5').css({'order':'2', 'text-align':'right'});
                    $('#entities_table_paginate').parents('.col-md-7').css('order','1');
                }
            });
            $('#entities_searchBar').on( 'keyup', function () {
                table.search($('#entities_searchBar').val()).draw();
            });
            $('.asc-sort').on('click', function () {
                table.order([[$(this).attr('column-order'), 'desc']]).draw();
            });
            $('.dsc-sort').on('click', function () {
                table.order([[$(this).attr('column-order'), 'asc']]).draw();
            });
    });
    // $(function() {
    //     var tableworkstream =  $('#work_stream').DataTable({
    //             ajax: {
    //                 url: '{{ route("dashboard.acceleration.workstream.datatable") }}',
    //                 cache: false,
    //                 "data": function(d) {
    //                     d.challenge =  '{{$challenge->id}}';
    //                 }
    //             },
    //             processing: true,
    //             select: {
    //                 style: 'multi',
    //                 selector: 'td:first-child .select-checkbox',
    //             },
    //             serverSide: true,
    //             scrollX: false,
    //             autoWidth: false,
    //             stateSave: false,
    //             lengthChange: false,
    //             language: {
    //                 paginate: {
    //                     previous: "Prev",
    //                     next: "Next",
    //                 },
    //                 info:"_START_ - _END_ of _TOTAL_",
    //                 select:{
    //                     rows:{
    //                         _:" (%d rows selected)",
    //                         0:"",
    //                         1:" (1 row selected)",
    //                     }
    //                 }
    //             },
    //             columns: [
    //                 {data: 'name_en', name: 'name_en', sClass:"nk-tb-col", sWidth:'30%',},
    //                 {data: 'leader_id', name: 'Leader', sClass:"nk-tb-col", sWidth:'15%',},
    //                 {data: 'members', name: 'members', sClass:"nk-tb-col", sWidth:'15%',},
    //                 {data: 'actions', name: 'actions', orderable: false, searchable: false, sClass:"nk-tb-col", sWidth:'10%',},
    //             ],
    //             "fnRowCallback": function (nRow, aData, iDisplayIndex) {
    //                 $(nRow).addClass('nk-tb-item');
    //                 $('#work_stream_info').parents('.col-md-5').css({'order':'2', 'text-align':'right'});
    //                 $('#work_stream_paginate').parents('.col-md-7').css('order','1');
    //             }
    //         });
    //         $('#searchBar').on( 'keyup', function () {
    //             tableworkstream.search($('#searchBar').val()).draw();
    //         });
    //         $('.asc-sort').on('click', function () {
    //             tableworkstream.order([[$(this).attr('column-order'), 'desc']]).draw();
    //         });
    //         $('.dsc-sort').on('click', function () {
    //             tableworkstream.order([[$(this).attr('column-order'), 'asc']]).draw();
    //         });
    // });
</script>
@endpush

<style>
    #challenge-plans-table_paginate {
        display: none;
    }

    #challenge-plans-table_info {
        display: none;
    }
</style>
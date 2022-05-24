@extends('layouts.app')
@section('content')
<div class="nk-content cohortDetails">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="breadcrumb-title">
                    <h5><a href="{{route('dashboard.cohorts.index')}}" class="text-dark"><i class="zmdi zmdi-chevron-left"></i> Cohorts</a></h5>
                    <ul>
                        <li>Cohorts > {{$cohort->name_en}}</li>
                    </ul>
                </div>
               <div class="tab-area">
                   <div class="tab-section">
                    <div class="card card-preview">
                        <div class="card-inner">
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul class="nav nav-tabs mt-n3 justify-content-start m-3">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#tabItem1">Challenges</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tabItem2">Cohort Details</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tabItem5">Entities</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tabItem4">Touch Points</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                     <!-- @@ manage Modal @e -->
                                        <div class="modal fade modalIntities" tabindex="-1" role="dialog" id="manage-stage"  data-backdrop="static">
                                            <div class="modal-dialog modal-md" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header align-center">
                                                        <div class="nk-file-title">
                                                            <div class="nk-file-icon">
                                                                <span class="nk-file-icon-type">
                                                                    <img class="width-sm" src="{{ asset('images/dashboard/manage-stage-icon.png')}}" alt="">
                                                                </span>
                                                            </div>
                                                            <div class="nk-file-name">
                                                                <div class="nk-file-name-text"><span class="title">Manage Stages</span></div>
                                                            </div>
                                                        </div>
                                                        <div class="single-form-field">
                                                            <div class="preview-block">
                                                                <div class="custom-control custom-switch checked">
                                                                    <input type="checkbox" class="custom-control-input" checked="" id="customSwitch3">
                                                                    <label class="custom-control-label" for="customSwitch3"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body p-0">
                                                        <form action="">
                                                            <div class="form-grid">
                                                                <div class="form-column">
                                                                    <div class="single-form-field">
                                                                        <label><span>*</span> NAME IN ENGLISH</label>
                                                                        <input type="text" placeholder="">
                                                                    </div>
                                                                    <div class="single-form-field">
                                                                        <label><span>*</span> Stage Number</label>
                                                                        <input type="text" placeholder="1">
                                                                    </div>
                                                                </div>

                                                                <div class="form-column">
                                                                    <div class="single-form-field">
                                                                        <label><span>*</span> NAME IN ARABIC</label>
                                                                        <input type="text" placeholder="">
                                                                    </div>
                                                                    <div class="single-form-field pt-5">
                                                                        <a href="#" class="btn btn-round btn-delete text-white"><em class="icon ni ni-trash mr-1"></em>Delete</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div><!-- .modal-body -->
                                                    <div class="modal-footer bg-white">
                                                        <ul class="btn-toolbar g-3">
                                                            <li><a href="#" data-dismiss="modal" class="btn btn-outline-light btn-white">CANCEL</a></li>
                                                            <li><a href="#" class="btn bg-green btn-round text-white">SAVE</a></li>
                                                        </ul>
                                                    </div><!-- .modal-footer -->
                                                </div><!-- .modal-content -->
                                            </div><!-- .modla-dialog -->
                                        </div><!-- .modal -->

                                        <!-- @@ edit-cohort Modal @e -->
                                        <div class="modal fade modalIntities" tabindex="-1" role="dialog" id="modal-challenge" data-backdrop="static">
                                            <div class="modal-dialog modal-md" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header align-center">
                                                        <div class="nk-file-title">
                                                            <div class="nk-file-icon">
                                                                <span class="nk-file-icon-type">
                                                                    <img class="width-sm" src="{{ asset('images/dashboard/dot-icon1.png')}}" alt="">
                                                                </span>
                                                            </div>
                                                            <div class="nk-file-name">
                                                                <div class="nk-file-name-text"><span class="title">Add Challenge</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form action="{{route('dashboard.challenges.store')}}" method="POST"
                                                        data-form="ajax-form" data-datatable="#challenges-table" data-modal="#modal-challenge" data-form-reset="true">
                                                        @csrf
                                                        <div class="modal-body p-0">
                                                        
                                                            <input type="hidden" name="cohort" value="{{$cohort->id}}">
                                                            <div class="form-grid">
                                                                <div class="form-column">
                                                                    <div class="single-form-field">
                                                                        <label><span>*</span> Challenge name in English</label>
                                                                        <input type="text" name="name_en" placeholder="" required>
                                                                    </div>
                                                                    <div class="single-form-field">
                                                                        <label><span>*</span> Description In English</label>
                                                                        <input type="text" placeholder="" name="description_en" required>
                                                                    </div>
                                                                    <div class="single-form-field">
                                                                        <label><span>*</span> Lead Enitity</label>
                                                                        <select name="lead_entity" id="" required class="form-control form-select-2" data-search="on">
                                                                            <option value="" selected="">Select lead entity</option>
                                                                            @foreach ($leadEntities as $leadEntity)
                                                                            <option value="{{$leadEntity->id}}">{{$leadEntity->name_en}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="single-form-field">
                                                                        <label>Sidebar icon (130 x 130 px)</label>
                                                    
                                                                        <div class="row">
                                                                            <div class="col-md-3">
                                                                                <img src="/images/dashboard/food-safety.png">
                                                                            </div>
                                                                            <div class="col-md-9">
                                                                                <div class="custom-file mt-1">
                                                                                    <input type="file" class="custom-file-input" id="customFile2" name="sidebar_icon">
                                                                                    <label class="custom-file-label" for="customFile">Choose icon</label>
                                                                                 </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-column">
                                                                    <div class="single-form-field">
                                                                        <label><span>*</span> Challenge Name In Arabic</label>
                                                                        <input type="text" placeholder="" name="name_ar" required>
                                                                    </div>
                                                                    <div class="single-form-field">
                                                                        <label><span>*</span> Description In Arabic</label>
                                                                        <input type="text" placeholder="" name="description_ar" required>
                                                                    </div>
                                                                    <div class="single-form-field">
                                                                        <label>Baseline</label>
                                                                        <input type="text" placeholder="Baseline" name="baseline" value="" required>
                                                                    </div>
                                                                    <div class="single-form-field">
                                                                        <label>Thumbnail icon (130 x 130 px)</label>
                                                    
                                                                        <div class="row">
                                                                            <div class="col-md-3">
                                                                                <img src="/images/dashboard/food-safety-filled.png">
                                                                            </div>
                                                                            <div class="col-md-9">
                                                                                <div class="custom-file mt-1">
                                                                                    <input type="file" class="custom-file-input" id="customFile2" name="thumbnail_icon">
                                                                                    <label class="custom-file-label" for="customFile">Choose icon</label>
                                                                                 </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                        </div><!-- .modal-body -->
                                                        <div class="modal-footer bg-white">
                                                            <ul class="btn-toolbar g-3">
                                                                <li><a href="#" data-dismiss="modal" class="btn btn-outline-light btn-white">CANCEL</a></li>
                                                                <li><button type="submit" class="btn bg-green btn-round text-white">SAVE</a></li>
                                                            </ul>
                                                        </div><!-- .modal-footer -->
                                                    </form>
                                                </div><!-- .modal-content -->
                                            </div><!-- .modla-dialog -->
                                        </div><!-- .modal -->

                                        <!-- @@ Challenge Modal @e -->
                                        <div class="modal fade modalIntities" tabindex="-1" role="dialog" id="modal-challenge" data-backdrop="static"> 
                                            <div class="modal-dialog modal-md" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header align-center">
                                                        <div class="nk-file-title">
                                                            <div class="nk-file-icon">
                                                                <span class="nk-file-icon-type">
                                                                    <img class="width-xs" src="{{ asset('images/dashboard/start.png')}}" alt="">
                                                                </span>
                                                            </div>
                                                            <div class="nk-file-name">
                                                                <div class="nk-file-name-text"><span class="title">Sustainability </span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body p-0">
                                                        <div class="modal-style-2">
                                                            <form action="">
                                                                <div class="form-grid">
                                                                    <h5>Are you sure you want to activate the sustainability phase for Gender Balance
                                                                        in the Financial and Banking Sector?</h5>
                                                                    <div class="form-column">
                                                                        <div class="single-form-field">
                                                                            <label><span>*</span> Sustainability Lead Enitity</label>
                                                                            <select>
                                                                                <option>Sustainability Lead Enitity</option>
                                                                                <option>Sustainability Lead Enitity</option>
                                                                                <option>Sustainability Lead Enitity</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="single-form-field">
                                                                            <div class="preview-block">
                                                                                <div class="custom-switch checked">
                                                                                    <div class="row">
                                                                                        <div class="col-9">
                                                                                            <span>Send Email to Load User</span>
                                                                                        </div>
                                                                                        <div class="col-3">
                                                                                            <input type="checkbox" class="custom-control-input" checked="" id="customSwitch2">
                                                                                            <label class="custom-control-label" for="customSwitch2"></label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="single-form-field">
                                                                            <div class="preview-block">
                                                                                <div class="custom-switch checked">
                                                                                    <div class="row">
                                                                                        <div class="col-9">
                                                                                            <span>Sustainability Phase with Scalability</span>
                                                                                        </div>
                                                                                        <div class="col-3">
                                                                                            <input type="checkbox" class="custom-control-input" checked="" id="customSwitch4">
                                                                                            <label class="custom-control-label" for="customSwitch4"></label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div><!-- .modal-body -->
                                                    <div class="modal-footer bg-white">
                                                        <ul class="btn-toolbar g-3">
                                                            <li><a href="#" data-dismiss="modal" class="btn btn-outline-light btn-white">CANCEL</a></li>
                                                            <li><a href="#" class="btn bg-green btn-round text-white">SAVE</a></li>
                                                        </ul>
                                                    </div><!-- .modal-footer -->
                                                </div><!-- .modal-content -->
                                            </div><!-- .modla-dialog -->
                                        </div><!-- .modal -->

                                        <!-- @@ Challenge Modal @e -->
                                        <div class="modal fade modalIntities" tabindex="-1" role="dialog" id="export" data-backdrop="static">
                                            <div class="modal-dialog modal-md" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header align-center">
                                                        <div class="nk-file-title">
                                                            <div class="nk-file-icon">
                                                                <span class="nk-file-icon-type">
                                                                    <img class="width-xs" src="{{ asset('images/dashboard/start.png')}}" alt="">
                                                                </span>
                                                            </div>
                                                            <div class="nk-file-name">
                                                                <div class="nk-file-name-text"><span class="title">Sustainability </span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body p-0">
                                                        <div class="modal-style-2">
                                                            <form action="">
                                                                <div class="form-grid">
                                                                    <h5>Are you sure you want to activate the sustainability phase for Gender Balance
                                                                        in the Financial and Banking Sector?</h5>
                                                                    <div class="form-column">
                                                                        <div class="single-form-field">
                                                                            <label><span>*</span> Sustainability Lead Enitity</label>
                                                                            <select>
                                                                                <option>General Directorate Civil Defense Abu Dhabi</option>
                                                                                <option>Sustainability Lead Enitity</option>
                                                                                <option>Sustainability Lead Enitity</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="single-form-field">
                                                                            <label><span>*</span> Sustainability Lead User</label>
                                                                            <select>
                                                                                <option>Team Member</option>
                                                                                <option>Team Member</option>
                                                                                <option>Team Member</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="single-form-field">
                                                                            <div class="preview-block">
                                                                                <div class="custom-switch checked">
                                                                                    <div class="row">
                                                                                        <div class="col-9">
                                                                                            <span>Send Email to Load User</span>
                                                                                        </div>
                                                                                        <div class="col-3">
                                                                                            <input type="checkbox" class="custom-control-input" checked="" id="customSwitch5">
                                                                                            <label class="custom-control-label" for="customSwitch5"></label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="single-form-field">
                                                                            <div class="preview-block">
                                                                                <div class="custom-switch checked">
                                                                                    <div class="row">
                                                                                        <div class="col-9">
                                                                                            <span>Sustainability Phase with Scalability</span>
                                                                                        </div>
                                                                                        <div class="col-3">
                                                                                            <input type="checkbox" class="custom-control-input" checked="" id="customSwitch6">
                                                                                            <label class="custom-control-label" for="customSwitch6"></label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div><!-- .modal-body -->
                                                    <div class="modal-footer bg-white">
                                                        <ul class="btn-toolbar g-3">
                                                            <li><a href="#" data-dismiss="modal" class="btn btn-outline-light btn-white">CANCEL</a></li>
                                                            <li><a href="#" class="btn bg-green btn-round text-white">SAVE</a></li>
                                                        </ul>
                                                    </div><!-- .modal-footer -->
                                                </div><!-- .modal-content -->
                                            </div><!-- .modla-dialog -->
                                        </div><!-- .modal -->
                                </div>
                            </div>
                            <div class="tab-content">
                                
                                <div class="tab-pane active" id="tabItem1">
                                    <div class="global-bg-white">

                                        <div class="page-right-dot-option dot-options">
                                        <div class="nk-file-actions">
                                            <div class="dropdown">
                                                <a href="" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="#modal-challenge" data-toggle="modal"><img src="{{ asset('images/dashboard/dot-icon1.png')}}" alt=""><span>Add Challenge</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                        <div class="nk-block nk-block-lg bg-white">
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
                                                                            <input type="text" class="form-control" id="searchBar" placeholder="Search">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4"></div>
                                                        </div>
                                                    </div>
                                                    <table class=" nowrap nk-tb-list nk-tb-ulist table table-style-3" id="challenges-table" data-export-title="Export">
                                                        <thead>
                                                            <tr class="nk-tb-item nk-tb-head">
                                                                <th><input type="checkbox"></th>
                                                                <th class="nk-tb-col">
                                                                    <div class="dropdown">
                                                                        <a class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" aria-expanded="false">Challenges <em class="icon ni ni-caret-down-fill"></em></a>
                                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs left115px">
                                                                            <ul class="link-list-plain">
                                                                                <li><a href="#"><img src="{{ asset('images/dashboard/reflect-icon1.png')}}" alt=""> From smallest to the largest</a></li>
                                                                                <li><a href="#"><img src="{{ asset('images/dashboard/reflect-icon2.png')}}" alt=""> From largest to smallest</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </th>
                                                                <th class="nk-tb-col tb-col-md">
                                                                    Entities
                                                                </th>
                                                                <th class="nk-tb-col tb-col-md">
                                                                    Lead Entity
                                                                </th>
                                                                
                                                                <th class="nk-tb-col tb-col-md">
                                                                    Duration
                                                                </th>
                                                                <th class="nk-tb-col">
                                                                    Stage
                                                                </th>
                                                               <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody> 
                                                    </table>
                                                </div>
                                            </div><!-- .card-preview -->
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane" id="tabItem2">
                                    <div class="modalIntities global-bg-white">
                                        <div class="intitesDetails">
                                            <form action="{{route('dashboard.cohorts.update', $cohort->id)}}" method="POST" enctype="multipart/form-data" data-form="ajax-form" data-reload="true">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body p-0">
                                                    <div class="intitiesDetail-top intitiesDetail-top-3-cols">
                                                        <div class="modal-center-logo">
                                                            <div class="modal-logo">
                                                                @php 
                                                                 $logo = asset('images/dashboard/placeholder-image.png');
                                                                @endphp
                                                                <span class="flex"><img class="modalCompanyLgo" src="{{$logo}}" alt=""></span>
                                                                <span><img class="cameraLogo" src="{{ asset('images/dashboard/modal-camera.png')}}" alt=""></span>
                                                                <b>CHANGE LOGO</b>
                                                            </div>
                                                            <input type="file" name="logo" accept="image/x-png,image/jpeg"   class="d-none logo">
                                                        </div>
                                                        <div class="title">  
                                                            {{$cohort->name_en}}
                                                        </div>
                                                        <div class="delete-update-btn">  
                                                            <a href="javascript:void(0)" class="btn btn-round btn-delete delete" data-url="{{route('dashboard.cohorts.destroy', $cohort->id) }}" data-table="cohorts-table" data-redirect="{{route('dashboard.cohorts.index')}}"><em class="icon ni ni-trash"></em><span>DELETE</span> </a>
                                                            <button type="submit" class="btn btn-round btn-update"><em class="icon ni ni-update"></em><span>UPDATE</span> </button>
                                                        </div>
                                                    </div>
                                                    <div class="form-grid">
                                                        <div class="form-column">
                                                            <div class="single-form-field">
                                                                <label><span>*</span> Cohort Name In English</label>
                                                                <input type="text" placeholder="Cohort name in English" name="name_en" value="{{$cohort->name_en}}" required>
                                                            </div>
                                                            <div class="single-form-field select2-field">
                                                                <label><span>*</span> Status</label>
                                                                <select name="status" id="status" required class="form-select form-control form-select-modal" data-search="on">
                                                                    <option value="" selected="">Select status</option>
                                                                    <option @if($cohort->status == 'ongoing') selected @endif value="ongoing">Ongoing</option>
                                                                    <option @if($cohort->status == 'completed') selected @endif value="completed">Completed</option>
                                                                </select>
                                                               
                                                            </div>
                                                            <div class="single-form-field select2-field">
                                                                <label><span>*</span> Stage</label>
                                                                <select name="stage" id="stage" required class="form-select form-control form-select-modal" data-search="on">
                                                                    <option value="" selected="">Select cohort stage</option>
                                                                    @foreach ($stages as $stage)
                                                                    <option @if($stage->id == $cohort->stage_id) selected @endif value="{{$stage->id}}">{{$stage->name_en}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="single-form-field">
                                                                <div class="form-group">
                                                                    <label><span>*</span> Start Date</label>
                                                                    <div class="form-control-wrap">
                                                                        <div class="form-icon form-icon-right datepicker-icon">
                                                                            <em class="icon ni ni-calendar-alt"></em>
                                                                        </div>
                                                                        <input type="text" autocomplete="off" placeholder="Start date" name="start_date" value="{{$cohort->start_date}}" class=" datepicker" required>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                            
                                                        <div class="form-column">
                                                            <div class="single-form-field">
                                                                <label><span>*</span> Cohort NAME IN ARABIC</label>
                                                                <input type="text" placeholder="Cohort name in Arabic" name="name_ar" value="{{$cohort->name_ar}}"required>
                                                            </div>
                                                            <div class="single-form-field select2-field">
                                                                <label><span>*</span> Cohort TYPE</label>
                                                                <select name="type" id="type" required class="form-select form-control form-select-modal" data-search="on">
                                                                    <option value="" selected="">Select cohort type</option>
                                                                    @foreach ($cohortTypes as $type)
                                                                    <option @if($type->id == $cohort->cohort_type_id) selected @endif value="{{$type->id}}">{{$type->name_en}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="single-form-field select2-field">
                                                                <label> Lead Entity</label>
                                                                <select name="lead_entity" id="" class="form-select form-control form-select-modal" data-search="on">
                                                                    <option value="" selected="">Select lead entity</option>
                                                                    @foreach ($leadEntities as $leadEntity)
                                                                    <option @if($leadEntity->id == $cohort->lead_entity_id) selected @endif value="{{$leadEntity->id}}">{{$leadEntity->name_en}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="single-form-field">
                                                                <div class="form-group">
                                                                    <label><span>*</span> End Date</label>
                                                                    <div class="form-control-wrap">
                                                                        <div class="form-icon form-icon-right datepicker-icon">
                                                                            <em class="icon ni ni-calendar-alt"></em>
                                                                        </div>
                                                                        <input type="text" autocomplete="off" placeholder="End date" name="end_date" value="{{$cohort->end_date}}" class=" datepicker" required>
                                                                    </div>
                                                                </div>
                                                              
                                                            </div>
                                                            <div class="single-form-field">
                                                                <label>STATUS</label>
                                                                <div class="preview-block">
                                                                    <div class="custom-control custom-switch checked">
                                                                        <span>Active</span>
                                                                        <input type="checkbox" class="custom-control-input" {{$cohort->is_active == 1 ? 'checked' : ''  }} id="customSwitch2" value="1" name="is_active">
                                                                        <label class="custom-control-label" for="customSwitch2"></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div><!-- .modal-body -->
                                            
                                    </div><!-- .modal-content -->
                                </div>

                                 <div class="tab-pane" id="tabItem5">
                                    <div class="global-bg-white">

                                        <div class="page-right-dot-option dot-options">
                                            <div class="nk-file-actions">
                                                <div class="dropdown">
                                                    <a href="" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="#modal-challenge" data-toggle="modal"><img src="{{ asset('images/dashboard/dot-icon1.png')}}" alt=""><span>Add Entity</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="nk-block nk-block-lg bg-white">
                                            <div class="card bg-white">
                                                <div class="table-content table">
                                                    <div class="table-search-bar-top">
                                                        <div class="row gy-2">
                                                            <div class="col-sm-4">
                                                                <div class="table-searchbar">
                                                                    <div class="form-group">
                                                                        <div class="form-control-wrap">
                                                                            <div class="form-icon form-icon-left">
                                                                                <em class="icon ni ni-search"></em>
                                                                            </div>
                                                                            <input type="text" class="form-control" id="default-03" placeholder="Search">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-sm-2"></div>
                                                            <div class="col-lg-5 col-sm-6">
                                                                <div class="form-group selectSearch text-right">
                                                                    <div class="dropdown">
                                                                        <a class="text-soft dropdown-toggle btn btn-icon btn-trigger hover-hidden" data-toggle="dropdown" aria-expanded="false">
                                                                            Filter by
                                                                            <em class="icon ni ni-caret-down-fill"></em>
                                                                        </a>
                                                                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right dropdown-menu-s1">
                                                                            <div class="dropdown-body">
                                                                                <div class="search-item">
                                                                                    <input type="search">
                                                                                </div>
                                                                                <div class="nk-notification">
                                     
                                                                                    <div class="nk-notification-item dropdown-inner">
                                                                                        <input id="id1" type="checkbox">
                                                                                        <div class="nk-notification-content">
                                                                                            <div class="nk-notification-text"><span><label for="id1">FEDERAL MINISTRY (18)</label></span></div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="nk-notification-item dropdown-inner">
                                                                                        <input id="id2" type="checkbox">
                                                                                        <div class="nk-notification-content">
                                                                                            <div class="nk-notification-text"><span><label for="id2">FEDERAL MINISTRY (18)</label></span></div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="nk-notification-item dropdown-inner">
                                                                                        <input id="id3" type="checkbox">
                                                                                        <div class="nk-notification-content">
                                                                                            <div class="nk-notification-text"><span><label for="id3">FEDERAL MINISTRY (18)</label></span></div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="nk-notification-item dropdown-inner">
                                                                                        <input id="id4" type="checkbox">
                                                                                        <div class="nk-notification-content">
                                                                                            <div class="nk-notification-text"><span><label for="id4">FEDERAL MINISTRY (18)</label></span></div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="nk-notification-item dropdown-inner">
                                                                                        <input id="id5" type="checkbox">
                                                                                        <div class="nk-notification-content">
                                                                                            <div class="nk-notification-text"><span><label for="id5">FEDERAL MINISTRY (18)</label></span></div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="nk-notification-item dropdown-inner">
                                                                                        <input id="id6" type="checkbox">
                                                                                        <div class="nk-notification-content">
                                                                                            <div class="nk-notification-text"><span><label for="id6">FEDERAL MINISTRY (18)</label></span></div>
                                                                                        </div>
                                                                                    </div>
                                                                                    
                                                                                </div><!-- .nk-notification -->
                                                                            </div><!-- .nk-dropdown-body -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <table class="datatable-init nowrap nk-tb-list nk-tb-ulist table" data-export-title="Export">
                                                        <thead>
                                                            <tr class="nk-tb-item nk-tb-head">
                                                                <th><input type="checkbox"></th>
                                                                <th class="nk-tb-col">
                                                                    <div class="dropdown">
                                                                        <a class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" aria-expanded="false">Name <em class="icon ni ni-caret-down-fill"></em></a>
                                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                                            <ul class="link-list-plain">
                                                                                <li><a href="#"><img src="{{asset('images/dashboard/a-z-icon.png')}}" alt=""> From A to Z</a></li>
                                                                                <li><a href="#"><img src="{{asset('images/dashboard/a-z-icon.png')}}" alt=""> From A to Z</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </th>
                                                                <th class="nk-tb-col tb-col-mb">
                                                                    <div class="dropdown">
                                                                        <a class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" aria-expanded="false">Entity Type <em class="icon ni ni-caret-down-fill"></em></a>
                                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                                            <ul class="link-list-plain">
                                                                                <li><a href="#"><img src="{{asset('images/dashboard/a-z-icon.png')}}" alt=""> From A to Z</a></li>
                                                                                <li><a href="#"><img src="{{asset('images/dashboard/a-z-icon.png')}}" alt=""> From A to Z</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </th>
                                                                <th class="nk-tb-col tb-col-md">
                                                                    <div class="dropdown">
                                                                        <a class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" aria-expanded="false">Short Name <em class="icon ni ni-caret-down-fill"></em></a>
                                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                                            <ul class="link-list-plain">
                                                                                <li><a href="#"><img src="{{asset('images/dashboard/a-z-icon.png')}}" alt=""> From A to Z</a></li>
                                                                                <li><a href="#"><img src="{{asset('images/dashboard/a-z-icon.png')}}" alt=""> From A to Z</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </th>
                                                                <th class="nk-tb-col tb-col-lg">
                                                                    <div class="dropdown">
                                                                        <a class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" aria-expanded="false">Challenges <em class="icon ni ni-caret-down-fill"></em></a>
                                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                                            <ul class="link-list-plain">
                                                                                <li><a href="#"><img src="{{asset('images/dashboard/reflect-icon1.png')}}" alt=""> From smallest to the largest</a></li>
                                                                                <li><a href="#"><img src="{{asset('images/dashboard/reflect-icon2.png')}}" alt=""> From largest to smallest</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </th>
                                                                <th class="nk-tb-col tb-col-lg">
                                                                    <div class="dropdown">
                                                                        <a class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" aria-expanded="false">Users <em class="icon ni ni-caret-down-fill"></em></a>
                                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs" style="">
                                                                            <ul class="link-list-plain">
                                                                                <li><a href="#"><img src="{{asset('images/dashboard/reflect-icon1.png')}}" alt=""> From smallest to the largest</a></li>
                                                                                <li><a href="#"><img src="{{asset('images/dashboard/reflect-icon2.png')}}" alt=""> From largest to smallest</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </th>
                                                                <th class="nk-tb-col nk-tb-col-tools text-right">
                                                                </th>
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

                                <div class="tab-pane" id="tabItem4">
                                    <div class="global-bg-white">

                                        <div class="page-right-dot-option dot-options">
                                            <div class="nk-file-actions">
                                                <div class="dropdown">
                                                    <a href="" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="javascript:void(0);" data-toggle="modal" data-act="ajax-modal"   data-method="get" data-action-url="{{ route('dashboard.touchpoint.create',$cohort->id) }}"><img src="{{ asset('images/dashboard/dot-icon1.png')}}" alt=""><span>Add New Touchpoint</span></a></li>
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
                                                                            <input type="text" class="form-control" id="default-03" placeholder="Search">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-sm-2"></div>
                                                        </div>
                                                    </div>
                                                    
                                                    {{-- touchpoint table --}}
                                                    @include('cohort.touch_points.index')
                                                </div>
                                            </div><!-- .card-preview -->
                                        </div><!-- nk-block -->

                                    </div>
                                </div>


                               
                            </div>

                        </div>
                    </div><!-- .card-preview -->
                   </div>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
    <script>
        $(function() {

            $('#modal-challenge').on('shown.bs.modal', function (e) {
                $('.form-select-2').select2();
            });
            
            var table =  $('#challenges-table').DataTable({
                ajax: {
                    url: '{{ route("dashboard.challenges.datatable") }}',
                    cache: false,
                    "data": function ( d ) {
                        d.cohort = '{{$cohort->id}}';
                        console.log("da",d);
                    }
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
                    info:"_START_ - _END_ of _TOTAL_",
                },
                columns: [
                   {    targets: 0,
                        sWidth: '5%',
                        searchable:false,
                        orderable:false,
                        className: 'dt-body-center',
                        render: function (data, type, full, meta){
                            return '<input type="checkbox" name="id[]" value="' 
                                + $('<div/>').text(data).html() + '">';
                    }},
                    {data: 'name_en', name: 'name_en', sClass:"nk-tb-col"},
                    {data: 'entities', name: 'entities', sClass:"nk-tb-col", orderable: false},
                    {data: 'lead_entity', name: 'lead_entity', sClass:"nk-tb-col", orderable: false},
                    {data: 'duration', name: 'duration', sClass:"nk-tb-col" , orderable: false, searchable: false},
                    
                    {data: 'stage', name: 'stage', orderable: false, searchable: false, sClass:"nk-tb-col"},
                    {data: 'edit', name: 'edit', orderable: false, searchable: false, sClass:"nk-tb-col"},
                ],
                "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                    $(nRow).addClass('nk-tb-item');
                    $('#challenges-table_info').parents('.col-md-5').css({'order':'2', 'text-align':'right'});
                    $('#challenges-table_paginate').parents('.col-md-7').css('order','1');
                }
            });
            $('#searchBar').on( 'keyup', function () {
                table.search($('#searchBar').val()).draw();
            });
            $('.asc-sort').on('click', function () {
                table.order([[$(this).attr('column-order'), 'desc']]).draw();
            });
            $('.dsc-sort').on('click', function () {
                table.order([[$(this).attr('column-order'), 'asc']]).draw();
            });

            var ctable =  $('#cohorts-table').DataTable({
                ajax: {
                    url: '{{ route("dashboard.cohorts.datatable-show") }}',
                    cache: false,
                    "data": function ( d ) {
                        d.cohort = '{{$cohort->id}}';
                    }
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
                    info:"_START_ - _END_ of _TOTAL_",
                },
                columns: [
                   
                    {data: 'name_en', name: 'name_en', sClass:"nk-tb-col",},
                    {data: 'status', name: 'status', sClass:"nk-tb-col", orderable: false, },
                    {data: 'actions', name: 'actions', orderable: false, searchable: false, sClass:"nk-tb-col"},
                ],
                "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                    $(nRow).addClass('nk-tb-item');
                    $('#cohorts-table_info').parents('.col-md-5').css({'order':'2', 'text-align':'right'});
                    $('#cohorts-table_paginate').parents('.col-md-7').css('order','1');
                }
            });

        });

        $('.datepicker').datepicker({
            format: "yyyy-mm-dd",
        });
        $(function() {
        var table =  $('#touch_point_table').DataTable({
                ajax: {
                    url: '{{ route("dashboard.touchpoint.datatable") }}',
                    cache: false,
                    "data": function(d) {
                        d.cohort =  '{{$cohort->id}}';
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
                    {data: 'done_image', name: 'done_image', sClass:"nk-tb-col", sWidth:'20%',},
                    {data: 'default_image', name: 'default_image', sClass:"nk-tb-col", sWidth:'20%',},
                    {data: 'title_en', name: 'title_en', sClass:"nk-tb-col", sWidth:'15%',},
                    {data: 'subtitle_en', name: 'subtitle_en', sClass:"nk-tb-col", sWidth:'15%',},
                    {data: 'is_completed', name: 'is_completed', sClass:"nk-tb-col", sWidth:'15%', orderable: false},
                    {data: 'is_active', name: 'is_active', sClass:"nk-tb-col", sWidth:'15%', orderable: false},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false, sClass:"nk-tb-col", sWidth:'10%',},
                ],
                "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                    $(nRow).addClass('nk-tb-item');
                    $('#touch_point_table_info').parents('.col-md-5').css({'order':'2', 'text-align':'right'});
                    $('#touch_point_table_paginate').parents('.col-md-7').css('order','1');
                }
            });
            $('#searchBar').on( 'keyup', function () {
                table.search($('#searchBar').val()).draw();
            });
            $('.asc-sort').on('click', function () {
                table.order([[$(this).attr('column-order'), 'desc']]).draw();
            });
            $('.dsc-sort').on('click', function () {
                table.order([[$(this).attr('column-order'), 'asc']]).draw();
            });
    });
    // change status
    $(document).on('click', '.is-completed-toggle', function(e) {
        _self = $(this);
        var data = {
            'status': _self.data('status')
        }
        let url = _self.data('url');
        let table = _self.data('table');
        const message = "Are you sure you want to change the status of Touchpoint. This action is undoable and will effect all the landing pages.";

        changeStatus(url, table, data, message, _self);
    });
    // change status
    $(document).on('click', '.is-active-toggle', function(e) {
        _self = $(this);
        var data = {
            'status': _self.data('status')
        }
        let url = _self.data('url');
        let table = _self.data('table');
        const message = "Are you sure you want to change the status of Touchpoint. This action is undoable and will effect all the landing pages.";

        changeStatus(url, table, data, message, _self);
    });
</script>
@endpush
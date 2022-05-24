@extends('layouts.app')
@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="breadcrumb-title">
                            <h5><i class="zmdi zmdi-chevron-left"></i> Challenges</h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        {{-- <div class="mood-status">
                            <span>Mode</span>
                            <div class="mood-status-parent">
                                <a href="{{route('dashboard.challenges.index')}}" @if(Request()->mode!='acceleration' && Request()->mode!='sustainability' && Request()->mode!='scalability') class="active" @endif>All</a>
                                <a href="{{route('dashboard.challenges.index',['mode'=>'acceleration'])}}" class="{{ Request()->mode=='acceleration' ? 'active' : '' }}">Acceleration</a>
                                <a href="{{route('dashboard.challenges.index',['mode'=>'sustainability'])}}" class="{{ Request()->mode=='sustainability' ? 'active' : '' }}">Sustainability</a>
                                <a href="{{route('dashboard.challenges.index',['mode'=>'scalability'])}}" class="{{ Request()->mode=='scalability' ? 'active' : '' }}">Scalability</a>
                            </div>
                        </div> --}}
                    </div>
                </div>
                
               <div class="global-area">
                   <div class="tab-section">
                    <div class="card card-preview">
                        <div class="card-inner">
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul class="nav nav-tabs mt-n3 justify-content-start m-3">
                                        <li class="nav-item">
                                            <a class="nav-link active filter-status" data-status="" data-toggle="tab" href="#tabItem1">ALL</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link filter-status" data-cohorts="yes" data-toggle="tab" href="#tabItem2">COHORT CHALLENGES</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link filter-status" data-cohorts="no" data-toggle="tab" href="#tabItem3">STAND ALONE CHALLENGES</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                            <div class="page-right-dot-option">
                         
                            <div class="nk-file-actions">
                                <div class="dropdown">
                                    <a href="" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="javascript:void(0);" data-act="ajax-modal" data-complete-location="true" data-method="get" data-action-url="{{ route('dashboard.challenges.create') }}" data-table="challenges-table" data-title="Add New Challenge">
                                                <img src="{{ asset('images/dashboard/dot-icon1.png')}}" alt=""><span>Add Challenge</span></a>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            </div>
                                </div>
                            </div>
                            <div class="global-bg-white">

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
                                                                    <input type="text" class="form-control" id="searchBar" placeholder="Search">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-2"></div>
                                                    
                                                </div>
                                            </div>

                                            <table class=" nowrap nk-tb-list nk-tb-ulist table table-style-3" id="challenges-table" data-export-title="Export">
                                                <thead>
                                                    <tr class="nk-tb-item nk-tb-head">
                                                        <th><input type="checkbox"  class="select-checkbox"></th>
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
                                                            Lead Entity
                                                        </th>
                                                        <th class="nk-tb-col">
                                                            Cohort
                                                        </th>
                                                        <th class="nk-tb-col">
                                                            Start date
                                                        </th>
                                                        <th class="nk-tb-col">
                                                            End date
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
                                </div><!-- nk-block -->

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
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
<script>
    $(function() {
        var withCohorts = '';   
        var table =  $('#challenges-table').DataTable({
            
                ajax: {
                    url: '{{ route("dashboard.challenges.datatable") }}',
                    cache: false,
                    "data": function ( d ) {
                        d.cohort = '';
                        d.with_cohorts = withCohorts;
                    }
                },
                select: {
                    style: 'multi',
                    selector: 'td:first-child .select-checkbox',
                },
                processing: false,
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
                    select:{
                        rows:{
                            _:" (%d rows selected)",
                            0:"",
                            1:" (1 row selected)",
                        }
                    }
                },
                columns: [
                {    targets: 0,
                        sWidth: '5%',
                        searchable:false,
                        orderable:false,
                        className: 'row-checks',
                        render: function (data, type, full, meta){
                            return '<input type="checkbox" class="select-checkbox" name="id[]" value="' 
                                + $('<div/>').text(data).html() + '">';
                    }},
                    {data: 'name', name: 'name', sClass:"nk-tb-col",sWidth: '15%'},
                    {data: 'lead_entity', name: 'lead_entity', sClass:"nk-tb-col", orderable: false, sWidth: '15%'},
                    {data: 'cohort', name: 'cohort', orderable: false, searchable: false, sClass:"nk-tb-col", sWidth: '13%'},
                    {data: 'start_date', name: 'start_date', orderable: false, searchable: false, sClass:"nk-tb-col",sWidth: '13%'}, 
                    {data: 'end_date', name: 'end_date', orderable: false, searchable: false, sClass:"nk-tb-col",sWidth: '13%'},  
                    {data: 'stage', name: 'stage', orderable: false, searchable: false, sClass:"nk-tb-col", sWidth: '13%'},
                    {data: 'edit', name: 'edit', orderable: false, searchable: false, sClass:"nk-tb-col", sWidth: '13%'},
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
            $('.filter-status').on('click', function () {
               withCohorts = $(this).data('cohorts');
               table.draw();
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
        
</script>
@endpush
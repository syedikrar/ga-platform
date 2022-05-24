@extends('layouts.app')
@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="breadcrumb-title">
                    <h5>Cohorts</h5>
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
                                            <a class="nav-link filter-status" data-status="ongoing" data-toggle="tab" href="#tabItem2">In Progress</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link filter-status" data-status="completed" data-toggle="tab" href="#tabItem3">COMPLETED</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link filter-status" data-status="completed" data-toggle="tab" href="#tabItem4">NOT STARTED</a>
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
                                            <li><a href="javascript:void(0);" data-act="ajax-modal" data-complete-location="true" data-method="get" data-action-url="{{ route('dashboard.cohorts.create') }}" data-table="cohorts-table" data-title="Add new cohort">
                                                <img src="{{ asset('images/dashboard/dot-icon1.png')}}" alt=""><span>Add Cohort</span></a>
                                            </li>
                                            <!--<li><a href="#" class="file-dl-toast"><img src="{{ asset('images/dashboard/dot-icon4.png')}}" alt=""><span>Export Cohorts</span></a></li>-->
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

                                            <table class="nowrap nk-tb-list nk-tb-ulist table" id="cohorts-table" data-export-title="Export">
                                                <thead>
                                                    <tr class="nk-tb-item nk-tb-head">
                                                        <th><input type="checkbox" class="select-checkbox"></th>
                                                        <th class="nk-tb-col">
                                                            <div class="dropdown">
                                                                <a class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" aria-expanded="false">Cohort <em class="icon ni ni-caret-down-fill"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                                    <ul class="link-list-plain">
                                                                        <li><a href="javascript:void(0);" class="asc-sort" column-order="1"><img src="{{ asset('images/dashboard/a-z-icon.png')}}" alt=""> From A to Z</a></li>
                                                                        <li><a href="javascript:void(0);" class="dsc-sort" column-order="1"><img src="{{ asset('images/dashboard/a-z-icon.png')}}" alt=""> From Z to A</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th class="nk-tb-col tb-col-md">
                                                            Duration
                                                        </th>
                                                        <th class="nk-tb-col tb-col-md">
                                                            Status
                                                        </th>
                                                        <th class="nk-tb-col tb-col-md">
                                                            Methodology
                                                        </th>
                                                        <th class="nk-tb-col tb-col-md">
                                                            Participant
                                                        </th>
                                                        <th class="nk-tb-col tb-col-mb">
                                                            <div class="dropdown">
                                                                <a class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" aria-expanded="false">Challenges <em class="icon ni ni-caret-down-fill"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                                    <ul class="link-list-plain">
                                                                        <li><a href="javascript:void(0);" class="asc-sort" column-order="2"><img src="{{ asset('images/dashboard/reflect-icon1.png')}}" alt=""> From smallest to the largest</a></li>
                                                                        <li><a href="javascript:void(0);" class="dsc-sort" column-order="2"><img src="{{ asset('images/dashboard/reflect-icon2.png')}}" alt=""> From largest to smallest</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th class="nk-tb-col tb-col-md">
                                                            Entities
                                                        </th>
                                                        
                                                        <th class="nk-tb-col tb-col-lg">
                                                            Active
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
                    </div><!-- .card-preview -->
                   </div>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script> --}}
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    <script>
        $(function() {
            var status = '';
            var table =  $('#cohorts-table').DataTable({
                ajax: {
                    url: '{{ route("dashboard.cohorts.datatable") }}',
                    cache: false,
                    "data": function ( d ) {
                        d.status = status;
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
                        searchable:false,
                        orderable:false,
                        className: 'row-checks',
                        render: function (data, type, full, meta){
                            return '<input type="checkbox"  class="select-checkbox" name="id[]" value="' 
                                + $('<div/>').text(data).html() + '">';
                    }},
                    {data: 'name', name: 'name_en', sClass:"nk-tb-col",},
                    {data: 'duration', name: 'duration', sClass:"nk-tb-col" , orderable: false,},
                    {data: 'status', name: 'status', sClass:"nk-tb-col", orderable: false, },
                    {data: 'methodology', name: 'methodology', sClass:"nk-tb-col", orderable: false, },
                    {data: 'participant', name: 'participant', sClass:"nk-tb-col", orderable: false, },
                    {data: 'challenges', name: 'challenges', sClass:"nk-tb-col",searchable: false,},
                    {data: 'entities', name: 'entities', sClass:"nk-tb-col",searchable: false,},
                    {data: 'active', name: 'active', sClass:"nk-tb-col", orderable: false, },
                    {data: 'edit', name: 'edit', orderable: false, searchable: false, sClass:"nk-tb-col"},
                ],
                "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                    $(nRow).addClass('nk-tb-item');
                    $('#cohorts-table_info').parents('.col-md-5').css({'order':'2', 'text-align':'right'});
                    $('#cohorts-table_paginate').parents('.col-md-7').css('order','1');
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
               status = $(this).data('status');
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
            }).on("select deselect", function(e, dt, type, indexes) {

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
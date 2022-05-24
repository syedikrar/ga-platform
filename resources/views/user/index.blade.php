@extends('layouts.app')
@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="breadcrumb-title">
                    <h5>Users</h5>
                </div>
               <div class="global-area">
                   <div class="tab-section">
                    <div class="card card-preview">
                        <div class="card-inner">
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul class="nav nav-tabs mt-n3 justify-content-start m-3">
                                        <li class="nav-item">
                                            <a class="nav-link active filter-sector"  data-sector="" data-toggle="tab" href="#tabItem1">Administrator</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link filter-sector" data-sector="Government" data-toggle="tab" href="#tabItem2">Entity Users</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link filter-sector" data-sector="Private Sector" data-toggle="tab" href="#tabItem5">Dashboard</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                    <div class="page-right-dot-option"></div>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem1">
                                    <div class="global-bg-white">
                                        <!-- options-->
                                        <div class="page-right-dot-option dot-options">
                                            <div class="nk-file-actions">
                                                <div class="dropdown">
                                                    <a href="" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li>
                                                                <a href="javascript:void(0);" data-act="ajax-modal" data-complete-location="true" data-method="get" data-action-url="{{ route('dashboard.user.create') }}" data-table="entities_table" data-title="Add Admin">
                                                                    <img src="{{ asset('images/dashboard/dot-icon1.png')}}" alt=""><span>Add Admin</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- options-->
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
                                                            <div class="col-lg-5 col-sm-6"></div>
                                                        </div>
                                                    </div>

                                                    <table class="nk-tb-list nk-tb-ulist table" id="entities_table" data-export-title="Export">
                                                        <thead>
                                                            <tr class="nk-tb-item nk-tb-head">
                                                                <th><input type="checkbox" class="select-checkbox"></th>
                                                                <th class="nk-tb-col">
                                                                    <div class="dropdown">
                                                                        <a class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" aria-expanded="false">English Name <em class="icon ni ni-caret-down-fill"></em></a>
                                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                                            <ul class="link-list-plain">
                                                                                <li><a href="javascript:void(0);" class="asc-sort" column-order="1"><img src="{{ asset('images/dashboard/a-z-icon.png')}}" alt=""> From A to Z</a></li>
                                                                                <li><a href="javascript:void(0);"  class="dsc-sort" column-order="1"><img src="{{ asset('images/dashboard/a-z-icon.png')}}" alt=""> From Z to A</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </th>
                                                                <th class="nk-tb-col tb-col-mb">
                                                                    <div class="dropdown">
                                                                        <a class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" aria-expanded="false">Arabic Name <em class="icon ni ni-caret-down-fill"></em></a>
                                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                                            <ul class="link-list-plain">
                                                                                <li><a href="javascript:void(0);" class="asc-sort" column-order="2"><img src="{{ asset('images/dashboard/a-z-icon.png')}}" alt=""> From A to Z</a></li>
                                                                                <li><a href="javascript:void(0);" class="dsc-sort" column-order="2"><img src="{{ asset('images/dashboard/a-z-icon.png')}}" alt=""> From Z to A</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </th>
                                                                <th class="nk-tb-col tb-col-md">
                                                                    <div class="dropdown">
                                                                        <a class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" aria-expanded="false">Email <em class="icon ni ni-caret-down-fill"></em></a>
                                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                                            <ul class="link-list-plain">
                                                                                <li><a href="javascript:void(0);" class="asc-sort" column-order="3"><img src="{{ asset('images/dashboard/a-z-icon.png')}}" alt=""> From A to Z</a></li>
                                                                                <li><a href="javascript:void(0);" class="dsc-sort" column-order="3"><img src="{{ asset('images/dashboard/a-z-icon.png')}}" alt=""> From Z to A</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </th>
                                                                <th class="nk-tb-col tb-col-lg">
                                                                    <div class="dropdown">
                                                                        <a class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" aria-expanded="false">Role <em class="icon ni ni-caret-down-fill"></em></a>
                                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                                            <ul class="link-list-plain">
                                                                                <li><a href="javascript:void(0);" class="asc-sort" column-order="4"><img src="{{ asset('images/dashboard/reflect-icon1.png')}}" alt=""> From smallest to the largest</a></li>
                                                                                <li><a href="javascript:void(0);" class="dsc-sort" column-order="4"><img src="{{ asset('images/dashboard/reflect-icon2.png')}}" alt=""> From largest to smallest</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </th>
                                                                <th class="nk-tb-col tb-col-lg">
                                                                    <div class="dropdown">
                                                                        <a class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" aria-expanded="false">Active <em class="icon ni ni-caret-down-fill"></em></a>
                                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs" style="">
                                                                            <ul class="link-list-plain">
                                                                                <li><a href="javascript:void(0);" class="asc-sort" column-order="5"><img src="{{ asset('images/dashboard/reflect-icon1.png')}}" alt=""> From smallest to the largest</a></li>
                                                                                <li><a hhref="javascript:void(0);" class="dsc-sort" column-order="5"><img src="{{ asset('images/dashboard/reflect-icon2.png')}}" alt=""> From largest to smallest</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </th>
                                                                <th class="nk-tb-col tb-col-lg">
                                                                    <div class="dropdown">
                                                                        <a class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" aria-expanded="false">Last Seen <em class="icon ni ni-caret-down-fill"></em></a>
                                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs" style="">
                                                                            <ul class="link-list-plain">
                                                                                <li><a href="javascript:void(0);" class="asc-sort" column-order="5"><img src="{{ asset('images/dashboard/reflect-icon1.png')}}" alt=""> From smallest to the largest</a></li>
                                                                                <li><a hhref="javascript:void(0);" class="dsc-sort" column-order="5"><img src="{{ asset('images/dashboard/reflect-icon2.png')}}" alt=""> From largest to smallest</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </th>
                                                                <th class="nk-tb-col nk-tb-col-tools text-right">
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody> 
                                                    </table>
                                                </div>
                                            </div><!-- .card-preview -->
                                        </div><!-- nk-block -->
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabItem2">
                                    <div class="global-bg-white">
                                        <!-- options-->
                                        <div class="page-right-dot-option dot-options">
                                            <div class="nk-file-actions">
                                                <div class="dropdown">
                                                    <a href="" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="link-list-opt no-bdr">
                                                        <li>
                                                            <a href="javascript:void(0);" data-act="ajax-modal" data-complete-location="true" data-method="get" data-action-url="{{ route('dashboard.user.entity-form', 'entity user') }}">
                                                                <img src="{{ asset('images/dashboard/dot-icon1.png')}}" alt=""><span>Add New Standard User</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0);" data-act="ajax-modal" data-complete-location="true" data-method="get" data-action-url="{{ route('dashboard.user.entity-form', 'entity leader') }}">
                                                                <img src="{{ asset('images/dashboard/dot-icon1.png')}}" alt=""><span>Add Entity Leader</span>
                                                            </a>
                                                        </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- options-->
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
                                                            <div class="col-lg-5 col-sm-6"></div>
                                                        </div>
                                                    </div>
                                                    @include('user.entities_users.datatable')
                                                   
                                                </div>
                                            </div><!-- .card-preview -->
                                        </div><!-- nk-block -->
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
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    <script>
        $(function() {
            var sector = '';
            getEntityTypes(sector);
            var types = $('input[name="filter-type[]"]:checked').map(function(){
                            return $(this).val();
                        }).get();
            var table =  $('#entities_table').DataTable({
                ajax: {
                    url: '{{ route("dashboard.user.datatable") }}',
                    cache: false,
                    "data": function ( d ) {
                        d.filter_type = types;
                        d.sector = sector;
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
                   {    targets: 0,
                        sWidth:'5%',
                        searchable:false,
                        orderable:false,
                        className: 'row-checks',
                        render: function (data, type, full, meta){
                            return '<input type="checkbox" class="select-checkbox" name="id[]" value="' 
                                + $('<div/>').text(data).html() + '">';
                    }},
                    {data: 'English Name', name: 'enl', sClass:"nk-tb-col", sWidth:'15%',},
                    {data: 'Arabic Name', name: 'arb', sClass:"nk-tb-col", sWidth:'15%',},
                    {data: 'email', name: 'email', sClass:"nk-tb-col", sWidth:'15%',},
                    {data: 'role', name: 'role', sClass:"nk-tb-col",searchable: false, sWidth:'15%',},
                    {data: 'active', name: 'active', sClass:"nk-tb-col", searchable: false, sWidth:'10%',},
                    {data: 'last seen', name: 'last seen', orderable: false, searchable: false, sClass:"nk-tb-col", sWidth:'10%',},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false, sClass:"nk-tb-col", sWidth:'10%',},
                ],
                "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                    $(nRow).addClass('nk-tb-item');
                    $('#entities_table_info').parents('.col-md-5').css({'order':'2', 'text-align':'right'});
                    $('#entities_table_paginate').parents('.col-md-7').css('order','1');
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

            $('.filter-sector').on('click', function () {
               sector = $(this).data('sector');
               getEntityTypes(sector);
               table.draw();
            });

            $(".filter-container-dropdown").on('click','input.filter-type',function () {
                types = $('input[name="filter-type[]"]:checked').map(function(){
                            return $(this).val();
                        }).get();

                $( 'input[name="filter-type[]"]:checked' ).each(function( index ) {
                    if(index==0){
                        $('.selected-filters').text( $( this ).attr('data-name') );
                    }else{
                        $('.selected-filters').text($('.selected-filters').text()+','+$( this ).attr('data-name') );
                    }
                });

                if($( 'input[name="filter-type[]"]:checked' ).length==0){
                    $('.selected-filters').text('Filter by Entity Types');
                }
                table.draw();
            });

            function getEntityTypes(sector){
                var search = $('#search').val();
                axios({
                    url: '{{route("dashboard.entities.entity-types-filter")}}',
                    method: 'get',
                    params:{search:search,sector:sector}
                })
                .then(response => {
                    if (response.status == 200) {
                        $('.filter-container-dropdown').html(response.data)
                    }
                    else toastMessage();
                })
                .catch(error => {
                    toastMessage(error.response.data.message);
                })
            }
            $('#search').on( 'input', function () {
                getEntityTypes(sector)
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

<style>
    .filter-container{
        width: 320px;
    }
    .filter-container .selected-filters{
        width: 90%;
        overflow: hidden;
    }
    .filter-container em{ right:0}
</style>
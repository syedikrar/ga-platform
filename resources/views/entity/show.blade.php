@extends('layouts.app')
@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="breadcrumb-title">
                    <h5><a href="{{route('dashboard.entities.index')}}" class="text-dark"><i class="zmdi zmdi-chevron-left"></i> Entities</a></h5>
                    <ul>
                        <li>Entities > {{$entity->name_en}}</li>
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
                                                <a class="nav-link active" data-toggle="tab" href="#tabItem1">Details</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#tabItem2">Entity directory</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#tabItem3">Users</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#tabItem4">Challenges</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6">

                                    </div>

                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tabItem1">
                                        <div class="modalIntities global-bg-white">

                                            <div class="intitesDetails">
                                                @include('entity.details.index')
                                            </div><!-- .modal-body -->

                                        </div><!-- .modal-content -->
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
                                                                <li><a href="#modal-contact" data-toggle="modal"><img src="{{ asset('images/dashboard/dot-icon1.png')}}" alt=""><span>Add Contact</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- options-->


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
                                                                                <input type="text" class="form-control" id="contactsSearchBar" placeholder="Search">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-sm-2"></div>
                                                            </div>
                                                        </div>
                                                        <div class="table-scroll-mobile">
                                                            @include('entity.entity_directories.index')
                                                        </div>
                                                    </div>
                                                </div><!-- .card-preview -->
                                            </div><!-- nk-block -->

                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabItem3">
                                        <div class="global-bg-white">

                                            <!-- options-->
                                            <div class="page-right-dot-option dot-options">
                                                <div class="nk-file-actions">
                                                    <div class="dropdown">
                                                        <a href="" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li>
                                                                    <a href="javascript:void(0);" data-act="ajax-modal" data-complete-location="true" data-method="get" data-action-url="{{ route('dashboard.entities.user.entity-user-form', [$entity->id, 'entity user']) }}">
                                                                        <img src="{{ asset('images/dashboard/dot-icon1.png')}}" alt=""><span>Add New Standard User</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:void(0);" data-act="ajax-modal" data-complete-location="true" data-method="get" data-action-url="{{ route('dashboard.entities.user.entity-user-form', [$entity->id, 'entity leader']) }}">
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
                                                                <div class="col-lg-3 col-sm-2"></div>
                                                            </div>
                                                        </div>
                                                        <div class="table-scroll-mobile">
                                                            @include('entity.users.index')
                                                        </div>
                                                    </div>
                                                </div><!-- .card-preview -->
                                            </div><!-- nk-block -->

                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabItem4">
                                        <div class="global-bg-white">

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
                                                                <div class="col-sm-4">
                                                                    <div class="export-btn">
                                                                        <a href="#" class="btn btn-round btn-primary"><em class="icon ni ni-upload"></em><span>Export challenges</span> </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="table-scroll-mobile">
                                                            @include('entity.challenges.index')
                                                        </div>
                                                    </div>
                                                </div><!-- .card-preview -->
                                            </div><!-- nk-block -->

                                        </div>
                                    </div>
                                </div>
                                <!-- @@ edit-cohort Modal @e -->
                                @include('entity.entity_directories.modal')
                                <!-- @@ task @e -->
                                <div class="modal fade modalIntities" tabindex="-1" role="dialog" id="modal-task" data-backdrop="static">
                                    <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content">
                                            <form action="{{route('dashboard.entity-contacts.store')}}" method="POST" id="entity-contact-form" enctype="multipart/form-data" data-form="ajax-form" data-datatable="#entity-contacts-table" data-modal="#modal-contact" data-form-reset="true">
                                                @csrf

                                                <div class="modal-header align-center">
                                                    <div class="nk-file-title">
                                                        <div class="nk-file-icon">
                                                            <span class="nk-file-icon-type">
                                                                <img src="{{ asset('images/dashboard/entities-icon.png')}}" alt="">
                                                            </span>
                                                        </div>
                                                        <div class="nk-file-name">
                                                            <div class="nk-file-name-text"><span class="title">Add Task</span></div>
                                                        </div>
                                                    </div>
                                                    <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="single-form-field single-form-row">
                                                                <label><span>*</span> Title in English</label>
                                                                <input type="text" placeholder="Title in English" name="name_en" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="single-form-field single-form-row">
                                                                <label><span>*</span> Title in Arabic</label>
                                                                <input type="text" placeholder="Title in Arabic" name="name_en" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="single-form-field single-form-row">
                                                                <label><span>*</span> Start Date</label>
                                                                <input type="text" placeholder="Title in Arabic" name="name_en" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="single-form-field single-form-row">
                                                                <label><span>*</span> End date</label>
                                                                <input type="text" placeholder="Title in Arabic" name="name_en" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- .modal-body -->
                                                <div class="modal-footer bg-white">
                                                    <ul class="btn-toolbar g-3">
                                                        <li><a href="#" data-dismiss="modal" class="btn btn-outline-light btn-white">Discard</a></li>
                                                        <li><button href="#" type="submit" class="btn btn-primary">Add</button></li>
                                                    </ul>
                                                </div><!-- .modal-footer -->
                                            </form>
                                        </div><!-- .modal-content -->
                                    </div><!-- .modla-dialog -->
                                </div>
                                <!-- .modal -->
                                <!-- @@ task @e -->
                                <div class="modal fade modalIntities" tabindex="-1" role="dialog" id="modal-workstream" data-backdrop="static">
                                    <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content">
                                            <form action="" method="POST" enctype="multipart/form-data" data-form="ajax-form" data-datatable="#entity-contacts-table" data-modal="#modal-contact" data-form-reset="true">
                                                @csrf
                                                <div class="modal-header align-center">
                                                    <div class="nk-file-title">
                                                        <div class="nk-file-icon">
                                                            <span class="nk-file-icon-type">
                                                                <img src="{{ asset('images/dashboard/entities-icon.png')}}" alt="">
                                                            </span>
                                                        </div>
                                                        <div class="nk-file-name">
                                                            <div class="nk-file-name-text"><span class="title">Add Task</span></div>
                                                        </div>
                                                    </div>
                                                    <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                                                </div>
                                                <div class="modal-body p-0">

                                                    <div class="inner_tabs">
                                                        <ul class="nav nav-tabs mt-n3 justify-content-start">
                                                            <li class="nav-item">
                                                                <a class="nav-link active" data-toggle="tab" href="#tabItem1">Basic details</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-toggle="tab" href="#tabItem2"> Members</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-toggle="tab" href="#tabItem3">Users</a>
                                                            </li>
                                                        </ul>

                                                        <div class="tab-content">
                                                            <div class="tab-pane active p-3" id="basic_details">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="single-form-field single-form-row">
                                                                            <label><span>*</span> Title in English</label>
                                                                            <input type="text" placeholder="Title in English" name="name_en" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="single-form-field single-form-row">
                                                                            <label><span>*</span> Title in Arabic</label>
                                                                            <input type="text" placeholder="Title in Arabic" name="name_en" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="single-form-field single-form-row">
                                                                            <label><span>*</span> Start Date</label>
                                                                            <input type="text" placeholder="Title in Arabic" name="name_en" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="single-form-field single-form-row">
                                                                            <label><span>*</span> End date</label>
                                                                            <input type="text" placeholder="Title in Arabic" name="name_en" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- .modal-body -->
                                                <div class="modal-footer bg-white">
                                                    <ul class="btn-toolbar g-3">
                                                        <li><a href="#" data-dismiss="modal" class="btn btn-outline-light btn-white">Discard</a></li>
                                                        <li><button href="#" type="submit" class="btn btn-primary">Add</button></li>
                                                    </ul>
                                                </div><!-- .modal-footer -->
                                            </form>
                                        </div><!-- .modal-content -->
                                    </div><!-- .modla-dialog -->
                                </div>
                                <!-- .modal -->
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
<script>
    $(function() {
        var table = $('#challenges-table').DataTable({
            ajax: {
                url: '{{ route("dashboard.challenges.datatable") }}',
                cache: false,
                "data": function(d) {
                    d.entity = '{{$entity->id}}';
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
                info: "_START_ - _END_ of _TOTAL_",
            },
            columns: [{
                    data: 'name_en',
                    name: 'name_en',
                    sClass: "nk-tb-col",
                    sWidth: '25%'
                },
                {
                    data: 'cohort',
                    name: 'cohort',
                    sClass: "nk-tb-col",
                    orderable: false,
                    sWidth: '25%',
                },
                {
                    data: 'entity_role',
                    name: 'entity_role',
                    orderable: false,
                    searchable: false,
                    sClass: "nk-tb-col",
                    sWidth: '15%'
                },
                {
                    data: 'participants',
                    name: 'participants',
                    orderable: false,
                    searchable: false,
                    sClass: "nk-tb-col",
                    sWidth: '15%'
                },
                {
                    data: 'progress',
                    name: 'progress',
                    sClass: "nk-tb-col",
                    orderable: false,
                    searchable: false,
                    sWidth: '20%'
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
    });
</script>
<script>
    initMap('map', 'searchInput', 'latitude', 'longitude', true, '{{$entity->location ?? "" }}', '{{$entity->latitude ?? "0"}}', '{{$entity->longitude ?? "0"}}');

    $('.form-select-modal').select2({
        // maximumSelectionLength: 5,
        width: 'resolve',
        placeholder: function() {
            $(this).data('placeholder');        
        }
    });
</script>

<script>
    $(function() {
        var contactsTable = $('#entity-contacts-table').DataTable({
            ajax: {
                url: '{{ route("dashboard.entity-contacts.datatable") }}',
                cache: false,
                "data": function(d) {
                    d.entity = '{{$entity->id}}';
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
                info: "_START_ - _END_ of _TOTAL_",
            },
            columns: [{
                    data: 'name',
                    name: 'name',
                    sClass: "nk-tb-col",
                    sWidth: '20%'
                },
                {
                    data: 'designation_en',
                    name: 'designation_en',
                    sClass: "nk-tb-col",
                    orderable: false,
                    sWidth: '20%',
                },
                {
                    data: 'mobile_number',
                    name: 'mobile_number',
                    orderable: false,
                    sClass: "nk-tb-col",
                    sWidth: '15%'
                },
                {
                    data: 'email',
                    name: 'email',
                    orderable: false,
                    sClass: "nk-tb-col",
                    sWidth: '15%'
                },
                {
                    data: 'remarks',
                    name: 'remarks',
                    sClass: "nk-tb-col",
                    orderable: false,
                    searchable: false,
                    sWidth: '20%'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false,
                    sClass: "nk-tb-col",
                    sWidth: '15%'
                },

            ],
            "fnRowCallback": function(nRow, aData, iDisplayIndex) {
                $(nRow).addClass('nk-tb-item');
                $('#entity-contacts-table_info').parents('.col-md-5').css({
                    'order': '2',
                    'text-align': 'right'
                });
                $('#entity-contacts-table_paginate').parents('.col-md-7').css('order', '1');
            }
        });
        $('#contactsSearchBar').on('keyup', function() {
            contactsTable.search($('#contactsSearchBar').val()).draw();
        });
        // $('.asc-sort').on('click', function () {
        //     table.order([[$(this).attr('column-order'), 'desc']]).draw();
        // });
        // $('.dsc-sort').on('click', function () {
        //     table.order([[$(this).attr('column-order'), 'asc']]).draw();
        // });
    });
</script>

<script>
    $(function() {
        var sector = '';
        getEntityTypes(sector);
        var types = $('input[name="filter-type[]"]:checked').map(function() {
            return $(this).val();
        }).get();
        var table = $('#entities_users_table').DataTable({
            ajax: {
                url: '{{ route("dashboard.entityUsers.dataTable", $entity->id) }}',
                cache: false,
                "data": function(d) {
                    d.entity = '{{$entity->id}}';
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
                    sWidth: '5%',
                    searchable: false,
                    orderable: false,
                    className: 'row-checks',
                    render: function(data, type, full, meta) {
                        return '<input type="checkbox" class="select-checkbox" name="id[]" value="' +
                            $('<div/>').text(data).html() + '">';
                    }
                },
                {
                    data: 'user_name',
                    name: 'user_name',
                    sClass: "nk-tb-col",
                    sWidth: '30%',
                },
                {
                    data: 'job_title',
                    name: 'job_title',
                    sClass: "nk-tb-col",
                    sWidth: '15%',
                },
                {
                    data: 'user_email',
                    name: 'user_email',
                    sClass: "nk-tb-col",
                    sWidth: '15%',
                },
                {
                    data: 'mobile_number',
                    name: 'mobile_number',
                    sClass: "nk-tb-col",
                    searchable: false,
                    sWidth: '15%',
                },
                {
                    data: 'challenges',
                    name: 'challenges',
                    sClass: "nk-tb-col",
                    searchable: false,
                    sWidth: '10%',
                },
                {
                    data: 'entity_leader',
                    name: 'entity_leader',
                    orderable: false,
                    searchable: false,
                    sClass: "nk-tb-col",
                    sWidth: '10%',
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false,
                    sClass: "nk-tb-col",
                    sWidth: '5%',
                },
            ],
            "fnRowCallback": function(nRow, aData, iDisplayIndex) {
                $(nRow).addClass('nk-tb-item');
                $('#entities_users_table_info').parents('.col-md-5').css({
                    'order': '2',
                    'text-align': 'right'
                });
                $('#entities_users_table_paginate').parents('.col-md-7').css('order', '1');
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
        $('.filter-sector').on('click', function() {
            sector = $(this).data('sector');
            getEntityTypes(sector);
            table.draw();
        });

        $(".filter-container-dropdown").on('click', 'input.filter-type', function() {
            types = $('input[name="filter-type[]"]:checked').map(function() {
                return $(this).val();
            }).get();

            $('input[name="filter-type[]"]:checked').each(function(index) {
                if (index == 0) {
                    $('.selected-filters').text($(this).attr('data-name'));
                } else {
                    $('.selected-filters').text($('.selected-filters').text() + ',' + $(this).attr('data-name'));
                }
            });

            if ($('input[name="filter-type[]"]:checked').length == 0) {
                $('.selected-filters').text('Filter by Entity Types');
            }
            table.draw();
        });


        function getEntityTypes(sector) {
            var search = $('#search').val();
            axios({
                    url: '{{route("dashboard.entities.entity-types-filter")}}',
                    method: 'get',
                    params: {
                        search: search,
                        sector: sector
                    }
                })
                .then(response => {
                    if (response.status == 200) {
                        $('.filter-container-dropdown').html(response.data)
                    } else toastMessage();
                })
                .catch(error => {
                    toastMessage(error.response.data.message);
                })
        }
        $('#search').on('input', function() {
            getEntityTypes(sector)
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
</script>
@endpush
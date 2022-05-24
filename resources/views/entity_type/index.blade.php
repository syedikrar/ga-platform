@extends('layouts.app')
@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="breadcrumb-title">
                    <h5> Entity Types</h5>
                </div>
               <div class="global-area">
                   <div class="tab-section">
                    <div class="card card-preview">
                        <div class="card-inner">
                            <div class="page-right-dot-option">
                            <div class="nk-file-actions">
                                <div class="dropdown">
                                    <a href="" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="javascript:void(0);" data-act="ajax-modal" data-complete-location="true" data-method="get" data-action-url="{{ route('dashboard.entity-types.create') }}" data-table="entity-types-table" data-title="ADD NEW ENTITY TYPE">
                                                <img src="{{ asset('images/dashboard/dot-icon1.png')}}" alt=""><span>ADD ENTITY TYPE</span></a>
                                            </li>
                                          
                                        </ul>
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
                                                    <div class="col-lg-5 col-sm-6"></div>
                                                </div>
                                            </div>

                                            <table class="nowrap nk-tb-list nk-tb-ulist table" id="entity-types" data-export-title="Export">
                                                <thead>
                                                    <tr class="nk-tb-item nk-tb-head">
                                                        <th><input type="checkbox"></th>
                                                        <th class="nk-tb-col">
                                                            <div class="dropdown">
                                                                <a class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" aria-expanded="false">Entity Type Name English <em class="icon ni ni-caret-down-fill"></em></a>
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
                                                                <a class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" aria-expanded="false">Entity Type Name Arabic</a>
                                                                
                                                            </div>
                                                        </th>
                                                        <th class="nk-tb-col tb-col-md">
                                                            <div class="dropdown">
                                                                <a class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" aria-expanded="false">Status</em></a>
                                                               
                                                            </div>
                                                        </th>
                                                      
                                                        <th class="nk-tb-col nk-tb-col-tools text-right">Actions
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
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    <script>
        $(function() {
          var table =  $('#entity-types').DataTable({
                ajax: '{{ route("dashboard.entity-types.datatable") }}',
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
                    {data: 'name_en', name: 'name_en', sClass:"nk-tb-col",  sWidth: '35%'},
                    {data: 'name_ar', name: 'name_ar', sClass:"nk-tb-col", orderable: false,  sWidth: '35%'},
                    {data: 'status', name: 'status', sClass:"nk-tb-col" , orderable: false, searchable: false,  sWidth: '15%'},
                    
                    {data: 'actions', name: 'actions', orderable: false, searchable: false, sClass:"nk-tb-col",  sWidth: '10%'},
                ],
                "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                    $(nRow).addClass('nk-tb-item');
                    $('#entity-types_info').parents('.col-md-5').css({'order':'2', 'text-align':'right'});
                    $('#entities-types_paginate').parents('.col-md-7').css('order','1');
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
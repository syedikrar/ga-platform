@extends('layouts.app')
@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="breadcrumb-title">
                    <h5>Translations</h5>
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
                                            <li><a href="javascript:void(0);" data-act="ajax-modal" data-complete-location="true" data-method="get" data-action-url="{{ route('dashboard.translations.create') }}" data-table="translations-table" data-title="ADD NEW TRANSALTION">
                                                <img src="{{ asset('images/dashboard/dot-icon1.png')}}" alt=""><span>Add Translation</span></a>
                                            </li>
                                            {{-- <li><a href="#" class="file-dl-toast"><img src="{{ asset('images/dashboard/dot-icon4.png')}}" alt=""><span>Export Cohorts</span></a></li> --}}
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
                                                    
                                                </div>
                                            </div>

                                            <table class="nowrap nk-tb-list nk-tb-ulist table" id="translations-table" data-export-title="Export">
                                                <thead>
                                                    <tr class="nk-tb-item nk-tb-head">
                                                        <th class="nk-tb-col tb-col-md py-4">
                                                            Group
                                                        </th>
                                                        <th class="nk-tb-col tb-col-md">
                                                            Key
                                                        </th>
                                                        <th class="nk-tb-col tb-col-md">
                                                            English
                                                        </th>
                                                        <th class="nk-tb-col tb-col-lg">
                                                            Arabic
                                                        </th>
                                                        <th class="nk-tb-col tb-col-lg text-right">
                                                            Actions
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
    <script>
        $(function() {
         
            var table =  $('#translations-table').DataTable({
                ajax: '{{ route("dashboard.translations.datatable") }}',
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
                    {data: 'group', name: 'group', sClass:"nk-tb-col", orderable: false,},
                    {data: 'key', name: 'key', sClass:"nk-tb-col",  orderable: false, },
                    {data: 'english', name: 'english', sClass:"nk-tb-col", orderable: false, },
                    {data: 'arabic', name: 'arabic', sClass:"nk-tb-col", orderable: false, },
                    {data: 'edit', name: 'edit', orderable: false, searchable: false, sClass:"nk-tb-col text-right"},
                ],
                "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                    $(nRow).addClass('nk-tb-item');
                    $('#translations-table_info').parents('.col-md-5').css({'order':'2', 'text-align':'right'});
                    $('#translations-table_paginate').parents('.col-md-7').css('order','1');
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
        
</script>
@endpush
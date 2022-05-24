<table class="nk-tb-list nk-tb-ulist table" id="entities_users_table" data-export-title="Export">
    <thead>
        <tr class="nk-tb-item nk-tb-head">
            <th><input type="checkbox" class="select-checkbox"></th>
            <th class="nk-tb-col">
                <div class="dropdown">
                    <a class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" aria-expanded="false">English Name <em class="icon ni ni-caret-down-fill"></em></a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                        <ul class="link-list-plain">
                            <li><a href="javascript:void(0);" class="asc-sort" column-order="1"><img src="{{ asset('images/dashboard/a-z-icon.png')}}" alt=""> From A to Z</a></li>
                            <li><a href="javascript:void(0);" class="dsc-sort" column-order="1"><img src="{{ asset('images/dashboard/a-z-icon.png')}}" alt=""> From Z to A</a></li>
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
                    <a class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" aria-expanded="false">Entity <em class="icon ni ni-caret-down-fill"></em></a>
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
            var table =  $('#entities_users_table').DataTable({
                ajax: {
                    url: '{{ route("dashboard.entities.users.datatable") }}',
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
                    {data: 'entity', name: 'entity', sClass:"nk-tb-col",searchable: false, sWidth:'15%',},
                    {data: 'active', name: 'active', sClass:"nk-tb-col", searchable: false, sWidth:'10%',},
                    {data: 'last seen', name: 'last seen', orderable: false, searchable: false, sClass:"nk-tb-col", sWidth:'10%',},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false, sClass:"nk-tb-col", sWidth:'10%',},
                ],
                "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                    $(nRow).addClass('nk-tb-item');
                    $('#entities_users_table_info').parents('.col-md-5').css({'order':'2', 'text-align':'right'});
                    $('#entities_users_table_paginate').parents('.col-md-7').css('order','1');
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
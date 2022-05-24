<table class="nk-tb-list nk-tb-ulist table" id="entities_users_table" data-export-title="Export">
    @if($message)
    <div class="alert alert-danger">
        <strong>{{ $message }}</strong>
    </div>
    @endif
    <thead>
        <tr class="nk-tb-item nk-tb-head">
            <th><input type="checkbox" class="select-checkbox"></th>
            <th class="nk-tb-col">
                <div class="dropdown">
                    <a class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" aria-expanded="false">Username <em class="icon ni ni-caret-down-fill"></em></a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                        <ul class="link-list-plain">
                            <li><a href="javascript:void(0);" class="asc-sort" column-order="1"><img src="{{ asset('images/dashboard/a-z-icon.png')}}" alt=""> From A to Z</a></li>
                            <li><a href="javascript:void(0);" class="dsc-sort" column-order="1"><img src="{{ asset('images/dashboard/a-z-icon.png')}}" alt=""> From Z to A</a></li>
                        </ul>
                    </div>
                </div>
            </th>
            <th class="nk-tb-col tb-col-mb">
                <div class="">
                    <a class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" aria-expanded="false">Job Title <em class="icon ni ni-caret-down-fill"></em></a>
                </div>
            </th>
            <th class="nk-tb-col tb-col-md">
                <div class="dropdown">
                    <a class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" aria-expanded="false">User Email <em class="icon ni ni-caret-down-fill"></em></a>
                </div>
            </th>
            <th class="nk-tb-col tb-col-lg">
                <div class="dropdown">
                    <a class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" aria-expanded="false">Mobile Number <em class="icon ni ni-caret-down-fill"></em></a>
                </div>
            </th>
            <th class="nk-tb-col tb-col-lg">
                <div class="dropdown">
                    <a class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" aria-expanded="false">Challenges <em class="icon ni ni-caret-down-fill"></em></a>
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
                    <a class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" aria-expanded="false">Entity Leader <em class="icon ni ni-caret-down-fill"></em></a>
                </div>
            </th>
            <th class="nk-tb-col nk-tb-col-tools text-right">
            </th>
        </tr>
    </thead>
    <tbody></tbody>
</table>


<table class="datatable-init nowrap nk-tb-list nk-tb-ulist table table-style-3" data-export-title="Export" id="challenge-plans-table">
    <thead>
        <tr class="nk-tb-item nk-tb-head">
            <th class="nk-tb-col widthHalf">
                Workstream/Task
            </th>
            <th class="nk-tb-col width9">
                Priority
            </th>
           
            <th class="nk-tb-col width10">
                Status
            </th>
            <th class="nk-tb-col tb-col-md">
                Progress
            </th>
            <th class="nk-tb-col tb-col-md text-center">
                Members
           </th>
           <th></th>
           <th></th>    
        </tr>
    </thead>
    <tbody>
        @if(count($plans))
        <tr>
            <td class="hiddenRow" colspan="12">
                <div id="accordion-1" class="accordion accordion-s2">
                    @foreach ($plans as $plan)
                         <!-- Accordion single item -->
                    <div class="accordion-item">
        
                        <table class="w-100 nk-tb-list">
                            <tr class="nk-tb-item curser noBdr">
                                <td class="widthHalf" data-toggle="collapse" data-target="#accordion-item-{{$loop->index}}">
                                   <h6 class="bold-text">@if(count($plan->childPlans)) <em class="icon ni ni-caret-up-fill"></em> @endif {{$plan->title_en}}</h6>
                                </td>
                                <td class="width9 pl-0">
                                    <span class="badge badge-dim {{$plan->priority =='Urgent' ? 'badge-danger' : ''  }} {{$plan->priority =='Medium' ? 'badge-success' : ''  }} {{$plan->priority =='Low' ? 'badge-warning' : ''  }}"><span>{{$plan->priority}}</span></span>
                                    <span></span>
                                </td>
                                <td class="width10 pl-0">
                                    <span class="in-progress">{{$plan->status}}</span>
                                </td>
                                <td class="progress_ proParent tb-col-md pl-0">
                                    <div class="progress-wrap">
                                        <div class="progress-text">
                                            <div class="progress-amount"><input type="text" placeholder="80"></div>
                                            <span class="percent_">%</span>
                                        </div>
                                        <div class="progress progress-md">
                                            <div class="progress-bar" data-progress="80" style="width: 80%;"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="tb-col-md">
                                    <div class="user-card multiple_member">
                                        <div class="user-avatar">
                                            <img src="{{ asset('images/dashboard/author-img.png') }}" alt="">
                                        </div>
                                        <div class="user-info">
                                            <div class="dropdown">
                                                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" aria-expanded="false">Multiple members <em class="icon ni ni-caret-down-fill"></em></a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-md">
                                                    <ul class="link-list-plain">
                                                        <li>
                                                            <div class="progressGrid">
                                                                <div class="progressIcon">
                                                                    <div class="nk-notification-icon">
                                                                        <em class="icon icon-circle bg-violate-50 ni ni-share"></em>
                                                                    </div>
                                                                </div>
                                                                <div class="progressBar">
                                                                    <span class="progressTitle">
                                                                        Services connections
                                                                    </span>
                                                                    <div class="progress progress-md">
                                                                        <div class="progress-bar" data-progress="75" style="width: 75%;"></div>
                                                                    </div>
                                                                    <div class="progressText">
                                                                        Progress: 75%
                                                                    </div>
                                                                </div>
                                                                <div class="progreeArrow">
                                                                    <em class="ni ni-chevron-right"></em>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="progressGrid">
                                                                <div class="progressIcon">
                                                                    <div class="nk-notification-icon">
                                                                        <em class="icon icon-circle bg-success-50 ni ni-curve-down-left"></em>
                                                                    </div>
                                                                </div>
                                                                <div class="progressBar">
                                                                    <span class="progressTitle">
                                                                        Services connections
                                                                    </span>
                                                                    <div class="progress progress-md">
                                                                        <div class="progress-bar" data-progress="75" style="width: 75%;"></div>
                                                                    </div>
                                                                    <div class="progressText">
                                                                        Progress: 75%
                                                                    </div>
                                                                </div>
                                                                <div class="progreeArrow">
                                                                    <em class="ni ni-chevron-right"></em>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="tb-col-md text-right">
                                    <div class="export"><a href="javascript:void(0);" data-act="ajax-modal1" data-complete-location="true" data-method="get"
                                        data-post-challenge_id="{{$plan->challenge->id}}"  data-action-url="{{route("dashboard.plans.edit",$plan->uuid)}}" data-table="challenges-table">  <em class="icon ni ni-edit"></em> Edit</a></div>
                                    {{-- <span class="curser">Edit</em></span> --}}
                                </td>
                            </tr>
                        </table>
                        @if(count($plan->childPlans))
                            <table class="w-100 nk-tb-list">
                                <tr class="noBdr">
                                    <td class="hiddenRow" colspan="12">
                                        <div class="accordion-body collapse" id="accordion-item-{{$loop->index}}" data-parent="#accordion-1">
                                        <table class="w-100 nk-tb-list">
                                            @foreach($plan->childPlans as $childPlan)
                                            <tr class="nk-tb-item">
                                                <td class="nk-tb-col widthHalf">
                                                    <div class="ml-3">
                                                        <p class="colorGray2">{{$childPlan->title_en}}</p>
                                                        @if($childPlan->start_date && $childPlan->end_date)
                                                        <div class="date- {{$childPlan->priority =='Urgent' ? 'color-red' : 'text-black-50'  }}">
                                                            <em class="icon ni ni-calendar"></em> {{Carbon\Carbon::parse($childPlan->start_date)->isoFormat('D MMM YYYY') }} - {{Carbon\Carbon::parse($childPlan->end_date)->isoFormat('D MMM YYYY') }}
                                                        </div>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col width9 pl-0">
                                                    <span class="badge badge-dim {{$childPlan->priority =='Urgent' ? 'badge-danger' : ''  }} {{$childPlan->priority =='Medium' ? 'badge-success' : ''  }} {{$childPlan->priority =='Low' ? 'badge-warning' : ''  }}"><span>{{$childPlan->priority}}</span></span>
                                                </td>
                                                <td class="nk-tb-col width10 pl-0">
                                                    <span class="in-progress">{{$childPlan->status}}</span>
                                                </td>
                                                <td class="progress_ proParent tb-col-md nk-tb-col pl-0">
                                                    <div class="progress-wrap">
                                                        <div class="progress-text">
                                                            <div class="progress-amount"><input type="text" placeholder="80"></div>
                                                            <span class="percent_">%</span>
                                                        </div>
                                                        <div class="progress progress-md">
                                                            <div class="progress-bar" data-progress="80" style="width: 80%;"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <div class="user-card multiple_member">
                                                        <div class="user-avatar">
                                                            <img src="{{ asset('images/dashboard/author-img.png') }}" alt="">
                                                        </div>
                                                        <div class="user-info text-soft">
                                                            Mohamed abdullah
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col tb-col-md text-right">
                                                    <div class="export"><a href="javascript:void(0);" data-act="ajax-modal1" data-complete-location="true" data-method="get"
                                                        data-post-challenge_id="{{$plan->challenge->id}}"  data-action-url="{{route("dashboard.plans.edit",$childPlan->uuid)}}" data-table="challenges-table">  <em class="icon ni ni-edit"></em> Edit</a></div>
                                                    {{-- <span class="curser">Edit</span> --}}
                                                </td>
                                            </tr>
                                            @endforeach
        
                                        </table>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        @endif
                    </div>
                     <!-- End Accordion single item -->
                    @endforeach
                </div> 
            </td>
        </tr>
         @else
         <tr class="odd"><td valign="top" colspan="7" class="dataTables_empty pt-5">No Plans Available</td></tr>
        @endif
    </tbody> 
   
</table>
<div>
    <nav>
        {!! $plans->links('vendor.pagination.custom') !!}
    </nav>
</div>


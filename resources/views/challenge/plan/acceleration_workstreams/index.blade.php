<table class="nowrap nk-tb-list nk-tb-ulist table table-style-3" data-export-title="Export" id="work_stream">
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
            <th>
                WS Leader
            </th>
            <th>
                Members
            </th>
            <th>
                Attachments
            </th>
            <th>
                Progress
            </th>
            <th>
                Actions
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($acc_workstreams as $workstream)
        <tr>
            <td class="hiddenRow" colspan="12">
                <div id="accordion-{{$loop->iteration}}" class="accordion accordion-s2">

                    <!-- Accordion single item -->
                    <div class="accordion-item">

                        <table class="w-100 nk-tb-list">
                            <tr class="nk-tb-item curser noBdr">
                                <td class="" data-toggle="collapse" data-target="#accordion-item-{{$loop->iteration}}">
                                    <h6 class="bold-text"> <em class="icon ni ni-caret-up-fill"></em> {{$workstream->name_en}} </h6>
                                </td>
                                <td class="pl-0">
                                    <span class="badge badge-dim"><span></span></span>
                                    <span></span>
                                </td>
                                <td class="pl-0">
                                    <span class="badge badge-dim"><span></span></span>
                                    <span></span>
                                </td>
                                <td class="text-right">
                                    <img src="{{$workstream->profile_photo_path ? asset('storage/'.$workstream->profile_photo_path) : '/images/dashboard/placeholder-image.png'}}" class="img img-rounded mr-1" style="border-radius:50%;width:40px;height:40px" />
                                    <span class="curser">{{$workstream->ws_leader($workstream->leader_id)->name_en}}</span>
                                </td>
                                <td class="text-right">
                                    <span class="curser">{{$workstream->members->count()}}</span>
                                </td>
                                <td class="text-right">
                                    <span class="curser">{{$workstream->countAttachments()}}</span>
                                </td>
                                <td class="text-right">
                                    <span class="curser">
                                        <div class="">
                                            <div class="progressBar">
                                                <div class="progress progress-md">
                                                    <div class="progress-bar" style="background-color: #00D85B" data-progress="{{$workstream->taskProgress()}}" style="width: {{$workstream->taskProgress()}}%;"></div>
                                                </div>
                                                <div class="progressText">
                                                    {{$workstream->taskProgress()}}%
                                                </div>
                                            </div>
                                        </div>
                                       </span>
                                </td>
                                <td class="text-right">
                                    <div class="page-right-dot-option table-options"><div class="dropdown">
                                        <a href="" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <ul class="link-list-opt no-bdr">
                                            <li><a href="javascript:void(0);" data-act="ajax-modal"   data-action-url="{{route('dashboard.acc-workstream.tasks.create',$workstream->id)}}" data-table="work_stream" data-method="get" ><img src="{{asset('images/dashboard/dot-icon1.png')}}"><span>Add New Task</span> </a></li>
                                            <li><a href="javascript:void(0)" data-act="ajax-modal"  data-table="work_stream" data-action-url="{{ route('dashboard.acceleration-workstreams.edit', $workstream->id)}}" data-method="get" data-title="Edit Work Stream"><em class="icon ni ni-edit"></em><span>Edit Work Stream</span></a></li>
                                            <li><a href="javascript:void(0)" class="delete " data-reload="true" data-url="{{route('dashboard.acceleration-workstreams.destroy', $workstream->id) }}"><em class="icon ni ni-trash text-danger"></em><span>Remove Work Stream</span> </a></li>  
                                            </ul>
                                        </div>
                                    </div></div>
                                </td>
                            </tr>
                        </table>
                        <table class="w-100 nk-tb-list">
                            @foreach($workstream->tasks as $task)
                                <tr class="noBdr">
                                    <td class="hiddenRow" colspan="12">
                                        <div class="accordion-body collapse" id="accordion-item-{{$loop->parent->iteration}}" data-parent="#accordion-{{$loop->parent->iteration}}">
                                            <table class="w-100 nk-tb-list">
                                                <tr class="nk-tb-item">
                                                    <td class="nk-tb-col widthHalf">
                                                        <div class="ml-3">
                                                            <p class="colorGray2">{{$task->title_en}}</p>

                                                            <div class="date">
                                                                <em class="icon ni ni-calendar"> </em>
                                                                {{Carbon\Carbon::parse($task->start_date)->format('d-m-Y') .' - ' .Carbon\Carbon::parse($task->end_date)->format('d-m-Y')}}
                                                            </div>

                                                        </div>
                                                    </td>
                                                    <td class="nk-tb-col width9 pl-0">
                                                        <p class="badge badge-dim {{$task->priority == 'low' ? 'badge-warning' : ($task->priority == 'medium' ? 'badge-success' : 'badge-danger')}}">{{$task->priority}}</p>
                                                    </td>
                                                    <td class="nk-tb-col width10 pl-0">
                                                        <span class="in-progress">{{$task->status}}</span>
                                                    </td>
                                                    <td class="text-right">
                                                        <img src="{{$workstream->profile_photo_path ? asset('storage/'.$workstream->profile_photo_path) : '/images/dashboard/placeholder-image.png'}}" class="img img-rounded mr-1" style="border-radius:50%;width:40px;height:40px" />
                                                        <span class="curser">{{$workstream->ws_leader($workstream->leader_id)->name_en}}</em></span>
                                                    </td>
                                                    <td class="text-right">
                                                        <span class="curser">{{$task->members->count()}}</em></span>
                                                    </td>
                                                    <td class="text-right">
                                                        <span class="curser">{{$task->images->count()}}</em></span>
                                                    </td>
                                                    <td class="text-right">
                                                        <span class="curser"></em>
                                                            <div class="">
                                                                <div class="progressBar">
                                                                    <div class="progress progress-md">
                                                                        <div class="progress-bar" style="background-color: #00D85B" data-progress="{{$task->progress}}" style="width: {{$task->progress}}%;"></div>
                                                                    </div>
                                                                    <div class="progressText">
                                                                        {{$task->progress}}%
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </span>
                                                    </td>
                                                    <td class="text-right">
                                                        <div class="page-right-dot-option table-options"><div class="dropdown">
                                                            <a href="" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li><a href="javascript:void(0)" data-act="ajax-modal"  data-table="work_stream" data-action-url="{{ route('dashboard.acc-workstream-tasks.edit', $task->id)}}" data-method="get" data-title="Edit Task"><em class="icon ni ni-edit"></em><span>Edit Task</span></a></li>
                                                                    <li><a href="javascript:void(0)" class="delete " data-reload="true" data-url="{{route('dashboard.acc-workstream-tasks.destroy', $task->id) }}"><em class="icon ni ni-trash text-danger"></em><span>Remove Task</span> </a></li>  
                                                                    </ul>
                                                            </div>
                                                        </div></div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- End Accordion single item -->
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
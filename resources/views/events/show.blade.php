@if (isset($event))
<div class="card-inner-event-calender-side-bar">
    <div class="row">
        <div class="col-sm-6">
            <div class="btn-holder">
                <a type="button" class="custom-delete-btn delete" data-table="events_table" data-reload="true"  data-method="get" data-url="{{route('dashboard.calendars.destroy',$event->id)}}">
                    <em class="icon ni ni-trash"></em>
                    Delete
                </a>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="btn-holder">
                <a type="button" data-act="ajax-modal" data-complete-location="true" data-method="get" class="custom-edit-btn" data-action-url="{{route("dashboard.calendars.edit",$event->id)}}" data-table="events-table"
                    data-title="EDIT COHORT STAGE">
                    <em class="icon ni ni-edit"></em>
                    Edit
                </a>
            </div>
        </div>
        <div class="col-sm-12">
            <p class="side-bar-text">
                {{ $event->subject_en }}
            </p>
        </div>
        <div class="col-sm-12">
            <div class="date-holder">
                <ul>
                    <li>
                        <label><em class="icon ni ni-calendar-fill"></em>
                            <span class="title">Date</span><br>
                            <small class="show-date">{{Carbon\Carbon::parse($event->start_date)->format('d M Y')}}  {{$event->end_date != null ? '-'.Carbon\Carbon::parse($event->end_date)->format('d M Y') : ''}}</small></label>
                    </li>
                    <li>
                        <label><em class="icon ni ni-clock"></em>
                            <span class="title">Timing</span><br>
                            <small class="show-date">{{Carbon\Carbon::parse($event->start_date)->format('H:i A')}}  {{$event->end_date != null ? '-'.Carbon\Carbon::parse($event->end_date)->format('H:i A') : ''}}</small></label>
                    </li>
                    @if ($event->event_on == 'cohorts')
                    <li>
                        <label><em class="icon ni ni-users"></em>
                            <span class="title">Cohorts</span><br>
                            <small class="show-date">{{ $event->cohort ? $event->cohort->name_en : 'N/A'}}</small></label>
                    </li>
                    @endif
                    @if ($event->event_on == 'challenges')
                    <li>
                        <label><em class="icon ni ni-bulb"></em>
                            <span class="title">Challenge</span><br>
                            <small class="show-date">{{ $event->challenge ? $event->challenge->name_en : 'N/A'}} </small></label>
                    </li>
                    @endif
                    @if($event->is_online)
                        <li>
                            <label><em class="icon ni ni-wifi"></em>
                                <span class="title">Meeting links</span><br>
                                <a href="{{ $event->meeting_link }}" id="meeting_link" target="__blank"><small class="show-date" style="text-transform: capitalize; font-size: 12px;">{{ $event->platform }}</small></a>
                                <span style="display: inline-block;margin-top: 9px;">
                                    <small class="copy-right-link"><em class="icon ni ni-link-alt"></em>
                                        Copy link
                                    </small>
                                </span>
                            </label>
                        </li>
                        <li>
                            <label><em class="icon ni ni-todo"></em>
                                <span class="title">Agenda</span><br>
                                <p class="long-text">
                                    {!! $event->agenda !!}
                                </p>
                            </label>
                        </li>
                    @else
                    <li>
                        <label><em class="icon ni ni-todo"></em>
                            <span class="title">Location in English</span><br>
                            <p class="long-text">
                                {{ $event->location_en }}
                            </p>
                        </label>
                    </li>
                    <li>
                        <label><em class="icon ni ni-todo"></em>
                            <span class="title">Location in Arabic</span><br>
                            <p class="long-text">
                                {{ $event->location_ar }}
                            </p>
                        </label>
                    </li>
                    <li>
                        <label><em class="icon ni ni-location"></em>
                            <span class="title">Location</span><br>
                            <a href="https://www.google.com/maps/dir/?api=1&destination={{$event->latitude}},{{$event->longitude}}&z=18" id="direction" target="__blank"><small class="show-date" style="text-transform: capitalize; font-size: 12px;">Direction</small></a>
                            
                        </label>
                    </li>
                    @endif
                    <li>
                        @if ($event->images)
                        <label><em class="icon ni ni-reports-alt"></em>
                            <span class="title">Attachments</span><br>
                            @foreach($event->images as $image)
                                <a href="{{getImage($image->url)}}" target="__blank"><small class="show-date">Attachment {{$loop->iteration}}</small></a>
                            @endforeach
                            </label>
                        @endif
                        
                    </li>
                    <li>
                        @if ($event->meeting_documents)
                        <label><em class="icon ni ni-reports-alt"></em>
                            <span class="title">Meeting Minutes</span><br>
                            @foreach($event->meeting_documents as $doc)
                                <a href="{{getImage($doc->url)}}" target="__blank"><small class="show-date">Meeting Minutes {{$loop->iteration}}</small></a>
                            @endforeach
                            </label>
                        @endif
                        
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>  
@endif

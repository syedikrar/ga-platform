@extends('layouts.app')

@section('custom-styles')
<link rel="stylesheet" href="{{asset('calender-assets/custom_style.css')}}" />
<style type="text/css">
    .hide_event_on{display: none;}
</style>
@endsection

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="breadcrumb-title">
                    <h5> Calendar </h5>
                </div>
                <div class="global-area">
                    <div class="tab-section">
                        <div class="card card-preview">
                            <div class="card-inner">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <ul class="nav nav-tabs mt-n3 justify-content-start m-3">
                                            <li class="nav-item">
                                                <a class="nav-link active filter-sector" data-sector=""
                                                    data-toggle="tab" href="#tabItem1">ALL EVENTS</a>
                                            </li>
                                            <li class="nav-item d-none">
                                                <a class="nav-link filter-sector" data-sector="Government"
                                                    data-toggle="tab" href="#tabItem4">Challenges</a>
                                            </li>
                                            <li class="nav-item d-none">
                                                <a class="nav-link filter-sector" data-sector="Private Sector"
                                                    data-toggle="tab" href="#tabItem5">Cohorts</a>
                                            </li>
                                            <li class="nav-item d-none">
                                                <a class="nav-link filter-sector" data-sector="Private Sector"
                                                    data-toggle="tab" href="#tabItem5">Activities</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="page-right-dot-option">
                                            <div class="nk-file-actions">
                                                <div class="dropdown">
                                                    <a href="" class="dropdown-toggle btn btn-sm btn-icon btn-trigger"
                                                        data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="javascript:void(0);" data-act="ajax-modal"
                                                                    data-complete-location="true" data-method="get"
                                                                    data-action-url="{{ route('dashboard.calendars.create') }}"
                                                                    data-table="entities-table" data-title="Add Entity">
                                                                    <img src="{{ asset('images/dashboard/dot-icon1.png')}}"
                                                                        alt=""><span>Add Event</span></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-content">
                                    <div class="tab-pane active" id="tabItem1">
                                        <div class="global-bg-white calendar-section">
                                            <div class="nk-block nk-block-lg bg-white">
                                                <div class="card bg-white">
                                                    <div class="row">
                                                        <div class="col-sm-9" style="padding-right: 0;">
                                                            <div class="card-inner-event-calender">
                                                                <div id="calendar"
                                                                    class="nk-calendar fc fc-media-screen fc-direction-ltr fc-theme-bootstrap"
                                                                    style="height: 800px;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3" id="events_show" style="padding-left: 0px;">
                                                            @include('events.show')
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- .card-preview -->
                                            </div>
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
    <script src="{{asset('calender-assets/fullcalendar.js')}}"></script>
    <script>
        let events = '{{ $formated_events}}'
        events = JSON.parse(events.replace(/&quot;/g,'"'));

    !function (NioApp, $) {
        "use strict"; // Variable
        var $win = $(window),
            $body = $('body'),
            breaks = NioApp.Break;

        NioApp.Calendar = function () {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();
        var tomorrow = new Date(today);
        tomorrow.setDate(today.getDate() + 1);
        var t_dd = String(tomorrow.getDate()).padStart(2, '0');
        var t_mm = String(tomorrow.getMonth() + 1).padStart(2, '0');
        var t_yyyy = tomorrow.getFullYear();
        var yesterday = new Date(today);
        yesterday.setDate(today.getDate() - 1);
        var y_dd = String(yesterday.getDate()).padStart(2, '0');
        var y_mm = String(yesterday.getMonth() + 1).padStart(2, '0');
        var y_yyyy = yesterday.getFullYear();
        var YM = yyyy + '-' + mm;
        var YESTERDAY = y_yyyy + '-' + y_mm + '-' + y_dd;
        var TODAY = yyyy + '-' + mm + '-' + dd;
        var TOMORROW = t_yyyy + '-' + t_mm + '-' + t_dd;
        var month = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        var calendarEl = document.getElementById('calendar');
        var eventsEl = document.getElementById('externalEvents');
        var removeEvent = document.getElementById('removeEvent');
        var addEventBtn = $('#addEvent');
        var addEventForm = $('#addEventForm');
        var addEventPopup = $('#addEventPopup');
        var updateEventBtn = $('#updateEvent');
        var editEventForm = $('#editEventForm');
        var editEventPopup = $('#editEventPopup');
        var previewEventPopup = $('#previewEventPopup');
        var deleteEventBtn = $('#deleteEvent');
        var mobileView = NioApp.Win.width < NioApp.Break.md ? true : false;
        var calendar = new FullCalendar.Calendar(calendarEl, {
        timeZone: 'UTC',
        initialView: mobileView ? 'listWeek' : 'dayGridMonth',
        themeSystem: 'bootstrap',
        headerToolbar: {
            left: 'title prev,next',
            center: null,
            right: 'today dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        height: 800,
        contentHeight: 780,
        aspectRatio: 3,
        editable: true,
        droppable: true,
        views: {
            dayGridMonth: {
            dayMaxEventRows: 2
            }
        },
        direction: NioApp.State.isRTL ? "rtl" : "ltr",
        nowIndicator: true,
        now: TODAY + 'T09:25:00',
        eventDragStart: function eventDragStart(info) {
            $('.popover').popover('hide');
        },
        eventMouseEnter: function eventMouseEnter(info) {
           
        },
        eventMouseLeave: function eventMouseLeave(info) {
            $(info.el).popover('hide');
        },
        eventClick: function eventClick(info) {
            var eventId = info.event._def.publicId;
            var url = '{{route("dashboard.calendars.show",":eventId")}}';
            url = url.replace(':eventId',eventId);
            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    $('#events_show').html(response.view);
                },
                error:function(responses) {
                    
                }
            });
        },
        events: events
    });
    calendar.render(); //Add event

    addEventBtn.on("click", function (e) {
        e.preventDefault();
        var eventTitle = $('#event-title').val();
        var eventStartDate = $('#event-start-date').val();
        var eventEndDate = $('#event-end-date').val();
        var eventStartTime = $('#event-start-time').val();
        var eventEndTime = $('#event-end-time').val();
        var eventDescription = $('#event-description').val();
        var eventTheme = $('#event-theme').val();
        var eventStartTimeCheck = eventStartTime ? 'T' + eventStartTime + 'Z' : '';
        var eventEndTimeCheck = eventEndTime ? 'T' + eventEndTime + 'Z' : '';
        console.log(eventStartTime);
        calendar.addEvent({
            id: 'added-event-id-' + Math.floor(Math.random() * 9999999),
            title: eventTitle,
            start: eventStartDate + eventStartTimeCheck,
            end: eventEndDate + eventEndTimeCheck,
            className: "fc-" + eventTheme,
            description: eventDescription
        });
        addEventPopup.modal('hide');
    });
    updateEventBtn.on("click", function (e) {
        e.preventDefault();
        var eventTitle = $('#edit-event-title').val();
        var eventStartDate = $('#edit-event-start-date').val();
        var eventEndDate = $('#edit-event-end-date').val();
        var eventStartTime = $('#edit-event-start-time').val();
        var eventEndTime = $('#edit-event-end-time').val();
        var eventDescription = $('#edit-event-description').val();
        var eventTheme = $('#edit-event-theme').val();
        var eventStartTimeCheck = eventStartTime ? 'T' + eventStartTime + 'Z' : '';
        var eventEndTimeCheck = eventEndTime ? 'T' + eventEndTime + 'Z' : '';
        var selectEvent = calendar.getEventById(editEventForm[0].dataset.id);
        selectEvent.remove();
        calendar.addEvent({
            id: editEventForm[0].dataset.id,
            title: eventTitle,
            start: eventStartDate + eventStartTimeCheck,
            end: eventEndDate + eventEndTimeCheck,
            className: "fc-" + eventTheme,
            description: eventDescription
        });
        editEventPopup.modal('hide');
    });
    deleteEventBtn.on("click", function (e) {
        console.log('ss');
        e.preventDefault();
        var selectEvent = calendar.getEventById(editEventForm[0].dataset.id);
        selectEvent.remove();
        location.reload();
    });

    function to12(time) {
        time = time.toString().match(/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

        if (time.length > 1) {
            time = time.slice(1);
            time.pop();
            time[5] = +time[0] < 12 ? ' AM' : ' PM'; // Set AM/PM

            time[0] = +time[0] % 12 || 12;
        }

        time = time.join('');
        return time;
    }

    function customCalSelect(cat) {
        if (!cat.id) {
            return cat.text;
        }
        var $cat = $('<span class="fc-' + cat.element.value + '"> <span class="dot"></span>' + cat.text + '</span>');
        return $cat;
    }

    ;
    NioApp.Select2('.select-calendar-theme', {
        templateResult: customCalSelect
    });
    addEventPopup.on('hidden.bs.modal', function (e) {
        setTimeout(function () {
            $('#addEventForm input,#addEventForm textarea').val('');
            $('#event-theme').val('event-primary');
            $('#event-theme').trigger('change.select2');
        }, 1000);
    });
    previewEventPopup.on('hidden.bs.modal', function (e) {
        $('#preview-event-header').removeClass().addClass('modal-header');
    });
};

    NioApp.coms.docReady.push(NioApp.Calendar);
    }(NioApp, jQuery);


    $(document).on('change','#event_on',function() {
        var name = $(this).val();
        var url = '{{route("dashboard.event-types",":name")}}';
            url = url.replace(':name',name);
        $.ajax({
            url: url,
            type: 'GET',
            success: function (response) {
                $(".hide_event_on").show();
                var event_name= `<span>*</span> `+name.trim().replace(/^\w/, (c) => c.toUpperCase());
                $('#event_on_id_label').empty().append(event_name);
                $('#event_on_values').removeClass('d-none');
                var $dropdown = $("#event_on_id");
                options= '<option selected disabled>Select event name</option>';
                $dropdown.empty();
                $.each(response.data, function() {
                    options += '<option value="' + this.id+ '">' + this.name_en + '</option>';
                });
                $('#event_on_id').empty().append(options);
            },
            error:function(responses){
                    
            }
        });
    });

    $(document).on('click', '.copy-right-link', function(e) {
        e.preventDefault();
        let link = $(this).siblings('#meeting_link').attr('href');
        var inputc = document.body.appendChild(document.createElement("input"));
        inputc.value =link;
        inputc.select();
        document.execCommand('copy');
        inputc.parentNode.removeChild(inputc);
    });

     $(document).on('change','#onlineStatusChange',function(){
            if($(this).is(':checked')){
                $('.platform_meeting').removeClass('d-none');
                $('.geo_location').addClass('d-none');
            }else{
                $('#event_meeting_ling').val('');
                $('.platform_meeting').addClass('d-none');
                $('.geo_location').removeClass('d-none');
            }
        });
        $(document).on('change','#invitation_type',function(){
            if($('#invitation_type :selected').val() == 'user'){
                $('.invitation_users').removeClass('d-none');
                $('.invitation_challanges').addClass('d-none');
            }else{
                $('.invitation_users').addClass('d-none');
                $('.invitation_challanges').removeClass('d-none');
            }
        });
        
    </script>   

@endpush
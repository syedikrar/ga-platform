@php
$isEdit = isset($event) ? true : false;
$url = $isEdit ? route('dashboard.calendars.update', $event->id) : route('dashboard.calendars.store');
@endphp
<form action="{{ $url }}" method="POST" id="events-form" enctype="multipart/form-data" data-form="ajax-form"
    data-modal="#ajax_model" data-redirect="{{ route('dashboard.calendars.index') }}">
    @csrf
    @if($isEdit)
    @method('put')
    @endif

    {{-- <div class="tab-content">
        <div class="tab-pane active" id="tabItem1">
        </div>
    </div> --}}
    <div class="modal-header align-center" style="border: 0px">
        <div class="nk-file-title">
            <div class="nk-file-icon">
                <span class="nk-file-icon-type">
                    <img src="{{ asset('images/dashboard/entities-icon.png')}}" alt="">
                </span>
            </div>
            <div class="nk-file-name">
                <div class="nk-file-name-text"><span class="title">Add New Event</span></div>
            </div>
        </div>
    </div>
    <div class="row mt-3 mx-1" style="border-bottom: 1px solid #dbdfea;">
        <div class="col-sm-12">
            <ul class="nav nav-tabs mt-n3 justify-content-center " id="myTab">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tab_basic_detail">Basic Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab_invitation">Invitations</a>
                </li>
                @if($isEdit)
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab_attendance">Attendance</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab_meeting_minutes">Meeting Minutes</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    <div class="modal-body p-4">
        <div class="tab-content">
            <div class="tab-pane active" id="tab_basic_detail">

                <div class="row">
                    <div class="col-sm-12 mb-4">
                        <div class="custom-control custom-switch custom-control-sm">
                            <input type="checkbox" class="custom-control-input sm" value="true" name="is_online"
                                id="onlineStatusChange" {{$isEdit ? ($event->is_online == 1 ? 'checked' : '' ) : ''}}>
                            <label class="custom-control-label" for="onlineStatusChange">Online Event</label>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="single-form-field single-form-row">
                            <label><span>*</span> Subject in English</label>
                            <input type="text" placeholder="Subject in English" name="subject_en"
                                value="{{$isEdit ? $event->subject_en : ''}}" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="single-form-field single-form-row">
                            <label><span>*</span> Subject in Arabic</label>
                            <input type="text" placeholder="Subject in Arabic" name="subject_ar"
                                value="{{$isEdit ? $event->subject_ar : ''}}" required>
                        </div>
                    </div>
                    <div class="col-sm-12  platform_meeting {{$isEdit && $event->is_online == 1 ? '' : 'd-none'}}">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="single-form-field single-form-row">
                                    <label><span>*</span> Platform</label>
                                    <select name="platform" id="platform"
                                        class="form-select form-control form-select-modal" data-search="on">
                                        <option value="" selected="">Choose Type</option>
                                        <option value="teams" {{$isEdit ? ($event->platform == "teams" ? 'selected' : ''
                                            ) : ''}}>Teams</option>
                                        <option value="zoom" {{$isEdit ? ($event->platform == "zoom" ? 'selected' : '' )
                                            : ''}}>Zoom</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="single-form-field single-form-row">
                                    <label><span>*</span>Meeting URL Link</label>
                                    <input type="text" placeholder="Past the link " id="event_meeting_ling"
                                        name="meeting_link"
                                        value="{{$isEdit ? ($event->is_online == 1 ? $event->meeting_link : '') : ''}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 geo_location {{$isEdit ? ($event->is_online == 0 ? '' : 'd-none') : ''}}">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="single-form-field single-form-row">
                                    <label><span>*</span> Location In English</label>
                                    <input type="text" placeholder="Location In English" name="location_en"
                                        value="{{$isEdit ? ($event->is_online == 0 ? $event->location_en : '') : ''}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="single-form-field single-form-row">
                                    <label><span>*</span> Location In Arabic</label>
                                    <input type="text" placeholder="Location In Arabic" name="location_ar"
                                        value="{{$isEdit ? ($event->is_online == 0 ? $event->location_ar : '') : ''}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="single-form-field single-form-row">
                                    <label>Longitude</label>
                                    <input type="text" placeholder="Longitude" id="longitude-popup" name="longitude"
                                        value="{{$isEdit ? ($event->is_online == 0 ? $event->longitude : '') : ''}}"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="single-form-field single-form-row">
                                    <label>Latitude</label>
                                    <input type="text" placeholder="Latitude" id="latitude-popup" name="latitude"
                                        value="{{$isEdit ? ($event->is_online == 0 ? $event->latitude : '') : ''}}"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-2">
                                <label class="form-label" for="name">Location</label>
                                <input style="width: 80%;" type="text" id="searchInputPopup" name="location"
                                    class="form-control map-input mt-2 mr-2">
                                <div id="address-map-container" style="width:100%;height:300px; ">
                                    <div style="width: 100%; height: 100%" id="map-popup"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="single-form-field single-form-row">
                            <label>Agenda</label>
                            <textarea class="w-100" rows="5" id="agenda"
                                name="agenda">{{$isEdit ? $event->agenda : ''}}</textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="single-form-field single-form-row">
                            <label><span>*</span> Start Date</label>
                            <input type="datetime-local" placeholder="Entity Website" name="start_date"
                                value="{{$isEdit ? Carbon\Carbon::parse($event->start_date)->format('Y-m-d\TH:i') : ''}}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="single-form-field single-form-row">
                            <label> End Date</label>
                            <input type="datetime-local" name="end_date"
                                value="{{$isEdit && $event->end_date != null ? Carbon\Carbon::parse($event->end_date)->format('Y-m-d\TH:i') : ''}}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="single-form-field single-form-row">
                            <label><span>*</span> Add Event on</label>
                            <select name="event_on" id="event_on" required
                                class="form-select form-control form-select-modal" data-search="on">
                                <option value="" selected="">Choose Event on</option>
                                <option value="challenges" {{$isEdit ? ($event->event_on == "challenges" ? 'selected' :
                                    '' ) : ''}}>Challenges</option>
                                <option value="cohorts" {{$isEdit ? ($event->event_on == "cohorts" ? 'selected' : '' ) :
                                    ''}}>Cohorts</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="single-form-field single-form-row">
                            <label><span>*</span> Type</label>
                            <select name="type" id="type" required class="form-select form-control form-select-modal"
                                data-search="on">
                                <option value="" selected="">Choose Type</option>
                                @foreach(config('events_type') as $key => $type)
                                <option value="{{$key}}" {{$isEdit ? ($event->type == $key ? 'selected' : '' ) :
                                    ''}}>{{$type}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 {{$isEdit ? '' : 'hide_event_on'}}">
                        <div class="single-form-field single-form-row">
                            <label id="event_on_id_label"></label>
                            <select name="event_on_id" id="event_on_id"
                                class="form-select form-control form-select-modal" data-search="on">
                                @if($isEdit)
                                @foreach($data as $item)
                                <option value="{{$item->id}}" {{$item->id==$event->event_on_id ? 'selected' :
                                    ''}}>{{$item->name_en}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="single-form-field single-form-row">
                            <div class="needsclick dropzone" id="document-dropzone">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="tab-pane" id="tab_invitation">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="single-form-field single-form-row">
                            <select name="invitation_type" id="invitation_type" 
                                class="form-select form-control form-select-modal">
                                <option value="user">Users</option>
                                <option value="challenge" >Challenges</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 invitation_users">
                        <div class="single-form-field single-form-row">
                            <select name="users[]" multiple="multiple" 
                                class="form-select form-control form-select-modal users-for-invite">
                                @foreach($users as $user)                                
                                    <option  value="{{$user->id}}" {{$isEdit ? (in_array($user->id,
                                        $event->invitations()->pluck('user_id')->toArray()) ? 'selected' : '') : ''}}>{{$user->name_en  }} ( {{$user->email }} )</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 d-none invitation_challanges" >
                        <div class="single-form-field single-form-row">
                            <select name="challenges[]" multiple="multiple" 
                                class="form-select form-control form-select-modal challenges_for_invite">
                                @foreach($challenges as $challenge)                                
                                    <option value="{{$challenge->id}}" >{{$challenge->name_en  }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane " id="tab_attendance">
                @if($isEdit && $event->invitations)
                    <div class="row">
                        <div class="col-sm-12">
                            <section>
                                <div class="table-searchbar mb-3">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-left">
                                                <em class="icon ni ni-search"></em>
                                            </div>
                                            <input type="text" class="form-control" id="searchBar"
                                                placeholder="Search">
                                        </div>
                                    </div>
                                </div>
                
                                @foreach($event->invitations as $user)
                                <div class="d-flex align-content-start flex-wrap mb-3 workstream_members">
                                    
                                    <div class="p-2">
                                        <img src="{{$user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) :  asset('images/dashboard/placeholder-image.png')}}" alt="" style="height: 40px;">
                                    </div>
                                    <div class="p-2 flex-fill align-middle">
                                        <a href="javascript:void(0);">{{$user->name_en}}</a>
                                    </div>
                                    <div class="p-2 flex-fill align-middle">
                                        {{$user->entity ? $user->entity->name_en : '----'}}
                                    </div>
                                    <div class="p-2 align-middle">
                                        <div class="custom-control custom-switch custom-control-sm">
                                            <input type="checkbox" class="custom-control-input sm"  {{$isEdit && $event->attendance ? (in_array($user->id,
                                                $event->attendance()->pluck('user_id')->toArray()) ? 'checked' : '') : 'checked'}} value="{{$user->id}}" name="attendance_ids[]" id="{{$user->id}}">
                                                <label class="custom-control-label" for="{{$user->id}}"></label>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                
                            </section>
                        </div>
                    </div>
                @endif
            </div>
            <div class="tab-pane " id="tab_meeting_minutes">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="single-form-field single-form-row">
                            <div class="needsclick dropzone" id="meeting_dropzone">
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
<style>
    .pac-container {
        background-color: #FFF;
        z-index: 1030;
        position: fixed;
        display: inline-block;
        float: left;
    }

    .modal {
        z-index: 1030;
    }

    .modal-backdrop {
        z-index: 1020;
    }
</style>
<script>
    //dropzone script start
    var uploadedDocumentMap = {}
    var dropzone = new Dropzone('#document-dropzone',{
            createImageThumbnails: true,
            addRemoveLinks: true,
            preventDuplicates: true,
            dictDefaultMessage :'Drop Gallery Images to Upload',
            dictMaxFilesExceeded : "You can not upload any more files.",
            maxFiles:10,
            dictInvalidFileType: 'This file type is not supported.',
            dictFileTooBig:'File size too Big',
            url: "{{route('dashboard.event.storeImage')}}",
            acceptedFiles: ".png,.jpg,.jpeg,.pdf,.doc,.docx",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            maxfilesexceeded: function(file) {
                file.previewElement.remove();
                toastr.error('You can upload upto 10 files only');
            },
            success: function (file, response) {
                file.filename = response.name;
                $('#events-form').append('<input type="hidden" name="images[]" value="' + response.name + '">');
                uploadedDocumentMap[file.name] = response.name;
            },
            removedfile: function (file) {
                var imagename=file.filename;
                imagename=imagename.replace('events/','');
                if (typeof(file.id) != "undefined"){
                        var id= file.id;
                        var url = '{{ route("dashboard.event.removeImage",":name,:id") }}';
                        url = url.replace(':name,:id', imagename+'/'+id);
                }
                else{
                    var url = '{{ route("dashboard.event.removeImage",":name") }}';
                    url = url.replace(':name', imagename);
                }
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: {_method: 'DELETE','_token':'{{csrf_token()}}',submit:true},
                    success: function (response) {
                        file.previewElement.remove();
                        var name = '';
                        if (typeof file.name !== 'undefined') {
                            name = file.filename;
                        } 
                        else {
                            name = uploadedDocumentMap[file.filename];
                        }
                        $('#events-form').find('input[name="images[]"][value="' + name + '"]').remove();
                    },
                    error:function(errors){
                    }
                });
            },
            init: function () {
                @if(isset($event) && $event->images)
                    console.log('data');
                    var files = {!! json_encode($event->images) !!}
                    for (var i in files) {
                        var mockFile = { id:files[i]['id'],name:files[i]['url'],filename: files[i]['url'], size: 1224 };
                        this.options.addedfile.call(this, mockFile);
                        $("[data-dz-thumbnail]").css("height", "120");
                        $("[data-dz-thumbnail]").css("width", "120");
                        $("[data-dz-thumbnail]").css("object-fit", "cover");
                        this.options.thumbnail.call(this, mockFile, "/storage/"+files[i]['url']);
                        this.emit("complete", mockFile);
                        $('#events-form').append('<input type="hidden" name="images[]" value="' +files[i]['url']+'">');
                    }
                @endif
            }
        });
        //dropzone script start
    var uploadedMeetingDocumentMap = {}
    var dropzone = new Dropzone('#meeting_dropzone',{
            createImageThumbnails: true,
            addRemoveLinks: true,
            preventDuplicates: true,
            dictDefaultMessage :'Drop Meeting Document to Upload',
            dictMaxFilesExceeded : "You can not upload any more files.",
            maxFiles:10,
            dictInvalidFileType: 'This file type is not supported.',
            dictFileTooBig:'File size too Big',
            url: "{{route('dashboard.event.store-meeting-document')}}",
            acceptedFiles: ".png,.jpg,.jpeg,.pdf,.doc,.docx",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            maxfilesexceeded: function(file) {
                file.previewElement.remove();
                toastr.error('You can upload upto 10 files only');
            },
            success: function (file, response) {
                file.filename = response.name;
                $('#events-form').append('<input type="hidden" name="meeting_documents[]" value="' + response.name + '">');
                uploadedMeetingDocumentMap[file.name] = response.name;
            },
            removedfile: function (file) {
                var imagename=file.filename;
                imagename=imagename.replace('meetings/','');
                if (typeof(file.id) != "undefined"){
                        var id= file.id;
                        var url = '{{ route("dashboard.event.remove-meeting-document",":name,:id") }}';
                        url = url.replace(':name,:id', imagename+'/'+id);
                }
                else{
                    var url = '{{ route("dashboard.event.remove-meeting-document",":name") }}';
                    url = url.replace(':name', imagename);
                }
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: {_method: 'DELETE','_token':'{{csrf_token()}}',submit:true},
                    success: function (response) {
                        file.previewElement.remove();
                        var name = '';
                        if (typeof file.name !== 'undefined') {
                            name = file.filename;
                        } 
                        else {
                            name = uploadedMeetingDocumentMap[file.filename];
                        }
                        $('#events-form').find('input[name="meeting_documents[]"][value="' + name + '"]').remove();
                    },
                    error:function(errors){
                    }
                });
            },
            init: function () {
                @if(isset($event) && $event->meeting_documents)
                    var files = {!! json_encode($event->meeting_documents) !!}
                    for (var i in files) {
                        var mockFile = { id:files[i]['id'],name:files[i]['url'],filename: files[i]['url'], size: 1224 };
                        this.options.addedfile.call(this, mockFile);
                        $("[data-dz-thumbnail]").css("height", "120");
                        $("[data-dz-thumbnail]").css("width", "120");
                        $("[data-dz-thumbnail]").css("object-fit", "cover");
                        this.options.thumbnail.call(this, mockFile, "/storage/"+files[i]['url']);
                        this.emit("complete", mockFile);
                        $('#events-form').append('<input type="hidden" name="meeting_documents[]" value="' +files[i]['url']+'">');
                    }
                @endif
            }
        });
        $('.challenges-for-invite').select2();
        $('.users-for-invite').select2();
    $("#agenda").summernote({
        toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
        
        ]
    }); 
</script>
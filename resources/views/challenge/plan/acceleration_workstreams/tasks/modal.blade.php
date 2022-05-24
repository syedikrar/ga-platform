@php
$isEdit = isset($task) ? true : false;
$url = $isEdit ? route('dashboard.acc-workstream-tasks.update', $task->id) : route('dashboard.acc-workstream-tasks.store');
@endphp
<form action="{{ $url }}" method="POST" id="task_form" data-reload="true" data-form="ajax-form" data-modal="#ajax_model" >
    @csrf
    @if($isEdit)
    @method('put')
    @endif
    <div class="container">
        <div class="row p-2 border-bottom">
            <div class="col-sm-12 pt-1">
                <div class="nk-file-name">
                    <div class="nk-file-name"><span class="title"><img
                                src="{{ asset('images/dashboard/dot-icon1.png')}}" alt="" class="mr-2" width="6%">{{$isEdit ? 'Update Task' : 'Add New Task'}} </span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-body p-4">
        <div id="tasks-wizard" class="nk-wizard nk-wizard-simple custom_model_form">
            <div class="nk-wizard-head">
             <h5>Basic details</h5>
            <em class="icon ni ni-dot"></em>
            </div>
            <section>
                <div class="row">
                    <input type="hidden" value="{{$isEdit ? '' : $workstream_id}}" name="acc_workstream_id"/>
                    <div class="col-sm-6">
                        <div class="single-form-field single-form-row">
                            <label><span>*</span> Title In English</label>
                            <input type="text" placeholder="Title In English" name="title_en" value="{{$isEdit ? $task->title_en : ''}}"
                                >
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="single-form-field single-form-row">
                            <label><span>*</span> Title In Arabic</label>
                            <input type="text" placeholder="Title In Arabic" name="title_ar" value="{{$isEdit ? $task->title_ar : ''}}"
                                >
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="single-form-field single-form-row">
                            <label><span>*</span> Start Date</label>
                            <input type="datetime-local"  value="{{$isEdit ? Carbon\Carbon::parse($task->start_date)->format('Y-m-d\TH:i') : ''}}"
                                name="start_date">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="single-form-field single-form-row">
                            <label><span>*</span> End Date</label>
                            <input type="datetime-local" name="end_date" value="{{$isEdit ? Carbon\Carbon::parse($task->end_date)->format('Y-m-d\TH:i') : ''}}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="single-form-field single-form-row">
                            <label><span>*</span> Priority</label>
                            <select name="priority" id="priority"
                                class="form-select form-control form-select-modal"
                                data-search="on">
                                <option value="" selected="">Choose Priority</option>
                                <option value="low" {{$isEdit && $task->priority == 'low' ? 'selected' : ''}}>Low</option>
                                <option value="medium" {{$isEdit && $task->priority == 'medium' ? 'selected' : ''}} >medium</option>
                                <option value="urgent" {{$isEdit && $task->priority == 'urgent' ? 'selected' : ''}}>Urgent</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="single-form-field single-form-row">
                            <label><span>*</span> Status</label>
                            <select name="status" id="status"
                                class="form-select form-control form-select-modal"
                                data-search="on">
                                <option  selected disabled>Choose Priority</option>
                                <option value="in progress" {{$isEdit && $task->status == 'in progress' ? 'selected' : ''}}>In Progress</option>
                                <option value="complete" {{$isEdit && $task->status == 'complete' ? 'selected' : ''}}>Complete</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="single-form-field single-form-row">
                            <label><span>*</span> Progress</label>
                            <input type="text" placeholder="Progress" name="progress" value="{{$isEdit ?  $task->progress : ''}}">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="single-form-field single-form-row">
                            <div class="needsclick dropzone" id="document-dropzone">
                            </div>
                        </div>
                    </div>

                </div>
            </section>
            <div class="nk-wizard-head">
             <h5>Members</h5>
            <em class="icon ni ni-dot"></em>
            </div>
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

                    @foreach($members as $member)
                    <div class="d-flex align-content-start flex-wrap mb-3 workstream_members">
                        
                        <div class="p-2">
                            <img src="{{$member->profile_photo_path ? asset('storage/' . $member->profile_photo_path) :  asset('images/dashboard/placeholder-image.png')}}" alt="" style="height: 40px;">
                        </div>
                        <div class="p-2 flex-fill align-middle">
                            <a href="javascript:void(0);">{{$member->name_en}}</a>
                        </div>
                        <div class="p-2 flex-fill align-middle">
                            {{$member->entity->name_en}}
                        </div>
                        <div class="p-2 align-middle">
                            <div class="custom-control custom-switch custom-control-sm">
                                <input type="checkbox" class="custom-control-input sm" value="{{$member->id}}" {{ $isEdit && in_array($member->id,
                                    $task->members()->pluck('user_id')->toArray()) ? 'checked' : ''}} name="member_id[]" id="{{$member->id}}">
                                    <label class="custom-control-label" for="{{$member->id}}"></label>
                            </div>
                        </div>
                    </div>
                    @endforeach
                
            </section>
            <div class="discardBtn">
                <button type="button" data-dismiss="modal" class="btn btn-primary btn-white">Discard</button>
            </div>
        </div>
    </div>
</form>
<script>
    $("#tasks-wizard").steps({
    headerTag: ".nk-wizard-head",
    bodyTag: "section",
    onFinished: function (event, currentIndex) {
        $("#task_form").submit();
    }
});
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
            url: "{{route('dashboard.task.storeImage')}}",
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
                $('#task_form').append('<input type="hidden" name="images[]" value="' + response.name + '">');
                uploadedDocumentMap[file.name] = response.name;
            },
            removedfile: function (file) {
                var imagename=file.filename;
                imagename=imagename.replace('tasks/','');
                if (typeof(file.id) != "undefined"){
                        var id= file.id;
                        var url = '{{ route("dashboard.task.removeImage",":name,:id") }}';
                        url = url.replace(':name,:id', imagename+'/'+id);
                }
                else{
                    var url = '{{ route("dashboard.task.removeImage",":name") }}';
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
                        $('#task_form').find('input[name="images[]"][value="' + name + '"]').remove();
                    },
                    error:function(errors){
                    }
                });
            },
            init: function () {
                @if(isset($task) && $task->images)
                    console.log('data');
                    var files = {!! json_encode($task->images) !!}
                    for (var i in files) {
                        var mockFile = { id:files[i]['id'],name:files[i]['url'],filename: files[i]['url'], size: 1224 };
                        this.options.addedfile.call(this, mockFile);
                        $("[data-dz-thumbnail]").css("height", "120");
                        $("[data-dz-thumbnail]").css("width", "120");
                        $("[data-dz-thumbnail]").css("object-fit", "cover");
                        this.options.thumbnail.call(this, mockFile, "/storage/"+files[i]['url']);
                        this.emit("complete", mockFile);
                        $('#task_form').append('<input type="hidden" name="images[]" value="' +files[i]['url']+'">');
                    }
                @endif
            }
        });
</script>
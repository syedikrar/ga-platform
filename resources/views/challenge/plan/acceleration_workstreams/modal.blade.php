@php
$isEdit = isset($acc_workstream) ? true : false;
$url = $isEdit ? route('dashboard.acceleration-workstreams.update', $acc_workstream->id) : route('dashboard.acceleration-workstreams.store');
@endphp

<form action="{{ $url }}" data-reload="true" method="POST" id="acceleration_workstream_form"  data-form="ajax-form" data-modal="#ajax_model">
    @csrf
    @if($isEdit)
    @method('put')
    @endif
    <div class="container">
        <div class="row p-2 border-bottom">
            <div class="col-sm-12 pt-1">
                <div class="nk-file-name">
                    <div class="nk-file-name"><span class="title"><img
                                src="{{ asset('images/dashboard/dot-icon1.png')}}" alt="" class="mr-2" width="6%"> Add
                            New Workstream</span></div>
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
                <input type="hidden" value="{{$isEdit ? $acc_workstream->challenge_id : $challenge_id}}" name="challenge_id"/>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="single-form-field single-form-row">
                            <label><span>*</span> Name In English</label>
                            <input type="text" placeholder="Name In English" name="name_en"  value="{{$isEdit ? $acc_workstream->name_en : ''}}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="single-form-field single-form-row">
                            <label><span>*</span> Name In Arabic</label>
                            <input type="text" placeholder="Name In Arabic" name="name_ar"  value="{{$isEdit ? $acc_workstream->name_ar : ''}}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="single-form-field single-form-row">
                            <label><span>*</span> Description English</label>
                            <div class="input-group">
                                <textarea name="description_en" class="form-control form-control-sm" rows="3">{{$isEdit ? $acc_workstream->description_en : ''}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="single-form-field single-form-row">
                            <label><span>*</span> Description Arabic</label>
                            <textarea name="description_ar" class="form-control form-control-sm" rows="3">{{$isEdit ? $acc_workstream->description_ar : ''}}</textarea>
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
                            <input type="checkbox" class="custom-control-input sm" {{ $isEdit && in_array($member->id,
                                $acc_workstream->members()->pluck('user_id')->toArray()) ? 'checked' : ''}} value="{{$member->id}}" name="member_id[]" id="{{$member->id}}">
                                <label class="custom-control-label" for="{{$member->id}}"></label>
                        </div>
                    </div>
                </div>
                @endforeach
                
            </section>
            <div class="nk-wizard-head">
             <h5>Workstream Leader</h5>
            <em class="icon ni ni-dot"></em>
            </div>
            <section>
                <div class="d-flex align-content-start flex-wrap mb-3">
                    <div class="p-2 align-middle">
                        <div class="single-form-field single-form-row">
                            <label id="event_on_id_label">Workstream Leader</label>
                            <select name="leader_id" id="leader_id" class="form-select form-control form-select-modal" data-search="on" >
                                <option selected disabled>Select Team Leader</option>
                                @foreach($members as $member)
                                    <option value="{{$member->id}}" {{ $isEdit && $acc_workstream->leader_id == $member->id ? 'selected' : ''}}>{{$member->name_en}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
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
    labels: {
         finish: "Save",
    },
    onFinished: function (event, currentIndex) {
        $("#acceleration_workstream_form").submit();
    }
});
</script>
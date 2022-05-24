@php
$isEdit = isset($work_stream) ? true : false;
$url = $isEdit ? route('dashboard.workstreams.update', $work_stream->id) : route('dashboard.workstreams.store');
@endphp
<form action="{{ $url }}" method="POST" id="workstream_form" data-datatable="#work_stream" data-form="ajax-form" data-modal="#ajax_model" >
    @csrf
    @if($isEdit)
    @method('put')
    @endif
    <div class="container">
        <div class="row p-2 border-bottom">
            <input type="hidden" value="{{$isEdit ? '' : $challenge_id}}" name="challenge_id"/>
            <div class="col-sm-12 pt-1">
                <div class="nk-file-name">
                    <div class="nk-file-name"><span class="title"><img
                                src="{{ asset('images/dashboard/dot-icon1.png')}}" alt="" class="mr-2" width="6%"> ADD
                            New WorkStream</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-body p-4">
        <div id="example-basic">
            <h3>Basic Info</h3>
            <section>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="single-form-field single-form-row">
                            <label><span>*</span> Name in English</label>
                            <input type="text" placeholder="Subject in English" value="{{$isEdit ? $work_stream->name_en : ''}}" name="name_en">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="single-form-field single-form-row">
                            <label><span>*</span> Name in Arabic</label>
                            <input type="text" placeholder="Subject in Arabic" name="name_ar" value="{{$isEdit ? $work_stream->name_ar : ''}}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="single-form-field single-form-row">
                            <label><span>*</span> Mode</label>
                            <select name="mode" id="mode" class="form-select form-control form-select-modal"
                                data-search="on">
                                <option value="" selected="">Choose Mode</option>
                                <option value="sustainability" {{$isEdit && $work_stream->mode == 'sustainability' ? 'selected' : ''}}>Sustainability</option>
                                <option value="scalability" {{$isEdit && $work_stream->mode == 'scalability' ? 'selected' : ''}}>Scalability</option>
                                <option value="acceleration" {{$isEdit && $work_stream->mode == 'acceleration' ? 'selected' : ''}}>Acceleration</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="single-form-field single-form-row">
                            <label><span>*</span> Priority</label>
                            <select name="priority" id="priority" class="form-select form-control form-select-modal"
                                data-search="on">
                                <option value="" selected="">Choose Priority</option>
                                <option value="low" {{$isEdit && $work_stream->priority == 'low' ? 'selected' : ''}}>Low</option>
                                <option value="medium" {{$isEdit && $work_stream->priority == 'medium' ? 'selected' : ''}}>medium</option>
                                <option value="high" {{$isEdit && $work_stream->priority == 'high' ? 'selected' : ''}}>High</option>
                            </select>
                        </div>
                    </div>

                </div>
            </section>
            <h3>Lead Entity</h3>
            <section>
                <div class="row">
                    <div class="col-sm-12 mb-4">
                        <div class="custom-control custom-switch custom-control-sm">
                            <input type="checkbox" class="custom-control-input sm" checked value="true" name="is_existing_user"
                                id="isExistingUser">
                            <label class="custom-control-label" for="isExistingUser">Existing User ? </label>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="single-form-field single-form-row">
                            <label><span>*</span> Entity Name</label>
                            <select name="entity_id" id="priority" class="form-select form-control form-select-modal"
                                data-search="on">
                                <option value="" selected="">Choose Entity Name</option>
                                @foreach($entity_names as $name)
                                <option value="{{$name->id}}" {{$isEdit && $work_stream->entity_id == $name->id ? 'selected' : ''}}>{{$name->name_en}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-4">
                        <div class="custom-control custom-switch custom-control-sm">
                            <input type="checkbox" class="custom-control-input sm" value="true" name="is_send_email"
                                id="isSendEmail">
                            <label class="custom-control-label" for="isSendEmail">Send Email</label>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-4">
                        <div class="custom-control custom-switch custom-control-sm">
                            <input type="checkbox" class="custom-control-input sm" value="true" name="is_send_sms"
                                id="isSendSMS">
                            <label class="custom-control-label" for="isSendSMS">Send SMS</label>
                        </div>
                    </div>
                    <div class="col-sm-12 bg-white">
                        <ul class="btn-toolbar g-3">
                            <li><a href="#" data-dismiss="modal" class="btn btn-outline-light btn-white">Discard</a></li>
                            <li><button href="#" type="submit"  class="btn btn-primary">Save</button></li>
                        </ul>
                    </div>
                </div>
            </section>
        </div>
    </div>
</form>
<script>
    $("#example-basic").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    autoFocus: true
});
</script>
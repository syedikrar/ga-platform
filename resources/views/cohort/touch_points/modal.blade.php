@php
$isEdit = isset($touch_point) ? true : false;
$url = $isEdit ? route('dashboard.touchpoints.update', $touch_point->id) : route('dashboard.touchpoints.store');
@endphp
<form action="{{$url}}" method="POST" data-form="ajax-form" data-datatable="#touch_point_table"
    data-modal="#ajax_model">
    @csrf
    @if($isEdit)
    @method('put')
    @endif
    <div class="modal-header align-center">
        <div class="nk-file-title">
            <div class="nk-file-icon">
                <span class="nk-file-icon-type">
                    <img class="width-sm" src="{{ asset('images/dashboard/dot-icon1.png')}}" alt="">
                </span>
            </div>
            <div class="nk-file-name">
                <div class="nk-file-name-text"><span class="title">{{$isEdit ? 'Update Touchpoint' : 'Add Touchpoint'}}</span></div>
            </div>
        </div>
    </div>

    <div class="modal-body p-0">
        <div class="form-grid">
            <div class="form-column">
                <input type="hidden" value="{{$isEdit ? '' : $cohort_id}}" name="cohort_id" />
                <div class="single-form-field">
                    <label><span>*</span> Title in English</label>
                    <input type="text" name="title_en" placeholder="Title in English"
                        value="{{$isEdit ? $touch_point->title_en : ''}}">
                </div>
                <div class="single-form-field">
                    <label><span>*</span> Subtitle In English</label>
                    <input type="text" placeholder="Description in English" name="subtitle_en"
                        value="{{$isEdit ? $touch_point->subtitle_en : ''}}">
                </div>

                <div class="single-form-field">
                <label>Picure (Default) (130 x 130 px)</label>

                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{$isEdit ? asset('storage/' . $touch_point->default_image)  : '/images/dashboard/food-safety-filled.png'}}">
                        </div>
                        <div class="col-md-9">
                            <div class="custom-file mt-1">
                                <input type="file" name="default_image" class="custom-file-input" id="default_image">
                                <label class="custom-file-label" for="default_image">Choose icon</label>
                             </div>
                        </div>
                    </div>
                </div>
                <div class="single-form-field">
                    <div class="custom-control custom-switch custom-control-sm pl-5">
                        <input type="checkbox" class="custom-control-input sm" {{$isEdit && $touch_point->is_completed == 1 ? 'checked' : ''}} value="true" name="is_completed"
                            id="is_completed">
                        <label class="custom-control-label" for="is_completed">Completed</label>
                    </div>
                </div>
            </div>
            <div class="form-column">
                <div class="single-form-field">
                    <label><span>*</span> Title in Arabic</label>
                    <input type="text" placeholder="Title in Arabic" name="title_ar"
                        value="{{$isEdit ? $touch_point->title_ar : ''}}">
                </div>
                <div class="single-form-field">
                    <label><span>*</span> Subtitle In Arabic</label>
                    <input type="text" placeholder="Description in Arabic" name="subtitle_ar"
                        value="{{$isEdit ? $touch_point->subtitle_ar : ''}}">
                </div>
                
                <div class="single-form-field">
                    <label>Picture (Done) (130 x 130 px)</label>

                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{$isEdit ? asset('storage/' . $touch_point->done_image) : '/images/dashboard/food-safety.png'}}">
                        </div>
                        <div class="col-md-9">
                            <div class="custom-file mt-1">
                                <input type="file" name="done_image" class="custom-file-input" id="done_image">
                                <label class="custom-file-label" for="done_image">Choose icon</label>
                             </div>
                        </div>
                    </div>
                </div>
                <div class="single-form-field">
                    <div class="custom-control custom-switch custom-control-sm pl-5">
                        <input type="checkbox" class="custom-control-input sm" value="true" name="is_send_update" {{$isEdit && $touch_point->is_send_update == 1 ? 'checked' : ''}}
                            id="is_send_update">
                        <label class="custom-control-label" for="is_send_update">Send this update for all challenge
                            member</label>
                    </div>
                </div>

            </div>

        </div>

    </div><!-- .modal-body -->
    <div class="modal-footer bg-white">
        <ul class="btn-toolbar g-3">
            <li><a href="#" data-dismiss="modal" class="btn btn-outline-light btn-white">CANCEL</a></li>
            <li><button type="submit" class="btn btn-primary">Save</a></li>
        </ul>
    </div><!-- .modal-footer -->
</form>
<form action="{{route('dashboard.cohorts.update', $cohort)}}" method="POST" id="cohort-edit-form" enctype="multipart/form-data"
    data-form="ajax-form" data-datatable="#cohorts-table" data-modal="#ajax_model" >
    @csrf
    @method('PUT')
    <div class="modal-header align-center">
        <div class="nk-file-title">
            <div class="nk-file-icon">
                <span class="nk-file-icon-type">
                    <img src="{{ asset('images/dashboard/cohort-logo.png')}}" alt="">
                </span>
            </div>
            <div class="nk-file-name">
                <div class="nk-file-name-text"><span class="title">Edit Cohort</span></div>
            </div>
        </div>
        <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
    </div>
    <div class="modal-body p-0">
        
        <div class="form-grid">
            <div class="form-column">
                <div class="single-form-field">
                    <label><span>*</span> Cohort Name In English</label>
                    <input type="text" placeholder="Cohort name in English" name="name_en" value="{{$cohort->name_en}}" required>
                </div>
                <div class="single-form-field">
                    <label><span>*</span> Status</label>
                    <select name="status" id="status" required class="form-select form-control form-select-modal" data-search="on">
                        <option value="" selected="">Select status</option>
                        <option @if($cohort->status == 'ongoing') selected @endif value="ongoing">Ongoing</option>
                        <option @if($cohort->status == 'completed') selected @endif value="completed">Completed</option>
                    </select>
                   
                </div>
                <div class="single-form-field">
                    <label><span>*</span> Stage</label>
                    <select name="stage" id="stage" required class="form-select form-control form-select-modal" data-search="on">
                        <option value="" selected="">Select cohort stage</option>
                        @foreach ($stages as $stage)
                        <option @if($stage->id == $cohort->stage_id) selected @endif value="{{$stage->id}}">{{$stage->name_en}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="single-form-field">
                   
                    <div class="form-group">
                        <label><span>*</span> Start Date</label>
                        <div class="form-control-wrap">
                            <div class="form-icon form-icon-right datepicker-icon">
                                <em class="icon ni ni-calendar-alt"></em>
                            </div>
                            <input type="text" autocomplete="off" placeholder="Start date" name="start_date" value="{{$cohort->start_date}}" class=" datepicker" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-column">
                <div class="single-form-field">
                    <label><span>*</span> Cohort name in Arabic</label>
                    <input type="text" placeholder="Cohort name in Arabic" name="name_ar" value="{{$cohort->name_ar}}"required>
                </div>
                <div class="single-form-field">
                    <label><span>*</span> Cohort Type</label>
                    <select name="type" id="type" required class="form-select form-control form-select-modal" data-search="on">
                        <option value="" selected="">Select cohort type</option>
                        @foreach ($cohortTypes as $type)
                        <option @if($type->id == $cohort->cohort_type_id) selected @endif value="{{$type->id}}">{{$type->name_en}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="single-form-field">
                    <label> Lead Entity</label>
                    <select name="lead_entity" id="" class="form-select form-control form-select-modal" data-search="on">
                        <option value="" selected="">Select lead entity</option>
                        @foreach ($leadEntities as $leadEntity)
                        <option @if($leadEntity->id == $cohort->lead_entity_id) selected @endif value="{{$leadEntity->id}}">{{$leadEntity->name_en}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="single-form-field">
                    <div class="form-group">
                        <label><span>*</span> End Date</label>
                        <div class="form-control-wrap">
                            <div class="form-icon form-icon-right datepicker-icon">
                                <em class="icon ni ni-calendar-alt"></em>
                            </div>
                            <input type="text" autocomplete="off" placeholder="End date" name="end_date" value="{{$cohort->end_date}}" class=" datepicker" required>
                        </div>
                    </div>
                </div>
                <div class="single-form-field d-none">
                    <label>Status</label>
                    <div class="preview-block">
                        <div class="custom-control custom-switch checked">
                            <span>Active</span>
                            <input type="checkbox" class="custom-control-input" {{$cohort->is_active == 1 ? 'checked' : ''  }} id="customSwitch2" value="1" name="is_active">
                            <label class="custom-control-label" for="customSwitch2"></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div><!-- .modal-body -->
    <div class="modal-footer bg-white">
        <ul class="btn-toolbar g-3">
            <li><a href="#" data-dismiss="modal" class="btn btn-outline-light btn-white">Discard</a></li>
            <li><button href="#" type="submit" class="btn btn-primary">Update</button></li>
        </ul>
    </div><!-- .modal-footer -->
</form>
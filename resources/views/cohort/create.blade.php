<form action="{{route('dashboard.cohorts.store')}}" method="POST" id="cohort-form" enctype="multipart/form-data"
    data-form="ajax-form" data-datatable="#cohorts-table" data-modal="#ajax_model">
    @csrf
    <div class="modal-header align-center">
        <div class="nk-file-title">
            <div class="nk-file-icon">
                <span class="nk-file-icon-type">
                    <img src="{{ asset('images/dashboard/cohort-logo.png')}}" alt="">
                </span>
            </div>
            <div class="nk-file-name">
                <div class="nk-file-name-text"><span class="title">Add New Cohort</span></div>
            </div>
        </div>
        <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
    </div>
    <div class="modal-body p-0">
        
        <div class="form-grid">
            <div class="form-column">
                <div class="single-form-field">
                    <label><span>*</span> Cohort name in English</label>
                    <input type="text" placeholder="Cohort name in English" name="name_en" required>
                </div>
                <div class="single-form-field">
                    <label><span>*</span> Status</label>
                    <select name="status" id="status" required class="form-select form-control form-select-modal" data-search="on">
                        <option value="" selected="">Select status</option>
                        <option value="ongoing">Ongoing</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
                <div class="single-form-field">
                    <label><span>*</span> Stage</label>
                    <select name="stage" id="stage" required class="form-select form-control form-select-modal" data-search="on">
                        <option value="" selected="">Select cohort stage</option>
                        @foreach ($stages as $stage)
                        <option value="{{$stage->id}}">{{$stage->name_en}}</option>
                        @endforeach
                    </select>
                 
                </div>
                <div class="single-form-field">
                    <div class="form-group">
                        <label><span>*</span> Start date</label>
                        <div class="form-control-wrap">
                            <div class="form-icon form-icon-right datepicker-icon">
                                <em class="icon ni ni-calendar-alt"></em>
                            </div>
                            <input type="text" autocomplete="off" placeholder="Start date" name="start_date" class=" datepicker" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-column">
                <div class="single-form-field">
                    <label><span>*</span> Cohort name in Arabic</label>
                    <input type="text" placeholder="Cohort name in Arabic" name="name_ar" required>
                </div>
                <div class="single-form-field">
                    <label><span>*</span> Methodology</label>
                    
                    <select name="type" id="type" required class="form-select form-control form-select-modal" data-search="on">
                        <option value="" selected="">Select cohort methodology</option>
                        @foreach ($cohortTypes as $type)
                        <option value="{{$type->id}}">{{$type->name_en}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="single-form-field">
                    <label> Lead Entity</label>
                    <select name="lead_entity" id="" class="form-select form-control form-select-modal" data-search="on">
                        <option value="" selected="">Select lead entity</option>
                        @foreach ($leadEntities as $leadEntity)
                        <option value="{{$leadEntity->id}}">{{$leadEntity->name_en}}</option>
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
                            <input type="text" autocomplete="off" placeholder="End date" name="end_date" class=" datepicker" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div><!-- .modal-body -->
    <div class="modal-footer bg-white">
        <ul class="btn-toolbar g-3">
            <li><a href="#" data-dismiss="modal" class="btn btn-outline-light btn-white">Discard</a></li>
            <li><button href="#" type="submit" class="btn btn-primary">add</button></li>
        </ul>
    </div><!-- .modal-footer -->
</form>
<form action="{{route('dashboard.plans.store')}}" method="POST" id="plan-form" enctype="multipart/form-data"
    data-form="ajax-form-plans" data-datatable="#plans-table" data-modal="#ajax_model" >
    <div class="modal-header align-center">
        <div class="nk-file-title">
            <div class="nk-file-icon">
                <span class="nk-file-icon-type">
                    <img class="width-sm" src="{{ asset('images/dashboard/dot-icon1.png')}}" alt="">
                </span>
            </div>
            <div class="nk-file-name">
                <div class="nk-file-name-text"><span class="title">Add Plan</span></div>
            </div>
        </div>
        <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
    </div>
    <div class="modal-body p-0">
        
            @csrf    
            <input type="hidden" name="challenge" value="{{$challenge_id}}">
            <div class="form-grid">
                <div class="form-column">
                    <div class="single-form-field">
                        <label><span>*</span> Plan title in English</label>
                        <input type="text" placeholder="Plan title in English" name="title_en" required>
                    </div>
                
                    <div class="single-form-field">
                        <label>Parent Plan</label>
                        <select class="form-select-2 form-control form-select-modal" data-search="on" name="parent_id">
                            <option value="" selected="">Select parent plan</option>
                            @foreach ($plans as $plan)
                            <option value="{{$plan->id}}">{{$plan->title_en}}</option>
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
                    <div class="single-form-field">
                        <label><span>*</span> Status</label>
                        <select class="form-select-2 form-control form-select-modal" data-search="on" name="status" required>
                            <option value="" selected="">Select status</option>
                            <option value="In-progress">In-progress</option>
                            <option value="finished">Finished</option>
                        </select>
                    </div>
                </div>

                <div class="form-column">
                    <div class="single-form-field">
                        <label><span>*</span> Plan title In Arabic</label>
                        <input type="text" placeholder=" Plan title In Arabic" name="title_ar" required>
                    </div>
                    <div class="single-form-field">
                        <label><span>*</span> Priority</label>
                        <select class="form-select-2 form-control form-select-modal" data-search="on" name="priority" required>
                            <option value="" selected="">Select priority</option>
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="Urgent">Urgent</option>
                        </select>
                    </div>
                    <div class="single-form-field">
                        <div class="form-group">
                            <label><span>*</span> End date</label>
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
            <li><button data-dismiss="modal" class="btn btn-outline-light btn-white">CANCEL</button></li>
            <li><button type="submit" class="btn btn-primary">SAVE</button></li>
        </ul>
    </div><!-- .modal-footer -->
</form>
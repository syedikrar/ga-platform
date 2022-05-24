<form action="{{route('dashboard.cohort-types.store')}}" method="POST" id="cohort-type-form" enctype="multipart/form-data"
data-form="ajax-form"  data-datatable="#cohort-types" data-modal="#ajax_model">
    @csrf
    <div class="modal-header align-center">
        <div class="nk-file-title">
            <div class="nk-file-icon">
                <span class="nk-file-icon-type">
                    <img src="{{ asset('images/dashboard/cohort-logo.png')}}" alt="">
                </span>
            </div>
            <div class="nk-file-name">
                <div class="nk-file-name-text"><span class="title">Add New Methodology Type</span></div>
            </div>
        </div>
        <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
    </div>
    <div class="modal-body p-0">
       
    
        
            <div class="form-grid">
                <div class="form-column">
                    <div class="single-form-field">
                        <label><span>*</span> Cohort methodology name in English</label>
                        <input type="text" placeholder="Cohort methodology name in English" name="name_en" required>
                    </div>
                    <div class="single-form-field">
                        <label>Status</label>
                        <div class="preview-block">
                            <div class="custom-control custom-switch checked">
                                <span>Active</span>
                                <input type="checkbox" class="custom-control-input" checked="" value="active" id="statusChange" name="status">
                                <label class="custom-control-label" for="statusChange"></label>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <div class="form-column">
                    <div class="single-form-field">
                        <label><span>*</span> Cohort methodology name in Arabic</label>
                        <input type="text" placeholder="Cohort methodology name in Arabic" name="name_ar" required>
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
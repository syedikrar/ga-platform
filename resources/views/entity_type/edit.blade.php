<form action="{{route('dashboard.entity-types.update', $entityType->id)}}" method="POST" id="entity-type-edit-form" enctype="multipart/form-data"
    data-form="ajax-form"  data-datatable="#entity-types" data-modal="#ajax_model">
    @csrf
    @method('PUT')
    <div class="modal-header align-center">
        <div class="nk-file-title">
            <div class="nk-file-icon">
                <span class="nk-file-icon-type">
                    <img src="{{ asset('images/dashboard/entities-icon.png')}}" alt="">
                </span>
            </div>
            <div class="nk-file-name">
                <div class="nk-file-name-text"><span class="title">Edit Entity Type</span></div>
            </div>
        </div>
        <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
    </div>
    <div class="modal-body p-0">
        <div class="form-grid">
            <div class="form-column">
                <div class="single-form-field">
                    <label><span>*</span> Entity type name in English</label>
                    <input type="text" placeholder="Entity type name in English" name="name_en" required value="{{$entityType->name_en}}">
                </div>
                <div class="single-form-field">
                    <label>Sector</label><br>
                    <div class="custom-control custom-radio d-block"> 
                        <input type="radio" id="govt" name="sector" {{$entityType->sector =='Government' ? 'checked':'' }} class="custom-control-input" value="Government"> 
                        <label class="custom-control-label" for="govt">Government</label>
                    </div>
                    <div class="custom-control custom-radio d-block">   
                        <input type="radio" id="private" name="sector" {{$entityType->sector =='Private Sector' ? 'checked':'' }} class="custom-control-input" value="Private Sector"> 
                        <label class="custom-control-label" for="private">Private</label>
                    </div>
                </div>
            </div>
            <div class="form-column">
                <div class="single-form-field">
                    <label><span>*</span> Entity type name in Arabic</label>
                    <input type="text" placeholder="Entity type name in Arabic" name="name_ar" required value="{{$entityType->name_ar}}">
                </div>
                <div class="single-form-field">
                    <label>Status</label>
                    <div class="preview-block">
                        <div class="custom-control custom-switch checked">
                            <span>Active</span>
                            <input type="checkbox" class="custom-control-input" {{$entityType->status =='active' ? 'checked':'' }} value="active" id="statusChange" name="status">
                            <label class="custom-control-label" for="statusChange"></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .modal-body -->
    <div class="modal-footer bg-white">
        <ul class="btn-toolbar g-3">
            <li><a href="#" data-dismiss="modal" class="btn btn-outline-light btn-white">Discard</a></li>
            <li><button href="#" type="submit" class="btn btn-primary">update</button></li>
        </ul>
    </div><!-- .modal-footer -->
</form>   
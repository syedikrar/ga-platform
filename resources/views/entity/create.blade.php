<form action="{{route('dashboard.entities.store')}}" method="POST" id="entity-form" enctype="multipart/form-data"
data-form="ajax-form" data-datatable="#entities-table" data-modal="#ajax_model">
    @csrf
    <div class="modal-header align-center">
        <div class="nk-file-title">
            <div class="nk-file-icon">
                <span class="nk-file-icon-type">
                    <img src="{{ asset('images/dashboard/entities-icon.png')}}" alt="">
                </span>
            </div>
            <div class="nk-file-name">
                <div class="nk-file-name-text"><span class="title">Add New Entity</span></div>
            </div>
        </div>
        <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
    </div>
    <div class="modal-body p-0">
        <div class="modal-center-logo">
            <div class="modal-logo" >
                <img class="modalCompanyLgo" src="{{ asset('images/dashboard/placeholder-image.png')}}" alt="">
                <span><img class="cameraLogo" src="{{ asset('images/dashboard/modal-camera.png')}}" alt=""></span>
            </div>
            <input type="file" class="d-none logo" accept="image/x-png,image/jpeg"  name="logo" value="logo.png">
        </div>
    
        
            <div class="form-grid">
                <div class="form-column">
                    <div class="single-form-field">
                        <label><span>*</span> Entity name in English</label>
                        <input type="text" placeholder="Entity name in English" name="name_en" required>
                    </div>
                    <div class="single-form-field">
                        <label><span>*</span> Entity Short Name</label>
                        <input type="text" placeholder="Entity Short Name" name="short_name" required>
                    </div>
                    <div class="single-form-field">
                        <label>Entity Website</label>
                        <input type="text" placeholder="Entity Website" name="website">
                    </div>
                    <div class="single-form-field">
                        <label>Phone</label>
                        <div class="input-group"><div class="input-group-prepend"><span class="input-group-text">+971</span></div><input type="text" class="form-control" placeholder="XXXXXXXXX" name="phone"></div>
                    </div>
                    <div class="single-form-field">
                        <label>Entity address in English</label>
                        <input type="text" placeholder="Entity address in English" name="address_en">
                    </div>
                    <div class="single-form-field">
                        <label>Longitude</label>
                        <input type="text" placeholder="Longitude" id="longitude-popup" name="longitude" value="">
                    </div>
                    
                </div>

                <div class="form-column">
                    <div class="single-form-field">
                        <label><span>*</span> Entity address in Arabic</label>
                        <input type="text" placeholder="Entity address in Arabic" name="name_ar" required>
                    </div>
                    <div class="single-form-field">
                        <label><span>*</span> Entity Type</label>
                        <select name="type" id="type" required class="form-select form-control form-select-modal" data-search="on" >
                            <option value="" selected="">Select entity type</option>
                            @foreach ($entityTypes as $type)
                                <option value="{{$type->id}}">{{$type->name_en}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="single-form-field">
                        <label>Entity Email Address</label>
                        <input type="email" placeholder="entity@example.com" name="email" >
                    </div>
                  
                    <div class="single-form-field">
                        <label>Entity Address In Arabic</label>
                        <input type="text" placeholder="نموذج للعنوان " name="address_ar">
                    </div>
                    <div class="single-form-field">
                        <label>Latitude</label>
                        <input type="text" placeholder="Latitude" id="latitude-popup" name="latitude" value="">
                    </div>
                    <div class="single-form-field">
                        <label>Status</label>
                        <div class="preview-block">
                            <div class="custom-control custom-switch checked">
                                <span>Active</span>
                                <input type="checkbox" class="custom-control-input" checked="" value="true" id="statusChange" name="status">
                                <label class="custom-control-label" for="statusChange"></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="form-grid single-column">
                <div class="form-column"> 
                    <label class="form-label" for="name">Location</label>
                    <input style="width: 80%;"  type="text" id="searchInputPopup" name="location" class="form-control map-input mt-2 mr-2">
                    <div id="address-map-container" style="width:100%;height:300px; ">
                        <div style="width: 100%; height: 100%" id="map-popup"></div>
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
.modal{
    z-index: 1030;   
}
.modal-backdrop{
    z-index: 1020;        
}
</style>
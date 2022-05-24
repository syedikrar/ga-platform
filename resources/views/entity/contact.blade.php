<form action="{{route('dashboard.entity-contacts.update',$contact->uuid)}}" method="POST" id="entity-contact-form-edit" enctype="multipart/form-data"
data-form="ajax-form" data-datatable="#entity-contacts-table"  data-modal="#ajax_model">
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
            <div class="nk-file-name-text"><span class="title">Edit Contact</span></div>
        </div>
    </div>
    <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
</div>
<div class="modal-body p-0">
    <div class="modal-center-logo">
        <div class="modal-logo" id="modal-logo">
            @php 
            $contact->avatar ? $logo = asset('storage/'.$contact->avatar) : $logo = asset('images/dashboard/placeholder-image.png');
            @endphp
            <img class="modalCompanyLgo" id="modalAvatarEdit" src="{{ $logo}}" alt="">
            <span><img class="cameraLogo" src="{{ asset('images/dashboard/modal-camera.png')}}" alt=""></span>
        </div>
        <input type="file" class="d-none" id="avatar-edit" accept="image/x-png,image/jpeg"  name="avatar" value="logo.png">
    </div>
    <div class="form-grid">
        <div class="form-column">
            <div class="single-form-field">
                <label><span>*</span> Contact Name in English</label>
                <input type="text" placeholder="Contact Name in English" name="name_en" required value="{{$contact->name_en}}">
            </div>
            <div class="single-form-field">
                <label><span>*</span> Title</label>
                <select name="title" id="title" required class="form-select form-control form-select-modal" data-search="on" style="width: 100%">
                    <option value="0" disabled selected>Select Title</option>
                    <option value="Mr." @if($contact->title == "Mr.") selected @endif>Mr.</option>
                    <option value="Ms." @if($contact->title == "Ms.") selected @endif>Ms.</option>
                    <option value="Mrs." @if($contact->title == "Mrs.") selected @endif>Mrs.</option>
                </select>
            </div>
            <div class="single-form-field">
                <label>Contact designation in English</label>
                <input type="text" placeholder="Contact designation in English" name="designation_en"  value="{{$contact->designation_en}}">
            </div>
            <div class="single-form-field">
                <label>Phone</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">+971</span>
                    </div>
                    <input type="text" class="form-control" placeholder="XXXXXXXXX" name="phone"  value="{{substr($contact->phone_number, 4)}}">
                </div>
            </div>
        </div>
        <div class="form-column">
            <div class="single-form-field">
                <label><span>*</span> Contact name in Arabic</label>
                <input type="text" placeholder="Contact name in Arabic" name="name_ar" required  value="{{$contact->name_ar}}">
            </div>
            <div class="single-form-field">
                <label>Email address</label>
                <input type="email" placeholder="contact@example.com" name="email"  value="{{$contact->email}}">
            </div>
            <div class="single-form-field">
                <label>Contact designation in Arabic</label>
                <input type="text" placeholder="Contact designation in Arabic" name="designation_ar"  value="{{$contact->designation_ar}}">
            </div>
            <div class="single-form-field">
                <label>Mobile</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">+971</span>
                    </div>
                    <input type="text" class="form-control" placeholder="XXXXXXXXX" name="mobile"  value="{{substr($contact->mobile_number, 4)}}">
                </div>
            </div>
        </div>
    </div>
    <div  class="form-grid single-column mt-0">
        <div class="form-column">
            <div class="single-form-field mt-0">
                <label>Remarks</label>
                <input type="text" placeholder="Remarks" name="remarks"  value="{{$contact->remarks}}">
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
<div class="modal fade modalIntities" tabindex="-1" role="dialog" id="modal-contact" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form action="{{route('dashboard.entity-contacts.store')}}" method="POST" id="entity-contact-form" enctype="multipart/form-data" data-form="ajax-form" data-datatable="#entity-contacts-table" data-modal="#modal-contact" data-form-reset="true">
                @csrf

                <div class="modal-header align-center">
                    <div class="nk-file-title">
                        <div class="nk-file-icon">
                            <span class="nk-file-icon-type">
                                <img src="{{ asset('images/dashboard/entities-icon.png')}}" alt="">
                            </span>
                        </div>
                        <div class="nk-file-name">
                            <div class="nk-file-name-text"><span class="title">Add Contact</span></div>
                        </div>
                    </div>
                    <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                </div>
                <div class="modal-body p-0">
                    <div class="modal-center-logo">
                        <div class="modal-logo" id="modal-logo">
                            <img class="modalCompanyLgo" id="modalAvatar" src="{{ asset('images/dashboard/placeholder-image.png')}}" alt="">
                            <span><img class="cameraLogo" src="{{ asset('images/dashboard/modal-camera.png')}}" alt=""></span>
                        </div>
                        <input type="file" class="d-none" id="avatar" accept="image/x-png,image/jpeg" name="avatar" value="logo.png">
                    </div>
                    <input type="hidden" name="entity" value="{{$entity->uuid}}">

                    <div class="form-grid">
                        <div class="form-column">
                            <div class="single-form-field">
                                <label><span>*</span> Contact Name in English</label>
                                <input type="text" placeholder="Contact Name in English" name="name_en" required>
                            </div>
                            <div class="single-form-field">
                                <label><span>*</span> Title</label>
                                <select name="title" id="title" required class="form-select form-control form-select-modal" data-search="on" style="width: 100%">
                                    <option value="0" disabled selected>Select Title</option>
                                    <option value="Mr.">Mr.</option>
                                    <option value="Ms.">Ms.</option>
                                    <option value="Mrs.">Mrs.</option>

                                </select>
                            </div>
                            <div class="single-form-field">
                                <label>Contact designation in English</label>
                                <input type="text" placeholder="Contact designation in English" name="designation_en">
                            </div>
                            <div class="single-form-field">
                                <label>Phone</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">+971</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="XXXXXXXXX" name="phone">
                                </div>
                            </div>
                        </div>

                        <div class="form-column">
                            <div class="single-form-field">
                                <label><span>*</span> Contact name in Arabic</label>
                                <input type="text" placeholder="Contact name in Arabic" name="name_ar" required>
                            </div>
                            <div class="single-form-field">
                                <label>Email address</label>
                                <input type="email" placeholder="contact@example.com" name="email">
                            </div>
                            <div class="single-form-field">
                                <label>Contact designation in Arabic</label>
                                <input type="text" placeholder="Contact designation in Arabic" name="designation_ar">
                            </div>
                            <div class="single-form-field">
                                <label>Mobile</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">+971</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="XXXXXXXXX" name="mobile">
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="form-grid single-column mt-0">
                        <div class="form-column">
                            <div class="single-form-field mt-0">
                                <label>Remarks</label>
                                <input type="text" placeholder="Remarks" name="remarks">
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
        </div><!-- .modal-content -->
    </div><!-- .modla-dialog -->
</div>
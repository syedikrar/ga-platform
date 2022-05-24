<div class="tab-area">
    <div class="tab-section">
        <div class="card card-preview">
            <div class="card-inner">

                <div class="row">
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs mt-n3">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabItem-bacicDetails">SUMMARY</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabItem-members">RISKS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabItem-leader">MEMBERS</a>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="bacicDetails">
                        <div class="global-bg-white">
                            <!------------------add work streams modal ----------------->

                            <form method="POST" action="{{ route('dashboard.workstreams.store') }}" id="entity-contact-form" enctype="multipart/form-data" data-form="ajax-form" data-datatable="#entity-contacts-table" data-modal="#ajax_model" data-form-reset="true">
                                @csrf
                                <div id="">
                                    <div class="container">
                                        <div class="row p-2 border-bottom">
                                            <div class="col-sm-12 pt-1">
                                                <div class="nk-file-name">
                                                    <div class="nk-file-name"><span class="title"><img src="{{ asset('images/dashboard/dot-icon1.png')}}" alt="" class="mr-2" width="6%"> ADD New WorkStream</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body p-3">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="single-form-field single-form-row">
                                                    <label><span>*</span> Name In English</label>
                                                    <input type="text" placeholder="Name In English" name="name_en" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="single-form-field single-form-row">
                                                    <label><span>*</span> Name In Arabic</label>
                                                    <input type="text" placeholder="Name In Arabic" name="name_ar" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="single-form-field single-form-row">
                                                    <label><span>*</span> Description English</label>
                                                    <div class="input-group">
                                                        <textarea name="description_en" class="form-control form-control-sm" rows="3"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="single-form-field single-form-row">
                                                    <label><span>*</span> Description Arabic</label>
                                                    <textarea name="description_ar" class="form-control form-control-sm" rows="3"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div><!-- .modal-body -->
                                    <div class="modal-footer bg-white">
                                        <ul class="btn-toolbar g-3">
                                            <li><a href="#" data-dismiss="modal" class="btn btn-outline-light btn-white">CANCEL</a></li>
                                            <li><button href="#" type="submit" class="btn btn-save">SAVE</button></li>
                                        </ul>
                                    </div><!-- .modal-footer -->
                                </div>
                            </form>



                        </div>
                    </div>


                    <div class="tab-pane" id="tabItem-members">
                        <div class="global-bg-white">
                            <div class="row gy-4">
                                <div class="col-sm-12">
                                    <div class="table-searchbar">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-left">
                                                    <em class="icon ni ni-search"></em>
                                                </div>
                                                <input type="text" class="form-control" id="searchBar" placeholder="Search">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="container">
                                        <div class="row gy-4">
                                            <div class="col-sm-4">
                                                <div class="user-card">
                                                    <div class="user-avatar">
                                                        <img src="{{ asset('images/dashboard/author-img.png')}}" alt="">
                                                    </div>
                                                    <div class="user-info">
                                                        <a href=""><span>User Name</span></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">Entity</div>
                                            <div class="col-sm-4">
                                                <div class="custom-control">
                                                    <input type="checkbox" name="members[]" class="custom-control" value="">
                                                    <!-- <label class="custom-control-label" for="existing_user_form"></label> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!---------- members tab ------->

                    <div class="tab-pane" id="tabItem-leader">
                        <div class="global-bg-white container px-5">
                            <div class="row">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Example select</label>
                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!------- end of members tab ---->
                </div>
            </div>
        </div><!-- .card-preview -->
    </div>
</div>
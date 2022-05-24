<form action="{{route('dashboard.challenges.store')}}" method="POST"
    data-form="ajax-form" data-datatable="#challenges-table" data-modal="#ajax_model">
    @csrf
    <div class="modal-header align-center">
        <div class="nk-file-title">
            <div class="nk-file-icon">
                <span class="nk-file-icon-type">
                    <img class="width-sm" src="{{ asset('images/dashboard/dot-icon1.png')}}" alt="">
                </span>
            </div>
            <div class="nk-file-name">
                <div class="nk-file-name-text"><span class="title">Add New Challenge</span></div>
            </div>
        </div>
    </div>
   
    <div class="modal-body p-4">

        <div class="row">
            <div class="col-md-6">
                <div class="single-form-field single-form-row">
                    <label><span>*</span> Challenge name in English</label>
                    <input type="text" name="name_en" placeholder="Challenge name in English" value="" required> 
                </div>
            </div>
            <div class="col-md-6">
               <div class="single-form-field single-form-row">
                    <label><span>*</span> Challenge Name In Arabic</label>
                    <input type="text" placeholder="Challenge name in Arabic" name="name_ar" value="" required>
                </div>
            </div>
            <div class="col-md-6">
               <div class="single-form-field single-form-row">
                    <label><span>*</span> Description In English</label>
                    <input type="text" placeholder="Description in English" name="description_en" value="" required>
                </div>
            </div>
            <div class="col-md-6">
               <div class="single-form-field single-form-row">
                    <label><span>*</span> Description In Arabic</label>
                    <input type="text" placeholder="Description in Arabic" name="description_ar" value="" required>
                </div>
            </div>
             <div class="col-md-12">
               <div class="single-form-field single-form-row">
                    <label>Baseline</label>
                    <input type="text" placeholder="Baseline" name="baseline" value="" required>
                </div>
            </div>
            <div class="col-md-6">
               <div class="single-form-field single-form-row">
                    <label><span>*</span> Lead Enitity</label>
                    <select name="lead_entity" id="" required class="form-select form-control form-select-modal" data-search="on">
                        <option value="" selected="">Select lead entity</option>
                        @foreach ($leadEntities as $leadEntity)
                        <option value="{{$leadEntity->id}}">{{$leadEntity->name_en}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
               <div class="single-form-field single-form-row">
                    <label><span>*</span> Cohort</label>
                    <select name="cohort" id="" class="form-select form-control form-select-modal" data-search="on">
                        <option value="" selected="">Select cohort</option>
                        @foreach ($cohorts as $cohort)
                        <option value="{{$cohort->id}}">{{$cohort->name_en}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
               <div class="single-form-field single-form-row">
                    <label>Sidebar icon (130 x 130 px)</label>

                    <div class="row">
                        <div class="col-md-3">
                            <img src="/images/dashboard/food-safety.png">
                        </div>
                        <div class="col-md-9">
                            <div class="custom-file mt-1">
                                <input type="file" class="custom-file-input" id="customFile2" name="sidebar_icon">
                                <label class="custom-file-label" for="customFile">Choose icon</label>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
               <div class="single-form-field single-form-row">
                    <label>Thumbnail icon (130 x 130 px)</label>

                    <div class="row">
                        <div class="col-md-3">
                            <img src="/images/dashboard/food-safety-filled.png">
                        </div>
                        <div class="col-md-9">
                            <div class="custom-file mt-1">
                                <input type="file" class="custom-file-input" id="customFile2" name="thumbnail_icon">
                                <label class="custom-file-label" for="customFile">Choose icon</label>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div><!-- .modal-body -->
    <div class="modal-footer bg-white">
        <ul class="btn-toolbar g-3">
            <li><a href="#" data-dismiss="modal" class="btn btn-outline-light btn-white">CANCEL</a></li>
            <li><button type="submit" class="btn btn-primary">ADD</a></li>
        </ul>
    </div><!-- .modal-footer -->
</form>
<form action="{{route('dashboard.challenges.update', $challenge)}}" method="POST"
    data-form="ajax-form" data-datatable="#challenges-table" data-modal="#ajax_model">
    @csrf
    @method('PUT')
    <div class="modal-header align-center">
        <div class="nk-file-title">
            <div class="nk-file-icon">
                <span class="nk-file-icon-type">
                    <img class="width-sm" src="{{ asset('images/dashboard/dot-icon1.png')}}" alt="">
                </span>
            </div>
            <div class="nk-file-name">
                <div class="nk-file-name-text"><span class="title">Edit Challenge</span></div>
            </div>
        </div>
    </div>
   
    <div class="modal-body p-0">
        <div class="form-grid">
            <div class="form-column">
                <div class="single-form-field">
                    <label><span>*</span> Challenge name in English</label>
                    <input type="text" name="name_en" placeholder="" value="{{$challenge->name_en}}" required> 
                </div>
                <div class="single-form-field">
                    <label><span>*</span> Description In English</label>
                    <input type="text" placeholder="" name="description_en" value="{{$challenge->description_en}}" required>
                </div>
                <div class="single-form-field">
                    <label>Baseline</label>
                    <input type="text" placeholder="Baseline" name="baseline" value="{{$challenge->baseline}}" required>
                </div>
                <div class="single-form-field">
                    <label><span>*</span> Lead Enitity</label>
                    <select name="lead_entity" id="" required class="form-select form-control form-select-modal" data-search="on">
                        <option value="" selected="">Select lead entity</option>
                        @foreach ($leadEntities as $leadEntity)
                        <option @if($leadEntity->id == $challenge->lead_entity_id) selected @endif value="{{$leadEntity->id}}">{{$leadEntity->name_en}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-column">
                <div class="single-form-field">
                    <label><span>*</span> Challenge Name In Arabic</label>
                    <input type="text" placeholder="" name="name_ar" value="{{$challenge->name_ar}}" required>
                </div>
                <div class="single-form-field">
                    <label><span>*</span> Description In Arabic</label>
                    <input type="text" placeholder="" name="description_ar" value="{{$challenge->description_ar}}" required>
                </div>
                <div class="single-form-field">
                    <label>Goal</label>
                    <input type="text" placeholder="Goal" name="goal" value="{{$challenge->goal}}" required>
                </div>
                <div class="single-form-field">
                    <label>Cohort</label>
                    <select name="cohort" id="" class="form-select form-control form-select-modal" data-search="on">
                        <option value="" selected="">Select cohort</option>
                        @foreach ($cohorts as $cohort)
                        <option @if($cohort->id == $challenge->cohort_id) selected @endif value="{{$cohort->id}}">{{$cohort->name_en}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        
    </div><!-- .modal-body -->
    <div class="modal-footer bg-white">
        <ul class="btn-toolbar g-3">
            <li><a href="#" data-dismiss="modal" class="btn btn-outline-light btn-white">CANCEL</a></li>
            <li><button type="submit" class="btn bg-green btn-round text-white">SAVE</a></li>
        </ul>
    </div><!-- .modal-footer -->
</form>
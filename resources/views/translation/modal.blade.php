@php
    $isEdit = isset($translation) ? true : false;
    $url = $isEdit ? route('dashboard.translations.update', $translation->id) : route('dashboard.translations.store');
@endphp

<form action="{{ $url }}" method="POST" id="translation-form" enctype="multipart/form-data"
    data-form="ajax-form" data-datatable="#translations-table" data-modal="#ajax_model">
    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif
    
    <div class="modal-header align-center">
        <div class="nk-file-title">
            <div class="nk-file-icon">
                <span class="nk-file-icon-type">
                    <img src="{{ asset('images/dashboard/cohort-logo.png')}}" alt="">
                </span>
            </div>
            <div class="nk-file-name">
                <div class="nk-file-name-text"><span class="title">TRANSALTION</span></div>
            </div>
        </div>
        <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
    </div>
    <div class="modal-body p-0">
        
        <div class="form-grid">
            <div class="form-column">
 
                <div class="single-form-field">
                    <label><span>*</span> Group</label>
                    <input type="text" placeholder="Enter Group" name="group" value="{{ $isEdit ? $translation->group : '' }}" required @if ($isEdit) disabled @endif>
                </div>

                <div class="single-form-field">
                    <label><span>*</span> ENGLISH</label>
                    <input type="text" placeholder="Enter english translation" name="english" value="{{ $isEdit ? $translation->text['en'] : '' }}" required>
                </div>
            </div>

            <div class="form-column">
                <div class="single-form-field">
                    <label><span>*</span> Key</label>
                    <input type="text" placeholder="Enter Key" name="key" value="{{ $isEdit ? $translation->key : '' }}" required @if ($isEdit) disabled @endif>
                </div>
                <div class="single-form-field">
                    <label><span>*</span> Arabic</label>
                    <input type="text" placeholder="Enter arabic translation" name="arabic" value="{{ $isEdit ? $translation->text['ar'] : '' }}" required>
                </div>
                
               
            </div>
        </div>
        
    </div><!-- .modal-body -->
    <div class="modal-footer bg-white">
        <ul class="btn-toolbar g-3">
            <li><a href="#" data-dismiss="modal" class="btn btn-outline-light btn-white">Discard</a></li>
            <li><button href="#" type="submit" class="btn btn-primary">Save</button></li>
        </ul>
    </div><!-- .modal-footer -->
</form>
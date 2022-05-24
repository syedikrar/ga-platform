<form method="POST" action="{{ route('dashboard.user.update', $user->id) }}" id="entities_table" enctype="multipart/form-data"
 data-form="ajax-form" data-datatable="#entities_table" data-modal="#ajax_model" data-form-reset="true">
    @csrf
    @method('PUT')
    <div id="model-target">
        <div class="modal-header align-center">
            <div class="nk-file-title">
                <div class="nk-file-icon">
                    <span class="fa-icon"> <i class="fa-solid fa-pen-to-square"></i></span><span>Edit: {{ $user->name_en }}</span>
                </div>
            </div>
        </div>
        <div class="modal-body p-4">
            <div class="row">
                <div class="col-sm-6">
                    <div class="single-form-field single-form-row">
                        <label><span>*</span> Name In English</label>
                        <input type="text" placeholder="Name In English" name="name_en" value="{{ $user->name_en }}" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="single-form-field single-form-row">
                        <label><span>*</span> Name In Arabic</label>
                        <input type="text" placeholder="Name In Arabic" name="name_ar" value="{{ $user->name_ar }}" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="single-form-field single-form-row">
                        <label><span>*</span> Phone</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">+971</span></div><input type="text" class="form-control" placeholder="XXXXXXXXX" name="phone" value="{{ $user->phone }}">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="single-form-field single-form-row">
                        <label><span>*</span> Email</label>
                        <input type="text" placeholder="Email" name="email" value="{{ $user->email }}" required>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="single-form-field single-form-row">
                        <label><span>*</span> Entity</label>
                        <select class="form-select-2 form-control form-select-modal" data-search="on" name="entity" id="inputGroupSelect01">
                            <option value="{{ $user->entity ? $user->entity->id : ''}}" selected>{{ $user->entity ? $user->entity->name_en : '' }}</option>
                            @foreach($entities as $entity)
                            <option value="{{ $entity->id }}">{{ $entity->name_en }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
            </div>

        </div><!-- .modal-body -->
        <div class="modal-footer bg-white">
            <ul class="btn-toolbar g-3">
                <li><a href="#" data-dismiss="modal" class="btn btn-outline-light btn-white">CANCEL</a></li>
                <li><button href="#" type="submit" class="btn btn-save btn-primary">SAVE</button></li>
            </ul>
        </div><!-- .modal-footer -->
    </div>
</form>
<script>
</script>


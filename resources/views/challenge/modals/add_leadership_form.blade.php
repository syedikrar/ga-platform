<form method="POST" action="{{ route('dashboard.user.store') }}" id="entity-contact-form" enctype="multipart/form-data"
 data-form="ajax-form" data-datatable="#challenges-table" data-modal="#ajax_model" data-form-reset="true">
    @csrf
    <input type="hidden" name="role" value="leadership">
    <div id="model-target">
        <div class="modal-header align-center">
            <div class="nk-file-title">
                <div class="nk-file-icon">
                    <span class="nk-file-icon-type">
                        <img src="{{ asset('images/dashboard/dot-icon1.png')}}" alt="" class="mr-2">
                    </span>
                </div>
                <div class="nk-file-name">
                    <div class="nk-file-name-text"><span class="title">Add Leadership</span></div>
                </div>
            </div>
            <div class="nk-file-name #team-member text-right">
                <div class="nk-file-name-text pr-0">
                    <span class="">A lot of users?</span>
                    <span class="title ml-2">
                        <div class="export-btn">
                            <a href="#" class="btn btn-round btn-primary"><em class="icon ni ni-upload"></em><span>Upload Bulk Users</span> </a>
                        </div>
                    </span>
                </div>
            </div>
        </div>
        <div class="modal-body p-4">
            <div class="row mb-4">
                <div class="col-sm-12">
                    <div class="custom-control custom-switch custom-control-sm">
                        <input type="hidden" name="challenge_id" value="{{ $challenge->id }}">
                        <input type="checkbox" onchange="get_modal();" class="custom-control-input sm" id="customSwitch111">
                        <label class="custom-control-label" for="customSwitch111">Existing Users?</label>
                    </div>
                </div>
            </div>
            
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
                        <label><span>*</span> Phone</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">+971</span></div><input type="text" class="form-control" placeholder="XXXXXXXXX" name="phone">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="single-form-field single-form-row">
                        <label><span>*</span> Email</label>
                        <input type="text" placeholder="Email" name="email" required>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="single-form-field single-form-row">
                        <label><span>*</span> Entity</label>
                        <select class="form-select-2 form-control form-select-modal" data-search="on" name="entity" id="inputGroupSelect01">
                            <option selected>Select Entity</option>
                            @forelse($entities as $entity)
                            <option value="{{ $entity->id }}">{{ $entity->name_en }}</option>
                            @empty
                            <option value="">No entity found</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 mb-3">
                    <div class="custom-control custom-switch custom-control-sm">
                        <input type="checkbox" name="send_email" class="custom-control-input" id="customSwitch11" value="send_email">
                        <label class="custom-control-label" for="customSwitch11">Send Email</label>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="custom-control custom-switch custom-control-sm">
                        <input type="checkbox" class="custom-control-input" id="customSwitch2">
                        <label class="custom-control-label" for="customSwitch2">Send SMS</label>
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
    $(document).ready(function() {
        $('.form-select-2').select2();
    })

    function get_modal() {
        var challenge = {!! json_encode($challenge, JSON_HEX_TAG) !!};
        var role = 'leadership';
        $.ajax({
            url: "/dashboard/challenge/get_existing_user_form"+"/"+challenge.id+"/"+role,
            success: function(data) {
                $('#ajax_model_content').html(data);
            }
        });
    }
</script>

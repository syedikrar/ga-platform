<!----------------------- existing user addition in challenge and invitation of email -------->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<form action="{{route('dashboard.challenge.add_user')}}" method="POST" id="entity-contact-form" enctype="multipart/form-data" 
data-form="ajax-form" data-datatable="#challenges-table" data-modal="#ajax_model" data-form-reset="true">
    @csrf
    <input type="hidden" name="role" value="{{$role}}">
    <div id="model-target">
    <div class="modal-header align-center">
            <div class="nk-file-title">
                <div class="nk-file-icon">
                    <span class="nk-file-icon-type">
                        <img src="{{ asset('images/dashboard/dot-icon1.png')}}" alt="" class="mr-2">
                    </span>
                </div>
                <div class="nk-file-name">
                <div class="nk-file-name-text"><span class="title">Add {{ $role }}</span></div>
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
                    <input type="checkbox" onchange="get_challenge_modal();" class="custom-control-input" id="existing_user_form" checked>
                    <label class="custom-control-label" for="existing_user_form">Existing Users?</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="single-form-field single-form-row">
                    <label><span>*</span> Users</label>
                    <select class="select-user" name="users[]" multiple="multiple">
                        @forelse($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name_en }}</option>
                        @empty
                        <option value="">No User found</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="custom-control custom-switch custom-control-sm">
                    <input type="checkbox" name="send_email" class="custom-control-input" id="customSwitch11" value="send_email">
                    <label class="custom-control-label" for="customSwitch11">Send Email</label>
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
        $('.select-user').select2();
    });
</script>
<script type="text/javascript">
    function get_challenge_modal() {
        var challenge = {!! json_encode($challenge, JSON_HEX_TAG) !!};
        var x = document.getElementById("existing_user_form").value;
        
        if (!document.getElementById('existing_user_form').checked) {
            $.ajax({
                url: "/dashboard/challenge/add_team_member_form"+"/"+challenge.id,
                success: function(data) {
                    $('#ajax_model_content').html(data);
                }
            });
        }
    }
</script>
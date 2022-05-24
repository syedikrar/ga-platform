<form action="{{route('dashboard.challenge-entities.store')}}" method="POST" id="entity-form" enctype="multipart/form-data" data-form="ajax-form"
    data-datatable="#entities_table" data-modal="#ajax_model">
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
    <div class="modal-body p-4">
        <div class="row">
            <div class="col-sm-12">
                <div class="single-form-field my-2">
                    <div class="preview-block">
                        <div class="custom-control custom-switch checked" style="padding-left: 160px">
                            <span>Existing Entity ? </span>
                            <input type="checkbox" readonly class="custom-control-input" value="true"
                                id="exixting_entity" name="is_existing">
                            <label class="custom-control-label" for="exixting_entity"></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-none" id="all_entities">
            <div class="col-sm-12">
                <div class="single-form-field single-form-row ">
                    <label><span>*</span> Entities</label>
                    
                    <select class="select-entity" name="entities[]" multiple="multiple">

                        @forelse($entities as $entity)
                            @if($entity->id != $challenge->lead_entity_id )
                                <option    value="{{ $entity->id }}" {{in_array($entity->id,
                                $challenge->secondary_entities()->pluck('entity_id')->toArray()) ? 'selected' : ''}}>{{ $entity->name_en }}</option>
                            @endif  
                        @empty
                        <option value="">No Entity found</option>
                        @endforelse
                    </select>
                </div>
            </div>
        </div>
        <input type="hidden" name="challenge_id" value="{{$challenge->id}}"/>
        <div class="row" id="single_entity">
            <div class="col-sm-12">
                <div class="modal-center-logo">
                    <div class="modal-logo">
                        <img class="modalCompanyLgo" src="{{ asset('images/dashboard/placeholder-image.png')}}" alt="">
                        <span><img class="cameraLogo" src="{{ asset('images/dashboard/modal-camera.png')}}" alt=""></span>
                    </div>
                    <input type="file" class="d-none logo" accept="image/x-png,image/jpeg" name="logo" value="logo.png">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="single-form-field my-2">
                    <label><span>*</span> Entity name in English</label>
                    <input type="text" placeholder="Entity name in English" name="name_en" >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="single-form-field my-2">
                    <label>Entity Name in Arabic</label>
                    <input type="text" placeholder="Entity Name in Arabic" name="name_ar">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="single-form-field my-2">
                    <label><span>*</span> Entity Short Name</label>
                    <input type="text" placeholder="Entity Short Name" name="short_name" >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="single-form-field my-2">
                    <label><span>*</span> Entity Type</label>
                    <select name="type" id="type"  class="form-select form-control form-select-modal"
                        data-search="on">
                        <option value="" selected="">Select entity type</option>
                        @foreach ($entityTypes as $type)
                        <option value="{{$type->id}}">{{$type->name_en}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="single-form-field my-2">
                    <label>Entity Website</label>
                    <input type="text" placeholder="Entity Website" name="website">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="single-form-field my-2">
                    <label>Entity Email Address</label>
                    <input type="email" placeholder="entity@example.com" name="email">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="single-form-field my-2">
                    <label>Phone</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">+971</span></div><input
                            type="text" class="form-control" placeholder="XXXXXXXXX" name="phone">
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="single-form-field my-2">
                    <label><span>*</span> Entity address in English</label>
                    <input type="text" placeholder="Entity address in English" name="address_en" >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="single-form-field my-2">
                    <label>Entity Address In Arabic</label>
                    <input type="text" placeholder="نموذج للعنوان " name="address_ar">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="single-form-field my-2">
                    <label>Longitude</label>
                    <input type="text" placeholder="Longitude" readonly id="longitude-popup" name="longitude" value="">
                </div>
            </div>
            <div class="col-sm-6 ">
                <div class="single-form-field my-2">
                    <label>Latitude</label>
                    <input type="text" placeholder="Latitude" readonly id="latitude-popup" name="latitude" value="">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="single-form-field my-2">
                    <label>Status</label>
                    <div class="preview-block">
                        <div class="custom-control custom-switch checked">
                            <span>Active</span>
                            <input type="checkbox" class="custom-control-input" checked="" value="true"
                                id="statusChange" name="status">
                            <label class="custom-control-label" for="statusChange"></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 mb-2">
                <label class="form-label" for="name">Location</label>
                <input style="width: 80%;"  type="text" id="searchInputPopup" name="location" class="form-control map-input mt-2 mr-2">
                <div id="address-map-container" style="width:100%;height:300px; ">
                    <div style="width: 100%; height: 100%" id="map-popup"></div>
                </div>
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

    .modal {
        z-index: 1030;
    }

    .modal-backdrop {
        z-index: 1020;
    }
</style>
<script>
    $(document).ready(function() {
        $('.select-entity').select2();
        initMap('map-popup','searchInputPopup', 'latitude-popup', 'longitude-popup', false,'',0,0)

    });
</script>
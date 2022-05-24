<form action="{{route('dashboard.entities.update', $entity->id)}}" method="POST" enctype="multipart/form-data" data-form="ajax-form" data-reload="true">
    @csrf
    @method('PUT')
    <div class="modal-body p-0">
        <div class="intitiesDetail-top intitiesDetail-top-3-cols">
            <div class="modal-center-logo">
                <div class="modal-logo">
                    @php
                    $entity->logo ? $logo = asset('storage/'.$entity->logo) : $logo = asset('images/dashboard/placeholder-image.png');
                    @endphp
                    <span class="flex"><img class="modalCompanyLgo" src="{{$logo}}" alt=""></span>
                    <span><img class="cameraLogo" src="{{ asset('images/dashboard/modal-camera.png')}}" alt=""></span>
                    <b>Change logo</b>
                </div>
                <input type="file" name="logo" accept="image/x-png,image/jpeg" class="d-none logo">
            </div>
            <div class="title">
                {{$entity->name_en}}
            </div>
            <div class="delete-update-btn">
                <a href="javascript:void(0)" class="btn btn-round btn-delete delete" data-url="{{route('dashboard.entities.destroy', $entity->id) }}" data-table="entities-table" data-redirect="{{route('dashboard.entities.index')}}"><em class="icon ni ni-trash"></em><span>DELETE</span> </a>
                <button type="submit" class="btn btn-round btn-update"><em class="icon ni ni-update"></em><span>UPDATE</span> </button>
            </div>
        </div>
        <div class="form-grid">
            <div class="form-column">
                <div class="single-form-field">
                    <label><span>*</span> Entity name in English</label>
                    <input type="text" placeholder="ENTITY NAME IN ENGLISH" name="name_en" value="{{$entity->name_en}}" required>
                </div>
                <div class="single-form-field">
                    <label><span>*</span> Entity short name</label>
                    <input type="text" placeholder="ENTITY SHORT NAME" name="short_name" value="{{$entity->short_name}}" required>
                </div>
                <div class="single-form-field">
                    <label>Entity website</label>
                    <input type="text" placeholder="www.website.com" name="website" value="{{$entity->website}}">
                </div>
                <div class="single-form-field">
                    <label>Phone</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">+971</span>
                        </div>
                        <input type="text" class="form-control" placeholder="XXXXXXXXX" name="phone" value="{{substr($entity->phone, 4)}}">
                    </div>
                </div>
                <div class="single-form-field">
                    <label>Entity address in English</label>
                    <input type="text" placeholder="ENTITY ADDRESS IN ENGLISH" name="address_en" value="{{$entity->address_en}}">
                </div>

                <div class="single-form-field">
                    <label>Longitude</label>
                    <input type="text" placeholder="Longitude" id="longitude" name="longitude" value="{{$entity->longitude}}">
                </div>
            </div>
            <div class="form-column">
                <div class="single-form-field">
                    <label><span>*</span> Entity name in Arabic</label>
                    <input type="text" placeholder="ENTITY NAME IN ARABIC" name="name_ar" value="{{$entity->name_ar}}" required>
                </div>
                <div class="single-form-field">
                    <label><span>*</span> Entity Type</label>
                    <select name="type" id="type" class="form-control form-select form-select-modal" data-search="on">
                        <option value="" selected="">Select entity type</option>
                        @foreach ($entityTypes as $type)
                        <option @if($entity->entity_type_id == $type->id) selected @endif value="{{$type->id}}">{{$type->name_en}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="single-form-field">
                    <label>Entity email address</label>
                    <input type="email" placeholder="entity@example.com" name="email" value="{{$entity->email}}">
                </div>
                <div class="single-form-field">
                    <label>Entity address in Arabic</label>
                    <input type="text" placeholder="Entity address in Arabic" name="address_ar" value="{{$entity->address_ar}}">
                </div>
                <div class="single-form-field">
                    <label>Latitude</label>
                    <input type="text" placeholder="Latitude" id="latitude" name="latitude" value="{{$entity->latitude}}">
                </div>
                <div class="single-form-field">
                    <label>Status</label>
                    <div class="preview-block">
                        <div class="custom-control custom-switch checked">
                            <span>Active</span>
                            <input type="checkbox" class="custom-control-input" {{$entity->status =='active' ? 'checked':'' }} id="customSwitch2" value="active" name="status">
                            <label class="custom-control-label" for="customSwitch2"></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-grid single-column">
            <div class="form-column">
                <label class="form-label" for="name">Location</label>
                <input style="width: 80%;" type="text" id="searchInput" name="location" class="form-control map-input mt-2 mr-2">
                <div id="address-map-container" style="width:100%;height:300px; ">
                    <div style="width: 100%; height: 100%" id="map"></div>
                </div>
            </div>
        </div>
    </div>
</form>
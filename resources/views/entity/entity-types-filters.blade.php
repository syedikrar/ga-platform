@foreach ($entityTypes as $type)
<div class="nk-notification-item dropdown-inner">
    <input id="{{$type->id}}" type="checkbox" name="filter-type[]" class="filter-type" value="{{$type->id}}" data-name=" {{$type->name_en}}">
    <div class="nk-notification-content">
        <div class="nk-notification-text">
            <span>
                <label for="{{$type->id}}">
                {{$type->name_en}} (@if(isset($type->entities)) {{count($type->entities)}} @else 0 @endif)
                </label>
            </span>
        </div>
    </div>
</div>
@endforeach 
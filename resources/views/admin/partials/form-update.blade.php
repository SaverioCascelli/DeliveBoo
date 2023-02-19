<form action="{{route('admin.toggleavailable', $entity->id)}}" method="GET" class="form" data="{{$entity->id}}">
    @csrf
    <div class="form-check form-switch">
        <input class="input-update form-check-input" type="checkbox" role="switch" data="{{$entity->id}}"
        @if ($entity->is_available == 1)
            checked
        @endif
        >
        <label class="form-check-label" for="isAvailable">ON</label>
    </div>
</form>





<form action="{{route('admin.foods.index', $entity)}}" method="POST" id="formUpdate" data="{{$entity->id}}" class="form">
    @csrf
    @method('PUT')
    <div class="form-check form-switch">
        <input class="input-update form-check-input" type="checkbox" role="switch" data="{{$entity->id}}"
        @if ($entity->is_available == 1)
            checked
        @endif
        >
        <label class="form-check-label" for="isAvailable">ON</label>
    </div>
</form>

<script>



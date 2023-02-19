<form action="{{route('admin.foods.index', $entity)}}" method="POST" id="formUpdate" data="{{$entity->id}}">
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

    // const formUpdateArray = document.querySelectorAll('form[data]');
    // const isAvailableArray = document.querySelectorAll('input[data]');
    const imageFood = document.getElementById('imageFood');

    console.log()

    // isAvailable.addEventListener('click', function(){
    //     formUpdate.submit();

    //     if(imageFood.classList.contains('food-not-available')){
    //         imageFood.classList.remove('food-not-available');
    //         console.log('contiene');
    //     } else {
    //         imageFood.classList.add('food-not-available');
    //         console.log('non-contiene');
    //     }
    // })

</script>


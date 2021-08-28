<div id="flash-message" class="absolute -top-52 left-1/2 transform -translate-x-1/2 transition duration-500 rounded-md shadow-md border mb-4 p-3 bg-white flex items-center gap-1">
    @if($message = Session::get('success'))
        <x-icons.check-circular class="h-5 w-5 text-green-600"></x-icons.check-circular>
        {{ $message }}
    @elseif($message = Session::get('error'))
        <x-icons.cross-circular class="h-5 w-5 text-red-600"></x-icons.cross-circular>
        {{ $message }}
    @endif
</div>


<script>
    let flashMessage = document.querySelector('#flash-message');
    flashMessage.classList.add('translate-y-28');
    setTimeout(function(){
        flashMessage.classList.remove('translate-y-28');
    }, 3000);
</script>


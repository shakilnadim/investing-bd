@if($message = Session::get('success'))
    <div class="bg-green-200 rounded-md text-green-900 mb-4 p-3">
        {{ $message }}
    </div>
@endif


@props(['list'])
<div>
    @foreach($list as $item)
        {{ $item }}
        <br>
        <br>
    @endforeach
</div>

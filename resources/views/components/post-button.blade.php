<form action="{{ $url }}" method="POST" style="display:block;">
    @csrf
    <button type="submit" class="{{ $class }}">
        {{ $slot }}
        {{ $label }}
    </button>
</form>

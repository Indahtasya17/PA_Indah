@props([
    'for' => '',
    'required' => false
])

<label for="{{ $for }}" class="form-label">
    {{ $slot }}
    @if ($required)
        <span class="text-danger font-weight-bold"> *</span>
    @endif
</label>

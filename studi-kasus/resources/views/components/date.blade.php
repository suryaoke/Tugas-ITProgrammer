@props([
    'name' => null,
    'label' => null,
    'placeholder' => 'Select a date',
    'value' => null,
    'id' => 'datepicker-icon-prepend',
])

<div class="form-group mb-3">
    @if ($label)
        <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    @endif
    <div class="input-icon">
        <span class="input-icon-addon">
            <!-- SVG Icon: Calendar -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                <path d="M16 3v4" />
                <path d="M8 3v4" />
                <path d="M4 11h16" />
                <path d="M11 15h1" />
                <path d="M12 15v3" />
            </svg>
        </span>
        <input class="form-control" name="{{ $name }}" placeholder="{{ $placeholder }}"
            id="{{ $id }}" value="{{ $value }}" {{ $attributes->merge(['type' => 'text']) }} />
    </div>
    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</div>

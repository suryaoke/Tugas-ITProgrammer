@props([
    'name',
    'label' => 'Inline Radios',
    'options' => [], // default options adalah array kosong
])

<div class="mb-3">
    <div class="form-label">{{ $label }}</div>
    <div>
        @foreach ($options as $option)
            <label class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="{{ $name }}" value="{{ $option['value'] }}"
                    {{ isset($option['checked']) && $option['checked'] ? 'checked' : '' }}
                    {{ isset($option['disabled']) && $option['disabled'] ? 'disabled' : '' }}>
                <span class="form-check-label">{{ $option['label'] }}</span>
            </label>
        @endforeach
    </div>
    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</div>

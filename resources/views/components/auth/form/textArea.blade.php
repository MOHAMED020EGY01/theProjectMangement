@props([
    'id' => ''?: $name,
    'label' => '',
    'name' => '',
    'placeholder' => '',
    'value' => '',
    'required' => false,
    'autofocus' => false,
    'disabled' => false,
    'readonly' => false,
    'rows' => 4,
    'prepend' => '',
    'append' => '',
])

<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    
    <div class="input-group">
        @if($prepend)
            <span class="input-group-text">{!! $prepend !!}</span>
        @endif

        <textarea 
            name="{{ $name }}" 
            id="{{ $id }}" 
            rows="{{ $rows }}"
            class="form-control shadow @error($name) is-invalid @enderror" 
            placeholder="{{ $placeholder }}"
            {{ $required ? 'required' : '' }}
            {{ $autofocus ? 'autofocus' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            {{ $readonly ? 'readonly' : '' }}
        >{{ old($name, $value) }}</textarea>

        @if($append)
            <span class="input-group-text">{!! $append !!}</span>
        @endif
    </div>

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

@props([
    'id' => ''?: $name,
    'label' => '',
    'name' => '',
    'type' => 'text',
    'placeholder' => '',
    'value' => '',
    'required' => false,
    'autofocus' => false,
    'disabled' => false,
    'readonly' => false,
    'autocomplete' => '',
    'prepend' => '',
    'append' => '',
])

<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    
    <div class="input-group shadow">
        @if($prepend)
            <span class="input-group-text">{!! $prepend !!}</span>
        @endif
        <input 
            name="{{ $name }}" 
            type="{{ $type }}" 
            id="{{ $id }}" 
            class="form-control   @error($name) is-invalid @enderror" 
            placeholder="{{ $placeholder }}"
            value="{{ old($name, $value) }}"
            {{ $required ? 'required' : '' }}
            {{ $autofocus ? 'autofocus' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            {{ $readonly ? 'readonly' : '' }}
            {{ $autocomplete ? 'autocomplete=' . $autocomplete : '' }}
        >

        @if($append)
            <span class="input-group-text">{!! $append !!}</span>
        @endif
    </div>

    @error($name)
        <div class="text-danger" style="font-size: 13px;">
            {{ $message }}
        </div>
    @enderror
</div>

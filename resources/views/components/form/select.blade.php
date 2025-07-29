@props([
'id' => ''?: $name,
'label' => '',
'name' => '',
'type' => 'text',
'placeholder' => '',
'options' => [],
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
        <select class="form-select" name="{{ $name }}" id="{{ $id }}" class="form-select @error($name) is-invalid @enderror">
            <option disabled selected>Select</option>
            @foreach ($options as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>

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
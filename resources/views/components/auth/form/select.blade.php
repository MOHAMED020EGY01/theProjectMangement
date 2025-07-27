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
    
    <div class="input-group">
        @if($prepend)
            <span class="input-group-text">{!! $prepend !!}</span>
        @endif
        <select name="{{ $name }}" id="{{ $id }}" class="form-select @error($name) is-invalid @enderror">
            @foreach ($options as $option)
                <option value="{{ $option->id }}">{{ $option->name }}</option>
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

@props([
    'name',
    'label',
    'type' => 'text',
    'value' => '',
    'options' => [],
    'required' => false,
    'help' => null
])

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}{{ $required ? ' *' : '' }}</label>
    @if($type === 'textarea')
        <textarea class="form-control @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}" {{ $required ? 'required' : '' }}>{{ old($name, $value) }}</textarea>
    @elseif($type === 'select')
        <select class="form-select @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}" {{ $required ? 'required' : '' }}>
            <option value="">-- Choisir --</option>
            @foreach($options as $key => $option)
                <option value="{{ is_int($key) ? $option : $key }}" {{ old($name, $value) == (is_int($key) ? $option : $key) ? 'selected' : '' }}>{{ $option }}</option>
            @endforeach
        </select>
    @elseif($type === 'checkbox')
        <div class="form-check">
            <input class="form-check-input @error($name) is-invalid @enderror" type="checkbox" id="{{ $name }}" name="{{ $name }}" value="1" {{ old($name, $value) ? 'checked' : '' }} {{ $required ? 'required' : '' }}>
            <label class="form-check-label" for="{{ $name }}">{{ $label }}</label>
        </div>
    @else
        <input type="{{ $type }}" class="form-control @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value) }}" {{ $required ? 'required' : '' }}>
    @endif
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @if($help)
        <div class="form-text">{{ $help }}</div>
    @endif
</div>

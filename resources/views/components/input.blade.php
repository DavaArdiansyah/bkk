<div class="form-group {{ $class ?? '' }}">
    @if(isset($label))
        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    @endif
    <input type="{{ $type ?? 'text' }}" name="{{ $name }}" id="{{ $name }}" class="form-control {{ $attributes->get('class', '') }} @error($name) is-invalid @enderror" value="{{ old($name, $value ?? '') }}" @if(isset($placeholder)) placeholder="{{ $placeholder }}" @endif {{ $attributes->except('class') }}>
    @error($name)
        <span class="invalid-feedback d-block mt-2" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

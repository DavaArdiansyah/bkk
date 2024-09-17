<div class="form-group {{ $class ?? '' }}">
    @if(isset($label))
        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    @endif
    <input
        type="{{ $type ?? 'text' }}"
        name="{{ $name }}"
        id="{{ $name }}"
        class="form-control {{ $attributes->get('class', '') }}"
        value="{{ old($name, $value ?? '') }}"
        @if(isset($placeholder)) placeholder="{{ $placeholder }}" @endif
        @if(isset($required) && $required) data-parsley-required="true" @endif
        @if(isset($min)) data-parsley-minlength="{{ $min }}" @endif
        @if(isset($match)) data-parsley-password-match="#{{ $match }}" @endif
        {{ $attributes->except('class') }}
    >
</div>

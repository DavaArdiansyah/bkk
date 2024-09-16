<div class="form-group {{ $class ?? '' }}">
    @if($label)
        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    @endif
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        class="form-control {{ $attributes->get('class', '') }}"
        @if ($value) value="{{$value}}" @endif
        @if($placeholder) placeholder="{{ $placeholder }}" @endif
        @if($required) data-parsley-required="true" @endif
        @if ($min) data-parsley-minlength="{{$min}}" @endif
        @if ($matchPassword) data-parsley-password-match="#{{$matchPassword}}" @endif
        {{ $attributes->except('class') }}
    >
</div>

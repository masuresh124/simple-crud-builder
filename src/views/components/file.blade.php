@if ($data->label)
    <label for="{{ $data->name }}" class="form-label"> {{ $data->label }}
        @if ($data->required)
            <span class="text-danger">*</span>
        @endif
    </label>
@endif
<input class="form-control" id="{{ $data->name }}" name="{{ $data->name }}" type="file"
    @if ($data->required) required @endif>
<div>
    @if ($data->value)
        <a href="{{ $data->value }}" target="_blank">{{ $data->value }}</a>
    @endif
</div>

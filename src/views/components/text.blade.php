@if ($data->label)
    <label for="{{ $data->name }}" class="form-label"> {{ $data->label }}
        @if ($data->required)
            <span class="text-danger">*</span>
        @endif
    </label>
@endif
<input type="text" name="{{ $data->name }}" id="{{ $data->name }}" class="form-control"
    placeholder="{{ $data->placeholder }}" value="{{ $data->value }}" @if ($data->required) required @endif
    maxlength="255" />

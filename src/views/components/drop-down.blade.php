@if ($data->label)
    <label for="{{ $data->name }}" class="form-label"> {{ $data->label }}
        @if ($data->required)
            <span class="text-danger">*</span>
        @endif
    </label>
@endif
<select name="{{ $data->name }}" id="{{ $data->name }}" class="form-select" aria-label="Default select example"
    @if ($data->required) required @endif>
    @foreach ($data->choices as $label => $value)
        <option @if ($value === $data->value) selected @endif value="{{ $value }}">{{ $label }}
        </option>
    @endforeach
</select>

@if (count($data->choices) > 0)
    @foreach ($data->choices as $label => $value)
        <div class="form-check">
            <input class="form-check-input" type="radio" name="{{ $data->name }}"
                id="{{ $data->name }}{{ $value }}" value="{{ $value }}"
                @if ($value === $data->value) checked="checked" @endif>
            @if ($label)
                <label class="form-check-label" for="{{ $data->name }}{{ $value }}">
                    {{ $label }}
                </label>
            @endif
        </div>
    @endforeach
@else
    <div class="form-check">
        <input class="form-check-input" type="radio" name="{{ $data->name }}"
            id="{{ $data->name }}{{ $data->value }}" value="{{ $data->value }}">
    </div>
@endif

 @if ($data->label)
     <label for="{{ $data->name }}" class="form-label"> {{ $data->label }}
         @if ($data->required)
             <span class="text-danger">*</span>
         @endif
     </label>
 @endif
 <textarea id="{{ $data->name }}" name="{{ $data->name }}" placeholder="{{ $data->placeholder }}" class="form-control"
     rows="4" cols="50" @if ($data->required) required @endif>{{ $data->value }}</textarea>

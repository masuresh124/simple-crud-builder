 <div class="form-check">
     <input class="form-check-input" type="checkbox" id="{{ $data->name }}" name="{{ $data->name }}" value=1
         @if ($data->value) checked="checked" @endif @if ($data->required) required @endif>
     @if ($label)
         <label class="form-check-label" for="{{ $data->name }}">
             {{ $label }}
         </label>
     @endif
 </div>

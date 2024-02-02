<form @if ($fieldDetails->name) name="{{ $fieldDetails->name }}" id="{{ $fieldDetails->name }}" @endif
    @if ($fieldDetails->method) method="{{ $fieldDetails->method }}" @endif
    @if ($fieldDetails->file) enctype="multipart/form-data" @endif
    @if ($fieldDetails->action) action="{{ $fieldDetails->action }}" @endif> @csrf()
    <input type="hidden"  class="batchId" id="batchId" name="batchId" value="">
    @if ($fieldDetails->methoFun)
        @method($fieldDetails->methoFun)
    @endif
    {{ $slot }}
</form>

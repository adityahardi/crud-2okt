@props(['label' => '', 'name' => '', 'placeholder' => '', 'value' => ''])
<div class="form-group mb-3">
    <label class="font-weight-bold">{{ $label }}</label>
    <textarea class="form-control @error($name) is-invalid @enderror" name="{{ $name }}" rows="5" placeholder="{{ $placeholder }}">{{ old($name, $value) }}</textarea>

    @error($name)
    <div class="alert alert-danger mt-2">
        {{ $message }}
    </div>
    @enderror
</div>

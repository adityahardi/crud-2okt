@props(['label' => '', 'name' => '', 'placeholder' => '', 'value' => ''])
<div {{ $attributes->merge(['class' => 'form-group']) }}>
    <label class="font-weight-bold">{{ $label }}</label>
    <input type="text" class="form-control @error($name) is-invalid @enderror" name="{{ $name }}" value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}">

    @error($name)
    <div class="alert alert-danger mt-2">
        {{ $message }}
    </div>
    @enderror
</div>

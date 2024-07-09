@props(['label', 'name', 'options', 'selected' => null ,'id'])
<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}:</label>
    <select id="{{$id}}" name="{{ $name }}" class="form-select form-select-lg mb-3">
        @foreach ($options as $key => $option)
            <option value="{{ $key }}" {{ old($name, $selected ?? '') == $key ? 'selected' : '' }}>{{ $option }}</option>
        @endforeach
    </select>
</div>


@props(['name','label','type', 'id'])

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}:</label>
    <input type="{{ $type ?? 'text' }}" class="form-control" id="{{ $id }}" name="{{ $name }}" >
</div>

<!-- resources/views/components/input-group.blade.php -->
@props(['label'])
<div class="input-group">
    <span class="input-group-text">{{ $label }}</span>
    {{ $slot }}
</div>
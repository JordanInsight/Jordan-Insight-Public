<!-- Modal Component -->
@props(['id', 'title', 'action', 'formId', 'enctype' => null])
<div {{ $attributes->merge(['class' => 'modal fade']) }} tabindex="-1" id="{{ $id }}"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                @include('partials.errorAdminMessage')

                <form action="{{ $action }}" method="POST" id="{{ $formId }}"
                    {{ $enctype ? 'enctype=' . $enctype : '' }}>
                    @csrf

                    {{ $slot }}

                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

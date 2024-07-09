@props(['element'])
<div class="d-grid gap-2 mt-5 mb-3">
    <button name="btnadd" class="btn btn-outline-info btn-lg" data-bs-toggle="modal"
        data-bs-target=".Addservice">
        <i data-feather="plus-square"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ADD {{ $element}}
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i data-feather="plus-square"></i></button>
</div>
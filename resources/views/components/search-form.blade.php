<!-- resources/views/components/search-form.blade.php -->

<form id="searchForm">
    @csrf
    @method('POST')
    <div class="row mt-3">
        {{ $slot }}
    </div>
    <div class="row mt-1">
        <div class="col-md-6">
            <button type="submit" class=" btn btn-primary btn-sm btn-border btn-round">Search</button>
        </div>
        <div class="col-md-6">
            <button type="reset" id="resetButton" class="btn btn-secondary btn-block">Reset</button>
        </div>
    </div>
</form>
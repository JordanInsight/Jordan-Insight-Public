@extends('layout.adminbase')
@section('title', 'Hitsorical Sites ')
@section('content')

    <x-admin-crud-wrapper>
        <h2 class="card-title ">Hitsorical Sites </h2>

        <x-add-element-button element="Hitsorical Sites" />

        <x-data-table>

            <thead class="text-center">
                <tr>
                    <th>ID</th>
                    <th>Hitsorical Sites Name</th>
                    <th>Location</th>
                    <th>Rating</th>
                    <th>Description</th>
                    <th>Entry Fees</th>
                    <th>Open Hour</th>
                    <th>Image</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody class="text-center">
            </tbody>
        </x-data-table>

    </x-admin-crud-wrapper>


    <!-- ADD   Modal -->
    <x-modal id="addModal" class="Addservice" title="ADD Historical_Site" action="javascript:void(0)" formId="addForm"
        enctype="multipart/form-data">

        @method('POST')
        <x-input-field name="site_name" label="Name" id="name" />

        <x-select-field id="location_id" name="location_id" label="Location" :options="$locations->pluck('location_name', 'id')"
            selected="Choose a location" />



        <x-input-field name="rating" label="Rating" id="rating" />

        <x-input-field name="description" label="Description" id="description" />

        <x-input-field name="entry_fees" label="Entry Fees" id="entry_fees" type="number" />

        <x-input-field name="opening_hours" label="Opening Hours" id="opening_hours" />

        <x-input-field name="image" label="image" id="image" type="file" />
        <button type="submit" class="btn btn-primary">Submit</button>
    </x-modal>

    <!-- Edit   Modal -->
    <x-modal id="editModal" class="EditSer" title="Edit Historical_Site" action="javascript:void(0)" formId="edit-form"
        enctype="multipart/form-data">

        @method('POST')
        <x-input-field name="site_name" label="Name" id="eName" />

        <x-select-field id="eLocation_id" name="location_id" label="Location" :options="$locations->pluck('location_name', 'id')"
            selected="Choose a location" />

        <x-input-field name="rating" label="Rating" id="eRating" />

        <x-input-field name="description" label="Description" id="eDescription" />

        <x-input-field name="entry_fees" label="Entry Fees" id="eEntry_fees" type="number" />

        <x-input-field name="opening_hours" label="Opening Hours" id="eOpening_hours" />

        <x-input-field name="image" label="image" id="image" type="file" />
        <button type="submit" class="btn btn-primary">Submit</button>
        <input type="hidden" name="id" id="editId">
    </x-modal>
@endsection
<script>
    window.routes = {
        fetchHistoricalSites: "{{ route('admin.historicalSite.fetch') }}",
        addHistoricalSite: "{{ route('admin.historicalSite.store') }}",
        editHistoricalSite: "{{ route('admin.historicalSite.edit', ['historicalSite' => 'ID_PLACEHOLDER']) }}",
        updateHistoricalSite: "{{ route('admin.historicalSite.update', ['historicalSite' => 'PLACEHOLDER']) }}",
        deleteHistoricalSite: "{{ route('admin.historicalSite.destroy', ['historicalSite' => 'PLACEHOLDER']) }}"
    };
</script>
<script src="{{ asset('admin/scripts/historicalSite.js') }}" type="module"></script>

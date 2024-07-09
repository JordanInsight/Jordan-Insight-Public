@extends('layout.adminbase')
@section('title', 'Locations ')
@section('content')

    <x-admin-crud-wrapper>
        <h2 class="card-title ">locations </h2>

        <x-add-element-button element="Locations" />

        <x-data-table>
            <thead class="text-center">
                <tr>
                    <th>ID</th>
                    <th>name</th>
                    <th>City</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody class="text-center">
            </tbody>
        </x-data-table>
    </x-admin-crud-wrapper>



    <!-- ADD   Modal -->
    <x-modal id="addModal" class="Addservice" title="ADD location" action="javascript:void(0)" formId="addForm">

        @method('POST')
        <x-input-field name="location_name" label="Name" id="name" />

        <x-select-field id="city_id" name="city_id" label="City" :options="$cities->pluck('city_name', 'id')" selected="Choose a city" />
        <button type="submit" class="btn btn-primary">Submit</button>
    </x-modal>

    <!-- Edit   Modal -->
    <x-modal id="editModal" class="Editser" title="Edit location" action="javascript:void(0)" formId="edit-form">

        @method('PUT')

        <x-input-field name="location_name" label="Name" id="eName" />

        <x-select-field id="eCity_id" name="city_id" label="City" :options="$cities->pluck('city_name', 'id')" />
        <button type="submit" class="btn btn-primary">Submit</button>
        <input type="hidden" name="id" id="editId">
    </x-modal>
@endsection
<script>
    window.routes = {
        fetchLocations: "{{ route('admin.location.fetch') }}",
        addLocation: "{{ route('admin.location.store') }}",
        editLocation: "{{ route('admin.location.edit', ['location' => 'ID_PLACEHOLDER']) }}",
        updateLocation: "{{ route('admin.location.update', ['location' => 'PLACEHOLDER']) }}",
        deleteLocation: "{{ route('admin.location.destroy', ['location' => 'PLACEHOLDER']) }}"
    };
</script>
<script src="{{ asset('admin/scripts/location.js') }}" type="module"></script>

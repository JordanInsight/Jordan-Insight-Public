@extends('layout.adminbase')
@section('title', 'City ')
@section('content')

    <x-admin-crud-wrapper>
        <h2 class="card-title ">City </h2>

        <x-add-element-button element="City" />

        <x-data-table>

            <thead class="text-center">
                <tr>
                    <th>ID</th>
                    <th>name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody class="text-center">
            </tbody>

        </x-data-table>

    </x-admin-crud-wrapper>


    <!-- ADD Modal -->
    <x-modal id="addModal" class="Addservice" title="ADD City" action="javascript:void(0)" formId="addForm">

        @method('POST')

        <x-input-field name="city_name" label="Name" id="name" />
        <button type="submit" class="btn btn-primary">Submit</button>
    </x-modal>

    <!-- Edit   Modal -->
    <x-modal id="editModal" class="Editser" title="Edit city" action="javascript:void(0)" formId="edit-form">

        @method('PUT')

        <x-input-field name="city_name" label="Name" id="eName" />
        <button type="submit" class="btn btn-primary">Submit</button>
        <input type="hidden" name="ciy_id" id="editId">
    </x-modal>
@endsection
<script>
    window.routes = {
        fetchCities: "{{ route('admin.city.fetch') }}",
        addCity: "{{ route('admin.city.store') }}",
        editCity: "{{ route('admin.city.edit', ['city' => 'ID_PLACEHOLDER']) }}",
        updateCity: "{{ route('admin.city.update', ['city' => 'PLACEHOLDER']) }}",
        deleteCity: "{{ route('admin.city.destroy', ['city' => 'PLACEHOLDER']) }}"
    };
</script>
<script src="{{ asset('admin/scripts/city.js') }}" type="module"></script>

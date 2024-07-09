@extends('layout.adminbase')
@section('title', 'Restaurant ')
@section('content')

    <x-admin-crud-wrapper>
        <h2 class="card-title ">Restaurant </h2>

        <x-add-element-button element="Restaurant" />

        <x-data-table>

            <thead class="text-center">
                <tr>
                    <th>ID</th>
                    <th>Restaurant Name</th>
                    <th>Location</th>
                    <th>Rating</th>
                    <th>Description</th>
                    <th>cuisine</th>
                    <th>Min Price</th>
                    <th>Max Price</th>
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
    <x-modal id="addModal" class="Addservice" title="ADD Restaurant" action="javascript:void(0)" formId="addForm"
        enctype="multipart/form-data">

        @method('POST')
        <x-input-field name="restaurant_name" label="Name" id="name" />

        <x-select-field id="location_id" name="location_id" label="Location" :options="$locations->pluck('location_name', 'id')"
            selected="Choose a location" />

        <x-input-field name="rating" label="Rating" id="rating" />

        <x-input-field name="description" label="Description" id="description" />

        <x-input-field name="cuisine" label="Cuisine" id="cuisine" />

        <x-input-field name="min_price" label="Min Price" id="Min_price" type="number" />

        <x-input-field name="max_price" label="Max Price" id="Max_price" type="number" />


        <x-input-field name="image" label="image" id="image" type="file" />
        <button type="submit" class="btn btn-primary">Submit</button>
    </x-modal>

    <!-- Edit   Modal -->
    <x-modal id="editModal" class="Editser" title="Edit Restaurant" action="javascript:void(0)" formId="edit-form"
        enctype="multipart/form-data">

        @method('POST')
        <x-input-field name="restaurant_name" label="Name" id="eName" />

        <x-select-field id="eLocation_id" name="location_id" label="Location" :options="$locations->pluck('location_name', 'id')"
            selected="Choose a location" />

        <x-input-field name="rating" label="Rating" id="eRating" />

        <x-input-field name="description" label="Description" id="eDescription" />

        <x-input-field name="cuisine" label="Cuisine" id="eCuisine" />

        <x-input-field name="min_price" label="Min Price" id="eMin_price" type="number" />

        <x-input-field name="max_price" label="Max Price" id="eMax_price" type="number" />

        <x-input-field name="image" label="image" id="image" type="file" />
        <button type="submit" class="btn btn-primary">Submit</button>
        <input type="hidden" name="id" id="editId">
    </x-modal>
@endsection
<script>
    window.routes = {
        fetchRestaurants: "{{ route('admin.restaurant.fetch') }}",
        addRestaurant: "{{ route('admin.restaurant.store') }}",
        editRestaurant: "{{ route('admin.restaurant.edit', ['restaurant' => 'ID_PLACEHOLDER']) }}",
        updateRestaurant: "{{ route('admin.restaurant.update', ['restaurant' => 'PLACEHOLDER']) }}",
        deleteRestaurant: "{{ route('admin.restaurant.destroy', ['restaurant' => 'PLACEHOLDER']) }}"
    };
</script>
<script src="{{ asset('admin/scripts/restaurant.js') }}" type="module"></script>

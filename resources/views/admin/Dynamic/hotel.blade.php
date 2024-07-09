@extends('layout.adminbase')
@section('title', 'Hotel ')
@section('content')
    @include('partials._sidebar')
    <div class="page-wrapper">
        <div class="page-content">

            <div id="message" class="alert" style="display: none;"></div>

            <h2 class="card-title ">Hotel </h2>

            <x-add-element-button element="Hotel" />

            <x-data-table>

                <thead class="text-center">
                    <tr>
                        <th>ID</th>
                        <th>Hotel Name</th>
                        <th>Location</th>
                        <th>Rating</th>
                        <th>Description</th>
                        <th>Website</th>
                        <th>Max Price</th>
                        <th>Min Price</th>
                        <th>Image</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>

                <tbody class="text-center">
                </tbody>

            </x-data-table>

        </div>
    </div>


    <!-- ADD   Modal -->
    <x-modal id="addModal" class="Addservice" title="ADD location" action="javascript:void(0)" formId="addForm"
        enctype="multipart/form-data">

        @method('POST')
        <x-input-field name="hotel_name" label="Name" id="name" />

        <x-select-field id="location_id" name="location_id" label="Location" :options="$locations->pluck('location_name', 'id')"
            selected="Choose a location" />

        <x-input-field name="rating" label="Rating" id="rating" />

        <x-input-field name="description" label="Description" id="description" />

        <x-input-field name="website" label="Website" id="website" />

        <x-input-field name="min_price" label="min_price" id="min_price" type="number" />
        
        <x-input-field name="max_price" label="Max price" id="max_price" type="number" />

        <x-input-field name="image" label="image" id="image" type="file" />
        <button type="submit" class="btn btn-primary">Submit</button>
    </x-modal>

    <!-- Edit   Modal -->
    <x-modal id="editModal" class="Editser" title="Edit location" action="javascript:void(0)" formId="edit-form"
        enctype="multipart/form-data">

        @method('POST')
        <x-input-field name="hotel_name" label="Name" id="eName" />

        <x-select-field id="eLocation_id" name="location_id" label="Location" :options="$locations->pluck('location_name', 'id')"
            selected="Choose a location" />

        <x-input-field name="rating" label="Rating" id=eRating" />

        <x-input-field name="description" label="Description" id="eDescription" />

        <x-input-field name="website" label="Website" id="eWebsite" />

        <x-input-field name="min_price" label="min_price" id="eMin_price" type="number" />
        
        <x-input-field name="max_price" label="Max price" id="eMax_price" type="number" />

        <x-input-field name="image" label="image" id="image" type="file" />
        <button type="submit" class="btn btn-primary">Submit</button>
        <input type="hidden" name="id" id="editId">
    </x-modal>
@endsection
<script>
    window.routes = {
        fetchHotels: "{{ route('admin.hotel.fetch') }}",
        addHotel: "{{ route('admin.hotel.store') }}",
        editHotel: "{{ route('admin.hotel.edit', ['hotel' => 'ID_PLACEHOLDER']) }}",
        updateHotel: "{{ route('admin.hotel.update', ['hotel' => 'PLACEHOLDER']) }}",
        deleteHotel: "{{ route('admin.hotel.destroy', ['hotel' => 'PLACEHOLDER']) }}"
    };
</script>
<script src="{{ asset('admin/scripts/hotel.js') }}" type="module"></script>
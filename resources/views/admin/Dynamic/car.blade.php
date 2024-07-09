@extends('layout.adminbase')
@section('title', 'Car')
@section('content')
    @include('partials._sidebar')
    <div class="page-wrapper">
        <div class="page-content">
            <div id="message" class="alert" style="display: none;"></div>
            <h2 class="card-title">Car</h2>
            <x-add-element-button element="Car" />
            <x-data-table>
                <thead class="text-center">
                    <tr>
                        <th>ID</th>
                        <th>Car Name</th>
                        <th>Model</th>
                        <th>Type</th>
                        <th>Seats</th>
                        <th>Status</th>
                        <th>Price</th>
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
    <!-- ADD Modal -->
    <x-modal id="addModal" class="Addservice" title="ADD Cars" action="javascript:void(0)" formId="addForm" enctype="multipart/form-data">
        @method('POST')
        <x-input-field name="car_name" label="Name" id="name" />
        <x-input-field name="model" label="Model" id="model" />
        <x-input-field name="type" label="Type" id="type" />
        <x-input-field name="number_of_seats" label="Seats" id="seats" />
        <x-input-field name="status" label="Status" id="status" />
        <x-input-field name="price" label="Price" id="price" />
        <x-input-field name="image" label="Image" id="image" type="file" />
        <button type="submit" class="btn btn-primary">Submit</button>
    </x-modal>
    <!-- Edit Modal -->
    <x-modal id="editModal" class="Editser" title="Edit Car" action="javascript:void(0)" formId="edit-form" enctype="multipart/form-data">
        @method('POST')
        <x-input-field name="car_name" label="Name" id="eName" />
        <x-input-field name="model" label="Model" id="eModel" />
        <x-input-field name="type" label="Type" id="eType" />
        <x-input-field name="number_of_seats" label="Seats" id="eSeats" />
        <x-input-field name="status" label="Status" id="eStatus" />
        <x-input-field name="price" label="Price" id="ePrice" />
        <x-input-field name="image" label="Image" id="eImage" type="file" />
        <button type="submit" class="btn btn-primary">Submit</button>
        <input type="hidden" name="id" id="editId">
    </x-modal>
@endsection
<script>
    window.routes = {
        fetchCars: "{{ route('admin.car.fetch') }}",
        addCar: "{{ route('admin.car.store') }}",
        editCar: "{{ route('admin.car.edit', ['car' => 'ID_PLACEHOLDER']) }}",
        updateCar: "{{ route('admin.car.update', ['car' => 'PLACEHOLDER']) }}",
        deleteCar: "{{ route('admin.car.destroy', ['car' => 'PLACEHOLDER']) }}"
    };
</script>
<script src="{{ asset('admin/scripts/car.js') }}" type="module"></script>

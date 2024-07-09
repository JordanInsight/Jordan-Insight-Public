@extends('layout.adminbase')
@section('title', 'Activities')
@section('content')
    @include('partials._sidebar')
    <div class="page-wrapper">
        <div class="page-content">

            <div id="message" class="alert" style="display: none;"></div>

            <h2 class="card-title">Activities</h2>
            <x-add-element-button element="Activity" />

            <x-data-table>
                <thead class="text-center">
                    <tr>
                        <th>ID</th>
                        <th>Activity Name</th>
                        <th>Location</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Website</th> <!-- Added website column -->
                        <th>Price</th>
                        <th>Image</th>
                        <th>Rating</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                </tbody>
            </x-data-table>

        </div>
    </div>

    <!-- ADD Activity Modal -->
    <x-modal id="addModal" class="Addservice" title="Add Activity" action="javascript:void(0)" formId="addForm"
        enctype="multipart/form-data">
        @method('POST')
        <x-input-field name="activity_name" label="Activity Name" id="name" />
        <x-select-field id="location_id" name="location_id" label="Location" :options="$locations->pluck('location_name', 'id')"
            selected="Choose a location" />
        <x-input-field name="description" label="Description" id="description" />
        <x-input-field name="activity_type" label="Type" id="activity_type" />
        <x-input-field name="website" label="Website" id="website" /> <!-- Added website field -->
        <x-input-field name="price" label="Price" id="price" type="number" />
        <x-input-field name="image" label="Image" id="image" type="file" />
        <x-input-field name="rating" label="Rating" id="rating" type="number" step="0.1" max="5" />
        <button type="submit" class="btn btn-primary">Submit</button>
    </x-modal>

    <!-- Edit Activity Modal -->
    <x-modal id="editModal" class="Editser" title="Edit Activity" action="javascript:void(0)" formId="edit-form"
        enctype="multipart/form-data">
        @method('POST')
        <x-input-field name="activity_name" label="Activity Name" id="eName" />
        <x-select-field id="eLocation_id" name="location_id" label="Location" :options="$locations->pluck('location_name', 'id')"
            selected="Choose a location" />
        <x-input-field name="description" label="Description" id="eDescription" />
        <x-input-field name="activity_type" label="Type" id="eActivity_type" />
        <x-input-field name="website" label="Website" id="eWebsite" /> <!-- Added website field -->
        <x-input-field name="price" label="Price" id="ePrice" type="number" />
        <x-input-field name="image" label="Image" id="eImage" type="file" />
        <x-input-field name="rating" label="Rating" id="eRating" type="number" step="0.1" max="5" />
        <button type="submit" class="btn btn-primary">Submit</button>
        <input type="hidden" name="id" id="editId">
    </x-modal>
@endsection

<script>
    window.routes = {
        fetchActivities: "{{ route('admin.activity.fetch') }}",
        addActivity: "{{ route('admin.activity.store') }}",
        editActivity: "{{ route('admin.activity.edit', ['activity' => 'ID_PLACEHOLDER']) }}",
        updateActivity: "{{ route('admin.activity.update', ['activity' => 'PLACEHOLDER']) }}",
        deleteActivity: "{{ route('admin.activity.destroy', ['activity' => 'PLACEHOLDER']) }}"
    };
</script>
<script src="{{ asset('admin/scripts/activity.js') }}" type="module"></script>

@extends('layout.adminbase')
@section('title', 'Reservations')
@section('content')
    @include('partials._sidebar')
    <div class="page-wrapper">
        <div class="page-content">

            <div id="message" class="alert" style="display: none;"></div>

            <h2 class="card-title">Car Reservations</h2>
            {{-- <x-add-element-button element="Car Reservation" modalId="addCarReservationModal" /> --}}

            <x-data-table>
                <thead class="text-center">
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Car</th>
                        <th>Reservation Date</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Phone</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody class="text-center" id="carReservationsTable">
                </tbody>
            </x-data-table>

            <h2 class="card-title">Tour Reservations</h2>
            {{-- <x-add-element-button element="Tour Reservation" modalId="addTourReservationModal" /> --}}

            <x-data-table>
                <thead class="text-center">
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Tour</th>
                        <th>Reservation Date</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Phone</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody class="text-center" id="tourReservationsTable">
                </tbody>
            </x-data-table>

        </div>
    </div>

    <!-- ADD Car Reservation Modal -->
    <x-modal id="addCarReservationModal" class="Addservice" title="Add Car Reservation" action="javascript:void(0)"
        formId="addCarReservationForm">
        @method('POST')
        <x-select-field id="car_user_id" name="user_id" label="User" :options="$users->mapWithKeys(function ($user) {
            return [$user->id => $user->first_name . ' ' . $user->last_name];
        })" selected="Choose a user" />
        <x-select-field id="car_id" name="car_id" label="Car" :options="$cars->pluck('car_name', 'id')" selected="Choose a car" />
        <x-input-field name="start_date" label="Start Date" id="car_start_date" type="date" />
        <x-input-field name="end_date" label="End Date" id="car_end_date" type="date" />
        <x-input-field name="phone" label="Phone" id="car_phone" />
        <button type="submit" class="btn btn-primary">Submit</button>
    </x-modal>

    <!-- Edit Car Reservation Modal -->
    <x-modal id="editCarReservationModal" class="Editser" title="Edit Car Reservation" action="javascript:void(0)"
        formId="editCarReservationForm">
        @method('POST')
        <x-select-field id="edit_car_user_id" name="user_id" label="User" :options="$users->mapWithKeys(function ($user) {
            return [$user->id => $user->first_name . ' ' . $user->last_name];
        })" selected="Choose a user" />
        <x-select-field id="edit_car_id" name="car_id" label="Car" :options="$cars->pluck('car_name', 'id')" selected="Choose a car" />
        <x-input-field name="start_date" label="Start Date" id="edit_car_start_date" type="date" />
        <x-input-field name="end_date" label="End Date" id="edit_car_end_date" type="date" />
        <x-input-field name="phone" label="Phone" id="edit_car_phone" />
        <button type="submit" class="btn btn-primary">Submit</button>
        <input type="hidden" name="id" id="editCarReservationId">
        <input type="hidden" name="original_car_id" id="original_car_id">
    </x-modal>

    <!-- ADD Tour Reservation Modal -->
    <x-modal id="addTourReservationModal" class="Addservice" title="Add Tour Reservation" action="javascript:void(0)"
        formId="addTourReservationForm">
        @method('POST')
        <x-select-field id="tour_user_id" name="user_id" label="User" :options="$users->mapWithKeys(function ($user) {
            return [$user->id => $user->first_name . ' ' . $user->last_name];
        })" selected="Choose a user" />
        <x-select-field id="tour_id" name="tour_id" label="Tour" :options="$tours->pluck('tour_name', 'id')" selected="Choose a tour" />
        <x-input-field name="start_date" label="Start Date" id="tour_start_date" type="date" />
        <x-input-field name="end_date" label="End Date" id="tour_end_date" type="date" />
        <x-input-field name="phone" label="Phone" id="tour_phone" />
    </x-modal>

    <!-- Edit Tour Reservation Modal -->
    <x-modal id="editTourReservationModal" class="Editser" title="Edit Tour Reservation" action="javascript:void(0)"
        formId="editTourReservationForm">
        @method('POST')
        <x-select-field id="edit_tour_user_id" name="user_id" label="User" :options="$users->mapWithKeys(function ($user) {
            return [$user->id => $user->first_name . ' ' . $user->last_name];
        })"
            selected="Choose a user" />
        <x-select-field id="edit_tour_id" name="tour_id" label="Tour" :options="$tours->pluck('tour_name', 'id')" selected="Choose a tour" />
        <x-input-field name="start_date" label="Start Date" id="edit_tour_start_date" type="date" />
        <x-input-field name="end_date" label="End Date" id="edit_tour_end_date" type="date" />
        <x-input-field name="phone" label="Phone" id="edit_tour_phone" />
        <input type="hidden" name="id" id="editTourReservationId">
    </x-modal>
@endsection

<script>
    window.routes = {
        fetchCarReservations: "{{ route('admin.reservation.fetch.cars') }}",
        fetchTourReservations: "{{ route('admin.reservation.fetch.tours') }}",
        fetchAvailableCars: "{{ route('admin.reservation.fetch.available-cars') }}",
        addReservation: "{{ route('admin.reservation.store') }}",
        editReservation: "{{ route('admin.reservation.edit', ['reservation' => 'ID_PLACEHOLDER']) }}",
        updateReservation: "{{ route('admin.reservation.update', ['reservation' => 'PLACEHOLDER']) }}",
        deleteReservation: "{{ route('admin.reservation.destroy', ['reservation' => 'PLACEHOLDER']) }}"
    };
</script>
<script src="{{ asset('admin/scripts/reservation.js') }}" type="module"></script>

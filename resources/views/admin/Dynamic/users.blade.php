@extends('layout.adminbase')
@section('title', 'Users ')
@section('content')
    @include('partials._sidebar')
    <div class="page-wrapper">
        <div class="page-content">

            <div id="message" class="alert" style="display: none;"></div>

            <h2 class="card-title ">Users </h2>


            <x-data-table>

                <thead class="text-center">
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Role</th>
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


    <!-- Edit   Modal -->
    <x-modal id="editModal" class="Editser" title="Edit User" action="javascript:void(0)" formId="edit-form"
        enctype="multipart/form-data">

        @method('POST')

        <x-select-field id="eIs_admin" name="is_admin" label="Admin" :options="['1' => 'true', '0' => 'false']" />
            <x-select-field id="eRole" name="role_id" label="Role" :options="$roles" />
            <button type="submit" class="btn btn-primary">Submit</button>

        <input type="hidden" name="id" id="editId">
    </x-modal>
@endsection
<script>
    window.routes = {
        fetchUsers: "{{ route('admin.user.fetch') }}",
        editUser: "{{ route('admin.user.edit', ['user' => 'ID_PLACEHOLDER']) }}",
        updateUser: "{{ route('admin.user.update', ['user' => 'PLACEHOLDER']) }}",
        deleteUser: "{{ route('admin.user.destroy', ['user' => 'PLACEHOLDER']) }}"
    };
</script>
<script src="{{ asset('admin/scripts/users.js') }}" type="module"></script>

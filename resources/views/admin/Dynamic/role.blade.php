@extends('layout.adminbase')
@section('title', 'Role ')
@section('content')
    @include('partials._sidebar')
    <div class="page-wrapper">
        <div class="page-content">

            <div id="message" class="alert" style="display: none;"></div>

            <h2 class="card-title ">Role </h2>

            <x-add-element-button element="Role" />

            <x-data-table>

                <thead class="text-center">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
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
    <x-modal id="addModal" class="Addservice" title="ADD Role" action="javascript:void(0)" formId="addForm">

        @method('POST')

        <x-input-field name="role_name" label="Name" id="name" />
        <button type="submit" class="btn btn-primary">Submit</button>
    </x-modal>

    <!-- Edit   Modal -->
    <x-modal id="editModal" class="Editser" title="Edit city" action="javascript:void(0)" formId="edit-form">

        @method('PUT')

        <x-input-field name="role_name" label="Name" id="eName" />
        <button type="submit" class="btn btn-primary">Submit</button>
        <input type="hidden" name="role_id" id="editId">
    </x-modal>
@endsection
<script>
    window.routes = {
        fetchRoles: "{{ route('admin.role.fetch') }}",
        addRole: "{{ route('admin.role.store') }}",
        editRole: "{{ route('admin.role.edit', ['role' => 'ID_PLACEHOLDER']) }}",
        updateRole: "{{ route('admin.role.update', ['role' => 'PLACEHOLDER']) }}",
        deleteRole: "{{ route('admin.role.destroy', ['role' => 'PLACEHOLDER']) }}"
    };
</script>
<script src="{{ asset('admin/scripts/role.js') }}" type="module"></script>

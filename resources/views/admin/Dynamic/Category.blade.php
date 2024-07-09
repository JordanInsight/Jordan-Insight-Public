@extends('layout.adminbase')
@section('title', 'Trip categories ')
@section('content')

    <x-admin-crud-wrapper>
        <h2 class="card-title ">Categories </h2>

        <x-add-element-button element="Category" />

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
    <x-modal id="addModal" class="Addservice" title="ADD Category" action="javascript:void(0)" formId="addForm"
        enctype="multipart/form-data">

        @method('POST')

        <x-input-field name="category_name" label="Name" id="name" />
        <button type="submit" class="btn btn-primary">Submit</button>
    </x-modal>

    <!-- Edit   Modal -->
    <x-modal id="editModal" class="Editser" title="Edit Category" action="javascript:void(0)" formId="edit-form"
        enctype="multipart/form-data">

        @method('POST')

        <x-input-field name="category_name" label="Name" id="eName" />
        <button type="submit" class="btn btn-primary">Submit</button>
        <input type="hidden" name="id" id="editId">
    </x-modal>
@endsection

<script>
    window.routes = {
        fetchCategories: "{{ route('admin.Category.fetch') }}",
        addCategory: "{{ route('admin.Category.store') }}",
        editCategory: "{{ route('admin.Category.edit', ['Category' => 'ID_PLACEHOLDER']) }}",
        updateCategory: "{{ route('admin.Category.update', ['Category' => 'PLACEHOLDER']) }}",
        deleteCategory: "{{ route('admin.Category.destroy', ['Category' => 'PLACEHOLDER']) }}"
    };
</script>

<script src="{{ asset('admin/scripts/tripCategory.js') }}" type="module"></script>

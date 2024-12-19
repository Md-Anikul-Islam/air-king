@extends('admin.app')
@section('admin_content')
    {{-- CKEditor CDN --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Air King</a></li>
                        <li class="breadcrumb-item active">Product Design!</li>
                    </ol>
                </div>
                <h4 class="page-title">Product Design!</h4>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    @can('product-design-create')
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addNewModalId">Add New</button>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Product Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($productDesign as $key=> $productDesignData)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$productDesignData->product_name}}</td>
                            <td class="{{ $productDesignData->status == 1 ? '' : 'text-danger' }}">
                                {{ $productDesignData->status == 1 ? 'Active' : 'Inactive' }}
                            </td>

                            <td style="width: 100px;">
                                <div class="d-flex justify-content-end gap-1">
                                    @can('product-design-edit')
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editNewModalId{{$productDesignData->id}}">Edit</button>
                                    @endcan
                                    @can('product-design-delete')
                                        <a href="{{route('product.design.destroy',$productDesignData->id)}}"class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#danger-header-modal{{$productDesignData->id}}">Delete</a>
                                    @endcan
                                </div>
                            </td>
                            <!--Edit Modal -->
                            <div class="modal fade" id="editNewModalId{{$productDesignData->id}}" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="editNewModalLabel{{$productDesignData->id}}" aria-hidden="true">
                                <div class="modal-dialog  modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="addNewModalLabel{{$productDesignData->id}}">Edit</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{route('product.design.update',$productDesignData->id)}}" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="product_name" class="form-label">Name</label>
                                                            <input type="text" id="product_name" name="product_name" value="{{$productDesignData->product_name}}"
                                                                   class="form-control" placeholder="Enter Color Name" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="example-select" class="form-label">Status</label>
                                                            <select name="status" class="form-select">
                                                                <option value="1" {{ $productDesignData->status === 1 ? 'selected' : '' }}>Active</option>
                                                                <option value="0" {{ $productDesignData->status === 0 ? 'selected' : '' }}>Inactive</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button class="btn btn-primary" type="submit">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Delete Modal -->
                            <div id="danger-header-modal{{$productDesignData->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="danger-header-modalLabel{{$productDesignData->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header modal-colored-header bg-danger">
                                            <h4 class="modal-title" id="danger-header-modalLabe{{$productDesignData->id}}l">Delete</h4>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="mt-0">Are You Went to Delete this ? </h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            <a href="{{route('product.design.destroy',$productDesignData->id)}}" class="btn btn-danger">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--Add Modal -->
    <div class="modal fade" id="addNewModalId" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addNewModalLabel">Add</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('product.design.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Product Category</label>
                                    <select name="product_category_id" class="form-select">
                                        <option value="" selected>Product Category Select</option>
                                        @foreach($productCategory as $productCategoryData)
                                        <option value="{{$productCategoryData->id}}">{{$productCategoryData->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="product_name" class="form-label">Name</label>
                                    <input type="text" id="product_name" name="product_name"
                                           class="form-control" placeholder="Enter Name" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Product Color</label>
                                    <select name="product_color_id" class="form-select">
                                        <option value="" selected>Product Color Select</option>
                                        @foreach($color as $colorData)
                                            <option value="{{$colorData->id}}">{{$colorData->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="product_version" class="form-label">Version</label>
                                    <input type="text" id="product_version" name="product_version"
                                           class="form-control" placeholder="Enter Version" required>
                                </div>
                            </div>


                            <div id="raw-material-fields">
                                <div class="row raw-material-field mb-3">
                                    <div class="col-5">
                                        <label class="form-label">Raw Material</label>
                                        <select name="raw_material_id[]" class="form-select">
                                            <option value="" selected>Select Raw Material</option>
                                            @foreach($rawMaterial as $material)
                                                <option value="{{ $material->id }}">{{ $material->raw_material_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-5">
                                        <label class="form-label">Quantity</label>
                                        <input type="number" name="quantity[]" class="form-control" placeholder="Enter Quantity" required>
                                    </div>
                                    <div class="col-2 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger remove-raw-material-field">Remove</button>
                                    </div>
                                </div>

                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-primary" id="add-raw-material">➕</button>
                            </div>

                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add Fields (Add Modal)
        document.getElementById('add-raw-material').addEventListener('click', function () {
            const container = document.getElementById('raw-material-fields');
            const newField = document.createElement('div');
            newField.classList.add('row', 'raw-material-field', 'mb-3');
            newField.innerHTML = `
            <div class="col-5">
                <label class="form-label">Raw Material</label>
                <select name="raw_material_id[]" class="form-select">
                    <option value="" selected>Select Raw Material</option>
                    @foreach($rawMaterial as $material)
                      <option value="{{ $material->id }}">{{ $material->raw_material_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-5">
                <label class="form-label">Quantity</label>
                <input type="number" name="quantity[]" class="form-control" placeholder="Enter Quantity" required>
            </div>

            <div class="col-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger remove-raw-material-field">Remove</button>
            </div>`;
            container.appendChild(newField);
        });

        document.getElementById('raw-material-fields').addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-raw-material-field')) {
                e.target.closest('.raw-material-field').remove();
            }
        });


        // document.querySelectorAll('[id^=add-more-]').forEach(button => {
        //     button.addEventListener('click', function () {
        //         const packageId = this.id.split('-')[2];
        //         const nameFieldsContainer = document.getElementById(`edit-name-fields-${packageId}`);
        //
        //         const newField = document.createElement('div');
        //         newField.classList.add('row', 'name-field', 'mb-3');
        //         newField.innerHTML = `
        //     <div class="col-10">
        //         <label for="product" class="form-label">Product Name</label>
        //         <input type="text" class="form-control product-input" placeholder="Enter Product Name">
        //     </div>
        //     <div class="col-2 d-flex align-items-end">
        //         <button type="button" class="btn btn-danger remove-field">Remove</button>
        //     </div>
        // `;
        //         nameFieldsContainer.appendChild(newField);
        //     });
        // });
        //
        //
        // document.querySelectorAll('[id^=edit-name-fields-]').forEach(container => {
        //     container.addEventListener('click', function (e) {
        //         if (e.target.classList.contains('remove-field')) {
        //             e.target.closest('.name-field').remove();
        //         }
        //     });
        // });
        //
        //
        // document.querySelectorAll('form').forEach(form => {
        //     form.addEventListener('submit', function (e) {
        //         const packageId = form.getAttribute('action').split('/').pop();
        //         const hiddenField = document.getElementById(`products-json-${packageId}`);
        //         const nameFieldsContainer = document.getElementById(`edit-name-fields-${packageId}`);
        //         const inputs = nameFieldsContainer.querySelectorAll('.product-input');
        //
        //         const products = Array.from(inputs).map(input => input.value.trim()).filter(value => value !== '');
        //         hiddenField.value = JSON.stringify(products);
        //     });
        // });


    </script>

@endsection
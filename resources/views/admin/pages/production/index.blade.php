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
                    <!-- Large modal -->
                    @can('production-section-create')
                        <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#addNewModalId">Add
                            New
                        </button>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <table id="basic-datatable" class="table table-bordered table-striped dt-responsive w-100">
                    <thead>
                    <tr class="text-capitalize text-nowrap">
                        <th>SL</th>
                        <th>Product Design</th>
                        <th>Batch</th>
                        <th>Brand</th>
                        <th>Unit Price</th>
                        <th>Production Qty</th>
                        <th>Production Status</th>
                        <th>Warehouse</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (!empty($productions))
                        @foreach ($productions as $key => $data)
                            <tr>
                                <td scope="row">{{ ++$key }}</td>
                                <td>{{ $data->product_design->product_name }}</td>
                                <td>{{ $data->batch->batch_no }}</td>
                                <td>{{ $data->brand->name }}</td>
                                <td>{{ $data->unit_price }}</td>
                                <td>{{ $data->production_qty }}</td>
                                <td> {{ $data->production_status == 1 ? 'Production Process Done' : ($data->production_status == 2 ? 'Send To Warehouse' : 'Sold') }}</td>
                                <td>{{ $data->warehouse->name ?? '' }}</td>
                                <td style="width: 100px;">
                                    <div class="d-flex justify-content-end gap-1 text-nowrap">
                                        @can('production-section-edit')
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#changeStatusModal{{$data->id}}">Change Status
                                            </button>
                                        @endcan
                                        @can('production-section-edit')
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editNewModalId{{$data->id}}">Edit
                                            </button>
                                        @endcan
                                        @can('production-section-delete')
                                            <a href="{{route('production.destroy',$data->id)}}"
                                               class="btn btn-danger btn-sm"
                                               data-bs-toggle="modal"
                                               data-bs-target="#danger-header-modal{{$data->id}}">Delete</a>
                                        @endcan
                                    </div>
                                </td>


                                <!--------------------- Change Status Modal ----------------------------->
                                <div class="modal fade" id="changeStatusModal{{$data->id}}" data-bs-backdrop="static"
                                     tabindex="-1" role="dialog" aria-labelledby="changeStatusModalLabel{{$data->id}}"
                                     aria-hidden="true">
                                    <div class="modal-dialog  modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="addNewModalLabel{{$data->id}}">Edit</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post"
                                                      action="{{route('production.change_status',$data->id)}}"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label for="production_status" class="form-label">Production
                                                                    Status</label>
                                                                <select name="production_status"
                                                                        class="form-select prodcution_status_select"
                                                                        required>
                                                                    <option
                                                                        value="1" {{ $data->production_status == 1 ? 'selected' : '' }}>
                                                                        Production Process Done
                                                                    </option>
                                                                    <option
                                                                        value="2" {{ $data->production_status == 2 ? 'selected' : '' }}>
                                                                        Send To Warehouse
                                                                    </option>
                                                                    <option
                                                                        value="3" {{ $data->production_status == 3 ? 'selected' : '' }}>
                                                                        Sold
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 warehouse_select_container">
                                                            <div class="mb-3">
                                                                <label for="warehouse_id"
                                                                       class="form-label">Warehouse</label>
                                                                <select name="warehouse_id" class="form-select">
                                                                    <option selected>Select Warehouse</option>
                                                                    @foreach($wareHouses as $wareHousesData)
                                                                        <option
                                                                            value="{{$wareHousesData->id}}" {{ $wareHousesData->warehouse_id == $wareHousesData->id ? 'selected' : '' }}>{{$wareHousesData->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-end">
                                                            <button class="btn btn-primary" type="submit">Update
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!--------------------- Edit Modal ----------------------------->
                                <div class="modal fade" id="editNewModalId{{$data->id}}" data-bs-backdrop="static"
                                     tabindex="-1" role="dialog" aria-labelledby="editNewModalLabel{{$data->id}}"
                                     aria-hidden="true">
                                    <div class="modal-dialog  modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="addNewModalLabel{{$data->id}}">Edit</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="{{route('production.update',$data->id)}}"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label for="production_design_id" class="form-label">Product
                                                                    Design
                                                                </label>
                                                                <select name="production_design_id" class="form-select"
                                                                        required>
                                                                    @foreach($productDesigns as $productDesignsData)
                                                                        <option
                                                                            value="{{$productDesignsData->id}}" {{ $productDesignsData->production_design_id == $productDesignsData->id ? 'selected' : '' }}>{{$productDesignsData->product_name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label for="batch_id" class="form-label">Batch
                                                                    No</label>
                                                                <select name="batch_id" class="form-select" required>
                                                                    @foreach($batches as $batchesData)
                                                                        <option
                                                                            value="{{$batchesData->id}}" {{ $batchesData->batch_id == $batchesData->id ? 'selected' : '' }}>{{$batchesData->batch_no}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label for="example-select" class="form-label">Brand
                                                                    Name</label>
                                                                <select name="brand_id" class="form-select" required>
                                                                    @foreach($brands as $brandsData)
                                                                        <option
                                                                            value="{{$brandsData->id}}" {{ $brandsData->brand_id == $brandsData->id ? 'selected' : '' }}>{{$brandsData->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label for="unit_price" class="form-label">Unit
                                                                    Price</label>
                                                                <input type="number" id="unit_price" name="unit_price"
                                                                       value="{{$data->unit_price}}"
                                                                       class="form-control"
                                                                       placeholder="Enter Unit Price"
                                                                       required>
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label for="production_qty" class="form-label">Production
                                                                    Qty</label>
                                                                <input type="number" id="production_qty"
                                                                       name="production_qty"
                                                                       value="{{$data->production_qty}}"
                                                                       class="form-control"
                                                                       placeholder="Enter Production Qty"
                                                                       required>
                                                            </div>
                                                        </div>

                                                        <div class="d-flex justify-content-end">
                                                            <button class="btn btn-primary" type="submit">Update
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--------------------- Delete Modal ----------------------------->
                                <div id="danger-header-modal{{$data->id}}" class="modal fade" tabindex="-1"
                                     role="dialog"
                                     aria-labelledby="danger-header-modalLabel{{$data->id}}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header modal-colored-header bg-danger">
                                                <h4 class="modal-title" id="danger-header-modalLabe{{$data->id}}l">
                                                    Delete</h4>
                                                <button type="button" class="btn-close btn-close-white"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h5 class="mt-0">Are You Went to Delete this ? </h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <a href="{{route('production.destroy',$data->id)}}"
                                                   class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--------------------- Add New Modal ----------------------------->
    <div class="modal fade" id="addNewModalId" data-bs-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="addNewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <h4 class="modal-title" id="addNewModalLabel">Add</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('production.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Product Design</label>
                                    <select name="production_design_id" class="form-select">
                                        <option selected>Select Product Design</option>
                                        @foreach($productDesigns as $productDesignsData)
                                            <option
                                                value="{{$productDesignsData->id}}">{{$productDesignsData->product_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="batch_id" class="form-label">Batch Name</label>
                                    <select name="batch_id" class="form-select">
                                        <option selected>Select Batch No</option>
                                        @foreach($batches as $batchesData)
                                            <option value="{{$batchesData->id}}">{{$batchesData->batch_no}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Brand Name</label>
                                    <select name="brand_id" class="form-select">
                                        <option selected>Select Batch No</option>
                                        @foreach($brands as $brandsData)
                                            <option value="{{$brandsData->id}}">{{$brandsData->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="unit_price" class="form-label">Unit Price</label>
                                    <input type="text" id="unit_price" name="unit_price"
                                           class="form-control" placeholder="Enter Unit Price" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="production_qty" class="form-label">Product Qty</label>
                                    <input type="text" id="production_qty" name="production_qty"
                                           class="form-control" placeholder="Enter Product Qty" required>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const statusSelects = document.querySelectorAll('.prodcution_status_select');
            statusSelects.forEach(function (select) {
                select.addEventListener('change', function () {
                    const container = select.closest('.row').querySelector('.warehouse_select_container');
                    if (select.value === '2') {
                        container.style.display = 'block';
                    } else {
                        container.style.display = 'none';
                    }
                });

                const container = select.closest('.row').querySelector('.warehouse_select_container');
                if (select.value === '2') {
                    container.style.display = 'block';
                } else {
                    container.style.display = 'none';
                }
            });
        });
    </script>

@endsection

@push('js')

@endpush

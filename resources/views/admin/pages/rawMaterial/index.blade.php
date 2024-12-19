@extends('admin.app')
@section('admin_content')
    {{-- CKEditor CDN --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Air King</a></li>
                        <li class="breadcrumb-item active">Raw Material!</li>
                    </ol>
                </div>
                <h4 class="page-title">Raw Material!</h4>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    @can('raw-material-create')
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addNewModalId">Add New</button>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Supplier</th>
                        <th>Raw Material Section</th>
                        <th>Raw Material Name</th>
                        <th>Raw Material Unit</th>
                        <th>Raw Material Code</th>
                        <th>Raw Material Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rawMaterial as $key=>$rawMaterialData)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$rawMaterialData->supplier->name}}</td>
                            <td>{{$rawMaterialData->rawMaterialSection->name}}</td>
                            <td>{{$rawMaterialData->raw_material_name}}</td>
                            <td>{{$rawMaterialData->raw_material_unit}}</td>
                            <td>{{$rawMaterialData->raw_material_code}}</td>
                            <td>{{$rawMaterialData->raw_material_price}}</td>
                            <td class="{{ $rawMaterialData->status == 1 ? '' : 'text-danger' }}">
                                {{ $rawMaterialData->status == 1 ? 'Active' : 'Inactive' }}
                            </td>
                            <td style="width: 100px;">
                                <div class="d-flex justify-content-end gap-1">
                                    @can('raw-material-edit')
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editNewModalId{{$rawMaterialData->id}}">Edit</button>
                                    @endcan
                                    @can('raw-material-delete')
                                        <a href="{{route('raw.material.section.destroy',$rawMaterialData->id)}}"class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#danger-header-modal{{$rawMaterialData->id}}">Delete</a>
                                    @endcan
                                </div>
                            </td>
                            <!--Edit Modal -->
                            <div class="modal fade" id="editNewModalId{{$rawMaterialData->id}}" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="editNewModalLabel{{$rawMaterialData->id}}" aria-hidden="true">
                                <div class="modal-dialog  modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="addNewModalLabel{{$rawMaterialData->id}}">Edit</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{route('raw.material.update',$rawMaterialData->id)}}" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="example-select" class="form-label">Supplier</label>
                                                            <select name="raw_material_supplier_id" class="form-select">
                                                                @foreach($supplier as $supplierData)
                                                                    <option value="{{$supplierData->id}}" {{ $supplierData->id === $rawMaterialData->raw_material_supplier_id ? 'selected' : '' }}>{{$supplierData->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="example-select" class="form-label">Raw Material Section </label>
                                                            <select name="raw_material_section_id" class="form-select">
                                                                @foreach($rawMaterialSection as $rawMaterialSectionData)
                                                                    <option value="{{$rawMaterialSectionData->id}}" {{ $rawMaterialSectionData->id === $rawMaterialData->raw_material_section_id ? 'selected' : '' }}>{{$rawMaterialSectionData->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="raw_material_name" class="form-label">Raw Material Name</label>
                                                            <input type="text" id="raw_material_name" name="raw_material_name"
                                                                   class="form-control" value="{{$rawMaterialData->raw_material_name}}" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="example-select" class="form-label">Raw Material Unit</label>
                                                            <select name="raw_material_unit" class="form-select">
                                                                <option value="Kg" {{ $rawMaterialData->raw_material_unit === 'Kg' ? 'selected' : '' }}>Kg</option>
                                                                <option value="Pc" {{ $rawMaterialData->raw_material_unit === 'Pc' ? 'selected' : '' }}>Pc</option>
                                                                <option value="PSI" {{ $rawMaterialData->raw_material_unit === 'PSI' ? 'selected' : '' }}>PSI</option>
                                                                <option value="Yeard" {{ $rawMaterialData->raw_material_unit === 'Yeard' ? 'selected' : '' }}>Yeard</option>
                                                                <option value="Can" {{ $rawMaterialData->raw_material_unit === 'Can' ? 'selected' : '' }}>Can</option>
                                                                <option value="Coil" {{ $rawMaterialData->raw_material_unit === 'Coil' ? 'selected' : '' }}>Coil</option>
                                                                <option value="Ltr" {{ $rawMaterialData->raw_material_unit === 'Ltr' ? 'selected' : '' }}>Ltr</option>
                                                                <option value="Bundle" {{ $rawMaterialData->raw_material_unit === 'Bundle' ? 'selected' : '' }}>Bundle</option>
                                                                <option value="Pair" {{ $rawMaterialData->raw_material_unit === 'Pair' ? 'selected' : '' }}>Pair</option>
                                                                <option value="Galon" {{ $rawMaterialData->raw_material_unit === 'Galon' ? 'selected' : '' }}>Galon</option>
                                                                <option value="Gm" {{ $rawMaterialData->raw_material_unit === 'Gm' ? 'selected' : '' }}>Gm</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="raw_material_code" class="form-label">Raw Material Code</label>
                                                            <input type="text" id="raw_material_code" name="raw_material_code"
                                                                   class="form-control" value="{{$rawMaterialData->raw_material_code}}" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="raw_material_price" class="form-label ">Raw Material Price</label>
                                                            <input type="text" id="raw_material_price" name="raw_material_price"
                                                                   class="form-control" value="{{$rawMaterialData->raw_material_price}}" required>
                                                        </div>
                                                    </div>


                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="example-select" class="form-label">Status</label>
                                                            <select name="status" class="form-select">
                                                                <option value="1" {{ $rawMaterialData->status === 1 ? 'selected' : '' }}>Active</option>
                                                                <option value="0" {{ $rawMaterialData->status === 0 ? 'selected' : '' }}>Inactive</option>
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
                            <div id="danger-header-modal{{$rawMaterialData->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="danger-header-modalLabel{{$rawMaterialData->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header modal-colored-header bg-danger">
                                            <h4 class="modal-title" id="danger-header-modalLabe{{$rawMaterialData->id}}l">Delete</h4>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="mt-0">Are You Went to Delete this ? </h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            <a href="{{route('raw.material.destroy',$rawMaterialData->id)}}" class="btn btn-danger">Delete</a>
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
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addNewModalLabel">Add</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('raw.material.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Supplier</label>
                                    <select name="raw_material_supplier_id" class="form-select">
                                        @foreach($supplier as $supplierData)
                                            <option value="{{$supplierData->id}}">{{$supplierData->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Raw Material Section </label>
                                    <select name="raw_material_section_id" class="form-select">
                                        @foreach($rawMaterialSection as $rawMaterialSectionData)
                                        <option value="{{$rawMaterialSectionData->id}}">{{$rawMaterialSectionData->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="raw_material_name" class="form-label">Raw Material Name</label>
                                    <input type="text" id="raw_material_name" name="raw_material_name"
                                           class="form-control"  required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Raw Material Unit</label>
                                    <select name="raw_material_unit" class="form-select">
                                        <option value="Kg">Kg</option>
                                        <option value="Pc">Pc</option>
                                        <option value="PSI">PSI</option>
                                        <option value="Yeard">Yeard</option>
                                        <option value="Can">Can</option>
                                        <option value="Coil">Coil</option>
                                        <option value="Ltr">Ltr</option>
                                        <option value="Bundle">Bundle</option>
                                        <option value="Pair">Pair</option>
                                        <option value="Galon">Galon</option>
                                        <option value="Gm">Gm</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="raw_material_code" class="form-label">Raw Material Code</label>
                                    <input type="text" id="raw_material_code" name="raw_material_code"
                                           class="form-control" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="raw_material_price" class="form-label ">Raw Material Price</label>
                                    <input type="text" id="raw_material_price" name="raw_material_price"
                                           class="form-control" required>
                                </div>
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
@endsection

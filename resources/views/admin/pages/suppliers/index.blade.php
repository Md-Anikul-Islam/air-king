@extends('admin.app')
@section('admin_content')
    {{-- CKEditor CDN --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Air King</a></li>
                        <li class="breadcrumb-item active">Supplier Section!</li>
                    </ol>
                </div>
                <h4 class="page-title">Supplier Section!</h4>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    @can('supplier-section-create')
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addNewModalId">Add New</button>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>email</th>
                        <th>phone</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($supplier as $key=> $supplierData)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$supplierData->name}}</td>
                            <td>{{$supplierData->email}}</td>
                            <td>{{$supplierData->phone}}</td>
                            <td>{{$supplierData->address}}</td>
                            <td class="{{ $supplierData->status == 1 ? '' : 'text-danger' }}">
                                {{ $supplierData->status == 1 ? 'Active' : 'Inactive' }}
                            </td>

                            <td style="width: 100px;">
                                <div class="d-flex justify-content-end gap-1">
                                    @can('supplier-section-edit')
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editNewModalId{{$supplierData->id}}">Edit</button>
                                    @endcan
                                    @can('supplier-section-delete')
                                        <a href="{{route('supplier.destroy',$supplierData->id)}}"class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#danger-header-modal{{$supplierData->id}}">Delete</a>
                                    @endcan
                                </div>
                            </td>
                            <!--Edit Modal -->
                            <div class="modal fade" id="editNewModalId{{$supplierData->id}}" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="editNewModalLabel{{$supplierData->id}}" aria-hidden="true">
                                <div class="modal-dialog  modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="addNewModalLabel{{$supplierData->id}}">Edit</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{route('supplier.update',$supplierData->id)}}" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Name</label>
                                                            <input type="text" id="name" name="name" value="{{$supplierData->name}}"
                                                                   class="form-control" placeholder="Enter Your Name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label">Email</label>
                                                            <input type="email" id="email" name="email" value="{{$supplierData->email}}"
                                                                   class="form-control" placeholder="Enter Email Address">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="phone" class="form-label">Phone</label>
                                                            <input type="number" id="phone" name="phone" value="{{$supplierData->phone}}"
                                                                   class="form-control" placeholder="Enter Phone Number">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="address" class="form-label">Address</label>
                                                            <input type="text" id="address" name="address" value="{{$supplierData->address}}"
                                                                   class="form-control" placeholder="Enter Your Address">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="example-select" class="form-label">Status</label>
                                                            <select name="status" class="form-select">
                                                                <option value="1" {{ $supplierData->status === 1 ? 'selected' : '' }}>Active</option>
                                                                <option value="0" {{ $supplierData->status === 0 ? 'selected' : '' }}>Inactive</option>
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
                            <div id="danger-header-modal{{$supplierData->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="danger-header-modalLabel{{$supplierData->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header modal-colored-header bg-danger">
                                            <h4 class="modal-title" id="danger-header-modalLabe{{$supplierData->id}}l">Delete</h4>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="mt-0">Are You Went to Delete this ? </h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            <a href="{{route('supplier.destroy',$supplierData->id)}}" class="btn btn-danger">Delete</a>
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
                    <h4 class="modal-title" id="addNewModalLabel">Add Supplier</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('supplier.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" id="name" name="name"
                                           class="form-control" placeholder="Enter Your Name" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" name="email"
                                           class="form-control" placeholder="Enter Email address">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="number" id="phone" name="phone"
                                           class="form-control" placeholder="Enter your Email">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" id="address" name="address"
                                           class="form-control" placeholder="Enter Your Address">
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

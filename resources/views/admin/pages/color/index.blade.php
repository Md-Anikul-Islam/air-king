@extends('admin.app')
@section('admin_content')
    {{-- CKEditor CDN --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Air King</a></li>
                        <li class="breadcrumb-item active">Color Section!</li>
                    </ol>
                </div>
                <h4 class="page-title">Color Section!</h4>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    @can('color-section-create')
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
                        <th>Code</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($color as $key=> $colorData)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$colorData->name}}</td>
                            <td><p style="color: {{ $colorData->code ?? '' }} !important;">{{$colorData->code}}</p></td>
                            <td class="{{ $colorData->status == 1 ? '' : 'text-danger' }}">
                                {{ $colorData->status == 1 ? 'Active' : 'Inactive' }}
                            </td>

                            <td style="width: 100px;">
                                <div class="d-flex justify-content-end gap-1">
                                    @can('color-section-edit')
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editNewModalId{{$colorData->id}}">Edit</button>
                                    @endcan
                                    @can('color-section-delete')
                                        <a href="{{route('color.destroy',$colorData->id)}}"class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#danger-header-modal{{$colorData->id}}">Delete</a>
                                    @endcan
                                </div>
                            </td>
                            <!--Edit Modal -->
                            <div class="modal fade" id="editNewModalId{{$colorData->id}}" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="editNewModalLabel{{$colorData->id}}" aria-hidden="true">
                                <div class="modal-dialog  modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="addNewModalLabel{{$colorData->id}}">Edit</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{route('color.update',$colorData->id)}}" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Name</label>
                                                            <input type="text" id="name" name="name" value="{{$colorData->name}}"
                                                                   class="form-control" placeholder="Enter Color Name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="code" class="form-label">Code</label>
                                                            <input type="code" id="code" name="code" value="{{$colorData->code}}"
                                                                   class="form-control" placeholder="Enter Color Code">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="example-select" class="form-label">Status</label>
                                                            <select name="status" class="form-select">
                                                                <option value="1" {{ $colorData->status === 1 ? 'selected' : '' }}>Active</option>
                                                                <option value="0" {{ $colorData->status === 0 ? 'selected' : '' }}>Inactive</option>
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
                            <div id="danger-header-modal{{$colorData->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="danger-header-modalLabel{{$colorData->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header modal-colored-header bg-danger">
                                            <h4 class="modal-title" id="danger-header-modalLabe{{$colorData->id}}l">Delete</h4>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="mt-0">Are You Went to Delete this ? </h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            <a href="{{route('color.destroy',$colorData->id)}}" class="btn btn-danger">Delete</a>
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
                    <h4 class="modal-title" id="addNewModalLabel">Add Color</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('color.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" id="name" name="name"
                                           class="form-control" placeholder="Enter Color Name" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="code" class="form-label">Code</label>
                                    <input type="code" id="code" name="code"
                                           class="form-control" placeholder="Enter Color Code">
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

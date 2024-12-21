@extends('admin.app')
@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Air King</a></li>
                        <li class="breadcrumb-item active">{{$page_title}}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{$page_title}}</h4>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    @can('brand-section-create')
                        <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#addNewModalId">Add New
                        </button>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Logo</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($brands as $key=>$data)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$data->name}}</td>
                            <td>
                                @if (!empty($data->logo))
                                    <img src="{{ asset('uploads/brand-logo/' . $data->logo) }}"
                                        style="width:60px;">
                                @endif
                            </td>
                            <td class="{{ $data->status == 1 ? '' : 'text-danger' }}">
                                {{ $data->status == 1 ? 'Active' : 'Inactive' }}
                            </td>
                            <td style="width: 100px;">
                                <div class="d-flex justify-content-end gap-1">
                                    @can('brand-section-edit')
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editNewModalId{{$data->id}}">Edit
                                        </button>
                                    @endcan
                                    @can('brand-section-delete')
                                        <a href="{{route('brand.destroy',$data->id)}}" class="btn btn-danger btn-sm"
                                           data-bs-toggle="modal" data-bs-target="#danger-header-modal{{$data->id}}">Delete</a>
                                    @endcan
                                </div>
                            </td>
                            <!--Edit Modal -->
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
                                            <form method="post" action="{{route('brand.update',$data->id)}}"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Name</label>
                                                            <input type="text" id="name" name="name"
                                                                   value="{{$data->name}}"
                                                                   class="form-control" placeholder="Enter Brand Name"
                                                                   required>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="logo" class="form-label">logo </label>

                                                            <input type="file" name="logo"
                                                                class="form-control">
                                                            @if(!empty($data->logo))
                                                                <div class="mb-2">
                                                                    <img src="{{ asset('uploads/brand-logo/' . $data->logo) }}"
                                                                         alt="Current Logo"
                                                                         style="width: 80px; height: auto; border: 1px solid #ddd; padding: 5px;">
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="example-select"
                                                                   class="form-label">Status</label>
                                                            <select name="status" class="form-select" required>
                                                                <option
                                                                    value="1" {{ $data->status === 1 ? 'selected' : '' }}>
                                                                    Active
                                                                </option>
                                                                <option
                                                                    value="0" {{ $data->status === 0 ? 'selected' : '' }}>
                                                                    Inactive
                                                                </option>
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
                            <div id="danger-header-modal{{$data->id}}" class="modal fade" tabindex="-1" role="dialog"
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
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close
                                            </button>
                                            <a href="{{route('brand.destroy',$data->id)}}"
                                               class="btn btn-danger">Delete</a>
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
    <div class="modal fade" id="addNewModalId" data-bs-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="addNewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <h4 class="modal-title" id="addNewModalLabel">Add</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('brand.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" id="name" name="name"
                                           class="form-control" placeholder="Enter Brand Name" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="logo" class="form-label">logo </label>
                                    <input type="file" name="logo" class="form-control">
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

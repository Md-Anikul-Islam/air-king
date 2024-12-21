@extends('admin.app')
@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Air King</a></li>

                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    @can('expense-section-create')
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
                        <th>Expense Type</th>
                        <th>Name</th>
                        <th>Unit Type</th>
                        <th>Quantity</th>
                        <th>Rate</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($expenses as $key=>$data)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                {{ $data->expenseType->name }}
                            </td>
                            <td>{{$data->name}}</td>
                            <td>{{$data->unit_type}}</td>
                            <td>{{$data->qty}}</td>
                            <td>{{$data->rate}}</td>
                            <td class="{{ $data->status == 1 ? '' : 'text-danger' }}">
                                {{ $data->status == 1 ? 'Active' : 'Inactive' }}
                            </td>
                            <td style="width: 100px;">
                                <div class="d-flex justify-content-end gap-1">
                                    @can('expense-section-edit')
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editNewModalId{{$data->id}}">Edit
                                        </button>
                                    @endcan
                                    @can('expense-section-delete')
                                        <a href="{{route('expense.destroy',$data->id)}}" class="btn btn-danger btn-sm"
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
                                            <form method="post" action="{{route('expense.update',$data->id)}}"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="col-12">

                                                        <div class="mb-3">
                                                            <label for="example-select" class="form-label">Expense Type</label>
                                                            <select name="expense_type_id" class="form-select">
                                                                <option value="" selected>Expense Type Select</option>
                                                                @foreach($expenseType as $expenseTypeData)
                                                                    <option value="{{$expenseTypeData->id}}" {{ $expenseTypeData->expense_type_id == $expenseTypeData->id ? 'selected' : '' }}>{{$expenseTypeData->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>


                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Name</label>
                                                            <input type="text" id="name" name="name"
                                                                   value="{{$data->name}}"
                                                                   class="form-control" placeholder="Enter Expense Type Name"
                                                                   required>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label for="example-select"
                                                                       class="form-label">Unit Type</label>
                                                                <select name="unit_type" class="form-select" required>
                                                                    <option
                                                                        value="Month" {{ $data->unit_type === 'Month' ? 'selected' : '' }}>
                                                                        Month
                                                                    </option>
                                                                    <option
                                                                        value="No" {{ $data->unit_type === 'No' ? 'selected' : '' }}>
                                                                        No
                                                                    </option>
                                                                    <option
                                                                    value="Dec" {{ $data->unit_type === 'Dec' ? 'selected' : '' }}>
                                                                    Dec
                                                                </option>
                                                                <option
                                                                    value="Set" {{ $data->unit_type === 'Set' ? 'selected' : '' }}>
                                                                    Set
                                                                </option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="qty" class="form-label">Quantity</label>
                                                            <input type="qty" id="qty" name="qty"
                                                                   value="{{$data->qty}}"
                                                                   class="form-control" placeholder="Enter Quantity"
                                                                   required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="rate" class="form-label">Rate</label>
                                                            <input type="rate" id="rate" name="rate"
                                                                   value="{{$data->rate}}"
                                                                   class="form-control" placeholder="Enter Rate"
                                                                   required>
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
                                            <a href="{{route('expense.destroy',$data->id)}}"
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
                    <form method="post" action="{{route('expense.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Expense Type</label>
                                    <select name="expense_type_id" class="form-select">
                                        <option value="" selected>Expense Type Select</option>
                                        @foreach($expenseType as $expenseTypeData)
                                            <option value="{{$expenseTypeData->id}}">{{$expenseTypeData->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" id="name" name="name"
                                           class="form-control" placeholder="Enter Expense Type Name" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Unit Type</label>
                                    <select name="unit_type" class="form-select">
                                        <option value="" selected>Select Unit Type</option>
                                        <option value="Month">Month</option>
                                        <option value="No">No</option>
                                        <option value="Dec">Dec</option>
                                        <option value="Set">Set</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="qty" class="form-label">Quantity</label>
                                    <input type="number" id="qty" name="qty"
                                           class="form-control" placeholder="Enter Quantity" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="rate" class="form-label">Rate</label>
                                    <input type="number" id="rate" name="rate"
                                           class="form-control" placeholder="Enter Rate" required>
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

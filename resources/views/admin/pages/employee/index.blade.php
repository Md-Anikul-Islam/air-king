@extends('admin.app')
@section('admin_content')
    {{-- CKEditor CDN --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Air King</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Hr Payroll</a></li>
                        <li class="breadcrumb-item active">Employee!</li>
                    </ol>
                </div>
                <h4 class="page-title">Employee!</h4>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    @can('employee-section-create')
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addNewModalId">Add New</button>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Employee Section</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Joining Date</th>
                        <th>Salary</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($employee as $key=>$employeeData)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$employeeData->employeeSection->name}}</td>
                            <td>{{$employeeData->name}}</td>
                            <td>{{$employeeData->designation}}</td>
                            <td>{{$employeeData->email? $employeeData->email:'N/A'}}</td>
                            <td>{{$employeeData->phone? $employeeData->phone:'N/A'}}</td>
                            <td>{{$employeeData->address? $employeeData->address:'N/A'}}</td>
                            <td>{{$employeeData->joining_date}}</td>
                            <td>{{$employeeData->salary}}</td>
                            <td>{{$employeeData->status==1? 'Active':'Inactive'}}</td>
                            <td style="width: 100px;">
                                <div class="d-flex justify-content-end gap-1">
                                    @can('employee-edit')
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editNewModalId{{$employeeData->id}}">Edit</button>
                                    @endcan
                                    @can('employee-delete')
                                        <a href="{{route('employee.destroy',$employeeData->id)}}"class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#danger-header-modal{{$employeeData->id}}">Delete</a>
                                    @endcan
                                </div>
                            </td>
                            <!--Edit Modal -->
                            <div class="modal fade" id="editNewModalId{{$employeeData->id}}" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="editNewModalLabel{{$employeeData->id}}" aria-hidden="true">
                                <div class="modal-dialog  modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="addNewModalLabel{{$employeeData->id}}">Edit</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{route('employee.update',$employeeData->id)}}" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="example-select" class="form-label">Employee Section</label>
                                                            <select name="employee_section_id" class="form-select">
                                                                @foreach($employeeSection as $employeeSectionData)
                                                                    <option value="{{$employeeSectionData->id}}" {{ $employeeData->employee_section_id === $employeeSectionData->id ? 'selected' : '' }}>{{$employeeSectionData->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Name</label>
                                                            <input type="text" id="name" name="name" value="{{$employeeData->name}}"
                                                                   class="form-control" placeholder="Enter Name" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="designation" class="form-label">Designation</label>
                                                            <input type="text" id="designation" name="designation" value="{{$employeeData->designation}}"
                                                                   class="form-control" placeholder="Enter Designation" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label">Email</label>
                                                            <input type="email" id="email" name="email" value="{{$employeeData->email}}"
                                                                   class="form-control" placeholder="Enter Email">
                                                        </div>
                                                    </div>



                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="phone" class="form-label">Phone</label>
                                                            <input type="text" id="phone" name="phone" value="{{$employeeData->phone}}"
                                                                   class="form-control" placeholder="Enter Phone">
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="address" class="form-label">Address</label>
                                                            <input type="text" id="address" name="address" value="{{$employeeData->address}}"
                                                                   class="form-control" placeholder="Enter Address">
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="joining_date" class="form-label ">Joining Date</label>
                                                            <input type="date" id="joining_date" name="joining_date" value="{{$employeeData->joining_date}}"
                                                                   class="form-control" placeholder="Enter Joining Date">
                                                        </div>
                                                    </div>


                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="salary" class="form-label">Salary</label>
                                                            <input type="text" id="salary" name="salary" value="{{$employeeData->salary}}"
                                                                   class="form-control" placeholder="Enter Salary">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="example-select" class="form-label">Status</label>
                                                            <select name="status" class="form-select">
                                                                <option value="1" {{ $employeeData->status === 1 ? 'selected' : '' }}>Active</option>
                                                                <option value="0" {{ $employeeData->status === 0 ? 'selected' : '' }}>Inactive</option>
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
                            <div id="danger-header-modal{{$employeeData->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="danger-header-modalLabel{{$employeeData->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header modal-colored-header bg-danger">
                                            <h4 class="modal-title" id="danger-header-modalLabe{{$employeeData->id}}l">Delete</h4>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="mt-0">Are You Went to Delete this ? </h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            <a href="{{route('employee.destroy',$employeeData->id)}}" class="btn btn-danger">Delete</a>
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
                    <form method="post" action="{{route('employee.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Employee Section</label>
                                    <select name="employee_section_id" class="form-select">
                                        @foreach($employeeSection as $employeeSectionData)
                                            <option value="{{$employeeSectionData->id}}">{{$employeeSectionData->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>



                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" id="name" name="name"
                                           class="form-control" placeholder="Enter Name" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="designation" class="form-label">Designation</label>
                                    <input type="text" id="designation" name="designation"
                                           class="form-control" placeholder="Enter Designation" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" name="email"
                                           class="form-control" placeholder="Enter Email">
                                </div>
                            </div>



                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" id="phone" name="phone"
                                           class="form-control" placeholder="Enter Phone">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" id="address" name="address"
                                           class="form-control" placeholder="Enter Address">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="joining_date" class="form-label ">Joining Date</label>
                                    <input type="date" id="joining_date" name="joining_date"
                                           class="form-control" placeholder="Enter Joining Date">
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="salary" class="form-label">Salary</label>
                                    <input type="text" id="salary" name="salary"
                                           class="form-control" placeholder="Enter Salary">
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

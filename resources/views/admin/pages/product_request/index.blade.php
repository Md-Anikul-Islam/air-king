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
            <div class="card-body">
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Product Name</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>phone</th>
                        <th>Address</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($productRequests as $key => $request)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $request->product_name }}</td>
                            <td>{{ $request->name }}</td>
                            <td>{{ $request->email }}</td>
                            <td>{{ $request->phone }}</td>
                            <td>{{ $request->address }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

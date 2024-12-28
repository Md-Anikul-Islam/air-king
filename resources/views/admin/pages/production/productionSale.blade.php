@extends('admin.app')
@section('admin_content')
    {{-- CKEditor CDN --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Air King</a></li>
                        <li class="breadcrumb-item active">!</li>
                    </ol>
                </div>
                <h4 class="page-title">Production Sale!</h4>
            </div>
        </div>
    </div>


    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    <!-- Large modal -->
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
                        <th>Available Qty</th>
                        <th>Production Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (!empty($productions))
                        @foreach ($productions as $key => $data)
                            <tr>
                                <td scope="row">{{ ++$key }}</td>
                                <td>{{ $data->product_design->product_name }}
                                    ({{ $data->product_design->productCategory->name }})
                                </td>
                                <td>{{ $data->batch->batch_no }}</td>
                                <td>{{ $data->brand->name }}</td>
                                <td>{{ $data->unit_price }}</td>
                                <td>{{ $data->production_qty }}</td>
                                <td>{{ $data->available_qty }}</td>
                                <td> {{ $data->production_status == 1 ? 'Production Process Done' : ($data->production_status == 2 ? 'Send To Warehouse' : 'Sales Initiated') }}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>



@endsection

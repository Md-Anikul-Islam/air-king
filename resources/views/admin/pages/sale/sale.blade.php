@extends('admin.app')
@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Air King</a></li>
                        <li class="breadcrumb-item active">Sale Record</li>
                    </ol>
                </div>
                <h4 class="page-title">Sale Record</h4>
            </div>
        </div>
    </div>

    <!-- Filter Form -->
    <form action="{{ route('sale.history') }}" method="get">
        <div class="row mb-4">
            <div class="col-md-3">
                <select name="customer_id" class="form-control">
                    <option value="">Select Customer</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ request('customer_id') == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="production_id" class="form-control">
                    <option value="">Select Product</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ request('production_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->product_design->product_name }} - {{ $product->batch->batch_no }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-2">
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <!-- Totals Display -->
    <div class="row mb-4">
        <div class="col-md-6">
            <h5>Total Sales (All Time): BDT {{ number_format($defaultTotalAmount, 2) }}</h5>
        </div>
        <div class="col-md-6">
            <h5>Total Sales (Filtered): BDT {{ number_format($totalAmount, 2) }}</h5>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                </div>
            </div>
            <div class="card-body">
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Customer Name</th>
                        <th>Batch</th>
                        <th>Product</th>
                        <th>Unit Cost</th>
                        <th>Sale Qty</th>
                        <th>Total Amount Sale</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sale as $key=>$data)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$data->customer->name}}</td>
                            <td>{{$data->production->batch->batch_no}}</td>
                            <td>{{$data->production->product_design->product_name}}</td>
                            <td>{{$data->production->unit_price}}</td>
                            <td>{{$data->sell_qty}}</td>
                            <td>{{$data->production->unit_price * $data->sell_qty}}</td>
                            <td>{{$data->sell_date}}</td>
                            <td style="width: 100px;">
                                <div class="d-flex gap-1">
                                    <a href="{{route('sale.history.invoice', $data->id)}}" class="btn btn-info">Generate Invoice</a>
                                    <a href="{{ route('sale.details', $data->id) }}" class="btn btn-primary">Details</a>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

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
                <div class="d-flex justify-content-end gap-1">
                    <button type="button" class="btn btn-info" data-bs-toggle="modal"
                            data-bs-target="#addNewModalId">Add New Payment
                    </button>
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
                        <th>Total Amount</th>
                        <th>Paid Amount</th>
                        <th>Due</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sellHistoryDetails as $key=>$data)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$data->sellProduction->customer->name}}</td>
                            <td>{{$data->sellProduction->production->batch->batch_no}}</td>
                            <td>{{$data->sellProduction->production->product_design->product_name}}</td>
                            <td>{{$data->sellProduction->unit_price}}</td>
                            <td>{{$data->sellProduction->sell_qty}}</td>
                            <td>{{$data->sellProduction->unit_price * $data->sellProduction->sell_qty}}</td>
                            <td>{{$data->payment}}</td>
                            <td>{{$data->due}}</td>
                            <td>{{$data->sellProduction->sell_date}}</td>
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
                    <form method="post" action="{{route('sale.details.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="sell_production_id" value="{{ $data->sell_production_id }}">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">New Payment</label>
                                    <input type="number" id="payment" name="payment"
                                           class="form-control" placeholder="Enter New Payment" required>
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

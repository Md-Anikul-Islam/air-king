<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use App\Models\ProductRequest;
use Yoeunes\Toastr\Facades\Toastr;

class ProductRequestController extends Controller
{
    public function index()
    {
        $productRequests = ProductRequest::all();
        return view('admin.pages.product_request.index', compact('productRequests'));
    }
    public function destroy($id)
    {
        try {
            $product_requests = ProductRequest::find($id);
            $product_requests->delete();
            Toastr::success('Product Request Section Deleted Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}

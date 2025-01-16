<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use App\Models\ProductRequest;

class ProductRequestController extends Controller
{
    public function index()
    {
        // Fetch all product requests
        $productRequests = ProductRequest::all();

        // Pass data to the view
        return view('admin.pages.product_request.index', compact('productRequests'));
    }
}

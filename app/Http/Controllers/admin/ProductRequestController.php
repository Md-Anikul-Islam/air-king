<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\ProductRequest;
use App\Http\Controllers\Controller;

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

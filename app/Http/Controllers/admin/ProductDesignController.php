<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\ProductCategory;
use App\Models\ProductDesign;
use App\Models\ProductDesignUseRawMaterial;
use App\Models\RawMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yoeunes\Toastr\Facades\Toastr;

class ProductDesignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Gate::allows('product-design-list')) {
                return redirect()->route('unauthorized.action');
            }
            return $next($request);
        })->only('index');
    }
    public function index()
    {
        $productCategory = ProductCategory::latest()->get();
        $productDesign = ProductDesign::latest()->get();
        $color = Color::latest()->get();
        $rawMaterial = RawMaterial::latest()->get();
        return view('admin.pages.productDesign.index', compact('productCategory', 'productDesign',
            'color', 'rawMaterial'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_category_id' => 'required',
            'product_name' => 'required',
            'product_color_id' => 'required',
            'product_version' => 'required',
        ]);
        $productDesign = new ProductDesign();
        $productDesign->product_category_id = $request->product_category_id;
        $productDesign->product_name = $request->product_name;
        $productDesign->product_color_id = $request->product_color_id;
        $productDesign->product_version = $request->product_version;
        $productDesign->save();
        // Handling multiple entries for raw materials and quantities
        if ($request->has('raw_material_id')) {
            foreach ($request->raw_material_id as $index => $rawMaterialId) {
                $quantity = $request->quantity[$index];
                ProductDesignUseRawMaterial::create([
                    'product_design_id' => $productDesign->id,
                    'raw_material_id' => $rawMaterialId,
                    'quantity' => $quantity,
                ]);
            }
        }
        Toastr::success('Product Design Add Successfully', 'Success');
        return redirect()->back();
    }
}

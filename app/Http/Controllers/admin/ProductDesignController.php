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
        $productDesign = ProductDesign::with(['productCategory', 'productColor', 'rawMaterials'])->latest()->get();
        $color = Color::latest()->get();
        $rawMaterialInfo = RawMaterial::latest()->get();
        return view('admin.pages.productDesign.index', compact('productCategory', 'productDesign',
            'color', 'rawMaterialInfo'));
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
                $rawMaterial = RawMaterial::find($rawMaterialId);
                ProductDesignUseRawMaterial::create([
                    'product_design_id' => $productDesign->id,
                    'raw_material_id' => $rawMaterialId,
                    'quantity' => $quantity,
                    'per_unit_price' => $rawMaterial->raw_material_price,
                ]);
            }
        }
        Toastr::success('Product Design Add Successfully', 'Success');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_category_id' => 'required',
            'product_name' => 'required',
            'product_color_id' => 'required',
            'product_version' => 'required',
            'raw_material_id.*' => 'required|exists:raw_materials,id',
            'quantity.*' => 'required|numeric|min:1'
        ]);

        try {
            \DB::beginTransaction();

            $productDesign = ProductDesign::findOrFail($id);
            $productDesign->update([
                'product_category_id' => $request->product_category_id,
                'product_name' => $request->product_name,
                'product_color_id' => $request->product_color_id,
                'product_version' => $request->product_version,
                'status' => $request->status,
            ]);

            // Remove old raw material associations
            ProductDesignUseRawMaterial::where('product_design_id', $id)->delete();

            // Re-add the updated raw materials and quantities
            foreach ($request->raw_material_id as $index => $rawMaterialId) {
                $quantity = $request->quantity[$index];
                ProductDesignUseRawMaterial::create([
                    'product_design_id' => $id,
                    'raw_material_id' => $rawMaterialId,
                    'quantity' => $quantity,
                ]);
            }

            \DB::commit();
            Toastr::success('Product Design Updated Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            \DB::rollBack();
            Toastr::error('Failed to update product design. Error: ' . $e->getMessage(), 'Error');
            return redirect()->back()->with('error', 'Failed to update product design. Error: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            \DB::beginTransaction();

            $productDesign = ProductDesign::findOrFail($id);
            // Delete associated raw materials first
            ProductDesignUseRawMaterial::where('product_design_id', $id)->delete();

            // Then delete the product design itself
            $productDesign->delete();

            \DB::commit();
            Toastr::success('Product Design Deleted Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            \DB::rollBack();
            Toastr::error('Failed to delete product design. Error: ' . $e->getMessage(), 'Error');
            return redirect()->back()->with('error', 'Failed to delete product design. Error: ' . $e->getMessage());
        }
    }


}

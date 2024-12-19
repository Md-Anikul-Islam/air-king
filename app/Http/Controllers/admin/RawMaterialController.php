<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\RawMaterial;
use App\Models\RawMaterialSection;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yoeunes\Toastr\Facades\Toastr;

class RawMaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Gate::allows('raw-material-list')) {
                return redirect()->route('unauthorized.action');
            }
            return $next($request);
        })->only('index');
    }
    public function index()
    {
        $rawMaterialSection = RawMaterialSection::latest()->get();
        $supplier = Supplier::latest()->get();
        $rawMaterial = RawMaterial::latest()->get();
        return view('admin.pages.rawMaterial.index', compact('rawMaterial', 'rawMaterialSection', 'supplier'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'raw_material_section_id' => 'required',
                'raw_material_supplier_id' => 'required',
                'raw_material_name' => 'required',
                'raw_material_code' => 'required',
                'raw_material_unit' => 'required',
                'raw_material_price' => 'required',
            ]);
            $rawMaterial= new RawMaterial();
            $rawMaterial->raw_material_section_id = $request->raw_material_section_id;
            $rawMaterial->raw_material_supplier_id = $request->raw_material_supplier_id;
            $rawMaterial->raw_material_name = $request->raw_material_name;
            $rawMaterial->raw_material_code = $request->raw_material_code;
            $rawMaterial->raw_material_unit = $request->raw_material_unit;
            $rawMaterial->raw_material_price = $request->raw_material_price;
            $rawMaterial->raw_material_qty = $request->raw_material_qty;
            $rawMaterial->save();
            Toastr::success('Raw Material Section Added Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'raw_material_section_id' => 'required',
                'raw_material_supplier_id' => 'required',
                'raw_material_name' => 'required',
                'raw_material_code' => 'required',
                'raw_material_unit' => 'required',
                'raw_material_price' => 'required',
            ]);
            $rawMaterial = RawMaterial::find($id);
            $rawMaterial->raw_material_section_id = $request->raw_material_section_id;
            $rawMaterial->raw_material_supplier_id = $request->raw_material_supplier_id;
            $rawMaterial->raw_material_name = $request->raw_material_name;
            $rawMaterial->raw_material_code = $request->raw_material_code;
            $rawMaterial->raw_material_unit = $request->raw_material_unit;
            $rawMaterial->raw_material_price = $request->raw_material_price;
            $rawMaterial->raw_material_qty = $request->raw_material_qty;
            $rawMaterial->status = $request->status;
            $rawMaterial->save();
            Toastr::success('Raw Material Section Updated Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $rawMaterial = RawMaterial::find($id);
            $rawMaterial->delete();
            Toastr::success('Raw Material Section Deleted Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}

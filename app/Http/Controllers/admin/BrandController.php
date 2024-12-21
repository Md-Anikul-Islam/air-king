<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yoeunes\Toastr\Facades\Toastr;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Gate::allows('brand-section-list')) {
                return redirect()->route('unauthorized.action');
            }
            return $next($request);
        })->only('index');
    }
    public function index()
    {
        $brands = Brand::latest()->get();
        $page_title = 'Brands';
        return view('admin.pages.brand.index', compact('brands', 'page_title'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
            ]);
            $brand = new Brand();
            

            $filename = null;
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $filename = date('YmdHis') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/brand-logo'), $filename);
            }
            $brand->name = $request->name;
            $brand->logo = $filename;
            $brand->save();
            Toastr::success('Brand Added Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
            ]);
            $brand = Brand::find($id);
            if ($request->hasFile('logo')) {
                
                if ($brand->logo && file_exists(public_path('uploads/brand-logo/' . $brand->logo))) {
                    unlink(public_path('uploads/brand-logo/' . $brand->logo));
                }

                $file = $request->file('logo');
                $filename = date('YmdHis') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/brand-logo'), $filename);

                $brand->logo = $filename;
            }
            $brand->name = $request->name;
            $brand->status = $request->status;
            $brand->save();
            Toastr::success('Brand Updated Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $brand = Brand::find($id);
            $brand->delete();
            Toastr::success('Brand Section Deleted Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}

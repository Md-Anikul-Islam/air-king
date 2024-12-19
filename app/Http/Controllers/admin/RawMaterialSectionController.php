<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\RawMaterialSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yoeunes\Toastr\Facades\Toastr;

class RawMaterialSectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Gate::allows('raw-material-section-list')) {
                return redirect()->route('unauthorized.action');
            }
            return $next($request);
        })->only('index');
    }
    public function index()
    {
        $rawMaterialSection = RawMaterialSection::latest()->get();
        return view('admin.pages.rawMaterialSection.index', compact('rawMaterialSection'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
            ]);
            $rawMaterialSection= new RawMaterialSection();
            $rawMaterialSection->name = $request->name;
            $rawMaterialSection->save();
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
                'name' => 'required',
            ]);
            $rawMaterialSection = RawMaterialSection::find($id);
            $rawMaterialSection->name = $request->name;
            $rawMaterialSection->status = $request->status;
            $rawMaterialSection->save();
            Toastr::success('Raw Material Section Updated Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $rawMaterialSection = RawMaterialSection::find($id);
            $rawMaterialSection->delete();
            Toastr::success('Raw Material Section Deleted Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}

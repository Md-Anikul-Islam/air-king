<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yoeunes\Toastr\Facades\Toastr;

class UnitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Gate::allows('unit-section-list')) {
                return redirect()->route('unauthorized.action');
            }
            return $next($request);
        })->only('index');
    }
    public function index()
    {
        $units = Unit::latest()->get();
        $blocks = Block::latest()->get();
        $active_blocks = Block::where('status', 1)->latest()->get();
        $page_title = 'Unit';
        return view('admin.pages.unit.index', compact('blocks','active_blocks', 'units', 'page_title'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'block_id' => 'required',
            ]);
            $unit = new Unit();
            $unit->block_id = $request->block_id;
            $unit->name = $request->name;
            $unit->status = $request->status;
            $unit->save();
            Toastr::success('Unit Added Successfully', 'Success');
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
                'block_id' => 'required',
            ]);
            $unit = Unit::find($id);
            $unit->block_id = $request->block_id;
            $unit->name = $request->name;
            $unit->status = $request->status;
            $unit->save();
            Toastr::success('Unit Updated Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $unit = Unit::find($id);
            $unit->delete();
            Toastr::success('Unit Section Deleted Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}

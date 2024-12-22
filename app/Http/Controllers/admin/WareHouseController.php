<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Unit;
use App\Models\WareHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yoeunes\Toastr\Facades\Toastr;

class WareHouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Gate::allows('wareHouse-section-list')) {
                return redirect()->route('unauthorized.action');
            }
            return $next($request);
        })->only('index');
    }
    public function index()
    {
        $wareHouses = WareHouse::latest()->get();
        $units = Unit::where('status', 1)->latest()->get();
        $active_units = Unit::where('status', 1)->latest()->get();
        $blocks = Block::latest()->get();
        $active_blocks = Block::where('status', 1)->latest()->get();
        $page_title = 'Ware House';
        return view('admin.pages.wareHouse.index', compact('blocks','active_blocks', 'units', 'active_units', 'wareHouses', 'page_title'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'unit_id' => 'required',
                'block_id' => 'required',
                'cost' => 'required',
            ]);
            $wareHouse = new WareHouse();
            $wareHouse->block_id = $request->block_id;
            $wareHouse->unit_id = $request->unit_id;
            $wareHouse->name = $request->name;
            $wareHouse->cost = $request->cost;
            $wareHouse->save();
            Toastr::success('Warehouse Added Successfully', 'Success');
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
                'unit_id' => 'required',
                'block_id' => 'required',
                'cost' => 'required',
            ]);
            $wareHouse = WareHouse::find($id);
            $wareHouse->block_id = $request->block_id;
            $wareHouse->unit_id = $request->unit_id;
            $wareHouse->name = $request->name;
            $wareHouse->cost = $request->cost;
            $wareHouse->status = $request->status;
            $wareHouse->save();
            Toastr::success('Warehouse Updated Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function getUnits($block_id)
    {
        $units = Unit::where('block_id', $block_id)->where('status', 1)->get();
        return response()->json($units);
    }

    public function destroy($id)
    {
        try {
            $wareHouse = WareHouse::find($id);
            $wareHouse->delete();
            Toastr::success('Warehouse Section Deleted Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}

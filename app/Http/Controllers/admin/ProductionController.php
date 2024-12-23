<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Brand;
use App\Models\Customer;
use App\Models\ProductDesign;
use App\Models\ProductDesignUseRawMaterial;
use App\Models\Production;
use App\Models\RawMaterial;
use App\Models\SellProduction;
use App\Models\WareHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yoeunes\Toastr\Facades\Toastr;

class ProductionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Gate::allows('production-section-list')) {
                return redirect()->route('unauthorized.action');
            }
            return $next($request);
        })->only('index');
    }

    public function index()
    {
        $productions = Production::where('available_qty', '!=', 0)->latest()->get();
        $productDesigns = ProductDesign::latest()->get();
        $batches = Batch::where('is_completed', 0)->get();
        $brands = Brand::latest()->get();
        $wareHouses = WareHouse::latest()->get();
        $customers = Customer::latest()->get();
        return view('admin.pages.production.index', compact('productions', 'productDesigns', 'batches',
            'brands', 'wareHouses', 'customers'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'production_design_id' => 'required',
                'brand_id' => 'required',
                'unit_price' => 'required',
                'production_qty' => 'required',
            ]);
            $productions = new Production();
            $productions->production_design_id = $request->production_design_id;
            $productions->batch_id = $request->batch_id;
            $productions->brand_id = $request->brand_id;
            $productions->unit_price = $request->unit_price;
            $productions->production_qty = $request->production_qty;
            $productions->available_qty = $request->production_qty;
            $productions->production_status = 1;
            $productions->save();

            //same time also batches table  is_completed field update 1
            $batch = Batch::find($request->batch_id);
            $batch->is_completed = 1;
            $batch->save();

            Toastr::success('Production Added Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function change_status(Request $request, $id)
    {
        try {
            $request->validate([
                'production_status' => 'required',
            ]);
            $productions = Production::find($id);
            $productions->production_status = $request->production_status;

            if ($request->production_status == 2) {
                $productions->warehouse_id = $request->warehouse_id;
                $wareHouse = WareHouse::find($request->warehouse_id);
                $wareHouse->is_already_booked = 1;
                $wareHouse->save();
            } else if ($request->production_status == 3) {
                $productions->sell_qty += $request->sell_qty;
                $productions->available_qty = $request->available_qty - $request->sell_qty;

                if ($request->available_qty < $request->sell_qty) {
                    return redirect()->back()->with('error', 'Sell Quantity is greater than Production Quantity');
                }

                $sellProduction = new SellProduction();
                $sellProduction->production_id = $productions->id;
                $sellProduction->customer_id = $request->customer_id;
                $sellProduction->sell_qty = $request->sell_qty;
                $sellProduction->sell_date = date('Y-m-d');
                $sellProduction->unit_price = $productions->unit_price;
                $sellProduction->save();

                if ($productions->available_qty == 0) {
                    $wareHouse = WareHouse::find($productions->warehouse_id);
                    if ($wareHouse) {
                        $wareHouse->is_already_booked = 0;
                        $wareHouse->save();
                    }
                    $productions->warehouse_id = null;
                    $productions->save();
                }
            }


            $productions->save();


            Toastr::success('Production Added Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'production_design_id' => 'required',
                'brand_id' => 'required',
                'unit_price' => 'required',
                'production_qty' => 'required',
            ]);
            $productions = Production::find($id);
            $productions->production_design_id = $request->production_design_id;
            $productions->batch_id = $request->batch_id;
            $productions->brand_id = $request->brand_id;
            $productions->unit_price = $request->unit_price;
            $productions->production_qty = $request->production_qty;
            $productions->save();
            Toastr::success('Production Edited Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $production = Production::find($id);
            $production->delete();
            Toastr::success('Production Deleted Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}

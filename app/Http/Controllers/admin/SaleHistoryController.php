<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Production;
use App\Models\SellHistory;
use App\Models\SellProduction;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SaleHistoryController extends Controller
{

    public function saleHistory(Request $request)
    {
        // Retrieve all customers and products for the filters
        $customers = Customer::latest()->get();
        $products = Production::with('product_design','batch')->latest()->get();

        // Start building the query
        $saleQuery = SellProduction::with('production.product_design', 'customer');

        // Apply filters based on the request
        if ($request->has('customer_id') && $request->customer_id != '') {
            $saleQuery->where('customer_id', $request->customer_id);
        }

        if ($request->has('production_id') && $request->production_id != '') {
            $saleQuery->where('production_id', $request->production_id);
        }

        if ($request->has('start_date') && $request->start_date != '') {
            $saleQuery->where('sell_date', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date != '') {
            $saleQuery->where('sell_date', '<=', $request->end_date);
        }

        // Get the filtered sale records
        $sale = $saleQuery->latest()->get();

        // Calculate total amounts for both all sales and filtered sales
        $totalAmount = $sale->sum(function ($sale) {
            return $sale->production->unit_price * $sale->sell_qty;
        });

        // Get all sales for the default total amount
        $defaultSale = SellProduction::with('production.product_design', 'customer')->latest()->get();
        $defaultTotalAmount = $defaultSale->sum(function ($sale) {
            return $sale->production->unit_price * $sale->sell_qty;
        });

        return view('admin.pages.sale.sale', compact('sale', 'customers', 'products', 'totalAmount', 'defaultTotalAmount'));
    }

    public function invoice($id)
    {
        $sale = SellProduction::where('id', $id)->with('customer','production','sellHistory.sellProductions.production.product_design')->first();
        //dd($sale);
        $siteSetting = SiteSetting::latest()->first();
        return view('admin.pages.sale.invoice', compact('sale','siteSetting'));
    }





}

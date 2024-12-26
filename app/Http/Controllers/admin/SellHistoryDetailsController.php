<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SellHistory;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;

class SellHistoryDetailsController extends Controller
{
    public function index($id)
    {
        $sellHistoryDetails = SellHistory::where('sell_production_id', $id)->get();
        return view('admin.pages.sellHistoryDetails.index', compact('sellHistoryDetails'));
    }

    public function store(Request $request)
    {
        try {
            $lastSellHistory = SellHistory::where('sell_production_id', $request->sell_production_id)->latest()->first();
            $previousDue = $lastSellHistory ? $lastSellHistory->due : 0;
            $sellHistory = new SellHistory();
            $sellHistory->sell_production_id = $request->sell_production_id;
            $sellHistory->payment = $request->payment;
            $sellHistory->due = $previousDue - $request->payment;
            $sellHistory->save();
            Toastr::success('Sell History Added Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}

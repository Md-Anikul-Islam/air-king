<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yoeunes\Toastr\Facades\Toastr;

class BatchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Gate::allows('batch-section-list')) {
                return redirect()->route('unauthorized.action');
            }
            return $next($request);
        })->only('index');
    }
    public function index()
    {
        $batches = Batch::latest()->get();
        $page_title = 'Bathes';
        return view('admin.pages.batch.index', compact('batches', 'page_title'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'batch_no' => 'required',
            ]);
            $batch = new Batch();
            $batch->batch_no = $request->batch_no;
            $batch->batch_date = $request->batch_date;

            $batch->save();
            Toastr::success('Batch Added Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'batch_no' => 'required',
            ]);
            $batch = Batch::find($id);
            $batch->batch_no = $request->batch_no;
            $batch->batch_date = $request->batch_date;
            $batch->status = $request->status;
            $batch->save();
            Toastr::success('Batch Updated Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $batch = Batch::find($id);
            $batch->delete();
            Toastr::success('Batch Section Deleted Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}


<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Models\Expense;
use App\Models\ExpenseType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yoeunes\Toastr\Facades\Toastr;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Gate::allows('expense-section-list')) {
                return redirect()->route('unauthorized.action');
            }
            return $next($request);
        })->only('index');
    }
    public function index()
    {
        $expenses = Expense::latest()->get();
        $expenseType = ExpenseType::latest()->get();
        return view('admin.pages.expense.index', compact('expenses', 'expenseType'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
            ]);
            $expense = new Expense();
            $expense->expense_type_id = $request->expense_type_id	;
            $expense->name = $request->name;
            $expense->unit_type = $request->unit_type;
            $expense->qty = $request->qty;
            $expense->rate = $request->rate;
            $expense->save();
            Toastr::success('Expense Added Successfully', 'Success');
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
            $expense = Expense::find($id);
            $expense->expense_type_id = $request->expense_type_id	;
            $expense->name = $request->name;
            $expense->unit_type = $request->unit_type;
            $expense->qty = $request->qty;
            $expense->rate = $request->rate;
            $expense->status = $request->status;
            $expense->save();
            Toastr::success('Expense Updated Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $expense = Expense::find($id);
            $expense->delete();
            Toastr::success('Expense Section Deleted Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}

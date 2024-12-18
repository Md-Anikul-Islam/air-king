<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yoeunes\Toastr\Facades\Toastr;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Gate::allows('employee-list')) {
                return redirect()->route('unauthorized.action');
            }
            return $next($request);
        })->only('index');
    }
    public function index()
    {
        $employeeSection = EmployeeSection::latest()->get();
        $employee = Employee::with('employeeSection')->latest()->get();
        return view('admin.pages.employee.index', compact('employee', 'employeeSection'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'designation' => 'required',
                'joining_date' => 'required',
            ]);
            $employee = new Employee();
            $employee->employee_section_id = $request->employee_section_id;
            $employee->name = $request->name;
            $employee->designation = $request->designation;
            $employee->joining_date = $request->joining_date;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->address = $request->address;
            $employee->salary = $request->salary;
            $employee->save();
            Toastr::success('Employee Added Successfully', 'Success');
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
            $employee = Employee::find($id);
            $employee->employee_section_id = $request->employee_section_id;
            $employee->name = $request->name;
            $employee->designation = $request->designation;
            $employee->joining_date = $request->joining_date;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->address = $request->address;
            $employee->salary = $request->salary;
            $employee->status = $request->status;
            $employee->save();
            Toastr::success('Employee Updated Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $employee = Employee::find($id);
            $employee->delete();
            Toastr::success('Employee Deleted Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}

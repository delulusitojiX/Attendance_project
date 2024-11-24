<?php

namespace App\Http\Controllers\Admin;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|string|max:15',
            'position' => 'nullable|string|max:255',
            'department' => 'required|string|max:255',
            'start_date' => 'required|date',
        ]);
    
        // Generate a unique employee ID
        $employeeId = strtoupper('EMP' . uniqid());
    
        try {
            // Create the new employee
            $employee = Employee::create([
                'employee_id' => $employeeId,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'position' => $request->position,
                'department' => $request->department,
                'start_date' => $request->start_date,
            ]);
    
            // Return success message
            return redirect()->route('admin.employee')->with('success', 'Employee added successfully!');
        } catch (\Exception $e) {
            // Return error message if something goes wrong
            return back()->with('error', 'There was an issue creating the employee: ' . $e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'position' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
        ]);
    
        $employee = Employee::findOrFail($id);
        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'position' => $request->position,
            'department' => $request->department,
        ]);
    
        return redirect()->back()->with('success', 'Employee updated successfully!');
    }
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('admin.employee')->with('success', 'Employee deleted successfully!');
    }
}

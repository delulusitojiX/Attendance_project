<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttendanceController extends Controller
{
    public function index()
    {
     $attendances = Attendance::with('employee')->get();

        return view('admin.attendance', compact('attendances'));
    }

    public function store(Request $request)
{
    // Validate the input
    $request->validate([
        'employee' => 'required|exists:employees,employee_id',  // Ensure employee exists in the DB
        'status' => 'required|in:in,out',  // Validating the status is either 'in' or 'out'
    ]);

    // Create or update the attendance record
    $attendance = Attendance::firstOrCreate(
        ['employee_id' => $request->employee, 'date' => Carbon::today()->toDateString()],
        ['status' => $request->status]
    );

    // Update the time-in or time-out based on the status
    if ($attendance->status == 'in' && $request->status == 'in') {
        $attendance->time_in = Carbon::now()->format('H:i:s');
    } elseif ($attendance->status == 'out' && $request->status == 'out') {
        $attendance->time_out = Carbon::now()->format('H:i:s');
    }

    $attendance->save();

    // Retrieve the employee name using the relationship
    $employeeName = $attendance->employee ? $attendance->employee->name : 'Unknown Employee';

    // Return the response including the employee's name
    return response()->json([
        'message' => 'Attendance recorded successfully',
        'employee_name' => $employeeName,  // Include the employee's name
    ]);
}


}

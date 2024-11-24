<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEmployees = Employee::count();
        $attendancePercentage = Attendance::where('status', 'in')->count() / Attendance::count() * 100;
        $checkedInToday = Attendance::where('date', Carbon::today())->where('status', 'in')->count();
        $checkedOutToday = Attendance::where('date', Carbon::today())->where('status', 'out')->count();
    
        return view('admin.home', compact('totalEmployees', 'attendancePercentage', 'checkedInToday', 'checkedOutToday'));
    }

    public function getAttendanceData(Request $request) {
        $year = $request->year;
    
        $checkedInData = $this->getCheckedInData($year);
        $checkedOutData = $this->getCheckedOutData($year);
    
        return response()->json([
            'checkedInData' => $checkedInData,
            'checkedOutData' => $checkedOutData,
        ]);
    }
}
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Center text in table header and cells */
        #employeeTable th, #employeeTable td {
            text-align: center;
        }
    </style>
</head>
<body>
    
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="logo-details">
        <i class='bx bxl-d-plus-plus icon'></i>
        <i class='bx bx-menu' id="btn"></i> <!-- Menu button to toggle sidebar -->
    </div>
    <ul>
        <li>
            <a href="{{route('admin.home')}}">
                <i class='bx bx-grid-alt'></i>
                <span class="links_name">Dashboard</span>
            </a>
            <span class="tooltip">Dashboard</span>
        </li>
        <li>
            <a href="{{route('admin.attendance')}}">
                <i class='bx bx-folder'></i>
                <span class="links_name">Attendance</span>
            </a>
            <span class="tooltip">Attendance</span>
        </li>
        <li>
            <a href="{{route('admin.employee')}}">
                <i class='bx bx-user'></i>
                <span class="links_name">Employee</span> 
            </a>
            <span class="tooltip">Employee</span>
        </li>
        <!-- Profile section -->
        <li class="profile">
            <div class="profile-details">
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <div class="job">LOGOUT</div>
                    <button type="submit" class="btn btn-link">
                        <i class='bx bx-log-out' id="log_out"></i> Logout
                    </button>
                </form>
            </div>
        </li>
    </ul>
  </div>
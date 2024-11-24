<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
      /* Center text in table header and cells */
      #example1 th, #example1 td {
          text-align: center;
      }
  </style> 
</head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <!-- Icon and logo name -->
      <i class='bx bxl-d-plus-plus icon'></i>
     
      <i class='bx bx-menu' id="btn"></i> <!-- Menu button to toggle sidebar -->
    </div>

      <!-- List of navigation items -->
      <li>
        <a href="{{route('admin.home')}}">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
        <span class="tooltip">Dashboard</span>
      </li>
      <!-- Additional navigation items -->
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
          <!--<img src="profile.jpg" alt="profileImg">-->
          <div class="name_job">
            <div class="name"></div>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
    @csrf
            <P></P>
            <div class="job">LOGOUT</div>
          </div>
        </div>
    <button type="submit" class="btn btn-link">
        <i class='bx bx-log-out' id="log_out"></i> Logout
    </button>
    </form> <!-- Logout icon -->

      </a>
      </li>
    </ul>
  </div>
  <!-- Main content area -->
  <section class="home-section">
    <div class="content-wrapper">
      <section class="content-header">
          <h1>Attendance</h1>
 
      </section>
      <section class="content">
          <div class="alert alert-danger alert-dismissible" style="display: none;">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-warning"></i> Error!</h4>
              <span id="error-message"></span>
          </div>
          <div class="alert alert-success alert-dismissible" style="display: none;">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-check"></i> Success!</h4>
              <span id="success-message"></span>
          </div>
          <div class="box">
              <div class="box-header with-border">
                  <div class="pull-right">
                      <form method="POST" class="form-inline" id="payForm">
                          <div class="input-group">
                              <div class="input-group-addon">
                                 
                              </div>
                              <P>
                              <input type="date" class="form-control pull-right col-sm-10" id="reservation" name="date_range" value="Date Range">
                            </P>
                          </div>
                          <P>
                          <button type="button" class="btn btn-success btn-sm btn-flat" id="print_attend"><span class="glyphicon glyphicon-print"></span> Attendance</button>
                        </P>
                      </form>
                  </div>
              </div>
              <div class="box-body">
                <table id="example1" class="table table-striped table-bordered">
                  <thead>
                      <tr>
                          <th class="d-none"></th>
                          <th>DATE</th>
                          <th>EMPLOYEE ID</th>
                          <th>FULL NAME</th>
                          <th>TIME IN</th>
                          <th>TIME OUT</th>
                      </tr>
                  </thead>
                  <tbody>
                      <!-- Example row, replace with dynamic content as needed -->
                      @foreach ($attendances as $attendance)
                      <tr>
                          <td>{{ $attendance->date }}</td>
                          <td>{{ $attendance->employee_id }}</td>
                          <td>{{ $attendance->employee->name }}</td>
                          <td>{{ $attendance->time_in ?? 'N/A' }}</td>
                          <td>{{ $attendance->time_out ?? 'N/A' }}</td>
                      </tr>
                @endforeach
                  </tbody>
              </table>
              </div>
          </div>
      </section>
  </div>
  </section>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  

    <script>
       // Get the sidebar, close button, and search button elements
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#btn");
    let searchBtn = document.querySelector(".bx-search");
    let navList = document.querySelector(".nav-list");

    // Event listener for the menu button to toggle the sidebar open/close
    closeBtn.addEventListener("click", () => {
      sidebar.classList.toggle("open"); // Toggle the sidebar's open state
      navList.classList.toggle("scroll"); // Toggle scroll state
      menuBtnChange(); // Call function to change button icon
    });

    // Event listener for the search button to open the sidebar
    searchBtn.addEventListener("click", () => {
      sidebar.classList.toggle("open");
      navList.classList.toggle("scroll");
      menuBtnChange(); // Call function to change button icon
    });

    // Function to change the menu button icon
    function menuBtnChange() {
      if (sidebar.classList.contains("open")) {
        closeBtn.classList.replace("bx-menu", "bx-menu-alt-right"); // Change icon to indicate closing
      } else {
        closeBtn.classList.replace("bx-menu-alt-right", "bx-menu"); // Change icon to indicate opening
      }
    }
    </script>
</body>
</html>

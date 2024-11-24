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
    <button type="submit" class="btn btn-link">
        <i class='bx bx-log-out' id="log_out"></i> Logout
    </button>
</form> <!-- Logout icon -->

      </a>
      </li>
    </ul>
  </div>
  <section class="home-section">
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Dashboard</h1>
        </section>
  
      <!-- Main content -->
      <section class="content">
        
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
              <h3>{{ $totalEmployees }}</h3> 
  
                <p>Total Employee</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-stalker"></i>
              </div>
              <a href="employee.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
              <h3>{{ number_format($attendancePercentage, 2) }}%</h3> 
            
                <p>Attendance Percentage</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="attendance.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
              <h3>{{ $checkedInToday }}</h3>
               
                <p>Checked In Today</p>
              </div>
              <div class="icon">
                <i class="ion ion-clock"></i>
              </div>
              <a href="attendance.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
              <h3>{{ $checkedOutToday }}</h3>
  
                <p>Checked Out Today</p>
              </div>
              <div class="icon">
                <i class="ion ion ion-clock"></i>
              </div>
              <a href="attendance.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <div class="row main-content">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Monthly Attendance Report</h3>
                <div class="box-tools pull-right">
                  <form class="form-inline">
                    <div class="form-group">
                      <label>Select Year: </label>
                      <select class="form-control ml-2" id="select_year">
                      <option value="2024" selected>2024</option>
                      <option value="2025">2025</option>
                    </select>
                    </div>
                  </form>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart" style="height: 350px; width: 1500px;"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
  
        </section>
        <!-- right col -->
      </div>
  </section>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
      document.addEventListener("DOMContentLoaded", function() {
      var ctx = document.getElementById('barChart').getContext('2d');
      var chart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          datasets: [{
            label: 'Checked In',
            backgroundColor: '#DA3330',
            borderColor: '#3c0cbc',
            data: [10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 110, 120]
          }, {
            label: 'Checked Out',
            backgroundColor: '#E89C1E',
            borderColor: '#00a65a',
            data: [5, 15, 25, 35, 45, 55, 65, 75, 85, 95, 105, 115]
          }]
        },
        options: {
          responsive: true,
          legend: {
            display: true,
            position: 'top',
          },
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
      });

      document.getElementById('select_year').addEventListener('change', function() {
    var year = this.value;

    $.ajax({
        url: '/attendance-data',  // Replace with the correct route
        type: 'GET',
        data: { year: year },
        success: function(response) {
            // Update the chart with new data
            chart.data.datasets[0].data = response.checkedInData;
            chart.data.datasets[1].data = response.checkedOutData;
            chart.update();
        }
    });
});

     
    });
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

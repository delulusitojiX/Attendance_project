<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
      /* Center text in table header and cells */
      #employeeTable th, #employeeTable td {
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

<section class="home-section">
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Employee</h1>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <div>
                        <p><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addEmployeeModal">
                            <i class="fa fa-user-plus"></i> Add Employee
                        </button></p>
                    </div>
                </div>
                <div class="box-body">
                    <table id="employeeTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>name</th>
                                <th>email</th>
                                <th>phone</th>
                                <th>position</th>
                                <th>department</th>
                                <th>start_date</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
    @foreach ($employees as $employee)
        <tr>
            <td>{{ $employee->name }}</td>
            <td>{{ $employee->email }}</td>
            <td>{{ $employee->phone }}</td>
            <td>{{ $employee->position }}</td>
            <td>{{ $employee->department }}</td>
            <td>{{ $employee->start_date }}</td>
            <td>
            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editEmployeeModal"
                    data-id="{{ $employee->id }}"
                    data-name="{{ $employee->name }}"
                    data-email="{{ $employee->email }}"
                    data-phone="{{ $employee->phone }}"
                    data-position="{{ $employee->position }}"
                    data-department="{{ $employee->department }}"
                    data-start_date="{{ $employee->start_date }}">
                    <i class="fa fa-edit"></i> Edit
                </button>
                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</section>


<!-- Add Employee Modal -->
<div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addEmployeeForm" action="{{ route('employees.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addEmployeeModalLabel">Add Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Full Name -->
                    <div class="form-group">
                        <label for="employeeName">Full Name</label>
                        <input type="text" class="form-control" id="employeeName" name="employeeName" required>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <!-- Phone -->
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>

                    <!-- Position -->
                    <div class="form-group">
                        <label for="position">Position</label>
                        <input type="text" class="form-control" id="position" name="position">
                    </div>

                    <!-- Department -->
                    <div class="form-group">
                        <label for="department">Department</label>
                        <select class="form-control" id="department" name="department">
                            <option value="HR">HR</option>
                            <option value="Finance">Finance</option>
                            <option value="Engineering">Engineering</option>
                        </select>
                    </div>

                    <!-- Start Date -->
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Employee</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Employee Modal -->
<div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('employees.update', '') }}" method="POST">
                @csrf
                @method('PUT') <!-- Specifies the request method as PUT -->
                
                <!-- Hidden field to store employee id -->
                <input type="hidden" id="editEmployeeId" name="employeeId">

                <!-- Full Name -->
                <div class="form-group">
                    <label for="editEmployeeName">Full Name</label>
                    <input type="text" class="form-control" id="editEmployeeName" name="employeeName" required>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="editEmail">Email</label>
                    <input type="email" class="form-control" id="editEmail" name="email" required>
                </div>

                <!-- Phone -->
                <div class="form-group">
                    <label for="editPhone">Phone</label>
                    <input type="text" class="form-control" id="editPhone" name="phone" required>
                </div>

                <!-- Position -->
                <div class="form-group">
                    <label for="editPosition">Position</label>
                    <input type="text" class="form-control" id="editPosition" name="position" required>
                </div>

                <!-- Department -->
                <div class="form-group">
                    <label for="editDepartment">Department</label>
                    <select class="form-control" id="editDepartment" name="department">
                        <option value="HR">HR</option>
                        <option value="Finance">Finance</option>
                        <option value="Engineering">Engineering</option>
                    </select>
                </div>

                <!-- Start Date -->
                <div class="form-group">
                    <label for="editStartDate">Start Date</label>
                    <input type="date" class="form-control" id="editStartDate" name="start_date" required>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


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

    $('#editEmployeeModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);  // Button that triggered the modal
    var employeeId = button.data('id');
    var employeeName = button.data('name');
    var employeeEmail = button.data('email');
    var employeePhone = button.data('phone');
    var employeePosition = button.data('position');
    var employeeDepartment = button.data('department');
    var employeeStartDate = button.data('start_date');

    var modal = $(this);
    modal.find('.modal-body #editEmployeeId').val(employeeId);
    modal.find('.modal-body #editEmployeeName').val(employeeName);
    modal.find('.modal-body #editEmail').val(employeeEmail);
    modal.find('.modal-body #editPhone').val(employeePhone);
    modal.find('.modal-body #editPosition').val(employeePosition);
    modal.find('.modal-body #editDepartment').val(employeeDepartment);
    modal.find('.modal-body #editStartDate').val(employeeStartDate);
});
    </script>

</body>
</html>

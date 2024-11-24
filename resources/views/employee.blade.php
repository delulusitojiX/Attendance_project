<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DMKR Attendance System</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- FontAwesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="hold-transition register-page">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="text-center">
          <img src="{{ asset('img/logo.png') }}" alt="Avatar" class="img-fluid mb-4">
        </div>

        <div class="card">
          <div class="card-body">
            <h4 class="card-title text-center" style="font-weight: bold; color: #3D6245; font-size: 20px;">DMKR ATTENDANCE SYSTEM</h4>

            <form id="attendance" class="mt-4" action="{{ route('attendance.store') }}" method="POST">
            @csrf
            <div class="form-group">
              <select class="form-control" name="status" id="status">
                <option value="in">TIME IN</option>
                <option value="out">TIME OUT</option>
              </select>
            </div>

            <div class="form-group has-feedback">
              <input type="text" class="form-control form-control-lg" id="employee" name="employee" placeholder="EMPLOYEE ID" required>
              <span class="fas fa-calendar form-control-feedback"></span>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <button type="submit" class="btn btn-primary btn-block" id="checkButton"><i class="fas fa-sign-in-alt"></i> CHECK</button>
              </div>
            </div>
          </form>
          </div>
        </div>

        <div class="text-center mt-4">
          <p id="date" style="color: #3D6245; font-size: 16px;"></p>
          <p id="time" class="bold" style="font-size: 18px; font-weight: bold;"></p>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    function handleCheckIn() {
  var status = document.getElementById('status').value;
  var employee = document.getElementById('employee').value;

  if (employee.trim() !== '') {
      console.log('Sending data:', {
          _token: '{{ csrf_token() }}',
          employee: employee,
          status: status
      });  // This will log the data being sent

      $.ajax({
          url: '{{ route("attendance.store") }}',  // Use the route helper here
          method: 'POST',
          data: {
              _token: '{{ csrf_token() }}',
              employee: employee,
              status: status
          },
          success: function(response) {
              Swal.fire({
                  icon: 'success',
                  title: status === 'in' ? 'Check-In Successful' : 'Check-Out Successful',
                  text: 'Employee ID: ' + employee,
              });
          },
          error: function(response) {
              Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: 'Could not process the attendance.',
              });
              console.error(response);  // Log the error response
          }
      });
  } else {
      Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Please enter a valid Employee ID.',
      });
  }
}
  </script>
</body>
</html>

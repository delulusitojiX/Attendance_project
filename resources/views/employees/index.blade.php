<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

@include('partials.sidebar')

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
                                <th>employee ID</th>
                                <th>name</th>
                                <th>email</th>
                                <th>phone</th>
                                <th>position</th>
                                <th>department</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($employees as $employee)
                                <tr>
                                <td>{{ $employee->employee_id }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->phone }}</td>
                                <td>{{ $employee->position }}</td>
                                <td>{{ $employee->department }}</td>
                                <td>
                                    <!-- Edit Button -->
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editEmployeeModal{{ $employee->id }}" 
                                        data-id="{{ $employee->id }}"
                                        data-name="{{ $employee->name }}"
                                        data-email="{{ $employee->email }}"
                                        data-phone="{{ $employee->phone }}"
                                        data-position="{{ $employee->position }}"
                                        data-department="{{ $employee->department }}"
                                        data-start_date="{{ $employee->start_date }}">Edit</button>
                                    
                                    <!-- Delete Form -->
                                    <form action="{{ route('employees.destroy', $employee) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                                </tr>
                                
                                <!-- Edit Modal for each employee -->
                                <div class="modal fade" id="editEmployeeModal{{ $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="editEmployeeLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('employees.update', $employee) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editEmployeeLabel">Edit Employee</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="text" name="name" class="form-control" id="editName{{ $employee->id }}" value="{{ $employee->name }}" required>
                                                    <input type="email" name="email" class="form-control mt-2" id="editEmail{{ $employee->id }}" value="{{ $employee->email }}" required>
                                                    <input type="text" name="phone" class="form-control mt-2" id="editPhone{{ $employee->id }}" value="{{ $employee->phone }}" required>
                                                    <input type="text" name="position" class="form-control mt-2" id="editPosition{{ $employee->id }}" value="{{ $employee->position }}" required>
                                                    <select class="form-control mt-2" name="department" id="editDepartment{{ $employee->id }}">
                                                        <option value="HR" {{ $employee->department == 'HR' ? 'selected' : '' }}>HR</option>
                                                        <option value="Finance" {{ $employee->department == 'Finance' ? 'selected' : '' }}>Finance</option>
                                                        <option value="Engineering" {{ $employee->department == 'Engineering' ? 'selected' : '' }}>Engineering</option>
                                                    </select>
                                                    <input type="date" name="start_date" class="form-control mt-2" id="editStartDate{{ $employee->id }}" value="{{ $employee->start_date }}" required>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</section>

<!-- Add Employee Modal -->
<div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('employees.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Employee</h5>
                </div>
                <div class="modal-body">
                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                    <input type="email" name="email" class="form-control mt-2" placeholder="Email" required>
                    <input type="text" name="phone" class="form-control mt-2" placeholder="Phone" required>
                    <input type="text" name="position" class="form-control mt-2" placeholder="Position" required>
                    <select class="form-control" id="department" name="department">
                        <option value="HR">HR</option>
                        <option value="Finance">Finance</option>
                        <option value="Engineering">Engineering</option>
                    </select>
                    <input type="date" class="form-control mt-2" id="start_date" name="start_date" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // JavaScript to pre-fill the Edit modal with the employee's information
    $('#editEmployeeModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var name = button.data('name');
        var email = button.data('email');
        var phone = button.data('phone');
        var position = button.data('position');
        var department = button.data('department');
        var start_date = button.data('start_date');

        var modal = $(this);
        modal.find('#editName' + id).val(name);
        modal.find('#editEmail' + id).val(email);
        modal.find('#editPhone' + id).val(phone);
        modal.find('#editPosition' + id).val(position);
        modal.find('#editDepartment' + id).val(department);
        modal.find('#editStartDate' + id).val(start_date);
    });
</script>

</body>
</html>

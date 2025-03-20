<x-slot:title>Employee Management</x-slot:title>

<div class="flex flex-column container">
    <h1 class="text-white">Employee Management</h1>
    
    <div class="table-responsive">
        <table id="kt_datatable_zero_configuration" class="table table-row-bordered gy-5">
            <thead>
                <tr class="fw-semibold fs-6 text-muted">
                    <th>No</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $data as $index =>  $employee)
                    
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->position }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td>{{ $employee->address }}</td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
       
        </table>
    </div>
</div>

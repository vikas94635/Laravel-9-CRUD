<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LARAVEL 9 CRUD</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
</head>
<body>
    
    <div class="bg-dark py-3">
        <div class="container">
            <div class="h4 text-white">Vikas Web Developer</div>
        </div>
    </div>
    <div class="container ">
        <div class="d-flex justify-content-between py-3">
            <div class="h5">Employee</div>
            <div>
                <a href="{{ route('employees.create') }}" class="btn btn-primary">Create</a>
            </div>
        </div>
        @if(Session::has('Success'))
            <div class="alert alert-success">
                {{ Session::get('Success') }}
            </div>
        @endif
        <div class="card border-0 shadow-lg">
            <div class="card body">
                <table class="table table-striped">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                    {{-- foreach loop --}}
                    @if($employees->isNotEmpty())
                    @foreach ($employees as $employee )
                    <tr valign="middle">
                        <td>{{ $employee->id }}</td>
                        <td>
                            @if ($employee->image != '' && file_exists(public_path().'/uploads/employees/'.$employee->image))
                                <img src="{{ url('uploads/employees/'.$employee->image) }}" alt="image" width="40" height="40" class="rounded-circle">
                                @else
                                <img src="{{ url('assets/images/no-image.png') }}" alt="image" width="40" height="40" class="rounded-circle">
                            @endif
                        </td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->address }}</td>
                        <td class="d-flex">
                            <a href="{{ route('employees.edit',$employee->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            {{-- <a href="{{ route('employees.destory',$employee->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-primary btn-sm">Delete</a> --}}
                            
                            <form action="{{ route('employees.destroy',$employee->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                  
                    @else
                    <tr>
                        <td colspan="6">Record Not Found</td>
                    </tr>
                    @endif
                </table>
            </div>
            
        </div>
     {{-- Pagination --}}
    <div class="mt-3">
        {{ $employees->links() }}
    </div>
     
    </div>
</body>
</html>

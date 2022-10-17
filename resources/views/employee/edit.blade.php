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
            <div class="h5">Edit Employee</div>
            <div>
                <a href="{{ route('employees.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <form action="{{ route('employees.update',$employee->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
        <div class="card border-0 shadow-lg">
            <div class="card body">
                <div class="my-2 mx-3">
                    <label for="name" class="form-lable">Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter Name" value="{{ old('name',$employee->name) }}" class="form-control @error('name') is-invalid 
                    
                    @enderror">
                    @error('name')
                     <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                    
                </div>
                <div class="my-2 mx-3">
                    <label for="email" class="form-lable">Email</label>
                    <input type="text" name="email" id="email" placeholder="Enter email" value="{{ old('email',$employee->email) }}" class="form-control @error('email') is-invalid
                    @enderror">
                    @error('email')
                    <p class="invalid-feedback"> {{ $message }}</p>
                   @enderror
                   
                </div>
                <div class="my-2 mx-3">
                    <label for="address" class="form-lable">Address</label>
                    <textarea name="address" id="address" cols="30" rows="4"  placeholder="Enter Address" class="form-control"> {{ old('address',$employee->address) }}</textarea>
                </div>
                <div class=" my-2 mx-3">
                    <label for="image" class="form-lable"></label>
                    <input type="file" name="image"    value="{{ old('image',$employee->image) }}"  class="@error('image') is-invalid @enderror">
                   
                     @error('image')
                    <p class="invalid-feedback"> {{ $message }}</p>
                    @enderror

                    @if ($employee->image != '' && file_exists(public_path().'/uploads/employees/'.$employee->image))
                    <img src="{{ url('uploads/employees/'.$employee->image) }}" alt="image" width="100" height="100" >
                    
                @endif
                </div>
            </div>
            
        </div>
        <button class="btn btn-primary my-3" >Update Employee</button>
    </form>
    </div>
   
</body>
</html>
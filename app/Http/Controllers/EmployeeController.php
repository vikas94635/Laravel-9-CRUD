<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;




class EmployeeController extends Controller
{
    public function index(){
      $employees = Employee::orderBy('id','ASC')->paginate(5);
        return view('employee.list',['employees' => $employees]);
    }

    public function create()
    {
        return view('employee.create');
    }

    public function store(Request $request )
    {
      $validator = Validator::make($request->all(),[
        'name' => 'required',
        'email' => 'required',
        'image' =>'sometimes|image:gif,png,jpeg,'
      ]);

      if($validator->passes()){
        // save data here
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->address = $request->address;
        $employee->save();

        // Upload Image

        if
        ($request->image){
          $ext = $request->image->getClientOriginalExtension();
          $newFileName = time().'.'.$ext;
          $request->image->move(public_path().'/uploads/employees/',$newFileName);  // this will save file in public folder 
          $employee->image = $newFileName;
          $employee->save();

        }

    //    $request->$request->session()->flash('Employee added succesfully', $employee);
         Session::flash('Success','Employee added succesfully.');
         return redirect()->route('employees.index');

        
      }else{
        // return with errors


        return redirect()->route('employees.create')->withErrors($validator)->withInput();
      }

    }

    public function edit($id)
    {

      $employee = Employee::findOrFail($id);

    
      return view('employee.edit',['employee' => $employee]);
    }

    public function update($id, Request $request)
    {
      $validator = Validator::make($request->all(),[
        'name' => 'required',
        'email' => 'required',
        'image' =>'sometimes|image:gif,png,jpeg,'
      ]);

      if($validator->passes()){
        // save data here
        $employee = Employee::find($id);
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->address = $request->address;
        $employee->save();

        // Upload Image

        if
        ($request->image){
          $oldImage = $employee->image;
          $ext = $request->image->getClientOriginalExtension();
          $newFileName = time().'.'.$ext;
          $request->image->move(public_path().'/uploads/employees/',$newFileName);  // this will save file in public folder 
          $employee->image = $newFileName;
          $employee->save();

          File::delete(public_path().'/uploads/employees/'.$oldImage);

        }

    //    $request->$request->session()->flash('Employee added succesfully', $employee);
         Session::flash('Success','Employee added succesfully.');
         return redirect()->route('employees.index');

        
      }else{
        // return with errors


        return redirect()->route('employees.edit',$id)->withErrors($validator)->withInput();
      }

    }

    public function destroy($id, Request $request)
    {
      // dd($id);
        $employee = Employee::find($id);
        File::delete(public_path().'/uploads/employees/'.$employee->image);
        $employee->delete();

        Session::flash('Success','Employee deleted succesfully.');
        return redirect()->route('employees.index');
    }
   
}
  
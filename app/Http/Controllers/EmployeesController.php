<?php

namespace App\Http\Controllers;

use App\Model\Employee;
use App\Model\Salary;
use App\Model\User;
use App\Model\Presence;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{

    /**
     * Display a listing of thE resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role', 20)->get();
        return view('employees.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'=>'required',
            'username'=>'required|unique:users,username',
            'password'=>'required|min:5',
            'email'=>'required|unique:users,email|email:rfc,dns',
            'alamat'=>'required',
            'phone_number'=>'required|unique:employees,phone_number|numeric|digits_between:10,14',
            'gaji_pokok_employee'=>'required|numeric',
            'uang_makan_employee'=>'required|numeric'
        ]);

        $data = $request->all();
        $employee = Employee::create($data);
        
        $data['username'] = strtolower($request->username);
        $data['password'] = bcrypt($request->password);
        $data['nama'] = ucwords(strtolower($request->nama));
        $data['email'] = strtolower($request->email);
        $data['user_id'] = $employee->id;

        $user = User::create($data);

        return redirect('/data-employees/employees')->with('success', 'Employee saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('user_id', $id)->first();
        return view('employees.edit', compact('user')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    // update still problem
    public function update(Request $request, $id)
    {
        $user = User::where('user_id', $id)->first();

        $request->validate([
            'nama'=>'required',
            'username'=>'required|unique:users,username,'.$user->id,
            'password' => 'nullable|min:5',
            'email'=>'required|email:rfc,dns|unique:users,email,'.$user->id,
            'alamat'=>'required',
            'phone_number'=>'required|numeric|digits_between:10,14|unique:employees,phone_number,'.$id,
            'gaji_pokok_employee'=>'required|numeric',
            'uang_makan_employee'=>'required|numeric'
        ]);

        $data = $request->all();
        $employee = Employee::find($id)->update($data);

        $data = $request->except(['_token', '_method', 'alamat', 'phone_number', 'gaji_pokok_employee', 'uang_makan_employee', 'password']);

        $data['username'] = strtolower($request->username);
        $data['nama'] = ucwords(strtolower($request->nama));
        $data['email'] = strtolower($request->email);
        if($request->get('password')!=''){
            $data['password'] = bcrypt($request->get('password'));
        }

        $user->update($data);

        return redirect('/data-employees/employees')->with('success', 'Employee updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $salary = Salary::where('user_id', $id);
        $user = User::where('user_id', $id)->first();
        $presence = Presence::where('user_id', $user->id);
        $employee->delete();
        $salary->delete();
        $user->delete();
        $presence->delete();

        return redirect('/data-employees/employees')->with('success', 'Employees deleted!');
    }

    public function absent(Request $request)
    {
        $presences = Presence::where('tanggal', $request->get('tanggal'))->get();
        return view('employees.absent', compact('presences'));
    }

    // employee view controller

    public function cekData()
    {
        return view('show_employee.cek_data');
    }

    public function cekGaji()
    {
        $salaries = Salary::where('user_id', \Auth::user()->user_id)->latest()->get();
        return view('show_employee.cek_gaji', compact('salaries'));
    }

    public function detailGaji($id)
    {
        $salary = Salary::find($id);
        return view('show_employee.detail_gaji', compact('salary'));
    }

    public function editEmployee($id)
    {
        $user = User::find($id);
        return view('employees.edit_employee', compact('user')); 
    }

    public function updateEmployee(Request $request, $id)
    {
        $request->validate([
            'nama'=>'required',
            'username'=>'required|unique:users,username,'.$id,
            'password' => 'nullable|min:5',
            'email'=>'required|email:rfc,dns|unique:users,email,'.$id,
            'alamat'=>'required',
            'phone_number'=>'required|numeric|digits_between:10,14|unique:employees,phone_number',
            'gaji_pokok_employee'=>'required|numeric',
            'uang_makan_employee'=>'required|numeric'
        ]);

        $data = $request->all();
        $employee = Employee::create($data);

        $data = $request->except(['_token', '_method', 'alamat', 'phone_number', 'gaji_pokok_employee', 'uang_makan_employee', 'password']);

        $data['username'] = strtolower($request->username);
        $data['nama'] = ucwords(strtolower($request->nama));
        $data['email'] = strtolower($request->email);
        $data['user_id'] = $employee->id;
        if($request->get('password')!=''){
            $data['password'] = bcrypt($request->get('password'));
        }

        $user = User::find($id)->update($data);

        return redirect('/data-employees/employees')->with('success', 'Employee updated!');
    }

    public function destroyEmployee($id)
    {
        $user = User::find($id);
        $salary = Salary::where('user_id', $user->user_id);
        $presence = Presence::where('user_id', $id);
        $salary->delete();
        $user->delete();
        $presence->delete();

        return redirect('/data-employees/employees')->with('success', 'Employees deleted!');
    }

}

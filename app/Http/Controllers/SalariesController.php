<?php

namespace App\Http\Controllers;

use App\Model\Salary;
use App\Model\Employee;
use App\Model\User;
use App\Model\Deduction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PDF;

class SalariesController extends Controller
{
    protected $months = [
        "January" => "January",
        "February" => "February",
        "March" => "March",
        "April" => "April",
        "May" => "May",
        "June" => "June",
        "July" => "July",
        "August" => "August",
        "September" => "September",
        "October" => "October",
        "November" => "November",
        "December" => "December"
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role', 20)->get();
        return view('salaries.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'bonus'=>'required|numeric',
            'potongan_lain'=>'required|numeric'
        ]);

        $data = $request->all();
        $data['gaji_kotor'] = $request->gaji_pokok_salary + $request->uang_makan_salary + $request->bonus;
        $data['pph'] = $request->pph_percentage / 100 * $data['gaji_kotor'];
        $data['bpjs'] = $request->bpjs_percentage / 100 * $data['gaji_kotor'];
        $data['gaji_bersih'] =  $data['gaji_kotor'] - $data['pph'] - $data['bpjs'] - $request->potongan_lain;

        $salary = Salary::create($data);

        return redirect()->back()->with('success', 'Salary saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $months = $this->months;
        $deduction = Deduction::find(1);
        $user = User::where('user_id', $id)->first();
        $salary = Salary::where('user_id', $id)->where('month', $request->get('month'))->where('year', $request->get('year'))->first();
        return view('salaries.show', ['user' => $user, 'salary' => $salary, 'months' => $months, 'deduction' => $deduction]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function edit(Salary $salary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'bonus'=>'required|numeric',
            'potongan_lain'=>'required|numeric'
        ]);

        $data = $request->except(['_token', '_method']);
        $data['gaji_kotor'] = $request->gaji_pokok_salary + $request->uang_makan_salary + $request->bonus;
        $data['pph'] = $request->pph_percentage / 100 * $data['gaji_kotor'];
        $data['bpjs'] = $request->bpjs_percentage / 100 * $data['gaji_kotor'];
        $data['gaji_bersih'] =  $data['gaji_kotor'] - $data['pph'] - $data['bpjs'] - $request->potongan_lain;

        Salary::where('id', $id)->update($data);

        return redirect()->back()->with('success', 'Salary Employee updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salary $salary)
    {
        //
    }

    public function salarypdf($id)
    { 
        // dd($id);
        return redirect()->back()->with('printpdf',''.$id.'');
    }

    public function printpdf($id)
    {
        $salary = Salary::find($id);

        set_time_limit(300);
            
        $pdf = PDF::loadview('salaries.salarypdf', compact('salary'))->setPaper('a4', 'potrait');
        return $pdf->stream('salary/'.$salary->employee->name.date('YmdHis').'.pdf');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Model\Qrdata;
use App\Model\Deduction;
use PDF;

class SettingController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $deduction = Deduction::find(1);
        $qrdatas = Qrdata::orderBy('tanggal','DESC')->get();
        return view('settings.index', ['qrdatas' => $qrdatas, 'deduction' => $deduction]);
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
        $data = $request->except(['_token','_method']);
        $qr = Crypt::encryptString($data['tanggal']);
        // dd($data);
        $findqr = Qrdata::where('tanggal',$data['tanggal'])->first();
        if ($findqr) { 
            $qrid = $findqr->id;
        } else{
            $qrsave = Qrdata::create([
                'tanggal' => $data['tanggal'],
                'token_qr' => $qr,
                ]);
                $qrid = $qrsave->id;
            }
            
            // dd($receipt);
            return redirect()->back()->with('printqrcode',''.$qrid.'');
    }
        
        public function printqr($id)
        {
            $qrcode = Qrdata::find($id);
            
            $pdf = PDF::loadview('settings.printqr', compact('qrcode'))->setPaper('a4', 'potrait');
            return $pdf->stream('qrcode/'.date('YmdHis').'.pdf');
        }
        
        /**
        * Display the specified resource.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
        public function show($id)
        {
            //
        }
        
        /**
        * Show the form for editing the specified resource.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
        public function edit($id)
        {
            //
        }
        
        /**
        * Update the specified resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
        public function update(Request $request, $id)
        {
            //
        }
        
        /**
        * Remove the specified resource from storage.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
        public function destroy($id)
        {
            //
        }

        public function updateDeductions(Request $request)
        {
            $request->validate([
            'pph'=>'required|numeric',
            'bpjs'=>'required|numeric',
        ]);

            $deduction = Deduction::find(1);
            Deduction::where('id', $deduction->id)
              ->update([
                'pph_percentage' => $request->pph,
                'bpjs_percentage' => $request->bpjs
            ]);

            return redirect()->back()->with('success', 'Deduction updated!');
        }

}
    
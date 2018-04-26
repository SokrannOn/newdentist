<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Doctor;
use App\Doctorpayment;
use App\Rounding;
use App\Shardoctor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class paymentDoctorController extends Controller
{

    public function index()
    {
        $branch = Branch::where('unused',0)->pluck('name','id');
        $doctor = Doctor::where('active',1)->pluck('name','id');
       return view('admin.paymentDoctor.view', compact('branch','doctor'));
    }


    public function create()
    {
        $branch = Branch::where('unused',0)->pluck('name','id');
        $doctor = Doctor::where('active',1)->pluck('name','id');
        return view('admin.paymentDoctor.create',compact('branch','doctor'));
    }


    public function showPayment(Request $request){
        $start = $request->start;
        $end = $request->end;
        $payment = Doctorpayment::where('doctor_id',$request->doctor)->whereBetween('paiddate',[$start,$end])->get();
        return view('admin.paymentDoctor.showPayment',compact('payment'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
           'branch'=>'required',
            'doctor'=>'required'
        ]);
        $doc = Doctor::find($request->input('doctor'));
        $share = Shardoctor::where('doctor_id',$request->input('doctor'))->orderBy('id','desc')->latest()->value('balance');
        if($share){
            $share = $share;
        }else{
            $share=0;
        }

       $amount = $doc->baseSalary+Rounding::roundUp($share,'d');

        $d = new Doctorpayment();
        $d->paiddate = Carbon::now();
        $d->doctor_id = $request->input('doctor');
        $d->branch_id = $request->input('branch');
        $d->currency_id = Rounding::getDefaultCurrencyId();
        $d->paidAmount = $amount;
        $d->exchangeRate = Rounding::getExchangeRate();
        $d->user_id = Auth::user()->id;
        $d->save();
        return redirect()->back();
    }


    public function show($id)
    {
        $doc = Doctor::find($id);
        $share = Shardoctor::where('doctor_id',$id)->orderBy('id','desc')->latest()->value('balance');
        if($share){
            $share = $share;
        }else{
            $share=0;
        }
        return view('admin.paymentDoctor.doctor-detail',compact('share','doc'));
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

}

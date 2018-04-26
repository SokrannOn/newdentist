<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Branch;
use App\Doctor;
use App\Plan;
use App\Rounding;
use App\Shardoctor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class treatmentProcedure extends Controller
{

    public function index()
    {
        $treat = \App\Treatmentprocedure::OrderBy('id','desc')->get();
        return view('admin.treatmentProcedure.view',compact('treat'));
    }


    public function create()
    {
       $id = Auth::user()->branch_id;
       $b = Branch::where('unused',0)->pluck('name','id');
       $p = Plan::where('branch_id',$id)->get();
        $branch = Branch::find($id);
        $doc = $branch->doctors()->where('active',1)->pluck('name','id');
       return view('admin.treatmentProcedure.create',compact('b','p','id','doc'));
    }


    public function store(Request $request)
    {
        $appId = 0;
        $time = Carbon::parse($request->time)->format('G:i');
        if($request->ajax()){
            if($request->docApp && $request->day && $request->time && $request->plan_id){
                $plan = Plan::find($request->plan_id);
                $client_id = $plan->client_id;
                $appointment = new Appointment();
                $appointment->doctor_id = $request->docApp;
                $appointment->client_id = $client_id;
                $appointment->date = Carbon::now()->toDateString();
                $appointment->time = $time;
                $appointment->completed =0;
                $appointment->cancel =0;
                $appointment->plan_id = $request->plan_id;
                $appointment->accept = 1;
                $appointment->save();
                $appId = $appointment->id;
            }
            $treat = new \App\Treatmentprocedure();
            $treat->branch_id       = $request->branch_id;
            $treat->plan_id         = $request->plan_id;
            $treat->treatment_id    = $request->treatment_id;
            $treat->doctor_id       = $request->doctor_id;
            $treat->description     = $request->description;
            if($request->completed =='on'){
                $treat->completed =1;
                $treat->completeddate = Carbon::now()->toDateString();
            }else{
                $treat->completed =0;
            }
            $treat->appointment_id = $appId;
            $treat->save();
            if($request->completed =='on'){
                $doc=  Doctor::where('id',$request->doctor_id)->value('commission');
                $p = Plan::find($request->plan_id);
                $amount = 0;
                $qtyPro = 0;
                $proUnit= 0;
                $data = $p->treatments()->where('treatments.id',$request->treatment_id)->get();
                foreach ($data as $d){
                    $amount= $d->pivot->amount;
                    $qtyPro= $d->pivot->qty;
                    $proUnit= $d->pivot->proUnit;
                }
                if($doc){

                    $balance = 0;
                    $share = Shardoctor::where('doctor_id',$request->input('doctor_id'))->latest()->value('balance');
                    if($share){
                        $balance= $share;
                    }
                    $commission = $doc/100;
                    $total = $amount-($proUnit*$qtyPro);
                    $balanceCom = ($total*$commission);
                    $totalBalance = $balance + $balanceCom;
                    $s = new Shardoctor();
                    $s->date = Carbon::now()->toDateString();
                    $s->branch_id = $request->branch_id;
                    $s->plan_id = $request->plan_id;
                    $s->treatment_id = $request->treatment_id;
                    $s->doctor_id  = $request->doctor_id;
                    $s->balance = $totalBalance;
                    $s->amount =$balanceCom;
                    $s->exchangeRate = Rounding::getExchangeRate();
                    $s->confirm = 0;
                    $s->user_id = Auth::user()->id;
                    $s->save();
                }
            }
        }
    }


    public function show($id)
    {
        //
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


    public function getTreatment($id){

        $p = Plan::find($id);
        $t = $p->treatments;
        $treatment=[];
        foreach ( $t as $tr ){
            $treatment[]=['id'=>$tr->id,'name'=>$tr->engname];
        }
      return response()->json($treatment);
    }

    public function getDoctor($id){ // get doctor by branch

        $branch = Branch::find($id);
        $doc = $branch->doctors;
        $plan =[];
        $p = $branch->plans;
        foreach ($p as $pa){
            $plan[$pa->id]=sprintf('%09d',$pa->id);
        }
        return response()->json(['doc'=>$doc,'plan'=>$plan]);
    }
    public function getDoctorApp($id){

        $d = Doctor::find($id);
        $doc = $d->appointments()->where('completed',0)->get();
        return response()->json($doc);
    }
}

<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Branch;
use App\Doctor;
use App\Plan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class treatmentProcedure extends Controller
{

    public function index()
    {
        $treat = \App\Treatmentprocedure::OrderBy('id','desc')->get();
        return view('admin.treatmentProcedure.view',compact('treat'));
    }


    public function create()
    {
       $b = Branch::where('unused',0)->pluck('name','id');
       $p = Plan::where('active',1)->get();
       return view('admin.treatmentProcedure.create',compact('b','p'));
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
        return response()->json($doc);
    }
    public function getDoctorApp($id){

        $d = Doctor::find($id);
        $doc = $d->appointments()->where('completed',0)->get();
        return response()->json($doc);
    }
}

<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Branch;
use App\Client;
use App\Doctor;
use App\Plan;
use App\Treatment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class planController extends Controller
{

    public function index()
    {
        $plan = Plan::where('active',1)->get();
        return view('admin.plan.views',compact('plan'));
    }
    public function viewDetail($id){
        $plan = Plan::find($id);
        return view('admin.plan.detail',compact('plan'));
    }
    public function getContentViewDetail($id){
        $plan = Plan::find($id);
        return view('admin.plan.contentDetail',compact('plan'));
    }
    public function completed($id){
        DB::table('plan_treatment')->where('id',$id)->update(['completed'=>1]);
    }


    public function create()
    {
        $d  = Doctor::where('active',1)->pluck('name','id');
        $c  = Client::where('active',1)->pluck('engname','id');
        $tr = Treatment::where('active',1)->pluck('engname','id');
        $branch= Branch::where('unused',0)->pluck('name','id');
       return view('admin.plan.create',compact('d','c','tr','branch'));
    }
    public function getPriceTreatment($id){
        $t = Treatment::find($id);
        $un = $t->unitPrice;
        $dis = $t->dis;
        if(!$dis){
            $dis=1;
        }
        return response()->json(['un'=>$un,'dis'=>$dis]);
    }
    public function store(Request $request)
    {
          $time = Carbon::parse($request->time)->format('G:i');
          $branch_id =$request->branch_id;
          $plan_id = $request->plan_id;
          $dis = $request->dis;
          $grand =  ($request->qty*$request->price);
          $amount =$grand-($grand*($dis/100));
        if($request->ajax()){

            $p = Plan::find($plan_id);
            if(count($p)){
                $appointment = new Appointment();
                $appointment->doctor_id = $request->doctor_id;
                $appointment->client_id = $request->client_id;
                $appointment->date = $request->day;
                $appointment->time = $time;
                $appointment->completed =0;
                $appointment->cancel =0;
                $appointment->plan_id = $plan_id;
                $appointment->accept = 1;
                $appointment->save();
                $appointment_id = $appointment->id;
                $p->treatments()->attach($request->treatment_id,['appointment_id'=> $appointment_id,'teeNo'=>$request->teeNo,'qty'=>$request->qty,'price'=>$request->price,'amount'=>$amount]);
            }else{
                $p = new Plan();
//                date	doctor_id	client_id	active	user_id
                $p->date = Carbon::now()->toDateString();
                $p->effectiveDate = $request->effective;
                $p->expiredDate = $request->expd;
                $p->branch_id = $request->branch_id;
                $p->client_id = $request->client_id;
                $p->active = 1;
                $p->user_id = Auth::user()->id;
                $p->save();
                $plan_id = $p->id;

                $appointment = new Appointment();
                $appointment->doctor_id = $request->doctor_id;
                $appointment->client_id = $request->client_id;
                $appointment->date = Carbon::now()->toDateString();
                $appointment->time = $time;
                $appointment->completed =0;
                $appointment->cancel =0;
                $appointment->plan_id = $plan_id;
                $appointment->accept = 1;
                $appointment->save();
                $appointment_id = $appointment->id;

                $p->treatments()->attach($request->treatment_id,['appointment_id'=> $appointment_id,'teeNo'=>$request->teeNo,'qty'=>$request->qty,'price'=>$request->price,'amount'=>$amount]);
            }
            return response()->json(['id'=>$plan_id,'branch_id'=>$branch_id]);
        }
    }

    public function viewCurrent($id){
        $plan = Plan::find($id);
        return view('admin.plan.currentView',compact('plan'));
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

    public function doctorAppointment($id){

        $d = Doctor::find($id);
        $doc = $d->appointments()->where('completed',0)->get();
        return view('admin.plan.doctorAppointment',compact('doc'));
    }
}

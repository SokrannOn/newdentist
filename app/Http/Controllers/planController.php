<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Branch;
use App\Client;
use App\Doctor;
use App\Plan;
use App\Pricelist;
use App\Product;
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
        $product = Product::where('active',1)->pluck('enName','id');
        $branch= Branch::where('unused',0)->pluck('name','id');
       return view('admin.plan.create',compact('d','c','tr','branch','product'));
    }
    public function getPriceTreatment($id){
        $t = Treatment::find($id);
        $un = $t->unitPrice;
        $dis = $t->dis;
        if(!$dis){
            $dis=0;
        }
        return response()->json(['un'=>$un,'dis'=>$dis]);
    }
    public function store(Request $request)
    {
        if($request->ajax()){
            $id = $request->teeNo;
            $productId = 0;
            $amount=0;
            $priceList=0;
            $now = Carbon::now()->toDateString();
            if($id){
                $productId=$id;
                $priceList = Pricelist::where([['product_id',$id],['endDate','>=',$now]])->value('sellingPrice');
            }
            $time = Carbon::parse($request->time)->format('G:i');
            $branch_id =$request->branch_id;
            $plan_id = $request->plan_id;
            $dis = $request->dis;
            $grand =  ($request->qty*$priceList)+$request->price;
            if ($dis){
                $amount =$grand -($grand*($dis/100));
            }else{
                $amount =$grand;
            }
//            return response()->json(['id'=>$amount,'branch_id'=>$branch_id,'prilist'=>$priceList,'ProductId'=>$id,'grand'=>$grand,'Amount'=>$amount,'dis'=>$dis]);
            $p = Plan::find($plan_id);
            $c=[$p];
            if(count($c)){
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
                $p->treatments()->attach($request->treatment_id,['appointment_id'=> $appointment_id,'teeNo'=>$productId,'proUnit'=>$priceList,'qty'=>$request->qty,'price'=>$request->price,'amount'=>$amount]);
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

                $p->treatments()->attach($request->treatment_id,['appointment_id'=> $appointment_id,'teeNo'=>$productId,'proUnit'=>$priceList,'qty'=>$request->qty,'price'=>$request->price,'amount'=>$amount]);
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

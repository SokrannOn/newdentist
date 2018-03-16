<?php

namespace App\Http\Controllers;

use App\Client;
use App\Plan;
use App\Prescription;
use App\Product;
use App\Treatment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class prescriptionController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        $client = Client::where('active',1)->pluck('engname','id');
        $product = Product::where('active',1)->pluck('enName','id');

        return view('admin.prescription.create',compact('client','product'));

    }

    public function getPlan($id){
        $client = Prescription::where('client_id',$id)->get();
        $p = Plan::where('client_id',$id)->pluck('id','id');
        $data =[];
        foreach ($p as $plan){
            $data[$plan]=sprintf('%09d',$plan);
        }
        return response()->json(['plan'=>$data,'client'=>$client]);
    }

    public function medicalHistory($id){
        $client = Prescription::where('client_id',$id)->get();
        return view('admin.prescription.medicalHistory',compact('client'));
    }

    public function getTreatment($id){
        $plan = Plan::find($id);
        $data = [];
        $d = $plan->treatments;
        foreach ($d as $p){
            $data[$p->id]=$p->engname;
        }
        return response()->json($data);
    }

    public function getPrice($id){
       $now = Carbon::now()->toDateString();
       $pro =Product::find($id);
       $selling = $pro->pricelists()->where('endDate','>=','2018-03-14')->value('sellingPrice');
       if ($selling) {
           return response()->json($selling);
       }else{
           return response()->json(0);
       }
    }

    public function store(Request $request)
    {
        if($request->ajax()){
            $filter = Prescription::find($request->prescription_id);
            $un = $request->un;
            $qty = $request->qty;
            $amount = $un*$qty;
            if(!count($filter)){
                $pre = new Prescription();
                $pre->client_id = $request->client_id;
                $pre->treatment_id = $request->treatment_id;
                $pre->plan_id = $request->plan_id;
                $pre->date = Carbon::now()->toDateString();
                $pre->user_id = Auth::user()->id;
                $pre->save();
                $id=$pre->id;
                $pre->products()->attach($request->product_id,['des'=>$request->des,'qty'=>$request->qty,'price'=>$request->un,'amount'=>$amount]);
            }else{
                $id = $request->prescription_id;
                $filter->products()->attach($request->product_id,['des'=>$request->des,'qty'=>$request->qty,'price'=>$request->un,'amount'=>$amount]);
            }
        }
        return response()->json(['id'=>$id]);

    }

    public function getCurrent($id){
        $pres = Prescription::find($id);
       return view('admin.prescription.getCurrent',compact('pres'));
    }
    public function deletePre($id){
        DB::table('prescription_product')->where('id',$id)->delete();
    }
    public function printPre($id){
        $pre = Prescription::find($id);
        return view('admin.prescription.print',compact('pre'));
    }

    public function show($id)//getCurrenRecord
    {

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

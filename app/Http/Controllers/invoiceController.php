<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Plan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class invoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inv = Invoice::all();
        return view('admin.invoice.view',compact('inv'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plan = Plan::where('active',1)->get();
        return view('admin.invoice.create',compact('plan'));
    }

    public function showDetailPlan($id){
        $plan = Plan::find($id);
        return view('admin.invoice.planDetail',compact('plan'));

    }


    public function store(Request $request)
    {
        if($request->ajax()){
            $id     = $request->plan_id;
            $dis    = $request->dis;
            $date   = Carbon::now()->toDateString();
            $paid   = 0;
            $total = 0;
            $p = Plan::find($id);
            $credit =$p->treatments()->sum('amount');
            if($dis) {
                $total = round($credit - ($credit * $dis / 100),2);
            }else{
                $total = round($credit,2);
                $dis=0;
            }
            $inv = new Invoice();
            $inv->date    = $date;
            $inv->plan_id = $id;
            $inv->paid    = $paid;
            $inv->credit  = $credit;
            $inv->dis     = $dis;
            $inv->totalAmount = $total;
            $inv->isPayment	=0;
            $inv->print = 1;
            $inv->user_id = Auth::user()->id;
            $inv->save();
            $invId = $inv->id;
            $p->active = 0;
            $p->save();
            return response()->json(['id'=>$invId]);
        }
    }


    public function printInvoice($id){
        $inv = Invoice::find($id);
        return view('admin.invoice.print',compact('inv'));
    }

    public function show($id)
    {
        $inv = Invoice::find($id);
        return view('admin.invoice.viewInvoice',compact('inv'));
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

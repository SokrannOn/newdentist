<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Rounding;
use App\Transection;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ClientpaymentController extends Controller
{
    public $DS = DIRECTORY_SEPARATOR;
    public function create()
    {
        $file = public_path('setvariable'.$this->DS)."variablepayment.txt";
        if(file_exists($file) && count(unserialize(file_get_contents($file)))){
            $invoice = Invoice::where('isPayment','=',0)->get();
            return view('admin.clientpayment.create',compact('invoice'));
        }else
        {
            return view('admin.clientpayment.warning');
        }
    }

    public function submit(Request $request)
    {
        $this->validate($request, [
            'invN' => 'required',
            'paid' => 'required',
        ]);
        $batchId=0;
        $bacth = Transection::OrderBy('batchID','desc')->value('batchID');
        if ($bacth) {
            $batchId = $bacth+1;
        }else{
            $batchId = 1;
        }

        $rate = Rounding::getExchangeRate();
        $currency = Rounding::getDefaultCurrencyId();

        $invoice = Input::get('invN');

        $purchase = Invoice::find($invoice);

        $grandTotal = $purchase->credit;
        $paid = $purchase->paid;
        $paidnew = Input::get("paid");
        $cradit = $grandTotal - $paidnew;


        $file = public_path('setvariable'.$this->DS)."variablepayment.txt";
        if(file_exists($file) && count(unserialize(file_get_contents($file)))){
            $arId =0; $arCr=null; $varDr=null;$arAccType=null;
            $cohId =0; $cohCr=null; $cohDr=null;$cohAccType=null;

            $variable = unserialize(file_get_contents($file));
            foreach ($variable as $var) {

                $arId= $var['ar']['id'];
                $arCr= $var['ar']['Cr'];
                $arDr= $var['ar']['Dr'];
                $arAccType= $var['ar']['typeaccount_id'];

                $cohId =$var['coh']['id'];
                $cohCr=$var['coh']['Cr'];
                $cohDr=$var['coh']['Dr'];
                $cohAccType=$var['coh']['typeaccount_id'];
            }

        }
        $runningAr = Transection::where('chartaccount_id',$arId)->OrderBy('id','desc')->value('runningBalance');
        $transection = Transection::create(array(
            'batchID' => $batchId,
            //chivorn edit date
            'transectionDate'=>Carbon::parse($request->paymentDate)->toDateString(),
            'chartaccount_id'=>$arId,
            'typeaccount_id'=>$arAccType,
            'drAmt'=>0*$arDr,
            'crAmt'=>$paidnew * $arCr,
            'runningBalance'=>($paidnew*$arCr)+$runningAr,
            'Postamount'=>($paidnew*$arCr)*$rate,
            'currency'=>$currency,
            'exchangeRate'=>$rate,
            'user_id'=>Auth::user()->id,
        ));

        $runningCOH = Transection::where('chartaccount_id',$cohId)->OrderBy('id','desc')->value('runningBalance');
        $transection = Transection::create(array(
            'batchID' => $batchId,
            //chivorn edit date
            'transectionDate'=>Carbon::parse($request->paymentDate)->toDateString(),
            'chartaccount_id'=>$cohId,
            'typeaccount_id'=>$cohAccType,
            'drAmt'=>$paidnew*$cohDr,
            'crAmt'=>0*$cohCr,
            'runningBalance'=>($paidnew*$cohDr)+$runningCOH,
            'Postamount'=>($paidnew*$cohDr)*$rate,
            'currency'=>$currency,
            'exchangeRate'=>$rate,
            'user_id'=>Auth::user()->id,
        ));

        $purchase->paid =$paid+$paidnew;
        if($cradit==0){
            $purchase->isPayment=1;
            //chivorn edit date
            $purchase->paidDate=Carbon::parse($request->paymentDate)->toDateString();
            $purchase->credit=0;
        }else{
            $purchase->credit = $cradit;
        }
        $purchase->save();
        return redirect()->back();
    }

    public function entryPayment($id)
    {
        $cradit = Invoice::where('id','=',$id)->value('credit');
        return $cradit;
    }
}

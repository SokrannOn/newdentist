<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Chartaccount;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Input;
use App\Setvariable;

class SetvariableController extends Controller
{

    public $DS = DIRECTORY_SEPARATOR;
    public function create()
    {
        $setvariables=array();
        $file = public_path('setvariable'.$this->DS)."variableGenerateInv.txt";
        if(file_exists($file)&&count(unserialize(file_get_contents($file))))
        {
            $setvariables = unserialize(file_get_contents($file));
            //dd($setvariables); 
        }else{
            $setvariables = [];
        }
    	$chartaccounts = Chartaccount::whereIn('typeaccount_id',[1,4,6,7])->pluck('description','id');
    	return view('admin.setvariable.createVariableGenerateInv',compact('chartaccounts','setvariables'));
    }
    public function save(Request $re)
    {
   	$this->validate($re, [
           'ar' => 'required',
           'inventory' => 'required',
           'cogs' => 'required',
           'saleIncome' => 'required',
           'vatoutput' => 'required',
       ],[
            'ar.required'=>'Account Recieveable is required',
            'inventory.required'=>'Inventery is required',
            'cogs.required'=>'Cost of Goods Sold is required',
            'saleIncome.required'=>'Sale Income is required',
            'vatoutput.required'=>'VAT Output is required',
       ]
   );
        $Id=[$re->input('ar'),$re->input('inventory'),$re->input('cogs'),$re->input('saleIncome'),$re->input('vatoutput')];
        $chartaccountsId = Chartaccount::whereIn('id',$Id)->get();
        $ar =[];
        $inventory=[];
        $cogs=[];
        $saleIncome=[];
        $vatoutput=[];

        foreach ($chartaccountsId as $value) {
            if($re->input('ar')==$value->id){
                $ar=['id'=>$value->id,'Dr'=>$value->drsign,'Cr'=>$value->crsign,'typeaccount_id'=>$value->typeaccount_id];
            }
            if($re->input('inventory')==$value->id){
                $inventory=['id'=>$value->id,'Dr'=>$value->drsign,'Cr'=>$value->crsign,'typeaccount_id'=>$value->typeaccount_id];
            }
            if($re->input('cogs')==$value->id){
                $cogs=['id'=>$value->id,'Dr'=>$value->drsign,'Cr'=>$value->crsign,'typeaccount_id'=>$value->typeaccount_id];
            }
            if($re->input('saleIncome')==$value->id){
                $saleIncome=['id'=>$value->id,'Dr'=>$value->drsign,'Cr'=>$value->crsign,'typeaccount_id'=>$value->typeaccount_id];
            }
            if($re->input('vatoutput')==$value->id){
                $vatoutput=['id'=>$value->id,'Dr'=>$value->drsign,'Cr'=>$value->crsign,'typeaccount_id'=>$value->typeaccount_id];
            }

        }


        $setValue=
        [
	            'VariableName'=>
	            [
	                'ar'=>$ar,
	                'inventory'=>$inventory,
	                'cogs'=>$cogs,
                    'saleIncome'=>$saleIncome,
                    'vatoutput'=>$vatoutput
            	]

        ];

        // if(count($re->cookie('setVariablePayment'))){

        // 	return $re->cookie('setVariablePayment');

        // }else{
        // 	Cookie::queue(Cookie::make('setVariablePayment',$setValue, time()));
        // 	return redirect()->back();
        // }

		//return $re->cookie('setVariblePayment');
			//Cookie::queue(Cookie::make('setVariblePayment',$setValue, time())

        $file = public_path('setvariable'.$this->DS)."variableGenerateInv.txt";
        $content =serialize($setValue);
        if(file_exists($file))
        {
            unlink($file);
            if($fh= fopen($file, 'w'))
            {
                file_put_contents($file,$content);
                
            }
//            echo "Successfully to backup ";
        }
        else
        {
            if($fh= fopen($file, 'w'))
            {
                file_put_contents($file,$content);

            }
        }
        //dd(unserialize(file_get_contents($file)));
        return redirect()->back();
    }
    public function resetVariable(){
        $file = public_path('setvariable'.$this->DS)."variableGenerateInv.txt";
        if(file_exists($file))
        {
            unlink($file);
        }
        return redirect('/admin/set/variable');
    }
    public function createVariablePayment()
    {
        $setvariables=array();
        $file = public_path('setvariable'.$this->DS)."variablepayment.txt";
        if(file_exists($file)&&count(unserialize(file_get_contents($file))))
        {
            $setvariables = unserialize(file_get_contents($file));
        }else{
            $setvariables = [];
        }
        $chartaccounts = Chartaccount::whereIn('typeaccount_id',[1])->pluck('description','id');
        return view('admin.setvariable.createVariablePayment',compact('chartaccounts','setvariables'));
    }
    public function store(Request $re)
    {
        $this->validate($re, [
           'ar' => 'required',
           'coh' => 'required',
       ],[
            'ar.required'=>'Account Recieveable is required',
            'coh.required'=>'Cash On Hand is required',
       ]
    );

        $Id=[$re->input('ar'),$re->input('coh')];
        $chartaccountsId = Chartaccount::whereIn('id',$Id)->get();
        $ar =[];
        $coh=[];
        foreach ($chartaccountsId as $value) {
            if($re->input('ar')==$value->id){
                $ar=['id'=>$value->id,'Dr'=>$value->drsign,'Cr'=>$value->crsign,'typeaccount_id'=>$value->typeaccount_id];
            }
            if($re->input('coh')==$value->id){
                $coh=['id'=>$value->id,'Dr'=>$value->drsign,'Cr'=>$value->crsign,'typeaccount_id'=>$value->typeaccount_id];
            }

        }


        $setValue=
        [
                'VariableName'=>
                [
                    'ar'=>$ar,
                    'coh'=>$coh
                ]

        ];


        $file = public_path('setvariable'.$this->DS)."variablepayment.txt";
        $content =serialize($setValue);
        if(file_exists($file))
        {
            unlink($file);
            if($fh= fopen($file, 'w'))
            {
                file_put_contents($file,$content);
                
            }
//            echo "Successfully to backup ";
        }
        else
        {
            if($fh= fopen($file, 'w'))
            {
                file_put_contents($file,$content);

            }
        }
        return redirect()->back();
    }

    public function resetVariablePayment(){
        $file = public_path('setvariable'.$this->DS)."variablepayment.txt";
        if(file_exists($file))
        {
            unlink($file);
        }
        return redirect('/admin/set/variable/payment/create');
    }
}

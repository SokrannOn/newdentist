<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Rounding;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class currencyController extends Controller
{

    public function index()
    {


        $currency = Currency::where('active',1)->get();
        return view('admin.currency.view',compact('currency'));
    }


    public function create()
    {
        $de = Currency::where('default',1)->get();
        return view('admin.currency.create',compact('de'));
    }


    public function store(Request $request)
    {
        if($request->ajax()){

            $de = Currency::where('default',1)->get();
            $lc = Currency::where('localecurrency',1)->get();
            $c = new Currency();
            $c->engname = $request->engname;
            $c->khname = $request->khname;
            $c->startdate= $request->startdate;
            $c->enddate = $request->enddate;
            $c->rounding = $request->rounding;
            $c->decimalplace = $request->decimalplace;

            if(count($lc)){
                $c->localecurrency = 0;
            }else{
                if($request->lc == 'on'){
                    $c->localecurrency =1;
                }else{
                    $c->localecurrency = 0;
                }
            }
            if(count($de)){
                $c->default = 0;
            }else{
                if($request->default == 'on'){
                    $c->default = 1;
                }else{
                    $c->default = 0;
                }
            }
            $c->buyrate = $request->buyrate;
            $c->sellrate = $request->sellrate;
            $c->active = 1;
            $c->save();
        }
    }


    public function show($id)//delete currency mean update active to deactivate
    {
        $currency = Currency::find($id);
        $currency->active = 0;
        $currency->save();
    }


    public function edit($id)
    {
       $c = Currency::find($id);
       return view('admin.currency.edit',compact('c'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'engname'=>'required',
            'khname'=>'required',
            'startdate'=>'required',
            'enddate'=>'required',
            'rounding'=>'required',
            'decimalplace'=>'required',
            'buyrate'=>'required',
            'sellrate'=>'required'
        ],[

        ]);
        $c = Currency::find($id);
        $c->engname = $request->input('engname');
        $c->khname = $request->input('khname');
        $c->startdate= $request->input('startdate');
        $c->enddate = $request->input('enddate');
        $c->rounding = $request->input('rounding');
        $c->decimalplace = $request->input('decimalplace');
        if($request->input('editlc')=='on'){
            Currency::where('id','>',0)->update(['localecurrency'=>0]);
            $c->localecurrency = 1;
        }else{
            $c->localecurrency = 0;
        }
        if($request->input('editdefault') == 'on'){
            Currency::where('id','>',0)->update(['default'=>0]);
            $c->default = 1;
        }else{
            $c->default = 0;
        }
        $c->buyrate = $request->input('buyrate');
        $c->sellrate = $request->input('sellrate');
        $c->save();
        return redirect()->back();
    }


    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Exchange;
use App\Rounding;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class exchangeRate extends Controller
{

    public function index()
    {

        $e = Exchange::orderBy('id','desc')->get();
        return view('admin.currency.exchangeView',compact('e'));
    }


    public function create()
    {
        $cur = Currency::where('active',1)->pluck('engname','id');
        return view('admin.currency.exchangeCreate',compact('cur'));

    }


    public function store(Request $request)
    {
        if ($request->ajax()){
            $ex = new Exchange();
            $ex->currency_id = $request->currency_id;
            $ex->date = Carbon::now()->toDateString();
            $ex->sellrate = $request->sellrate;
            $ex->buyrate = $request->buyrate;
            $ex->midrate = ($request->sellrate+$request->buyrate)/2;
            $ex->save();
            $cur = Currency::find($request->currency_id);
            $cur->buyrate = $request->buyrate;
            $cur->sellrate = $request->sellrate;
            $cur->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

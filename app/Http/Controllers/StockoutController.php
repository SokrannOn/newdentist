<?php

namespace App\Http\Controllers;

use App\Prescription;
use App\Product;
use App\Stockout;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stockout = Stockout::all();
        return view('admin.stockouts.index',compact('stockout'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pre = Prescription::where('isExport','=',null)->get();
        return view('admin.stockouts.create',compact('pre'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $re)
    {
        $now = Carbon::now()->addYear(1)->toDateString('Y-m-d');
        $a=0;
        $j =0;
        $this->validate($re,[
            'pre_id'=>'required'
        ],[
            'pre_id.required' => 'Please select invoice number'
        ]);
        $user_id = Auth::user()->id;
        $invoiceN = $re->input('pre_id');//Get Invoice number from combobox in Form
        if($invoiceN!=0){
            $pres = Prescription::find($invoiceN);//Find purchase by In that got from comboBox from form
            $product = $pres->products()->get();// Get all product by Invoice/Purchase Order

            $stockout = new Stockout();//Insert to table stockout
            $stockout->date = Carbon::now()->toDateString();
            $stockout->prescription_id = $invoiceN;
            $stockout->user_id = $user_id;
            $stockout->status = 0;
            $stockout->save();
            $stockout_id = $stockout->id;

            foreach ($product as $p) {
                $qtyIn = $p->pivot->qty;
                $product_id = $p->id;
                $qt=$qtyIn;
                $result = DB::select("SELECT id, qty, import_id FROM `import_product` WHERE product_id = {$product_id} AND qty > 0"); // Select all product in import
                foreach ($result as $r){
                    //$res = DB::select("SELECT id, qty, import_id,product_id, mfd, expd FROM `import_product` WHERE import_id = {$r->import_id} AND product_id={$product_id} AND qty > 0 AND expd >{$now}");//select one by one from import
                    $res =DB::table('import_product')->select('id','qty','import_id','product_id','mfd','expd')->where('import_id',$r->import_id)->where('product_id',$product_id)->where('expd','>',0)->where('expd','>',$now)->get();
                    foreach ($res as $s){
                        $qt=$qt;
                        if( $a>=$qtyIn | $s->qty >= $qtyIn){
                            if($j!=$product_id){
                                $m = $s->qty - $qt;
                                if($m >=0){
                                    DB::table('import_product')->where('id', $s->id)->update(array('qty'=>$m));

                                    $Up = Prescription::find($invoiceN);
                                    $Up->isExport=1;
                                    $Up->save();

                                    DB::table('import_stockout')->insert(['stockout_id'=>$stockout_id,'import_id'=>$s->import_id, 'product_id' => $product_id, 'qty' => $qt,'expd' =>$s->expd]);
                                    $j = $product_id;
                                    $a=0;
                                }
                            }
                        }
                        elseif($s->qty < $qtyIn || $a < $qtyIn)
                        {
                            if($j!=$product_id)
                            {
                                $a = $a + $s->qty;
                                if ($a >= $qtyIn)
                                {
                                    $m = $s->qty - $qt;
                                    DB::table('import_product')->where('id', $s->id)->update(array('qty'=>$m));

                                    $Up = Prescription::find($invoiceN);//Update field delivery to 1
                                    $Up->isExport=1;
                                    $Up->save();

                                    DB::table('import_stockout')->insert(['stockout_id'=>$stockout_id,'import_id'=>$s->import_id, 'product_id'=>$product_id, 'qty'=>$qt, 'expd'=>$s->expd]);
                                    $j = $product_id;
                                    $a = 0;
                                }
                                elseif ($a < $qtyIn)
                                {
                                    $m = $qt - $s->qty;
                                    $qt = $m;
                                    DB::table('import_product')->where('id', $s->id)->update(array('qty'=>0));
                                    DB::table('import_stockout')->insert(['stockout_id'=>$stockout_id,'import_id'=>$s->import_id, 'product_id' => $product_id, 'qty' => $s->qty, 'expd' => $s->expd]);
                                }
                            }
                        }
                    }


                }
            }
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prescription = Prescription::find($id);
        return view('admin.stockouts.show',compact('prescription'));
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
    public function getPrescription($id){
        $pre = Prescription::find($id);
        return view('admin.stockouts.getprescriptiondetails',compact('pre'));
    }
}

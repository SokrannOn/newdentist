<?php

namespace App\Http\Controllers;

use App\Branch;
use App\History;
use App\Import;
use App\Product;
use App\Supply;
use App\Tmpimport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $import = Import::all();
        return view('admin.imports.index', compact('import'));
    }

    public function current($id){//show Current if import stock

        $importCurrent = Import::find($id);
        return view('admin.imports.currentView', compact('importCurrent'));
    }

    public function history($id)
    {
        $importId = Import::find($id);
        return view('admin.imports.view', compact('importId'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supply::where('active',1)->pluck('companyEnName','id');
        $branch = Branch::pluck('name','id');
        $product = Product::where('active',1)->pluck('khName','id');
        return view('admin.imports.create',compact('suppliers','product','branch'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $re)
    {
        $this->validate( $re,
            [
                'companyname'=>'required',
                'inv_date'=>'required',
                'inv_number'=>'required',
            ],[
                'companyname.required' => 'Company supplier name required',
                'inv_date.required' => 'Invoice date required',
                'inv_number.required' => 'Invoice number required'
            ]);
        $lPrice=0;
        $now= Carbon::now()->toDateString();
        $amount = Tmpimport::all()->sum('amount');
        $userId = Auth::user()->id;
        $import = new Import();
        $import->impDate = $now;
        $import->invoiceDate = $re->input('inv_date');
        $import->invoiceNumber = $re->input('inv_number');
        $import->totalAmount = $amount;
        $dis = $re->input('discount');
        if($dis!=null){
            $import->discount = $re->input('discount');
        }else{
            $import->discount = 0;
        }
        $bra = $re->input('branch_id');
        if($bra!=null){
            $import->branch_id = $re->input('branch_id');
        }else{
            $import->branch_id = 0;
        }
        $import->supplier_id = $re->input('companyname');
        $import->user_id =$userId;
        $import->save();
        $impId= $import->id;
//          end insert to main table

        $tmpInsert = Tmpimport::all();
        foreach ($tmpInsert as $row){
            $proId = $row->product_id;
            $qty = $row->qty;
            $landing = DB::table('pricelists')->select('landingPrice')->where([['product_id','=',$proId],['beginDate','<=',$now],['endDate','>=',$now],])->get();
            //$landing = DB::select("SELECT landingprice FROM `pricelists` WHERE product_id = {$proId} and startdate<=now() and enddate>=now()");
            foreach($landing as $rows){
                $lPrice=$rows->landingPrice;
            }
            $mfd = $row->mfd;
            $expd = $row->expd;
            $import->products()->attach($proId,['qty'=>$qty,'landingPrice'=>$lPrice,'mfd'=>$mfd, 'expd'=>$expd]);
        }


        //clone date from import_product to table histories
        $history = Import::findOrFail($impId);

        foreach ($history->products as $proID){
            $History = new History();
//                    importId	productId	qty	landingPrice	mfd	expd
            $History->import_id = $impId;
            $History->product_id = $proID->id;
            $History->qty = $proID->pivot->qty;
            $History->landingPrice= $proID->pivot->landingPrice;
            $History->mfd= $proID->pivot->mfd;
            $History->expd = $proID->pivot->expd;
            $History->save();
        }


        $tmpDelete = Tmpimport::truncate();
        return redirect(route('import.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
    public function importAdd($proId,$qty,$mfd,$exp)
    {
        $error="";
        if($proId==""){
            $error.="has errors";
        }
        if($qty==""){
            $error.="has errors";
        }
        if($mfd==""){
            $error.="has errors";
        }
        if($exp==""){
            $error.="has errors";
        }
        if($error==""){
            $lPrice = 0;
            $now= Carbon::now()->toDateString();
            $lPrice = DB::table('pricelists')->select('landingPrice')->where([['product_id','=',$proId],['beginDate','<=',$now],['endDate','>=',$now],])->value('landingPrice');
            $checkExist = Tmpimport::where('product_id','=',$proId)->value('qty');
            if($checkExist){
                $qtyUp = $checkExist+$qty;
                $amountUp = $qtyUp*$lPrice;
                DB::table('tmpimports')->where('product_id','=',$proId)->update(array('qty'=>$qtyUp, 'amount'=>$amountUp));

            }else{
                //$landing = DB::select("SELECT landingprice FROM `pricelists` WHERE product_id = {$id} and startdate<=now() and enddate>=now()");
                $amount = ($lPrice * $qty);
                $tmpInsert = new  Tmpimport();
                $tmpInsert->product_id = $proId;
                $tmpInsert->qty=$qty;
                $tmpInsert->amount= $amount;
                $tmpInsert->mfd = $mfd;
                $tmpInsert->expd = $exp;
                $tmpInsert->save();
            }
        }
        $tmpdata = Tmpimport::all();
        return response()->json($tmpdata);
    }
    public function viewRecord(){
        $tmpSelect = Tmpimport::orderBy('id','desc')->get();
        return view('admin.imports.show',compact('tmpSelect'));
    }
    //Remove Record one by one
    public function remove($id){
        $tmpInsert = Tmpimport::where('product_id','=',$id);
        $tmpInsert->delete();
        $tmpdata = Tmpimport::all();
        return response()->json($tmpdata);
    }
    public  function discard(){
        Tmpimport::truncate();
    }

}

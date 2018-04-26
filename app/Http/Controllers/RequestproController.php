<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Requestpro;
use App\Stockoutre;
use App\Tmprequestpro;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class RequestproController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = Requestpro::all();
        return view('admin.requestpro.index',compact('request'));
    }

    public function createRequestPro(Request $request){
        $now = Carbon::now()->toDateString();
        $product = Product::where('active',1)->get();
        $user = User::all();
        $catInPro = Product::select('category_id')->distinct('category_id')->pluck('category_id','category_id');
        $category = Category::whereIn('id',$catInPro)->get();
        return view('admin.requestpro.create',compact('now','product','category','user','requestData'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'request_by'       =>'required',
            'description'   =>'required'
        ],[
            'request_by.required' =>'Request by required',
            'description.required' =>'Description required'
        ]);
        $Req = new Requestpro();
        $Req->date = Carbon::now()->toDateString();
        $Req->request_by = Input::get('request_by');
        $Req->description = Input::get('description');
        $Req->user_id = Auth::user()->id;
        $Req->is_export = 0;
        $Req->save();
        $data = $request->session()->get('requestProduct');
        foreach ($data as $d) {
            $Req->products()->attach($d['id'],
                ['qty'=>$d['qty'],
                    'user_id'=>Auth::user()->id]);
        }
        $request->session()->forget('requestProduct');
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
        $request = Requestpro::find($id);
        return view('admin.requestpro.show',compact('request'));
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

    }

    public function addRequestPro(Request $request,$id)
    {
        $requestPro[$id]=[
            'id'=>$id,
            'qty'=>0
        ];
        $data = $request->session()->get('requestProduct');
        if($data){
            if(array_key_exists($id,$data)){

            }else{
                $request->session()->put('requestProduct',$data+$requestPro);
            }
        }else{
            $request->session()->put('requestProduct',$requestPro);
        }
    }
    public function showProduct(Request $request)
    {
        $now = Carbon::now()->toDateString();
        $product = Product::where('active',1)->get();
        $user = User::all();
        $catInPro = Product::select('category_id')->distinct('category_id')->pluck('category_id','category_id');
        $category = Category::whereIn('id',$catInPro)->get();
        $now1 = Carbon::now();
        $addyear = $now1->addYear()->toDateString();
        $data = $request->session()->get('requestProduct');
        $requests = Requestpro::where('is_export','=',0)->get();
        return view('admin.requestpro.request',compact('addyear','requests','data','now','product','user','category'));
    }
    public function addRequest($id,$qty)
    {
        $qty_tmp = Tmprequestpro::where('product_id','=',$id)->where('user_id','=',Auth::user()->id)->value('qty');
        if($qty_tmp){
            $new_qty = $qty_tmp+$qty;
            DB::table('tmprequestpros')->where('product_id',$id)->update(['qty'=>$new_qty]);
        }else{
            $tmp = new Tmprequestpro();
            $tmp->product_id = $id;
            $tmp->qty = $qty;
            $tmp->user_id = Auth::user()->id;
            $tmp->save();
        }
        $tmp = Tmprequestpro::where('user_id',Auth::user()->id)->get();
        return response()->json(['tmp'=>$tmp]);
    }
    public function removeRequestProduct(Request $request,$id)
    {
        $data = $request->session()->get('requestProduct');
        if(array_key_exists($id,$data)){
           unset($data[$id]);
           $request->session()->put('requestProduct',$data);
        }

    }
    public function updateQtyRequestProduct(Request $request,$id,$qty)
    {
        $data = $request->session()->get('requestProduct');
        if(array_key_exists($id,$data)){
            $updateQty = (int)$qty;//make a new value qty
            $new = array('qty'=>$updateQty); // stored a new qty in array to replace
            $replace = array_replace($data[$id],$new); // replace a new value into array
            unset($data[$id]);//delete index of array exist
            $updateProduct[$id]=$replace; //make a new array after replace
            $a = $data+$updateProduct; // make array like default
            $request->session()->forget('requestProduct'); //deleted session stock in
            $request->session()->put('requestProduct',$a); // make a new session stock in
        }

    }
    public function discard(Request $request)
    {
        $request->session()->forget('requestProduct');
    }

    //verify
    public function createverify()
    {
        $request = Requestpro::where('auth_id',null)->get();
        return view('admin.requestpro.createverify',compact('request'));
    }
    public function confirm(Request $request)
    {
        $id = $request->id;
        $requestpro = Requestpro::find($id);
        $requestpro->auth_id = Auth::user()->id;
        $requestpro->auth_date = Carbon::now()->toDateString();
        $requestpro->save();
        return redirect()->back();
    }
    public function viewRequested($id)
    {
        $request = Requestpro::find($id);
        return view('admin.requestpro.showverifybyid',compact('request'));
    }
    public function exportRequest()
    {
        $requstPro = Requestpro::whereNotNull('auth_id')->where('is_export',0)->get();
        return view('admin.requestpro.ExportRequest',compact('requstPro'));
    }
    public function viewRequestedDetail($id)
    {
        $requestPro = Requestpro::find($id);
        return view('admin.requestpro.showRequestDetail',compact('requestPro'));
    }
    public function exportRequestPro(Request $request){
        $this->validate($request,[
            'requestNumber'=>'required|min:1'
        ]);
        $qt=0;
        $a= 0;
        $j=0;
        $qtyUpToImport = 0;
        $now = Carbon::now()->toDateString('Y-m-d');
        $resquestpro = Requestpro::find($request->input('requestNumber'));
        if($resquestpro){

            $stockoutre = new Stockoutre();
            $stockoutre->outdate = Carbon::now()->toDateString();
            $stockoutre->requestpro_id = $request->input('requestNumber');
            $stockoutre->user_id = Auth::user()->id;
            $stockoutre->save();
            $stockoutreid = $stockoutre->id;

            foreach ($resquestpro->products as $re){
                $quantitiesRequest=$re->pivot->qty;
                $qt = $quantitiesRequest;
                $productId=$re->id;
                $results = DB::table('import_product')->where([['product_id',$productId],['qty','>',0],['expd','>',$now],])->get();
                foreach ($results as $result){
                    $qt = $qt;
                    if($a>=$quantitiesRequest | $result->qty >=$quantitiesRequest){

                        if($j!=$productId){
                            $qtyUpToImport = $result->qty - $quantitiesRequest;
                            if($qtyUpToImport>=0){

                                DB::table('import_product')->where('id', $result->id)->update(array('qty'=>$qtyUpToImport));
                                $prod = Product::find($productId);//Update qty to main table product
                                $bqty = $prod->qty;
                                $uqty = ($bqty-$quantitiesRequest);
                                $prod->qty = $uqty;
                                $prod->save();

                                DB::table('import_stockoutre')->insert(['stockoutre_id'=>$stockoutreid,'import_id'=>$result->import_id, 'product_id' => $productId, 'qty' => $qt,'expd' =>$result->expd]);
                                $j = $productId;
                                $a=0;

                            }
                        }

                    }elseif($result->qty < $quantitiesRequest || $a < $quantitiesRequest){

                        if($j!=$productId){
                            $a = $a + $result->qty;
                            if($a>= $quantitiesRequest){
                                $qtyUpToImport = $result->qty - $qt;
                                DB::table('import_product')->where('id', $result->id)->update(array('qty'=>$qtyUpToImport));
                                $prod = Product::find($productId);//Update qty to main table product
                                $bqty = $prod->qty;
                                $uqty = ($bqty-$quantitiesRequest);
                                $prod->qty = $uqty;
                                $prod->save();

                                DB::table('import_stockoutre')->insert(['stockoutre_id'=>$stockoutreid,'import_id'=>$result->importId, 'product_id' => $productId, 'qty' => $qt,'expd' =>$result->expd]);
                                $j = $productId;
                                $a=0;

                            }elseif($a<$quantitiesRequest){

                                $qtyUpToImport = $qt- $result->qty;
                                $qt=$qtyUpToImport;
                                DB::table('import_product')->where('id', $result->id)->update(array('qty'=>0));
                                DB::table('import_stockoutre')->insert(['stockoutre_id'=>$stockoutreid,'import_id'=>$result->importId, 'product_id' => $productId, 'qty' => $result->qty,'expd' =>$result->expd]);
                            }

                        }

                    }//end main If
                }

            }

            $requestproUpdate = Requestpro::find($request->input('requestNumber'));
            $requestproUpdate->is_export= 1;
            $requestproUpdate->save();
        }

        return redirect('show/requested/product');

    }
}

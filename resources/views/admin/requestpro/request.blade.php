<div class="row">
    <div class="col-lg-6">
        <div class=" scroll-y" style="height: 500px;border: 1px solid #3c8dbc; border-radius: 3px;">

            @foreach($category as $c)
                <div class="single category" style="margin-top: 10px;">
                    <h3 class="side-title"><span style="background-color: #3c8dbc;color:white;padding-left: 3px;padding-right: 3px;padding-top: 3px;border-top-right-radius: 10px;">{{$c->name}}</span></h3>
                </div>
                @foreach($product as $p)
                    @if($p->category_id==$c->id)
                        @if($data)
                                @if(array_key_exists($p->id,$data) )
                                    <div class="panel item" style="padding:0px;margin: 5px;">
                                        <div class="table-responsive product-box" style="background-color: #F2F3F4">
                                            <table class="table cursor-pointer">
                                                <tr>
                                                    <td width="10%"><img src="{{asset('/product_photo/'.$p->image)}}" alt="" style="width: 40px; height: 40px;"></td>
                                                    <td width="70%"><span>{{$p->productCode}}</span><br>
                                                        <i style="font-size: 10px; font-family: 'Khmer OS System', serif">{{$p->khName}}</i>
                                                 </td>
                                                    <td width="5%" style="line-height: 40px;"><i class="fa fa-check-circle text-success"></i></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                @else
                                    {{--dd--}}
                                    <div class="panel item" style="padding:0px;margin: 5px;">
                                        <div class="table-responsive product-box">
                                            <table class="table cursor-pointer">
                                                <tr onclick="add('{{$p->id}}')">
                                                    <td width="10%"><img src="{{asset('/product_photo/'.$p->image)}}" alt="" style="width: 40px; height: 40px;"></td>
                                                    <td width="70%"><span>{{$p->productCode}}</span><br>
                                                        <i style="font-size: 10px; font-family: 'Khmer OS System', serif">{{$p->khName}}</i>
                                                    </td>
                                                    <td width="5%" style="line-height: 40px;"><i class="fa fa-plus-circle text-primary"></i></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                @endif
                        @else
                            <div class="panel item" style="padding:0px;margin: 5px;">
                                <div class="table-responsive product-box">
                                    <table class="table cursor-pointer">
                                        <tr onclick="add('{{$p->id}}')">
                                            <td width="10%"><img src="{{asset('/product_photo/'.$p->image)}}" alt="" style="width: 40px; height: 40px;"></td>
                                            <td width="70%"><span>{{$p->productCode}}</span><br>
                                                <i style="font-size: 10px; font-family: 'Khmer OS System', serif">{{$p->khName}}</i>
                                            </td>
                                            <td width="5%" style="line-height: 40px;"><i class="fa fa-plus-circle text-primary"></i></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach
            @endforeach
        </div>
    </div>
    <div class="col-lg-6">
        <div class="row">
            <div class="col-lg-12">
                @if($data)
                    @foreach($data as $p)
                        @php
                            $available=0;
                            $requested=0;
                               if($requests){
                                   foreach ($requests as $r){
                                       $requestproId = $r->id;
                                       $requested = $requested + \Illuminate\Support\Facades\DB::table('product_requestpro')->where('product_id',$p['id'])->where('requestpro_id',$requestproId)->groupBy('product_id')->sum('qty');
                                   }
                               }
                               $instock= \Illuminate\Support\Facades\DB::table('import_product')->where([['product_id','=',$p['id']],['expd','>=',$addyear],])->groupBy('product_id')->sum('qty');
                               $available = $instock-$requested;
                        @endphp
                        <div class="product-box-add item" style="padding: 5px;">
                            <table class="">
                                <tr>
                                    <td width="10%"><img src="{{asset('/product_photo/'.\App\Product::where('id',$p['id'])->value('image'))}}" alt="" style="width: 80px"></td>
                                    <td><span style="padding: 5px;">{{\App\Product::where('id',$p['id'])->value('productCode')}}</span><br>
                                        <input type="hidden" name="availableQty" value="{{$available}}" id="available{{$p['id']}}">
                                        <div style="margin-left: 7px;">
                                            <i style="font-size: 10px; font-family: 'Khmer OS System', serif; padding:5px;">{{\App\Product::where('id',$p['id'])->value('khName')}}</i><br>
                                            <input type="number" class="form-control" name="qty" required value="{{$p['qty']}}" id="{{$p['id']}}" style="outline: none; height: 25px; width: 50%;" onkeyup="qtyProduct('{{$p['id']}}')"><br>
                                        </div>
                                        <div id="error{{$p['id']}}">
                                            <span style="padding:5px;font-size: 10px;">Stock Available : {{$available}} item.</span>
                                        </div>
                                    </td>
                                    <td width="5%"><a class="cursor-pointer" onclick="remove('{{$p['id']}}')"><i class="fa fa-remove text-danger"></i></a></td>
                                </tr>
                            </table>
                        </div>
                    @endforeach
                @else
                    <h4 class="center text-danger" style="background-color: #FDFEFE;padding: 6px; border-radius: 5px;border: 1px solid #ddd">No found record!</h4>
                @endif
            </div>
        </div>
        @if($data)
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('request_by','&nbsp;Request By',['class'=>'edit-label required']) !!}
                        <select name="request_by" id="request_by" class="edit-form-control" required>
                            <option value="">Request By</option>
                            @foreach($user as $u)
                                <option value="{{$u->id}}">{!! $u->name !!}</option>
                            @endforeach
                        </select>
                        @if($errors->has('request_by'))
                            <span class="text-danger">
                        {{$errors->first('request_by')}}
                    </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('description','&nbsp;Description',['class'=>'edit-label required']) !!}
                        {!! Form::textarea('description',null,['class'=>'edit-form-control text-blue','required'=>'true','rows'=>3])!!}
                        @if($errors->has('description'))
                            <span class="text-danger">
                        {{$errors->first('description')}}
                    </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="submit" class="btn btn-success btn-sm" value="Save">
                        <input type="button" class="btn btn-danger btn-sm" value="Discard" onclick="discardRecord()">
                    </div>
                </div>
            </div>
        @else

        @endif
    </div>

</div>
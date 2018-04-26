
    {!! Form::model($product,['action'=>['ProductController@update',$product->id],'method'=>'PATCH','files'=>true]) !!}
    <div class="row">
        <div class="col-lg-10">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('productCode','&nbsp;Code',['class'=>'edit-label required']) !!}
                        {!! Form::text('productCode',null,['class'=>'edit-form-control text-blue','required'=>'true'])!!}
                        @if($errors->has('productCode'))
                            <span class="text-danger">
                                                    {{$errors->first('productCode')}}
                                                </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('productBarcode','&nbsp;Barcode',['class'=>'edit-label required']) !!}
                        {!! Form::text('productBarcode',null,['class'=>'edit-form-control text-blue','required'=>'true'])!!}
                        @if($errors->has('productBarcode'))
                            <span class="text-danger">
                                                    {{$errors->first('productBarcode')}}
                                                </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('khName','&nbsp;Khmer Name',['class'=>'edit-label required']) !!}
                        {!! Form::text('khName',null,['class'=>'edit-form-control text-blue','required'=>'true'])!!}
                        @if($errors->has('khName'))
                            <span class="text-danger">
                                                    {{$errors->first('khName')}}
                                                </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('enName','&nbsp;English Name',['class'=>'edit-label required']) !!}
                        {!! Form::text('enName',null,['class'=>'edit-form-control text-blue','required'=>'true'])!!}
                        @if($errors->has('enName'))
                            <span class="text-danger">
                                                    {{$errors->first('enName')}}
                                                </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        {!! Form::label('category_id','&nbsp;Category Name',['class'=>'edit-label required']) !!}
                        {!! Form::select('category_id',$cat,null,['class'=>'edit-form-control height-35px text-blue','required'=>true,'placeholder'=>'---Please select one---']) !!}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        {!! Form::label('branch_id','&nbsp;Branch Name',['class'=>'edit-label']) !!}
                        {!! Form::select('branch_id',$bra,null,['class'=>'edit-form-control height-35px text-blue','placeholder'=>'---Please select one---']) !!}
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="file" class="edit-form-control" id="image" onchange="loadFile(event)" name="imageEdit" accept="image/x-png,image/gif,image/jpeg" style="display: none;">
                        <label for="image" class="cursor-pointer"><img src="{{asset('/product_photo/'.$product->image)}}" alt="" class="img-responsive" id="preView" style="border: 1px solid #238595; padding: 1px;margin-top:5px;"></label>
                        @if($errors->has('image'))
                            <span class="text-danger">
                                                {{$errors->first('image')}}
                                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="form-group">
        {!! Form::submit('Update',['class'=>'btn btn-primary btn-sm']) !!}
       <a onclick="cancel()" class="btn btn-danger btn-sm cursor-pointer">Cancel</a>
    </div>
    {!! Form::close() !!}

@section('script')
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('preView');
            output.src = URL.createObjectURL(event.target.files[0]);
        };
        var loadFileEdit = function(event) {
            var output = document.getElementById('preViewEdit');
            output.src = URL.createObjectURL(event.target.files[0]);
        };
        //
    </script>
@endsection
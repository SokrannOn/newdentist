@extends('admin.master')
@section('content')
    <br>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                Create Product
            </div>
            <div class="panel-body">
                <div class="editProduct">
                    {!! Form::open(['action'=>'ProductController@store','method'=>'post','files'=>true]) !!}
                    <input type="hidden" value="{{csrf_token()}}">
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
                                        <input type="file" class="edit-form-control" id="image" onchange="loadFile(event)" name="image" accept="image/x-png,image/gif,image/jpeg" style="display: none;">
                                        <label for="image" class="cursor-pointer"><img src="{{asset('/product_photo/default_photo.png')}}" alt="" class="img-responsive" id="preView" style="border: 1px solid #238595; padding: 1px;margin-top:5px;"></label>
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
                        {!! Form::submit('Create',['class'=>'btn btn-success btn-sm']) !!}
                        {!! Form::reset('Reset',['class'=>'btn btn-warning btn-sm']) !!}
                    </div>

                </div>
                {!! Form::close() !!}
                </div>

                <div class="panel-footer container-fluid">
                    <div id="tableProduct">

                    </div>
                </div>

            </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        var loadFile = function(event) {
            var output = document.getElementById('preView');
            output.src = URL.createObjectURL(event.target.files[0]);
        };
        var loadFileEdit = function(event) {
            var output = document.getElementById('preViewEdit');
            output.src = URL.createObjectURL(event.target.files[0]);
        };

        {{--$('#product').submit(function (e) {--}}
            {{--e.preventDefault();--}}
            {{--var data = $('#product').serialize();--}}
                {{--$.ajax({--}}
                    {{--type : 'post',--}}
                    {{--url  : "{{route('product.store')}}",--}}
                    {{--dataType: 'html',--}}
                    {{--data : data,--}}
                    {{--beforeSend:function () {--}}

                    {{--},--}}
                    {{--success:function (data) {--}}
                        {{--//console.log(data);--}}
                        {{--$('#product')[0].reset();--}}
                        {{--$(document).ready(function () {--}}
                            {{--getTableProduct();--}}
                        {{--});--}}
                    {{--}--}}
                {{--});--}}

        {{--});--}}
        $(document).ready(function () {
            getTableProduct();
        });
        function getTableProduct() {
            $.ajax({
                type : 'get',
                url : "{{route('product.index')}}",
                dataType : 'html',
                beforeSend:function () {

                },success:function (data) {
                    $('#tableProduct').html(data);
                    $('#productList').DataTable();
                }, error:function (error) {
                    console.log(error);
                }
            });
        }

        function editProduct(id) {
            $.ajax({
                type:'get',
                url:"{{url('/product/edit')}}"+"/"+id,
                dataType:'html',
                success:function (data) {
                   $('.editProduct').html(data);
                },
                error:function (error) {
                    console.log(error);
                }
            });
        }

        function deleteProduct(id) {
            swal({
                title: "Are you sure?",
                text: "Are you sure that you want to delete this product ?",
                type: "warning",
                showCancelButton:true,
                confirmButtonText: "Yes",
                cancelButtonText : "No",
                cancelButtonColor:"#d33",
                confirmButtonColor: "#dd4b39"
            }, function() {
                $.ajax({
                    url : "{{url('/product/delete')}}"+"/"+id,
                    type: "get",
                    dataType: 'html'
                })
                    .done(function(data) {
                        swal("Deleted!", "Your file was successfully deleted!", "success");

                        $(document).ready(function () {
                            getTableProduct();
                        });
                    })
                    .error(function(data) {
                        swal("Oops", "We couldn't connect to the server!", "error");
                    });
            });
        }
        function cancel() {
            window.location.reload();
        }
    </script>
@endsection
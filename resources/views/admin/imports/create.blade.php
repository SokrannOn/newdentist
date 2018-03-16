@extends('admin.master')
@section('content')
    {{--<div>--}}
        {{--@include('nav.message')--}}
    {{--</div>--}}
    <div class="container-fluid">
        <br><br>
        <div class="panel panel-default">
            {{--Create Users--}}
            <div class="panel-heading">Add new stock</div>
            <div class="panel panel-body">
                <div class="container-fluid">
                    <div class="row">
                     {!!Form::open(['action'=>'ImportController@store','method'=>'post'])!!}
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    {!! Form::label('branch_id','Branch Name', ['class'=>'']) !!}
                                    {!! Form::select('branch_id', $branch,null,['class'=>'edit-form-control height-35px', 'required'=>true, 'placeholder'=>'Please chose branch name'])!!}
                                    @if($errors->has('branch_id'))
                                        <div class="help-block">
                                            <strong>{{$errors->first('branch_id')}}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    {!! Form::label('companyname','Company Supplier Name', ['class'=>'']) !!}
                                    {!! Form::select('companyname', $suppliers,null,['class'=>'edit-form-control height-35px','id'=>'supply_id', 'required'=>true, 'placeholder'=>'Please chose companies name'])!!}
                                    @if($errors->has('companyname'))
                                        <div class="help-block">
                                            <strong>{{$errors->first('companyname')}}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    {!! Form::label('invoice_Date','Invoice Date', ['class'=>'']) !!}
                                    {!! Form::date('inv_date', null, ['class'=>'edit-form-control', 'id'=>'inv_date', 'required'=>true])!!}
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    {!! Form::label('inv_number','Invoice Number', ['class'=>'']) !!}
                                    {!! Form::text('inv_number', null, ['class'=>'edit-form-control', 'id'=>'inv_number', 'required'=>true, 'min'=>0,'placeholder'=>'CAM-00001'])!!}
                                    @if($errors->has('inv_number'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('inv_number')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    {!! Form::label('discount','Discount (%)', ['class'=>'']) !!}
                                    {!! Form::number('discount', null, ['class'=>'edit-form-control', 'id'=>'discount', 'min'=>0, 'placeholder'=>'10%', 'onkeyup'=>'checkValue()'])!!}
                                    @if($errors->has('discount'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('discount')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default"​ style="box-shadow: 0px 2px 30px -11px black">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            {!! Form::label('product_name','Product Name', ['class'=>'']) !!}
                                            {!! Form::select('product_name',$product,null,['class'=>'edit-form-control height-35px', 'id'=>'product_id','placeholder'=>'Please chose product name','onchange'=>'checkValue()'])!!}
                                            @if($errors->has('product_name'))
                                                <div class="help-block">
                                                    <strong>{{$errors->first('product_name')}}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            {!! Form::label('qty','Quantity', ['class'=>'']) !!}
                                            {!! Form::number('qty',null,['class'=>'edit-form-control', 'id'=>'qty', 'placeholder'=>'Please provide quantities','onkeyup'=>'checkValue()' ])!!}
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            {!! Form::label('mfd','Manufactured Date', ['class'=>'']) !!}
                                            {!! Form::date('mfd_date',null, ['class'=>'edit-form-control mfd','id'=>'mfd_date'])!!}
                                            @if($errors->has('mfd_date'))
                                                <span class="help-block">
                                            <strong>{{$errors->first('mfd_date')}}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            {!! Form::label('expd','Expired Date', ['class'=>'']) !!}
                                            {!! Form::date('expd_date',null, ['class'=>'edit-form-control','id'=>'exp_date'])!!}
                                            @if($errors->has('expd_date'))
                                                <span class="help-block">
                                            <strong>{{$errors->first('expd_date')}}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input type="button" class="btn btn-primary btn-xs" id="addtolist"  value="Add to List" onclick="addProduct()">
                                    <input type="button" class="btn btn-info btn-xs" id="viewAll"  value="Views" onclick="viewRecord()">
                                    <a href="{{url('/admin')}}" class="btn btn-default btn-xs">Close</a>
                                </div>
                            </div>
                        </div>
                        {{--<input type="submit" class="btn-default">--}}
                        <div id="table">

                        </div>

                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script type="text/javascript">

        //View all records from temporary table
        function viewRecord(){
            $.ajax({
                type: 'get',
                url :"{{url('/import/view/record')}}",
                dataType:'html',
                success:function (data) {
                    $("#table").fadeIn(2000);
                    $("#table").html(data);
                },
                errors:function (error) {
                    console.log(error);
                }

            });
        }
//        check values when release key
        function checkValue() {
            var qty = $("#qty").val();
            var  product_name = $('#product_id').val();
            var discount = $("#discount").val();
            if(product_name!=0){
                $("#qty").focus();
            }
            if(qty<0){
                $("#qty").css('border','1px solid red');
            }else if(qty==""){
                $("#qty").css('border','');
            }
            if(discount<0){
                $("#discount").css('border','1px solid red');
            }
        }

//     add record to temporary table

        function addProduct() {
            var proId = $('#product_id').val();
            var qty = $('#qty').val();
            var mfd = $('#mfd_date').val();
            var exp = $('#exp_date').val();
            if(proId=='' && qty=='' && mfd=='' && exp=='') {
                $('#product_id').css('border', '1px solid red');
                $('#qty').css('border', '1px solid red');
                $('#mfd_date').css('border', '1px solid red');
                $('#exp_date').css('border', '1px solid red');
            }else if(proId!='' && qty=='' && mfd=='' && exp==''){
                $('#product_id').css('border','1px solid lightblue');
                $('#qty').css('border','1px solid red');
                $('#mfd_date').css('border','1px solid red');
                $('#exp_date').css('border','1px solid red');
            }else if(proId !='' && qty!='' && mfd=='' && exp==''){
                $('#product_id').css('border','1px solid lightblue');
                $('#qty').css('border','1px solid lightblue');
                $('#mfd_date').css('border','1px solid red');
                $('#exp_date').css('border','1px solid red');
            }else if(proId!='' && qty!='' && mfd!='' && exp==''){
                $('#product_id').css('border','1px solid lightblue');
                $('#qty').css('border','1px solid lightblue');
                $('#mfd_date').css('border','1px solid lightblue');
                $('#exp_date').css('border','1px solid red');
            }else if(proId=='' && qty!='' && mfd!='' && exp!=''){
                $('#product_id').css('border','1px solid red');
                $('#qty').css('border','1px solid lightblue');
                $('#mfd_date').css('border','1px solid lightblue');
                $('#exp_date').css('border','1px solid lightblue');
            }else if(proId=='' && qty=='' && mfd!='' && exp!=''){
                $('#product_id').css('border','1px solid red');
                $('#qty').css('border','1px solid red');
                $('#mfd_date').css('border','1px solid lightblue');
                $('#exp_date').css('border','1px solid lightblue');
            }else if(proId=='' && qty=='' && mfd=='' && exp!=''){
                $('#product_id').css('border','1px solid red');
                $('#qty').css('border','1px solid red');
                $('#mfd_date').css('border','1px solid red');
                $('#exp_date').css('border','1px solid lightblue');
            }else if(proId!='' && qty=='' && mfd=='' && exp!=''){
                $('#product_id').css('border','1px solid lightblue');
                $('#qty').css('border','1px solid red');
                $('#mfd_date').css('border','1px solid red');
                $('#exp_date').css('border','1px solid lightblue');
            }else if(proId!='' && qty=='' && mfd!='' && exp!=''){
                $('#product_id').css('border','1px solid lightblue');
                $('#qty').css('border','1px solid red');
                $('#mfd_date').css('border','1px solid lightblue');
                $('#exp_date').css('border','1px solid lightblue');
            }else if(proId!='' && qty=='' && mfd!='' && exp==''){
                $('#product_id').css('border','1px solid lightblue');
                $('#qty').css('border','1px solid red');
                $('#mfd_date').css('border','1px solid lightblue');
                $('#exp_date').css('border','1px solid red');
            }else if(proId!='' && qty!='' && mfd=='' && exp==''){
                $('#product_id').css('border','1px solid lightblue');
                $('#qty').css('border','1px solid lightblue');
                $('#mfd_date').css('border','1px solid red');
                $('#exp_date').css('border','1px solid red');
            }else if(proId=='' && qty!='' && mfd!='' && exp==''){
                $('#product_id').css('border','1px solid red');
                $('#qty').css('border','1px solid lightblue');
                $('#mfd_date').css('border','1px solid lightblue');
                $('#exp_date').css('border','1px solid red');
            }else if(proId=='' && qty!='' && mfd=='' && exp!=''){
                $('#product_id').css('border','1px solid red');
                $('#qty').css('border','1px solid lightblue');
                $('#mfd_date').css('border','1px solid red');
                $('#exp_date').css('border','1px solid lightblue');
            }else if(proId=='' && qty=='' && mfd!='' && exp!=''){
                $('#product_id').css('border','1px solid red');
                $('#qty').css('border','1px solid red');
                $('#mfd_date').css('border','1px solid lightblue');
                $('#exp_date').css('border','1px solid lightblue');
            }else if(proId=='' && qty=='' && mfd=='' && exp!=''){
                $('#product_id').css('border','1px solid red');
                $('#qty').css('border','1px solid red');
                $('#mfd_date').css('border','1px solid red');
                $('#exp_date').css('border','1px solid lightblue');
            }else if(proId!='' && qty!='' && mfd=='' && exp!='') {
                $('#product_id').css('border', '1px solid lightblue');
                $('#qty').css('border', '1px solid lightblue');
                $('#mfd_date').css('border', '1px solid red');
                $('#exp_date').css('border', '1px solid lightblue');
            }else if(proId=='' && qty!='' && mfd=='' && exp=='') {
                $('#product_id').css('border', '1px solid red');
                $('#qty').css('border', '1px solid lightblue');
                $('#mfd_date').css('border', '1px solid red');
                $('#exp_date').css('border', '1px solid red');
            }else if(proId=='' && qty=='' && mfd!='' && exp==''){
                    $('#product_id').css('border','1px solid red');
                    $('#qty').css('border','1px solid red');
                    $('#mfd_date').css('border','1px solid lightblue');
                    $('#exp_date').css('border','1px solid red');
            }else{
                $('#product_id').css('border','1px solid lightblue');
                $('#qty').css('border','1px solid lightblue');
                $('#mfd_date').css('border','1px solid lightblue');
                $('#exp_date').css('border','1px solid lightblue');
                $.ajax({
                    type:'get',
                    url:"{{url('/import/add')}}"+"/"+proId+"/"+qty+"/"+mfd+"/"+exp,
                    dataType:'json',
                    success:function (data) {
                        $('#product_id').val('');
                        $('#qty').val('');
                        $('#mfd_date').val('');
                        $('#exp_date').val('');
                        $(document).ready(function () {
                            viewRecord();
                        });
                    },
                    error:function (error) {
                        console.log(error);
                    }
                });
            }
        }
        {{--function addToList() {--}}
            {{--var qty = $("#qty").val();--}}
            {{--var proId= $("#product_id").val();--}}
            {{--var mfd = $("#mfd_date").val();--}}
            {{--var exp = $("#exp_date").val();--}}
            {{--var invDate = $("#inv_date").val();--}}
            {{--var invNum = $("#inv_number").val();--}}
            {{--var supplyId = $("#supply_id").val();--}}
            {{--var error = "";--}}
            {{--if(supplyId==null){--}}
                {{--$("#supply_id").css('border','1px solid red');--}}
                {{--error+="has error";--}}
            {{--}--}}
            {{--if(invNum==""){--}}
                {{--$("#inv_number").css('border','1px solid red');--}}
                {{--error+="has error";--}}
            {{--}--}}
            {{--if(proId ==null){--}}
                {{--$("#product_id").css('border','1px solid red');--}}
                {{--error+="has error";--}}
            {{--}--}}
            {{--if(qty=="" || qty<0){--}}
                {{--$("#qty").css('border','1px solid red');--}}
                {{--error+="has error";--}}
            {{--}--}}
            {{--if(mfd==""){--}}
                {{--$("#mfd_date").css('border','1px solid red');--}}
                {{--error+="has error";--}}
            {{--}--}}
            {{--if(exp==""){--}}
                {{--$("#exp_date").css('border','1px solid red');--}}
                {{--error+="has error";--}}
            {{--}--}}
            {{--if(invDate==""){--}}
                {{--$("#inv_date").css('border','1px solid red');--}}
                {{--error+="has error";--}}
            {{--}--}}
            {{--if(error==""){--}}
                {{--error="";--}}
                {{--$.ajax({--}}
                    {{--type:'get',--}}
                    {{--url:"{{url('admin/stock/create')}}"+"/"+proId+"/"+qty+"/"+mfd+"/"+exp,--}}
                    {{--dataType: 'html',--}}
                    {{--success:function (data) {--}}
                        {{--$("#qty").css('border','');--}}
                        {{--$("#product_id").css('border','');--}}
                        {{--$("#mfd_date").css('border','');--}}
                        {{--$("#exp_date").css('border','');--}}
                        {{--$("#inv_date").css('border','');--}}
                        {{--$("#inv_number").css('border','');--}}
                        {{--$("#supply_id").css('border','');--}}
                        {{--$("#table").fadeIn(2000);--}}
                        {{--$("#table").html(data);--}}
                        {{--$("#qty").val(null);--}}
                        {{--$("#product_id").val(null);--}}
                    {{--},--}}
                    {{--error:function (error) {--}}
                        {{--console.log(error);--}}
                    {{--}--}}
                {{--});--}}
            {{--}--}}
        {{--}--}}

    //Delete Record by ID from terminal table
        function deleteRecord(id) {
            var proId = id;
            $.ajax({
                type:'get',
                url:"{{url('/tmp/import/remove')}}"+"/"+proId,
                dataType: 'json',
                success:function (data) {
                    $(document).ready(function () {
                        viewRecord();
                    });
                },
                error:function (error) {
                    console.log(error);
                }
            });
        }

 //Unsave recode to master table but delete all record in terminal table
        function discardRecord() {
            var message = confirm("Do you want to save change these record ?");
            if(message==true){
                $.ajax({
                    type:'get',
                    url : "{{url('/tmp/import/discard')}}",
                    success:function () {
                        window.location.reload();
                    }
                });
            }
        }


    </script>

@stop

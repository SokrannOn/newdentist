@extends('admin.master')

@section('content')
    <br>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                Prescription
            </div>
            <div class="panel-body">
                {!! Form::open(['id'=>'prescription']) !!}
                    {!! Form::hidden('prescription_id',0,['id'=>'prescription_id']) !!}
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                {!! Form::label('Client') !!}
                                {!! Form::select('client_id',$client,null,['class'=>'edit-form-control height-35px','placeholder'=>'Please choose client','id'=>'client_id','required']) !!}
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                {!! Form::label('Plan') !!}
                                {!! Form::select('plan_id',[],null,['class'=>'edit-form-control height-35px','placeholder'=>'Please choose plan','id'=>'plan_id','required']) !!}
                            </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                               {!! Form::label('Treatment') !!}
                               {!! Form::select('treatment_id',[],null,['class'=>'edit-form-control height-35px','placeholder'=>'Please choose treatment','id'=>'treatment_id','required']) !!}
                           </div>
                       </div>

                    </div>
                    <div class="panel panel-default  padding-10" style="box-shadow: 0px 2px 30px -11px black">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('Medical') !!}
                                    {!! Form::select('product_id',$product,null,['class'=>'edit-form-control height-35px','placeholder'=>'Please choose medical','id'=>'product_id','required']) !!}
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('Quantities') !!}
                                    {!! Form::number('qty',null,['class'=>'edit-form-control height-35px','placeholder'=>'Please provide quantities','step'=>'any','required']) !!}
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('Unit Price') !!}
                                    {!! Form::number('un',null,['class'=>'edit-form-control height-35px','placeholder'=>'unit price','step'=>'any','id'=>'un','readOnly']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                {!! Form::label('Description') !!}
                                {!! Form::textarea('des',null,['class'=>'edit-form-control','rows'=>'1','placeholder'=>'Enter your description','required']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            {!! Form::submit('Save',['class'=>'btn btn-success btn-sm','id'=>'submit']) !!}
                            {!! Form::reset('Add New',['class'=>'btn btn-warning btn-sm']) !!}
                            {!! Form::button('Medical History',['class'=>'btn btn-info btn-sm','id'=>'medicalHistory','style'=>'display:none','data-toggle'=>'modal','data-target'=>'#myModal']) !!}
                            <i class="fa fa-spinner fa-pulse fa-1x fa-fw" id="loading" style="display: none;"></i>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="panel-footer">
                <div id="getCurrent">

                </div>
            </div>
            <div id="printPre" style="display: none;"></div>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div id="viewMedicalhistory"></div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>

        $('#client_id').change(function () {
            var id = $('#client_id').val();
            var ele = "<option value=''>Please choose plan</option>"
            if(id){

                $.ajax({
                    type : 'get',
                    url  : "{{url('/prescription/get/plan/')}}"+"/"+id,
                    dataType : 'json',
                    beforeSend:function () {
                    },
                    success:function (data) {
                        if(data.client.length){
                            $('#medicalHistory').css('display','');
                        }else{
                            $('#medicalHistory').css('display','none');
                        }
                        $.map(data.plan,function (value,key) {
                            ele+="<option value='"+key+"'>"+value+"</option>";
                        });
                        $('#plan_id').html(ele);
                    },
                    error:function (error) {
                        console.log(error);
                    }
                });
            }else {
                $('#plan_id').html(ele);
                $('#medicalHistory').css('display','none');
            }

        });

        $('#medicalHistory').click(function () {
            var id =$('#client_id').val();
            $.ajax({
                type : 'get',
                url  : "{{url('/prescription/client/history')}}"+"/"+id,
                dataType : 'html',
                beforeSend:function () {
                },
                success:function (data) {
                    $('#viewMedicalhistory').html(data);
                },
                error:function (error) {

                }
            });

        });

        $('#plan_id').change(function () {
            var id = $('#plan_id').val();
            var ele = "<option value=''>Please choose plan</option>"
            if(id){

                $.ajax({
                    type : 'get',
                    url  : "{{url('/prescription/get/treatment')}}"+"/"+id,
                    dataType : 'json',
                    beforeSend:function () {
                    },
                    success:function (data) {

                        $.map(data,function (value,key) {
                            ele+="<option value='"+key+"'>"+value+"</option>";
                        });
                        $('#treatment_id').html(ele);
                    },
                    error:function (error) {
                        console.log(error);
                    }
                });
            }else {
                $('#treatment_id').html(ele);
            }

        });

        $('#product_id').change(function () {
            var id = $('#product_id').val();
            if(id){
                $.ajax({
                    type : 'get',
                    url  : "{{url('/prescription/get/price')}}"+"/"+id,
                    dataType : 'html',
                    beforeSend:function () {
                    },
                    success:function (data) {
                        $('#un').val(data);
                    },
                    error:function (error) {
                        console.log(error);
                    }
                });
            }else {
                $('#un').val("unit price");
            }

        });
        $('#prescription').submit(function (e) {
           e.preventDefault();
           var data = $('#prescription').serialize();
           $.ajax({
               type : 'post',
               url  : "{{route('prescription.store')}}",
               data : data,
               dataType : 'json',
               beforeSend:function () {

                    $('#submit').attr('disabled','true');
                    $('#loading').css('display','');
               },
               success:function (data) {
                    $('#prescription_id').val(data.id);
                    $('#submit').removeAttr('disabled');
                    $('#loading').css('display','none');
                    getCurrenRecord();
               },
               error:function (error) {
                   console.log(error);
               }
           });
        });
        function getCurrenRecord() {
            var preId = $('#prescription_id').val();
            if(preId){
                $.ajax({
                    type : 'get',
                    url  : "{{url('/prescription/get/current/create')}}"+"/"+preId,
                    dataType : 'html',
                    beforeSend:function () {

                    },
                    success:function (data) {
                        $('#getCurrent').html(data);
                    },
                    error:function (error) {
                        console.log(error);
                    }
                });
            }
        }
        function deletePrescript(id) {
            $.ajax({
                type : 'get',
                url  : "{{url('/prescription/delete/prescription')}}"+"/"+id,
                dataType : 'html',
                beforeSend:function () {

                },
                success:function (data) {
                    getCurrenRecord();
                },
                error:function (error) {
                    console.log(error);
                }
            });
        }
        function printPre() {
            var id = $('#prescription_id').val();
            $.ajax({
                type : 'get',
                url  : "{{url('/prescription/print/prescription')}}"+"/"+id,
                dataType : 'html',
                beforeSend:function () {

                },
                success:function (data) {
                    $('#printPre').html(data);
                    $(document).ready(function () {
                        $('#printPre').printThis(

                        )
                    });
                },
                error:function (error) {
                    console.log(error);
                }
            });
        }

    </script>
@endsection
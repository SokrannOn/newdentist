@extends('admin.master')
@section('content')
    <br>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                Create Plan
            </div>
            <div class="panel-body">
                {!! Form::open(['id'=>'planForm']) !!}
                    {!! Form::hidden('plan_id',0,['id'=>'plan_id']) !!}
                    {!! Form::hidden('dis',1,['id'=>'dis']) !!}
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                {!! Form::label('Client') !!}
                                {!! Form::select('client_id',$c,null,['class'=>'edit-form-control text-blue height-35px','required','placeholder'=>'Please choose client','id'=>'client_id']) !!}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                {!! Form::label('Effective Date') !!}
                                {!! Form::date('effective',null,['class'=>'edit-form-control text-blue','required','id'=>'client_id']) !!}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                {!! Form::label('Expired Date') !!}
                                {!! Form::date('expd',null,['class'=>'edit-form-control text-blue','required','id'=>'client_id']) !!}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                {!! Form::label('Branch') !!}
                                {!! Form::select('branch_id',$branch,null,['class'=>'edit-form-control text-blue height-35px','required','placeholder'=>'Please choose branch','id'=>'branch']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                {!! Form::label('Treatment') !!}
                                {!! Form::select('treatment_id',$tr,null,['class'=>'edit-form-control text-blue height-35px','required','placeholder'=>'Please choose treatment','id'=>'treatment_id']) !!}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                {!! Form::label('Teeth') !!}
                                {!! Form::number('teeNo',null,['class'=>'edit-form-control text-blue','required','placeholder'=>'Please enter teeth number','id'=>'teeNo']) !!}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {!! Form::label('Quantities') !!}
                                {!! Form::number('qty',1,['class'=>'edit-form-control text-blue','required','min'=>1,'placeholder'=>'Please enter quantities','id'=>'qty']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-lg-3">
                            <div class="form-group">
                                {!! Form::label('Unit Price') !!}
                                {!! Form::number('price',null,['class'=>'edit-form-control text-blue','required','readOnly','placeholder'=>'Unit Price','id'=>'price','step'=>'any']) !!}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                {!! Form::label('Doctor') !!}
                                {!! Form::select('doctor_id',$d,null,['class'=>'edit-form-control text-blue height-35px','required','placeholder'=>'Please choose doctor','id'=>'doctor_id']) !!}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {!! Form::label('Appointment Date') !!}
                                        {!! Form::date('day',null,['class'=>'edit-form-control text-blue','required','id'=>'client_id']) !!}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {!! Form::label('Time') !!}
                                        {!! Form::time('time',null,['class'=>'edit-form-control text-blue','required','id'=>'client_id']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div id="doctorAppointment">
                        <div class="row">
                            <div class="col-lg-12"></div>
                        </div>
                    </div>
                <br>
                    <div class="row">
                        <div class="col-lg-12">
                            {!! Form::submit('Create',['class'=>'btn btn-success btn-sm']) !!}
                            {!! Form::reset('Clear',['class'=>'btn btn-danger btn-sm']) !!}
                        </div>
                    </div>

                {!! Form::close() !!}

            </div>
            <div class="panel-body">
                <div id="currentView">

                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
//           $('#client_id').select2();
//           $('#doctor_id').select2();
        });
        $('#treatment_id').on('change',function () {
            var id = $('#treatment_id').val();
           $.ajax({
              type : 'get',
               url : "{{url('/plan/get/price/treatment/')}}"+"/"+id,
               dataType : 'json',
               success:function (data) {
                   $('#dis').val(data.dis);
                   $('#price').val(data.un);
               },
               error:function (error) {
                   console.log(error);
               }
           });
        });

        $('#planForm').submit(function (e) {
           e.preventDefault();
           var data = $('#planForm').serialize();
           $.ajax({
              type : 'post',
               url : "{{route('plan.store')}}",
               data: data,
               dataType : 'json',
               success:function (data) {
                   $('#treatment_id option').prop('selected',function () {
                       return this.defaultSelected;
                   });
                   $('#doctor_id option').prop('selected',function () {
                      return this.defaultSelected;
                   });
                   $('#teeNo').val('');
                   $('#qty').val('');
                   $('#price').val('');
                   currentView(data.id);
                   $('#plan_id').val(data.id);
                   console.log(data);
               },
               error:function (error) {
                  console.log(error);
               }
           });
        });

        function currentView(id) {
            $.ajax({
                type : 'get',
                url : "{{url('/plan/viewCurrent')}}"+"/"+id,
                dataType : 'html',
                success:function (data) {
                    $('#currentView').html(data);
                },
                error:function (error) {
                    console.log(error);
                }
            });
        }
        $('#doctor_id').on('change',function () {
            var id = $('#doctor_id').val();
            if(id){
                $.ajax({
                    type : 'get',
                    url : "{{url('/plan/doctor/appointment/')}}"+"/"+id,
                    dataType : 'html',
                    success:function (data) {
                        $('#doctorAppointment').html(data);
                        $('#doctorFladOut').fadeIn('slow');
                    },
                    error:function (error) {
                        console.log(error);
                    }
                });
            }else{
                $('#doctorFladOut').fadeOut('slow');
            }
        });
    </script>
@endsection
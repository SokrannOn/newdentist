@extends('admin.master')

@section('content')
    <br>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                Treatment Procedure
            </div>
            <div class="panel-body">
                {!! Form::open(['id'=>'procedureForm']) !!}
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    {!! Form::label('Branch') !!}
                                    {!! Form::select('branch_id',$b,null,['class'=>'edit-form-control text-blue height-35px','placeholder'=>'Please choose branch','id'=>'branch','required']) !!}
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    {!! Form::label('Plan') !!}
                                    <select name="plan_id" id="plan_id" required class="edit-form-control text-blue height-35px" onchange="getTreatment()">
                                        <option value="">Please choose plan</option>
                                        @foreach($p as $plan)
                                            <option value="{{$plan->id}}">{{sprintf('%09d',$plan->id)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    {!! Form::label('Treatment') !!}
                                    <select name="treatment_id" required id="treatment_id" class="edit-form-control text-blue height-35px">
                                        <option value="">No treatment choose</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    {!! Form::label('Doctor') !!}
                                    {!! Form::select('doctor_id',[],null,['class'=>'edit-form-control text-blue height-35px','required','placeholder'=>'Please choose doctor','id'=>'doctor_id']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-lg-9">
                                {!! Form::label('Description') !!}
                                {!! Form::textarea('description',null,['class'=>'edit-form-control text-blue','rows'=>'2']) !!}
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    {!! Form::label('') !!}
                                    <div class="checkbox checkbox-success">
                                        {!! Form::checkbox('completed',null,null,['id'=>'completed']) !!}
                                        <label for="completed">
                                            Completed
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="makeAppointment">
                                    <fieldset>
                                        <legend>Make Appointment</legend>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    {!! Form::label('Branch') !!}
                                                    {!! Form::select('braApp',$b,null,['class'=>'edit-form-control text-blue height-35px','placeholder'=>'Please choose doctor','id'=>'braApp']) !!}
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    {!! Form::label('Doctor') !!}
                                                    {!! Form::select('docApp',[],null,['class'=>'edit-form-control text-blue height-35px','placeholder'=>'No doctor choose','id'=>'docApp']) !!}
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    {!! Form::label('Day') !!}
                                                    {!! Form::date('day',null,['class'=>'edit-form-control text-blue height-35px']) !!}
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    {!! Form::label('Time') !!}
                                                    {!! Form::time('time',null,['class'=>'edit-form-control text-blue height-35px']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <lable>Doctor Appointment</lable>
                                                <div id="docAppointment">

                                                </div>
                                            </div>

                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                <br>
                        <div class="row">
                            <div class="col-lg-12">
                                {!! Form::submit('Save',['class'=>'btn btn-sm btn-success']) !!}
                            </div>
                        </div>
                {!! Form::close() !!}
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script>
        function getTreatment() {
            var id = $('#plan_id').val();
            var element = "<option value=''>No treatment choose</option>";
            if(id){
                $.ajax({
                    type : 'get',
                    url  : "{{url('/gettreatment/change')}}"+"/"+id,
                    dataType : 'json',
                    success:function (data) {
                        element = "<option value=''>No treatment choose</option>";
                        if(data.length){
                            element = "<option value=''>Please choose treatment</option>";
                            $.map(data,function (item) {
                                element+="<option value='"+item.id+"'>"+item.name+"</option>";
                            })
                        }
                        $('#treatment_id').html(element);
                    },
                    error:function (error) {
                        console.log(error);
                    }
                });
            }else{
                $('#treatment_id').html(element);
            }
        }

        $('#branch').on('change',function () {
            var id =  $('#branch').val();
            var element = "<option value=''>No doctor choose</option>";
            if(id){
                $.ajax({
                    type : 'get',
                    url  : "{{url('/getdoctor/by/branch/')}}"+"/"+id,
                    dataType : 'json',
                    success:function (data) {

                        if(data.length){
                            element = "<option value=''>Please choose doctor</option>";
                            $.map(data,function (item) {
                                element += "<option value='"+item.id+"'>"+item.name+"</option>";
                            })
                            $('#doctor_id').html(element);
                        }else{
                            $('#doctor_id').html(element);
                        }
                    },
                    error:function (error) {
                        console.log(error);
                    }
                });
            }else{
                $('#doctor_id').html(element);
            }
        });

        $('#braApp').on('change',function () {
            var id =  $('#braApp').val();
            var element = "<option value=''>No doctor choose</option>";
            if(id){
                $.ajax({
                    type : 'get',
                    url  : "{{url('/getdoctor/by/branch/')}}"+"/"+id,
                    dataType : 'json',
                    success:function (data) {

                        if(data.length){
                            element = "<option value=''>Please choose doctor</option>";
                            $.map(data,function (item) {
                                element += "<option value='"+item.id+"'>"+item.name+"</option>";
                            })
                            $('#docApp').html(element);
                        }else{
                            $('#docApp').html(element);
                        }
                    },
                    error:function (error) {
                        console.log(error);
                    }
                });
            }else{
                $('#docApp').html(element);
            }
        });

        $('#docApp').on('change',function () {
            var id = $('#docApp').val();
            if(id){
                $.ajax({
                    type : 'get',
                    url  : "{{url('/get/doctor/appointment/')}}"+"/"+id,
                    dataType : 'json',
                    success:function (data) {
                        var mes = "";
                        if(data.length){
                            $.map(data,function (item) {
                                mes += "<span class='label label-default' style='margin:2px; font-size: 12px;'>"+moment(item.date).format('DD-MMM-YYYY')+' '+ moment(item.time, "h:mm A").format("hh:mm A")+"</span>";
                                console.log(item.date);
                            })
                            $('#docAppointment').html(mes);
                        }else{
                            mes = "<span class='label label-default'>No appointment</span>";
                            $('#docAppointment').html(mes);
                        }

                    },
                    error:function (error) {
                        console.log(error);
                    }
                });
            }else {
                $('#docAppointment').html('');
            }
        });

        $('#procedureForm').submit(function (e) {
            e.preventDefault();
            var data = $('#procedureForm').serialize();
            $.ajax({
               type : 'post',
               url  : "{{route('treatmentprocedure.store')}}",
               data : data,
               dataType : 'html',
               success:function (data) {
                   $('#procedureForm')[0].reset();
               },
               error:function (error) {
                 console.log(error);
               }
            });
        });

    </script>
@endsection
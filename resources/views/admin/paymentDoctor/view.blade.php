@extends('admin.master')

@section('content')
    <br>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                View
            </div>
            <div class="panel-body">
                {!! Form::open(['id'=>'showPayment']) !!}
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                {!! Form::label('branch','Branch') !!}
                                {!! Form::select('branch',$branch,null,['class'=>'edit-form-control height-35','placeholder'=>'Please choose branch','required']) !!}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                {!! Form::label('doctor','Doctor') !!}
                                {!! Form::select('doctor',$doctor,null,['class'=>'edit-form-control height-35','placeholder'=>'Please choose doctor','required']) !!}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                {!! Form::label('start','Start Date') !!}
                                {!! Form::date('start',null,['class'=>'edit-form-control height-35','required']) !!}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                {!! Form::label('end','End Date') !!}
                                {!! Form::date('end',null,['class'=>'edit-form-control height-35','required']) !!}
                            </div>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-lg-12">
                        {!! Form::submit('Show',['class'=>'btn btn-success btn-sm']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div id="showPaymentIn">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
            $('#showPayment').submit(function (e) {
                e.preventDefault();
                $.ajax({
                   type : 'post',
                    url : "{{url('show-payment')}}",
                    data : $('#showPayment').serialize(),
                    dataType : 'html',
                    success:function (data) {
                        $('#showPaymentIn').html(data);
                    },
                    error:function (error) {
                        console.log(error);                    }
                });
            });
    </script>
@endsection
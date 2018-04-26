@extends('admin.master')
@section('content')
    <br>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                Payment Doctor
            </div>
            <div class="panel-body">
                {!! Form::open(['action'=>'paymentDoctorController@store','method'=>'post']) !!}
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                {!! Form::label('branch','Branch') !!}
                                {!! Form::select('branch',$branch,null,['class'=>'edit-form-control height-35px','required','placeholder'=>'Please choose branch']) !!}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {!! Form::label('doctor','Doctor') !!}
                                {!! Form::select('doctor',$doctor,null,['class'=>'edit-form-control height-35px','required','placeholder'=>'Please choose doctor']) !!}
                            </div>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            {!! Form::submit('Payment',['class'=>'btn btn-success btn-sm']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <div id="docInfo">
                                <div class="center" id="loading" style="display: none;">
                                    <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="panel-footer">

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#doctor').change(function () {
            var id = $('#doctor').val();
            $.ajax({
               type : 'get',
               url : "{{url('/doctorpayment/get-doc-info/')}}"+"/"+id,
               dataType : 'html',
               beforeSend:function () {
                    $('#loading').css('display','');
               },success:function (data) {
                    $('#docInfo').html(data);
               },error:function (error) {
                    console.log(error);
                }
            });
        });
    </script>
@endsection
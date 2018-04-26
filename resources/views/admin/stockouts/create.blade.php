@extends('admin.master')
@section('content')
    <div class="container-fluid">
        <br>
        <div class="panel panel-default">
            <div class="panel-heading">Export</div>
            <div class="panel panel-body">
                <div class="container-fluid">
                    <div class="row">
                        {!!Form::open(['action'=>'StockoutController@store','method'=>'post'])!!}
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    {!! Form::label('pre_id','Prescription Number ') !!}
                                        <select name="pre_id" id="pre_id" class="edit-form-control" onchange="getPrescription()" style="width: 100%; height: 35px;">
                                            <option value="0">Please select one</option>
                                            @foreach($pre as $row)
                                                <option value="{{$row['id']}}">{{"CAM-IN-" . sprintf('%06d',$row['id'])}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('pre_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('pre_id') }}</strong>
                                            </span>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group" id="pres">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group" id="btn-sub" hidden>
                                    {!! Form::submit('Submit',['class'=>'btn btn-success btn-sm']) !!}
                                    <a href="{{url('/')}}" class="btn btn-danger btn-sm">Cancel</a>
                                </div>
                            </div>
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


            function getPrescription() {
               var invN = $("#pre_id").val();
               if(invN!=0){
                   $.ajax({
                       type : 'get',
                       url : "{{url('/get/prescription')}}"+"/"+invN,
                       dataType: 'html',
                       success:function (data) {
                           $('#pres').html(data).fadeIn();
                           $('#btn-sub').fadeIn();
                       },
                       error:function (error) {
                         console.log(error);
                       }

                   });
               }else {
                   $('#pres').fadeOut();
                   $('#btn-sub').fadeOut();
               }
            }
    </script>

@stop

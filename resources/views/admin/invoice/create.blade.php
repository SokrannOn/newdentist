@extends('admin.master')
@section('content')
    <br>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                Invoice
            </div>
            <div class="panel-body">
                {!! Form::open(['method'=>'post','action'=>'invoiceController@store','id'=>'invoice']) !!}
                    {!! Form::hidden('invID',0,['id'=>'invID']) !!}
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('plan_id','Plan') !!}
                                        <select name="plan_id" id="plan_id" class="edit-form-control text-blue height-35px" required>
                                            <option value="">Please choose item</option>
                                            @foreach($plan as $p)
                                                <option value="{{$p->id}}">{{sprintf('%09d',$p->id)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('dis','Discount') !!}
                                        {!! Form::number('dis',null,['class'=>'edit-form-control text-blue','id'=>'plan_id','step'=>'any']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    {!! Form::submit('Save',['class'=>'btn btn-success btn-sm']) !!}
                                    <a class="cursor-pointer btn btn-danger btn-sm" onclick="history.back()">Back</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            {!! Form::label('') !!}
                            <div id="planDetail" class="table-responsive">

                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
            <div id="print" style="display: none">

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#plan_id').on('change',function () {
            var id = $('#plan_id').val();
            if(id){
                $.ajax({
                    type : 'get',
                    url : "{{url('invoice/show/plan/detail')}}"+"/"+id,
                    dataType : 'html',
                    beforeSend:function () {
                        $('#planDetail').html("<h5 class='center'><i class='fa fa-spinner fa-pulse fa-fw'></i> wait...</h5>");
                    },
                    success:function (data) {
                        $('#planDetail').html(data);
                    }

                });
            }else {
                $('#planDetail').html("");
            }

        });
        $('#invoice').submit(function (e) {
           e.preventDefault();
           var data = $('#invoice').serialize();
           $.ajax({
              type : 'post',
               url : "{{route('invoice.index')}}",
               data:data,
               dataType : 'json',
               success:function (data) {
                   $('#invoice')[0].reset();
                   printInvoice(data.id);
                   $('#planDetail').html("<div class='center'><h5>Invoice has been created.</h5></div>");
               },
               error:function (error) {

               }
           });
        });

        function printInvoice(id) {
            $.ajax({
               type : 'get',
               url : "{{url('invoice/print/invoice')}}"+"/"+id,
               dataType : 'html',
               success:function (data) {
                   $('#print').html(data);
                   $(document).ready(function () {
                       $('#print').printThis({
                           loadCSS: "",
                       });
                   });
               },
               error:function (error) {
                   console.log(error);
               }
            });
        }
    </script>
@endsection
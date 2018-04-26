@extends('admin.master')

@section('content')
    <br>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                Exchange Rate
            </div>
            <div class="panel-body">
                {!! Form::open(['id'=>'exchange']) !!}
                    <div class="row">
                        <div class="col-lg-4">
                            {!! Form::label('currency','Currency') !!}
                            {!! Form::select('currency_id',$cur,null,['class'=>'edit-form-control','placeholder'=>'Please select currency','required']) !!}
                        </div>
                        <div class="col-lg-4">
                            {!! Form::label('sellrate','Sell Rate') !!}
                            {!! Form::number('sellrate',null,['class'=>'edit-form-control','placeholder'=>'Please enter sell rate','required','step'=>'any']) !!}
                        </div>
                        <div class="col-lg-4">
                            {!! Form::label('buyrate','Buy Rate') !!}
                            {!! Form::number('buyrate',null,['class'=>'edit-form-control','placeholder'=>'Please enter buy rate','required','step'=>'any']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            {!! Form::submit('Add',['class'=>'btn btn-success btn-sm']) !!}
                            {!! Form::reset('Clear',['class'=>'btn btn-warning btn-sm']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="panel-footer">
                <div id="viewExchange"></div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            getContent();
        });
        function getContent() {
            $.ajax({
                type : 'get',
                url : "{{route('exchange.index')}}",
                dataType: 'html',
                beforeSend:function () {

                },
                success:function (data) {
                    $('#viewExchange').html(data);
                    $('#exchangefff').dataTable();
                },
                error:function (error) {
                    console.log(error);
                }
            });
        }


        $('#exchange').submit(function (e) {
            e.preventDefault();
            $.ajax({
                type : 'post',
                url : "{{route('exchange.store')}}",
                data: $('#exchange').serialize(),
                dataType: 'html',
                beforeSend:function () {

                },
                success:function () {
                    $('#exchange')[0].reset();
                    getContent();
                },
                error:function (error) {
                    console.log(error);
                }
            });
        });
    </script>
@endsection